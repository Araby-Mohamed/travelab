<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Interest\Store;
use App\Http\Requests\General\MultiDelete;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends GeneralController
{
    private $viewPath = 'dashboard.interest.';
    private $route = 'dashboard.interests';

    public function __construct(Interest $model){
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        // Search And Get Data
        $data = Interest::when($request->title,function($q) use ($request){
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
        Interest::create($data);
        $this->flash('success', __('lang.stored'));
        return redirect(route($this->route));
    }


    public function edit($id)
    {
        $data = Interest::findOrFail($id);
        return view($this->viewPath . 'edit',compact('data'));
    }


    public function update(Store $request, $id)
    {
        $data = Interest::findOrFail($id);
        $data->update($request->validated());
        $this->flash('success', __('lang.updated'));
        return redirect(route($this->route));
    }


    public function delete($id)
    {
        $data = Interest::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Interest::whereIn('id', $data['data']);
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }
}
