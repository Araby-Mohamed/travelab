<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteActivityResources;
use App\Http\Resources\FavoriteResours;
use App\Http\Traits\GeneralTrait;
use App\Models\Favorite;
use App\Models\FavoriteList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class FavoriteController extends Controller
{
    use GeneralTrait;

    public function index(Request $request){
        $model = Favorite::whereUserId(auth()->user()->id);
        // Check Activity Or Package
        ($request->type == 'activity') ? $model->whereNotNull('activity_id') : $model->whereNotNull('package_id');
        $item = $model->whereFavoriteListId($request->input('favorite_list_id'))->latest()->paginate(24);
        $data = ($request->type == 'activity') ? FavoriteActivityResources::collection($item) : FavoriteResours::collection($item);
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
        return $this->returnData('favorite',['data' => $data,'pagination' => $pagination]);
    }

    public function store(Request $request){
        // Validation Rules
        if($request->type == 'activity'){
            $rules = [
                'favorite_list_id'   => [
                    'required',
                    'integer',
                    'exists:favorite_list,id',
                    Rule::exists('favorite_list','id')->where(function($q) {
                        $q->where('user_id',auth()->user()->id);
                    })
                ],
                'activity_id'         => [
                    'required',
                    'integer',
                    'exists:activities,id',
                    Rule::unique('favorite')
                        ->where('activity_id', $request->input('activity_id'))
                        ->where('user_id', auth()->user()->id)
                ],
            ];
        }else{
            $rules = [
                'favorite_list_id'   => [
                    'required',
                    'integer',
                    'exists:favorite_list,id',
                    Rule::exists('favorite_list','id')->where(function($q) {
                        $q->where('user_id',auth()->user()->id);
                    })
                ],
                'package_id'         => [
                    'required',
                    'integer',
                    'exists:packages,id',
                    Rule::unique('favorite')
                        ->where('package_id', $request->input('package_id'))
                        ->where('user_id', auth()->user()->id)
                ],
            ];
        }

        // Check Validation
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }

        // Store In Table
        $data = [
            'user_id'           => auth()->user()->id,
            'favorite_list_id'  => $request->input('favorite_list_id')
        ];
        if($request->type == 'activity'){
            if(FavoriteList::whereId($request->input('favorite_list_id'))->whereType('activity')->exists()){
                $data['favorite_list_id'] = $request->input('favorite_list_id');
            }else{
                return $this->returnError(404,'This list cannot be selected as it is dependent packages');
            }
        }else{
            if(FavoriteList::whereId($request->input('favorite_list_id'))->whereType('package')->exists()){
                $data['favorite_list_id'] = $request->input('favorite_list_id');
            }else{
                return $this->returnError(404,'This list cannot be selected as it is dependent the activities');
            }
        }
        $request->type == 'activity' ? $data['activity_id'] = $request->input('activity_id') : $data['package_id'] = $request->input('package_id');

        Favorite::create($data);
        return $this->returnSuccess('Item Added Successfully');
    }

    public function delete(Request $request){
        $data = Favorite::whereUserId(auth()->user()->id)->where('id',$request->favorite_id)->first();
        if(!$data)
            return $this->returnError(404,'Not Found');

        $data->delete();
        return $this->returnSuccess('Item Deleted Successfully');
    }


}
