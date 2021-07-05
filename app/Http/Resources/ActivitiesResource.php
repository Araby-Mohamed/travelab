<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivitiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $favorites = Favorite::whereActivityId($this->id)->whereUserId(auth()->user()->id);
        if($favorites->exists()){
            $favoriteCheck = 1;
            $favorite_id = $favorites->first()->id;
        }else{
            $favoriteCheck = 0;
            $favorite_id = 0;
        }
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'estimated_time'    => $this->estimated_time,
            'cost'              => $this->cost . ' ' . $this->package->user->currency->code,
            'location'          => $this->location,
            'address'           => $this->address,
            'description'       => $this->description,
            'images'            => ImagesResource::collection($this->images),
            'links'             => LinksResource::collection($this->links),
            'favorites'         => $favoriteCheck,
            'favorite_id'       => $favorite_id,
            'user_id'           => $this->package->user->id,
        ];
    }
}
