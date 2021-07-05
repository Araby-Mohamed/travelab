<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaBannerTranslations extends Model
{
    protected $table = 'meta_banner_translations';

    protected $fillable = ['locale', 'meta_id', 'title', 'description', 'keywords'];

    public $timestamps = false;
}
