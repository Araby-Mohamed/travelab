<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Country\Store;
use App\Http\Requests\General\MultiDelete;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends GeneralController
{
    private $viewPath = 'dashboard.countries.';
    private $route = 'dashboard.country';

    public function __construct(Country $model){
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        // Search And Get Data
        $data = Country::when($request->title,function($q) use ($request){
            return $q->where('title', 'LIKE' , '%' . $request->title . '%');
        })->latest()->paginate($this->paginate);

        return view($this->viewPath . 'index',compact('data'));
    }


    public function create()
    {
        return view($this->viewPath . 'create');
    }


    public function store(Store $request)
    {
        $data = $request->validated();
        Country::create($data);
        $this->flash('success', __('lang.stored'));
        return redirect(route($this->route));
    }


    public function edit($id)
    {
        $data = Country::findOrFail($id);
        return view($this->viewPath . 'edit',compact('data'));
    }


    public function update(Store $request, $id)
    {
        $data = Country::findOrFail($id);
        $data->update($request->validated());
        $this->flash('success', __('lang.updated'));
        return redirect(route($this->route));
    }


    public function delete($id)
    {
        $data = Country::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Country::whereIn('id', $data['data']);
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }
}
