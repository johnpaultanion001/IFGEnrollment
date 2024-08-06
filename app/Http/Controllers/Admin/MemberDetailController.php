<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\MemberDetail;
use App\Models\MemberPlanCode;
use App\Models\PlanCodeForIFGModel;
use App\Models\MemberDetailHealth;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use App\Http\Helpers\SetupFunctions;
use App\Models\FileReceipt;
use App\Models\FileUpload;
use File;
use DB;

class MemberDetailController extends Controller
{
    public function index($typeOfAccount, $referral_code)
    {
        if ($typeOfAccount == 'principal') {
            return view('member.principal_membership', compact('typeOfAccount', 'referral_code'));
        } else {

            return view('member.dependent_membership', compact('typeOfAccount', 'referral_code'));
        }

    }

    public function plancodesForIFG(){
        $plancodes =  DB::connection('second_db')->select(
            "SELECT a.pl_code, a.pl_desc, CASE WHEN pl_account_type = 'A' THEN 'AGENT' WHEN pl_account_type = 'B' THEN 'BROKER' WHEN pl_account_type = 'D' THEN 'DIRECT' ELSE '--' END AS pl_account_type, b.room_type,
            a.pl_mop_desc, a.pl_bvat, a.pl_evat, a.pl_mem_fee FROM CH_Plans a LEFT JOIN plan_room_type b ON a.pl_room_type = b.room_code WHERE pl_corporifg = 'IFG'"
           );

        return response()->json(['result' => $plancodes]);
    }
    public function getMemberData($type, $referral_code)
    {

        $member = MemberDetail::where('referral_code', $referral_code)->first();
        $policy = true;
        if ($member == null) {
            $policy = true;
            $memberDetail = "";
        } else {

            if ($type == 'principal') {
                $memberDetail = MemberDetail::with('plancode')->with('memberHealth')->with('uploadFile')->where('referral_code', $referral_code)->where('principal_id', 0)->first();
                $dependents = MemberDetail::with('plancode')->with('memberHealth')->where('principal_id', $memberDetail->id)->where('isSaveByUser', true)->latest()->get();
            } else {
                $memberDetail = MemberDetail::with('plancode')->with('memberHealth')->with('uploadFile')->where('referral_code', $referral_code)->first();
                $dependents = "";
            }

            if ($memberDetail->isSaveByUser == true) {
                $policy = false;
            }
        }


        return response()->json(['result' => $memberDetail, 'dependents' => $dependents ?? '', 'status' => 'ADDDEPENDENT', 'policy' => $policy]);
    }





    public function store(Request $request,  $referral_code, $step)
    {
        if ($step == "STEP1") {
            $validated =  Validator::make($request->all(), [
                //Step 1 validation
                'last_name' => ['required'],
                'first_name' => ['required'],
                'present_address' => ['required'],
                'permanent_address' => ['required'],
                'mobile_no' => ['required'],
                'email_address' => ['required', 'email'],
                'place_of_birth' => ['required'],
                'date_of_birth' => ['required', 'date', 'before:today'],
                'citizenship' => ['required'],
                'gender' => ['required'],
                'civil_status' => ['required'],
                'employment_status' => ['required'],
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }


            if ($request->input('typeOfAccount') == 'principal') {
                $principal = 0;
            } else {
                $principal = auth()->user()->memberDetail->id ?? '';
            }

            $member =  MemberDetail::updateOrCreate(
                [
                    'referral_code' =>  $referral_code,
                    'principal_id' => $principal,
                ],
                [
                    "last_name" => $request->input('last_name'),
                    "first_name" => $request->input('first_name'),
                    "middle_name" => $request->input('middle_name'),
                    "present_address" => $request->input('present_address'),
                    "permanent_address" => $request->input('permanent_address'),
                    "home_phone" => $request->input('home_phone'),
                    "mobile_no" => $request->input('mobile_no'),
                    "email_address" => $request->input('email_address'),
                    "place_of_birth" => $request->input('place_of_birth'),
                    "date_of_birth" => $request->input('date_of_birth'),
                    "height" => $request->input('height'),
                    "weight" => $request->input('weight'),
                    "citizenship" => $request->input('citizenship'),
                    "gender" => $request->input('gender'),
                    "civil_status" => $request->input('civil_status'),
                    "employment_status" => $request->input('employment_status'),
                    "employer_business_name" => $request->input('employer_business_name'),
                    "nature_of_business" => $request->input('nature_of_business'),
                    "business_address" => $request->input('business_address'),
                ]
            );

            SetupFunctions::createActivity(
                "Successfully completed step 1 of " . $request->input('typeOfAccount') . " registration",
                $member,
            );

            return response()->json(['success' => "GREAT ! <br> NOW CHOOSE YOUR ACCOUNT", 'status' => "STEP2", 'memberId' => $member->id]);
        }

        if ($step == "STEP2") {
            $validated =  Validator::make($request->all(), [
                //Step 1 validation
                'type_of_account' => ['required'],
                'type_of_program' => ['required'],
                'membership_type' => ['required'],
                'upload_file_id' => ['required'],

            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }

            if ($request->input('typeOfAccount') == 'principal') {
                $principal = 0;
            } else {
                $principal = auth()->user()->memberDetail->id ?? '';
            }


            $member =  MemberDetail::updateOrCreate(
                [
                    'referral_code' =>  $referral_code,
                    'principal_id' => $principal,
                ],
                [
                    "type_of_account" => $request->input('type_of_account'),
                    "type_of_program" => $request->input('type_of_program'),
                    "dental" => $request->input('dental'),
                    "membership_type" => $request->input('membership_type'),
                    "philhealth_no" => $request->input('philhealth_no'),
                    "spouse_name" => $request->input('spouse_name'),
                    "spouse_philhealth_no" => $request->input('spouse_philhealth_no'),
                    "telephone_number" => $request->input('telephone_number'),
                    "cellphone_number" => $request->input('cellphone_number'),
                    "name_beneficial_owner" => $request->input('name_beneficial_owner'),
                    "name_beneficiary" => $request->input('name_beneficiary'),
                    "nationality" => $request->input('nationality'),
                    "proof_id" => $request->input('proof_id'),
                    "source_fund" => $request->input('source_fund'),
                    "tin" => $request->input('tin'),
                    "sss_gsis" => $request->input('sss_gsis'),
                ]
            );
            

            MemberPlanCode::updateOrCreate(
                [
                    'member_id' =>  $member->id,
                ],
                [
                    'plm_code' => $request->input('plm_code'),
                    'plm_room'=> $request->input('plm_room'),
                    'plm_acct_type'=> $request->input('plm_acct_type'),
                    'plm_mop' => $request->input('plm_mop'),
                    'plm_bvat' => $request->input('plm_bvat'),
                    'plm_mem_fee' => $request->input('plm_mem_fee'),
                    'member_id' =>  $member->id,
                ],
            );

            SetupFunctions::createActivity(
                "Successfully completed step 2 of " . $request->input('typeOfAccount') . " registration",
                $member
            );

            return response()->json(
                [
                    'success' => "ALMOST DONE ! <br> NOW TELL US ABOUT YOUR HEATH",
                    'status' => "STEP3"
                ]
            );
        }

        if ($step == "STEP3") {
            if ($request->input('typeOfAccount') == 'principal') {
                $memberDetail = MemberDetail::where('principal_id', 0)->where('referral_code', $referral_code)->first();
            } else {
                $memberDetail = MemberDetail::where('principal_id', auth()->user()->memberDetail->id)->where('referral_code', $referral_code)->first();
            }

            MemberDetailHealth::updateOrCreate(
                [
                    'member_id' =>  $memberDetail->id,
                ],
                [
                    "previos_healthcare_company" => $request->input('previos_healthcare_company') == null ? false : true,
                    "free_previos_healthcare_company" => $request->input('free_previos_healthcare_company'),
                    "hospitalized_previous_healthcare" => $request->input('hospitalized_previous_healthcare') == null ? false : true,
                    "free_hospitalized_previous_healthcare" => $request->input('free_hospitalized_previous_healthcare'),
                    "rejected_previous_healthcare" => $request->input('rejected_previous_healthcare') == null ? false : true,
                    "free_rejected_previous_healthcare" => $request->input('free_rejected_previous_healthcare'),
                    "drink_alcohol" => $request->input('drink_alcohol') == null ? false : true,
                    "pick_drink_alcohol" => $request->input('pick_drink_alcohol'),
                    "free_drink_alcohol" => $request->input('free_drink_alcohol'),
                    "smoke_cigarettes" => $request->input('smoke_cigarettes') == null ? false : true,
                    "free_smoke_cigarettes" => $request->input('free_smoke_cigarettes'),
                    "quit_smoke_cigarettes" => $request->input('quit_smoke_cigarettes'),
                    "physical_exam_history" => $request->input('physical_exam_history'),
                    "free_physical_exam_history" => $request->input('free_physical_exam_history'),
                    "advised_surgery" => $request->input('advised_surgery') == null ? false : true,
                    "free_advised_surgery" => $request->input('free_advised_surgery'),
                    "times_visited_physician" => $request->input('times_visited_physician'),

                    "alcoholism" => $request->input('alcoholism') == null ? false : true,
                    "heart_attack" => $request->input('heart_attack') == null ? false : true,
                    "anemia" => $request->input('anemia') == null ? false : true,
                    "heart_murmur" => $request->input('heart_murmur') == null ? false : true,
                    "arthritis" => $request->input('arthritis') == null ? false : true,
                    "hypertension" => $request->input('hypertension') == null ? false : true,
                    "astma" => $request->input('astma') == null ? false : true,
                    "hernia" => $request->input('hernia') == null ? false : true,
                    "chronic" => $request->input('chronic') == null ? false : true,
                    "immune_deficiency" => $request->input('immune_deficiency') == null ? false : true,
                    "back_injury" => $request->input('back_injury') == null ? false : true,
                    "stomach" => $request->input('stomach') == null ? false : true,
                    "disability" => $request->input('disability') == null ? false : true,
                    "venereal" => $request->input('venereal') == null ? false : true,
                    "cancer" => $request->input('cancer') == null ? false : true,
                    "convulsions" => $request->input('convulsions') == null ? false : true,
                    "kidney_condition" => $request->input('kidney_condition') == null ? false : true,
                    "diabetes" => $request->input('diabetes') == null ? false : true,
                    "urination" => $request->input('urination') == null ? false : true,
                    "diarrhea" => $request->input('diarrhea') == null ? false : true,
                    "prostate" => $request->input('prostate') == null ? false : true,
                    "ear_problems" => $request->input('ear_problems') == null ? false : true,
                    "liver_conditions" => $request->input('liver_conditions') == null ? false : true,
                    "etitis_media" => $request->input('etitis_media') == null ? false : true,
                    "paralysis" => $request->input('paralysis') == null ? false : true,
                    "eye_condition" => $request->input('eye_condition') == null ? false : true,
                    "serious_skin" => $request->input('serious_skin') == null ? false : true,
                    "glaucoma" => $request->input('glaucoma') == null ? false : true,
                    "organ_abnormality" => $request->input('organ_abnormality') == null ? false : true,
                    "gall_bladder" => $request->input('gall_bladder') == null ? false : true,
                    "irregular_vaginal" => $request->input('irregular_vaginal') == null ? false : true,
                    "goiter" => $request->input('goiter') == null ? false : true,
                    "mental" => $request->input('mental') == null ? false : true,
                    "fever" => $request->input('fever') == null ? false : true,
                    "drug_addiction" => $request->input('drug_addiction') == null ? false : true,
                    "migraine_headache" => $request->input('migraine_headache') == null ? false : true,

                    "treated_condition" => $request->input('treated_condition') == null ? false : true,
                    "free_treated_condition" => $request->input('free_treated_condition'),
                    "undiagnosed_sysmtoms" => $request->input('undiagnosed_sysmtoms') == null ? false : true,
                    "free_undiagnosed_sysmtoms" => $request->input('free_undiagnosed_sysmtoms'),
                    "taking_medications" => $request->input('taking_medications') == null ? false : true,
                    "free_taking_medications" => $request->input('free_taking_medications'),
                    "condition_present" => $request->input('condition_present') == null ? false : true,
                    "free_condition_present" => $request->input('free_condition_present'),
                    "hazard_sports" => $request->input('hazard_sports') == null ? false : true,
                    "free_hazard_sports" => $request->input('free_hazard_sports'),
                    "name_physician" => $request->input('name_physician'),

                ]
            );
            SetupFunctions::createActivity(
                "Successfully completed step 3 of " . $request->input('typeOfAccount') . " registration",
                $memberDetail,
            );

            return response()->json(['success' => "Thanks you", 'status' => "DONE", 'memberId' => $memberDetail->id]);
        }
    }

    public function uploadFile(Request $request, MemberDetail $memberDetail)
    {

        $validated =  Validator::make(
            $request->all(),
            $request->input('typeFile') == "receipt" ?
                [
                    'upload_file' => ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040', 'required'],
                    'reference_number' => ['required'],
                    'amount_paid' => ['required'],
                ] : [
                    'upload_file' => ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040', 'required'],
                ]
        );
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $fileUpload = $memberDetail->uploadFile->file ?? "";
        $lastName = strtoupper($memberDetail->last_name ?? "no_last_name");
        $referralCode = strtoupper($memberDetail->referral_code ?? "no_referral_code");

        File::delete(public_path('uploadedFiles/' . $fileUpload));

        $file = $request->file('upload_file');
        $extension = $file->getClientOriginalExtension();
        $file_name_to_save = "FILE_" . $lastName . "_" . $referralCode . "." . $extension;

        if ($request->input('typeFile') == "receipt") {
            $file->move('uploadedReceipts', $file_name_to_save);
            $file = FileReceipt::updateOrCreate(
                [
                    "user_id" => $memberDetail->user->id,
                    "member_id" => $memberDetail->id,
                ],
                [
                    "file" => $file_name_to_save,
                    "reference_number" => $request->input('reference_number'),
                    "amount_paid" =>  $request->input('amount_paid'),
                    "user_id" =>  $memberDetail->user->id,
                    "member_id" => $memberDetail->id,
                ]
            );
            SetupFunctions::uploadedPayment($memberDetail);
        } else {
            $file->move('uploadedFiles', $file_name_to_save);
            $file = FileUpload::updateOrCreate(
                [
                    "user_id" => auth()->user()->id,
                    "member_id" => $memberDetail->id,
                ],
                [
                    "file" => $file_name_to_save,
                    "user_id" => auth()->user()->id,
                    "member_id" => $memberDetail->id,
                ]
            );
        }

        return response()->json(['success' => 'Successfully uploaded', 'file' => $file->file]);
    }

    public function saveByUser(MemberDetail $memberDetail)
    {
        $memberDetail->update([
            'isSaveByUser' => true,
        ]);
        SetupFunctions::endorseToPending($memberDetail);
        SetupFunctions::createActivity(
            "Successfully saved the membership registration",
            $memberDetail,
        );

        return response()->json(['success' => "Thanks you, Succesfully saved", "referral_code" => $memberDetail->principal->referral_code ?? ""]);
    }
}
