<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesPackeges extends Model
{
    protected $table = 'images_packages';

    protected $fillable = ['image','activity_id'];

    public function activity()
    {
        return $this->belongsTo(Activities::class,'activity_id','id');
    }
}
