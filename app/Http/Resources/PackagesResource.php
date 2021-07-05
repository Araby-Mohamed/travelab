<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $favorites = Favorite::wherePackageId($this->id)->whereUserId(auth()->user()->id);
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
            'description'       => $this->description,
            'estimated_time'    => $this->estimated_time,
            'cost'              => $this->cost . ' ' . $this->user->currency->code,
            'country_id'        => $this->country_id,
            'country'           => $this->country->title,
            'governorate_id'    => $this->governorate_id,
            'governorate'       => $this->governorate->title,
            'user_id'           => $this->user_id,
            'images'            => ImagesResource::collection($this->images),
            'interests'         => TagsPackagesResource::collection($this->tags),
            'activities'        => ActivitiesResource::collection($this->activity),
            'average_ratings'   => rating($this->id),
            'date'              => $this->created_at->diffForHumans(),
            'favorites'         => $favoriteCheck,
            'favorite_id'       => $favorite_id
        ];
    }
}
