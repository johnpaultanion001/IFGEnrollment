@extends('layouts.admin1')
@section('content')
<div class="section" style="background: #e0e0e0;">
      <div class="container">
        <div class="row">
          <div class="card card-signup  py-4 ">
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="card-header text-center mx-auto">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="card-title title-up color-black 
                        ">Forgot your password? </h3>
                      
                      <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Provide your registered email</b></p>
                    <hr>
              </div>
              
              <div class="card-body">
                <div class="form-group pt-2">
                      <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email"  value="{{old('email')}}"  autofocus >
                      @if($errors->has('email'))
                      <div class="invalid-feedback color-red">
                        
                          <strong>  {{ $errors->first('email') }} </strong>
                      </div>
                      @endif
                  </div>
              </div>
              <div class="card-footer text-center">
                <input type="submit" name="login" id="login" class="btn btn-primary btn-lg" value="Send Password Reset Link" />
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