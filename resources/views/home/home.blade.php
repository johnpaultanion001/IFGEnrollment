@extends('layouts.admin1')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br>
            <div class="row">
                @if(auth()->user()->roles()->pluck('id')->implode(', ') != '5')
                <div class="col-lg-10 mx-auto">
                    <div class="card  bg-primary">
                        <div class="p-3 text-white">
                            Hi <b>{{auth()->user()->lastname ?? ""}} , {{auth()->user()->firstname ?? ""}} {{auth()->user()->middlename ?? ""}}</b> <br><br>
                            Welcome to our <b>{{config('app.name')}}</b> You have successfully loggin us <b> {{auth()->user()->roles()->pluck('title')->implode(', ')}} </b>.
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
                @endif
                @can('user_access')
                @if(!auth()->user()->memberDetail)
                <div class="col-lg-10 mx-auto">
                    <div class="card  bg-primary">
                        <p class="p-3 text-white">
                            Thank you for your registration to <b> {{ config('app.name') }}</b> <br> <br>
                            You can now apply your membership .
                        </p>
                        <a href="/admin/membership/principal/{{ Auth::user()->referral_code ?? "" }}" style="color: #910000;" class="m-2 btn btn-neutral btn-sm">Apply your membership here</a>
                    </div>
                </div>
                @else
                @if(auth()->user()->memberDetail->statusUser == "FOR REVIEW")
                <div class="col-lg-10 mx-auto">
                    <div class="card  bg-primary">
                        <div class="p-3 text-white">
                            Hi <b>{{auth()->user()->memberDetail->first_name ?? ""}}</b> <br><br>
                            We have successfully saved your application to our records. Please wait for the administrator's response to confirm the submission.
                            <br>
                            <br>
                            Any details of your application is will be email to your registered email <b>{{auth()->user()->email ?? ""}}</b><br>
                            If you want to edit your application details or dependents details
                            <a style="color: #910000;" class="btn btn-neutral btn-sm" href="/admin/membership/principal/{{ Auth::user()->referral_code ?? "" }}">Click here</a>
                        </div>
                    </div>
                </div>
                @endif
                @if(auth()->user()->memberDetail->statusUser == "FOR PAYMENT")
                <div class="col-lg-10 mx-auto ">
                    <div class="card bg-primary">
                        <div class="p-3 text-white">
                            Hi <b>{{auth()->user()->memberDetail->first_name ?? ""}}</b> <br><br>
                            Thank you for your patient <br>
                            Your quatation is available click the button bellow to view your quatation and upload your receipt

                        </div>
                        <br>

                        <button class="btn btn-neutral btn-sm m-2" id="view_quatation" style="color: #910000;" member="{{auth()->user()->memberDetail->id ?? ""}}">View Quatation</button>
                    </div>
                </div>
                @endif
                @if(auth()->user()->memberDetail->statusUser == "PAYMENT REVIEW")
                <div class="col-lg-10 mx-auto">
                    <div class="card bg-primary">
                        <div class="p-3 text-white">
                            <b>Hi {{auth()->user()->memberDetail->first_name ?? ""}}</b> <br><br>

                            Currently your payment is review by the administor, wait for a while we assure you once it's approve we notify you

                        </div>
                        <br>
                        <button class="btn btn-neutral btn-sm m-2" id="view_quatation" style="color: #910000;" member="{{auth()->user()->memberDetail->id ?? ""}}">View Details</button>
                    </div>
                </div>
                @endif
                @if(auth()->user()->memberDetail->statusUser == "ACTIVE")
                <div class="col-lg-10 mx-auto">
                    <div class="card  bg-primary">
                        <div class="p-3 text-white">
                            Welcome back <b>{{auth()->user()->memberDetail->first_name ?? ""}},</b> <br><br>
                            Your account membership is successfully reviewed by administrator and your membership is now officially active, 
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endcan
            </div>
            <hr class="my-2 bg-danger">
            <div class="row">
                <div class="col-6">
                    <h4>Hello, Good Day!</h4>
                    <span>How are you today?</span>
                </div>
            </div>
            <hr class="my-2 bg-danger">
        </div>
        <div class="col-md-12">

        </div>
        @can('user_access')
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    @if(!auth()->user()->memberDetail)
                                    <h5><span class="badge badge-warning">MEMBERSHIP NOT COMPLETED</span></h5>
                                    @else
                                    <h5><span class="badge @if(auth()->user()->memberDetail->statusUser == 'ACTIVE') badge-success @else badge-warning @endif">{{auth()->user()->memberDetail->statusUser}}</span></h5>
                                    @endif


                                    <h6 class="card-subtitle mb-3 h6">Membership Status</h6>
                                </div>
                                <div class="col-3">
                                    <i class="now-ui-icons files_paper text-success" style="font-size: 50px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-center">
                                        <div class="btn btn-success btn-sm btn-facebook btn-icon btn-round">
                                            <i class="now-ui-icons ui-1_check text-white"></i>
                                        </div><br>
                                        Email Verified
                                    </h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-center">
                                        <div class="btn @if(auth()->user()->memberDetail->isSaveByUser ?? false == true) btn-success @else btn-warning @endif btn-sm btn-facebook btn-icon btn-round">
                                            <i class="now-ui-icons ui-1_check  text-white"></i>
                                        </div><br>
                                        Membership Completed
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h6 class="card-subtitle mb-2 text-danger">{{ Auth::user()->updated_at->format('F d,Y h:i A') }}</h6>
                                    <h6 class="card-subtitle mb-2 h6">Your last login</h6>

                                </div>
                                <div class="col-3">
                                    <i class="now-ui-icons arrows-1_share-66 text-success" style="font-size: 50px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h6 class="card-subtitle mb-2 text-danger">{{$dependents}}</h6>
                                    <h6 class="card-subtitle mb-2 h6">Number Of Dependents</h6>
                                    @if($dependents > 0)
                                    <a href="/admin/membership/principal/{{ Auth::user()->referral_code ?? "" }}?step=4" class="card-subtitle mb-2 text-info">
                                        <h6> View Dependets </h6>
                                    </a>
                                    @endif
                                </div>
                                <div class="col-3">
                                    <i class="now-ui-icons users_circle-08 text-success" style="font-size: 50px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endcan


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
                            <div class="card border border-primary border-right-0 border-left-0 border-bottom-0 rounded payment_details_section">
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
                <button type="button" class="btn btn-primary text-uppercase upload_receipt">Upload your receipt</button>
            </div>

        </div>
    </div>
</div>

<form method="post" id="uploadForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="modal" id="uploadModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-id text-white text-uppercase font-weight-bold">UPLOAD YOUR RECEIPT</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>


                <!-- Modal body -->
                <div class="modal-body">
                    <div id="modalbody" class="modalbody row">

                        <div class="col-sm-12 uploadFile">
                            <div class="form-group">
                                <strong>IMPORTANT: <br>Upload at least one(1) image file of your receipt. <br> Make sure your uploaded receipt in not blured, And must be type of png/jpg/jpeg/svg/bmp/ico. </strong> <br> <br>
                                <label class="control-label">Upload File <span class="text-danger">*</span></label>
                                <input type="file" name="upload_file" id="upload_file" accept="image/*" class="form-control" />
                                <input type="hidden" name="typeFile" id="typeFile" value="receipt">
                                <span class="text-muted" role="alert">
                                    (File Format: jpg/png Size:Max 30 MB)
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-upload_file"></strong>
                                </span>
                                <br>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reference Number <span class="text-danger">*</span></label>
                                <input type="text" name="reference_number" id="reference_number" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-reference_number"></strong>
                                </span>
                                <br>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Amount you paid <span class="text-danger">*</span></label>
                                <input type="text" name="amount_paid" id="amount_paid" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-amount_paid"></strong>
                                </span>
                                <br>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer bg-white uploadFile">


                    <button type="button" class="btn btn-white text-uppercase" id="view_quatation_b">View Quatation</button>
                    <input type="submit" name="file_action_button" id="file_action_button" class="text-uppercase btn btn-primary" value="Upload" />
                </div>

            </div>
        </div>
    </div>
</form>


<div id="modalViewImage" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img alt="no file" id="img_file" class="img-responsive">
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function alertPopup(title, typeOfAlert) {
        if (typeOfAlert == "success") {
            $('#success-alert').removeClass('bg-danger');
            $('#success-alert').addClass('bg-success');
        }
        if (typeOfAlert == "error") {
            $('#success-alert').removeClass('bg-success');
            $('#success-alert').addClass('bg-danger');
        }

        $('#success-alert').html('<strong> ' + title + ' </strong>');
        $("#success-alert").fadeTo(5000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    }


    var memberID = "";
    $('#view_quatation').on("click", function(event) {

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
                        console.log('receipt' + value.file);

                        if (value.length == 0) {
                            $(".payment_details_section").hide();
                        } else {
                            $(".payment_details_section").show();
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

                    }

                })
            }
        })
    }

    $('.upload_receipt').on("click", function(event) {
        $('#uploadModal').modal('show');
        $('#modalQuatation').modal('hide')
        $('.form-control').removeClass('is-invalid')
    });

    $('#receipt_data').on("click", '.view_uploaded_id', function(event) {
        var image = $(this).attr('image');
        console.log(image)
        $('#modalViewImage').modal('show')
        $('#img_file').attr('src', '/uploadedReceipts/' + image);
    });


    $('#uploadForm').on('submit', function(event) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        var action_url = "/admin/membership/upload/" + memberID;
        var type = "POST";

        $.ajax({
            url: action_url,
            method: type,
            dataType: "json",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#file_action_button").attr("disabled", true);
            },
            success: function(data) {
                $("#file_action_button").attr("disabled", false);
                if (data.errors) {
                    $.each(data.errors, function(key, value) {
                        if (key == $('#' + key).attr('id')) {
                            $('#' + key).addClass('is-invalid')
                            $('#error-' + key).text(value)
                        }
                    })
                }
                if (data.success) {

                    $.confirm({
                        title: 'Confirmation',
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
            }
        });

    });
</script>
@endsection