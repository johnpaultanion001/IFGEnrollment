@extends('layouts.admin1')
@section('content')
    <div class="container">
        <div class="row">
        
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-header p-1 mt-5 text-uppercase bg-primary">
                            <h5 class="text-white font-weight-bold">
                               CALCULATOR
                            </h5>
                            <h6 class="text-white font-weight-bold">
                              Now select sending or receiving amount, it depend on your choice, then enter amount and below your will see the total amount including fees. It is very convineint to our valuable customers.
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >SELECT COUNTRY <span class="text-danger">*</span></label>
                                        <select name="country_dd" id="country_dd" class="form-control select2" style="width: 100%">
                                          <option value="" disabled selected>...</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}"> {{$country->country}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-country_dd"></strong>
                                        </span>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >SELECT DELIVERY METHOD <span class="text-danger">*</span></label>
                                        <select name="delivery_method_dd" id="delivery_method_dd" class="form-control select2" style="width: 100%">
                                          <option value="" disabled selected>...</option>
                                          <option value="BANK">Bank Deposit</option>
                                          <option value="CASH_AGENT">Cash Agent</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-delivery_method_dd"></strong>
                                        </span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Expected delivery time:<span class="text-danger">*</span>
                                        <br> Instant </label>
                                        <select name="banks_dd" id="banks_dd" class="form-control select2" style="width: 100%">
                                          
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-banks_dd"></strong>
                                        </span>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >CHOOSE TRANSITION<span class="text-danger">*</span></label>
                                        <select name="transition_dd" id="transition_dd" class="form-control select2" style="width: 100%">
                                            <option value="" disabled selected>...</option>
                                            <option value="Sending Amount">Sending Amount</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-transition_dd"></strong>
                                        </span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label text-uppercase  mt-4" >AMOUNT <span class="text-danger">*</span></label>
                                        <input type="text" id="amount" id="amount" class="form-control">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-amount"></strong>
                                        </span>
                                        
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                       
                        <div class="card-body text-white">
                            <div class="row">
                                <div class="col-8 bg-primary p-1" style="border: 2px #fff solid;">
                                    <h5>YOUR SENDING AMOUNT</h5>
                                </div>
                                <div class="col-4 bg-secondary p-1" style="border: 2px #fff solid;">
                                    <h5 id="ysa">¥ 0</h5>
                                </div>
                                <div class="col-8 bg-primary p-1" style="border: 2px #fff solid;">
                                    <h5>OUR TRANSFER FEE</h5>
                                </div>
                                <div class="col-4 bg-secondary p-1" style="border: 2px #fff solid;">
                                    <h5 id="otf">¥ 0</h5>
                                </div>
                                <div class="col-8 bg-primary p-1" style="border: 2px #fff solid;">
                                    <h5>YOUR DEPOSITED AMOUNT</h5>
                                </div>
                                <div class="col-4 bg-secondary p-1" style="border: 2px #fff solid;">
                                    <h5 id="yda">¥ 0</h5>
                                </div>
                                <div class="col-8 bg-primary p-1" style="border: 2px #fff solid;">
                                    <h5>DESTINATION COUNTRY EXCHANGE RATE</h5>
                                </div>
                                <div class="col-4 bg-secondary p-1" style="border: 2px #fff solid;">
                                    <h5 id="dcer">¥ 0</h5>
                                </div>
                                <div class="col-8 bg-primary p-1" style="border: 2px #fff solid;">
                                    <h5>RECEIVED AMOUNT</h5>
                                </div>
                                <div class="col-4 bg-secondary p-1" style="border: 2px #fff solid;">
                                    <h5 id="receive_amount">¥ 0</h5>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                       
                        <div class="card-body text-primary" style="border: 1px #111 solid">
                            <h6>
                              The exchange rate is based on today's rate of the transfer amount from Yen to US dollars converted into the local currency. The exchange rate will be applied on the date and time of when the remittance is processed, and the rate indicated above is for reference only.
                            </h6>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
  $('select[name="delivery_method_dd"]').on("change", function(event){
      var delivery = $(this).val();
      $.ajax({
          url: "/calculator/delivery", 
          type: "get",
          dataType:"json",
          data: {
              delivery:delivery,_token: '{!! csrf_token() !!}',
          },
          beforeSend: function() {
                  $('#delivery_method_dd').addClass('is-invalid');
                  $('#error-delivery_method_dd').text('LOADING...');
          },
          success: function(data){
              $('#delivery_method_dd').removeClass('is-invalid');
              var banks = '';
              banks += '<option value="" disabled selected>...</option>';
              $.each(data.banks, function(key,value){
                  banks += '<option value="'+value.id+'">'+value.name+'</option>';
              });
              $('#banks_dd').empty().append(banks);

          }	
      });
        
  });
  $('select[name="country_dd"]').on("change", function(event){
      var country = $(this).val();
      $.ajax({
          url: "/calculator/country", 
          type: "get",
          dataType:"json",
          data: {
              country:country,_token: '{!! csrf_token() !!}',
          },
          beforeSend: function() {
                  $('#country_dd').addClass('is-invalid');
                  $('#error-country_dd').text('LOADING...');
          },
          success: function(data){
              $('#country_dd').removeClass('is-invalid');
              $('#dcer').text(data.dcer);
              $('#receive_amount').text(data.receive_amount);

          }	
      });
        
  });

  $('#amount').on('keyup',function(){
    var amount  = $(this).val();
    var country = $('#country_dd').val();
    if(country == null){
      $('#country_dd').addClass('is-invalid');
      $('#error-country_dd').text('SELECT COUNTRY');
    }else{
      $.ajax({
          url: "/calculator/amount", 
          type: "get",
          dataType:"json",
          data: {
              amount:amount,country:country,_token: '{!! csrf_token() !!}',
          },
          beforeSend: function() {
                  $('#amount').addClass('is-invalid');
                  $('#error-amount').text('LOADING...');
          },
          success: function(data){
              $('#amount').removeClass('is-invalid');
              $('#ysa').text(data.amount);
              $('#otf').text(data.charge);
              $('#yda').text(data.deposited);
              $('#receive_amount').text(data.receive);
          }	
      });
    }
      
  });

</script>
@endsection