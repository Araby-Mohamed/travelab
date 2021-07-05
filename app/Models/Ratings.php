<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    Protected $table = 'ratings';

    protected $fillable = ['name','comment','rate','status','package_id','user_id'];

    public function package(){
        return $this->belongsTo(Packages::class,'package_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
