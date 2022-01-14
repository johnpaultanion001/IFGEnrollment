<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Gate; 
use Symfony\Component\HttpFoundation\Response;
use App\Models\CountryExchange;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Bank;
use App\Models\Beneficiary;
use App\Models\Transaction;

class TransactionStaffController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = CountryExchange::latest()->get();
        $senders   = RoleUser::where('role_id', 3)->get();
        $banks     = Bank::latest()->get();
        return view('administration.staff.transaction.transaction' ,compact('countries','senders','banks'));
    }
    public function sender(Request $request)
    {
        $sender        = $request->get('sender');
        $user          = User::where('id', $sender)->first();
        $beneficiaries = Beneficiary::where('user_id', $user->id)->latest()->get();

        return response()->json([
            'first_name'    => $user->firstname,
            'middle_name'   => $user->middlename,
            'last_name'     => $user->lastname,
            'address'       => $user->address,
            'mobile_number' => $user->mobile_number,
            'gender'        => $user->gender,
            'nationality'   => $user->nationality,
            'beneficiaries' => $beneficiaries,


        ]);
    }

    public function beneficiary_dd(Request $request){
        $beneficiaries = Beneficiary::where('user_id', $request->get('sender'))->latest()->get();
        return response()->json([
            'beneficiaries' => $beneficiaries,
        ]);
    }

    public function beneficiary(Request $request)
    {
        $id               = $request->get('beneficiary');
        $beneficiary      = Beneficiary::where('id', $id)->first();

        return response()->json([
            'first_name'    => $beneficiary->beneficiary_firstname,
            'middle_name'   => $beneficiary->beneficiary_middlename,
            'last_name'     => $beneficiary->beneficiary_lastname,
            'address'       => $beneficiary->address,
            'mobile_number' => $beneficiary->mobile_number,
            'payment_mode'  => $beneficiary->payment_mode,
            'bank'          => $beneficiary->bank->name,
            

        ]);
    }

    public function reviewpayment(Request $request)
    {  
        $beneciary_id = $request->get('beneficiary');
        $country_id = $request->get('country');

        $beneciary = Beneficiary::where('id', $beneciary_id)->first();
        $country   = CountryExchange::where('id', $country_id)->first();

        
        return response()->json([
            'payment_mode' => $beneciary->payment_mode,
            'purpose_of_remit' => $beneciary->purpose_of_remit,
            'exchange' => $country->exchange,
            'exchange_code' => $country->code,
        ]);
    }
    public function compute(Request $request){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'send_amount' => ['required' ,'numeric','min:1000'],
            'transaction_source_of_fund' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

         $country_id = $request->input('transaction_country_id');
         $country    =  CountryExchange::where('id', $country_id)->first();
         $send       = $request->input('send_amount');
    
            if($send < 10001){
                $charge = 500;  
            }
            elseif($send < 300001){
                $charge = 1000;  
            }
            elseif($send < 1000000){
                $charge = 1500;  
            }

            $total = $send + $charge;
            $total_receive = $send * $country->exchange;
    
            return response()->json([
                'submit'    =>  'submit',
                'receive'   =>  number_format($total_receive , 0, '.', ','),
                'send'      =>  number_format($send , 0, '.', ','),
                'total'     =>  number_format($total , 0, '.', ','),
                'charge'    =>  number_format($charge , 0, '.', ','),

            ]);
        
    }

    public function transaction_store(Request $request){

        date_default_timezone_set('Asia/Manila');
        $send       = $request->input('send_amount');
        $country    =  CountryExchange::where('id', $request->input('transaction_country_id'))->first();

        if($send < 10001){
            $charge = 500;  
        }
        elseif($send < 300001){
            $charge = 1000;  
        }
        elseif($send < 1000000){
            $charge = 1500;  
        }
        $total = $send + $charge;
        $total_receive = $send * $country->exchange;

        $transaction = Transaction::create([
            'user_id'                      => $request->input('transaction_sender_id'),
            'beneficiary_id'               => $request->input('transaction_beneficiary_id'),
            'country_exchange_id'          => $country->id,
            'send_amount'                  => $send,
            'receive_amount'               => $total_receive,
            'service_charge'               => $charge,
            'total'                        => $total,
            'reference_number'             => 'JRF'.substr(time(), 4).$request->input('transaction_sender_id'),
            'transaction_payment_mode'     => $request->input('transaction_payment_mode'),
            'transaction_source_of_fund'   => $request->input('transaction_source_of_fund'),
            'transaction_purpose_of_remit' => $request->input('transaction_purpose_of_remit'),
            'isConfirm'                    => 1,
        ]);

        return response()->json([
            'transaction' => 'Successfully Added Transaction.',
            'transaction_id' => $transaction->id,
        ]);

    }

    public function transaction_details(Request $request){
        $transaction   =  Transaction::where('id', $request->get('transaction_id'))->first();
        if($transaction->isPaid == 1){
            $status = 'Paid';
        }else{
            $status = 'Unpaid';
        }

        if($transaction->transaction_payment_mode == 'Account Deposit'){
            $deposit_type = 'Account Deposit';
        }else{
            $deposit_type = 'Cash Deposit';
        }

        return response()->json([
            'payout_partner'    => $transaction->beneficiary->bank->name,
            'status'            => $status,
            'transaction_type'  => 'Cash Pay',
            'date_time'         => $transaction->created_at->format('M j , Y h:i A'),
            'approved_by'       => auth()->user()->firstname .' '.auth()->user()->lastname,
            'collected_amount'  => number_format($transaction->total , 0, '.', ','). ' [JPY]',
            'service_charge'    => number_format($transaction->service_charge , 0, '.', ','). ' [JPY]',
            'transfer_amount'   => number_format($transaction->send_amount , 0, '.', ','). ' [JPY]',
            'exchange_rate'     => '1 [JPY] = '. $transaction->country->exchange. ' ['.$transaction->country->code.']',
            'receive_amount'    => number_format($transaction->receive_amount , 0, '.', ','). ' ['.$transaction->country->code.']',
            'deposit_type'      => $deposit_type,
            'reference_number'  => $transaction->reference_number,
            'sender_name'       => $transaction->user->firstname . ' ' .$transaction->user->lastname,
            'beneficiary_name'  => $transaction->beneficiary->beneficiary_firstname. ' ' .$transaction->beneficiary->beneficiary_lastname,
            'bank_name'         => $transaction->beneficiary->bank->name,
            'account_number'    => $transaction->beneficiary->account_number,
        ]);
    }
    
    public function transaction_cancel(Transaction $transaction){
        return response()->json(['success' => $transaction->delete()]);
    }
}
