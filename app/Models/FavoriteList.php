<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteList extends Model
{
    protected $table = 'favorite_list';

    protected $fillable = ['title','user_id','type'];

    public function favoriteCount(){
        return $this->hasMany(Favorite::class,'favorite_list_id','id');
    }
}
