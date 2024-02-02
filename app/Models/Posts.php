<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable  =[
        'title',
        'content',
        'id_destination'
    ];

    public function destination()
    {
        return $this->belongsTo(destinations::class, 'id_destination');
    }

    public function images()
    {
        return $this->hasMany(images::class, 'id_post');
    }
}
