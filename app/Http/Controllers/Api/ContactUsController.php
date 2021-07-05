<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Messages;
use Validator;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use GeneralTrait;
    public function __invoke(Request $request)
    {
        // Validation
        $rules = [
            'username'      => 'required|string|min:3|max:191',
            'email'         => 'required|string|email',
            'subject'       => 'required|string|min:3|max:191',
            'message'       => 'required|string|min:6',
        ];

        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }
        // Data
        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'subject'  => $request->subject,
            'message'  => $request->message,
        ];

        Messages::create($data);
        return $this->returnSuccess('Your message was sent successfully');

    }
}
