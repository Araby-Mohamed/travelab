<?php

namespace App\Http\Resources;

use App\Models\Activities;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteActivityResources extends JsonResource
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
            'id' => $this->id,
            'activity' => ActivitiesResource::collection(Activities::whereId($this->activity_id)->get()),
        ];
    }
}
