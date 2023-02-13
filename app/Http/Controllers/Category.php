<?php

namespace App\Http\Controllers;

use App\Models\Category as cat;
use Illuminate\Http\Request;

class Category extends Controller
{
    
    public function home_show() {
        $categories = cat::where('state', '!=', 'deleted')->with(['books' => fn($query) => $query->withSum('chapters as views', 'views')])->orderBy('created_at', 'desc');
        $categories_2 = $categories->paginate(8);

        $categories_1 = $this->get_views($categories->get());

        return view('collections', [
            'categories' => $categories_2,
            'categories_to_views' => $categories_1
        ]);
    }

    public function home_search(Request $request) {

        $query = Category::search($request);
        $result = $query->paginate(8)->appends(['search' => $request->search . "  " , 'filter' => $request->filter . "  "]);
        $categories = $query->get();

        if(request()->ajax())
        return view('search_results.home_category', [
            'categories' => $result,
            'categories_to_views'      => $this->get_views($categories),
        ]);

        return view('collections', [
            'categories' => $result,
            'categories_to_views'      => $this->get_views($categories),
        ]);
    }

    public function index()
    {
        //
        $categories = cat::where('state', '!=', 'deleted')->withCount(['books as books' => fn($query) => $query->where('state', '!=', 'deleted')])
                         ->with(['books' => fn($query) => $query->withSum('chapters as views', 'views')])->orderBy('created_at', 'desc');

        $categories_1 = $categories->get();
        $categories_2 = $categories->paginate(12);

        return view('admin.categories', [
            'categories' => $categories_2,
            'views'      => $this->get_views($categories_1),
        ]);
    }

    public function get_views($categories) {
        //converts the categories eloquent result to an array to allow access to the sub query result "books"
        $category_array = $categories->toArray();

        //an array to store the views for each category
        $category_to_views = array();

        //looping through the converted categories array to calculate and store the views for each category
        foreach($category_array as $category) {

            $category_to_views[$category['name']] = 0;

            foreach($category['books'] as $book) {
                $category_to_views[$category['name']] += (int) $book['views'];
            }
        }

        return $category_to_views;
    }


    public function create(Request $request)
    {
        $attributes = $request->validate([
            'image' => 'required',
            'name'  => 'required',
        ]);

        $status = 'success';

        //upload and update image

        $image_name = date('YmdHi') . '_' . $attributes['image']->getClientOriginalName();
        
        //check if category with name already exists and update if it does not
        $category_name = cat::where('name', $attributes['name'])->first();

        if($category_name != null) 
        return response()->json(['status' => 'exists']);


        else if($attributes['image']->move(public_path('images/category_images'), $image_name))

        $category = cat::create([
            'name' => $attributes['name'],
            'image' => $image_name
        ]);

        $result = cat::where('state', '!=', 'deleted')->withCount(['books as books' => fn($query) => $query->where('state', '!=', 'deleted')])
                     ->with(['books' => fn($query) => $query->withSum('chapters as views', 'views')])->where('id', $category->id);

        $result_1 = $result->paginate(10);
        $result_2 = $result->get();
        return view('search_results.admin_category', [
                'categories' => $result_1,
                'views'      => $this->get_views($result_2),
        ]);

    }

    
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'image' => '',
            'name'  => 'required',
            'id'    => 'required',
        ]);

        $status = 'success';

        //upload and update image
        if(isset($attributes['image'])) {

            $image_name = date('YmdHi') . '_' . $attributes['image']->getClientOriginalName();

            if($attributes['image']->move(public_path('images/category_images'), $image_name))
            cat::where('id', $attributes['id'])->update([
                'image' => $image_name
            ]);
        }

        //check if category with name already exists and update if it does not
        $category = cat::where('id', $attributes['id'])->first();
        $category_name = cat::where('name', $attributes['name'])->first();

        if($category_name != null && $category_name->id != $category->id) 
        $status = 'exists';

        else $category->update([
            'name' => $attributes['name']
        ]);
        
        return response()->json([
            'status' => $status,
            'name'   => $category->name,
            'image'  => $category->image
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


        if ($filter == 'book')
        $categories = cat::whereHas('books', fn($query) => $query->where('title', 'like', "%$search%"))->where('state', '!=', 'deleted');

        else
        $categories = cat::where('name', 'like', "%$search%")->where('state', '!=', 'deleted');

        return $categories->withCount(['books as books' => fn($query) => $query->where('state', '!=', 'deleted')])
        ->with(['books' => fn($query) => $query->withSum('chapters as views', 'views')])->orderBy('created_at', 'desc');
    }

    
    public function admin_search(Request $request)
    {

        $query = Category::search($request);
        $result = $query->paginate(12)->appends(['search' => $request->search . "  " , 'filter' => $request->filter]);
        $categories = $query->get();

        if(request()->ajax())
        return view('search_results.admin_category', [
            'categories' => $result,
            'views'      => $this->get_views($categories),
        ]);

        return view('admin.categories', [
            'categories' => $result,
            'views'      => $this->get_views($categories),
        ]);
    }


    public function destroy(Request $request)
    {

        $attributes = $request->validate([
            'id' => 'required'
        ]);

        cat::where('id', $attributes['id'])->update([
            'state' => 'deleted'
        ]);

        return response()->json([
            'status' => 'success'
        ]);

    }
}
