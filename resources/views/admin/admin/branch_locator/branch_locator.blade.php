@extends('layouts.admin1')
@section('content')
<div class="section" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center; min-height: 750px;">
      <div class="container">
      <div class="row">
            <div class="col-md-4">
            <p class="category text-dark">Branch Locator</p>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#bank_atm" role="tab">Bank & ATMs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bank_atm" role="tab">Cash Pick Up</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="bank_atm" role="tabpanel">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="now-ui-icons ui-1_zoom-bold"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="address" id="address"  class="form-control font-weight-bold map-input" placeholder="Search a address here">
                                    
                                </div>
                                <input type="hidden" name="latitude" id="address-latitude"  />
                                <input type="hidden" name="longitude" id="address-longitude" />
                            </div>
                            <div class="form-group text-center">
                                <select name="province" id="province" class="form-control select2" style="width: 100%">
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
                                    <select name="city" id="city" class="form-control select2" style="width: 100%">
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
                                                @foreach ($banks as $bank)
                                                    <div id="btn_bank" address="{{$bank->address}}" class="col-sm-11 btn btn-outline-primary">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <h6 class="text-dark font-weight-bold">{{$bank->bank_name}}</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <i class="now-ui-icons travel_info" style="font-size: 23px"></i>
                                                            </div>
                                                        </div>
                                                        <hr class="my-2 bg-primary">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tabs on plain Card -->
            </div>
            <div class="col-md-8">
                <div class="card">
               
                    
                    <div id="address-map-container" class="mb-2" style="width:100%;height:600px; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                   
                </div>
            </div>
          
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
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url: "branch_locator/cities_province_banks", 
        type: "POST",
        dataType: "HTMl",
        data:{province:province, city:city, _token:_token},
        beforeSend: function() {
           
        },
        success: function(data){
            $("#list_of_banks").html(data);
        }	
    })
}
</script>
@endsection