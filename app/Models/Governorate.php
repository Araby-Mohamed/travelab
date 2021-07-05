<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorate';

    protected $fillable = ['title','country_id'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
