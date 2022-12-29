<div class="row">
    <p class="guild_p">
        <span class="add_btn" onclick="add_address(this)"> + </span>
        اضافه آدرس
    </p>
    <hr>
    <div class="row col-md-12 addresses-wrapper">

    </div>
</div>

<script>

    @if (isset($addresses))
        @foreach ($addresses as $key => $value)
            $('.addresses-wrapper').append("<div class='addresses'>" +
            " <div class='col-md-12'>" +
            " <div class='col-md-10 form-group'>" +
            " <textarea class='form-control' name='addresses[" + makeid(6) +
            "][addresses]' placeholder='آدرس کامل'>{{$value['address']}}</textarea></div>" +
            "<div class='col-md-2' ><span class='delete_btn' onclick='remove_address(this)'> X </span></div>" +
            "</div>");
        @endforeach ;
    @endif
    
    function makeid(length) {
        let result = '';
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function add_address(element) {

        let id = makeid(6);
        $(element).parent().parent().find('.addresses-wrapper').append("<div class='addresses'>" +
            " <div class='col-md-12'>" +
            " <div class='col-md-10 form-group'>" +
            " <textarea class='form-control' name='addresses[" + id +
            "][addresses]'  placeholder='آدرس کامل'></textarea> </div>" +
            "<div class='col-md-2' ><span class='delete_btn' onclick='remove_address(this)'> X </span></div>" +
            "</div>"
        );
    }

    function remove_address(element) {
        let sender = $(element);
        let parent = sender.parentsUntil('.addresses').parent();
        parent.remove();
    }
</script>
