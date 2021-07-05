<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $credentials = $request->only('email','password');
        $token = Auth::guard('user-api')->attempt($credentials);
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender == 'M' ? 'Male' : 'Female',
            'image' => $this->image,
            'currency' => new CurrencyResource($this->currency),
            'token' => $token
        ];
    }
}
