<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->users->username,
            'comment'   => $this->comment,
            'rate'      => $this->rate,
            'image'     => $this->users->image,
            'date'      => $this->created_at->diffForHumans(),
        ];
    }
}
