<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Setting\UpdateSetting;
use App\Models\Setting;

class SettingController extends GeneralController
{

    protected $viewPath = 'setting.';
    protected $path = 'setting';
    protected $quality = 100;
    protected $encode = 'png';


    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }


    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all data model
        $data = $this->model->get();
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }



    public function update(UpdateSetting $request)
    {
        // Get Data From Model
        $data = $this->model->get();
        // Get data from Request
        $inputs = $request->validated();
        // Check If Has Logo
        if($request->hasFile('logo')) {
            $inputs['logo'] = $this->uploadImage($request->file('logo'), $this->path, $data->where('key', 'logo')->first()->val);
        }
        // Check If Has Logo White
        if($request->hasFile('logo_white')) {
            $inputs['logo_white'] = $this->uploadImage($request->file('logo_white'), $this->path, $data->where('key', 'logo_white')->first()->val);
        }
        // Check If Has Favicon
        if($request->hasFile('favicon')) {
            $inputs['favicon'] = $this->uploadImage($request->file('favicon'), $this->path, $data->where('key', 'favicon')->first()->val);
        }
        // Update Data in DB
        $this->model->setMany($inputs);
        $this->flash('success', __('lang.updated'));
        return back();
    }
}
