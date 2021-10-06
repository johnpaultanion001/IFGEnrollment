@extends('layouts.admin1')
@section('content')
<div class="section section-signup" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center; min-height: 750px;">
      <div class="container">
        <div class="row">
          <div class="card card-signup" data-background-color="orange">
            <form class="form-horizontal" method="post" id="trackerForm">
              @csrf
              <div class="card-header text-center">
                <h3 class="card-title title-up">Track Your Remittance</h3>
              </div>
              
              <div class="card-body">
              <div id="tracker">
                      
              </div>

              <h4 class="text-center" id="track_another_transaction">Track Another Transaction</h4>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons files_box"></i>
                    </span>
                  </div>
                  <input type="text" id="reference_number" name="reference_number" class="form-control font-weight-bold" placeholder="Insert Reference Number">
                  
                </div>
                <div id="error_reference_number" class="text-white font-weight-bold"></div>
              </div>
              <div class="card-footer text-center">

              
                <input type="button" name="track_status" id="track_status" class="btn btn-neutral btn-round btn-lg" value="Track Status" />
              </div>
            </form>
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