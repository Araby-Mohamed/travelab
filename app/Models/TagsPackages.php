<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsPackages extends Model
{
    protected $table = 'tags_packages';

    protected $fillable = ['interest_id','package_id'];

    public function packages(){
        return $this->belongsTo(Packages::class,'package_id','id');
    }

    public function interest(){
        return $this->belongsTo(Interest::class,'interest_id','id');
    }
}
