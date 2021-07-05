<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    protected $fillable = ['username','email','subject','message','read_at'];
}
