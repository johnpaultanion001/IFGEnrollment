
<div class="card">
    <div class="card-header p-2">
        <h4>
            Transaction Report
        </h4>
        <h6>
            Total Transaction : <span class="text-primary">{{$histories->count()}}</span>
        </h6>
        
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-history display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>
                            Transaction ID
                        </th>
                        <th>
                            Date Time
                        </th>
                        <th>
                            Reference #
                        </th>
                        <th>
                           Beneficiary
                        </th>
                        <th>
                            Receive Amount
                        </th>
                        <th>
                            Send Amount
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Payment
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $key => $history)
                        <tr data-entry-id="{{ $history->id }}">
                            <td>
                                {{ $history->id ?? '' }}
                            </td>
                            <td>
                                {{ $history->created_at->format('F d,Y h:i A') }}
                            </td>
                            <td>
                                {{ $history->reference_number ?? '' }}
                            </td>
                            <td>
                                {{ $history->beneficiary->beneficiary_firstname ?? '' }} {{ $history->beneficiary->beneficiary_lastname ?? '' }}
                            </td>
                            <td>
                                {{  number_format($history->receive_amount , 0, ',', ',') }}
                                <hr class="my-1 bg-muted">
                                {{ $history->beneficiary->bank->name ?? '' }}

                            </td>
                            <td>
                                {{  number_format($history->send_amount , 0, ',', ',') }}
                                <hr class="my-1 bg-muted">
                                {{ $history->transaction_payment_mode ?? '' }}
                            </td>
                            <td>
                                @if($history->status == 0)
                                    <span class="badge badge-success">Sending</span>
                                @elseif($history->status == 1)
                                   <span class="badge badge-warning">Ready For Pickup</span>
                                @elseif($history->status == 2)
                                    <span class="badge badge-primary">Claimed</span>
                                @endif
                            </td>
                            <td>
                                @if($history->isPaid == false)
                                    <span class="badge badge-danger">UNPAID</span>
                                @elseif($history->isPaid == true)
                                    <span class="badge badge-success">PAID</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
  });

  $('.datatable-history:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>