<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';

    protected $fillable = ['title','link','activity_id'];

    public function activities(){
        return $this->belongsTo(Activities::class,'activity_id','id');
    }
}
