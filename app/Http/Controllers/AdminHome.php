<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Visits;
use App\Models\Category as cat;

use Illuminate\Support\Carbon;

class AdminHome extends Controller
{
    //
    public function home() {
        $user_count             = User::where('state', '!=', 'deleted')->count();
        $book_count             = Book::where('state', '!=', 'deleted')->count();
        $published_book_count   = Book::whereHas('chapters', fn($query) => $query->where('state', 'published'))->where('state', '!=', 'deleted')->count();
        $visits                 = Visits::whereDate('created_at', Carbon::today())->count();
        $view_count             = Chapter::where('state', '!=', 'deleted')->sum('views');

        $active_users = User::whereNotNull('last_seen')->orderBy('last_seen', 'desc')->get();


        $categories = cat::whereHas('books', fn($query) => $query->whereHas('chapters', fn($second_query) => $second_query->where('state', 'published')))->limit(5)->get();


        return view('admin.dashboard',
        [
            'user_count'            => $user_count,
            'book_count'            => $book_count,
            'visits'                => $visits,
            'view_count'            => $view_count,
            'active_users'          => $active_users,
            'categories'            => $categories
        ]);
    }

    public function book() {
        
    }
}
