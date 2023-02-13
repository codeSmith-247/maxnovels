<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Carbon\Carbon;
 

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'role',
        'state',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function chapters() {
        return $this->hasManyThrough(Chapter::class, Bookmark::class, 'user_id', 'id', 'id', 'chapter_id');
        
    }

    public function views() {
        return $this->hasManyThrough(FingerprintToChapter::class, UserFingerprint::class, 'user_id', 'fingerprint_id');
    }

    public function books() {
        return $this->hasManyThrough(Book::class, UserToBook::class, 'user_id', 'id', 'id', 'book_id');
    }

    public function age() {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
}
