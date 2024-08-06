@extends('layouts.admin1')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-header p-1 mt-2 text-uppercase bg-secondary">
                            <h5 class="text-white font-weight-bold">
                                Member Search
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Select Member <span class="text-danger">*</span></label>
                                        <select name="customer_dd" id="customer_dd" class="form-control select2" style="width: 100%">
                                            <option value="" disabled selected>-</option>
                                            @foreach ($members as $member)
                                                <option value="{{$member->id}}">{{$member->last_name ?? ""}} {{$member->first_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-customer_dd"></strong>
                                        </span>
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                </div>
            </div>
           
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-header p-1 text-uppercase bg-secondary">
                            <button class = "btn btn-md btn-primary h6" id="btn_customer_detail">
                                Member Detail
                            </button>
                            <button class = "btn btn-md h6" id="btn_beneficiaries">
                                Dependents
                            </button>
                            <button class = "btn btn-md h6" id="btn_transactions">
                                Activities
                            </button>
                        </div>
                        <div id="customer_detail">
                            <div class="card-header p-1 text-uppercase bg-secondary">
                                <h5 class="text-white font-weight-bold">
                                    MEMBER INFO
                                </h5>
                               
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >Refferal Code:</label>
                                                <input type="text" name="referral_code" id="referral_code"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-referral_code"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        
                                        <button class="btn btn-info btn-sm">PRINT</button>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="row">
                                              
                                                <div class="col-sm-4">
                                                    <label class="control-label text-uppercase" >LAST NAME</label>
                                                    <input type="text" name="last_name" id="last_name"  class="form-control h6" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="control-label text-uppercase" >FIRST NAME</label>
                                                    <input type="text" name="first_name" id="first_name"  class="form-control h6" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="control-label text-uppercase" >MIDDLE NAME</label>
                                                    <input type="text" name="middle_name" id="middle_name"  class="form-control h6" readonly>
                                                </div>

                                            </div>
                                            
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >Address:</label>
                                            <input type="text" name="permanent_address" id="permanent_address"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-permanent_address"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >MOBILE NO.:</label>
                                            <input type="text" name="mobile_no" id="mobile_no"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-mobile_no"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >GENDER:</label>
                                            <input type="text" name="gender" id="gender"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-gender"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >CITIZENSHIP :</label>
                                            <input type="text" name="citizenship" id="citizenship"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-citizenship"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >TYPE OF PROGRAM:</label>
                                            <input type="text" name="type_of_program" id="type_of_program"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-type_of_program"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase" >STATUS:</label>
                                            <input type="text" name="status" id="status"  class="form-control h6" readonly>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-status"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="beneficiaries">
                            <div class="card-header p-1 text-uppercase bg-secondary">
                                <h5 class="text-white font-weight-bold">
                                    Dependent List
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush datatable-country display text-uppercase" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    ACTION
                                                </th>
                                                <th>
                                                    DEPENDENT NAME
                                                </th>
                                                <th>
                                                    TYPE OF PROGRAM
                                                </th>
                                                <th>
                                                    MEMBERSHIP TYPE
                                                </th>
                                                <th>
                                                    STATUS
                                                </th>
                                                <th>
                                                    DATE CREATED
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_dependent">
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="transactions">
                            <div class="card-header p-1 text-uppercase bg-secondary">
                                <h5 class="text-white font-weight-bold">
                                    Transactions
                                </h5>
                            </div>
                            <div class="card-body">
                               <div id="table_transaction">

                               </div>
                            </div>
                        </div>
                        
                </div>
            </div>
          
           
            
        </div>
    </div>


 


@endsection
@section('scripts')
<script>
$(function () {
    $('#customer_detail').show();
    $('#beneficiaries').hide();
    $('#transactions').hide();
});

$(document).on('click', '#btn_customer_detail', function(){

    $('#btn_customer_detail').addClass('btn-primary');
    $('#btn_beneficiaries').removeClass('btn-primary');
    $('#btn_transactions').removeClass('btn-primary');
    $('#customer_detail').show();
    $('#beneficiaries').hide();
    $('#transactions').hide();

});

// Beneficiary List
function listbeneficiaries(){
    var customer = $('#customer_dd').val();
    $.ajax({
        url: "/admin/customer/beneficiaries", 
        type: "get",
        dataType:"json",
        data: {
            customer:customer,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            $('#customer_dd').addClass('is-invalid');
            $('#error-customer_dd').text('LOADING...');
        },
        success: function(data){
            $('#customer_dd').removeClass('is-invalid');

            

        }	
    });
}

// Transaction List
function listTransactions(){
    var customer = $('#customer_dd').val();
    $.ajax({
        url: "/admin/customer/transactions", 
        type: "get",
        dataType: "HTMl",
        data: {
            customer:customer,_token: '{!! csrf_token() !!}',
        },
       success: function(response){
            $("#table_transaction").html(response);
        }	
    })
}

$(document).on('click', '#btn_beneficiaries', function(){
    var customer = $('#customer_dd').val();
    
    if(customer == null){
      $('#customer_dd').addClass('is-invalid');
      $('#error-customer_dd').text('Please select a member');
    }else{
        $('#customer_dd').removeClass('is-invalid');
        $('#btn_customer_detail').removeClass('btn-primary');
        $('#btn_beneficiaries').addClass('btn-primary');
        $('#btn_transactions').removeClass('btn-primary');
        $('#customer_detail').hide();
        $('#beneficiaries').show();
        $('#transactions').hide();
        listbeneficiaries();
    }
});

$(document).on('click', '#btn_transactions', function(){
    var customer = $('#customer_dd').val();
    
    if(customer == null){
      $('#customer_dd').addClass('is-invalid');
      $('#error-customer_dd').text('Please select a member');
    }else{
        $('#customer_dd').removeClass('is-invalid');
        $('#btn_customer_detail').removeClass('btn-primary');
        $('#btn_beneficiaries').removeClass('btn-primary');
        $('#btn_transactions').addClass('btn-primary');
        $('#customer_detail').hide();
        $('#beneficiaries').hide();
        $('#transactions').show();
        listTransactions();
    }
    

});

$('select[name="customer_dd"]').on("change", function(event){
    var member = $(this).val();
    $.ajax({
        url: "/admin/member/member_detail", 
        type: "get",
        dataType:"json",
        data: {
            member:member,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            $('#customer_dd').addClass('is-invalid');
            $('#error-customer_dd').text('LOADING...');
        },
        success: function(data){
            $('#customer_dd').removeClass('is-invalid');
            console.log(data);
            $.each(data.memberDetails ?? '', function(key,value){
                if(key == key){
                  $('#'+key).val(value);
                }
            })

            var dependents = '';
            $.each(data.dependents, function(key,value){
                dependents += '<tr>';
                    dependents += '<td> <button type="button" edit="1" class="edit btn btn-info btn-sm"><i class="fas fa-pen" aria-hidden="true"></i></button> <button type="button" remove="1" class="remove btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></button> </td>'
                    dependents += '<td>'+value.first_name+ ' ' +value.last_name+'</td>'
                    dependents += '<td>'+value.type_of_program+'</td>'
                    dependents += '<td>'+value.membership_type+'</td>'
                    dependents += '<td>'+value.status+'</td>'
                    dependents += '<td>'+value.created_at+'</td>'       
                dependents += '</tr>';
            });
            $('#list_dependent').empty().append(dependents);


            // listbeneficiaries();
            // listTransactions();
        }	
    });
      
});

</script>
@endsection