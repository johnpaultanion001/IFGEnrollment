<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Models\CountryExchange;
use Validator;

class TransactionController extends Controller
{
    
    public function index()
    {
        return view('admin.admin.history.history');
    }
    public function loadhistory(){
        $userid = auth()->user()->id;
        $histories = Transaction::where('user_id' ,$userid)->where('isConfirm' , 1)->latest()->get();
        return view('admin.admin.history.loadhistory' , compact('histories'));
    }

    public function show(Request $request)
    {
        $transaction_id = $request->get('transaction_id');
        $transaction = Transaction::findorfail($transaction_id);
        return response()->json([
            'beneficiary_name' => $transaction->beneficiary->beneficiary_firstname .' '. $transaction->beneficiary->beneficiary_lastname,
            'order_id' => $transaction->id,
            'bank_name' => $transaction->beneficiary->bank_name,
            'account_number' => $transaction->beneficiary->account_number,

            'send_amount' => $transaction->send_amount,
            'service_charge' => $transaction->service_charge,
            'total' => $transaction->total,
        ]);
    }
   
    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'send_amount' => ['required' ,'numeric','min:1'],
            'service_charge' => ['required' ,'numeric','min:0'],
            'transaction_source_of_fund' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $userid = auth()->user()->id;
        $transaction = Transaction::create([
            'user_id' => $userid,
            'beneficiary_id' => $request->input('transaction_beneficiary_id'),
            'send_amount' => $request->input('send_amount'),
            'receive_amount' => $request->input('receive_amount'),
            'service_charge' => $request->input('service_charge'),
            'total' => $request->input('total'),
            'reference_number' => 'JRF'.substr(time(), 4).$userid,
            'transaction_payment_mode' => $request->input('transaction_payment_mode'),
            'transaction_source_of_fund' => $request->input('transaction_source_of_fund'),
            'transaction_purpose_of_remit' => $request->input('transaction_purpose_of_remit'),
        ]);

        return response()->json(['transaction_form' => $transaction->id]);
    }

  
    
    

   
    public function update(Request $request, Transaction $transaction)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'send_amount' => ['required' ,'numeric','min:1'],
            'service_charge' => ['required' ,'numeric','min:0'],
            'transaction_source_of_fund' => ['required'],
        ]);

        $userid = auth()->user()->id;
        Transaction::find($transaction->id)->update([
            'user_id' => $userid,
            'beneficiary_id' => $request->input('transaction_beneficiary_id'),
            'send_amount' => $request->input('send_amount'),
            'receive_amount' => $request->input('receive_amount'),
            'service_charge' => $request->input('service_charge'),
            'total' => $request->input('total'),
            'reference_number' => 'JRF'.substr(time(), 4).$userid,
            'transaction_payment_mode' => $request->input('transaction_payment_mode'),
            'transaction_source_of_fund' => $request->input('transaction_source_of_fund'),
            'transaction_purpose_of_remit' => $request->input('transaction_purpose_of_remit'),
        ]);

        return response()->json(['transaction_form' => $transaction->id]);
    }

    public function confirmtransaction(Request $request, Transaction $transaction)
    {
       Transaction::find($transaction->id)->update([
           'isConfirm' => 1
        ]);

        return response()->json(['transaction_detail' => 'Transaction Added Successfully']);
    }

   
  
    public function reviewpayment(Request $request)
    {  
        $beneciary_id = $request->get('beneficiary');
        $beneciary = Beneficiary::findorfail($beneciary_id);
        
        return response()->json([
            'payment_mode' => $beneciary->payment_mode,
            'purpose_of_remit' => $beneciary->purpose_of_remit,
            'exchange' => $beneciary->country->exchange,
            'exchange_code' => $beneciary->country->code,
        ]);

    }

    public function sendamount(Request $request)
    {  
        $beneciary_id = $request->get('beneficiary');
        $beneciary = Beneficiary::findorfail($beneciary_id);
        $send = $request->get('sendamount');
        $service_charge =  $request->get('service_charge');

        $receive = $send * $beneciary->country->exchange;
        $total = $send + $service_charge;

        return response()->json([
            'receive' => $receive,
            'send' => $send,
            'total' => $total,
            
        ]);
    
       
    }
    public function servicecharge(Request $request)
    {  
        $send = $request->get('sendamount');
        $charge = $request->get('charge');
        $total = $send + $charge;

        return response()->json([
            'total' => $total,
        ]);
        
    }

    public function tracker()
    {  
        return view('admin.admin.tracker.tracker');
    }

    public function tracker_show(Request $request)
    { 
        $reference_number = $request->get('reference_number');
            $isexist = Transaction::where('isConfirm', 1)->where('reference_number', $reference_number)->count();
            if($isexist == 1){
                $transaction = Transaction::where('isConfirm', 1)->where('reference_number', $reference_number)->first();
                $reference_exist = 1;
                return view('admin.admin.tracker.gettransaction', compact('transaction','reference_exist'));
            }
            $reference_exist = 0;
            return view('admin.admin.tracker.gettransaction', compact('reference_exist'));

        
    }

    //Ledger

    public function ledger()
    {
        return view('admin.admin.ledger.ledger');
    }
    public function loadledger(){
        return view('admin.admin.ledger.loadledger');
    }
}
