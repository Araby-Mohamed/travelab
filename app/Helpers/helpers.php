<?php

use App\Models\Ratings;
use Illuminate\Support\Str;

if(!function_exists('pathFile')) {
    function pathFile($file, bool $thumbnail = false)
    {
        $file = ($thumbnail === true) ? 'images/thumbnail' . substr($file, strpos($file, '/', 6)) : $file;
        return asset($file);
    }
}

if(!function_exists('iconsList')) {
    function iconsList()
    {
        // Get Data From File
        $file = file(asset('flaticons/include-flaticons.css'));
        // Remove Empty Items
        $filter = array_filter($file, function ($var) {
            return ($var != "\n");
        });

        // Sort Ascending Array
        sort($filter);
        return $filter;
    }
}

if(!function_exists('slug')) {
    function slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهيیةى]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }
}

if(!function_exists('str_limit')) {
    function str_limit($string, $length = 100, $end = '...')
    {
        return Str::limit($string, $length, $end);
    }
}

if(!function_exists('data_lang')) {
    function data_lang($en_data, $ar_data)
    {
        return app()->getLocale() == 'en' ? $en_data : $ar_data;
    }
}

if(!function_exists('daysLeft')) {
    function daysLeft($days)
    {
        if($days >= 10)
            $notify = 'success';
        elseif ($days > 0)
            $notify = 'warning';
        else
            $notify = 'danger';
        return $notify;
    }
}

if(!function_exists('rating')){
    function rating($id){
        // Get Sum Rate
        $sumRate = Ratings::wherePackageId($id)->whereStatus(1)->sum('rate');
        // Get Count Rate
        $count = Ratings::wherePackageId($id)->whereStatus(1)->count();
        // Rating
        $rating = ($count && $sumRate != 0) ? round($sumRate / $count) : 0;

        return $rating;
    }
}
