
<div class="row">
    @foreach($beneficiaries as $key => $beneficiary)
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold">Customer Name:</span>
                            </div>
                            <div class="col-6">
                                <span class="font-weight-bold">{{$beneficiary->user->firstname}}  {{$beneficiary->user->lastname}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold">Customer Country:</span>
                            </div>
                            <div class="col-6">
                                <span class="font-weight-bold">{{$beneficiary->user->country}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold">Beneficiary Name:</span>
                            </div>
                            <div class="col-6">
                                <span class="font-weight-bold">{{$beneficiary->beneficiary_firstname}} {{$beneficiary->beneficiary_lastname}} </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold">Beneficiary Country:</span>
                            </div>
                            <div class="col-6">
                                <span class="font-weight-bold">{{$beneficiary->receipt_country}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="font-weight-bold">Payment Type:</span>
                            </div>
                            <div class="col-6">
                                <span class="font-weight-bold">{{$beneficiary->payment_mode}}</span>
                            </div>
                        </div>
                    </p>
                    
                    <br>
                   
                    <button type="button" edit="{{  $beneficiary->id ?? '' }}" class="edit_beneficiary btn btn-link btn-info">Edit</button>
                    <button type="button" remove="{{  $beneficiary->id ?? '' }}" class="remove_beneficiary btn-link btn-danger">Remove</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
