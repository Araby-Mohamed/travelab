<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $table = 'activities';

    protected $fillable = ['title','estimated_time','cost','location','address','description','package_id'];

    public function package(){
        return $this->belongsTo(Packages::class,'package_id','id');
    }

    public function images(){
        return $this->hasMany(ImagesPackeges::class,'activity_id','id');
    }

    public function links(){
        return $this->hasMany(Links::class,'activity_id','id');
    }
}
