@extends('layouts.admin1')
@section('content')

<div class="section"  style="background: #e0e0e0;">
      <div class="container">
        <div class="row">
          <div class="card card-signup py-4">
          <form method="POST" action="{{ route('password.request') }}">
              @csrf
              <div class="card-header text-center mx-auto">
                    <h3 class="card-title title-up color-black 
                        ">Reset your password </h3>
                      
                      <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Provide your new password</b></p>
                    <hr>
              </div>
              
              <div class="card-body text-white">
                  <input name="token" value="{{ $token }}" type="hidden">
                  <div class="form-group pt-2">
                      <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email"   value="{{ $email ?? old('email') }}"  autofocus >
                      @if($errors->has('email'))
                      <div class="invalid-feedback color-red">
                        
                          <strong>  {{ $errors->first('email') }} </strong>
                      </div>
                      @endif
                  </div>
                  <div class="form-group pt-2">
                    <input type="password" id="password" name="password" class="form-control classic-input font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                        @if($errors->has('password'))
                        <div class="invalid-feedback color-red">
                          
                            <strong>  {{ $errors->first('password') }} </strong>
                        </div>
                        @endif
                  </div>
                  <div class="form-group pt-2">
                  <input type="password" id="password-confirm" name="password_confirmation" class="classic-input form-control font-weight-bold" placeholder="Password">
                        @if($errors->has('password'))
                        <div class="invalid-feedback color-red">
                          
                            <strong>  {{ $errors->first('password') }} </strong>
                        </div>
                        @endif
                  </div>
              </div>
              <div class="card-footer text-center">
                <input type="submit" name="login" id="login" class="btn btn-primary btn-lg" value="Reset Password" />
              </div>
              
            </form>
          </div>
        </div>
        
      </div>
</div>


@endsection
@section('scripts')
<script>



</script>
@endsection