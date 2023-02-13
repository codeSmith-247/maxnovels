<?php

namespace App\Http\Controllers;

use App\Models\User as Users;

use Illuminate\Http\Request;

class User extends Controller
{
    public function index() {

        $users = Users::where('state', '!=', 'deleted')->paginate(12);

        return view('admin.users', [
            'users' => $users
        ]);

    }

    public function search(Request $request)
    {
        //
        $attributes = $request->validate([
            'search'   => '',
            'filter'   => '',
        ]);

        $filter = $attributes['filter'];
        $search = $attributes['search'];


        

        if ($filter == 'Email')
            $result = Users::where('email', 'like', "%$search%");

        else if($filter == 'DOB') {
            $result = Users::where('date_of_birth', 'like', '%'. $search .'%');
        }

        else if($filter == 'Book') {
            $result = Users::whereHas('books', fn($query) => $query->where('title', 'like', '%'. $search .'%'));
        }

        else if($filter == 'Age >') {
            $search = str_replace(' ', '', $search) == "" ? 0 : $search;
            $result = Users::whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 > ?', $search);
        }

        else if($filter == 'Age <') {
            $search = str_replace(' ', '', $search) == "" ? 1000 : $search;
            $result = Users::whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 < ?', $search);
        }

        else if($filter == 'Age =') {
            $result = Users::whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 like ?', "%$search%");
        }

        else if($filter == 'Online') {
            $result = Users::whereNotNull('last_seen')->where('last_seen', '>=', now()->subMinutes(2))->where(
                function($query) use($search) {
                    $query
                    ->where('email', 'like', '%'. $search .'%')
                    ->orWhere('name', 'like', '%'. $search . '%');
                }
            );
        }

        else
            $result = Users::where('name', 'like', "%$search%");

        return $result->where('state', '!=', 'deleted');
    }

    
    public function admin_search(Request $request)
    {

        $query = User::search($request);
        $result = $query->paginate(12)->appends(['search' => $request->search . "  " , 'filter' => $request->filter]);

        if(request()->ajax())
        return view('search_results.admin_users', [
            'users' => $result,
        ]);

        return view('admin.users', [
            'users' => $result,
        ]);
    }

    public function update() {
        $attributes = request()->validate([
            'image' => '',
            'role'  => 'required',
            'id'    => 'required',
        ]);

        if(isset($attributes['image'])) {

            $image_name = date('YmdHi') . '_' . $attributes['image']->getClientOriginalName();

            if($attributes['image']->move(public_path('images/user_images'), $image_name))
            Users::where('id', $attributes['id'])->update([
                'image' => $image_name
            ]);
        }

        Users::where('id', $attributes['id'])->update([
            'role' => $attributes['role']
        ]);

        $user = Users::where('id', $attributes['id'])->first();

        return response()->json([
            'status' => 'success',
            'role'   => $user->role,
            'image'  => $user->image,
        ]);
    }

    public function update_avatar() {
        $attributes = request()->validate([
            'image' => 'required',
            'id'    => 'required',
        ]);

        $image_name = date('YmdHi') . '_' . $attributes['image']->getClientOriginalName();

        if($attributes['image']->move(public_path('images/user_images'), $image_name) && (auth()->user()->role == 'admin' || auth()->user()->role == 'super user' || auth()->user()->id == $attributes['id']))

        Users::where('id', $attributes['id'])->update([
            'image' => $image_name
        ]);

        else 

        return response()->json([
            'status' => 'fail'
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy() {
        $attributes = request()->validate([
            'id' => 'required'
        ]);

        Users::where('id', $attributes['id'])->update([
            'state' => 'deleted'
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
