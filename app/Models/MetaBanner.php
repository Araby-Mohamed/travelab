<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaBanner extends Model
{

    protected $table = 'meta_banners';

    protected $fillable = ['page', 'image', 'title', 'keywords', 'description'];

    protected $hidden = ['created_at', 'updated_at'];
}
