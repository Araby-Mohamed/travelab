<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable = ['image','package_id'];

    public function package()
    {
        return $this->belongsTo(Packages::class,'package_id','id');
    }
}
