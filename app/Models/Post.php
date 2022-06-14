<?php

namespace App\Models;

use App\Models\Fav;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'tytul',
        'cena',
        'kategoria',
        'lokalizacja',
        'opis',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function fav(){
        return $this->belongsToMany(Fav::class);
    }

    public function favedBy(User $user){
        return $this->fav->contains('user_id', $user->id);
    }
}

