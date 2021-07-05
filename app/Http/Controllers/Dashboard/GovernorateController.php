<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Governorate\Store;
use App\Http\Requests\General\MultiDelete;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends GeneralController
{
    private $viewPath = 'dashboard.countries.governorate.';
    private $route = 'dashboard.governorate';

    public function __construct(Governorate $model){
        parent::__construct($model);
    }

    public function index(Request $request,$id)
    {
        $country = Country::findOrFail($id);
        // Search And Get Data
        $data = Governorate::whereCountryId($id)->when($request->title,function($q) use ($request){
            return $q->where('title', 'LIKE' , '%' . $request->title . '%');
        })->latest()->paginate($this->paginate);

        return view($this->viewPath . 'index',compact('data','country'));
    }


    public function create($id)
    {
        $country = Country::findOrFail($id);
        return view($this->viewPath . 'create',compact('country'));
    }


    public function store(Store $request,$id)
    {
        $data = $request->validated();
        $data['country_id'] = $id;
        Governorate::create($data);
        $this->flash('success', __('lang.stored'));
        return redirect(route($this->route,$id));
    }


    public function edit($id)
    {
        $data = Governorate::findOrFail($id);
        return view($this->viewPath . 'edit',compact('data'));
    }


    public function update(Store $request, $id,$co)
    {
        $data = Governorate::findOrFail($id);
        $data->update($request->validated());
        $this->flash('success', __('lang.updated'));
        return redirect(route($this->route,$co));
    }


    public function delete($id)
    {
        $data = Governorate::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Governorate::whereIn('id', $data['data']);
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }
}
