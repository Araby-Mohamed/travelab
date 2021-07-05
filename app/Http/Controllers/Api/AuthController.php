<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Users\StoreUsers;
use App\Http\Resources\UserResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request){
        // Validation
        $rules = [
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|min:3|confirmed|string',
        ];
        // Check Validate
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
        $currency = Currency::first();
        // Get Request
        $data = [
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'username' => 'Travel App',
            'currency_id' => $currency->id,
        ];
        // Store In DataBase
        $user = new UserResource(User::create($data));
        return $this->returnData('user',$user,'200','Successfully Registered');
    }

    public function login(Request $request){
        // Validation
        $rules = [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:3',
        ];
        // Check Validate
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
        // Login
        $credentials = $request->only(['email','password']);
        // Get Token
        $token = Auth::guard('user-api')->attempt($credentials);
        // Check Token
        if(!$token)
            return $this->returnError('404','بيانات الدخول غير صحيحة');

        $user = new UserResource(Auth::guard('user-api')->user());
        $user->api_token = $token;
        // Return Token
        return $this->returnData('user',$user);
    }

    public function logout(Request $request){
         $token = $request->header('auth-token');
         if($token){
             try{
                 JWTAuth::setToken($token)->invalidate();
             }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return $this->returnError('404','Some Thing Went Wrongs');
             }

             return $this->returnSuccess('Logged Out Successfully');
         }else{
             $this->returnError('404','Some Thing Went Wrongs');
         }
    }

    public function forgotPassword(Request $request){
        // Validation
        $rules = [
            'email'     => 'required|email|exists:users,email',
        ];
        // Check Validate
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
        // Create Code
        $code = Str::random(6);
        // Insert In Password Resets Table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'code' => $code,
            'created_at' => Carbon::now()
        ]);
        // Send Email
        Mail::send('mail.verify',['code' => $code], function($message) use($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        // Return Success Message
        return $this->returnSuccess('We have email us the password reset code!');

    }

    public function updatePassword(Request $request)
    {
        // Validation
        $rules = [
            'email'                 => 'required|email|exists:users,email',
            'code'                  => 'required|min:1|max:10',
            'password'              => 'required|min:3|confirmed|string',
            'password_confirmation' => 'required',
        ];
        // Check Validate
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
        // Get Email
        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'code' => $request->code])
            ->first();
        // Check Token
        if(!$updatePassword)
            return $this->returnError('404','Invalid code!');
        // Update Password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        // Delete Token
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        // Return Success Message
        return $this->returnSuccess('The password has been changed successfully. Please go to the login page');
    }
}
