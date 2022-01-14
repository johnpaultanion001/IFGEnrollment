@extends('layouts.admin1')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div style="height: 750px;" id="map"></div>
    </div>
    <div class="col-sm-6">
        <div class="card d-block mx-auto px-5" style="background: transparent; box-shadow: 0 0 0;">
                    <div class="card-header">
                      
                        <h3 class="card-title color-red title-big mt-4 mb-0">Branch Locator</h3>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn {{ request()->is('branch_locator/BANK') || request()->is('branch_locator/BANK/*') ? 'bg-primary' : '' }}" style="width: 100%;" id="bank_atms">BANK & ATM'S</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn {{ request()->is('branch_locator/CASH_AGENT') || request()->is('branch_locator/CASH_AGENT/*') ? 'bg-primary' : '' }}" style="width: 100%;" id="cash_pickup">CASH PICK UP</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                    <!-- Tab panes -->
                        <form method="post" id="address_search" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="address" id="address"  class="form-control font-weight-bold" placeholder="Search a address here">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-address"></strong>
                                    </span>
                                </div>
                                
                            </div>
                            <input type="hidden" id="status" name="status" value="{{ request()->is('branch_locator/BANK') || request()->is('branch_locator/BANK/*') ? 'BANK' : 'CASH_AGENT' }}">

                        </form>
                        <div class="form-group text-center">
                            <select name="province_dd" id="province_dd" class="classic-input2 form-control select2" style="width: 100%">
                                <option value="" disabled selected>Province</option>
                                @foreach ($provincies as $province)
                                    <option value="{{$province->province_code}}">{{$province->province_description}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-province_dd"></strong>
                            </span>
                        </div>
                        <div class="form-group text-center">
                            <select name="cities_dd" id="cities_dd" class="classic-input2 form-control select2" style="width: 100%">
                                <option value="" disabled selected>City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->city_municipality_code}}">{{$city->city_municipality_description}}</option>
                                    @endforeach
                            
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-cities_dd"></strong>
                            </span>
                        </div>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="scrollable">
                                    <div id="bank_list">
                                        @foreach ($locations as $bank)
                                        <div id="btn_locations" address="{{$bank->address}}" lat="{{$bank->lat}}" lng="{{$bank->lng}}" dplay="{{$bank->display_name}}"  class="col-sm-11 btn btn-outline-primary">
                                            <div class="row">
                                                <div class="col-10">
                                                    <h6 class="text-dark font-weight-bold">{{$bank->display_name}}</h6>
                                                    <h6 class="text-dark font-weight-bold">{{$bank->name}}</h6>
                                                    <h6 class="text-dark">{{$bank->address}}</h6>
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




@endsection
@section('scripts')
<!-- <script src="/js/mapInput.js"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script> -->
<!-- <script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRuaXzf2jNaX7t6im3kt7vR9aKksgkhmg&libraries=places&callback=initialize&language=en&region=GB" async defer></script> -->

<script>


$(document).on('click', '#btn_locations', function(){
    var address = $(this).attr('address');
    var lat = parseFloat($(this).attr('lat'));
    var lng = parseFloat($(this).attr('lng'));
    var dplay = $(this).attr('dplay');
    $('#address').val(address);
    $('#address').focus();

    var options = {
        zoom: 15,
        center: {lat:lat, lng:lng}
    }

    var map = new google.maps.Map(document.getElementById('map'), options);
    addMarker({
            coords:{lat:lat, lng:lng},
            content: dplay,
    });

    function addMarker(props){
    var marker = new google.maps.Marker({
        position:props.coords,
        map:map
    });

    //check content
    if(props.content){
        var infoWindow = new google.maps.InfoWindow({
            content: props.content
        })

        marker.addListener('click', function(){
            infoWindow.open(map, marker);
        });
    }
    }

})

function initMap(){
    var locations = <?php print_r(json_encode($locations)) ?>;

    var options = {
        zoom: 8,
        center: {lat:14.6255, lng:121.1245}
    }

    var map = new google.maps.Map(document.getElementById('map'), options);
    $.each( locations, function( index, value ){
        addMarker({
            coords:{lat:parseFloat(value.lat), lng:parseFloat(value.lng)},
            content: value.display_name,
        });
        
    });

    function addMarker(props){
        var marker = new google.maps.Marker({
            position:props.coords,
            map:map
        });

        //check content
        if(props.content){
            var infoWindow = new google.maps.InfoWindow({
                content: props.content
            })

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
            });
        }
    }
}

$(document).on('click', '#bank_atms', function(){
    window.location.href = '/branch_locator/BANK';
})

$(document).on('click', '#cash_pickup', function(){
    window.location.href = '/branch_locator/CASH_AGENT';
})

$('select[name="province_dd"]').on("change", function(event){
    var province = $(this).val();
    var status   = $('#status').val();
    $.ajax({
        url: "{{ route('branch_locator.province') }}",
        type: "get",
        dataType: "json",
        data: {
            province:province, status:status ,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            $('#province_dd').addClass('is-invalid');
            $('#error-province_dd').text('LOADING...');
        },
        success: function(data){
            $('#province_dd').removeClass('is-invalid');
            $('#error-province_dd').text('');
            
            var cities = '';
            cities += '<option value="" disabled selected>City</option>';
            $.each(data.cities, function(key,value){
                cities += '<option value="'+value.city_municipality_code+'">'+value.city_municipality_description+'</option>';
            });
            $('#cities_dd').empty().append(cities);

            var banks = '';
            $.each(data.banks, function(key,value){
                banks += '<div id="btn_locations" address="'+value.address+'" lat="'+value.lat+'" lng="'+value.lng+'" dplay="'+value.display_name+'"  class="col-sm-11 btn btn-outline-primary">';
                    banks += '<div class="row">'
                        banks += '<div class="col-10">'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.display_name+'</h6>'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.name+'</h6>'
                            banks += '<h6 class="text-dark">'+value.address+'</h6>'
                        banks += '</div>'
                        banks += '<div class="col-2">'
                            banks += '<i class="now-ui-icons travel_info" style="font-size: 23px"></i>'
                        banks += '</div>'
                    banks += '</div>'
                    banks  += '<hr class="my-2 bg-primary">',
                banks += '</div>';
            });
            $('#bank_list').empty().append(banks);

        }	
    })
});

$('select[name="cities_dd"]').on("change", function(event){
    var city = $(this).val();
    var status   = $('#status').val();
    $.ajax({
        url: "{{ route('branch_locator.city') }}",
        type: "get",
        dataType: "json",
        data: {
            city:city, status:status ,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            $('#cities_dd').addClass('is-invalid');
            $('#error-cities_dd').text('LOADING...');
        },
        success: function(data){
            $('#cities_dd').removeClass('is-invalid');
            $('#error-cities_dd').text('');
            
            var banks = '';
            $.each(data.banks, function(key,value){
                banks += '<div id="btn_locations" address="'+value.address+'" lat="'+value.lat+'" lng="'+value.lng+'" dplay="'+value.display_name+'"  class="col-sm-11 btn btn-outline-primary">';
                    banks += '<div class="row">'
                        banks += '<div class="col-10">'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.display_name+'</h6>'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.name+'</h6>'
                            banks += '<h6 class="text-dark">'+value.address+'</h6>'
                        banks += '</div>'
                        banks += '<div class="col-2">'
                            banks += '<i class="now-ui-icons travel_info" style="font-size: 23px"></i>'
                        banks += '</div>'
                    banks += '</div>'
                    banks  += '<hr class="my-2 bg-primary">',
                banks += '</div>';
            });
            $('#bank_list').empty().append(banks);

        }	
    })
});

$('#address_search').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('branch_locator.address') }}";
    var type = "GET";
    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#address').addClass('is-invalid');
            $('#error-address').text('LOADING...');
        },
        success:function(data){
            $('#address').removeClass('is-invalid');
            
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }

            var banks = '';
            $.each(data.banks, function(key,value){
                banks += '<div id="btn_locations" address="'+value.address+'" lat="'+value.lat+'" lng="'+value.lng+'" dplay="'+value.display_name+'"  class="col-sm-11 btn btn-outline-primary">';
                    banks += '<div class="row">'
                        banks += '<div class="col-10">'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.display_name+'</h6>'
                            banks += '<h6 class="text-dark font-weight-bold">'+value.name+'</h6>'
                            banks += '<h6 class="text-dark">'+value.address+'</h6>'
                        banks += '</div>'
                        banks += '<div class="col-2">'
                            banks += '<i class="now-ui-icons travel_info" style="font-size: 23px"></i>'
                        banks += '</div>'
                    banks += '</div>'
                    banks  += '<hr class="my-2 bg-primary">',
                banks += '</div>';
            });
            $('#bank_list').empty().append(banks);
        
        }
    });
});



</script>
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRuaXzf2jNaX7t6im3kt7vR9aKksgkhmg&libraries=places&callback=initMap&language=en&region=GB" async defer></script>
@endsection