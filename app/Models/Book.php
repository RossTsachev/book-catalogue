<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover',
        'published_at',
        'is_signed_by_author',
        'is_fiction',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
