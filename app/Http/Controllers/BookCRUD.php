<?php

namespace App\Http\Controllers;

use App\Models\Book;

use App\Models\Tag;
use App\Models\TagToBook;

use App\Models\Character;
use App\Models\CharacterToBook;

use App\Models\Audience;
use App\Models\AudienceToBook;

use App\Models\Rating;
use App\Models\RatingToBook;

use App\Models\Category;
use App\Models\CategoryToBook;

use App\Models\Language;
use App\Models\LanguageToBook;

use App\Models\User;
use App\Models\UserToBook;


use App\Models\Author;
use App\Models\AuthorToBook;

use Illuminate\Http\Request;

class BookCRUD extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function published_books()
    {
        $books = Book::whereHas('chapters', fn($query) => $query->where('state', 'published')->orderBy('chapters.updated_at', 'desc'))->where('state', '!=', 'deleted')->withCount(['chapters as latest_chapter' => fn($query) => $query->where('state', 'published')]);
        return $books;
    }

    public function all_books()
    {
        $books = Book::whereHas('chapters', fn($query) => $query->orderBy('created_at', 'desc'))->where('state', '!=', 'deleted');
        return $books;
    }

    public function most_read_books() 
    {
        $books = BookCRUD::published_books()->withSum('chapters as views', 'views')->orderBy('views', 'desc');
        return $books;
    }

    public function books(Category $category) {

        $books = $this->published_books();

        if($category->name != null)

        $books = $books->whereHas('categories', fn($query) => $query->where('name', $category->name));

        $books = $books->paginate(12);

        $categories = Category::where('state', '!=', 'deleted')->get();

        return view('books', [
            'books' => $books,
            'categories' => $categories,
            'my_category' =>$category
        ]);
    }

    public function yourbooks() {
        $books = Book::whereHas('user', fn($query) => $query->where('users.id', auth()->user()->id))->withCount(['chapters as latest_chapter' => fn($query) => $query->where('state', '!=', 'deleted')])->where('state', '!=', 'deleted')->paginate(12);

        if($books[0] == null) {
            return redirect('/details');
        }
        
        // dd($books);

        return view('user.yourbooks', [
            'books' => $books
        ]);
    }

    public function create()
    {
        //validate all incoming post parameters
        $attributes = request()->validate([
            'title'       => 'required|min:3|unique:books,title',
            'description' => 'required|min:40',
            'category'    => 'required|exists:categories,id',
            'audience'    => 'required|exists:audiences,id',
            'language'    => 'required|exists:languages,id',
            'rating'      => 'required|exists:ratings,id',
            'cover-image' => 'required|image|max:2500|min:0.5',
            'tags'        => 'required',
            'characters'  => '',
            'authors'     => '',
        ]);

        //handle the cover image
        $image      = request()->file('cover-image');
        $image_name = date('YmdHi') . '_' . $image->getClientOriginalName();

        if($image->move(public_path('images/cover_images'), $image_name)) {

            //these properties have values separated by comma, convert them to an array
            $tags        = explode(',', $attributes['tags']);
            $characters  = explode(',', $attributes['characters']);
            $authors     = explode(',', $attributes['authors']);
            $category    = explode(',', $attributes['authors']);


            $book = Book::create([
                'title'       => str_replace( array( '\'', '"', ',' , ';', '<', '>', '?' ), '', $attributes['title']),
                'cover_image' => $image_name,
                'description' => $attributes['description'],
            ]);

            UserToBook::create([
                'book_id' => $book->id,
                'user_id' => Auth()->user()->id
            ]);

            //handle the exploded values :-)
            $this->handle_exploded($tags,       new Tag(),       new TagToBook(),       'tag_id',       $book->id);
            $this->handle_exploded($characters, new Character(), new CharacterToBook(), 'character_id', $book->id);
            $this->handle_exploded($authors,    new Author(),    new AuthorToBook(),    'author_id',    $book->id);

            //hanlde the selected values 
            $this->handle_fixed($attributes['category'], new CategoryToBook(), 'category_id', $book->id);
            $this->handle_fixed($attributes['audience'], new AudienceToBook(), 'audience_id', $book->id);
            $this->handle_fixed($attributes['language'], new LanguageToBook(), 'language_id', $book->id);
            $this->handle_fixed($attributes['rating'],   new RatingToBook(),   'rating_id',   $book->id);

        }

        return redirect('/writer/create/new/'.$book->id);

    }

    public function handle_exploded($array, $model, $linker_model, $linker_word, $book_id) {

        //this function loops over the exploded values
        //checks if each value already exists
        //inserts the value into the database if it doesnt
        //links them in the database if link does not exists;

        $linker_model->where('book_id', $book_id)->delete();

        foreach($array as $value) {

            if($value == "") continue;

            $value = trim(strtolower($value));

            $check = $model->where('name', $value)->first();

            if($check == null) {
                $check = $model::create([
                    'name' => $value
                ]);
            }

            $linker_model::create([
                "$linker_word" => $check->id,
                "book_id"      => $book_id,
            ]);

            // $linker = $linker_model->where($linker_word, $check->id)
            //                        ->where('book_id', $parent_id)->first();

            // if($linker = null) {

            // }
        
            
        }
    }

    public function handle_fixed($value, $linker_model, $linker_word, $book_id) {

        if($value == "" || $value == null) return false;

        $value = (int) $value;

        $linker_model->where('book_id', $book_id)->delete();

        $linker_model::create([
            "$linker_word" => $value,
            "book_id"      => $book_id,
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


        if ($filter == 'tag')
        $books = BookCRUD::published_books()->whereHas('tags', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'language')
        $books = BookCRUD::published_books()->whereHas('language', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'author') {
            $books = BookCRUD::published_books()->whereHas('authors', fn($query) => $query->where('name', 'like', "%$search%"))
                                                ->orWhereHas('user', fn($query) => $query->where('name', 'like', "%$search%"));

        }

        else if ($filter == 'character')
        $books = BookCRUD::published_books()->whereHas('characters', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'category')
        $books = BookCRUD::published_books()->whereHas('categories', fn($query) => $query->where('name', 'like', "%$search%"));

        else
        $books = BookCRUD::published_books()->where('title', 'like', "%$search%");

        return $books;
    }

    public function books_search(Request $request) {

        $books = BookCRUD::search($request);

        $books = $books->whereHas('categories', fn($query) => $query->where('name', $request->category ?? ''));

        $books = $books->paginate(12)->appends(['search' => $request->search . "  " , 'filter' => $request->filter . "  ", 'category' => $request->category]);

        $categories = Category::where('state', '!=', 'deleted')->get();

        if(!$request->ajax())
        return view('books', [
            'books' => $books,
            'categories' => $categories,
            'my_category' => $request->category ?? '',
        ]);

        else return view('search_results.books', [
            'books' => $books,
        ]);
    }

    public function yourbooks_search(Request $request) {
        $attributes = $request->validate([
            'search'   => '',
            'filter'   => '',
        ]);

        $filter = $attributes['filter'];
        $search = $attributes['search'];


        if ($filter == 'tag')
        $books = Book::where('state', '!=', 'deleted')->whereHas('tags', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'language')
        $books = Book::where('state', '!=', 'deleted')->whereHas('language', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'author') {
            $books = Book::where('state', '!=', 'deleted')->whereHas('authors', fn($query) => $query->where('name', 'like', "%$search%"))
                                                ->orWhereHas('user', fn($query) => $query->where('name', 'like', "%$search%"));
        }

        else if ($filter == 'character')
        $books = Book::where('state', '!=', 'deleted')->whereHas('characters', fn($query) => $query->where('name', 'like', "%$search%"));

        else if ($filter == 'category')
        $books = Book::where('state', '!=', 'deleted')->whereHas('categories', fn($query) => $query->where('name', 'like', "%$search%"));

        else
        $books = Book::where('state', '!=', 'deleted')->where('title', 'like', "%$search%");


        $books = $books->whereHas('user', fn($query) => $query->where('users.id', auth()->user()->id))->withCount('chapters as latest_chapter')->paginate(12)->appends(['search' => $request->search . "  " , 'filter' => $request->filter . "  "]);


        if(!$request->ajax())
        return view('user.yourbooks', [
            'books' => $books,
        ]);

        else return view('search_results.yourbooks', [
            'books' => $books,
        ]);
    }

    public function home_search(Request $request) {
        $result = BookCRUD::search($request)->limit(5)->get();

        return view('search_results.home', [
            'books' => $result,
        ]);
    }

    public function admin_search(Request $request) {
        $result = BookCRUD::search($request)->paginate(1)->appends(['search' => $request->search . "  " , 'filter' => $request->filter]);

        if(request()->ajax())
        return view('search_results.admin_books', [
            'books' => $result,
        ]);

        return view('admin.books', [
            'books' => $result,
        ]);
    }

    public function preview(Book $book)
    {
        //

        return view('preview', [
            'book' => $book,
            'books' => Book::whereHas('categories', fn($query) => $query->where('name', $book->categories[0]->name)->where('state', 'published')->where('books.id', '!=', $book->id))->where('state', '!=', 'deleted')->limit(12)->get(),
        ]);
    }

    public function admin_books() {

        $books = Book::with('authors')->withSum('chapters as views', 'views')->orderBy('created_at', 'desc')->where('state', '!=', 'deleted')->paginate(12);

        return view('admin.books', [
            'books' => $books
        ]);
    }

    public function edit()
    {

                //validate all incoming post parameters
                $attributes = request()->validate([
                    'title'       => 'required|min:3',
                    'description' => 'required|min:40',
                    'category'    => 'required|exists:categories,id',
                    'audience'    => 'required|exists:audiences,id',
                    'language'    => 'required|exists:languages,id',
                    'rating'      => 'required|exists:ratings,id',
                    'cover-image' => 'image|max:2500|min:0.5',
                    'tags'        => 'required',
                    'characters'  => '',
                    'authors'     => '',

                    'book_id'     => 'required|integer'
                ]);

                $book = Book::where('id', $attributes['book_id'])->first();

                if(auth()->user()->role != 'admin' && auth()->user()->role != 'super user' && $book->user[0]->id != auth()->user()->id) return redirect('/books');

                $new_title = Book::where('title', $attributes['title'])->first();

                if($new_title != null && $new_title->title != $book->title) 
                return back()->withError([
                    'title' => 'A book with this title already exists'
                ]);
        
                //handle the cover image
                $image = request()->file('cover-image');

                if($image != null) {

                    $image_name = date('YmdHi') . '_' . $image->getClientOriginalName();
            
                    if($image->move(public_path('images/cover_images'), $image_name)) {
                        $book->update([
                            'cover_image' => $image_name
                        ]);
                    }

                }


                //these properties have values separated by comma, convert them to an array
                $tags        = explode(',', $attributes['tags']);
                $characters  = explode(',', $attributes['characters']);
                $authors     = explode(',', $attributes['authors']);
                $category    = explode(',', $attributes['authors']);

                // dd($attributes);
    
                $book = Book::where('id', $attributes['book_id'])->first();
                
                $book->update([
                    'title'       => str_replace( array( '\'', '"', ',' , ';', '<', '>', '?' ), ' ', $attributes['title']),
                    'description' => $attributes['description']
                ]);
    
                //handle the exploded values :-)
                $this->handle_exploded($tags,       new Tag(),       new TagToBook(),       'tag_id',       $book->id);
                $this->handle_exploded($characters, new Character(), new CharacterToBook(), 'character_id', $book->id);
                $this->handle_exploded($authors,    new Author(),    new AuthorToBook(),    'author_id',    $book->id);
    
                //hanlde the selected values 
                $this->handle_fixed($attributes['category'], new CategoryToBook(), 'category_id', $book->id);
                $this->handle_fixed($attributes['audience'], new AudienceToBook(), 'audience_id', $book->id);
                $this->handle_fixed($attributes['language'], new LanguageToBook(), 'language_id', $book->id);
                $this->handle_fixed($attributes['rating'],   new RatingToBook(),   'rating_id',   $book->id);
        
                session(['edit_book' => true]);
                return redirect('/details/'. (string)urldecode($book->title));
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy()
    {
        $attributes = request()->validate([
            'book' => 'required'
        ]);

        $book = Book::where('title', $attributes['book'])->first();

        if(auth()->user()->role != 'admin' && auth()->user()->role != 'super user' && $book->user[0]->id != auth()->user()->id) return response()->json(['status' => 'fail']);
        
        $book->update([
            'state' => 'deleted'
        ]);

        return response()->json(['status' => 'success']);
    }
}
