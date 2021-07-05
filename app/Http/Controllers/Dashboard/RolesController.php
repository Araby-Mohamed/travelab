<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Roles\StoreRole;
use App\Http\Requests\General\MultiDelete;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends GeneralController
{
    protected $viewPath = 'roles.';
    protected $path = 'roles';
    private $route = 'dashboard.roles';
    protected $paginate = 30;

    public function __construct(Role $model)
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
        $data = $this->model->withCount('users');
        // Search For Role Name
        request()->whenFilled('role', function() use($data) {
            $data->where('name', 'LIKE', '%' . request()->role . '%');
        });
        $data = $data->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }

    private function getPermissions()
    {
        return Permission::get()->groupBy('path');
    }


    /**
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Get Permissions
        $permissions = $this->getPermissions();
        return view($this->viewPath($this->viewPath . 'create'), compact('permissions'));
    }


    /**
     * Store Data in DB
     * @param StoreRole $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRole $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Store Data in DB
        $role = $this->model->create($inputs);
        // Assign Permission
        $role->syncPermissions($inputs['permissions']);
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
        // Get Permissions
        $permissions = $this->getPermissions();
        // Get Old Assigned Permissions
        $rolePermissions = $data->permissions->pluck('id')->all();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data', 'permissions', 'rolePermissions'));
    }


    /**
     * Update Data in DB
     * @param StoreRole $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreRole $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Update Data in DB
        $data->update($inputs);
        $data->syncPermissions($inputs['permissions']);
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
        $data = $this->model->doesnthave('users')->where('id', '!=', 1)->findOrFail($id);
        // Delete Data from DB
        $data->delete();
        $this->flash('success', trans('lang.deleted'));
        return back();
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
        $items = $this->model->where('id', '!=', 1)->where('id', '!=', $this->admin()->roles->first()->id)->whereIn('id', $data['data'])->doesnthave('users');
        // Check If Not Have Count Items Or Check If User Delete Yourself
        if(!$items->count()) {
            $this->flash('warning', __('lang.select_least_one'));
            return back();
        }
        // Delete Permissions Related To Users
        DB::table('permission_user')->whereIn('user_id', $data['data'])->delete();
        // Delete Images Related To Items Selected
        $this->deleteImage($items->get()->pluck('image')->toArray());
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }
}
