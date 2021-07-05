<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';

    protected $fillable = ['title','code'];

    public function users(){
        return $this->hasOne(User::class);
    }
}
