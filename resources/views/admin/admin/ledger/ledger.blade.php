@extends('layouts.admin1')
@section('content')
    <div id="loadLedger">
        
    </div>
@endsection
@section('scripts')
<script>

$(function () {
    
    return loadLedger();
    
});

function loadLedger(){
    $.ajax({
        url: "ledger/load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
          
        },
        success: function(response){
            $("#loadLedger").html(response);
        }	
    })
}

</script>
@endsection