<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use GeneralTrait;

    public function index(Request $request){
        $data = Setting::get();
        return $this->returnData('data',$data);
    }
}
