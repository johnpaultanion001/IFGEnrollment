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
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;

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
        
        $emailNotif = [
            'notif_message'     =>  '',
            'reference_number'  =>  $transaction->reference_number,
            'receiver'          =>  $transaction->beneficiary->beneficiary_firstname . ' ' . $transaction->beneficiary->beneficiary_lastname,
            'send_amount'       =>  number_format($transaction->send_amount , 0, '.', ','). ' [JPY]',
            'receive_amount'    =>  number_format($transaction->receive_amount , 0, '.', ','). ' ['.$transaction->country->code.']',
            'receive_method'    =>  $transaction->transaction_payment_mode,
            'note'              =>  '',
        ];
        
        if($transaction->status == 0){
            Transaction::find($transaction_id)->update([
                'status' => 1,
            ]);
            if($transaction->transaction_payment_mode == 'Account Deposit')
            {
                $emailNotif['notif_message']  = "Remittance has been credited to your account";
                $emailNotif['note']  = 'Timing of funds availability for account deposit is subject to banking hours, destination country and compliance with regulatory requirements';

            }
            elseif($transaction->transaction_payment_mode == 'Cash Pick Up')
            {
                $emailNotif['notif_message']  = "Remittance is now available for pick up!";
                $emailNotif['note']  = 'Funds available for pick up at any Palawan , MLhuillier ,Cebuana, LBC, PeraHub, RD or Western Union branches';

            }
            Mail::to([$transaction->user->email, $transaction->beneficiary->beneficiary_email])
                ->send(new EmailNotification($emailNotif));
            return response()->json(['success' => 'Data For Pickup']);
        }
        if($transaction->status == 1){
            Transaction::find($transaction_id)->update([
                'status' => 2,
            ]);
            if($transaction->transaction_payment_mode == 'Account Deposit')
            {
                $emailNotif['notif_message']  = 'Transfer of '. number_format($transaction->send_amount , 0, '.', ',') .
                ' [JPY] to ' . $transaction->beneficiary->beneficiary_firstname . ' is complete!';
                $emailNotif['note']  = 'Your transfer is complete and funds have been deposited into your receiver account';

            }
            elseif($transaction->transaction_payment_mode == 'Cash Pick Up')
            {
                $emailNotif['notif_message']  = 'Transfer of '. number_format($transaction->send_amount , 0, '.', ',') .
                                        ' [JPY] to ' . $transaction->beneficiary->beneficiary_firstname . ' has been picked up!';
                $emailNotif['note']  = 'Funds available for pick up at any Palawan , MLhuillier ,Cebuana, LBC, PeraHub, RD or Western Union branches';
                
            }
            

            Mail::to([$transaction->user->email, $transaction->beneficiary->beneficiary_email])
                ->send(new EmailNotification($emailNotif));
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

        $emailNotif = [
            'notif_message'     => 'Transfer of '. number_format($transaction->send_amount , 0, '.', ',') .
                                    ' [JPY] is on its way to ' . $transaction->beneficiary->beneficiary_firstname . '!',
            'reference_number'  =>  $transaction->reference_number,
            'receiver'          =>  $transaction->beneficiary->beneficiary_firstname . ' ' . $transaction->beneficiary->beneficiary_lastname,
            'send_amount'       =>  number_format($transaction->send_amount , 0, '.', ','). ' [JPY]',
            'receive_amount'    =>  number_format($transaction->receive_amount , 0, '.', ','). ' ['.$transaction->country->code.']',
            'receive_method'    =>  $transaction->transaction_payment_mode,
            'note'              =>  '',
        ];

        if($transaction->isPaid == true){
            Transaction::find($transaction_id)->update([
                'isPaid' => false,
            ]);
        }

        if($transaction->isPaid == false){
            Transaction::find($transaction_id)->update([
                'isPaid' => true,
            ]);
            if($transaction->transaction_payment_mode == 'Account Deposit')
            {
                $emailNotif['note']  = 'Timing of funds availability for account deposit is subject to banking hours, destination country and compliance with regulatory requirements';
            }
            elseif($transaction->transaction_payment_mode == 'Cash Pick Up')
            {
                $emailNotif['note']  = 'Funds available for pick up at any Palawan , MLhuillier ,Cebuana, LBC, PeraHub, RD or Western Union branches';
            }
            Mail::to($transaction->user->email)
                ->send(new EmailNotification($emailNotif));
        }
        return response()->json(['success'=>'Successfully Updated']);
    }



}
