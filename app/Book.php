<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;  
      protected $fillable = [
        'user_id', 'title', 'author',
    ];
    
     protected $dates = ['deleted_at'];
     
}
