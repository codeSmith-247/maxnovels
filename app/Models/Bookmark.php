<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function chapter() {
        return $this->hasOne(Chapter::class, 'id', 'chapter_id');
    }
    
    public function book() {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }
    
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
}
