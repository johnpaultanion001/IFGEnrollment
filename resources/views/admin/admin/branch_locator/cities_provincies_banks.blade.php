@foreach ($banks as $bank)
    <div id="btn_bank" address="{{$bank->address}}" class="col-sm-11 btn btn-outline-primary">
        <div class="row">
            <div class="col-10">
                <h6 class="text-dark font-weight-bold">{{$bank->bank_name}}</h6>
            </div>
            <div class="col-2">
                <i class="now-ui-icons travel_info" style="font-size: 23px"></i>
            </div>
        </div>
        <hr class="my-2 bg-primary">
    </div>
@endforeach