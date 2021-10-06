@extends('layouts.admin1')
@section('content')
<div class="section" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center; min-height: 750px;">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card" >
              <form class="form-horizontal" method="post" id="contactForm">
                @csrf
                <div class="card-header text-center">
                  <h3 class="card-title title-up">Contact Us</h3>
                  <div class="social-line">
                    <a href="#" class="btn btn-primary  btn-icon btn-round">
                      <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="btn btn-primary  btn-icon btn-round">
                       <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="btn btn-primary btn-icon btn-round">
                      <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-primary btn-icon btn-round">
                      <i class="fab fa-tiktok"></i>
                    </a>
                  </div>
                </div>
                
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Name<span class="text-primary">*</span> </label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Enter Email<span class="text-primary">*</span> </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Name">
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-email"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Phone Number<span class="text-primary">*</span> </label>
                        <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number">
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-phone_number"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Select your desired country<span class="text-primary">*</span> </label>
                        <select name="desired_country" id="desired_country" class="form-control select2" style="width: 100%">
                            <option value="" disabled selected>Please Select</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->country}}"> {{$country->country}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-desired_country"></strong>
                        </span>
                    </div>
                    <div class="textarea-container">
                      <textarea class="form-control" name="message" id="message"  rows="4" cols="80" placeholder="Type a message..."></textarea>
                      <span class="invalid-feedback" role="alert">
                          <strong id="error-message"></strong>
                      </span>
                    </div>

                </div>
                <div class="card-footer text-center">

                
                  <input type="submit" name="btn_send" id="btn_send" class="btn btn-primary btn-round btn-lg" value="Send" />
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card" >
              <div class="card-body">
                <p class="text-primary font-weight-bold">Philippines Office Address:</p>
                <p class=" font-weight-bold">UNIT 707 BSA Twin Towers Bank Drive Ortigas Center Mandaluyong City Philippines</p>
              </div>
            </div>
            <div class="card" >
              <div class="card-body">
                <p class="text-primary font-weight-bold">Phone Number:</p>
                <p class=" font-weight-bold">0917 676 0070</p>
              </div>
            </div>
            <div class="card" >
              <div class="card-body">
                <p class="text-primary font-weight-bold">Email:</p>
                <p class=" font-weight-bold">philippines@jpremit.com</p>
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
</div>


@endsection
@section('scripts')
<script>
$('#contactForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid');
    var action_url = "/contactus";
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#btn_send").attr("disabled", true);
            $("#btn_send").attr("value", "Sending..");
        },
        success:function(data){
            $("#btn_send").attr("disabled", false);
            $("#btn_send").attr("value", "Send");
            
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
                    $('#contactForm')[0].reset();
                    $('#desired_country').select2({
                        placeholder: 'Select Category'
                    })
              }
           
           
        
        }
    });
  
    
});

</script>
@endsection