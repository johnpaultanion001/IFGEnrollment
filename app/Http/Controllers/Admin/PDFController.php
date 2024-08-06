<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberDetail;

class PDFController extends Controller
{
    public function index()
    {
        return view('pdf.membershipPDF');
    }

    public function getMemberDataPDF($type, $referral_code)
    {
        $member = MemberDetail::where('referral_code', $referral_code)->first();
        if ($member == null) {
            $memberDetail = "";
        } else {
            if ($type == 'principal') {
                $memberDetail = MemberDetail::with('plancode')->with('memberHealth')->with('uploadFile')->where('referral_code', $referral_code)->where('principal_id', 0)->first();
            } else {
                $memberDetail = MemberDetail::with('plancode')->with('memberHealth')->with('uploadFile')->where('referral_code', $referral_code)->first();
              
            }

        }


        return response()->json(['result' => $memberDetail, 'dependents' => $dependents ?? '']);
    }

}
