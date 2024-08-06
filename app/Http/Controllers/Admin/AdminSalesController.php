<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SetupFunctions;
use Illuminate\Http\Request;
use App\Models\MemberDetail;
use App\Models\EndorceToMda;

use Illuminate\Support\Facades\Mail;
use App\Mail\QuatationMail;
use App\Mail\ApprovedPaymentMail;


class AdminSalesController extends Controller
{
    public function index()
    {
        $memberDetails = MemberDetail::where('isSaveByUser', true)->where('principal_id', 0)->latest()->get();
        return view('admin_sales.admin_sales', compact('memberDetails'));
    }

    public function endorseTo(MemberDetail $memberDetail, $endorseTo)
    {

        if ($endorseTo == "BILLING") {
            SetupFunctions::endorseToBilling($memberDetail);
        }

        if ($endorseTo == "ACCOUNTING") {
            SetupFunctions::endorseToAccounting($memberDetail);
        }

        if ($endorseTo == "SALES") {
            SetupFunctions::endorseToSales($memberDetail);
        }

        if ($endorseTo == "MEMBER") {
            SetupFunctions::endorseToMember($memberDetail);
        }

        if ($endorseTo == "MDA") {
            SetupFunctions::endorseToMDA($memberDetail);
        }



        return response()->json(['success' => "Succesfully updated",]);
    }
    public function notifyMember(MemberDetail $member)
    {
        $bodyData = [
            'name'     =>  $member->last_name . ", " . $member->first_name . " (" . $member->middle_name . ")",
        ];

        Mail::to($member->user->email)
            ->send(new QuatationMail($bodyData));
        SetupFunctions::endorseToMember($member);

        return response()->json(['success' => "A notification was successfully sent to this email address " . $member->user->email,]);
    }

    public function notifyMemberPayment(MemberDetail $member)
    {
        $bodyData = [
            'name'     =>  $member->last_name . ", " . $member->first_name . " (" . $member->middle_name . ")",
        ];

        Mail::to($member->user->email)
            ->send(new ApprovedPaymentMail($bodyData));
        SetupFunctions::approvedPaymentMember($member);

        return response()->json(['success' => "A notification was successfully sent to this email address " . $member->user->email,]);
    }

    public function viewActivities(MemberDetail $member)
    {
        return response()->json(['activities' =>  $member->activities()->get()]);
    }

    public function viewIFGForm(MemberDetail $member)
    {
        $mem_count = $member->dependents()->count();
        $name = $member->last_name . ", " . $member->first_name . " " . $member->middle_name;
        $address = $member->present_address;
        $contact_number = $member->mobile_no;
        $requested_by = auth()->user()->lastname . ", " . auth()->user()->firstname . " " . auth()->user()->middlename;
        $ifgForm = [
            "mem_count" => $mem_count + 1,
            "name" => $name,
            "billing_address" => $address,
            "contact_number" => $contact_number,
            "request_by" =>  $requested_by,
            "department" => "SALES",
        ];

        return response()->json(["result" => $ifgForm]);
    }

    public function storeIFGForm(MemberDetail $member, Request $request)
    {
        EndorceToMda::insert([
            "af_ifg_account_source" => $request->input('business_source'),
            "af_ifg_account_type" => $request->input('account_type'),
            "af_ifg_name" => $request->input('name'),
            "af_ifg_address" => $request->input('billing_address'),
            "af_ifg_city" => $request->input('city_province'),
            "af_ifg_contact_number" => $request->input('contact_number'),


            "af_ifg_req_by" => $request->input('request_by'),
            "af_ifg_req_dept" => $request->input('department'),

            'af_ifg_direct_sales' => $request->input('direct'),
            'af_ifg_sales_manager' => $request->input('sales_teams_manager'),
            'af_ifg_sales_remarks' => $request->input('sales_remarks'),
            'af_ifg_member_count' => $request->input('mem_count'),
            'af_ifg_acc_cac_name' => $request->input('created_by'),
        ]);
        SetupFunctions::endorseToMDA($member);

        return response()->json(['success' => 'Successfully endorced to MDA']);
    }
}
