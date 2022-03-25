@extends('layouts.admin1')
@section('content')
<div class="section py-0" style="background: #e0e0e0;">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-5 col-md-6 my-auto">
            <div class="card d-block mx-auto px-5" style="background: transparent; box-shadow: 0 0 0;">
              <div class="card-contact py-4">
                <form class="form-horizontal" method="post" id="contactForm">
                  @csrf
                  <div class="card-header text-center">
                    <h3 class="card-title title-up">Contact Us</h3>
                    <p class="font-weight-bold mb-0">Philippines Office Address:</p>
                    <p style="font-size: 14px; font-weight: 400">UNIT 707 BSA Twin Towers Bank Drive Ortigas Center Mandaluyong City Philippines<br>
                    639176760070 | philippines@jpremit.com<br>
                    </p>
                    <div class="social-line">
                      <a href="https://www.facebook.com/JRFOfficialPH" target="_blank" class="btn btn-primary  btn-icon btn-round">
                        <i class="fab fa-facebook-square"></i>
                      </a>
                      <a href="https://www.youtube.com/channel/UC1HYwPpVu6gmUv2sifCj7TQ" target="_blank" class="btn btn-primary  btn-icon btn-round">
                        <i class="fab fa-youtube"></i>
                      </a>
                      <a href="https://www.instagram.com/JRFOfficialPH/" target="_blank" class="btn btn-primary btn-icon btn-round">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <a href="https://www.tiktok.com/@JRFOfficialPH" target="_blank" class="btn btn-primary btn-icon btn-round">
                        <i class="fab fa-tiktok"></i>
                      </a>
                    </div>
                  </div>
                  
                  <div class="card-body px-5">
                      <div class="form-group">
                          <input type="text" id="name" name="name" class="classic-input form-control" placeholder="Name">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-name"></strong>
                          </span>
                      </div>
                      <div class="form-group">
                          <input type="email" id="email" name="email" class="classic-input form-control" placeholder="Email">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-email"></strong>
                          </span>
                      </div>
                      <div class="form-group">
                          <input type="number" id="phone_number" name="phone_number" class="classic-input form-control" placeholder="Phone Number">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-phone_number"></strong>
                          </span>
                      </div>
                      <div class="form-group">
                          <select name="desired_country" id="desired_country" class="classic-input form-control select2" style="width: 100%">
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
                      <input type="submit" name="btn_send" id="btn_send" class="mt-5 btn btn-main btn-round btn-lg" value="Send" />
                  </div>
                </form>
                </div>
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