<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

use Illuminate\Auth\Events\Registered;

class Signup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $attributes = $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email',
            'password'    => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'gender'      => 'required',
            'year'        => 'required|integer',
            'month'       => 'required|numeric',
            'day'         => 'required|integer',
        ]);

        $attributes['date_of_birth'] = $attributes['year'] . '-' . $attributes['month'] . '-' . $attributes['day'];

        unset($attributes['year']);
        unset($attributes['month']);
        unset($attributes['day']);

        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['remember_token'] = Str::random(10);

        if($user = User::create($attributes))

        if($user->gender == 'female') $user->update(['image' => 'avatar_female']);

        if(Auth::loginUsingId($user->id)) {
            event(new Registered($user));
            return redirect('/books');
        }

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
