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

class CustomerStaffController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $senders   = RoleUser::where('role_id', 3)->get();
        return view('administration.staff.customer.customer' , compact('senders'));
    }

    public function customer_detail(Request $request)
    {
        $customer   =  User::where('id', $request->get('customer'))->first();
        return response()->json([
            'first_name'    => $customer->firstname,
            'middle_name'   => $customer->middlename,
            'last_name'     => $customer->lastname,
            'address'       => $customer->address,
            'mobile_number' => $customer->mobile_number,
            'gender'        => $customer->gender,
            'nationality'   => $customer->nationality,
        ]);
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
