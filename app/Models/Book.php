<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chapters() {
        return $this->belongsToMany(Chapter::class, 'chapter_to_books', 'book_id', 'chapter_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_to_books', 'book_id', 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_to_books', 'book_id', 'tag_id');
    }

    public function language() {
        return $this->belongsToMany(Language::class, 'language_to_books', 'book_id', 'language_id');
    }

    public function authors() {
        return $this->belongsToMany(Author::class, 'author_to_books', 'book_id', 'author_id');
    }

    public function audience() {
        return $this->belongsToMany(Audience::class, 'audience_to_books', 'book_id', 'audience_id');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_to_books', 'book_id', 'character_id');
    }

    public function rating() {
        return $this->belongsToMany(Rating::class, 'rating_to_books', 'book_id', 'rating_id');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'user_to_books', 'book_id', 'user_id');
    }
}
