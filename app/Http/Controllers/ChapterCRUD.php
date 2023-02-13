<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterToBook;
use App\Models\FingerprintToChapter;

use App\Models\Book;
use App\Models\Bookmark;

use Illuminate\Http\Request;

use Auth;

class ChapterCRUD extends Controller
{

    public function index(Book $book, Chapter $chapter) {
        $chapter = $chapter->whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('state' , '!=', 'deleted')->where('title', $chapter->title)->first();

        if($chapter == null) return redirect('/chapters/'. $book->title);



        return view('user.writer', [
            'book'     => $book,
            'chapter'  => $chapter,
        ]);
    }

    public function read_chapter(Book $book, Chapter $chapter) {


        // $chapter = $this->check_view($book);

        $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('title', $chapter->title)->where('state', 'published')->orderBy('order', 'asc')->first();
        
        $bookmark = false;
        
        $bookmarks = [];

        if(Auth::check()) {
            $bookmark = Bookmark::where('book_id', $book->id)->where('chapter_id', $chapter->id)->where('user_id', auth()->user()->id)->first();

            $bookmark = $bookmark == null ? false: true;
            
            $bookmarks = Bookmark::where('book_id', $book->id)->where('user_id', auth()->user()->id)->with('chapter')->get();
        }

        return view('reader', [
            'book' => $book,
            'chapter' => $chapter,
            'bookmark' => $bookmark,
            'bookmarks' => $bookmarks
        ]);

    }

    public function read(Book $book) {

        $chapter = $this->check_view($book);
        

        if($chapter == null) {
            return redirect('/books');
        }

        return redirect('/read/'. $book->title . '/' . $chapter->title);
        
        
    }

    public function check_view($book) {

        $fingerprint = session('fingerprint');
    

        $chapter_id = null;

        //check for the last chapter read by the user's browser
        $check = FingerprintToChapter::where('fingerprint_id', $fingerprint)->where('book_id', $book->id)->orderBy('created_at', 'desc')->first();

        
        
        //if user is logged in and has a bookmark overide last chapter with bookmark
        if(Auth::check()) {
            $bookmark = Bookmark::where('user_id', auth()->user()->id)->where('book_id', $book->id)->first();

            if($bookmark != null) {
                $check = $bookmark;
                $chapter_id = $check->chapter_id;
            }
        } 

        //if there is no bookmark or chapter read by the browser, get the first chapter of the book
        if($check == null) {

            $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('state', 'published')->orderBy('order', 'asc')->first();
            $chapter_id = $chapter->id;
            
            if(session()->has('fingerprint')) {

                FingerprintToChapter::create([
                    'fingerprint_id' => $fingerprint,
                    'book_id'        => $book->id,
                    'chapter_id'     => $chapter->id,
                ]);
            }

            Chapter::where('id', $chapter_id)->increment('views');
        }
        else {
            $chapter_id = $check->chapter_id;
        }

        $chapter = Chapter::where('id', $chapter_id)->where('state', 'published')->first();

        return $chapter;
    }

    public function read_next(Book $book, $order) {
        $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('order', '>', $order)->where('state', 'published')->orderBy('order', 'asc')->first();
        
        if($chapter == null) {
            $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('order', '=', $order)->where('state', 'published')->orderBy('order', 'asc')->first();
        }

        return redirect('/read/'. $book->title . '/' . $chapter->title);

    }

    public function read_prev(Book $book, $order) {
        $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('order', '<', $order)->where('state', 'published')->orderBy('order', 'desc')->first();

        
        if($chapter == null) {
            $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->where('order', '=', $order)->where('state', 'published')->orderBy('order', 'asc')->first();
        }

        return redirect('/read/'. $book->title . '/' . $chapter->title);

    }

    public function bookmark($book, $chapter_id) {

        if(!Auth::check()) return response()->json(['status' => 'fail']); 

        $attributes = request()->validate([
            'state' => 'required',
        ]);

        Bookmark::where('book_id', $book)->where('user_id', auth()->user()->id)->where('chapter_id', $chapter_id)->delete();

        if($attributes['state'] == 'true')
        Bookmark::create([
            'book_id'    => $book,
            'chapter_id' => $chapter_id,
            'user_id'    => auth()->user()->id
        ]);

        return response()->json([
            'status' => 'success'
        ]);
        
    }

    public function get_title($chapter_number, $book_id) {
        $chapter = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book_id))->where('title', "Chapter $chapter_number")->where('state' , '!=', 'deleted')->first();

        if($chapter == null) return $chapter_number;
        else {
            $chapter_number++;
            return $this->get_title($chapter_number, $book_id);
        }
    }

    public function create($book_id)
    {
        $this->authenticate($book_id);

        $latest_chapter = Book::where('id', $book_id)->withCount(['chapters as chapters' => function($query) {
            $query->where('state', '!=', 'deleted');
        }])->first()->chapters;

        $latest_chapter = $latest_chapter + 1;

        $latest_chapter = $this->get_title($latest_chapter, $book_id);
        
        $latest_order = Book::where('id', $book_id)->with(['chapters' => function($query) {
                $query->where('state', '!=', 'deleted')->orderBy('order', 'desc')->first();
            }])->first()->chapters[0]->order;
            
        
        
        $chapter = Chapter::create([
            'title' => 'Chapter ' . $latest_chapter,
            'order' => $latest_order + 1,
        ]);

        ChapterToBook::create([
            'chapter_id' => $chapter->id,
            'book_id'    => $book_id,
        ]);

        return redirect('/writer/'. Book::select('title')
                ->where('id', $book_id)->first()->title . '/Chapter ' . $latest_chapter);

    }

    public function authenticate($book_id) {

    }

    public function save(Request $request)
    {
        //
        $attributes = $request->validate([
            'book_id'    => 'required',
            'chapter_id' => 'required',
            'title'      => '',
            'content'    => 'required',
        ]);

        $this->authenticate($attributes['book_id']);

        $check = Chapter::whereHas('book', fn($query) => $query->where('books.id', $attributes['book_id']))->where('title', $attributes['title'])->first();
        

        $chapter = Chapter::where('id', $attributes['chapter_id'])->with('book')->first();

        if($check != null && $check->id != $chapter->id) 
        return response()->json(['status' => 'error', 'chapter_id' => $chapter->id, 'check_id' => $check->id]);

        $chapter->update(['draft' => $attributes['content']]);
        
        if(str_replace(' ', '', $attributes['title'] != ""))
        $chapter->update(['title' => str_replace( array( '\'', '"', ',' , ';', '<', '>', '?' ), ' ', $attributes['title'])]);

        return response()->json(['status' => 'success', 'book' => $chapter->book[0]->title, 'chapter' => $chapter->title]);
    }

    public function publish(Request $request)
    {
        //
        $attributes = $request->validate([
            'book_id'    => 'required',
            'chapter_id' => 'required',
        ]);

        $this->authenticate($attributes['book_id']);

        $chapter = Chapter::where('id', $attributes['chapter_id'])->with('book')->first();

        $chapter->update([
            'state'     => 'published',
            'published' => $chapter->draft
        ]);

        return response()->json(['status' => 'success',  'book' => $chapter->book[0]->title, 'chapter' => $chapter->title]);
    }

    public function show_all(Book $book)
    {
        //
        $chapters = Chapter::whereHas('book', fn($query) => $query->where('books.id', $book->id))->with('book')->orderBy('order', 'asc')->where('state', '!=', 'deleted')->get();

        return view('user.chapters', [
            'chapters' => $chapters,
            'book'     => $book,
        ]);
    }

    public function search(Request $request) {
        $attributes = $request->validate([
            'book_id' => 'required',
            'search'  => '',
        ]);

        $chapters = Chapter::whereHas('book', fn($query) => $query->where('books.id', $attributes['book_id']))->with('book')
                             ->where('title', 'like', '%'. $attributes['search'] .'%')->with('book')->orderBy('order', 'asc')->where('state', '!=', 'deleted')->get();
        if($request->ajax()) {
            return view('search_results.chapters', ['chapters' => $chapters]);
        }
        
    }

    public function reorder(Request $request)
    {
        //
        $attributes = $request->validate([
            'book_id' => 'required',
            'order'  => 'required',
            'search' => '',
        ]);

        $chapters = Chapter::whereHas('book', fn($query) => $query->where('books.id', $attributes['book_id']))->where('title', 'like', '%'. $attributes['search'] .'%')->orderBy('order', 'asc')->get();

        $count = 0;

        foreach($chapters as $chapter) {
            $order = $chapter->order;
            $new_order = $attributes['order'][$count];

            if($order == $new_order) continue;

            Chapter::where('order', $new_order)->update(['order' => $order]);
            $chapter->update(['order' => $new_order]);

            $count++;

            unset($attributes['order'][array_search($order)]);

        }
    }

    public function publish_all(Request $request) {

        $attributes = $request->validate([
            'book_id' => 'required'
        ]);

        $chapters = Chapter::whereHas('book', fn($query) => $query->where('books.id', $attributes['book_id']));

        foreach($chapters as $chapter) {
            if(sizeof($chapter->draft) >= 100) {
                $chapter->update(['status', 'published']);
            }
        }

        return response()->json(['status' => 'success']);

    }

    public function destroy(Request $request)
    {
        //
        $attributes = $request->validate([
            'chapter_id' => 'required',
            'book_id' => 'required',
        ]);

        $this->authenticate($attributes['book_id']);

        Chapter::where('id', $attributes['chapter_id'])->update(['state' => 'deleted']);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
