<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Validator;
use App\Models\CountryExchange;
use App\Models\Bank;

class BeneficiaryController extends Controller
{
   
    public function index()
    {
        $userid = auth()->user()->id;
        $beneficiaries = Beneficiary::where('user_id', $userid)->latest()->get();
        return view('auth.beneficiaries', compact('beneficiaries'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'receipt_country' => ['required'],
            'payment_mode' => ['required'],
            //Payout Location
            'bank_name' => ['required'],
            'account_number' => ['required'],
             //Beneficiary Details
            'beneficiary_firstname' => ['required'],
            'beneficiary_lastname' => ['required'],
            'beneficiary_mobile_number' => ['required'],
            //Address Details
            'beneficiary_address' => ['required'],
            'purpose_of_remit' => ['required'],
            'relation_with_beneficiary' => ['required'],

        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        
        Beneficiary::create([
            'user_id' => $request->input('beneficiary_user_id'),
            'receipt_country' => $request->input('receipt_country'),
            'payment_mode' => $request->input('payment_mode'),
             //Payout Location
             'bank_name' => $request->input('bank_name'),
             'account_number' => $request->input('account_number'),
             //Beneficiary Details
             'beneficiary_firstname' => $request->input('beneficiary_firstname'),
             'beneficiary_middlename' => $request->input('beneficiary_middlename'),
             'beneficiary_lastname' => $request->input('beneficiary_lastname'),
             'mobile_number' => $request->input('beneficiary_mobile_number'),
             //Address Details
             'address' => $request->input('beneficiary_address'),
             'purpose_of_remit' => $request->input('purpose_of_remit'),
             'relation_with_beneficiary' => $request->input('relation_with_beneficiary'),
            
        ]);

        return response()->json(['success' => 'Beneficiary Added Successfully.']);
    }
 
    public function show(Beneficiary $beneficiary)
    {
        //
    }

    public function edit(Beneficiary $beneficiary)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' => $beneficiary,
                'b_address' => $beneficiary->address,
                'b_cn' => $beneficiary->mobile_number,
            ]);
        }
    }
   
    public function update(Request $request, Beneficiary $beneficiary)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'receipt_country' => ['required'],
            'payment_mode' => ['required'],
            //Payout Location
            'bank_name' => ['required'],
            'account_number' => ['required'],
             //Beneficiary Details
            'beneficiary_firstname' => ['required'],
            'beneficiary_lastname' => ['required'],
            'beneficiary_mobile_number' => ['required'],
            //Address Details
            'beneficiary_address' => ['required'],
            'purpose_of_remit' => ['required'],
            'relation_with_beneficiary' => ['required'],

        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        Beneficiary::find($beneficiary->id)->update([
            'receipt_country' => $request->input('receipt_country'),
            'payment_mode' => $request->input('payment_mode'),
             //Payout Location
             'bank_name' => $request->input('bank_name'),
             'account_number' => $request->input('account_number'),
             //Beneficiary Details
             'beneficiary_firstname' => $request->input('beneficiary_firstname'),
             'beneficiary_middlename' => $request->input('beneficiary_middlename'),
             'beneficiary_lastname' => $request->input('beneficiary_lastname'),
             'mobile_number' => $request->input('beneficiary_mobile_number'),
             //Address Details
             'address' => $request->input('beneficiary_address'),
             'purpose_of_remit' => $request->input('purpose_of_remit'),
             'relation_with_beneficiary' => $request->input('relation_with_beneficiary'),
        ]);

        return response()->json(['success' => 'Beneficiary Updated Successfully.']);
    }

    public function destroy(Beneficiary $beneficiary)
    {
        Beneficiary::find($beneficiary->id)->delete();
        return response()->json(['success' => 'Beneficiary Removed Successfully.']);
    }

    // Recipient
    public function recipient()
    {
        $countries = CountryExchange::latest()->get();
        $banks = Bank::latest()->get();
        return view('admin.admin.recipient.recipient' , compact('countries', 'banks'));
    }
    public function loadrecipient()
    {
        $userid = auth()->user()->id;
        $beneficiaries = Beneficiary::where('user_id', $userid)->latest()->get();
        return view('admin.admin.recipient.loadrecipient', compact('beneficiaries'));
    }
}
