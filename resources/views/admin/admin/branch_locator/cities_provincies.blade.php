<div class="form-group text-center">
    <select name="city" id="city" class="form-control select2" style="width: 100%">
        <option value="" disabled selected>City</option>
            @foreach ($cities as $city)
                <option value="{{$city->city_municipality_code}}">{{$city->city_municipality_description}}</option>
            @endforeach
    
    </select>
    <span class="invalid-feedback" role="alert">
        <strong id="error-city"></strong>
    </span>
</div>


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