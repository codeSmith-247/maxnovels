<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\Category;
use App\Models\Copyright;
use App\Models\Rating;
use App\Models\Language;
use App\Models\Book;

class Details extends Controller
{
    //

    public function details() {

        return view('user.details', [
            'audience'  => Audience::all(),
            'categories'  => Category::where('state', '!=', 'deleted')->get(),
            'copyrights' => Copyright::all(),
            'ratings'    => Rating::all(),
            'languages'    => Language::all(),
        ]);
    }

    public function edit_details(Book $book) {

        if(auth()->user()->role != 'admin' && auth()->user()->role != 'super user' && $book->user[0]->id != auth()->user()->id) return redirect('/books');

        return view('user.edit_details', [
            'book' => $book,

            'audience'  => Audience::all(),
            'categories'  => Category::where('state', '!=', 'deleted')->get(),
            'copyrights' => Copyright::all(),
            'ratings'    => Rating::all(),
            'languages'    => Language::all(),
        ]);

    }
}
