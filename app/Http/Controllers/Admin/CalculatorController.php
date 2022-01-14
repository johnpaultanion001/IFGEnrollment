<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryExchange;
use App\Models\Bank;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{

    public function index()
    {
        $countries = CountryExchange::latest()->get();
        return view('admin.admin.calculator.calculator',compact('countries'));
    }
    public function delivery(Request $request){
        $delivery      = $request->get('delivery');
    
        $banks = Bank::where('status', $delivery)->latest()->get();
        return response()->json([
            'banks' => $banks,
        ]);
    }
    public function country(Request $request){
        $country      = $request->get('country');
        
        $dcer = CountryExchange::where('id', $country)->first();
        return response()->json([
            'dcer'              => $dcer->code.' '.$dcer->exchange.' /¥',
            'receive_amount'    => $dcer->code.' 0',
        ]);
    }

    public function amount(Request $request){
        
        $country      = CountryExchange::where('id', $request->get('country'))->first();
        $amount       = $request->get('amount');

        if($amount < 10001){
            $charge = 500;  
        }
        elseif($amount < 300001){
            $charge = 1000;  
        }
        elseif($amount < 1000000){
            $charge = 1500;  
        }
        $deposited = $amount + $charge;
        $receive = $amount * $country->exchange;

        return response()->json([
            'amount'       => '¥ '.number_format($amount , 0, '.', ','),
            'charge'       => '¥ '.number_format($charge , 0, '.', ','),
            'deposited'    => '¥ '.number_format($deposited , 0, '.', ','),
            'receive'      => $country->code.' '.number_format($receive , 0, '.', ','),
        ]);
    }
}
