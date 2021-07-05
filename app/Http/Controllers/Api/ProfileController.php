<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProfileController extends GeneralController
{
    use GeneralTrait;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function index(){
        // Get User
        $user = new UserResource(Auth::user());
        // Return User Data
        return $this->returnData('user',$user);
    }

    public function update(Request $request){
        // Get User ID
        $user = Auth::user();
        // Validation
        $rules = [
            'username'      => 'required|string|min:3|max:191',
            'email'         => 'required|string|email|unique:users,email,'.$user->id,
            'phone'         => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,'.$user->id,
            'password'      => 'nullable|min:3|string',
            'date_of_birth' => 'required|min:3|max:20',
            'gender'        => 'required|min:1|max:1',
            'image'         => 'nullable|mimes:jpeg,jpg,png',
            'currency_id'   => 'required|integer|min:1|max:10',
        ];
        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError("404",$validator);
        }

        $data = [
            'username'      => $request->username,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'currency_id'   => $request->currency_id,
        ];

        if(!empty($request->password))
            $data['password'] = bcrypt($request->password);

        // If Request Has File
        if($request->hasFile('image')) {
            // Set Image in inputs data
            $data['image'] = $this->uploadImage($request->file('image'),'users',$user->image,300);
        }

        // Update Data
        $user->update($data);
        $userData = new ProfileResource($user);
        return $this->returnData('user',$userData,'200','Your personal data has been successfully modified');

    }
}
