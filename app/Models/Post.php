<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // post's field that can be modified
    protected $fillable = [
        'title','thumbnail_url','tags','content'
    ];
}
