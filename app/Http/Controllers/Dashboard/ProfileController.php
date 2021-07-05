<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Profile\UpdateProfile;

class ProfileController extends GeneralController
{
    protected $viewPath = 'profile.';
    protected $urlPath = 'profile/';

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }


    /**
     * Show Page Profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get Data Admin Login
        $admin = $this->admin();
        return view($this->viewPath($this->viewPath . 'index'), compact('admin'));
    }


    /**
     * Show Page Edit Profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        // Get Data Admin Login
        $admin = $this->admin();
        return view($this->viewPath($this->viewPath . 'edit'), compact('admin'));
    }


    /**
     * Update Data in DB
     * @param UpdateProfile $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProfile $request)
    {
        // Get Item By ID
        $data = $this->GetItem($this->admin()->id);
        // Get all Data from request
        $inputs = $request->validated();
        // Set Password if existing in Data request
        if(!empty($request->input('password'))) {
            $inputs['password'] =  bcrypt($request->input('password'));
        } else {unset($inputs['password']);}
        // Set Image in request data
        $inputs['image'] = $this->uploadImage($request->file('image'), 'admins', $data->image, 300, 300);
        // Update Data in DB
        $data->update($inputs);
        // Flash Message
        $this->flash('success', trans('lang.profile_updated'));
        return redirect($this->urlPath($this->urlPath));
    }
}
