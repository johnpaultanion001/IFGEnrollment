<select name="select_recipient" id="select_recipient" class="select_recipient select2 form-cotrol"  style="width: 100%">
    <option value="" disabled selected>Select Recipient</option>
    @foreach ($beneficiaries as $beneficiary)
        <option value="{{$beneficiary->id}}"> {{$beneficiary->beneficiary_firstname}} {{$beneficiary->beneficiary_lastname}}</option>
    @endforeach
</select>



<script>
    $(document).ready(function () {
        $('.select2').select2()
        $('.treeview').each(function () {
        var shouldExpand = false
        $(this).find('li').each(function () {
            if ($(this).hasClass('active')) {
                shouldExpand = true
            }
        })
            if (shouldExpand) {
                $(this).addClass('active')
            }
        })

    });
</script>