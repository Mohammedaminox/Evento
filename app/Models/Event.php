<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'images',
        'description',
        'date',
        'status',
        'typeAccept',
        'location',
        'category_id',
        'places',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
