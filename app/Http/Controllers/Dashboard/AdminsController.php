<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Admins\StoreAdmin;
use App\Http\Requests\General\MultiDelete;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminsController extends GeneralController
{
    protected $viewPath = 'admins.';
    protected $path = 'admins';
    private $route = 'dashboard.admins';

    public function __construct(Admin $model)
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
        $data = $this->getData()->with('roles');
        // Search For Role
        request()->whenFilled('role', function() use($data) {
            $data->whereHas('roles', function($q){$q->where('slug', request()->role);});
        });
        // Search For Username
        request()->whenFilled('username', function() use($data) {
            $data->like('username', request()->username);
        });
        $data = $data->paginate($this->paginate);
        // Get Roles Has Admins
        $roles = Role::has('users')->get();
        return view($this->viewPath($this->viewPath . 'index'), compact('data', 'roles'));
    }


    private function roles()
    {
        return Role::get();
    }


    /**
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'create'), compact('roles'));
    }


    /**
     * Store Data in DB
     * @param StoreAdmin $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAdmin $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Set Password in inputs data
        $inputs['password'] = bcrypt($request->input('password'));
        // If Request Has File
        if($request->hasFile('image')) {
            // Set Image in inputs data
            $inputs['image'] = $this->uploadImage($request->file('image'), $this->path, null, 300);
        }
        // Store Data in DB
        DB::beginTransaction();
        $admin = $this->model->create($inputs);
        // Assign Roles
        $admin->attachRole($inputs['role']);
        DB::commit();
        $this->flash('success', __('lang.stored'));
        return redirect(route($this->route));
    }


    /**
     * View Page Edit Item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Roles
        $roles = $this->roles();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data', 'roles'));
    }


    /**
     * Update Data in DB
     * @param StoreAdmin $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreAdmin $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Set Password if exist inputs data
        if(!empty($request->input('password'))) {
            $inputs['password'] = bcrypt($request->input('password'));
        } else { unset($inputs['password']); }
        // If Request Has File
        if($request->hasFile('image')) {
            // Set Image in inputs data
            $inputs['image'] = $this->uploadImage($request->file('image'), $this->path, $data->image, 300);
        }
        // Update Data in DB
        DB::beginTransaction();
        $data->update($inputs);
        // Assign Roles
        $data->syncRoles([$inputs['role']]);
        DB::commit();
        $this->flash('success', __('lang.updated'));
        return redirect(route($this->route));
    }


    /**
     * Delete Data from DB
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Check If User Delete Yourself
        if(($data->id == $this->admin()->id) || ($data->roles->first()->id == 1)) {
            $this->flash('warning', __('lang.cant_be_deleted'));
            return back();
        }
        // Delete Roles From Admin
        $data->detachRole($data->roles->first());
        // Delete images from folders
        $this->deleteImage($data->image);
        // Delete Data from DB
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }


    /**
     * Delete Multi Records From DB
     * @param MultiDelete $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = $this->model->whereIn('id', $data['data'])->whereHas('roles', function($q){$q->where('id', '!=', 1);});
        // Check If Not Have Count Items Or Check If User Delete Yourself
        if((!$items->count()) || (in_array($this->admin()->id, $data['data']))) {
            $this->flash('warning', __('lang.select_least_one'));
            return back();
        }
        // Delete Permissions Related To Users
        DB::table('role_user')->whereIn('user_id', $data['data'])->delete();
        // Delete Images Related To Items Selected
        $this->deleteImage($items->get()->pluck('image')->toArray());
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }
}
