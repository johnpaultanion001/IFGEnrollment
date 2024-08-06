@extends('layouts.admin1')
@section('content')
<div class="section">
      <div class="container">
        <div class="row">
          <div class="card card-signup bg-primary">
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <div class="card-header text-center">
              <h2 class="text-white">Verify your email address</h2>
                        @if (session('resent'))
                            <p class="text-white bg-success font-weight-bold">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </p>
                        @endif
                        <p class="p-3 text-white">
                            we've sent an email to <b>{{auth()->user()->email}}</b> to verify your email address and activate your account. The link in the email will expire in 60 minutes.
                           <button type="submit"style="color: #910000;" class="btn btn-neutral btn-round btn-sm">Click here</button> if you did not receive an email
                        </p>
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