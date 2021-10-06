@extends('layouts.admin1')
@section('content')
    <div id="loadHistory">
        
    </div>
@endsection
@section('scripts')
<script>

$(function () {
    
    return loadHistory();
    
});

function loadHistory(){
    $.ajax({
        url: "history/load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
          
        },
        success: function(response){
            $("#loadHistory").html(response);
        }	
    })
}

</script>
@endsection