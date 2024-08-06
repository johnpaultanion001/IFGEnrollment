<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Gate; 
use Symfony\Component\HttpFoundation\Response;
use App\Models\CountryExchange;
use App\Models\MemberDetail;
use App\Models\User;
use App\Models\Beneficiary;
use App\Models\Transaction;

class MemberDetailAdminController extends Controller
{
    public function index()
    {
        $members = MemberDetail::where('principal_id', 0)->where('isSaveByUser', true)->orderBy('last_name', 'asc')->get();
        return view('admin.member.member' , compact('members'));
    }

    public function member_detail(Request $request)
    {
        $memberDetatils   =  MemberDetail::with('plancode')->where('id', $request->get('member'))->first();
        $dependents = MemberDetail::where('principal_id', $request->get('member'))->where('isSaveByUser', true)->latest()->get();
      

        return response()->json(
                [
                    "memberDetails" => $memberDetatils,
                    "dependents" => $dependents,
                ]
           ,);
    }

    public function beneficiaries(Request $request){
        $beneficiaries = Beneficiary::where('user_id', $request->get('customer'))->latest()->get();
        return response()->json([
            'beneficiaries'    => $beneficiaries,
        ]);
    }
    public function transactions(Request $request){
        $transactions = Transaction::where('user_id', $request->get('customer'))->latest()->get();
        return view('administration.staff.customer.transaction' , compact('transactions'));
    }
}
