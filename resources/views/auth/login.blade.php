@extends('layouts.admin1')
@section('content')
<div class="section" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center; min-height: 750px;">
      <div class="container">
        <div class="row">
          <div class="card card-signup" data-background-color="orange">
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="card-header text-center">
                <h3 class="card-title title-up">Login Here</h3>
              </div>
              
              <div class="card-body">
                <div class="form-group">
                    <label class="control-label text-uppercase font-weight-bold" >Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" autofocus >
                        @if($errors->has('email'))
                        <div class="invalid-feedback text-white">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    </div>
                   
                </div>
                <div class="form-group">
                <label class="control-label text-uppercase font-weight-bold" >Password:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="now-ui-icons ui-1_lock-circle-open"></i>
                            </span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                        @if($errors->has('password'))
                            <div class="invalid-feedback text-white">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                
 
              </div>
              <div class="card-footer text-center">
                <input type="submit" name="login" id="login" class="btn btn-neutral btn-round btn-lg" value="Login" />
               <br>
                <a href="/password/reset">Forgot your password?</a>
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