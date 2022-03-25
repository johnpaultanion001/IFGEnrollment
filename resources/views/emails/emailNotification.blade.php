
@component('mail::message')
<style>
    .center {
            margin: auto;
            width: 100%;
            text-align: center;
            text-align: center;
            color: gray;
        }
    hr{
        border-top: .1em solid whitesmoke;
    }
</style>

<div class="center">
    <img src="https://icon-library.com/images/chat-send-icon/chat-send-icon-5.jpg" alt="send" width="100"/>
    <br>
    <br>
    <b style="font-size: 22px;">{{ $content['notif_message'] }}</b>
    <br>
    <br>
    <b style="font-size: 18px;">Reference Number:</b>
    <br>
    <b style="font-size: 20px;">{{ $content['reference_number'] }}</b>
    <br>
    <br>
    <hr>
        <b style="font-size: 15px;">Receiver:  {{ $content['receiver'] }}</b>
    <hr>
        <b style="font-size: 15px;">Send Amount:  {{ $content['send_amount'] }}</b>
    <hr>
        <b style="font-size: 15px;">Receive Amount: {{ $content['receive_amount'] }}</b>
    <hr>
        <b style="font-size: 15px;">Receive Method: {{ $content['receive_method'] }}</b>
    <hr>
    <b style="font-size: 12px;">{{ $content['note'] }}</b>
</div>



 

@endcomponent
