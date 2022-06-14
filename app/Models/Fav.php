<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fav extends Model
{

    protected $table = 'favs';


    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

}
