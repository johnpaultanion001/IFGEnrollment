<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralCode;
use Illuminate\Http\Request;
use Validator;

class ReferralCodeController extends Controller
{
   
    public function index()
    {
        $referralCodes = ReferralCode::latest()->get();
        return view('admin.referralCodes.referralCodes', compact('referralCodes'));
    }

   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'referral_code' => ['required', 'unique:referral_codes'] ,
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        ReferralCode::create($request->all());
        return response()->json(['success' => 'Added Successfully.']);
    }

   
    public function edit(ReferralCode $referralCode)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' => $referralCode,
            ]);
        }
    }
   
    public function update(Request $request, ReferralCode $referralCode)
    {
        $validated =  Validator::make($request->all(), [
            'referral_code' => ['required', 'unique:referral_codes,referral_code,'.$referralCode->id,] ,
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        ReferralCode::find($referralCode->id)->update($request->all());
        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function destroy(ReferralCode $referralCode)
    {
        return response()->json(['success' => $referralCode->delete()]);
    }
}
