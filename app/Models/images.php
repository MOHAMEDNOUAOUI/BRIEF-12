<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;

    protected $fillable  =[
        'image',
        'id_post'
    ];


    public function post()
    {
        return $this->belongsTo(Posts::class, 'id_post');
    }
}
