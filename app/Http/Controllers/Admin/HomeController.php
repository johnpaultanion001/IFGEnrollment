<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Beneficiary;
use App\Models\CountryExchange;
use App\Models\Bank;
use App\Models\Transaction;
use File;
use Illuminate\Support\Facades\Storage;

class HomeController
{
    public function index()
    {
        $userid = auth()->user()->id;
        $countries = CountryExchange::latest()->get();
        $banks = Bank::where('status', 'BANK')->latest()->get();

        $last_amount_transfer = Transaction::where('user_id' ,$userid)->where('isConfirm' , 1)->latest()->first(); 
        $total_transfer = Transaction::where('user_id' ,$userid)->where('isConfirm' , 1)->sum('send_amount');

        $beneficiaries = Beneficiary::where('user_id', $userid)->latest()->get();

        return view('admin.admin.home.home', compact('countries', 'banks' , 'beneficiaries' , 'last_amount_transfer' , 'total_transfer'));
    }
    public function listbeneficiaries()
    {
        $userid = auth()->user()->id;
        $beneficiaries = Beneficiary::where('user_id', $userid)->latest()->get();
        return view('admin.admin.home.listbeneficiaries', compact('beneficiaries'));
    }
    public function exchangerate(Request $request){
       
        $send = $request->get('send');  
        $exchange = CountryExchange::findorfail($request->get('exchange'));

        if($send < 10001){
            $charge = 500;  
        }
        elseif($send < 300001){
            $charge = 1000;  
        }
        elseif($send < 1000000){
            $charge = 1500;  
        }

        $total_send = $send - $charge;
        $total_receive = $total_send * $exchange->exchange;

        
        return response()->json([
            'receive' => $total_receive,
            'value' => $exchange->exchange,
            'code' => $exchange->code,
            'total' => $send,
            'charge' => $charge,
        ]);
    }
    public function fullregistration(){
        $countries = CountryExchange::latest()->get();
        $banks = Bank::where('status', 'BANK')->latest()->get();
        return view('auth.fullregistration' , compact('countries','banks'));
    }

    public function getpersonalinfo(User $user){
        if (request()->ajax()) {
            return response()->json([
                //Personal Info
                'firstname' => $user->firstname,
                'middlename' => $user->middlename,
                'lastname' => $user->lastname,
                'date_of_birth' => $user->date_of_birth,
                'occupation' => $user->occupation,
                'gender' => $user->gender,
                'source_of_fund' => $user->source_of_fund,
                'nationality' => $user->nationality,
                //ID Info
                'id_type' => $user->id_type,
                'id_number' => $user->id_number,
                'id_issued_country' => $user->id_issued_country,
                'id_issue_date' => $user->id_issue_date,
                'id_expiry_date' => $user->id_expiry_date,

                //Personal Info
                'country' => $user->country,
                'address' => $user->address,
                'mobile_number' => $user->mobile_number,
                'telephone' => $user->telephone,
                'terms_and_conditions' => $user->terms_and_conditions,


            ]);
        }
    }

    public function updatepersonalinfo(Request $request, User $user){
        date_default_timezone_set('Asia/Manila');
        $action = $request->input('action');
        if($action == 'personal_info'){
            $validated =  Validator::make($request->all(), [
                //Personal Info
                'firstname' => ['required'],
                'lastname' => ['required'],
                'date_of_birth' => ['required', 'date','before:today'],
                'occupation' => ['required'],
                'gender' => ['required'],
                'source_of_fund' => ['required'],
                'nationality' => ['required'],
                //ID Info
                'id_type' => ['required'],
                'id_number' => ['required'],
                'id_issued_country' => ['required'],
                'id_issue_date' => ['required', 'date'],
                'id_expiry_date' => ['required', 'date'],
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
            if($user->id_card_front == '' || $user->id_card_back == ''){
                return response()->json(['error_id' => 'Ids field is required , Please Upload a Ids']);
            }

            User::find($user->id)->update([
                //Personal Info
                'firstname' => $request->input('firstname'),
                'middlename' => $request->input('middlename'),
                'lastname' => $request->input('lastname'),
                'date_of_birth' => $request->input('date_of_birth'),
                'occupation' => $request->input('occupation'),
                'gender' => $request->input('gender'),
                'source_of_fund' => $request->input('source_of_fund'),
                'nationality' => $request->input('nationality'),
                //ID Info
                'id_type' => $request->input('id_type'),
                'id_number' => $request->input('id_number'),
                'id_issued_country' => $request->input('id_issued_country'),
                'id_issue_date' => $request->input('id_issue_date'),
                'id_expiry_date' => $request->input('id_expiry_date'),
            ]);
    
            return response()->json(['personal_info' => 'Contact Information']);
        }
        if($action == 'contact_info'){
            $validated =  Validator::make($request->all(), [
                //contact Info
                'country' => ['required'],
                'address' => ['required'],
                'mobile_number' => ['required'],
                'terms_and_conditions' => ['accepted'],
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
            User::find($user->id)->update([
                //Contact Info
                'country' => $request->input('country'),
                'address' => $request->input('address'),
                'mobile_number' => $request->input('mobile_number'),
                'telephone' => $request->input('telephone'),
                'terms_and_conditions' => 1,
            ]);
    
            return response()->json(['contact_info' => 'Create Your Beneficiary']);
        }
        if($action == 'create_your_beneficiary'){
            Mail::to($user->email)->send(new WelcomeMail());
            User::find($user->id)->update([
                'isRegistered' => 1,
            ]);
            return response()->json(['create_your_beneficiary' => 'Saved']);
        }
       
    }

    public function ids(Request $request, User $user){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'id_card_front' => ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040' , 'required'],
            'id_card_back' => ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040' , 'required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        File::delete(public_path('ids/'.$user->id_card_front));
        File::delete(public_path('ids/'.$user->id_card_back));

        $id_front = $request->file('id_card_front');
        $extension_front = $id_front->getClientOriginalExtension(); 
        $file_name_to_save_front = "id_front_".$user->email."_".$user->id.".".$extension_front;
        $id_front->move('ids', $file_name_to_save_front);

        $id_back = $request->file('id_card_back');
        $extension_back = $id_back->getClientOriginalExtension(); 
        $file_name_to_save_back = "id_back_".$user->email."_".$user->id.".".$extension_back;
        $id_back->move('ids', $file_name_to_save_back);

        $user->id_card_front = $file_name_to_save_front;
        $user->id_card_back = $file_name_to_save_back;
        $user->save();

        return response()->json(['success' => 'Ids Are Successfully Uploaded']);
    }

}
