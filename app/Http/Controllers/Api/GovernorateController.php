<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernorateResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $data = GovernorateResource::collection(Governorate::whereCountryId($request->country_id)->get());
        return $this->returnData('governorate',$data);
    }
}
