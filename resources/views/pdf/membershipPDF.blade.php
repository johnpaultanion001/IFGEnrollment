<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFG Membership Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        .form-control {
            border: 1px solid #111 !important;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header" style="background-color: #910000 !important;">
            <img src="{{ asset('images/vclogo/vc_logo.png') }}" alt="" width="200" hieght="200" />
        </div>
        <div class="card-body m-3">
            <div class="row">
                <div class="col-sm-12">
                    <hr class="my-2" style="background-color: #910000 !important;">
                    <br>
                    <h5 class="text-dark font-weight-bold">We would like to know you better</h5>


                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label text-uppercase">Last Name </label>
                        <input type="textarea" name="last_name" id="last_name" class="form-control" />

                        <span class="invalid-feedback" role="alert">
                            <strong id="error-last_name"></strong>
                        </span>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label  text-uppercase">First Name </label>
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
                        <label class="control-label">PRESENT ADDRESS </label>
                        <input type="text" name="present_address" id="present_address" class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-present_address"></strong>
                        </span>

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label">PERMANENT ADDRESS </label>
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
                        <label class="control-label  text-uppercase">MOBILE NO. </label>
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-mobile_no"></strong>
                        </span>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label  text-uppercase">EMAIL ADDRESS </label>
                        <input type="text" name="email_address" id="email_address" class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-email_address"></strong>
                        </span>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">PLACE OF BIRTH </label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-place_of_birth"></strong>
                        </span>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Date Of Birth </label>
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
                        <label class="control-label">CITIZENSHIP </label>
                        <input type="text" name="citizenship" id="citizenship" class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-citizenship"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Gender </label>
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
                        <label class="control-label">Civil Status </label>
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
                        <hr class="my-2" style="background-color: #910000 !important;">
                        <br>
                        <h5 class="text-dark font-weight-bold">We would like to kwow about your work or businness</h5>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">EMPLOYMENT STATUS </label>
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
            <div class="row">
                <div class="col-sm-12 ">
                    <br>
                    <hr class="my-2" style="background-color: #910000 !important;">
                    <h5 class="text-dark font-weight-bold">Choose your account</h5>

                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label">TYPE OF ACCOUNT </label>
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
                        <label class="control-label">TYPE OF PROGRAM
                        </label> <br>
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
                        <label class="control-label">UPLOAD VALID ID
                        </label> <br>
                        <strong class="text-success pointer receipt_view" id="btn_receipt_view">Click here to view your uploaded file</strong>

                        <input type="hidden" name="upload_file_id" id="upload_file_id" class="form-control">
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-upload_file_id"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">DENTAL </label>
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
                        <label class="control-label">MEMBERSHIP TYPE </label>
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
                    <hr class="my-2" style="background-color: #910000 !important;">
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
            <div class="row">
                <div class="col-sm-12 ">
                    <br>
                    <hr class="my-2" style="background-color: #910000 !important;">
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
    </div>

    <button id="generate-pdf" class="btn btn-primary">Generate Full Page PDF</button>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- Custom Script -->
    <script>
        $.urlParam = function(name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results == null) {
                return null;
            }
            return decodeURI(results[1]) || 0;
        }

        function memberData() {
            let type = $.urlParam('type');
            let referral_code = $.urlParam('referral_code');


            $.ajax({
                url: "/admin/get-membership-pdf/" + type + "/" + referral_code,
                dataType: "json",
                beforeSend: function() {


                },
                success: function(data) {
                    $.each(data.result, function(key, value) {
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

                }




            })
        };

        $(document).ready(function() {
            memberData();


            $('#generate-pdf').on('click', function() {
                const {
                    jsPDF
                } = window.jspdf;

                html2canvas(document.body).then(function(canvas) {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF('p', 'mm', 'a4');
                    const imgWidth = 210; // A4 width in mm
                    const pageHeight = 295; // A4 height in mm
                    const imgHeight = canvas.height * imgWidth / canvas.width;
                    let heightLeft = imgHeight;

                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 0, heightLeft - imgHeight, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    pdf.save('full-page.pdf');
                });
            });
        });
    </script>
</body>

</html>