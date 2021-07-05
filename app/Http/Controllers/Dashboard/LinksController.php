<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\MultiDelete;
use App\Models\Links;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index($id) {
        $data = Links::whereActivityId($id)->latest()->paginate(24);
        return view('dashboard.links.index',compact('data','id'));
    }

    public function delete($id)
    {
        $data = Links::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Links::whereIn('id', $data['data']);
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

    protected function flash($type,$message){
        return session()->flash($type, $message);
    }
}
