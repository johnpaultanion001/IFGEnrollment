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

class TransactionSummaryReportController extends Controller
{
    public function transaction_summary_report(){
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('administration.staff.transaction_summary_report.transaction_summary_report');
    }
    public function transaction_summary_report_load(){
        $transactions = Transaction::where('isConfirm' , 1)->latest()->get();
        $title_filter= 'ALL REPORTS'; 
        return view('administration.staff.transaction_summary_report.loadtransaction', compact('transactions','title_filter'));
    }
    public function transaction_summary_report_filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter        = $request->get('filter');
        if($filter == 'status'){
            if($request->get('value') == 0){
                $title = 'SENDING';
            }elseif(($request->get('value') == 1)){
                $title = 'READY FOR PICKUP';
            }elseif(($request->get('value') == 2)){
                $title = 'CLAIMED';
            }
            
            $transactions = Transaction::where('isConfirm' , 1)->where('status', $request->get('value'))->latest()->get();
            $title_filter  = 'STATUS: ' . $title;
        }
        if($filter == 'payment'){
            if($request->get('value') == 0){
                $title = 'UNPAID';
            }elseif(($request->get('value') == 1)){
                $title = 'PAID';
            }
            $transactions = Transaction::where('isConfirm' , 1)->where('isPaid', $request->get('value'))->latest()->get();
            $title_filter  = 'PAYMENT: ' . $title;
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');

            $title_filter  =  'From: '.date('M j , Y', strtotime($from)). ' To: ' .date('M j , Y', strtotime($to));
            $transactions       =   Transaction::where('isConfirm' , 1)->latest()->whereBetween('created_at', [$from, $to])->get();
        }

        return view('administration.staff.transaction_summary_report.loadtransaction', compact('transactions','title_filter'));
    }
}
