@extends('layouts.admin1')
@section('content')
<div class="section py-0" style="background: #e0e0e0;">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-5 col-md-6 my-auto">
            <div class="card card-signup d-block mx-auto" style="background: transparent; box-shadow: 0 0 0;">
              <div class="card-grey py-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-header text-center px-3 px-md-4 py-0">
                      <img src="../assets/images/web/jrf-logo.png" alt="">
                      <h3 class="card-title title-up color-black mt-4
                      ">Sign up</h3>
                      <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Getting started is easy. Sign up now.</b></p>
                    </div>
                    
                    <div class="card-body px-4 px-md-5">
                      <div class="form-group pt-4">
                        <b class="color-red">Select Language: </b> 
                        <select name="" id="" class="classic-input ml-1 px-2  py-1">
                          <option value="">EN</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" autofocus >
                        @if($errors->has('email'))
                        <div class="invalid-feedback color-red">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <input type="password" id="password" name="password" class="classic-input form-control font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback color-red">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="classic-input form-control font-weight-bold" placeholder="Confirm Password">
                      </div>
                      
                      <input type="submit" name="register" id="register" class="btn btn-main" value="Register" />
      
                    </div>
                  </form>
                </div>
                <p class="text-center mt-3 color-black" style="font-size: 13px;">Already have an account? <a href="/login"><b class="color-black" style="font-weight: 700">Login here</b></a></p>
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



</script>
@endsection