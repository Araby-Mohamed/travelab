<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingsResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Packages;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RatingsController extends Controller
{
    use GeneralTrait;

    public function store(Request $request){
        // Validation
        $rules = [
            'comment'       => 'required|string',
            'rate'          => 'required|integer|min:1|max:5',
            'package_id'    => 'required|integer|exists:packages,id',
        ];
        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }

        // Store Data
        $data = [
            'comment'       => $request->input('comment'),
            'rate'          => $request->input('rate'),
            'package_id'    => $request->input('package_id')
        ];

        $data['user_id'] = auth()->user()->id;

        Ratings::create($data);
        return $this->returnSuccess('Item Added Successfully Awaiting Approval');
    }

    public function show(Request $request){
        $data = RatingsResource::collection(Ratings::wherePackageId($request->package_id)->whereStatus(1)->get());
        return $this->returnData('Ratings',$data);
    }
}
