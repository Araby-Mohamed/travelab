<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Resources\ActivitiesResource;
use App\Http\Resources\PackagesResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Activities;
use App\Models\ImagesPackeges;
use App\Models\Links;
use App\Models\Packages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class ActivitiesController extends GeneralController
{
    use GeneralTrait;

    public function __construct(Packages $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request){
        // Validation
        $rules = [
            'title'          => 'required|string|min:3|max:191',
            'estimated_time' => 'required|integer|min:1|max:10',
            'cost'           => 'required|integer|between:1,100000000',
            'location'       => 'required|string|min:3|max:191',
            'address'        => 'required|string|min:3|max:191',
            'description'    => 'required|string|min:3',
            'package_id'     => 'required|integer',
            'image*'         => 'required|image|mimes:jpeg,jpg,png',
        ];
        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError('404',$validator);
        }

        $data = [
            'title'          => $request->input('title'),
            'estimated_time' => $request->input('estimated_time'),
            'cost'           => $request->input('cost'),
            'location'       => $request->input('location'),
            'address'        => $request->input('address'),
            'description'    => $request->input('description'),
        ];

        // Check Store Activity In  My Package Store
        $package = Packages::whereUserId(Auth::user()->id)->where('id',$request->input('package_id'))->get();
        if(count($package)){
            $data['package_id'] = $request->input('package_id');
        }else{
            return $this->returnError(404,'An error occurred while determining the Package');
        }
        // Store Activity
        $acitvity = Activities::create($data);
        // Store Multi Image In Activity
        foreach($request->image as $val){
            $image = $this->uploadImage($val,'activities',null,500,500);
            ImagesPackeges::create([
                'image' => $image,
                'activity_id' => $acitvity->id,
            ]);
        }

        // Store Multi Links In Database
        if(isset($request->links)){
            foreach($request->links as $item){
                Links::create([
                    'title'         => $item['title'],
                    'link'          => $item['link'],
                    'activity_id'   => $acitvity->id
                ]);
            }
        }
        return $this->returnSuccess('Item added Successfully');
    }

    public function update(Request $request){
        // Activity
        $acitvity = Activities::find($request->activity_id);
        if(!$acitvity)
            return $this->returnError('404', 'Not Found');
        // Validation
        $rules = [
            'title'          => 'required|string|min:3|max:191',
            'estimated_time' => 'required|integer|min:1|max:10',
            'cost'           => 'required|integer|between:1,100000000',
            'location'       => 'required|string|min:3|max:191',
            'address'        => 'required|string|min:3|max:191',
            'description'    => 'required|string|min:3',
            'package_id'     => 'required|integer',
            'image*'         => 'nullable|image|mimes:jpeg,jpg,png',
        ];
        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }

        $data = [
            'title'          => $request->input('title'),
            'estimated_time' => $request->input('estimated_time'),
            'cost'           => $request->input('cost'),
            'location'       => $request->input('location'),
            'address'        => $request->input('address'),
            'description'    => $request->input('description'),
        ];

        // Check Store Activity In  My Package Store
        $package = Packages::whereUserId(Auth::user()->id)->where('id',$request->input('package_id'))->get();
        if(count($package)){
            $data['package_id'] = $request->input('package_id');
        }else{
            return $this->returnError(404,'An error occurred while determining the Package');
        }
        // Store Activity
        $acitvity->update($data);
        // Store Multi Image In Activity
        foreach($request->image as $val){
            $image = $this->uploadImage($val,'activities',null,500,500);
            ImagesPackeges::create([
                'image' => $image,
                'activity_id' => $request->activity_id,
            ]);
        }


        return $this->returnSuccess('Item Updated Successfully');
    }

    public function delete(Request $request){
        $data = Activities::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');
        $images = ImagesPackeges::where('activity_id',$data->id)->get();
        $this->deleteImage($images->pluck('image')->toArray());
        $data->delete();
        return $this->returnSuccess('Item Deleted Successfully');
    }

    public function deleteActivityImage(Request $request){
        $data = ImagesPackeges::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');
        $user_id = $data->activity->package->user->id;
        if($user_id == Auth::user()->id){
            $this->deleteImage($data->image);
            $data->delete();
            return $this->returnSuccess('Image Deleted Successfully');
        }else{
            return $this->returnError(404, 'You cannot delete this');
        }

    }

    public function show(Request $request){
        $data = Activities::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');

        return $this->returnData('activities',new ActivitiesResource($data));
    }
}
