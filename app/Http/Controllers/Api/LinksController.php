<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Activities;
use App\Models\Links;
use App\Models\Packages;
use Validator;
use Illuminate\Http\Request;


class LinksController extends Controller
{
    use GeneralTrait;

    public function store(Request $request){
        // Validation
        $rules = [
            'title'         => 'required|string|min:3|max:191',
            'link'          => 'required|url|min:3|max:191',
            'activity_id'   => 'required|integer|exists:activities,id',
        ];

        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError('404',$validator);
        }

        // Store Data
        $data = [
            'title'         => $request->input('title'),
            'link'          => $request->input('link'),
            'activity_id'   => $request->input('activity_id'),
        ];

        // Check Store Links In  My Activities
        $activity = Activities::findOrFail($request->input('activity_id'));
        if($activity->package->user_id != auth()->user()->id){
            return $this->returnError(404,'An error occurred while determining the activity');
        }

        Links::create($data);
        return $this->returnSuccess('Item added Successfully');
    }

    public function update(Request $request){
        $link = Links::find($request->activity_id);
        if(!$link)
            return $this->returnError('404', 'Not Found');

        // Validation
        $rules = [
            'title'         => 'required|string|min:3|max:191',
            'link'          => 'required|url|min:3|max:191',
            'activity_id'   => 'required|integer|exists:activities,id',
        ];

        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError('404',$validator);
        }

        // Store Data
        $data = [
            'title'         => $request->input('title'),
            'link'          => $request->input('link'),
            'activity_id'   => $request->input('activity_id'),
        ];

        // Check Update Links In  My Activities
        $activity = Activities::findOrFail($request->input('activity_id'));
        if($activity->package->user_id != auth()->user()->id){
            return $this->returnError(404,'An error occurred while determining the activity');
        }

        // Update
        $link->update($data);
        return $this->returnSuccess('Item Update Successfully');
    }

    public function delete(Request $request){
        $data = Links::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');
        // Check Delete Links In  My Activities
        $activity = Activities::Find($data->activity_id);
        if($activity->package->user_id != auth()->user()->id){
            return $this->returnError(404,'An error occurred while determining the activity');
        }
        $data->delete();
        return $this->returnSuccess('Item Deleted Successfully');
    }
}
