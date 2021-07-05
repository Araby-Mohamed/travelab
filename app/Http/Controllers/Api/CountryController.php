<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $data = CountryResource::collection(Country::all());
        return $this->returnData('countries',$data);
    }
}
