<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InterestResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $data = InterestResource::collection(Interest::all());
        return $this->returnData('interests',$data);
    }
}
