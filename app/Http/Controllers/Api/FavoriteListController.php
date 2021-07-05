<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteListResources;
use App\Http\Traits\GeneralTrait;
use App\Models\FavoriteList;
use Illuminate\Http\Request;
use Validator;

class FavoriteListController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        $model = FavoriteList::whereUserId(auth()->user()->id);
        $request->type == 'activity' ? $model->whereType('activity') : $model->whereType('package');
        $data = FavoriteListResources::collection($model->withCount('favoriteCount')->latest()->paginate(24));
        // Pagination Data
        $pagination = [
            'count' => $data->count(),
            'currentPage' => $data->currentPage(),
            'hasMorePages' => $data->hasMorePages(),
            'lastPage' => $data->lastPage(),
            'nextPageUrl' => $data->nextPageUrl(),
            'previousPageUrl' => $data->previousPageUrl(),
            'perPage' => $data->perPage()
        ];
        return $this->returnData('favorite_list',['data' => $data,'pagination' => $pagination]);
    }
    public function store(Request $request){
        // Validation Rules
        $rules = [
            'title' => 'required|max:191',
        ];
        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }

        $data = [
            'title'     => $request->input('title'),
            'user_id'   => auth()->user()->id,
        ];

        if($request->type == 'activity'){
            $data['type'] = 'activity';
        }
        // Store In Table
        FavoriteList::create($data);
        return $this->returnSuccess('Item Added Successfully');
    }

    public function delete(Request $request){
        $data = FavoriteList::whereUserId(auth()->user()->id)->where('id',$request->favorite_list_id)->first();
        if(!$data)
            return $this->returnError(404,'Not Found');

        $data->delete();
        return $this->returnSuccess('Item Deleted Successfully');
    }
}
