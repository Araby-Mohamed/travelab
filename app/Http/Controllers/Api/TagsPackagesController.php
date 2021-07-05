<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\TagsPackages;
use Illuminate\Http\Request;

class TagsPackagesController extends Controller
{
    use GeneralTrait;

    public function delete(Request $request){
        $data = TagsPackages::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');
        $data->delete();
        return $this->returnSuccess('Item Deleted Successfully');
    }
}
