<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'image',
        'description',
        'date',
        'status',
        'typeAccept',
        'location',
        'category_id',
        'user_id',
        'places',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }


    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
