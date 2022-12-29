@extends('panel.theme.main')
@section('content')

    <style>
        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio]+img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked+img {
            outline: 2px solid #f00;
        }

        #payment-form {
            display: flex;
            justify-content: center;
        }

        #payment {
            margin: 100px 0 50px 0;
            text-align: center;
        }

        #payment p {
            margin-top: 30px;
        }

        .image-radio {
            display: flex;
            height: 80px;
            width: 80px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .image-radio span {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>

    <div id="loader"
        style="display:none;position: absolute;z-index: 10; background-color: rgba(123,123,123,.4) ; right: 15px;left: 15px;top: 37px;bottom: 20px">
        <i style="position: absolute;top: 40%;left: 47%;" class="fa fa-3x fa-spin fa-spinner"></i>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div
                class="panel {{ match ($transaction->status) { 'success' => 'panel-light-green',  'failed' => 'panel-red',  'unpaid' => 'panel-light-orange' } }}">
                <div class="panel-heading">
                    <h3 class="panel-title">اطلاعات تراکنش</h3>
                </div>
                <div class="panel-body">
                    <div style="width: 100%; display: flex; justify-content: center; margin-top: 30px;">
                        <i class="fa {{ $transaction->status == 'success' ? 'fa-check-circle' : 'fa-times-circle' }}"
                            style="font-size: 180px; color:{{ match ($transaction->status) { 'success' => 'darkseagreen',  'failed' => '#ff7878',  'unpaid' => '#FBBF77' } }};"></i>
                    </div>

                    <h3 style="margin-top: 70px;margin-bottom: 20px;">
                        {{ match ($transaction->status) {
                            'success' => 'پرداخت با موفقیت انجام شد',
                            'failed' => 'خطا در پرداخت',
                            'unpaid' => 'پرداخت انجام نشده'
                        } }}
                    </h3>

                    <div>
                        <p class="hoverP">
                            <span class="info-label"> شماره پرداخت :</span>
                            <span class="info-body">{{ $transaction->id }}</span>
                        </p>


                        @if (isset($transaction->order_id) && $transaction->order()->product_id !== null)
                            <p class="hoverP">
                                <span class="info-label"> نام محصول :</span>
                                <span class="info-body">{{ $transaction->order()->product()->title }}</span>
                            </p>

                            <p class="hoverP">
                                <span class="info-label"> کیت های انتخاب شده :</span>
                                <span class="info-body">
                                    @foreach ($transaction->order()->kits() as $index => $kit)
                                        {{ ($index == 0 ? '' : ', ') . $kit->title }}
                                    @endforeach
                                </span>
                            </p>

                            <p class="hoverP">
                                <span class="info-label"> روش پرداخت :</span>
                                <span class="info-body">
                                    {{ $transaction->payment_method ? 'درگاه پرداخت' : 'کیف پول' }}
                                </span>
                            </p>
                        @endif

                        @isset($transaction->payment_method)
                            <p class="hoverP">
                                <span class="info-label"> درگاه پرداخت :</span>
                                <span class="info-body">
                                    {{ match ($transaction->payment_method) { 'mellat' => 'بانک ملت' } }}
                                </span>
                            </p>
                        @endisset

                        <p class="hoverP">
                            <span class="info-label"> مبلغ :</span>
                            <span class="info-body">{{ number_format($transaction->amount) }} ریال</span>
                        </p>

                        @isset($transaction->sale_reference_id)
                            <p class="hoverP">
                                <span class="info-label"> کد پیگیری :</span>
                                <span class="info-body">{{ $transaction->sale_reference_id }}</span>
                            </p>
                        @endisset

                        @isset($transaction->description)
                            <p class="hoverP">
                                <span class="info-label"> توضیحات :</span>
                                <span class="info-body">{{ $transaction->description }}</span>
                            </p>
                        @endisset
                    </div>

                    @if ($transaction->status == 'unpaid')
                        <div class="col-md-12" id="payment">
                            <div id="payment-form">
                                @foreach ($payment_methods as $key => $method)
                                    <label class="image-radio">
                                        <input type="radio" name="method" value="{{ $method['name'] }}"
                                            {{ $key == 0 ? 'checked' : '' }}>
                                        <img style="max-height: 80%;" src="{{ $method['image'] }}">
                                        <span>{{ trans($method['name'] . '.name') }}</span>
                                    </label>
                                @endforeach

                            </div>

                            <p class="btn btn-warning" id="send_payment_url" onclick="payment_request(this)">پرداخت</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function payment_request(button) {

            // default
            let method = 'mellat';
            $('.image-radio input:radio').each(function(index, radio) {
                if ($(radio).is(':checked')) {
                    method = $(radio).attr('value');
                }
            });

            $(button).attr('disabled', 'disabled');
            $('#loader').css('display', 'block');

            $.ajax('{{ $transaction->wallet_id == null ? route('payment.request.transactionId', ['amount' => $transaction->amount, 'transaction' => $transaction->id]) : route('payment.request', ['amount' => $transaction->amount]) }}' +
                '?method=' + method, {
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
