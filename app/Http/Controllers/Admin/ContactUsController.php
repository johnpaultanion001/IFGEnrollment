<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\CountryExchange;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendingMail;

class ContactUsController extends Controller
{
 
    public function index()
    {
        $countries = CountryExchange::latest()->get();
        return view('admin.admin.contactus.contactus', compact('countries'));
    }
    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'desired_country' => ['required'],
            'message' => ['required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $valueArray = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'desired_country' => $request->input('desired_country'),
        	'message' => $request->input('message'),
        ];
        
        Mail::to('philippines@jpremit.com')
                ->send(new SendingMail($valueArray));

        return response()->json(['success' => 'Send Successfully']);
    }

   
   
}
