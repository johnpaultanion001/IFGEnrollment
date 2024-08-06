@extends('layouts.admin1')
@section('content')
<div class="section py-0" style="background: #e0e0e0;">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-12 col-md-12 my-auto">
            <div class="card card-signup d-block mx-auto" style="background: transparent; box-shadow: 0 0 0;">
              <div class="card-grey py-4">
                <form id="myForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-header text-center px-3 px-md-4 py-0">
                      
                      <h3 class="card-title title-up color-black mt-4
                      ">Sign up</h3>
                     
                      <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Getting started is easy. Sign up now.</b></p>
                    </div>
                    
                    <div class="card-body px-4 px-md-5">
                     
                      <div class="form-group">
                      <label class="control-label" >Email (Must be active) <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}"  autofocus >
                        @if($errors->has('email'))
                        <div class="invalid-feedback color-red">
                          <strong>{{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                      <label class="control-label" >Referral Code <span class="text-danger">*</span></label>
                        <input type="text" id="referral_code" name="referral_code" class="classic-input form-control font-weight-bold {{ $errors->has('referral_code') ? ' is-invalid' : '' }}"  value="{{old('referral_code')}}" >
                        @if($errors->has('referral_code'))
                        <div class="invalid-feedback color-red">
                          <strong>{{ $errors->first('referral_code') }}</strong>
                           
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                      <label class="control-label" >Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" class="classic-input form-control font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                        @if($errors->has('password'))
                          <div class="invalid-feedback color-red">
                            <strong>{{ $errors->first('password') }}</strong>  
                          </div>
                        @endif
                      </div>
                      <div class="form-group">
                      <label class="control-label" >Password Confirm <span class="text-danger">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="classic-input form-control font-weight-bold">
                        <span toggle="#confirm_password-field" class="fa fa-fw fa-eye field_icon toggle-confirm_password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>

                      </div>
                   
                      
                      <input type="submit" name="register" id="register" class="btn btn-main" value="Register" />
                      
                    </div>
                  </form>
                </div>
                <p class="text-center mt-3 color-black" style="font-size: 13px;">Already have an account? <a href="/login"><b class="color-black" style="font-weight: 700">Login here</b></a></p>
              </div>
          </div>
        
        </div>
        
      </div>
</div>

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>
@endsection
@section('scripts')
<script>
$("body").on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-confirm_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password_confirmation");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});




</script>
@endsection