<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\MultiDelete;
use App\Models\Activities;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class ActivitiesController extends Controller
{
    protected $viewPath = 'dashboard.activities.';
    protected $rotePath = 'dashboard.activities';
    protected $paginate = 24;

    protected function flash($type,$msg)
    {
         return session()->flash($type,$msg);
    }

    public function index(Request $request,$id){
        $data = Activities::where('package_id',$id)->latest()->paginate($this->paginate);
        return view($this->viewPath . 'index',compact('data'));
    }

    public function show($id){
        $data = Activities::findOrFail($id);
        return view($this->viewPath . 'show',compact('data'));
    }

    public function delete($id)
    {
        $data = Activities::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Activities::whereIn('id', $data['data']);
        // Check If Not Have Count Items Or Check If User Delete Yourself
        if(!$items->count()) {
            $this->flash('warning', __('lang.select_least_one'));
            return back();
        }
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }
}
