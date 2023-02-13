<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Audience;
use App\Models\Copyright;
use App\Models\Category;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Maxnovel Admin',
            'email'     =>  'maxnovels@gmail.com',
            'gender'    => 'male',
            'role'      => 'super',
            'password'  => bcrypt('maxnovels@pass2022'),
            'date_of_birth' => now(),
            'email_verified_at' => now(),
        ]);

        Audience::create([
            'audience' => 'Middle Grade (7 - 13 years of age)',
            'min_age'  => 7,
            'max_age'  => 13,
        ]);

        Audience::create([
            'audience' => 'Young Adult (13 - 18 years of age)',
            'min_age'  => 13,
            'max_age'  => 18,
        ]);

        Audience::create([
            'audience' => 'New Adult (18 - 25 years of age)',
            'min_age'  => 18,
            'max_age'  => 25,
        ]);

        Audience::create([
            'audience' => 'Adult (25+ years of age)',
            'min_age'  => 25,
            'max_age'  => 1000,
        ]);

        Copyright::create([
            'name' => 'All Rights Reserved'
        ]);

        Copyright::create([
            'name' => 'Public Domain'
        ]);

        Copyright::create([
            'name' => 'Creative Commons (CC) Attribution'
        ]);

        Copyright::create([
            'name' => '(CC) Attribution NonCommercial'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NonComm. NoDerivs'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NonComm. ShareAlike'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. NoDerivs'
        ]);

        Copyright::create([
            'name' => '(CC) Attrib. ShareAlike'
        ]);

        Category::create([
            'name'  => 'Romance',
            'image' => 'romance',
        ]);

        Rating::create([
            'name' => 'Mature'
        ]);

        Rating::create([
            'name' => 'General'
        ]);
    }
}
