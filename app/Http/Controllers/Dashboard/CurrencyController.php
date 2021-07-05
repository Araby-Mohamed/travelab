<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Currency\CurrencyStore;
use App\Http\Requests\General\MultiDelete;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends GeneralController
{
    protected $viewPath = 'dashboard.currency.';
    private $route = 'dashboard.currency';


    public function __construct(Currency $currency){
        parent::__construct($currency);
    }
    public function index(Request $request)
    {
        // Search And Get Data
        $data = Currency::when($request->title,function($q) use ($request){
            return $q->where('title', 'LIKE' , '%' . $request->title . '%');
        })->latest()->paginate($this->paginate);

        return view($this->viewPath . 'index',compact('data'));

    }


    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(CurrencyStore $request)
    {
        $inputs = $request->validated();
        Currency::create($inputs);
        $this->flash('success', __('lang.stored'));
        return redirect(route($this->route));
    }

    public function edit($id)
    {
        $data = Currency::findOrFail($id);
        return view($this->viewPath . 'edit',compact('data'));
    }


    public function update(CurrencyStore $request, $id)
    {
        $data = Currency::findOrFail($id);
        $inputs = $request->validated();
        $data->update($inputs);
        $this->flash('success', __('lang.updated'));
        return redirect(route($this->route));
    }


    public function delete($id)
    {
        $data = Currency::findOrFail($id);
        $data->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }

    public function deletes(MultiDelete $request)
    {
        // Get Inputs Data From Request
        $data = $request->validated();
        // Get Items Selected
        $items = Currency::whereIn('id', $data['data']);
        // Check If Not Have Count Items Or Check If User Delete Yourself
        if(!$items->count()) {
            $this->flash('warning', __('lang.select_least_one'));
            return back();
        }
        // Get & Delete Data Selected
        $items->delete();
        $this->flash('success', __('lang.deleted'));
        return redirect(route($this->route));
    }
}
