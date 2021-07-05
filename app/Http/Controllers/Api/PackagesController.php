<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\GeneralController;
use App\Http\Resources\PackagesResource;
use App\Http\Resources\TagsPackagesResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Activities;
use App\Models\Images;
use App\Models\ImagesPackeges;
use App\Models\Interest;
use App\Models\Links;
use App\Models\Packages;
use App\Models\TagsPackages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;

class PackagesController extends GeneralController
{
    use GeneralTrait;

    public function __construct(Packages $model)
    {
        parent::__construct($model);
    }

    public function interest(Request $request){
        $countTags = TagsPackages::count() >= 10 ? 10 : TagsPackages::count();
        $data = TagsPackagesResource::collection(TagsPackages::all()->random($countTags));
        return $this->returnData('data',$data->unique('title'));
    }
    public function search(Request $request){
        $data = PackagesResource::collection(Packages::whereStatus(1)->when($request->title, function($q) use($request){
            //$q->where('address', 'LIKE', '%' . $request->title . '%');
            $q->whereCountryId($request->country_id);
        })->latest()->paginate($this->paginate));

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
        return $this->returnData('packages',['data' => $data,'pagination' => $pagination]);
    }

    public function searchFilter(Request $request){
        $data = PackagesResource::collection(Packages::whereStatus(1)->where(function($q) use ($request) {
            if($request->has('from_cost') || $request->has('to_cost')){
                $q->whereBetween('cost',[(int)$request->from_cost,(int)$request->to_cost]);
            }
            if($request->has('duration')){
                $q->whereEstimatedTime($request->duration);
            }

            $q->whereHas('tags', function($query) {
                $query->where('title', 'LIKE', '%'. request()->interests. '%');
            });
        })->paginate($this->paginate));

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
        return $this->returnData('packages',['data' => $data,'pagination' => $pagination]);
    }

    public function index() {
        $data = PackagesResource::collection(Packages::whereStatus(1)->paginate($this->paginate));
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
        return $this->returnData('packages',['data' => $data,'pagination' => $pagination]);
    }

    public function show(Request $request){
        $data = Packages::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Item Not Found');

        return $this->returnData('package',new PackagesResource($data));
    }

    public function my_packages(Request $request){
        if($request->type == 'approve'){
            $data = PackagesResource::collection(Packages::whereStatus(1)->whereUserId(Auth::user()->id)->paginate($this->paginate));
        }elseif ($request->type == 'not_approve'){
            $data = PackagesResource::collection(Packages::whereStatus(0)->whereUserId(Auth::user()->id)->paginate($this->paginate));
        }else{
            $data = PackagesResource::collection(Packages::whereUserId(Auth::user()->id)->paginate($this->paginate));
        }

        $package =  Packages::all();
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
        return $this->returnData('packages',['data' => $data,'pagination' => $pagination]);

    }

    public function store(Request $request){
        //return $request->all();\
        // Validation Rules
        $rules = [
            'title'                     => 'required|string|min:3|max:191',
            'estimated_time'            => 'required|integer|min:1|max:10',
            'cost'                      => 'required|integer|between:1,100000000',
            'interests*'                => 'required|max:191',
            'country_id'                => 'required|integer|exists:country,id',
            'governorate_id'            => 'required|integer|exists:governorate,id',
            'image*'                    => 'required|image|mimes:jpeg,jpg,png',
            Rule::exists('governorate')->where(function ($query) {
                return $query->where('country_id', request()->country_id);
            }),
            '*title_activity'            =>  'required|string|min:3|max:191',
            '*estimated_time_activity'   =>  'required|integer|min:1|max:10',
            '*cost_activity'             =>  'required|integer|between:1,100000000',
            '*location'                  => 'required|min:3|max:191',
            '*address'                   => 'required|min:3|max:191',
            '*description'               => 'required|min:2',
        ];

        // Check Validation
        $validator = Validator::make($request->all(),$rules,[
            'title_activity'            => 'Title Activity',
            'estimated_time_activity'   => 'Estimated Time Activity',
            'cost_activity'             => 'Cost Activity',
            'location'                  => 'Location Activity',
            'address'                   => 'Address Activity',
            'description'               => 'Description Activity',
            'links'                     => 'Link And Title Activity'
        ]);
        if($validator->fails()){
            return $this->returnValidationError(404,$validator);
        }
        // Insert Data
        $data = [
            'title'          => $request->input('title'),
            'address'        => $request->input('address'),
            'estimated_time' => $request->input('estimated_time'),
            'cost'           => $request->input('cost'),
            'country_id'     => $request->input('country_id'),
            'governorate_id' => $request->input('governorate_id'),
            'user_id'        => Auth::user()->id,
        ];

        DB::beginTransaction();
        // Check Count Image
        if(!empty($request->image) && count($request->image) == 4){
            $packages = Packages::create($data);

            // Store Multi Interests In Database
            if(isset($request->interests)){
                foreach($request->interests as $item){
                    $tags = Interest::find($item['tag_id']);
                    if(!empty($tags)){
                        if(TagsPackages::whereInterestId($item['tag_id'])->wherePackageId($packages->id)->exists()){
                            return $this->returnError('404','You have entered this interest before');
                        }else{
                            TagsPackages::create([
                                'interest_id'   => $item['tag_id'],
                                'package_id'    => $packages->id
                            ]);
                        }
                    }else{
                        return $this->returnError('404','This interest does not exist');
                    }
                }
            }

            // Store Multi Image In Packages
            foreach($request->image as $val){
                $image = $this->uploadImage($val,'packages',null,500,500);
                Images::create([
                    'image' => $image,
                    'package_id' => $packages->id,
                ]);
            }

            if(isset($request->activities)){
                foreach($request->activities as $item){

                    $data = [
                        'title'          => $item['title_activity'],
                        'estimated_time' => $item['estimated_time_activity'],
                        'cost'           => $item['cost_activity'],
                        'location'       => $item['location'],
                        'address'        => $item['address'],
                        'description'    => $item['description'],
                        'package_id'     => $packages->id
                    ];
                    $acitvity = Activities::create($data);
                    // Store Multi Image In Activity
                    foreach($item['image_activity'] as $val){
                        $image = $this->uploadImage($val,'activities',null,500,500);
                        ImagesPackeges::create([
                            'image' => $image,
                            'activity_id' => $acitvity->id,
                        ]);
                    }

                    // Store Multi Links In Database
                    if(isset($item['links'])){
                        foreach($item['links'] as $val){
                            Links::create([
                                'title'         => $val['title'],
                                'link'          => $val['link'],
                                'activity_id'   => $acitvity->id
                            ]);
                        }
                    }
                }
            }
            DB::commit();


            // Return Success Message
            return $this->returnSuccess('The item was added successfully');
        }else{
            return $this->returnError(404,'4 photos must be selected');
        }
    }

    public function update(Request $request){
        // Get Package By ID
        $package = Packages::whereUserId(Auth::user()->id)->whereId($request->package_id)->first();
        if($package){
            // Validation Rules
            $rules = [
                'title'          => 'required|string|min:3|max:191',
                'address'        => 'required|string|min:2|max:191',
                'estimated_time' => 'required|integer|min:1|max:10',
                'cost'           => 'required|integer|between:1,100000000',
                'location'       => 'required|string|min:3|max:191',
                'interests*'     => 'required|max:191',
                'image*'         => 'required|mimes:jpeg,jpg,png',
            ];
            // Check Validation
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $this->returnValidationError(404,$validator);
            }
            // Insert Data
            $data = [
                'title'          => $request->input('title'),
                'address'        => $request->input('address'),
                'estimated_time' => $request->input('estimated_time'),
                'cost'           => $request->input('cost'),
                'location'       => $request->input('location'),
                'status'         => 0
            ];


            // Get Count My Image
            $images = Images::wherePackageId($package->id)->count();
            if(!empty($request->image)){
                // Count Request Images + Count Image In Database
                $ImageCount = count($request->image) + $images;
                // Check Count Image
                if( $ImageCount == 4 ){
                    $package->update($data);
                    // Store Multi Image In Packages
                    foreach($request->image as $val){
                            $image = $this->uploadImage($val,'packages',null,500,500);
                        Images::create([
                            'image' => $image,
                            'package_id' => $package->id,
                        ]);
                    }
                    // Return Success Message
                    return $this->returnSuccess('The item was Update successfully');
                }else{
                    return $this->returnError(404,'There are actually 4 pictures. At least one image must be deleted to add a new one');
                }
            }else{
                $package->update($data);
                // Store Multi Interests In Database
                if(isset($request->interests)){
                    foreach($request->interests as $item){
                        TagsPackages::updateOrCreate([
                            'title'         => $item['title'],
                            'package_id'    => $package->id
                        ]);
                    }
                }
                // Return Success Message
                return $this->returnSuccess('The item was Update successfully');
            }

        }else{
            return $this->returnError(404,'Item Not Found');
        }
    }


    public function deletePackageImage(Request $request){
        $data = Images::find($request->id);
        if(!$data)
            return $this->returnError(404, 'Not Found');
        $user_id = $data->package->user->id;
        if($user_id == Auth::user()->id){
            $this->deleteImage($data->image);
            $data->delete();
            return $this->returnSuccess('Image Deleted Successfully');
        }else{
            return $this->returnError(404, 'You cannot delete this');
        }

    }
}
