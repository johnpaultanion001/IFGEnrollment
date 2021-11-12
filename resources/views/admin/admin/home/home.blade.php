@extends('layouts.admin1')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <hr class="my-2 bg-danger">
                <div class="row">
                    <div class="col-6">
                        <h4>Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h4>
                        <span>How are you today?</span>
                    </div>
                    <div class="col-3 mt-2">
                        <h6 class="text-center">
                            <div class="btn btn-success btn-sm btn-facebook btn-icon btn-round">
                                <i class="now-ui-icons ui-1_check text-white"></i>
                            </div><br>
                           Email Verified
                        </h6>
                    </div>
                    <div class="col-3 mt-2">
                        <h6 class="text-center">
                            <div class="btn btn-success btn-sm btn-facebook btn-icon btn-round">
                                <i class="now-ui-icons ui-1_check text-white"></i>
                            </div><br>
                           Identity Verified
                        </h6>
                    </div>
                </div>
                <hr class="my-2 bg-danger">
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <span>Whom do you want to send?</span>
                        <div class="form-group">
                            <div id="listbeneficiaries">
                               
                            </div>
                            <div id="error_select_recipient" class="text-danger"></div>
                          
                            
                            <button id="add_beneficiary" class="btn btn-sm btn-warning btn-round" > <i class="now-ui-icons ui-1_simple-add mr-2"></i>Add New</button> 
                            <button id="send_now" class="btn btn-sm btn-success btn-round" > <i class="now-ui-icons ui-1_send mr-2"></i> Send Now</button> 
                        
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                    <h6 class="card-subtitle mb-2 text-muted">AVAILABLE BALANCE</h6>
                                        <h5 class="card-title text-danger">0.00 JPY</h5>
                                    </div>
                                    <div class="col-3">
                                        <i class="now-ui-icons business_briefcase-24 text-success" style="font-size: 50px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="card-subtitle mb-2 text-danger">{{ Auth::user()->updated_at->format('F d,Y h:i A') }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Your last login</h6>
                                        
                                    </div>
                                    <div class="col-3">
                                        <i class="now-ui-icons arrows-1_share-66 text-success" style="font-size: 50px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                           
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-success text-center font-weight-bold text-white">Exchange Rate</li>
                                <li class="list-group-item bg-warning text-center font-weight-bold text-white">1 JPY = <span id="value_exchange"></span> </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6">
                                                YOU SEND 
                                            <div class="form-group">
                                                <input type="number" placeholder="0.00" id="exchange_send" name="exchange_send" class="form-control" />
                                                <div id="error_exchange_send" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 text-center mt-4">
                                            JPY
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6">
                                             THEY GET
                                            <div class="form-group">
                                                <input type="number" placeholder="0.00" id="exchange_get" readonly name="exchange_get" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-6 text-center mt-4">
                                            <div class="form-group">
                                                <select name="select_exchange" id="select_exchange" class="form-control select_exchange select2" style="width: 100%">
                                                    <option value="" disabled selected>Select Exchange</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{$country->id}}"> {{$country->code}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <span>FEE</span> <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Service Change</span>
                                        </div>
                                        <div class="col-6">
                                            <span id="total_service" class="text-danger">0 JPY</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                             <span>Total</span>
                                        </div>
                                        <div class="col-6">
                                            <span id="total_exchange" class="text-danger">0 JPY</span>
                                        </div>
                                    </div>
                                     
                                 

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
               <div class="row">
                   <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="card-subtitle mb-2 text-danger">{{  number_format($last_amount_transfer->send_amount ?? '0' , 2, '.', ',')  }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Last Amount Transfered</h6>
                                        
                                    </div>
                                    <div class="col-3">
                                        <i class="now-ui-icons business_money-coins text-success"  style="font-size: 50px"></i>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="card-subtitle mb-2 text-danger">{{$beneficiaries->count()}}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Number Of Beneficiary</h6>
                                        
                                    </div>
                                    <div class="col-3">
                                       <i class="now-ui-icons users_circle-08 text-success" style="font-size: 50px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="card-subtitle mb-2 text-muted">Your ID Submitted to JRF</h6>
                                        <h6 class="card-subtitle mb-2 text-danger">Exp: {{ Auth::user()->id_expiry_date }}</h6>
                                        
                                    </div>
                                    <div class="col-3">
                                        <i class="now-ui-icons business_badge text-success" style="font-size: 50px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class="card-subtitle mb-2 text-danger">{{  number_format($total_transfer , 2, '.', ',') }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Total Amount Transfered</h6>
                                        
                                    </div>
                                    <div class="col-3">
                                        <i class="now-ui-icons business_chart-bar-32 text-success" style="font-size: 50px"></i>
                                    </div>
                                </div>
                            </div>
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
                                <select name="receipt_country" id="receipt_country" class="form-control select2" style="width: 100%">
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

<form method="post" id="transactionForm" class="form-horizontal">
    @csrf
    <div class="modal" id="transactionModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title-transaction  text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="transaction_form" class="row">
                        
                        <div class="col-sm-12">
                            <h6 class="text-dark font-weight-bold">How much money you want to send?</h6>
                            <hr class="my-2 bg-muted">
                        </div>
                        <br>
                        <div class="col-sm-12"> 
                            <div class="col-sm-8 mx-auto">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Send Amount<span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="number" name="send_amount" id="send_amount" step="any" placeholder="0.00" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text font-weight-bold">JPY</span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div id="error_send_amount" class="error_transaction text-danger"></div>
                                </div>
                                <div class="col-sm-4 mx-auto">
                                        <button type="button" class="btn btn-primary" id="compute">
                                            Compute
                                            <i class="pl-2 fas fa-calculator"></i>
                                        </button>
                                </div>
                            </div>
                            
                        </div>    
                        <div class="col-sm-12"> 
                            <div class="col-sm-8 mx-auto">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Receive Amount</label>
                                    <div class="input-group">
                                        <input type="number" name="receive_amount" id="receive_amount" step="any" placeholder="0.00" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text font-weight-bold country_code"></span>
                                        </div>
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-receive_amount"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-12"> 
                            <div class="col-sm-8 mx-auto">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Payment Mode</label>
                                    <input type="text" name="transaction_payment_mode" id="transaction_payment_mode" class="form-control" readonly>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-transaction_payment_mode"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-12">
                            <h6 class="text-dark font-weight-bold">Other Information</h6>
                            <hr class="my-2 bg-muted">
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Purpose of Remit</label>
                                <input type="text" name="transaction_purpose_of_remit" id="transaction_purpose_of_remit" class="form-control" readonly>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-transaction_purpose_of_remit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Source of Fund<span class="text-danger">*</span> </label>
                                <select name="transaction_source_of_fund" id="transaction_source_of_fund" class="form-control select2" style="width: 100%">
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
                                <div id="error_transaction_source_of_fund" class="error_transaction text-danger"></div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-center font-weight-bold ">Transfer Summary</li>
                                    <li class="list-group-item text-center font-weight-bold ">1 JPY = <span id="exchange_transaction"></span> </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">
                                                    YOU SEND 
                                                <div class="form-group">
                                                    <input type="number" step="any" placeholder="0.00" id="you_send" name="you_send" readonly />
                                                </div>
                                            </div>
                                            <div class="col-6 text-center mt-4">
                                                JPY
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">
                                                    THEY GET
                                                <div class="form-group">
                                                    <input type="text" step="any" placeholder="0.00" id="they_get" name="they_get" readonly />
                                                </div>
                                            </div>
                                            <div class="col-6 text-center mt-4 country_code">
                                                
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>FEE</span> <br>
                                        <div class="row">
                                            <div class="col-6">
                                                <span>Service Change</span>
                                            </div>
                                            <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <div class="form-group">
                                                                    <input type="number" readonly name="service_charge" id="service_charge" placeholder="0.00" step="any" style="width: 100%"/> 
                                                                    <div id="error_service_charge" class="error_transaction text-danger"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-5">
                                                                JPY
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                    <span>Total</span>
                                            </div>
                                            <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <div class="form-group">
                                                                    <input type="number" name="total" id="total" placeholder="0.00" readonly style="width: 100%"/> 
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong id="error-total"></strong>
                                                                        </span> 
                                                                </div>
                                                            </div>
                                                            <div class="col-5">
                                                                JPY
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                            
                                        

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="transaction_detail" class="row">
                    <div class="col-sm-12">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Your Beneficiary Information</li>
                                    <li class="list-group-item">
                                       Beneficiary Name :  <span id="td_beneficiary_name"></span>
                                       <hr class="my-1 bg-muted">
                                       Order ID :  <span id="td_order_id"></span>
                                       <hr class="my-1 bg-muted">
                                       Bank Name :  <span id="td_bank_name"></span>
                                       <hr class="my-1 bg-muted">
                                       Account Number :  <span id="td_account_number"></span>
                                    </li>
                                    <li class="list-group-item font-weight-bold">Transaction Details</li>
                                    <li class="list-group-item">
                                       Send Amount :  <span id="td_send_amount"></span>
                                       <hr class="my-1 bg-muted">
                                       Service Charge:  <span id="td_service_charge"></span>
                                       <hr class="my-1 bg-muted">
                                       GST :  <span id="td_gst"></span>
                                       <hr class="my-1 bg-muted">
                                       Discount :  <span id="td_discount">0.00</span>
                                       <hr class="my-1 bg-muted">
                                       Total To Pay :  <span id="td_total_to_pay"></span>
                                    </li>
                                    <li class="list-group-item">
                                       <div class="card">
                                           <div class="card-body">
                                                <p class="font-weight-bold">I hereby confirm my remittance transaction created by myself with;</p>
                                                <p>no Iran/North Korea involved in any aspect;</p>
                                                <p>all information including name, address, remittance purpose, and fund source valid and true;</p>
                                                <p>no violation in Japanese laws (incl. Forex Law) and any relevant laws;</p>
                                                <p>no undeclared Politically Exposed Persons involved;</p>
                                                <p>my awareness of Japan Remit Finance Co., Ltd. being not a blank but a licensed remittance company in Japan;</p>
                                                <p>one residential bank account, at least, active and open in Japan under my name</p>
                                            </div>
                                           
                                       </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="transaction_action" id="transaction_action" value="transaction_form" />
                    <input type="text" name="transaction_beneficiary_id" id="transaction_beneficiary_id" />
                    <input type="text" name="transaction_id" id="transaction_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" id="transaction_back" class="btn btn-white text-uppercase">Close</button>
                    <input type="submit" name="transaction_action_button" id="transaction_action_button" class="text-uppercase btn btn-primary" value="Save" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>

$(document).ready(function () {
   $('#transaction_detail').hide();
   $('#transaction_action').hide();
   $('#transaction_beneficiary_id').hide();
   $('#transaction_id').hide();
   return listbeneficiaries();
});

function listbeneficiaries(){
    $.ajax({
        url: "listbeneficiaries", 
        type: "get",
        dataType: "HTMl",
       success: function(response){
            $("#listbeneficiaries").html(response);
        }	
    })
}


$(document).on('click', '#add_beneficiary', function(){
    $('#beneficiaryModal').modal('show');
    $('#beneficiaryForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Beneficiary');
    $('#beneficiary_action_button').val('Submit');
    $('#beneficiary_action').val('Add');
});

$(document).on('click', '#send_now', function(){
    var beneficiary = $('#select_recipient').val();
    if(beneficiary == null){
      $('#error_select_recipient').html('Please select a list of recipient');
    }else{
        $('#error_select_recipient').html(null);
        $('#transactionModal').modal('show');
        // $('#transactionForm')[0].reset();
        $('.form-control').removeClass('is-invalid')
        $('#transaction_beneficiary_id').val(beneficiary)

        if($('#transaction_action').val() == 'transaction_form'){
            $('#transaction_detail').hide();
            $('#transaction_form').show();

            $('.modal-title-transaction').text('Transaction Form');
            $('#transaction_action_button').val('Review Payment');
            var _token =  $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.reviewpayment') }}",
                method:"POST",
                dataType: "json",
                data:{beneficiary:beneficiary, _token:_token},
                beforeSend: function() {
                  
                },
                success:function(data){
                  $('#transaction_payment_mode').val(data.payment_mode);
                  $('#transaction_purpose_of_remit').val(data.purpose_of_remit);
                  $('#exchange_transaction').text(data.exchange +' '+ data.exchange_code);
                  $('.country_code').text(data.exchange_code);
                }
            });
        }
        if($('#transaction_action').val() == 'transaction_datail'){
            $('#transaction_action').val('Edit');
            $('#transaction_action_button').val('Review Payment');
            $('#transaction_detail').hide();
            $('#transaction_form').show();
            
           
        }
    }
});

$('#beneficiaryForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.beneficiaries.store') }}";
    var type = "POST";

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
            $("#beneficiary_action_button").attr("disabled", false);
            $("#beneficiary_action_button").attr("value", "Submit");
           
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-success');
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
                return listbeneficiaries();
             
                
            }
           
        }
    });
});


$(document).on('click', '#compute', function(event){
    var sendamount = $('#send_amount').val();
    var beneficiary = $('#transaction_beneficiary_id').val();
    var _token =  $('input[name="_token"]').val();

    if(sendamount < 1000){
        alert('Send ammount must be 1000')
    }else{
        $.ajax({
            url:"{{ route('admin.sendamount') }}",
            method:"POST",
            dataType: "json",
            data:{beneficiary:beneficiary, sendamount:sendamount, _token:_token},
            beforeSend: function() {
                
            },
            success:function(data){
                $('#receive_amount').val(data.receive);
                $('#they_get').val(data.receive);
                $('#you_send').val(data.send);
                $('#total').val(data.total);
                $('#service_charge').val(data.charge);

            }
        });
    }
   
});


$('#transactionForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url; 
    var type;
    var id;

    if($('#transaction_action').val() == 'transaction_form'){
        action_url = "{{ route('admin.transactions.store') }}";
        type =  "POST";
    }

    if($('#transaction_action').val() == 'Edit'){
        id = $('#transaction_id').val();
        action_url = "transactions/" + id;
        type = "PUT";
    }

    if($('#transaction_action').val() == 'transaction_datail'){
        id = $('#transaction_id').val();
        action_url = "transactions/" + id + "/confirmtransaction";
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#transaction_action_button").attr("disabled", true);
            $("#transaction_action_button").attr("value", "Loading..");
        },
        success:function(data){
            $("#transaction_action_button").attr("disabled", false);

            if($('#transaction_action').val() == 'transaction_datail'){
                if(data.transaction_detail){
                   
                   
                    $("#transaction_action_button").attr("value", "All Agreed and Confirmed Payment");
                    $('#transactionForm')[0].reset();
                    $('#transactionModal').modal('hide');
                    $('.select2').select2({
                        placeholder: 'Please Select'
                    });

                    $('#success-alert').addClass('bg-success');
                    $('#success-alert').html('<strong>' + data.transaction_detail + '</strong>');
                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });

                }
            }else{
                
                if(data.errors){
                    $("#transaction_action_button").attr("value", "Review Payment");
                    $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                            $('#error_'+key).html(value)
                        }
                    
                    })
                }
                if(data.transaction_form){
                    
                    $('.form-control').removeClass('is-invalid');
                    $('.select2').select2({
                        placeholder: 'Please Select'
                    });
                    $('.error_transaction').html(null);
                    $('#transaction_form').hide();
                    $('#transaction_detail').show();


                    $('#transaction_action').val('transaction_datail');
                    $('#transaction_id').val(data.transaction_form);
                    $("#transaction_action_button").attr("value", "All Agreed and Confirmed Payment");
                    $("#transaction_back").text("Back");
                    $('.modal-title-transaction').text('Transaction Detail');
                    
                    var transaction_id = data.transaction_form;
                    var _token =  $('input[name="_token"]').val();
                    $.ajax({
                            url:"{{ route('admin.transactions.show') }}",
                            method:"POST",
                            dataType: "json",
                            data:{transaction_id:transaction_id, _token:_token},
                            beforeSend: function() {
                                
                            },
                            success:function(data){
                                $('#td_beneficiary_name').text(data.beneficiary_name);
                                $('#td_order_id').text(data.order_id);
                                $('#td_bank_name').text(data.bank_name);
                                $('#td_account_number').text(data.account_number);

                                $('#td_send_amount').text(data.send_amount);
                                $('#td_service_charge').text(data.service_charge);
                                $('#td_total_to_pay').text(data.total);
                                
                            }
                        });
                }
            }
                

            
           
        }
    });
});

$(document).on('click', '#transaction_back', function(){
    if($('#transaction_action').val() == 'transaction_form'){
        $('#transactionModal').modal('hide');
    }
    else if($('#transaction_action').val() == 'transaction_datail'){
        $('#transaction_detail').hide();
        $('#transaction_form').show();
        $('#transaction_action').val('Edit')
        $("#transaction_action_button").attr("value", "Review Payment");
        $("#transaction_back").text("Close");
    }
    else if($('#transaction_action').val() == 'Edit'){
        $('#transactionModal').modal('hide');
    }
});

//Seclect Exchange


$('select[name="select_exchange"]').on("change", function(event){
    var exchange = $('#select_exchange').val();
    var _token =  $('input[name="_token"]').val();
    var send = $('#exchange_send').val();
    if(send == ''){
        $('#error_exchange_send').text('You send field is required. Please input a number');
        $('#select_exchange').val(null).trigger('change');
    }
    else{
        if(exchange != ''){
            $.ajax({
                url:"{{ route('admin.home.exchangerate') }}",
                method:"POST",
                dataType: "json",
                data:{exchange:exchange, send:send , _token:_token},
                beforeSend: function() {
                    
                },
                success:function(data){
                    $('#error_exchange_send').text('');
                    $('#value_exchange').text(data.value + ' ' + data.code);
                    $('#exchange_get').val(parseFloat(data.receive.toFixed(2)));
                    $('#total_exchange').text(data.total + ' JPY');
                    $('#total_service').text(data.charge + ' JPY')
                   
                }
            });
        }
    }
 

});

$('#exchange_send').on('keyup' , function(){
    $('#select_exchange').val(null).trigger('change');
    $('#exchange_get').val('0.00');
    $('#total_exchange').text('0 JPY');
    $('#total_service').text('0 JPY');
});


</script>
@endsection