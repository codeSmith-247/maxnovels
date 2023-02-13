<?php

use Illuminate\Support\Facades\Route;


//controllers
use App\Http\Controllers\BookCRUD;
use App\Http\Controllers\ChapterCRUD;
use App\Http\Controllers\Category;
use App\Http\Controllers\Details;
use App\Http\Controllers\Fingerprint;
use App\Http\Controllers\User;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Signup;
use App\Http\Controllers\Oauth;

use App\Http\Controllers\AdminHome;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//models


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//users can access these links without authentication

//books

Route::get("/", function () {

    $bookCrud = new BookCRUD();
    
    $latest_books    = $bookCrud->published_books()->limit(12)->get();
    $most_read_books = $bookCrud->most_read_books()->limit(12)->get();

    return view('home', [
        'latest_books'    => $latest_books,
        'most_read_books' => $most_read_books
    ]);

});

Route::get("/home", fn() => redirect('/'));

Route::get("/home_search",  [BookCRUD::class, 'home_search']);



Route::get("/collections", [Category::class, 'home_show']);
Route::get("/home_search_collection", [Category::class, 'home_search']);

Route::get("/books", [BookCRUD::class, 'books']);
Route::get("/books/{category:name}", [BookCRUD::class, 'books']);
Route::get("/books_search", [BookCRUD::class, 'books_search']);

Route::get("/admin_book_search", [BookCRUD::class, 'admin_search']);

Route::get("/preview/{book:title}", [BookCRUD::class, 'preview']);

Route::get("/read/{book:title}/{chapter:title}", [ChapterCRUD::class, 'read_chapter']);
Route::get("/read/{book:title}",                 [ChapterCRUD::class, 'read']);
Route::get("/next/{book:title}/{order}",         [ChapterCRUD::class, 'read_next']);
Route::get("/prev/{book:title}/{order}",         [ChapterCRUD::class, 'read_prev']);
Route::get("/bookmark/{book}/{chapter_id}",      [ChapterCRUD::class, 'bookmark']);

Route::get('/terms-and-conditions', function() {
    return view('terms');
});

Route::get('/privacy-policy', function() {
    return view('privacy');
});

Route::middleware(['guest'])->group(function () {

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );

     
        $status === Password::RESET_LINK_SENT
                    ? session(['password_sent' => true])
                    : back()->withErrors(['email' => __($status)]);

        return back();

    })->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

 
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');


    Route::get("/login", function () {
        return view('auth.login');
    })->name('login');
    Route::post("/login",  [LoginController::class, 'login']);


    Route::get("/signup", function () {
        return view('auth.signup');
    });
    Route::post("/signup", [Signup::class, 'signup']);

 
    Route::get('/google/redirect', [Oauth::class, 'google_redirect']);
    
    Route::get('/google/callback', [Oauth::class, 'google_callback']);

    Route::get('/additional_details', function() {
        if(!session()->has('oauth_username')) return redirect('/login');
        return view('auth.additional');
    });

    Route::post('/additional_details', [Oauth::class, 'signup']);

});


//users need authentication before accessing these links

Route::middleware(['auth'])->group(function () {

    Route::get('/email/verify', function () {

        return view('auth.verify-email');

    })->name('verification.notice');

 
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/home');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        session(['verification' => true]);
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    Route::post("/logout", [LoginController::class, 'logout']);
    
    Route::get("/details", [Details::class, 'details']);
    Route::get("/details/{book:title}", [Details::class, 'edit_details']);

    //books

    //books get
    Route::get("/yourbooks", [BookCRUD::class, 'yourbooks']);
    Route::get("/yourbooks_search", [BookCRUD::class, 'yourbooks_search']);
    //books post
    Route::post("/create_book",  [BookCRUD::class, 'create']);
    Route::post("/edit_book",  [BookCRUD::class, 'edit']);
    Route::post("/delete_book",  [BookCRUD::class, 'destroy']);
    Route::post("/update_avatar",  [User::class, 'update_avatar']);


    //chapters

    //chapters get
    Route::get("/chapters/{book:title}",                [ChapterCRUD::class, 'show_all']);
    Route::get("/writer/{book:title}/{chapter:title}",  [ChapterCRUD::class, 'index']);
    Route::get("/writer/create/new/{book_id}",          [ChapterCRUD::class, 'create']);
    Route::get("/search_chapters",                      [ChapterCRUD::class, 'search']);
    //chapters post
    Route::post("/save_chapter",                        [ChapterCRUD::class, 'save']);
    Route::post("/publish_chapter",                     [ChapterCRUD::class, 'publish']);
    Route::post("/publish_chapters",                    [ChapterCRUD::class, 'publish_all']);
    Route::post("/delete_chapter",                      [ChapterCRUD::class, 'destroy']);
    Route::post("/reorder_chapter",                     [ChapterCRUD::class, 'reorder']);




    //admin panel section requires admin panel authentication
    Route::middleware(['admin'])->group(function () {
        Route::get("/admin", [AdminHome::class, 'home']);
    
        Route::get("/admin/books", [BookCRUD::class, 'admin_books']);
    
        //category get
        Route::get("/admin/categories", [Category::class, 'index']);
        Route::get("/admin_category_search", [Category::class, 'admin_search']);
    
        //category post
        Route::post("/create_category", [Category::class, 'create']);
        Route::post("/update_category", [Category::class, 'update']);
        Route::post("/delete_category", [Category::class, 'destroy']);
    
    
        //user get
            Route::middleware(['superuser'])->group(function () {
                Route::get("/admin/users", [User::class, 'index']);
                Route::get("/user_search", [User::class, 'admin_search']);
            
                //user post
                Route::post('/update_user', [User::class, 'update']);
                Route::post('/delete_user', [User::class, 'destroy']);
            });
    });

});


//general operations

Route::post("/fingerprint", [Fingerprint::class, 'index']);