@extends('layouts.admin1')
@section('content')
    <div id="loadRecipient">
        
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
                                    <label class="control-label text-uppercase" >Delivery Type <span class="text-danger">*</span> </label>
                                    <select name="payment_mode" id="payment_mode" class="form-control select2" style="width: 100%">
                                        <option value="" disabled selected>Please Select</option>
                                        <option value="Account Deposit">Account Deposit</option>
                                        <option value="Cash Pick Up">Cash Pick Up</option>
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
                                            <option value="{{$bank->id}}"> {{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-bank_name"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6" id="section_account_number">
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
                                    <label class="control-label text-uppercase" >Beneficiary Email<span class="text-danger">*</span></label>
                                    <input type="email" name="beneficiary_email" id="beneficiary_email" class="form-control" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-beneficiary_email"></strong>
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
                                    <div id="section_relation_with_beneficiary_others">
                                        <label class="control-label text-uppercase" >Others<span class="text-danger">*</span> </label>
                                        <input type="text" name="relation_with_beneficiary_others" id="relation_with_beneficiary_others" class="form-control" />
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-relation_with_beneficiary"></strong>
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
                                    <div id="section_purpose_of_remit_others">
                                        <label class="control-label text-uppercase" >Others<span class="text-danger">*</span> </label>
                                        <input type="text" name="purpose_of_remit_others" id="purpose_of_remit_others" class="form-control" />
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-purpose_of_remit"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            
                        
                            
                            
                        </div>
                        <input type="hidden" name="beneficiary_user_id" id="beneficiary_user_id"  value="{{Auth::user()->id}}"/>
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
                                </div>
                                
                            </div>    
                            <div class="col-sm-12"> 
                                <div class="col-sm-8 mx-auto">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Receive Amount</label>
                                        <div class="input-group">
                                            <input type="text" name="receive_amount" id="receive_amount" step="any" placeholder="0.00" class="form-control" readonly>
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
                                        <label class="control-label text-uppercase" >Delivery Type</label>
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
                                                        <h5 class="text-primary" id="you_send">0.00</h5>
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
                                                        <h5 class="text-primary" id="they_get">0.00</h5>
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
                                                                        <input type="text" class="form-control" readonly id="service_charge" value="0.00">
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
                                                                        <input type="text" class="form-control" readonly id="total" value="0.00">
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
                        <div id="transaction_confirm" class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
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
                        <input type="text" name="transaction_action" id="transaction_action" value="compute" />
                        <input type="text" name="transaction_beneficiary_id" id="transaction_beneficiary_id" />
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer bg-white">
                        <button type="button" id="transaction_back" class="btn btn-white text-uppercase">BACK</button>
                        <input type="submit" name="transaction_action_button" id="transaction_action_button" class="text-uppercase btn btn-primary" value="COMPUTE" />
                    </div>
            
                </div>
            </div>
        </div>
    </form>

    <div class="modal" id="transactionDetailModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="text-uppercase font-weight-bold">TRANSACTION DETAIL</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body" >
                    <div id="transaction_detail" class="row">
                       
                        <div class="col-sm-12">
                            <h6>TRANSACTION DETAILS</h6>
                            <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Transaction ID:</th>
                                            <td id="transaction_id"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">DATA TIME:</th>
                                            <td id="lbl_date_time"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">REFERENCE NUMBER</th>
                                            <td id="lbl_reference_number"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">TRANSFER AMOUNT:</th>
                                            <td id="lbl_transfer_amount"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">RECEIVE AMOUNT:</th>
                                            <td id="lbl_receive_amount"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">EXCHANGE RATE:</th>
                                            <td id="lbl_exchange_rate"></td>
                                        </tr>
                                    <tr>
                                            <th scope="row">SERVICE CHARGE:</th>
                                            <td id="lbl_service_charge"></td>
                                    </tr>
                                    <tr>
                                            <th scope="row">TOTAL TO PAY:</th>
                                            <td id="lbl_total_to_pay"></td>
                                    </tr>
                                    </tbody>
                            </table>

                            <h6>YOUR BENEFICIARY INFORMATION</h6>
                            <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">BENEFICIARY NAME:</th>
                                            <td id="lbl_beneficiary_name"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">BANK NAME:</th>
                                            <td id="lbl_bank_name"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ACCOUNT NUMBER:</th>
                                            <td id="lbl_account_number"></td>
                                        </tr>
                                    </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" id="transaction_cancel" class="btn btn-danger text-uppercase">CANCEL</button>
                    <input type="button"  id="transaction_detail_print_button" class="text-uppercase btn btn-success" value="PRINT" />
                    <input type="button" data-dismiss="modal" name="transaction_detail_action_button" id="transaction_detail_action_button" class="text-uppercase btn btn-primary" value="SAVE" />
                </div>
        
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>

$(function () {

    $('#transaction_confirm').hide();
    $('#transaction_action').hide();
    $('#transaction_beneficiary_id').hide();
    $('#section_relation_with_beneficiary_others').hide();
    $('#section_purpose_of_remit_others').hide();
    return loadRecipient();
    
});

function loadRecipient(){
    $.ajax({
        url: "recipient/load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
          
        },
        success: function(response){
            $("#loadRecipient").html(response);
        }	
    })
}


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
                return loadRecipient();
             
                
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
                    if(key == 'mobile_number'){
                        $('#beneficiary_mobile_number').val(value);
                    }
                }
            })
            if(data.b_address){
                $('#beneficiary_address').val(data.b_address);
            }
            if(data.b_cn){
                $('#beneficiary_mobile_number').val(data.b_cn);
            }
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
                            return loadRecipient();
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

//send money
$(document).on('click', '.send_money_beneficiary', function(){
    var beneficiary = $(this).attr('send');
    var _token =  $('input[name="_token"]').val();

    $('.modal-title-transaction').text('Transaction Form');
    $('#error_select_recipient').html(null);
    $('#transactionModal').modal('show');
    // $('#transactionForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#transaction_beneficiary_id').val(beneficiary)

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

});



function transaction_details(){
    var transaction_id = $('#transaction_id').text();
    $.ajax({
        url: "/admin/transaction/transaction_details", 
        type: "get",
        dataType: "json",
        data: {
            transaction_id:transaction_id,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            $("#transaction_detail_action_button").attr("disabled", true);
            $("#transaction_detail_action_button").attr("value", "LOADING...");
        },
        success: function(data){
            $("#transaction_detail_action_button").attr("disabled", false);
            $("#transaction_detail_action_button").attr("value", "SAVE");

            $('#lbl_date_time').text(data.date_time);
            $('#lbl_reference_number').text(data.reference_number);
            $('#lbl_transfer_amount').text(data.transfer_amount);
            $('#lbl_receive_amount').text(data.receive_amount);
            $('#lbl_exchange_rate').text(data.exchange_rate);
            $('#lbl_service_charge').text(data.service_charge);
            $('#lbl_total_to_pay').text(data.collected_amount);
            $('#lbl_beneficiary_name').text(data.beneficiary_name);
            $('#lbl_bank_name').text(data.bank_name);
            $('#lbl_account_number').text(data.account_number);

        }	
    })
}

$('#transactionForm').on('submit', function(event){
    event.preventDefault();
    var action_url =  "{{ route('admin.transactions.compute') }}";
    var type       =  "GET";

    if($('#transaction_action').val() == 'submit'){
        action_url = "{{ route('admin.transactions.confirm') }}";
        type =  "GET";
    }
    if($('#transaction_action').val() == 'confirm'){
        action_url = "{{ route('admin.transactions.store') }}";
        type =  "POST";
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
            if($('#transaction_action').val() == 'compute'){
                $("#transaction_action_button").attr("disabled", false);
                $("#transaction_action_button").attr("value", "COMPUTE");
            }else{
                $("#transaction_action_button").attr("disabled", false);
                $("#transaction_action_button").attr("value", "SEND");
            }
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                            $('#error_'+key).html(value)
                        }
                    })
            }
            if(data.submit){
                $('.error_transaction').text('');
                $('#transaction_action').val(data.submit);
                $("#transaction_action_button").attr("disabled", false);
                $("#transaction_action_button").attr("value", "SEND");

                $('#receive_amount').val(data.receive);
                $('#they_get').text(data.receive);
                $('#you_send').text(data.send);
                $('#total').val(data.total);
                $('#service_charge').val(data.charge);
            }
            if(data.confirm){
                $('#transaction_form').hide();
                $('#transaction_confirm').show();
                $('#transaction_action').val(data.confirm);
                $("#transaction_action_button").attr("disabled", false);
                $("#transaction_action_button").attr("value", "All Agreed and Confirmed Payment");
            }
            if(data.success){
                $('.error_transaction').text('');
                $('#success-alert').addClass('bg-success');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid');
                $('#transactionForm')[0].reset();
                $('#transactionModal').modal('hide');
                $('#transactionDetailModal').modal('show');
                $('#transaction_id').text(data.transaction_id);
                transaction_details();
            }
            
           
        }
    });
});

$('#send_amount').on('keyup',function(){
    $('#transaction_action').val('compute');
    $("#transaction_action_button").attr("disabled", false);
    $("#transaction_action_button").attr("value", "COMPUTE");
})

$(document).on('click', '#transaction_cancel', function(){
  var transaction_id = $('#transaction_id').text();
  $.confirm({
      title: 'Confirmation',
      content: 'You really want cancel this transaction?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/transaction/transaction_cancel/"+transaction_id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                           
                      },
                      success:function(data){
                          if(data.success){
                                location.reload();
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

$(document).on('click', '#transaction_back', function(){
    $('#transaction_form').show();
    $('#transaction_confirm').hide();
    $('#transaction_action').val('compute');
    $("#transaction_action_button").attr("disabled", false);
    $("#transaction_action_button").attr("value", "COMPUTE");

});

$('select[id="payment_mode"]').on("change", function(event){
  if($(this).val() == 'Cash Pick Up'){
    $('#section_account_number').hide();
  }else{
    $('#section_account_number').show();
  }
  
});

$('select[id="relation_with_beneficiary"]').on("change", function(event){
  if($(this).val() == 'Others'){
    $('#section_relation_with_beneficiary_others').show();
  }else{
    $('#section_relation_with_beneficiary_others').hide();
  }
});

$('select[id="purpose_of_remit"]').on("change", function(event){
  if($(this).val() == 'Others'){
    $('#section_purpose_of_remit_others').show();
  }else{
    $('#section_purpose_of_remit_others').hide();
  }
});

$(document).on('click', '#transaction_detail_print_button', function(){
        var printContents = document.getElementById('transaction_detail').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
});


</script>
@endsection