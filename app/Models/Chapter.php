<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function book() {
        return $this->belongsToMany(Book::class, 'chapter_to_books', 'chapter_id', 'book_id');
        
    }
}
