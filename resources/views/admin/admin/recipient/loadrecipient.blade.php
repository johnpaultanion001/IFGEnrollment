
<div class="card">
    <div class="card-header p-2">
        <h4>
            Recipient
        </h4>
        <h6>
            Total Recipient : <span class="text-primary">{{$beneficiaries->count()}}</span>
        </h6>
        
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-beneficiary display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>
                            Actions
                        </th>
                        <th>
                            Beneficiary Name
                        </th>
                        <th>
                            Payment Mode
                        </th>
                        <th>
                            Bank Name
                        </th>
                        <th>
                            Account Number
                        </th>
                        <th>
                            Receipt Country
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Date Created
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beneficiaries as $key => $beneficiary)
                        <tr data-entry-id="{{ $beneficiary->id }}">
                            <td>
                                <button type="button" send="{{  $beneficiary->id ?? '' }}" class="send_money_beneficiary btn btn-primary btn-sm">Send Money</button>
                                <br>
                                <button type="button" edit="{{  $beneficiary->id ?? '' }}" class="edit_beneficiary btn btn-info btn-sm">Edit</button>
                                <button type="button" remove="{{  $beneficiary->id ?? '' }}" class="remove_beneficiary btn btn-danger btn-sm">Remove</button>
                                
                            </td>
                            <td>
                                {{ $beneficiary->beneficiary_firstname ?? '' }} {{ $beneficiary->beneficiary_lastname ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->payment_mode ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->bank->bank_name ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->account_number ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->country->country ?? '' }} {{ $beneficiary->country->code ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->address ?? '' }}
                            </td>
                            <td>
                                {{ $beneficiary->created_at->format('F d,Y h:i A') }}
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
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-beneficiary:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>