<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Auth;
use App\Models\User;
use App\Models\UserFingerprint;

class Oauth extends Controller
{
    public function google_redirect() {
        return Socialite::driver('google')->stateless()->redirect();

    }

    public function google_callback() {

        $user = Socialite::driver('google')->stateless()->user();

        $check = User::where('email', $user->email)->first();

        if($check != null && Auth::loginUsingId($check->id)) {

            session()->regenerate();

            $fingerprint = session('fingerprint');

            $fingerprint = UserFingerprint::where('id', $fingerprint)->update([
                'user_id' => auth()->user()->id
            ]);


            return redirect('/books');
            
        }

        session([
            'oauth_username' => $user->name,
            'oauth_email'    => $user->email
        ]);

        return redirect('additional_details');
    }

    public function signup() {
        $attributes = request()->validate([
            'gender'      => 'required',
            'year'        => 'required|integer',
            'month'       => 'required|numeric',
            'day'         => 'required|integer',
        ]);

        $attributes['date_of_birth'] = $attributes['year'] . '-' . $attributes['month'] . '-' . $attributes['day'];

        unset($attributes['year']);
        unset($attributes['month']);
        unset($attributes['day']);

        $attributes['password'] = bcrypt('averytotallyrandompasswordthatshouldneverbeusedeverandeverandever');
        $attributes['remember_token'] = Str::random(10);
        $attributes['name'] = session('oauth_username');
        $attributes['email'] = session('oauth_email');

        if($user = User::create($attributes))

        $user->update([
            'email_verified_at' => now()
        ]);

        if($user->gender == 'female') $user->update(['image' => 'avatar_female']);

        if(Auth::loginUsingId($user->id)) {
            return redirect('/books');
        }

        return back();
    }
}
