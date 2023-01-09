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

    public function getFictionRadioData()
    {
        $radioData = collect();
        $itemYes = (object) [
            'checked' => (bool) $this->is_fiction,
            'value' => 1,
            'label' => 'Yes',
        ];
        $radioData->push($itemYes);

        $itemNo = (object) [
            'checked' => (bool) !$this->is_fiction,
            'value' => 0,
            'label' => 'No',
        ];
        $radioData->push($itemNo);

        return $radioData;
    }
}
