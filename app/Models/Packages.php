<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    protected $fillable = ['title','description','estimated_time','cost','status','country_id','governorate_id','user_id'];

    protected $casts = [
        'interests' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }

    public function activity(){
        return $this->hasMany(Activities::class,'package_id','id');
    }

    public function ratings(){
        return $this->hasMany(Ratings::class,'package_id','id');
    }

    public function images(){
        return $this->hasMany(Images::class,'package_id','id');
    }

    public function tags(){
        return $this->hasMany(TagsPackages::class,'package_id','id');
    }
}
