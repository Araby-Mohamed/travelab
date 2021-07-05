<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\General\MultiDelete;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends GeneralController
{
    protected $viewPath = 'dashboard.messages.';

    public function __construct(Messages $model){
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        $data = Messages::when($request->username,function ($q) use ($request){
            return $q->where('username','LIKE','%' . $request->username . '%' );
        })->latest()->paginate($this->paginate);

        return view($this->viewPath . 'index',compact('data'));
    }


    public function show($id)
    {
        $data = Messages::findOrFail($id);
        if($data->read_at == '0')
            $data->update(['read_at' => '1']);
        return view($this->viewPath . 'show',compact('data'));
    }



    public function delete($id)
    {
        $data = Messages::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Messages::whereIn('id', $data['data']);
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
