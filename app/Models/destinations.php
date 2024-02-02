<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destinations extends Model
{
    use HasFactory;


    public function posts()
    {
        return $this->hasOne(Posts::class, 'id_destination');
    }
}
