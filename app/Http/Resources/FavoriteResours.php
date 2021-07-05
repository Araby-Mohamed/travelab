<?php

namespace App\Http\Resources;

use App\Models\Packages;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResours extends JsonResource
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
            'package' => PackagesResource::collection(Packages::whereId($this->package_id)->get()),
        ];
    }
}
