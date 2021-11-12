@extends('layouts.admin1')
@section('content')
<div class="section_register" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center; min-height: 750px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-body p-4">
                    <h4>Compelete all Required Field</h4>
                    <br>
                        <div class="row justify-content-center">
                    
                            <div class="col-6 mx-4">
                                <div class="mx-12">
                                    <div class="row">
                                        <div class="menu1 col-sm-4 bg-primary text-white text-center">
                                            <h3>1</h3> 
                                            <h6>TELL US ABOUT YOU</h6>
                                        </div>
                                        <div class="menu2 col-sm-4 text-center">
                                            <h3>2</h3> 
                                            <h6>HOW CAN WE CONTACT YOU</h6>
                                        </div>
                                        <div class="menu3 col-sm-4 text-center">
                                            <h3>3</h3>
                                            <h6>CREATE YOUR BENEFICIARY</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                        <br>
                    <form method="post" id="registerForm" class="form-horizontal">
                            @csrf
                            <hr class="my-2 bg-primary">
                            <br>
                            <!-- Personal Page -->
                            <div id="tell_us_about_you">
                                <h5 class="text-dark">SECURITY INFORMATION</h5>
                                <hr class="my-2 bg-muted">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Email: </label>
                                            <input type="text" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly />
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-email"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 class="text-dark">PERSONAL INFORMATION</h5>
                                <h6 class="text-dark font-weight-bold">We would like to know you better</h6>
                                <hr class="my-2 bg-muted">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >First Name (as in your ID Card) <span class="text-danger">*</span></label>
                                            <input type="text" name="firstname" id="firstname" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-firstname"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Middle Name</label>
                                            <input type="text" name="middlename" id="middlename" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-middlename"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Last Name (as in your ID Card) <span class="text-danger">*</span></label>
                                            <input type="text" name="lastname" id="lastname" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-lastname"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Date Of Birth <span class="text-danger">*</span></label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-date_of_birth"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Occupation <span class="text-danger">*</span></label>
                                            <select name="occupation" id="occupation" class="form-control select2" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Business">Business</option>
                                                <option value="Construction Contractor">Construction Contractor</option>
                                                <option value="Construction Worker">Construction Worker</option>
                                                <option value="General Worker">General Worker</option>
                                                <option value="Government Servant">Government Servant</option>
                                                <option value="House Wife">House Wife</option>
                                                <option value="IT Officer">IT Officer</option>
                                                <option value="Professional Worker">Professional Worker</option>
                                                <option value="Self Employed and Business">Self Employed and Business</option>
                                                <option value="Service Supervisor">Service Supervisor</option>
                                                <option value="Student">Student</option>
                                                <option value="Unemployed">Unemployed</option>
                                                <option value="Others">Others</option>
                                               
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-occupation"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-gender"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Source Of Fund <span class="text-danger">*</span></label>
                                            <select name="source_of_fund" id="source_of_fund" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Business Income">Business Income</option>
                                                <option value="Capital Gain">Capital Gain</option>
                                                <option value="Capital Gain">Capital Gain</option>
                                                <option value="Family Income">Family Income</option>
                                                <option value="Gift">Gift</option>
                                                <option value="Loan">Loan</option>
                                                <option value="Savings">Savings</option>
                                                <option value="Others">Others</option>
                                                
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-source_of_fund"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Nationality <span class="text-danger">*</span></label>
                                            <input type="text" name="nationality" id="nationality" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-nationality"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 class="text-dark">ID INFORMATION</h5>
                                <hr class="my-2 bg-muted">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >ID Type<span class="text-danger">*</span></label>
                                            <select name="id_type" id="id_type" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Alien Registration Card">Alien Registration Card</option>
                                                <option value="Passport with its address page">Passport with its address page</option>
                                                <option value="Pension Handbook">Pension Handbook</option>
                                                <option value="Resident Registration Card">Resident Registration Card</option>
                                                <option value="Driver's License">Driver's License</option>
                                                <option value="Temporary Visa">Temporary Visa</option>
                                                <option value="National Health Insurance Card">National Health Insurance Card</option>
                                                <option value="MyNumber Card">MyNumber Card</option>
                                                <option value="VISA Extension Permit">VISA Extension Permit</option>

                                               
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-id_type"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >ID Number <span class="text-danger">*</span></label>
                                            <input type="number" name="id_number" id="id_number" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-id_number"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >ID Issued Country <span class="text-danger">*</span></label>
                                            <select name="id_issued_country" id="id_issued_country" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="India">India</option>
                                                <option value="China">China</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="Others">Others</option>
                                               
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-id_issued_country"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >ID Issue Date <span class="text-danger">*</span></label>
                                            <input type="date" name="id_issue_date" id="id_issue_date" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-id_issue_date"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label" >ID Expiry Date <span class="text-danger">*</span></label>
                                            <input type="date" name="id_expiry_date" id="id_expiry_date" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-id_expiry_date"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <!-- id upload -->
                                    <div class="col-sm-4">
                                       <div class="form-group">
                                            <label class="control-label" >Upload Id's <span class="text-danger">*</span></label>
                                            <button type="button" id="id_modal_btn" class="btn btn-neutral form-control text-uppercase text-uppercase">Upload Ids</button>
                                            <span id="id_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Page -->
                            <div id="how_can_we_contact_you">
                                <br>
                                <h5 class="text-dark">CONTACT INFORMATION</h5>
                                <h6 class="text-dark font-weight-bold">We would like to know you better</h6>
                                <hr class="my-2 bg-muted">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Country <span class="text-danger">*</span></label>
                                            <select name="country" id="country" class="select2 form-control" style="width: 100%">
                                                <option value="" disabled selected>Please Select</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="India">India</option>
                                                <option value="China">China</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-country"></strong>
                                            </span>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Address<span class="text-danger">*</span></label>
                                            <input type="text" name="address" id="address" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-address"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Mobile Number<span class="text-danger">*</span></label>
                                            <input type="number" name="mobile_number" id="mobile_number" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-mobile_number"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" >Telephone</label>
                                            <input type="number" name="telephone" id="telephone" class="form-control"/>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-telephone"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input class="form-check-input form-control" type="checkbox" id="terms_and_conditions" name="terms_and_conditions">
                                            <span class="form-check-sign"></span>
                                            To read and accept the Terms & Conditions 

                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-terms_and_conditions"></strong>
                                            </span>
                                            </label>
                                            
                                            
                                        </div>
                                    
                                    </div>

                                </div>
                            </div>
                            <!-- Create Beneficiary -->
                            <div id="create_your_beneficiary">
                                <br>
                                <h5 class="text-dark">BENEFICIARY INFORMATION</h5>
                                <h6 class="text-dark font-weight-bold">Where do you want to send your money</h6>
                                <hr class="my-2 bg-muted">
                                <div id="beneficiaries">

                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="button" id="add_beneficiary" class="btn btn-info btn-lg">Add Beneficiary</button>
                                    <button type="button" id="action_back" class="btn btn-lg">Back</button>
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-lg" value="Next" />
                                </div>
                            </div>
                            

                            <input type="hidden" name="action" id="action" value="personal_info" />
                            <input type="hidden" name="hidden_id" id="hidden_id" value="{{ Auth::user()->id }}" />  

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form method="post" id="beneficiaryForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="beneficiaryModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body">
                 <div id="modalbody" class="modalbody row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Receipt Country <span class="text-danger">*</span></label>
                                <select name="receipt_country" id="receipt_country" class="form-control select2 form-control" style="width: 100%">
                                    <option value="" disabled selected>Please Select</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}"> {{$country->country}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-receipt_country"></strong>
                                </span>
                              
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Payment Mode <span class="text-danger">*</span> </label>
                                <select name="payment_mode" id="payment_mode" class="form-control select2" style="width: 100%">
                                    <option value="" disabled selected>Please Select</option>
                                    <option value="Account Deposit">Account Deposit</option>
                                    
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-payment_mode"></strong>
                                </span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-12">
                            <h6 class="text-dark font-weight-bold">Payout Location Details</h6>
                            <hr class="my-2 bg-muted">
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Bank Name<span class="text-danger">*</span> </label>
                                <select name="bank_name" id="bank_name" class="form-control select2" style="width: 100%">
                                    <option value="" disabled selected>Please Select</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank->id}}"> {{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-bank_name"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Account Number:<span class="text-danger">*</span> </label>
                                <input type="number" name="account_number" id="account_number" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-account_number"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="text-dark font-weight-bold">Beneficiary Details</h6>
                            <hr class="my-2 bg-muted">
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Beneficiary First Name<span class="text-danger">*</span> </label>
                                <input type="text" name="beneficiary_firstname" id="beneficiary_firstname" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-beneficiary_firstname"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Beneficiary Middle Name</label>
                                <input type="text" name="beneficiary_middlename" id="beneficiary_middlename" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-beneficiary_middlename"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Beneficiary Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_lastname" id="beneficiary_lastname" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-beneficiary_lastname"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Mobile Number<span class="text-danger">*</span></label>
                                <input type="number" name="beneficiary_mobile_number" id="beneficiary_mobile_number" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-beneficiary_mobile_number"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="text-dark font-weight-bold">Address Details</h6>
                            <hr class="my-2 bg-muted">
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Address<span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_address" id="beneficiary_address" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-beneficiary_address"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Purpose of Remit<span class="text-danger">*</span> </label>
                                <select name="purpose_of_remit" id="purpose_of_remit" class="form-control select2" style="width: 100%">
                                    <option value="" disabled selected>Please Select</option>
                                    <option value="Business">Business</option>
                                    <option value="Donation">Donation</option>
                                    <option value="Family Maintenance">Family Maintenance</option>
                                    <option value="Gift">Gift</option>
                                    <option value="Investment">Investment</option>
                                    <option value="Lending Money">Lending Money</option>
                                    <option value="Living Expenses">Living Expenses</option>
                                    <option value="Medical Expenses">Medical Expenses</option>
                                    <option value="Rental Payment">Rental Payment</option>
                                    <option value="Payment for Goods and Services">Payment for Goods and Services</option>
                                    <option value="Salary">Salary</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Others">Others</option>

                                
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-purpose_of_remit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Relation with Beneficiary<span class="text-danger">*</span> </label>
                                <select name="relation_with_beneficiary" id="relation_with_beneficiary" class="form-control select2" style="width: 100%">
                                    <option value="" disabled selected>Please Select</option>
                                    <option value="Aunt">Aunt</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Brother in Law">Brother in Law</option>
                                    <option value="Cousin">Cousin</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Daughter in law">Daughter in law</option>
                                    <option value="Father">Father</option>
                                    <option value="Father in Law">Father in Law</option>
                                    <option value="Fiancée">Fiancée</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Mother in Law">Mother in Law</option>
                                    <option value="Nephew">Nephew</option>
                                    <option value="Niece">Niece</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Sister in Law">Sister in Law</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Uncle">Uncle</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Others">Others</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-relation_with_beneficiary"></strong>
                                </span>
                            </div>
                        </div>
                        
                       
                        
                        
                    </div>
                    <input type="hidden" name="beneficiary_action" id="beneficiary_action" value="Add" />
                    <input type="hidden" name="beneficiary_hidden_id" id="beneficiary_hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="beneficiary_action_button" id="beneficiary_action_button" class="text-uppercase btn btn-primary" value="Save" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<div class="modal" id="welcomeModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
                    <div class="modal-body">
                        <div id="modalbody" class="modalbody">
                       <div class="row">
                            <div class="col-md-12  text-center mb-5">
                               <h3 class="text-muted">{{ trans('panel.site_title') }}</h3>
                           </div>
                           <div class="col-md-12  text-center">
                               <div class="container">
                                   <h3>Thank you <span class="text-success">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span> for registering with <br> {{ trans('panel.site_title') }}</h3>
                                    <br>
                                    <br>
                                    <h6 class="text-muted">Your Login ID: {{ Auth::user()->email }}</h6>
                                    <br><br>
                                    <h3>Please check your e-mail for futher datails</h3>
                                    <h5 class="text-muted">Your account has been Successfully Registered</h5>
                                    <h5 class="text-muted">Now you can login into <span class="text-danger">{{ trans('panel.site_title') }}</span> </h5>
                                        <h5 class="text-muted"> Have a good day
                                            <button class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Login Now</button> 
                                           
                                        </h5>
                                    <br>
                                    <br>
                                    <span class="text-muted">© {{ trans('panel.site_title') }}</span>
                                </div>
                           </div>
                       </div>
                            
                            
                        </div>
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer bg-danger text-center">
                            {{ trans('panel.site_title') }}
                    </div>
            
            </div>
    </div>
</div>

<!-- id modal -->
<form method="post" id="idForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="modal" id="idModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-id text-white text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body">
                 <div id="modalbody" class="modalbody row">
                      
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" >ID Card (Front) <span class="text-danger">*</span></label>
                            <input type="file" name="id_card_front" id="id_card_front" accept="image/*" class="form-control"/>
                            @if(Auth::user()->id_card_front == '')

                            @else
                            <a href="../ids/{{ Auth::user()->id_card_front }}" target="_blank">
                                <img src="../ids/{{ Auth::user()->id_card_front }}" class="rounded" style="width: 100px; height: 100px" alt="id front">
                            </a>
                            @endif
                            <br>
                            <span class="text-muted" role="alert" >
                                (File Format: jpg/png Size:Max 30 MB)
                            </span>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-id_card_front"></strong>
                            </span>
                        
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" >ID Card (Back) <span class="text-danger">*</span></label>
                            <input type="file" name="id_card_back" id="id_card_back" accept="image/*" class="form-control"/>
                            @if(Auth::user()->id_card_back == '')

                            @else
                                <a href="../ids/{{ Auth::user()->id_card_back }}" target="_blank">
                                    <img src="../ids/{{ Auth::user()->id_card_back }}" class="rounded" style="width: 100px; height: 100px" alt="id front">
                                </a>
                            @endif
                           
                            <br>
                            <span class="text-muted" role="alert" >
                                (File Format: jpg/png Size:Max 30 MB)
                            </span>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-id_card_back"></strong>
                            </span>
                        
                        </div>
                    </div>
                        
                    </div>
                    <input type="hidden" name="id_action" id="id_action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="id_action_button" id="id_action_button" class="text-uppercase btn btn-primary" value="Upload" />
                </div>
        
            </div>
        </div>
    </div>
</form>





@endsection
@section('scripts')
<script>

function beneficiaries(){
    $.ajax({
        url: "beneficiaries", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
        },
        success: function(response){
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Save");
            $("#beneficiaries").html(response);
        }	
    })
}

$(document).ready(function () {
    $('#how_can_we_contact_you').hide();
    $('#create_your_beneficiary').hide();
    $('#action_back').hide();
    $('#add_beneficiary').hide();
    
    var id = $('#hidden_id').val();

    $.ajax({
        url: "/admin/fullregistration/personalinfo/" + id + "/show",
        dataType:"json",
        beforeSend:function(){

        },
        success:function(data){  
            //Personal Info
            $('#firstname').val(data.firstname);
            $('#middlename').val(data.middlename);
            $('#lastname').val(data.lastname);
            $('#date_of_birth').val(data.date_of_birth);
            $("#occupation").select2("trigger", "select", {
                data: { id: data.occupation }
            });
            $("#gender").select2("trigger", "select", {
                data: { id: data.gender }
            });
            $("#source_of_fund").select2("trigger", "select", {
                data: { id: data.source_of_fund }
            });
            $('#nationality').val(data.nationality);

            //ID info
            $("#id_type").select2("trigger", "select", {
                data: { id: data.id_type }
            });
            $('#id_number').val(data.id_number);
            $("#id_issued_country").select2("trigger", "select", {
                data: { id: data.id_issued_country }
            });
            $('#id_issue_date').val(data.id_issue_date);
            $('#id_expiry_date').val(data.id_expiry_date);

            //Contact Info
            $("#country").select2("trigger", "select", {
                data: { id: data.country }
            });
            $('#address').val(data.address);
            $('#mobile_number').val(data.mobile_number);
            $('#telephone').val(data.telephone);
            if(data.terms_and_conditions == 1){
                var tac = true;
            }
            else{
                var tac = false;
            }
            $('#terms_and_conditions').attr('checked', tac);
        }
    })

   
});

$('#registerForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid');
    var id = $('#hidden_id').val();
    var action = $('#action').val();
    var action_url = "/admin/fullregistration/personalinfo/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            if(action == 'personal_info'){
                if(data.errors){
                    $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                            $('#'+key).addClass('is-invalid')
                            $('#error-'+key).text(value)
                        }
                    })
                    $("#action_button").attr("value", "Next");
                }
                if(data.error_id){
                    $("#id_error").text(data.error_id);
                    $("#action_button").attr("value", "Next");
                }
                if(data.personal_info){
                    $('#success-alert').addClass('bg-success');
                    $('#success-alert').html('<strong>' + data.personal_info + '</strong>');
                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });

                    $('.menu1').removeClass('bg-primary text-white');
                    $('.menu2').addClass('bg-primary text-white');
                    $("#id_error").text('');
                    $('#tell_us_about_you').hide();
                    $('#how_can_we_contact_you').show();
                    $('#action').val('contact_info');
                    $('#action_back').show();
                    $("#action_button").attr("value", "Next");
                }
            }
            if(action == 'contact_info'){
                if(data.errors){
                    $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                            $('#'+key).addClass('is-invalid')
                            $('#error-'+key).text(value)
                        }
                    })
                    $("#action_button").attr("value", "Next");
                }
                if(data.contact_info){
                    $('#success-alert').addClass('bg-success');
                    $('#success-alert').html('<strong>' + data.contact_info + '</strong>');
                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });

                    $('.menu1').removeClass('bg-primary text-white');
                    $('.menu2').removeClass('bg-primary text-white');
                    $('.menu3').addClass('bg-primary text-white');
                    $('#tell_us_about_you').hide();
                    $('#how_can_we_contact_you').hide();
                    $('#create_your_beneficiary').show();
                    $('#action').val('create_your_beneficiary');
                    $('#action_back').show();
                    $('#add_beneficiary').show();
                    $("#action_button").attr("value", "Save");
                    return beneficiaries();
                }
            }
            if(action == 'create_your_beneficiary'){
               if(data.create_your_beneficiary){
                $('#welcomeModal').modal('show'); 
              }
            }
           
        
        }
    });
  
    
});


$(document).on('click', '#action_back', function(){
    var action = $('#action').val();
    if(action == 'contact_info'){
        $('.menu1').addClass('bg-primary text-white')
        $('.menu2').removeClass('bg-primary text-white')
        $('.menu3').removeClass('bg-primary text-white')
        $('#tell_us_about_you').show();
        $('#how_can_we_contact_you').hide();
        $('#create_your_beneficiary').hide();
        $('#action').val('personal_info');
        $('#action_back').hide();
        $("#action_button").attr("value", "Next");
    }
    if(action == 'create_your_beneficiary'){
        $('.menu1').removeClass('bg-primary text-white')
        $('.menu2').addClass('bg-primary text-white')
        $('.menu3').removeClass('bg-primary text-white')
        $('#tell_us_about_you').hide();
        $('#how_can_we_contact_you').show();
        $('#create_your_beneficiary').hide();
        $('#action').val('contact_info');
        $('#add_beneficiary').hide();
        $("#action_button").attr("value", "Next");
    }
});

$(document).on('click', '#add_beneficiary', function(){
    $('#beneficiaryModal').modal('show');
    $('#beneficiaryForm')[0].reset();
    $('.select2').select2({
        placeholder: 'Please Select'
    });
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Beneficiary');
    $('#beneficiary_action_button').val('Submit');
    $('#beneficiary_action').val('Add');
   
});

$('#beneficiaryForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.beneficiaries.store') }}";
    var type = "POST";

    if($('#beneficiary_action').val() == 'Edit'){
        var id = $('#beneficiary_hidden_id').val();
        action_url = "beneficiaries/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#beneficiary_action_button").attr("disabled", true);
            $("#beneficiary_action_button").attr("value", "Loading..");
        },
        success:function(data){
            if($('#beneficiary_action').val() == 'Edit'){
                    $("#beneficiary_action_button").attr("disabled", false);
                    $("#beneficiary_action_button").attr("value", "Update");
            }else{
                    $("#beneficiary_action_button").attr("disabled", false);
                    $("#beneficiary_action_button").attr("value", "Submit");
            }
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid');
                $('#beneficiaryForm')[0].reset();
                $('.select2').select2({
                    placeholder: 'Please Select'
                });
                $('#beneficiaryModal').modal('hide');
                return beneficiaries();
             
                
            }
           
        }
    });
});

$(document).on('click', '.edit_beneficiary', function(){
    $('#beneficiaryModal').modal('show');
    $('.modal-title').text('Edit Beneficiary');
    $('#beneficiaryForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/beneficiaries/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#beneficiary_action_button").attr("disabled", true);
            $("#beneficiary_action_button").attr("value", "Loading..");
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('.modalbody').show();
            if($('#action').val() == 'Edit'){
                $("#beneficiary_action_button").attr("disabled", false);
                $("#beneficiary_action_button").attr("value", "Update");
            }else{
                $("#beneficiary_action_button").attr("disabled", false);
                $("#beneficiary_action_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'mobile_number'){
                        $('#beneficiary_mobile_number').val(value)
                    }
                    if(key == 'address'){
                        $('#beneficiary_address').val(value)
                    }
                    if(key == 'receipt_country'){
                        $("#receipt_country").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'payment_mode'){
                        $("#payment_mode").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'bank_name'){
                        $("#bank_name").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'purpose_of_remit'){
                        $("#purpose_of_remit").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'relation_with_beneficiary'){
                        $("#relation_with_beneficiary").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }

                }
            })
            $('#beneficiary_hidden_id').val(id);
            $('#beneficiary_action_button').val('Update');
            $('#beneficiary_action').val('Edit');
        }
    })
});

$(document).on('click', '.remove_beneficiary', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this beneficiary?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/beneficiaries/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                            $("#action_button").attr("disabled", true);
                            $("#action_button").attr("value", "Loading..");
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            $("#action_button").attr("disabled", false);
                            $("#action_button").attr("value", "Save");
                            return beneficiaries();
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });

});

//id
$(document).on('click', '#id_modal_btn', function(){
    $('#idModal').modal('show');
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-id').text('Upload Id');
});

$('#idForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid');
    var id = $('#hidden_id').val();
    var action_url = "/admin/fullregistration/ids/" + id;
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        dataType:"json",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend:function(){
            $("#id_action_button").attr("disabled", true);
            $("#id_action_button").attr("value", "Uploading..");
        },
        success:function(data){
            $("#id_action_button").attr("disabled", false);
            $("#id_action_button").attr("value", "Upload");
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('#idModal').modal('hide');
                $('.form-control').removeClass('is-invalid')
               
            }
         
           
        
        }
    });
    
});




</script>
@endsection