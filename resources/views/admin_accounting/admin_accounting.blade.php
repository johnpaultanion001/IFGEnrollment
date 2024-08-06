@extends('layouts.admin1')
@section('content')

<div id="exchange_rates">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header p-2">
                <h4>
                    ADMIN ACCOUNTING
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
</div>


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
                                <div class="card-body">
                                    <p class="fw-bold mb-1 text-dark h6">Sales Order</p>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope=" h6">ITEM</th>

                                                <th scope=" h6">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody id="principal_charge">

                                        </tbody>
                                        <tbody id="dependents_charge">

                                        </tbody>

                                        <tbody id="charge_section">

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>TOTAL</th>

                                                <th class="total">0</th>
                                            </tr>
                                        </tfoot>
                                        <tfoot>
                                            <tr>
                                                <th>SUBTOTAL</th>

                                                <th class="subtotal">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>

                            <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded">
                                <div class="card-body">
                                    <p class="fw-bold mb-1 text-dark h6">Payment Details</p>
                                    <table class="table table-striped">

                                        <tbody id="receipt_data">

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-uppercase confirm_payment">Confirm this payment</button>
            </div>

        </div>
    </div>
</div>


<div id="modalViewImage" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
                <p class="modal-title  text-uppercase font-weight-bold">Uploaded Image</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img alt="no file" id="img_file" class="img-responsive">
            </div>
        </div>
    </div>
</div>



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

    var memberID = "";
    $('.view_quatation').on("click", function(event) {

        memberID = $(this).attr('member');
        viewQuatation(memberID);
    });
    $('#view_quatation_b').on("click", function(event) {
        viewQuatation(memberID);
        $('#uploadModal').modal('hide');
    });



    function viewQuatation(id) {
        $.ajax({
            url: "/admin/quatation/" + id,
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data.result);
                $.each(data.result, function(key, value) {
                    console.log(value.isQuatation);
                    if (key == 'isQuatation') {
                        if (value == false) {
                            $.confirm({
                                title: 'Confirmation',
                                content: 'This member does not currently have a quotation. ',
                                type: 'red',
                                buttons: {
                                    confirm: {
                                        text: 'confirm',
                                        btnClass: 'btn-blue',
                                        keys: ['enter', 'shift'],
                                        action: function() {

                                        }
                                    },

                                }
                            });
                        } else {
                            $('#modalQuatation').modal('show')
                        }
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
                            <tr>
                                <td>` + value.item + `</td>
                                <td>` + value.amount + `</td>
                            </tr>
                        `;

                        $('#principal_charge').empty().append(princ);
                    }
                    if (key == 'dependents') {
                        var depend = "";
                        $.each(value, function(key, value) {
                            depend += `
                                <tr>
                                    <td>` + value.item + `</td>
                                    <td>` + value.amount + `</td>
                                </tr>
                            `;
                        });
                        $('#dependents_charge').empty().append(depend);
                    }
                    if (key == 'charges') {
                        var charge = "";
                        $.each(value, function(key, value) {
                            charge += `
                                <tr>
                                    <td>` + value.item + `</td>
                                    <td>` + value.amount + `</td>
                                </tr>
                            `;
                        });
                        $('#charge_section').empty().append(charge);
                    }
                    if (key == 'name') {
                        $('.account_name').text(value)
                    }
                    if (key == 'receipt_data') {
                        console.log(value);
                        var receipt_datas = "";
                        var paymentColor = value.payment_status == 'PAYMENT REVIEW' ? 'badge-warning' : 'badge-success';
                        receipt_datas += `
                                <tr>
                                    <td>
                                            Payment Status
                                    </td>
                                    <td>
                                         <h5>  <span class="badge  ` + paymentColor + `">` + value.payment_status + `</span> </h5>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                        File Uploaded
                                </td>
                                <th  style="cursor: pointer;" class="text-info view_uploaded_id" image="` + value.file_uploaded + `">
                                     View Uploaded Image
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Reference Number
                                </td>
                            <th>
                                            ` + value.reference_number + `
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Amount Paid
                                </td>
                                <th>
                                            ` + value.amount_paid + `
                                </th>
                            </tr>
                            <tr>
                                <td>
                                        Date Upload
                                </td>
                                <th>
                                            ` + value.date_uploaded + `
                                </th>
                            </tr>
                        `;
                        $('#receipt_data').empty().append(receipt_datas);
                    }

                })
            }
        })
    }


    $('#receipt_data').on("click", '.view_uploaded_id', function(event) {
        var image = $(this).attr('image');
        console.log(image)
        $('#modalViewImage').modal('show')
        $('#img_file').attr('src', '/uploadedReceipts/' + image);
    });

    $('.confirm_payment').on("click", function(event) {
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
                            url: "/admin/payment_confirmation/" + memberID,
                            method: 'PUT',
                            data: {
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType: "json",
                            beforeSend: function() {

                            },
                            success: function(data) {
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
                                                    url: "/admin/endorse_to/" + memberID + "/" + "SALES",
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
                                                location.reload();
                                            }
                                        }
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
                        location.reload();
                    }
                }
            }
        });
    });
</script>
@endsection