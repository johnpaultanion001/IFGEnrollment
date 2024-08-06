@extends('layouts.admin1')
@section('content')
<div class="section py-0" style="background: #e0e0e0;">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-5 col-md-6 my-auto">
            <div class="card card-signup d-block mx-auto" style="background: transparent; box-shadow: 0 0 0;">
              <div class="card-grey py-4">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="card-header text-center mx-auto">
                    <h3 class="card-title title-up color-black 
                        ">Sign In</h3>
                      
                      <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Provide your email and password</b></p>
                    <hr>
                  </div>
            
                  <div class="card-body  px-4 px-md-5">
                  
                    <div class="form-group pt-2">
                      <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email"  value="{{old('email')}}"  autofocus >
                      @if($errors->has('email'))
                      <div class="invalid-feedback color-red">
                          {{ $errors->first('email') }}
                      </div>
                      @endif
                    </div>
                    <div class="form-group pt-1">
                      <input type="password" id="password" name="password" class="classic-input form-control font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password"  value="{{old('password')}}" >
                      <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                      @if($errors->has('password'))
                          <div class="invalid-feedback color-red">
                              {{ $errors->first('password') }}
                          </div>
                      @endif
                    </div>
                    
                    <input type="submit" name="login" id="login" class="btn btn-main" value="Login" />

                    <div class="form-group pt-4">
                        
                        <a href="/password/reset" class="ml-3 color-red" style="font-size: 12px">Forgot your password?</a>
                    </div>
                  </div>
                  
                </form>
              </div>
              <p class="text-center mt-3 color-black" style="font-size: 13px;">Do not have an account yet? <a href="/register"><b class="color-black" style="font-weight: 700">Register here</b></a></p>
            </div>
          </div>
          <div class="d-none d-md-block col-md-6 col-lg-7" style="background-image: url('../images/bg/bg3.png'); background-size: 100% 100%; background-position: top center;">
            
          </div>
        </div>
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

</script>
@endsection