@extends('layouts.admin1')
@section('content')
<div class="section_register" style="background: #e0e0e0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-body p-4">
                        <h4 class="text-center font-weight-bold">APPLICATION FOR MEMBERSHIP</h4>
                        <h6 class="text-center font-weight-bold mb-4">4 Steps to complete your application</h6>
                        <div class="row justify-content-center">

                            <div class="col-12 mx-4">
                                <div class="mx-12">
                                    <div class="row">
                                        <div id="step1Tab" class="col-sm-3 text-center bg-primary text-white " style="cursor: pointer;">
                                            <h3>1</h3>
                                            <h6>TELL US ABOUT YOU</h6>
                                        </div>
                                        <div id="step2Tab" class="col-sm-3 text-center  " style="cursor: pointer;">
                                            <h3>2</h3>
                                            <h6>CHOOSE YOUR ACCOUNT</h6>
                                        </div>
                                        <div id="step3Tab" class="col-sm-3 text-center  " style="cursor: pointer;">
                                            <h3>3</h3>
                                            <h6>TELL US ABOUT YOUR HEATH</h6>
                                        </div>
                                        <div id="step4Tab" class="col-sm-3 text-center  " style="cursor: pointer;">
                                            <h3>4</h3>
                                            <h6>ADD YOUR DEPENDENTS</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <br>
                        <form method="post" id="registerForm" class="form-horizontal">
                            @csrf
                            <div id="step1" class="row">
                                <div class="col-sm-12">
                                    <hr class="my-2 bg-primary">
                                    <br>
                                    <h5 class="text-dark font-weight-bold">We would like to know you better</h5>
                                    <h6>Are fields marked with <span class="text-danger">( * )</span> are required</h6>

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase">Last Name <span class="text-danger">*</span></label>
                                        <input type="textarea" name="last_name" id="last_name" class="form-control" />

                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-last_name"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label  text-uppercase">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-first_name"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label  text-uppercase">Middle Name</label>
                                        <input type="text" name="middle_name" id="middle_name" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-middle_name"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">PRESENT ADDRESS <span class="text-danger">*</span></label>
                                        <input type="text" name="present_address" id="present_address" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-present_address"></strong>
                                        </span>

                                    </div>
                                </div>
                                @php
                                $present = Auth::user()->memberDetail->present_address ?? "n/a";
                                $pemanet = Auth::user()->memberDetail->permanent_address ?? "none";
                                $isSameToPresentAddress = false;
                                if($present == $pemanet){
                                $isSameToPresentAddress = true;
                                }
                                @endphp
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">PERMANENT ADDRESS <span class="text-danger">*</span></label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permanent_address_checkbox" id="permanent_address_checkbox">
                                            <label class="form-check-label" for="permanent_address_checkbox">Same to present address?</label>
                                        </div>
                                        <input type="text" name="permanent_address" id="permanent_address" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-permanent_address"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase">HOME PHONE </label>
                                        <input type="textarea" name="home_phone" id="home_phone" class="form-control" />

                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-home_phone"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label  text-uppercase">MOBILE NO. <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-mobile_no"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label  text-uppercase">EMAIL ADDRESS <span class="text-danger">*</span></label>
                                        <input type="text" name="email_address" id="email_address" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-email_address"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">PLACE OF BIRTH <span class="text-danger">*</span></label>
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-place_of_birth"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-date_of_birth"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">HEIGHT </label>
                                        <input type="input" name="height" id="height" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-height"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">WEIGHT</label>
                                        <input type="input" name="weight" id="weight" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-weight"></strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">CITIZENSHIP <span class="text-danger">*</span></label>
                                        <input type="text" name="citizenship" id="citizenship" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-citizenship"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="select2 form-control" style="width: 100%">
                                            <option value="" disabled selected>Please Select</option>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                            <option value="OTHER">OTHER</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-gender"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Civil Status <span class="text-danger">*</span></label>
                                        <select name="civil_status" id="civil_status" class="select2 form-control" style="width: 100%">
                                            <option value="" disabled selected>Please Select</option>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="WIDOWER">WIDOWER</option>
                                            <option value="LEGALLY SEPARATED">LEGALLY SEPARATED</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-civil_status"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <hr class="my-2 bg-primary">
                                        <br>
                                        <h5 class="text-dark font-weight-bold">We would like to kwow about your work or businness</h5>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">EMPLOYMENT STATUS <span class="text-danger">*</span></label>
                                            <select name="employment_status" id="employment_status" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="EMPLOYED IN PRIVATE">EMPLOYED IN PRIVATE</option>
                                                <option value="EMPLOYED IN GOVERNMENT">EMPLOYED IN GOVERNMENT</option>
                                                <option value="SELF EMPLOYED">SELF EMPLOYED</option>
                                                <option value="OFW">OFW</option>
                                                <option value="OTHERS">OTHERS</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-employment_status"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">EMPLOYER /BUSINESS NAME </label>
                                            <input type="text" name="employer_business_name" id="employer_business_name" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-employer_business_name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">NATURE OF BUSINESS</label>
                                            <input type="text" name="nature_of_business" id="nature_of_business" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-nature_of_business"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">BUSINESS ADDRESS </label>
                                            <input type="text" name="business_address" id="business_address" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-business_address"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step2">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <br>
                                        <hr class="my-2 bg-primary">
                                        <h5 class="text-dark font-weight-bold">Choose your account</h5>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">TYPE OF ACCOUNT <span class="text-danger">*</span></label>
                                            <select name="type_of_account" id="type_of_account" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select type of IFG</option>
                                                <option value="INDIVIDUAL">INDIVIDUAL</option>
                                                <option value="FAMILY">FAMILY</option>
                                                <option value="GROUP">GROUP</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-type_of_account"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">TYPE OF PROGRAM <span class="text-danger">*</span>
                                            </label> <br>
                                            <button class="btn btn-sm btn-info" id="btn_select_program" type="button">CLICK HERE TO SELECT A AVAILABLE PROGRAM</button>


                                            <div class="table-responsive" id="panel_type_of_program">
                                                <table class="table align-items-center table-flush datatable-country display text-uppercase" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>

                                                            <th>
                                                                PLANCODE
                                                            </th>
                                                            <th>
                                                                Room and Board
                                                            </th>
                                                            <th>
                                                                Agent Type
                                                            </th>
                                                            <th>
                                                                Mode of Payment
                                                            </th>
                                                            <th>
                                                                Before Vat
                                                            </th>
                                                            <th>
                                                                Member Fee
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" id="pc_plm_code" name="plm_code" readonly class="border-0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="pc_plm_room" name="plm_room" readonly class="border-0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="pc_plm_acct_type" name="plm_acct_type" readonly class="border-0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="pc_plm_mop" name="plm_mop" readonly class="border-0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="pc_plm_bvat" name="plm_bvat" readonly class="border-0">
                                                            </td>
                                                            <td>
                                                                <input type="text" id="pc_plm_mem_fee" name="plm_mem_fee" readonly class="border-0">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <input type="hidden" name="type_of_program" id="type_of_program" value="" class="form-control">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-type_of_program"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label class="control-label">UPLOAD VALID ID <span class="text-danger">*</span>
                                            </label> <br>
                                            <button class="btn btn-sm btn-info" id="btn_receipt" type="button">CLICK HERE TO UPLOAD YOUR VALID ID</button> <br>
                                            <strong class="text-success pointer receipt_view" id="btn_receipt_view">Click here to view your uploaded file</strong>

                                            <input type="hidden" name="upload_file_id" id="upload_file_id" class="form-control">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-upload_file_id"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">DENTAL <span class="text-danger">*</span></label>
                                            <select name="dental" id="dental" class="select2 form-control" style="width: 100%">
                                                <option value="1" selected>YES</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-dental"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">MEMBERSHIP TYPE <span class="text-danger">*</span></label>
                                            <select name="membership_type" id="membership_type" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please select</option>
                                                <option value="PRINCIPAL">PRINCIPAL</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-membership_type"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">



                                    <div class="col-sm-12 ">
                                        <br>
                                        <hr class="my-2 bg-primary">
                                        <h5 class="text-dark font-weight-bold">Other info</h5>
                                        <h6 class="text-dark font-weight-bold">Input their field if it is applicable.</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">PHILHEALTH NO.</label>
                                            <input type="text" name="philhealth_no" id="philhealth_no" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-philhealth_no"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">SPOUSE NAME</label>
                                            <input type="text" name="spouse_name" id="spouse_name" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-spouse_name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">SPOUSE PHILHEALTH NO.</label>
                                            <input type="text" name="spouse_philhealth_no" id="spouse_philhealth_no" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-spouse_philhealth_no"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">TELEPHONE NUMBER</label>
                                            <input type="text" name="telephone_number" id="telephone_number" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-telephone_number"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">CELLPHONE NUMBER</label>
                                            <input type="text" name="cellphone_number" id="cellphone_number" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-cellphone_number"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">NAME OF BENEFICIAL OWNER</label>
                                            <input type="text" name="name_beneficial_owner" id="name_beneficial_owner" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name_beneficial_owner"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">NAME OF BENEFICAIRY</label>
                                            <input type="text" name="name_beneficiary" id="name_beneficiary" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name_beneficiary"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">NATIONALITY</label>
                                            <input type="text" name="nationality" id="nationality" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-nationality"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">PROOF OF IDENTIFICATION</label>
                                            <input type="text" name="proof_id" id="proof_id" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-proof_id"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">SOURCE OF FUNDS OR PROPERTY</label>
                                            <input type="text" name="source_fund" id="source_fund" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-source_fund"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">TIN NUMBER</label>
                                            <input type="text" name="tin" id="tin" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-tin"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">SSS /GSIS NUMBER</label>
                                            <input type="text" name="sss_gsis" id="sss_gsis" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-sss_gsis"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <br>
                                        <hr class="my-2 bg-primary">
                                        <h5 class="text-dark font-weight-bold">WE WOULD LIKE TO KNOW ABOUT YOUR HEALTH</h5>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Were you a previos member of any HealthCare company? </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="previos_healthcare_company" id="previos_healthcare_company1" value="option1">
                                                <label class="form-check-label h6" for="previos_healthcare_company1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="previos_healthcare_company" id="previos_healthcare_company2" value="">
                                                <label class="form-check-label h6" for="previos_healthcare_company2">No</label>
                                            </div>
                                            <br>
                                            <div class="previos_healthcare_company ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please give name of company. And when did your former membership begin and end?</label>
                                                <input type="text" name="free_previos_healthcare_company" data="free_previos_healthcare_company" id="free_previos_healthcare_company" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_previos_healthcare_company"></strong>
                                                </span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Have you been treated/examined/hospitalized while a member of this HealthCare company? </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="hospitalized_previous_healthcare" id="hospitalized_previous_healthcare1" value="option1">
                                                <label class="form-check-label h6" for="hospitalized_previous_healthcare1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="hospitalized_previous_healthcare" id="hospitalized_previous_healthcare2" value="">
                                                <label class="form-check-label h6" for="hospitalized_previous_healthcare2">No</label>
                                            </div>
                                            <br>
                                            <div class="hospitalized_previous_healthcare ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please list location and last exam of treatment.</label>
                                                <input type="text" name="free_hospitalized_previous_healthcare" id="free_hospitalized_previous_healthcare" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_hospitalized_previous_healthcare"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12  ">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Have you ever been rejected for medical insurance, including HealthCare plan, or been offered insurance at a higher (rated up) premium </label>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="rejected_previous_healthcare" id="rejected_previous_healthcare1" value="option1">
                                                <label class="form-check-label h6" for="rejected_previous_healthcare1">Yes</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="rejected_previous_healthcare" id="rejected_previous_healthcare2" value="">
                                                <label class="form-check-label h6" for="rejected_previous_healthcare2">No</label>
                                            </div>
                                            <br>
                                            <div class="rejected_previous_healthcare ifYesSection">
                                                <label class="control-label h6">If yes, Please explain.</label>
                                                <input type="text" name="free_rejected_previous_healthcare" id="free_rejected_previous_healthcare" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_rejected_previous_healthcare"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Do you regularly drink alcohol</label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="drink_alcohol" id="drink_alcohol1" value="option1">
                                                <label class="form-check-label h6" for="drink_alcohol1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="drink_alcohol" id="drink_alcohol2" value="">
                                                <label class="form-check-label h6" for="drink_alcohol2">No</label>
                                            </div>
                                            <br>
                                            <div class="drink_alcohol ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please pick</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pick_drink_alcohol" id="pick_drink_alcohol1" value="Beer">
                                                    <label class="form-check-label h6" for="pick_drink_alcohol1">Beer</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pick_drink_alcohol" id="pick_drink_alcohol2" value="Wine">
                                                    <label class="form-check-label h6" for="pick_drink_alcohol2">Wine</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pick_drink_alcohol" id="pick_drink_alcohol3" value="Hard Liquor">
                                                    <label class="form-check-label h6" for="pick_drink_alcohol3">Hard Liquor</label>
                                                </div>
                                                <label class="control-label mr-10 h6">How much do you consume.</label>
                                                <input type="text" name="free_drink_alcohol" id="free_drink_alcohol" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Do you smoke?</label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="smoke_cigarettes" id="smoke_cigarettes1" value="option1">
                                                <label class="form-check-label h6" for="smoke_cigarettes1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="smoke_cigarettes" id="smoke_cigarettes2" value="">
                                                <label class="form-check-label h6" for="smoke_cigarettes2">No</label>
                                            </div>
                                            <br>
                                            <div class="smoke_cigarettes ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, How many sticks per day? And how long have you smoked</label>
                                                <input type="text" name="free_smoke_cigarettes" id="free_smoke_cigarettes" class="form-control" />
                                                <br>
                                                <label class="control-label mr-10 h6">If you quit, how many years did you smoke? And how long since you've quit</label>
                                                <input type="text" name="quit_smoke_cigarettes" id="quit_smoke_cigarettes" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  ">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Physical Exam History: Check the appropriate box state the name add address of examining M.D date of Exam. </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="physical_exam_history" id="physical_exam_history1" value="Routine Examination">
                                                <label class="form-check-label h6" for="physical_exam_history1">Routine Examination</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="physical_exam_history" id="physical_exam_history2" value="OB-GYN (Obstetrics-Gynecology)">
                                                <label class="form-check-label h6" for="physical_exam_history2">OB-GYN (Obstetrics-Gynecology)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="physical_exam_history" id="physical_exam_history3" value="Other(Please Specify)">
                                                <label class="form-check-label h6" for="physical_exam_history3">Other(Please Specify)</label>
                                            </div>
                                            <br>
                                            <div class="physical_exam_history ifYesSection">
                                                <label class="control-label mr-10 h6">Please Specify</label>
                                                <input type="text" name="free_physical_exam_history" id="free_physical_exam_history" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_physical_exam_history"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Have you ever been advised to have surgery which you have not yet undergone. </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="advised_surgery" id="advised_surgery1" value="option1">
                                                <label class="form-check-label h6" for="advised_surgery1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="advised_surgery" id="advised_surgery2" value="">
                                                <label class="form-check-label h6" for="advised_surgery2">No</label>
                                            </div>
                                            <br>
                                            <div class="advised_surgery ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please give details</label>
                                                <input type="text" name="free_advised_surgery" id="free_advised_surgery" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_advised_surgery"></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">How many times you visited a physician in the last 12 months? Please list reasons for visit (Symptoms, complaints, etc.)</label>

                                            <input type="text" name="times_visited_physician" id="times_visited_physician" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-times_visited_physician"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Have you ever been hospitalized, diagnosed, or treated for any of the following?</label>
                                            <div class="row mx-auto">
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="alcoholism" id="alcoholism">
                                                    <label class="form-check-label h6" for="alcoholism">
                                                        Alcoholism
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="heart_attack" id="heart_attack">
                                                    <label class="form-check-label h6" for="heart_attack">
                                                        Heart attack or other heart trouble
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="anemia" id="anemia">
                                                    <label class="form-check-label h6" for="anemia">
                                                        Serious anemia or other blood diseases
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="heart_murmur" id="heart_murmur">
                                                    <label class="form-check-label h6" for="heart_murmur">
                                                        heart murmur
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="arthritis" id="arthritis">
                                                    <label class="form-check-label h6" for="arthritis">
                                                        Arthritis, Gout or pailful joints
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="hypertension" id="hypertension">
                                                    <label class="form-check-label h6" for="hypertension">
                                                        Hypertension or High blood pressure
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="astma" id="astma">
                                                    <label class="form-check-label h6" for="astma">
                                                        Astma/Wheezing
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="hernia" id="hernia">
                                                    <label class="form-check-label h6" for="hernia">
                                                        Hernia surgically repaired?
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="chronic" id="chronic">
                                                    <label class="form-check-label h6" for="chronic">
                                                        Chronic cough, emphysema or other chronic lung diseases
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="immune_deficiency" id="immune_deficiency">
                                                    <label class="form-check-label h6" for="immune_deficiency">
                                                        Immune Deficiency Syndromes, Example AIDS
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="back_injury" id="back_injury">
                                                    <label class="form-check-label h6" for="back_injury">
                                                        Back ache or back injury
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="stomach" id="stomach">
                                                    <label class="form-check-label h6" for="stomach">
                                                        Ulcers of stomach or duodenum
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="disability" id="disability">
                                                    <label class="form-check-label h6" for="disability">
                                                        Serious bodily injury or disability
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="venereal" id="venereal">
                                                    <label class="form-check-label h6" for="venereal">
                                                        Venereal disease
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="cancer" id="cancer">
                                                    <label class="form-check-label h6" for="cancer">
                                                        Cancer, leukemia or tumors
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="peptic_sysptoms" id="peptic_sysptoms">
                                                    <label class="form-check-label h6" for="peptic_sysptoms">
                                                        Persistent Indigestion or peptic sysptoms
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="convulsions" id="convulsions">
                                                    <label class="form-check-label h6" for="convulsions">
                                                        Convulsions, seizures or epilepsy
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="kidney_condition" id="kidney_condition">
                                                    <label class="form-check-label h6" for="kidney_condition">
                                                        Kidney condition, Kidney stones
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="diabetes" id="diabetes">
                                                    <label class="form-check-label h6" for="diabetes">
                                                        Diabetes mellitus
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="urination" id="urination">
                                                    <label class="form-check-label h6" for="urination">
                                                        Loss of urine control, bladder problems or difficulty in urination
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="diarrhea" id="diarrhea">
                                                    <label class="form-check-label h6" for="diarrhea">
                                                        Diarrhea or colitis(chronic), rectal bleeding or other rectal ailment
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="prostate" id="prostate">
                                                    <label class="form-check-label h6" for="prostate">
                                                        Prostate problems
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="ear_problems" id="ear_problems">
                                                    <label class="form-check-label h6" for="ear_problems">
                                                        Ear problems or loss hearing
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="liver_conditions" id="liver_conditions">
                                                    <label class="form-check-label h6" for="liver_conditions">
                                                        Liver conditions
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="etitis_media" id="etitis_media">
                                                    <label class="form-check-label h6" for="etitis_media">
                                                        Tubes now present in ear for etitis media
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="paralysis" id="paralysis">
                                                    <label class="form-check-label h6" for="paralysis">
                                                        Paralysis/Strokes
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="eye_condition" id="eye_condition">
                                                    <label class="form-check-label h6" for="eye_condition">
                                                        Eye condition (cataract, iritis, etc.)
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="serious_skin" id="serious_skin">
                                                    <label class="form-check-label h6" for="serious_skin">
                                                        Serious skin disease , Melanoma, psoriasis
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="glaucoma" id="glaucoma">
                                                    <label class="form-check-label h6" for="glaucoma">
                                                        Glaucoma
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="organ_abnormality" id="organ_abnormality">
                                                    <label class="form-check-label h6" for="organ_abnormality">
                                                        Female organ abnormality
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="gall_bladder" id="gall_bladder">
                                                    <label class="form-check-label h6" for="gall_bladder">
                                                        Gall bladder stones surgically removed?
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="irregular_vaginal" id="irregular_vaginal">
                                                    <label class="form-check-label h6" for="irregular_vaginal">
                                                        Irregular vaginal bleeding
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="goiter" id="goiter">
                                                    <label class="form-check-label h6" for="goiter">
                                                        Goiter or thyroid condition
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="mental" id="mental">
                                                    <label class="form-check-label h6" for="mental">
                                                        Mental/emotional disorders psychiatric counseling
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="fever" id="fever">
                                                    <label class="form-check-label h6" for="fever">
                                                        Hay fever or allergies
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="drug_addiction" id="drug_addiction">
                                                    <label class="form-check-label h6" for="drug_addiction">
                                                        Drug addiction or abuse
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="allergy_injection" id="allergy_injection">
                                                    <label class="form-check-label h6" for="allergy_injection">
                                                        Currently on allergy injection
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-3">
                                                    <input class="form-check-input" type="checkbox" name="migraine_headache" id="migraine_headache">
                                                    <label class="form-check-label h6" for="migraine_headache">
                                                        Migraine headache
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Have you ever been treated any other condition now listed above? </label>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="treated_condition" id="treated_condition1" value="YES">
                                                <label class="form-check-label h6" for="treated_condition1">Yes</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="treated_condition" id="treated_condition2" value="">
                                                <label class="form-check-label h6" for="treated_condition2">No</label>
                                            </div>
                                            <br>
                                            <div class="treated_condition ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please give details below:.</label>
                                                <input type="text" name="free_treated_condition" id="free_treated_condition" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_treated_condition"></strong>
                                                </span>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Do you have or have you had unexplained and/or undiagnosed sysmtoms, such as weight loss, swollen glands, fever, skin lesions, rash or rectal problem? </label>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="undiagnosed_sysmtoms" id="undiagnosed_sysmtoms1" value="option1">
                                                <label class="form-check-label h6" for="undiagnosed_sysmtoms1">Yes</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input rb_question" type="radio" name="undiagnosed_sysmtoms" id="undiagnosed_sysmtoms2" value="">
                                                <label class="form-check-label h6" for="undiagnosed_sysmtoms2">No</label>
                                            </div>
                                            <br>
                                            <div class="undiagnosed_sysmtoms ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please explain.</label>
                                                <input type="text" name="free_undiagnosed_sysmtoms" id="free_undiagnosed_sysmtoms" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_undiagnosed_sysmtoms"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Are you currently taking any medications?</label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="taking_medications" id="taking_medications1" value="option1">
                                                <label class="form-check-label h6" for="taking_medications1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="taking_medications" id="taking_medications2" value="">
                                                <label class="form-check-label h6" for="taking_medications2">No</label>
                                            </div>
                                            <br>
                                            <div class="taking_medications ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Please list all medicines.</label>
                                                <input type="text" name="free_taking_medications" id="free_taking_medications" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_taking_medications"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Are any of the above conditions now present? </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="condition_present" id="condition_present1" value="option1">
                                                <label class="form-check-label h6" for="condition_present1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="condition_present" id="condition_present2" value="">
                                                <label class="form-check-label h6" for="condition_present2">No</label>
                                            </div>
                                            <br>
                                            <div class="condition_present ifYesSection">
                                                <label class="control-label mr-10 h6">If yes, Which condition(s)?</label>
                                                <input type="text" name="free_condition_present" id="free_condition_present" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_condition_present"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">Do you engage in any hazard sports or activities? </label>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="hazard_sports" id="hazard_sports1" value="option1">
                                                <label class="form-check-label h6" for="hazard_sports1">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input rb_question" type="radio" name="hazard_sports" id="hazard_sports2" value="">
                                                <label class="form-check-label h6" for="hazard_sports2">No</label>
                                            </div>
                                            <br>
                                            <div class="hazard_sports ifYesSection">
                                                <label class="control-label mr-10 h6 ">If yes, Please explain?</label>
                                                <input type="text" name="free_hazard_sports" id="free_hazard_sports" class="form-control" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-free_hazard_sports"></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mr-10 h6">State the name and address of your family physicians</label>
                                            <input type="text" name="name_physician" id="name_physician" class="form-control" />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name_physician"></strong>
                                            </span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div id="step4">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <br>
                                        <h6 class="text-dark font-weight-bold">Add your dependent if applicable</h5>

                                            <br>
                                            <br>
                                    </div>
                                    <div id="dependent_section" class=" row col-sm-12">

                                    </div>


                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between">
                                <input type="hidden" name="action" id="action" value="STEP1" />
                                <input type="hidden" name="referral" id="referral" value="{{$referral_code ?? ""}}" />
                                <input type="hidden" name="typeOfAccount" id="typeOfAccount" value="{{$typeOfAccount ?? nodata}}" />



                                <button type="button" id="action_back" class="btn btn-lg">Back</button>
                                <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-lg " value="SUBMIT" />

                            </div>
                    </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

<div class="modal" id="typeOfProgramModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header ">
                <p class="text-uppercase font-weight-bold">Select a program</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <h6 class="text-dark font-weight-bold">Click a select button to select a program </h6>
                    <hr class="my-2 bg-muted">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush datatable-table display" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        Actions
                                    </th>
                                    <th>
                                        PLANCODE
                                    </th>
                                    <th>
                                        Room and Board
                                    </th>
                                    <th>
                                        Agent Type
                                    </th>
                                    <th>
                                        Mode of Payment
                                    </th>
                                    <th>
                                        Before Vat
                                    </th>
                                    <th>
                                        Member Fee
                                    </th>

                                </tr>
                            </thead>
                            <tbody id="list_plancodes">

                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" id="transaction_back" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
            </div>

        </div>
    </div>
</div>


<form method="post" id="uploadForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="modal" id="uploadModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-id text-white text-uppercase font-weight-bold">UPLOAD YOUR FILE</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>


                <!-- Modal body -->
                <div class="modal-body">
                    <div id="modalbody" class="modalbody row">

                        <div class="col-sm-12 uploadFile">
                            <div class="form-group">
                                <strong>IMPORTANT: <br>Upload at least one(1) valid government-issued ID . <br> For school-aged dependents, upload School ID or Birth Cetificate (PSA)</strong> <br> <br>
                                <label class="control-label">Upload File <span class="text-danger">*</span></label>
                                <input type="file" name="upload_file" id="upload_file" accept="image/*" class="form-control" />
                                <input type="hidden" name="typeFile" id="typeFile" value="ids">
                                <span class="text-muted" role="alert">
                                    (File Format: jpg/png Size:Max 30 MB)
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-upload_file"></strong>
                                </span>


                                <br>


                            </div>
                        </div>
                        <div class="col-md-12 uploadedFile">
                            <img class="rounded" alt="no file" id="img_file">
                        </div>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer bg-white uploadFile">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="file_action_button" id="file_action_button" class="text-uppercase btn btn-primary" value="Upload" />
                </div>

            </div>
        </div>
    </div>
</form>


<div class="modal" id="privacy_policy" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header ">
                <p class="text-uppercase font-weight-bold">ValuCare Privacy Policy</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <hr class="my-2 bg-muted">
                    <div class="advisory" style="padding-left: 20px; padding-right: 20px; padding-bottom: 30px">
                        <br>
                        <div style="font-family: 'Lato', sans-serif; text-align:justify"><b>Value Care Health Systems, Inc. (ValuCare) </b> is fully committed to protect and respect your privacy and personal data. ValuCare recognizes its responsibilities under the <b>Republic Act No. 10173</b> otherwise known as the <i>Data Privacy Act of 2012</i>, with respect to the data it collects, records, organizes, updates, uses, consolidates or destructs from members.
                            <br>
                            <br>The personal data obtained from various sources such as from hard copy application forms or those sent via email and web portal are entered and store in the ValuCare's information and communications system and will only be accessed by authorized personnel. ValuCare has instituted appropriate organizational, technical and physical security measures to ensure the protection it commits.
                            <br>
                            <br>Your consent to share specific information will enable us to serve you better. Generally, ValuCare collects, uses, and processes your personal data in order to provide to you the health products and services that you require. This Data Privacy Policy shall explain the kind of information we collect, where said information will be used, and how we can protect your privacy.
                        </div>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> <b>ValuCare</b> shall collect information from the principal member and his/her dependent/s such as your name, email address, contact information, employee number, home address and any other data such as your civil status, birthday, gender, existing illnesses, and your relationship with the principal member that may be deemed necessary.</div>
                        <ul>
                            <li>For your identification;</li>
                            <li>For assessing your enrollment application;</li>
                            <li>For attending to your healthcare-related inquiries and services;</li>
                            <li>For informing our accredited medical providers related to your healthcare management;</li>
                            <li>For utilization report;</li>
                            <li>For billing and collection; </li>
                            <li>For updating of your pertinent information;</li>
                            <li>For informing you about <b>ValuCare</b> services, products and events;</li>
                            <li>For sending survey regarding our products and services to improve it.</li>
                        </ul>
                        <div style="font-family: 'Lato', sans-serif; text-align:left">** each must be consented by the data subject</div>
                        <div style="font-family: 'Lato', sans-serif; text-align:left">There will be cases when we will request personal data through a third party such as your employer, doctor, hospitals, clinics or other publicly available sources of information. (This is subject to a separate privacy notice from the third parties.)</div>
                        <h5 style="color:#c21710; text-align:left"><strong>Use and Disclosure</strong></h5>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> All information given to <b>ValuCare</b> will be used only for the purposes for which they were collected.
                            Your personal information may then be disclosed to the following:</div>
                        <ul>
                            <li><b>ValuCare-accredited medical providers</b> such as clinics, doctors, dentists and hospitals who shall receive the Letter of Authorization (LOA), the Laboratory/Radiology/Ultrasound Request (LUR), Consultation, Emergency Case and Dental Forms of ValuCare (duly signed by you as patient or your authorized representative) which you will hand over to the medical provider to attend and manage your health care requirements and needs.</li>
                            <li><b>ValuCare Sales and Marketing Department</b> who shall receive application forms via email, web portal and physical form. Also they shall receive survey feedback.</li>
                            <li><b>ValuCare Underwriting Department</b> who shall register said information to its database server.</li>
                            <li><b>ValuCare Customer Care Department</b> who shall attend to requested services and inquiries.</li>
                            <li><b>ValuCare Claims Administration Department</b> who shall process availment of services.</li>
                            <li><b>ValuCare ICT Department</b> who shall maintain and secure database servers.</li>
                            <li><b>ValuCare-accredited agents or brokers</b> whom you have authorized to mediate in your behalf. If applicable </li>
                            <li><b>Government or regulatory bodies</b> who may require any and all information for as long as they are authorized by law to do so.</li>
                        </ul>
                        <div style="font-family: 'Lato', sans-serif; text-align:left">** the LOA, LUR and other abovementioned ValuCare Forms contains personal data such as the patient name, birthday, age, ValuCare ID number, Company Name, if applicable and the diagnosis, if applicable.</div>
                        <h5 style="color:#c21710; text-align:left"><strong>Security</strong></h5>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> <b>ValuCare</b> gives importance to security of your personal information, and we ensure the data subjects that ValuCare placed the necessary security controls and measures to mitigate the risk of unauthorized access and disclosure as well as the misuse of personal data.</div>
                        <h5 style="color:#c21710; text-align:left"><strong>Member and Data Subjects Rights</strong></h5>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> You have the right to be informed and request for information about your personal data given to ValuCare and pertaining to personal data being processed or has been processed. You have the right to have your information corrected or removed. You also have the right to file a complaint if your personal data is unlawfully obtained or subjected to unauthorized used or unauthorized disclosure by ValuCare.</div>
                        <h5 style="color:#c21710; text-align:left"><strong>Retention</strong></h5>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> The retention of personal data shall only be as long as necessary to fulfill the specified and legitimate purposes, unless there is an existing law or regulation that specifically requires otherwise. All personal data, no longer retained is disposed in a secured manner that would prevent further processing, loss, unauthorized access or disclosure to any other party or the public.</div>
                        <h5 style="color:#c21710; text-align:left"><strong>Update on Privacy Policy</strong></h5>
                        <div style="font-family: 'Lato', sans-serif; text-align:left"> Value Care Health Systems, Inc. may, at any given time, change and update the Privacy Policy and the Terms of Use, and you shall see pertinent updates on the website. The updated privacy policy will supersede earlier version. Please check the Valucare website regularly.
                            <br>
                            <br>
                            For more information on the <b>ValuCare</b> Data Privacy Policy, you may email our Data Privacy Officer thru <a href="mailto:dpo@valuecarehealth.com?Subject=DPO Inquiry" target="_top" style="text-decoration: none; color: black">dpo@valuecarehealth.com </a>
                            <br>
                        </div>
                        <hr>
                        <br>
                        <strong>By "CLOSING THIS MODAL", you fully understand the terms and conditions of ValuCare's Data Privacy Policy and you give your full consent to the collection and processing of your personal data by ValuCare based on the terms and condition of the ValuCare Privacy Policy. Your full consent is valid for the entire period of your HMO coverage with ValuCare.
                            You may email our Data Privacy Officer to withdraw your full consent, however we may not be able to provide to you the health products or services that you have required from us.

                        </strong>
                    </div>
                </div>
                <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" id="transaction_back" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
            </div>

        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function alertPopup(title, typeOfAlert) {
        if (typeOfAlert == "success") {
            $('#success-alert').removeClass('bg-danger');
            $('#success-alert').addClass('bg-success');
        }
        if (typeOfAlert == "error") {
            $('#success-alert').removeClass('bg-success');
            $('#success-alert').addClass('bg-danger');
        }

        $('#success-alert').html('<strong> ' + title + ' </strong>');
        $("#success-alert").fadeTo(5000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    }

    function step1Tab() {
        $('#step1').show();
        $('#step2').hide();
        $('#step3').hide();
        $('#step4').hide();
        $('#action').val('STEP1');
        $('#step1Tab').addClass('bg-primary text-white');
        $('#step2Tab').removeClass('bg-primary text-white');
        $('#step3Tab').removeClass('bg-primary text-white');
        $('#step4Tab').removeClass('bg-primary text-white');
        $('#action_button').val('NEXT');

    }

    function step2Tab() {
        $('#step1').hide();
        $('#step2').show();
        $('#step4').hide();
        $('#step3').hide();
        $('#action').val('STEP2');
        $('#step1Tab').removeClass('bg-primary text-white');
        $('#step2Tab').addClass('bg-primary text-white');
        $('#step3Tab').removeClass('bg-primary text-white');
        $('#step4Tab').removeClass('bg-primary text-white');
        $('#action_button').val('NEXT');
    }

    function step3Tab() {
        $('#step1').hide();
        $('#step2').hide();
        $('#step4').hide();
        $('#step3').show();
        $('#action').val('STEP3');
        $('#step1Tab').removeClass('bg-primary text-white');
        $('#step2Tab').removeClass('bg-primary text-white');
        $('#step3Tab').addClass('bg-primary text-white');
        $('#step4Tab').removeClass('bg-primary text-white');
        $('#action_button').val('SUBMIT');
    }

    function step4Tab() {
        $('#step1').hide();
        $('#step2').hide();
        $('#step3').hide();
        $('#step4').show();
        $('#action').val('STEP4');
        $('#step1Tab').removeClass('bg-primary text-white');
        $('#step2Tab').removeClass('bg-primary text-white');
        $('#step3Tab').removeClass('bg-primary text-white');
        $('#step4Tab').addClass('bg-primary text-white');
        $('#action_button').val('ADD DEPENDENT');
    }

    $(document).on('click', '#step1Tab', function() {
        step1Tab();
    });

    $(document).on('click', '#step2Tab', function() {
        step2Tab();
    });

    $(document).on('click', '#step3Tab', function() {
        step3Tab();
    });

    $(document).on('click', '#step4Tab', function() {
        step4Tab();
    });





    var dataMember = [];

    function memberData() {
        var id = $('#referral').val();
        $.ajax({
            url: "/admin/membership/principal/" + id + "/json",
            dataType: "json",
            beforeSend: function() {


            },
            success: function(data) {
                dataMember = data.result;

                if (data.policy == true) {
                    $("#privacy_policy").modal('show');
                }
                $.each(dataMember, function(key, value) {
                    if (key == key) {
                        try {
                            $('#' + key).val(value ?? "");
                        } catch {}
                    }
                    if (key == 'gender') {
                        $('#' + key).val(value).trigger('change');
                    }
                    if (key == 'civil_status') {
                        $('#' + key).val(value).trigger('change');
                    }
                    if (key == 'employment_status') {
                        $('#' + key).val(value).trigger('change');
                    }
                    if (key == 'dental') {
                        $('#dental').val('1').trigger('change');
                    }
                    if (key == 'membership_type') {
                        $('#membership_type').val('PRINCIPAL').trigger('change')
                    }
                    if (key == 'type_of_account') {
                        $('#' + key).val(value).trigger('change');
                    }

                })


                $.each(dataMember.plancode ?? '', function(key, value) {
                    if (key == key) {
                        if (key == $('#pc_' + key).attr('name')) {
                            $('#pc_' + key).val(value)
                        }
                        if (key == "plm_code") {
                            $("#type_of_program").val(value)
                        }
                    }
                })

                if ($('#type_of_program').val() == "") {
                    $("#panel_type_of_program").hide()
                } else {
                    $("#panel_type_of_program").show()
                }




                $(".receipt_view").hide();
                try {
                    var file = dataMember.upload_file.file;
                } catch {
                    var file = "";
                }
                if (file == '') {
                    $(".receipt_view").hide()
                } else {
                    $(".receipt_view").show()
                    $('#img_file').attr('src', '/uploadedFiles/' + dataMember.upload_file.file);
                    $('#upload_file_id').val(dataMember.upload_file.file);
                }

                $.each(dataMember.member_health ?? '', function(key, value) {
                    if (key == $('[name=' + key + "]").attr('name')) {
                        if (value == true) {
                            $("#" + key + "1").prop('checked', true);
                            $("#" + key).prop('checked', true);
                            $('.' + key).show();

                        } else if (value == false) {
                            $("#" + key + "2").prop('checked', true);
                            $('.' + key).hide();
                        }
                    }
                    if (key == 'pick_drink_alcohol') {
                        if (value == "Beer") {
                            $("#" + key + "1").prop('checked', true);
                        } else if (value == "Wine") {
                            $("#" + key + "2").prop('checked', true);
                        } else if (value == "Hard Liquor") {
                            $("#" + key + "3").prop('checked', true);
                        }
                    }
                    if (key == 'physical_exam_history') {
                        if (value == "Routine Examination") {
                            $("#" + key + "1").prop('checked', true);
                            $('.' + key).hide();
                        } else if (value == "OB-GYN (Obstetrics-Gynecology)") {
                            $("#" + key + "2").prop('checked', true);
                            $('.' + key).hide();
                        } else if (value == "Other(Please Specify)") {
                            $("#" + key + "3").prop('checked', true);
                            $('.' + key).show();
                        } else {
                            $('.' + key).hide();
                        }
                    }
                    if (key == key) {
                        $('#' + key).val(value)
                    }


                })
            }




        })
    };


    function dataDependents() {
        var id = $('#referral').val();
        $.ajax({
            url: "/admin/membership/principal/" + id + "/json",
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                var dependent = '';

                try {
                    console.log(data.dependents.le)
                    if (data.dependents.length < 1) {
                        dependent +=
                            `
                            <div class="col-xl-12 mb-4">
                                    <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded" style="background: #e0e0e0;">
                                                <div class="card-body">
                                                    <div class="align-items-center text-center">
                                                      <h4>No dependent register</h4>  
                                                    </div>
                                                </div>
                                    </div>
                            </div>
                        `;
                    } else {
                        console.log(data.dependents)
                        $.each(data.dependents, function(key, value) {
                            dependent +=
                                `
                            <div class="col-xl-6 mb-4">
                                    <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded" style="background: #e0e0e0;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                        <p class="fw-bold mb-1 text-dark h4">` + value.last_name + `, ` + value.first_name + `(` + value.middle_name + `)</p>
                                                        <p class="text-dark mb-0 h6">` + value.membership_type + `</p>
                                                        </div>
                                                    </div>
                                                    <span class="badge rounded-pill badge-warning">` + value.statusUser + `</span>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
                                                    <a
                                                    class="btn btn-link m-0 text-reset text-info h6"
                                                    href="/admin/membership/dependent/` + value.referral_code + `" target="_blank"
                                                    role="button"
                                                    data-ripple-color="primary"
                                                    data-mdb-ripple-init
                                                    >Update</a>
                                                    <a
                                                    class="btn btn-link m-0 text-reset text-danger h6"
                                                    href="#"
                                                    role="button"
                                                    data-ripple-color="primary"
                                                    data-mdb-ripple-init
                                                    >Remove</i
                                                    ></a>
                                                </div>
                                    </div>
                            </div>
                        `;
                        });
                    }

                } catch {

                }

                $('#dependent_section').empty().append(dependent);
            }
        })
    }

    function dataPlancodes() {
        $.ajax({
            url: "/admin/memberships/plancodes",
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                var list = "";
                $.each(data.result, function(key, value) {
                    list +=
                        `
                        <tr id="selectProgram` + value.pl_code + `">
                            <td>
                                <button class="btn btn-sm btn-success btnSelectedProgram" 
                                pl_code="` + value.pl_code + `"
                                room_type="` + value.room_type + `"
                                room_type="` + value.room_type + `"
                                pl_account_type="` + value.pl_account_type + `"
                                pl_mop_desc="` + value.pl_mop_desc + `"
                                pl_bvat="` + value.pl_bvat + `"
                                pl_mem_fee="` + value.pl_mem_fee + `"
                                >SELECT</button>
                            </td>
                            <td>
                               ` + value.pl_code + `
                            </td>
                            <td>
                                ` + value.room_type + `
                            </td>
                            <td>
                                ` + value.pl_account_type + `
                            </td>
                            <td>
                                ` + value.pl_mop_desc + `
                            </td>
                            <td>
                                ` + parseInt(value.pl_bvat).toLocaleString() + `
                            </td>
                            <td>
                                ` +  parseInt(value.pl_mem_fee).toLocaleString() + `
                            </td>
                        </tr>
                    `;

                });
                $('#list_plancodes').empty().append(list);
            }
        })
    }


    $.urlParam = function(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        return decodeURI(results[1]) || 0;
    }


    $(document).ready(function() {


        step1Tab();
        memberData();




        dataDependents();
        dataPlancodes();
        // step3Data();  

        let step = $.urlParam('step');
        if (step == 4) {
            step4Tab();
        }




    });


    $("#permanent_address_checkbox").change(function() {
        if (this.checked) {
            $('#permanent_address').val($('#present_address').val());
        }
    });

    $(".rb_question").change(function() {
        var test = $(this).attr('name');
        if (test == 'physical_exam_history') {
            if ($("#" + test + "1").is(":checked")) {
                $('.' + test).hide();
            } else if ($("#" + test + "2").is(":checked")) {
                $('.' + test).hide();
            } else {
                $('.' + test).show();
            }
        } else {
            if ($("#" + test + "1").is(":checked")) {
                $('.' + test).show();
            } else {
                $('.' + test).hide();
            }
        }

    });


    $(document).on('click', '#btn_receipt', function() {
        $('#uploadModal').modal('show');
        $('.form-control').removeClass('is-invalid')
        $('.uploadFile').show();
        $('.uploadedFile').hide();
    });
    $(document).on('click', '#btn_receipt_view', function() {
        $('#uploadModal').modal('show');
        $('.form-control').removeClass('is-invalid')
        $('.uploadFile').hide();
        $('.uploadedFile').show();
    });

    var memberID = "";
    $('#uploadForm').on('submit', function(event) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        var id = $('#referral').val();
        var action_url = "/admin/membership/upload/" + memberID;
        var type = "POST";

        $.ajax({
            url: action_url,
            method: type,
            dataType: "json",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#file_action_button").attr("disabled", true);
            },
            success: function(data) {
                $("#file_action_button").attr("disabled", false);
                if (data.errors) {
                    $.each(data.errors, function(key, value) {
                        if (key == $('#' + key).attr('id')) {
                            $('#' + key).addClass('is-invalid')
                            $('#error-' + key).text(value)
                        }
                    })
                }
                if (data.success) {
                    console.log(data.file);
                    $('#img_file').attr('src', '/uploadedFiles/' + data.file);
                    $('#upload_file_id').val(data.file);
                    $(".receipt_view").show()
                    $('#uploadModal').modal('hide');
                    $('.form-control').removeClass('is-invalid')
                    return alertPopup(data.success, 'success');
                }
            }
        });

    });

    $('#registerForm').on('submit', function(event) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        var id = $('#referral').val();
        var action = $('#action').val();
        var action_url = "";
        var type = "";

        if (action == "STEP1") {
            action_url = "/admin/member/" + id + "/" + "STEP1";
            type = "PUT";
        }
        if (action == "STEP2") {
            action_url = "/admin/member/" + id + "/" + "STEP2";
            type = "PUT";
        }
        if (action == "STEP3") {
            action_url = "/admin/member/" + id + "/" + "STEP3";
            type = "PUT";
        }
        if (action == "STEP4") {
            action_url = "/admin/membership/principal/" + id + "/json";
            type = "GET";
        }


        $.ajax({
            url: action_url,
            method: type,
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $("#action_button").attr("disabled", true);
            },
            success: function(data) {
                $("#action_button").attr("disabled", false);

                if (data.errors) {
                    $.each(data.errors, function(key, value) {
                        if (key == $('#' + key).attr('id')) {
                            $('#' + key).addClass('is-invalid')
                            $('#error-' + key).text(value)
                        }
                        return alertPopup('Validation errors', 'error');
                    })
                }

                if (data.status == "STEP2") {
                    memberID = data.memberId;
                    step2Tab();
                    return alertPopup(data.success, 'success');
                }
                if (data.status == "STEP3") {
                    step3Tab();
                    return alertPopup(data.success, 'success');
                }
                if (data.status == "DONE") {
                    //$('#saveRecordModal').modal('show');
                    var id = data.memberId;
                    $.confirm({
                        title: 'Confirmation',
                        content: 'You really want to save this record?',
                        type: 'blue',
                        buttons: {
                            confirm: {
                                text: 'confirm',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function() {
                                    return $.ajax({
                                        url: "/admin/saveByUser/" + id,
                                        method: 'PUT',
                                        data: {
                                            _token: '{!! csrf_token() !!}',
                                        },
                                        dataType: "json",
                                        beforeSend: function() {

                                        },
                                        success: function(data) {
                                            if (data.success) {
                                                step4Tab();
                                                return alertPopup(data.success, 'success');

                                            }
                                        }
                                    })
                                }
                            },
                            cancel: {
                                text: 'cancel',
                                btnClass: 'btn-red',
                                keys: ['enter', 'shift'],
                            }
                        }
                    });
                }
                if (data.status == 'ADDDEPENDENT') {
                    var dependent = data.dependents.length + 1

                    window.open("/admin/membership/dependent/" + $('#referral').val() + dependent, '_blank');
                }
            }
        });


    });


    $(document).on('click', '#action_back', function() {
        var action = $('#action').val();
        if (action == "STEP1") {
            //step1Tab();
        }
        if (action == "STEP2") {
            step1Tab();
        }
        if (action == "STEP3") {
            step2Tab();
        }
        if (action == "STEP4") {
            step3Tab();
        }
    });



    $(document).on('click', '#btn_select_program', function() {
        $('#typeOfProgramModal').modal('show');

        $('.datatable-table').DataTable({
            pageLength: 10,
            "scrollX": true,
            "sScrollXInner": "100%",
            "bDestroy": true,
            buttons: [],
        })

    });

    $(document).on('click', '.btnSelectedProgram', function() {
        var pl_code = $(this).attr('pl_code');
        var room_type = $(this).attr('room_type');
        var pl_account_type = $(this).attr('pl_account_type');
        var pl_mop_desc = $(this).attr('pl_mop_desc');
        var pl_bvat = $(this).attr('pl_bvat');
        var pl_mem_fee = $(this).attr('pl_mem_fee');

        $("#type_of_program").val(pl_code)
        $("#pc_plm_code").val(pl_code);
        $("#pc_plm_room").val(room_type);
        $("#pc_plm_acct_type").val(pl_account_type);
        $("#pc_plm_mop").val(pl_mop_desc);
        $("#pc_plm_bvat").val(parseInt(pl_bvat).toLocaleString());
        $("#pc_plm_mem_fee").val(parseInt(pl_mem_fee).toLocaleString());
        $("#panel_type_of_program").show();
        $("#typeOfProgramModal").modal('hide');
    });




    $(document).on('click', '#btn_create_dependent', function() {

        var id = $('#referral').val();
        $.ajax({
            url: "/admin/membership/principal/" + id + "/json",
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                window.location = "/admin/membership/dependent/" + id + data.dependents.length;
            }
        })

    });
</script>
@endsection