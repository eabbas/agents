@extends('panel.theme.main')
@section('content')
    <div id="loader"
        style="display:none;position: absolute;z-index: 10; background-color: rgba(123,123,123,.4) ; right: 15px;left: 15px;top: 37px;bottom: 20px">
        <i style="position: absolute;top: 40%;left: 47%;" class="fa fa-3x fa-spin fa-spinner"></i>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel panel-red">
                <div class="panel-heading">
                    <h3 class="panel-title">موجودی</h3>
                </div>
                <div class="panel-body">
                    <p class="hoverP"><span class="info-label"> موجودی :</span> <span class="info-body">
                            {{ number_format($wallet['balance']) }} ریال </span>
                    </p>
                    <p class="hoverP"><span class="info-label"> آخرین تغییر :</span> <span class="info-body">
                            {{ $wallet['updated_at'] ? piry_gregorian_to_jalali($wallet['updated_at']) : 'بدون تغییر' }}
                        </span>
                    </p>

                    <hr>

                    <div class="form-group col-md-4">
                        <input type="text" class="form-control " id="wallet_price"
                            placeholder="افزایش موجودی - عدد به ریال">
                    </div>
                    <div class="col-md-2">
                        <p onclick="payment_request(this)" class="btn btn-success"> افزایش</p>
                    </div>

                </div>


            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title">پرداخت ها</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 pmd-card pmd-z-depth pmd-card-custom-view">
                        <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let wallet_input = $('#wallet_price');

            wallet_input.on('input', function() {
                let wallet_price = wallet_input.val().replaceAll(',', '');
                let wallet_price_string = parseInt(wallet_price).toLocaleString();
                wallet_input.val(wallet_price.length > 0 ? wallet_price_string : 0);
            });
        });

        function payment_request(button) {

            const val = $("#wallet_price").val().replaceAll(',', '');

            if (!$.isNumeric(val))
                return alert('مقدار را  به صورت اعداد لاتین  وارد کنید.');
            if (val < 100000)
                return alert('کمترین مقداری که میتوانید شارژ کنید صد هزار ریال است.');

            $(button).attr('disabled', 'disabled');
            $('#loader').css('display', 'block');

            $.ajax('{{ route('payment.request', '') }}/' + val + '?method=mellat&wallet=true', {
                type: 'get',
                dataType: 'json',
                success: function(data) {

                    let form = $('<form>', {
                        'action': data.gateway,
                        'method': data.method
                    });

                    if ('inputs' in data) {
                        $.each(data.inputs, function(k, v) {
                            form.append($('<input>', {
                                'name': k,
                                'value': v,
                                'type': 'hidden'
                            }))
                        });
                    }

                    $('.panel-body')[0].append(form[0]);
                    form.submit();
                    $('#loader').css('display', 'none');
                    $(button).removeAttr('disabled');
                },
                error: function(data) {
                    alert('خطا در عملیات پرداخت');
                    $('#loader').css('display', 'none');
                    $(button).removeAttr('disabled');
                }
            });

        }
    </script>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
