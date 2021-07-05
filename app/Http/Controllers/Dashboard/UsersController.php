<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends GeneralController
{
    protected $viewPath = 'dashboard.users.';
    private $route = 'dashboard.users';


    public function __construct(User $users){
        parent::__construct($users);
    }
    public function index(Request $request)
    {
        // Search And Get Data
        $data = User::when($request->username,function($q) use ($request){
            return $q->where('username', 'LIKE' , '%' . $request->username . '%');
        })->latest()->paginate($this->paginate);

        return view($this->viewPath . 'index',compact('data'));

    }

    public function show($id){
        $data = User::findOrFail($id);
        return view($this->viewPath . 'show',compact('data'));
    }


    public function delete($id)
    {
        // Get and Check Data
        $data = User::findOrFail($id);
        // Delete images from folders
        $this->deleteImage($data->image);
        // Delete Data from DB
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }

    public function deletes(MultiDelete $request)
    {
        $inputs = $request->validated();
        $data = User::whereIn('id',$inputs['data']);
        $this->deleteImage($data->pluck('image')->toArray());
        $data->delete();
        session()->flash('success',__('lang.deleted'));
        return redirect(route($this->route));
    }
}
