<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    use GeneralTrait;
    public function __invoke()
    {
        $currency = CurrencyResource::collection(Currency::all());
        return $this->returnData('currencies',$currency);
    }
}
