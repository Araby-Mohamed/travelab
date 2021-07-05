<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';

    protected $fillable = ['key', 'val', 'is_translatable'];

    protected $hidden = ['created_at', 'updated_at'];


    public static function setMany($data)
    {
        foreach ($data as $key => $value) {
            Self::set($key, $value);
        }
    }


    public static function set($key, $value)
    {
        if($key === 'translatable') {
            return Self::setTranslatableSettings($value);
        }

        if(is_array($value)) {
            $value = json_encode($value);
        }
        Self::updateOrCreate(['key' => $key], ['val' => $value]);
    }


    public static function setTranslatableSettings($data)
    {
        foreach ($data as $key => $value)
        {
            $assign = [];
            if(is_array($value)) {
                foreach ($value as $k => $get) {
                    $assign[$k] = $get;
                }
            }
            Self::updateOrCreate(['key' => $key], ['is_translatable' => true])->update($assign);
        }
    }

}
