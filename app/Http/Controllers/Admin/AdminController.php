<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Transaction;
use App\Models\CountryExchange;
use App\Models\Bank;
use App\Models\Province;
use App\Models\City;

class AdminController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $histories = Transaction::where('isConfirm' , 1)->latest()->get();
        $countries = CountryExchange::orderby('id', 'asc')->get();
        $banks     = Bank::where('status', 'BANK')->latest()->get();
        $branchs   = Bank::where('status', 'BRANCH')->latest()->get();
        $provincies   = Province::latest()->get();
        $cities   = City::latest()->get();

        return view('administration.home' , compact('histories', 'countries','banks','branchs', 'provincies', 'cities'));
    }
    public function status(Request $request){
        $transaction_id = $request->get('transaction');
        $transaction = Transaction::where('id', $transaction_id)->first();
        
        if($transaction->status == 0){
            Transaction::find($transaction_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success' => 'Data For Pickup']);
        }
        if($transaction->status == 1){
            Transaction::find($transaction_id)->update([
                'status' => 2,
            ]);
            return response()->json(['success' => 'Claimed']);
        }
        if($transaction->status == 2){
            Transaction::find($transaction_id)->update([
                'status' => 0,
            ]);
            return response()->json(['success' => 'Sending']);
        }
        
    }

    public function payment(Request $request){
        $transaction_id = $request->get('payment');
        $transaction = Transaction::where('id', $transaction_id)->first();
        
        if($transaction->isPaid == true){
            Transaction::find($transaction_id)->update([
                'isPaid' => false,
            ]);
            
        }
        if($transaction->isPaid == false){
            Transaction::find($transaction_id)->update([
                'isPaid' => true,
            ]);
        }
        return response()->json(['success'=>'Successfully Updated']);
    }



}
