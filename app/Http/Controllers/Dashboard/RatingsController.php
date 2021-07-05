<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\MultiDelete;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    protected $viewPath = 'dashboard.ratings.';
    protected $routePath = 'dashboard.ratings';

    protected function flash($type,$msg)
    {
        return session()->flash($type,$msg);
    }

    public function index(Request $request) {
        if(request()->filled('type')) {
            $data = Ratings::when($request->name, function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            })->where('package_id', request()->get('type'))->latest()->paginate();
        }elseif (request()->user){
            $data = Ratings::when($request->name, function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            })->where('user_id', request()->get('user'))->latest()->paginate();
        }else{
            $data = Ratings::when($request->name,function ($q) use ($request){
                $q->where('name','LIKE','%' . $request->name . '%');
            })->latest()->paginate();
        }
        return view($this->viewPath . 'index',compact('data'));
    }

    public function show($id) {
        $data = Ratings::findOrFail($id);
        return view($this->viewPath . 'show',compact('data'));
    }


    public function status($id) {
        $data = Ratings::findOrFail($id);
        if($data->status == 0){
            $data->update(['status' => 1]);
        }else{
            $data->update(['status' => 0]);
        }
        session()->flash('success','Item Updated Successfully');
        return back();
    }

    public function delete($id)
    {
        $data = Ratings::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Ratings::whereIn('id', $data['data']);
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
