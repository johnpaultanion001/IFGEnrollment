@extends('layouts.admin1')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header p-2">
            <h4>
                ADMIN BILLING
            </h4>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center table-flush datatable-table display" width="100%">
                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th class="h6">
                                Name
                            </th>
                            <th class="h6">
                                Dependents
                            </th>
                            <th class="h6">
                                MEMBERSHIP TYPE
                            </th>
                            <th class="h6">
                                Endorse To:
                            </th>
                            <th class="h6">
                                Status
                            </th>
                            <th class="h6">
                                Created At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($memberDetails as $data)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-transparent" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="now-ui-icons ui-1_settings-gear-63"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="btn btn-link m-0 text-reset text-secondary view_quatation" member="{{$data->id ?? ""}}" href="#">View Quatation</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-link m-0 text-reset text-dark h6 " href="/admin/membership/principal/{{$data->referral_code ?? ''}}" target="_blank"> {{ $data->last_name ?? '' }}, {{ $data->first_name ?? '' }} ({{ $data->middle_name ?? 'N/A' }}) </a> <br>
                            </td>
                            <td>
                                @foreach($data->dependents()->get() as $item)
                                <a class="btn btn-link m-0 text-reset text-info h6 " href="/admin/membership/dependent/{{$item->referral_code ?? ''}}" target="_blank">{{ $item->last_name ?? '' }}, {{ $item->first_name ?? '' }} ({{ $item->middle_name ?? 'N/A' }}) - {{ $item->membership_type ?? '' }}</a> <br>
                                @endforeach
                            </td>
                            <td>
                                <strong>{{ $data->membership_type ?? '' }}</strong>

                            </td>
                            <td>

                                <div class="form-group">
                                    <select class="select2 form-control select_endorse_to" member="{{  $data->id ?? '' }} " style="width: 100%" value="{{$data->endorse_to}}">
                                        <option value="" disabled selected>Please select</option>
                                        <option value="SALES" {{$data->endorse_to == 'SALES' ? 'selected':''}}>SALES</option>

                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-success h6">{{$data->status ?? ""}}</div>
                            </td>
                            <td>
                                {{ $data->created_at->format('M j , Y h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<form method="post" id="formQuatation" class="form-horizontal ">
    @csrf
    <div class="modal" id="modalQuatation" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">Quatation Form</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>


                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="col-xl-12 mb-4">
                        <div class="card " style="background: #e0e0e0;">
                            <div class="card-body">
                                <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <p class="fw-bold  text-dark h6">Account Name:</p>
                                        <p class="fw-bold  text-dark h6 account_name"> </p>
                                    </div>
                                </div>
                                <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                    <p class="fw-bold mb-1 text-dark">Sales Order</p>
                                    <div class="form-group" style="height:600px; overflow-y: auto; overflow-x: hidden;">
                                        <div id="principal_charge" class="m-2">

                                        </div>
                                        <div id="dependents_charge" class="m-2">

                                        </div>

                                        <div class="parentContainer m-2">
                                            <hr>
                                            <div class="row childrenContainer">
                                                <div class="col-10">

                                                    <p class="text-dark h5 ">SUBTOTAL</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="text-dark h5 subtotal font-weight-bold">0</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="charge_section">

                                        </div>
                                        <div class="parentContainer m-2">
                                            <hr>
                                            <div class="row childrenContainer">
                                                <div class="col-10">

                                                    <p class="text-dark h5">TOTAL</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="text-dark h5 total font-weight-bold">0</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-danger font-weight-bold">* To remove, Leave the item field blank.</p>
                                <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">

                                    <a class="btn btn-info m-0 add_charge text-white font-weight-bold" target="_blank" role="button" data-ripple-color="primary" data-mdb-ripple-init>ADD CHARGE</a>
                                </div>



                            </div>

                        </div>
                    </div>


                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>

                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="FOR PAYMENT" />

                </div>

            </div>
        </div>
    </div>
</form>





@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.datatable-table').DataTable({
            pageLength: 10,
            "scrollX": true,
            "sScrollXInner": "100%",
            "sScrollY": "500",
            "bDestroy": true,
            buttons: [],
        })
    });

    $('.select_endorse_to').on("change", function(event) {
        var endorseTo = $(this).val();
        var member = $(this).attr('member');
        console.log(member);

        $.confirm({
            title: 'Confirmation',
            content: 'You really want to endorce to ' + endorseTo + ' ? <br><br> This member will be accessible to you once you confirm.',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function() {
                        return $.ajax({
                            url: "/admin/endorse_to/" + member + "/" + endorseTo,
                            method: 'PUT',
                            data: {
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType: "json",
                            beforeSend: function() {

                            },
                            success: function(data) {
                                return alertPopup(data.success, 'success');
                            }
                        })
                    }
                },
                cancel: {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],
                    action: function() {
                        location.reload();
                    }
                }
            }
        });
    });
    var count = 0;

    function viewQuatation(id) {
        $.ajax({
            url: "/admin/quatation/" + id,
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data.result);
                $.each(data.result, function(key, value) {
                    if (key == 'name') {
                        $('.account_name').text(value)
                    }

                    if (key == 'subtotal') {
                        $('.subtotal').text(value);
                    }
                    if (key == 'total') {
                        $('.total').text(value);
                    }



                    if (key == 'principal') {
                        var princ = '';
                        princ += `
                            <div class="row childrenContainer">
                                <div class="col-10">
                                    <h6>Item</h6>
                                    <p class="text-dark h6">` + value.item + `</p>
                                    <input type="hidden"  name="qmember[p` + value.id + `][qid]" class="form-control" value="` + value.qid + `" />
                                    <input type="hidden"  name="qmember[p` + value.id + `][id]" class="form-control" value="` + value.id + `" required/>
                                    <input type="hidden"  name="qmember[p` + value.id + `][item]" class="form-control" value="` + value.item + `" required/>
                                    <input type="hidden"  name="qmember[p` + value.id + `][type]" class="form-control" value="` + value.type + `" required/>
                                </div>
                                <div class="col-2">
                                    <h6>Amount</h6>
                                    <input type="text"  name="qmember[p` + value.id + `][amount]" class="form-control" value="` + value.amount + `" required/>
                                </div>
                                
                            </div>
                        `;

                        $('#principal_charge').empty().append(princ);
                        count += 1;
                    }
                    if (key == 'dependents') {
                        var depend = "";
                        $.each(value, function(key, value) {
                            depend += `
                                <div class="row childrenContainer">
                                    <div class="col-10">
                                        <h6>Item</h6>
                                        <p class="text-dark h6">` + value.item + `</p>
                                        <input type="hidden"  name="qmember[d` + key + `][qid]" class="form-control" value="` + value.qid + `" />
                                        <input type="hidden"  name="qmember[d` + key + `][id]" class="form-control" value="` + value.id + `" required/>
                                        <input type="hidden"  name="qmember[d` + key + `][item]" class="form-control" value="` + value.item + `" required/>
                                        <input type="hidden"  name="qmember[d` + key + `][type]" class="form-control" value="` + value.type + `" required/>
                                    </div>
                                    <div class="col-2">
                                        <h6>Amount</h6>
                                        <input type="text"  name="qmember[d` + key + `][amount]" class="form-control" value="` + value.amount + `" required/>
                                    </div>
                                    
                                </div>
                            `;
                            count += 1;
                        });
                        $('#dependents_charge').empty().append(depend);
                    }
                    if (key == 'charges') {
                        var charge = "";
                        $.each(value, function(key, value) {
                            charge += `
                                <div class="parentContainer m-2">
                                    <div class="row childrenContainer">
                                        <div class="col-10">
                                            <h6>Item</h6>
                                            <input type="hidden"  name="qmember[cs` + key + `][qid]" class="form-control" value="` + value.qid + `" />
                                            <input type="hidden"  name="qmember[cs` + key + `][id]" class="form-control" value="` + value.id + `" />
                                            <input type="text"  name="qmember[cs` + key + `][item]" class="form-control"  value="` + value.item + `" />
                                            <input type="hidden"  name="qmember[cs` + key + `][type]" class="form-control" value="` + value.type + `" />
                                            
                                        </div>
                                        <div class="col-2">
                                            <h6>Amount</h6>
                                            <input type="text"  name="qmember[cs` + key + `][amount]" class="form-control"  value="` + value.amount + `" />
                                        </div>
                                        
                                    </div>
                                </div>
                            `;
                            count += 1;
                        });
                        $('#charge_section').empty().append(charge);
                    }
                    $('#modalQuatation').modal('show')
                })
            }
        })
    }

    var memberID = "";
    $('.view_quatation').on("click", function(event) {

        memberID = $(this).attr('member', );
        viewQuatation(memberID);

    });


    $(document).on('click', '.add_charge', function() {
        count++;

        var html = '';
        html += `
            <div class="parentContainer m-2">
                <div class="row childrenContainer">
                    <div class="col-10">
                        <h6>Item</h6>
                        <input type="hidden"  name="qmember[c` + count + `][qid]" class="form-control" value="` + count + `" />
                        <input type="hidden"  name="qmember[c` + count + `][id]" class="form-control" value="` + memberID + `" />
                        <input type="text"  name="qmember[c` + count + `][item]" class="form-control" />
                        <input type="hidden"  name="qmember[c` + count + `][type]" class="form-control" value="addCharge" />
                        
                    </div>
                    <div class="col-2">
                        <h6>Amount</h6>
                         <input type="text"  name="qmember[c` + count + `][amount]" class="form-control"  />
                    </div>
                    
                </div>
            </div>
        `;
        $('#charge_section').append(html);
    });

    $('#formQuatation').on('submit', function(event) {
        event.preventDefault();
        var form = new FormData(this)
       
        $.confirm({
            title: 'Confirmation',
            content: 'You really want to confirm this?',
            type: 'blue',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function() {
                        return $.ajax({
                            url: "/admin/quatation/" + memberID,
                            method: "POST",
                            dataType: "json",
                            data: form,
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $("#action_button").attr("disabled", true);
                            },
                            success: function(data) {
                                $("#action_button").attr("disabled", false);

                                if (data.success) {
                                    viewQuatation(data.memberID);
                                    $.confirm({
                                        title: 'Success Message',
                                        title: data.success,
                                        content: 'Do you want to endorce to SALES? <br><br> This member will be accessible to you once you confirm.',
                                        type: 'blue',
                                        buttons: {
                                            confirm: {
                                                text: 'confirm',
                                                btnClass: 'btn-blue',
                                                keys: ['enter', 'shift'],
                                                action: function() {
                                                    return $.ajax({
                                                        url: "/admin/endorse_to/" + data.memberID + "/" + "SALES",
                                                        method: 'PUT',
                                                        data: {
                                                            _token: '{!! csrf_token() !!}',
                                                        },
                                                        dataType: "json",
                                                        beforeSend: function() {

                                                        },
                                                        success: function(data) {
                                                            $.confirm({
                                                                content: data.success,
                                                                type: 'green',
                                                                buttons: {
                                                                    confirm: {
                                                                        text: 'confirm',
                                                                        btnClass: 'btn-blue',
                                                                        keys: ['enter', 'shift'],
                                                                        action: function() {
                                                                            location.reload();
                                                                        }
                                                                    },

                                                                }
                                                            });
                                                        }
                                                    })
                                                }
                                            },
                                            cancel: {
                                                text: 'cancel',
                                                btnClass: 'btn-red',
                                                keys: ['enter', 'shift'],
                                                action: function() {

                                                }
                                            }
                                        }
                                    });

                                }
                            }
                        })
                    }
                },
                cancel: {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],
                    action: function() {
                        location.reload();
                    }
                }
            }
        });

    });
</script>
@endsection