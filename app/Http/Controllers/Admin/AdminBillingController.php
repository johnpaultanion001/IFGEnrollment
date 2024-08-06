<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberDetail;
use App\Models\Quatation;
use Illuminate\Http\Request;
use App\Http\Helpers\SetupFunctions;

class AdminBillingController extends Controller
{
    public function index(){
        $memberDetails = MemberDetail::where('isSaveByUser', true)->where('endorse_to', 'BILLING')->latest()->get();
        return view('admin_billing.admin_billing' , compact('memberDetails'));
    }

    public function viewQuatation(MemberDetail $member){
        $principal = MemberDetail::with('plancode')->where('id', $member->id)->where('isSaveByUser', true)->first();
        $dependents = MemberDetail::with('plancode')->where('principal_id', $principal->id)->where('isSaveByUser', true)->latest()->get();

        $uploaded_by = [];
        $principal_data = [];
        $dependents_data = [];
        $charges_data = [];
        $receipt_data = [];
        $subtotal = 0;
        $total = 0;
        $count = $principal->quatations()->count();
        $isQuatation = false;
        if($principal->quatations()->count() < 1){
            $count++;
            $principal_data =  [
                "qid" => $count,
                "id" => $principal->id,
                "item" => $principal->last_name .", ".$principal->first_name." (".$principal->middle_name.") - ".$principal->plancode->plm_code." (".$principal->plancode->plm_room.") x 1",
                "amount" => (double)$principal->plancode->plm_mem_fee ?? 0,
                "type" => 'principal',
            ];

            foreach($dependents as $dependent){
                $amt = str_replace( ',', '', $dependent->plancode->plm_mem_fee );
                $count++;
                $data = [
                    "qid" => $count,
                    "id" => $principal->id,
                    "item" => $dependent->last_name .", ".$dependent->first_name." (".$dependent->middle_name.") - ".$dependent->plancode->plm_code." (".$dependent->plancode->plm_room.") x 1",
                    "amount" => (double)$amt ?? 0,
                    "type" => 'dependent',
                ];
                
                $subtotal += $data['amount'];
                array_push($dependents_data, $data);
            }
            $subtotal +=  (double)$principal->plancode->plm_mem_fee;
            $total = $subtotal;
            $isQuatation = false;
        }else{
            foreach($principal->quatations()->get() as $quats){
                if($quats->type == "principal"){
                    $principal_data =  [
                        "qid" => $quats->id,
                        "id" => $quats->member_id,
                        "item" => $quats->item,
                        "amount" => (double) $quats->amount,
                        "type" => 'principal',
                    ];
                }
                if($quats->type == "dependent"){
                    $data =  [
                        "qid" => $quats->id,
                        "id" => $quats->member_id,
                        "item" => $quats->item,
                        "amount" => (double) $quats->amount,
                        "type" => 'dependent',
                    ];
                    array_push($dependents_data, $data);
                }
                if($quats->type == "addCharge"){
                    $data =  [
                        "qid" => $quats->id,
                        "id" => $quats->member_id,
                        "item" => $quats->item,
                        "amount" => (double) $quats->amount,
                        "type" => 'addCharge',
                    ];
                    array_push($charges_data, $data);
                }
            }
            $subtotal = $principal->quatations()->whereIn('type',['dependent', 'principal'])->get()->sum('amount');
            $total = $principal->quatations()->get()->sum('amount');
            $isQuatation = true;

            if($principal->uploadReceipt){
                $receipt_data =  [
                    "payment_status" => $principal->uploadReceipt->status ?? '',
                    "file_uploaded" => $principal->uploadReceipt->file ?? '',
                    "reference_number" => $principal->uploadReceipt->reference_number ?? '',
                    "amount_paid" => $principal->uploadReceipt->amount_paid ?? '',
                    "date_uploaded" => $principal->uploadReceipt->created_at->format('M j , Y h:i A'),
                    
                ];
            }
            $quatation_uploaded_by = $principal->activities()->where('activity', "Successfully updated quatation")->first(); 
            $last_send_email_for_quatation = $principal->activities()->where('activity', "Send email for quatation")->first();
            $last_send_email_for_payment = $principal->activities()->where('activity', "Send email for payment")->first();
            $approved_by_accounting = $principal->activities()->where('activity', "Successfully approved payment by the accounting")->first();


            if($quatation_uploaded_by){
                $quatation_uploaded_by  = "Updated By " . $quatation_uploaded_by->user->firstname  ." ".$quatation_uploaded_by->user->lastname ." - " ."BILLING DEPT at " . $quatation_uploaded_by->created_at->format('M j , Y');
            }
            if($last_send_email_for_quatation){
                $last_send_email_for_quatation = "Last notify " . $last_send_email_for_quatation->created_at->format('M j , Y h:i A') ;
            }
            if($last_send_email_for_payment){
                $last_send_email_for_payment = "Last notify " . $last_send_email_for_payment->created_at->format('M j , Y h:i A') ;
            } 
            if($approved_by_accounting){
                $approved_by_accounting = "Approved By " . $approved_by_accounting->user->firstname  ." ".$approved_by_accounting->user->lastname ." - " ."ACCOUNTING DEPT at " . $approved_by_accounting->created_at->format('M j , Y');
            }
            $uploaded_by = [
                "quatation_uploaded_by" => $quatation_uploaded_by,
                "last_send_email_for_quatation" => $last_send_email_for_quatation,
                "last_send_email_for_payment" => $last_send_email_for_payment,
                "approved_by_accounting" => $approved_by_accounting,
            ];
        
        }

       
        
        $member_data = [
            "name" => $principal->last_name .", ".$principal->first_name." (".$principal->middle_name.")",
            "principal" => $principal_data,
            "dependents" => $dependents_data,
            "charges" => $charges_data,
            "subtotal" => number_format($subtotal,2),
            "total" =>  number_format($total,2),
            "isQuatation" => $isQuatation,
            "receipt_data" => $receipt_data,
            "uploaded_by" => $uploaded_by,
        ];

        return response()->json(["result" => $member_data]);
    }


    public function storeQuatation(Request $request, MemberDetail $member){
    
         foreach(request('qmember') as $item){
                if($item['item'] == null || $item['item'] == ""){
                    if($item['type'] == 'addCharge'){
                        Quatation::where('id', $item['qid'])->delete();
                    }
                }else{
                    Quatation::updateOrCreate(
                        [
                            'id' => $item['qid'],
                            'member_id' => $item['id'],
                        ],
                        [
                            'member_id' => $item['id'],
                            'item' => $item['item'],
                            'amount' => $item['amount'],
                            'type' => $item['type'], 
                            'isAddCharge' => $item['type'] == 'addCharge' ? true:false,
                        ]
                    );
                }
       
          }

        SetupFunctions::createActivity(
            "Successfully updated quatation",
            $member,
        );

        return response()->json(['success' => "Successfully updated quatation", "memberID" => $member->id]);
    
    }

}
