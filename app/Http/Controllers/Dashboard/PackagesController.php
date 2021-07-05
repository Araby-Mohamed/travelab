<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\MultiDelete;
use App\Models\Activities;
use App\Models\Packages;
use App\Models\Ratings;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    protected $viewPath = 'dashboard.packages.';
    protected $rotePath = 'dashboard.packages';
    protected $paginate = 24;


    protected function flash($type,$msg)
    {
        return session()->flash($type,$msg);
    }

    public function index(Request $request) {
        // Search And Get Data
        if(request()->filled('type')){
            $data = Packages::when($request->title,function($q)use($request){
                $q->where('title', 'LIKE', '%' . $request->title . '%');
            })->whereUserId(request()->get('type'))->latest()->paginate($this->paginate);
        }else{
            $data = Packages::when($request->title,function($q)use($request){
                $q->where('title', 'LIKE', '%' . $request->title . '%');
            })->latest()->paginate($this->paginate);
        }
        return view($this->viewPath . 'index',compact('data'));
    }



    public function show($id) {
        // Get Package
        $data = Packages::with('tags')->findOrFail($id);
        // Get Sum Rate
        $sumRate = Ratings::wherePackageId($id)->whereStatus(1)->sum('rate');
        // Get Count Rate
        $count = Ratings::wherePackageId($id)->whereStatus(1)->count();
        // Rating
        $rating = ($count && $sumRate != 0) ? round($sumRate / $count) : 0;
        return view($this->viewPath . 'show',compact('data','rating'));
    }

    public function status($id) {
        $data = Packages::findOrFail($id);
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
        $data = Packages::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Packages::whereIn('id', $data['data']);
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
