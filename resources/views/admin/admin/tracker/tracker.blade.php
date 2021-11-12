@extends('layouts.admin1')
@section('content')
<div class="section py-0" style="background: #fff;">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-5 col-md-6 my-auto">
            <div class="card card-signup d-block mx-auto" style="background: transparent; box-shadow: 0 0 0;">
                <form class="form-horizontal" method="post" id="trackerForm">
                  @csrf
                  <div class="card-header text-center">
                    <img src="../assets/images/web/jrf-logo.png" alt="">
                    <h3 class="card-title color-red title-big mt-4 mb-0">Track Your Remittance</h3>
                  </div>
                  
                  <div class="card-body">
                    <div id="tracker">   </div> 
                      <h4 class="text-center" id="track_another_transaction">Track Another Transaction</h4>
                      <input type="text" id="reference_number" name="reference_number" class="classic-input form-control font-weight-bold" style="height: 40px" placeholder="Insert Reference Number">
                      <div id="error_reference_number" class="text-white font-weight-bold"></div>
                      <input type="button" name="track_status" id="track_status" class="btn btn-secondary mx-auto text-center d-block
                      " value="Track Status" />
                    
                  </div>
                </form>
              </div>
            </div>
          <div class="d-none d-md-block col-md-6 col-lg-7" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center;">
            
          </div>
        </div>
        
      </div>
</div>


@endsection
@section('scripts')
<script>

$(document).ready(function () {
   $('#track_another_transaction').hide();
});

$(document).on('click', '#track_status', function(){
    var reference_number = $('#reference_number').val();
    var _token =  $('input[name="_token"]').val();
    $.ajax({
            url:"{{ route('tracker.gettracker') }}",
            method:"post",
            dataType: "HTMl",
            data:{reference_number:reference_number , _token:_token},
            beforeSend: function() {
                
            },
            success:function(response){
                $('#track_another_transaction').show();
                $("#tracker").html(response);
            }
        });
});


</script>
@endsection