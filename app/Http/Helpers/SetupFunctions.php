<?php


namespace App\Http\Helpers;  //this was missing in your code

use App\Models\Activity;
use App\Models\MemberDetail;

class SetupFunctions {
  public static function createActivity($activity, MemberDetail $member) {
    Activity::updateOrCreate(
        [
            "activity" => $activity,
            "member_id" => $member->id,
            "user_id" => auth()->user()->id,
        ]
        , 
        [
          "activity" => $activity,
          "member_id" => $member->id,
          "user_id" => auth()->user()->id,
        ]
    );
  }

  public static function endorseToPending(MemberDetail $member) {
    $member->update([
     "status" => "FOR REVIEW",
     "statusUser" => "FOR REVIEW",
    ]);
  }

  public static function endorseToBilling(MemberDetail $member) {
    $member->update([
     "status" => "REVIEW BY BILLING",
     "endorse_to" => "BILLING",
    ]);
    SetupFunctions::createActivity("Endorse to billing", $member);
  }

  public static function endorseToAccounting(MemberDetail $member) {
    $member->update([
     "status" => "REVIEW BY ACCOUNTING",
     "endorse_to" => "ACCOUNTING",
    ]);
    SetupFunctions::createActivity("Endorse to accounting", $member);
  }

  public static function endorseToSales(MemberDetail $member) {
    $member->update([
     "status" => "REVIEW BY SALES",
     "endorse_to" => "SALES",
    ]);
    SetupFunctions::createActivity("Endorse to sales", $member);
  }

  public static function endorseToMDA(MemberDetail $member) {
    $member->update([
      "status" => "ACTIVE",
      "endorse_to" => "MDA",
      "statusUser" => "ACTIVE"
    ]);
    $member->dependents()->update([
      "status" => "ACTIVE",
      "endorse_to" => "MDA",
      "statusUser" => "ACTIVE"
    ]);
    SetupFunctions::createActivity("Endorse to MDA", $member);
  }

  public static function endorseToMember(MemberDetail $member) {
    $member->update([
      "status" => "REVIEW BY MEMBER",
      "endorse_to" => "MEMBER",
      "statusUser" => "FOR PAYMENT"
    ]);
    SetupFunctions::createActivity("Send email for quatation", $member);
  }

  public static function approvedPaymentMember(MemberDetail $member) {
 
    $member->uploadReceipt->update([
      'status' => 'PAYMENT PAID'
    ]);

    
    SetupFunctions::createActivity("Send email for payment", $member);
  
  }

  public static function uploadedPayment(MemberDetail $member) {
    $member->update([
      "status" => "REVIEW BY SALES",
      "endorse_to" => "SALES",
      "statusUser" => "PAYMENT REVIEW"
    ]);
    SetupFunctions::createActivity("Uploaded receipt", $member);
  }

  public static function approvedPayment(MemberDetail $member){
    $member->update([
      "status" => "APPROVED PAYMENT",
    ]);
    SetupFunctions::createActivity("Successfully approved payment by the accounting", $member);
  }
}

?>