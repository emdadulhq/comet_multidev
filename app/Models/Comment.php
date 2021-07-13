<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * Get post
     */

    public function post(){
        return $this ->belongsTo('App\Models\Post');
    }

    /**
     * Get user info
     */
    public function user(){
        return $this -> belongsTo('App\Models\User');
    }
}
