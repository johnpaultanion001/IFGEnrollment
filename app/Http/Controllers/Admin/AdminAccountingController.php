<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberDetail;
use App\Http\Helpers\SetupFunctions;

class AdminAccountingController extends Controller
{
    public function index(){
        $memberDetails = MemberDetail::where('isSaveByUser', true)->where('endorse_to', 'ACCOUNTING')->latest()->get();
        return view('admin_accounting.admin_accounting' , compact('memberDetails'));
    }

    public function confirmPayment(MemberDetail $member){
      
        SetupFunctions::approvedPayment($member);
        return response()->json(['success' => "Successfully approved this payment"]);
    }
    
}
