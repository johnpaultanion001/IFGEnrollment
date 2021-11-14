@extends('layouts.admin1')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card d-block mx-auto px-5" style="background: transparent; box-shadow: 0 0 0;">
                    <div class="card-header">
                        <img src="../assets/images/web/jrf-logo.png" alt="">
                        <h3 class="card-title color-red title-big mt-4 mb-0">Branch Locator</h3>
                        <div class="nav nav-tabs nav-tabs-neutral d-flex justify-content-center px-0"  role="tablist">
                            <a class="nav-link active btn btn-tab" data-toggle="tab" href="#bank_atm" id="bank_atms" role="tab">Bank & ATMs</a>
                            <a class="nav-link btn btn-tab" data-toggle="tab" href="#bank_atm" id="cash_pickup" role="tab">Cash Pick Up</a>
                            <input type="hidden" id="status" value="bank">
                        </div>
                    </div>
                    <div class="card-body">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="bank_atm" role="tabpanel">
                                <div class="form-group">
                                    <input type="text" name="address" id="address"  class="classic-input2 form-control font-weight-bold map-input" placeholder="Search a address here">
                                    <input type="hidden" name="latitude" id="address-latitude" />
                                    <input type="hidden" name="longitude" id="address-longitude"/>
                                </div>
                                <div class="form-group text-center">
                                    <select name="province" id="province" class="classic-input2 form-control select2" style="width: 100%">
                                        <option value="" disabled selected>Province</option>
                                        @foreach ($provincies as $province)
                                            <option value="{{$province->province_code}}">{{$province->province_description}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-province"></strong>
                                    </span>
                                </div>
                                <div id="cities_provincies">
                                    <div class="form-group text-center">
                                        <select name="city" id="city" class="classic-input2 form-control select2" style="width: 100%">
                                            <option value="" disabled selected>City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->city_municipality_code}}">{{$city->city_municipality_description}}</option>
                                                @endforeach
                                        
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-city"></strong>
                                        </span>
                                    </div>
                                </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="scrollable">
                                                <div id="list_of_banks">
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
        </div>
    </div>

    <div class="col-lg-6">

    <div id="address-map-container col-ld-12" style="width: 100%; height:100%;">
   
    <div style="width: 100%; height: 100%" id="address-map"></div>
    </div>
  
        
           
        
    </div>
</div>




@endsection
@section('scripts')
<script src="/js/mapInput.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script> -->
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRuaXzf2jNaX7t6im3kt7vR9aKksgkhmg&libraries=places&callback=initialize&language=en&region=GB" async defer></script>

<script>
$(document).ready(function () {
    return cities_province_banks();
});

$('select[name="province"]').on("change", function(event){
  var province = $('#province').val();
  if(province != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"branch_locator/cities_province",
          method:"POST",
          dataType: "HTMl",
          data:{province:province, _token:_token},
          beforeSend: function() {
            
          },
          success:function(data){
            $("#cities_provincies").html(data);
            cities_province_banks();
          }
         });
        }
});

$('select[name="city"]').on("change", function(event){
    cities_province_banks();
});

$(document).on('click', '#btn_bank', function(){
    var address = $(this).attr('address');
    $('#address').val(address);
    $('#address').focus();
})

function cities_province_banks(){
    var province = $('#province').val();
    var city = $('#city').val();
    var status = $('#status').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url: "branch_locator/cities_province_banks", 
        type: "POST",
        dataType: "HTMl",
        data:{province:province, city:city, status:status , _token:_token},
        beforeSend: function() {
           
        },
        success: function(data){
            $("#list_of_banks").html(data);
        }	
    })
}

$(document).on('click', '#bank_atms', function(){
    $('#status').val('BANK');
    cities_province_banks();
})

$(document).on('click', '#cash_pickup', function(){
    $('#status').val('BRANCH');
    cities_province_banks();
})

</script>
@endsection