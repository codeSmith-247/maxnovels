<?php

namespace App\Http\Controllers;

use App\Models\UserFingerprint;
use Illuminate\Http\Request;

class Fingerprint extends Controller
{

    public function index()
    {
        $attributes = request()->validate([
            'fingerprint' => 'required',
            'os'          => 'required',
        ]);

        $check = UserFingerprint::where('fingerprint', $attributes['fingerprint'])->first();

        if($check == null) {
            $check = UserFingerprint::create([
                'fingerprint' => $attributes['fingerprint'],
                'os'          => $attributes['os']
            ]);
        }

        session(['fingerprint' => $check->id]);
    }

}
