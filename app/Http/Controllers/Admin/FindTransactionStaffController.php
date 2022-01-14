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
use App\Models\Beneficiary;
use App\Models\Transaction;


class FindTransactionStaffController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('administration.staff.find_transaction.find_transaction');
    }
    public function find_transaction(Request $request)
    {
        $transaction   =  Transaction::where('id', $request->get('transaction_id'))->first();

        if($transaction == null){
            return response()->json([
                'invalid'    => 'Invalid Transaction ID',
            ]);
        }
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
            'transaction_id'    => $transaction->id,
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
            //Sender
            'first_name'        => $transaction->user->firstname,
            'middle_name'       => $transaction->user->middlename,
            'last_name'         => $transaction->user->lastname,
            'address'           => $transaction->user->address,
            'mobile_number'     => $transaction->user->mobile_number,
            'gender'            => $transaction->user->gender,
            'nationality'       => $transaction->user->nationality,
            'user_id'           => $transaction->user->id,

            //Receiver
            'rfirst_name'       => $transaction->beneficiary->beneficiary_firstname,
            'rmiddle_name'      => $transaction->beneficiary->beneficiary_middlename,
            'rlast_name'        => $transaction->beneficiary->beneficiary_lastname,
            'raddress'          => $transaction->beneficiary->address,
            'rmobile_number'    => $transaction->beneficiary->mobile_number,
            'rpayment_mode'     => $transaction->beneficiary->payment_mode,
            'rbank'             => $transaction->beneficiary->bank->name,
            'country'           => $transaction->beneficiary->country->country,
        ]);
    }
}
