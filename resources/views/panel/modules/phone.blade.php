<div class="row">

    <p class="guild_p">
        <span class="add_btn" onclick="add_phone(this)"> + </span>
        اضافه شماره تماس
    </p>
    <hr>
    <div class="row col-md-12 phone_numbers" id="phone_numbers">

    </div>
</div>

<script>
    @if (isset($phones))
        @foreach ($phones as $key => $value)
            $('.phone_numbers').append("<div class='phones'>" +
                "<div class='col-md-5'>" +
                "<div class='form-group'>" +
                "<select style='font-size : 12px;' class='form-control'  name='phones[{{ $value['id'] }}][type]' >" +
                "<option {{ $value['type'] == 'phone' ? 'selected' : '' }} value='phone'>شماره موبایل</option> " +
                "<option {{ $value['type'] == 'tell' ? 'selected' : '' }} value='tell'>شماره ثابت</option> " +
                "<option {{ $value['type'] == 'fax' ? 'selected' : '' }} value='fax'>شماره فاکس</option> " +
                " </select>" +
                " </div>" +
                " </div>" +
                "<div class='col-md-5'>" +
                "<div class='form-group'>" +
                "<input type='text' class='form-control' name='phones[{{ $value['id'] }}][number]' placeholder='شماره تماس' value='{{ $value['number'] }}'>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-2' ><span class='delete_btn' onclick='remove_phone(this)'> X </span></div>" +
                "</div>");
        @endforeach ;
    @endif

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function add_phone(element) {

        let id = makeid(6);
        $(element).parent().parent().find('.phone_numbers').append("<div class='phones'>" +
            "<div class='col-md-5'>" +
            "<div class='form-group'>" +
            "<select style='font-size : 12px;' class='form-control'  name='phones[" + id + "][type]' >" +
            "<option value='phone'>شماره موبایل</option> " +
            "<option value='tell'>شماره ثابت</option> " +
            "<option value='fax'>شماره فاکس</option> " +
            " </select>" +
            " </div>" +
            " </div>" +
            "<div class='col-md-5'>" +
            "<div class='form-group'>" +
            "<input type='text' class='form-control' name='phones[" + id + "][number]' placeholder='شماره تماس' >" +
            "</div>" +
            "</div>" +
            "<div class='col-md-2' ><span class='delete_btn' onclick='remove_phone(this)'> X </span></div>" +
            "</div>");
    }

    function remove_phone(element) {
        var sender = $(element);
        var parent = sender.parentsUntil('.phones').parent();
        parent.remove();
    }
</script>
