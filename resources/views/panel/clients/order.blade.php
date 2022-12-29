@extends('panel.theme.main')


@section('content')
    @php
    $ready = false;
    if (isset($requestedData) && $requestedData !== null) {
        $ready = true;
        $reqData = $requestedData;
    }
    @endphp
    <div id="pod">
        <div id="loader"
            style="display:none;position: absolute;z-index: 10; background-color: rgba(123,123,123,.4) ; right: 15px;left: 15px;top: 37px;bottom: 20px">
            <i style="position: absolute;top: 40%;left: 47%;" class="fa fa-3x fa-spin fa-spinner"></i>
        </div>

        <div class="container-fluid">

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-dark">
                    <div class="panel-heading">
                        <h3 class="panel-title">اطلاعات محصول</h3>
                    </div>
                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label>انتخاب محصول</label>
                                    <select id="select_user_5" onchange="get_kit_for_client(this)" class="demo-default"
                                        placeholder="جستجو و انتخاب نوع کاغذ">
                                        <option value="">انتخاب کنید (الزامی)</option>
                                        @foreach ($products as $product)
                                            <option
                                                value="{{ $product['id'] }}-{{ $client->id }}-{{ $product['price'] }}">
                                                {{ $product['title'] }}
                                                - قیمت : {{ number_format($product['price']) }} ریال
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12" id="product_kits">
                        </div>


                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">محاسبه هزینه</h3>
                    </div>
                    <div class="panel-body" style="width: 100% ; height: 100%">
                        <div id="loader"
                            style="display:none;position: absolute;z-index: 10; background-color: rgba(123,123,123,.4) ; right: 15px;left: 15px;top: 37px;bottom: 20px">
                            <i style="position: absolute;top: 40%;left: 47%;" class="fa fa-3x fa-spin fa-spinner"></i>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table pmd-table table-hover table-striped  display responsive nowrap"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>-</th>
                                            <th>قیمت واحد</th>
                                            <th>مالیات بر ارزش افزوده</th>
                                            <th>جمع کل</th>
                                        </tr>
                                    </thead>

                                    <tbody id="invoice_tbody">
                                        <tr class="cat_row">
                                            <td>هزینه محصول :</td>
                                            <td id="product_price">-</td>
                                            <td id="POD_PP_TAHRIR_count">-</td>
                                            <td id="product_price_total">-</td>
                                        </tr>

                                    </tbody>
                                </table>

                                <hr>
                                <p class="hoverP"><span class="info-label"> جمع هزینه کیت ها :</span> <span
                                        id="kit_prices_total" class="info-body"> 0 </span></p>
                                <p class="hoverP2"><span class="info-label-2"> هزینه کل :</span> <span id="total_price"
                                        class="info-body-2"> 0 </span>
                                </p>

                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-md-12" style="display: flex;flex-wrap: wrap;gap: 12px;">
                                <p disabled="disabled" class="btn btn-primary" id="calculate_pod" onclick="payBank(true)">
                                    پرداخت از موجودی</p>
                                <p disabled="disabled" class="btn btn-success" id="pay_bank" onclick="payBank(false)">
                                    پرداخت
                                    از
                                    درگاه بانکی </p>
                                <p disabled="disabled" class="btn btn-warning" id="send_payment_url"
                                    onclick="sendPaymentURL()"> ارسال لینک پرداخت به کاربر </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        let kits;
        let selected_kits = [];
        let client_id;
        let product_id;

        function sendPaymentURL() {
            disableButtons();
            $('#loader').css('display', 'block');

            fetch("/panel/agent/clients/" + client_id + "/order/sendPaymentURL", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    'product_id': product_id,
                    'kits': selected_kits,
                    'client_id': {{ $client->id }},
                })
            }).then(response => {
                if (response.status === 200) {
                    // TODO: make beautiful alert :)
                    alert('لینک پرداخت با موفقیت ارسال شد.');
                }
                if (response.status == 404) {
                    alert('شماره همراه برای کاربر ثبت نشده است');
                }


                enableButtons();
                $('#loader').css('display', 'none');
            });

        }

        function payBank(wallet = false) {
            disableButtons();
            $('#loader').css('display', 'block');

            let json = {
                'product_id': product_id,
                'kits': selected_kits,
            };

            if (wallet) {
                json.wallet_id = {{ auth()->user()->wallet()->id }};
            }

            fetch("/panel/agent/clients/" + client_id + "/order/pay", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(json)
            }).then(response => {
                if (response.status === 200) {
                    response.json().then(data => {
                        if (data.success) {
                            location.href = data.payment_url;
                        } else {
                            alert(data.message);
                        }
                    });
                } else {
                    alert('پرداخت با خطا مواجه شد.');
                }
                enableButtons();
                $('#loader').css('display', 'none');
            });
        }

        function disableButtons() {
            $("#send_payment_url").attr('disabled', 'disabled');
            $("#pay_bank").attr('disabled', 'disabled');
            $("#calculate_pod").attr('disabled', 'disabled');
        }

        function enableButtons() {
            $("#send_payment_url").removeAttr('disabled');
            $("#pay_bank").removeAttr('disabled');
            $("#calculate_pod").removeAttr('disabled');
        }

        function get_kit_for_client(element) {
            $('#loader').css('display', 'inline');

            let el_val = element.value;
            el_val = el_val.split('-');
            product_id = el_val[0];
            client_id = el_val[1];
            $("#total_price").html(el_val[2]);
            enableButtons();

            $("#product_price").html(el_val[2]);
            $("#product_price_total").html(el_val[2]);

            $(".kit_tr").remove();
            $("#kit_prices_total").html(0);

            $.ajax("/panel/agent/" + client_id + "/" + product_id + "/get_kits", {
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    $('#loader').css('display', 'none');
                    kits = data;
                    append_to_kits(data);
                },
                error: function(data) {
                    $('#loader').css('display', 'none');
                }
            });
        }

        function append_to_kits(kits) {
            $('#product_kits').find('input[type=checkbox]:checked').removeAttr('checked');
            $('#product_kits').find('div').remove();

            var i;
            for (i = 0; i < kits.length; ++i) {
                generate_kit_checkbox(kits[i])
            }
        }

        function generate_kit_checkbox(kit) {
            $("#product_kits").append(
                "<div class='col-md-12'>" +
                "<label>" +
                "<input onclick='append2table(this)' data-kit='" + JSON.stringify(kit) +
                "' name='kits[]'  class='' type='checkbox'  id='checkRed6' >" +
                "<span> " + kit['title'] + " </span>" +
                "</label>" +
                "</div>"
            );
        }

        function append2table(e) {
            var kit = $(e).data('kit');
            if ($(e).is(':checked')) {
                $("#invoice_tbody").append(
                    "<tr id='kit_tr_" + kit['id'] + "_" + kit['product_id'] + "' class='kit_tr cat_row'>" +
                    "<td> " + kit['title'] + " :</td>" +
                    "<td id='POD_PP_BALK'>" + kit['price'] + "</td>" +
                    "<td id='POD_PP_BALK_count'>-</td>" +
                    "<td id='POD_PP_BALK_total'>" + kit['price'] + "</td>" +
                    "</tr>"
                );
                $("#kit_prices_total").html(Number($("#kit_prices_total").html()) + Number(kit['price']));
                $("#total_price").html(Number($("#total_price").html()) + Number(kit['price']));
                selected_kits.push(kit['id']);
                enableButtons();
            }
            if (!$(e).is(':checked')) {
                $("#kit_tr_" + kit['id'] + "_" + kit['product_id']).remove();
                $("#kit_prices_total").html(Number($("#kit_prices_total").html()) - Number(kit['price']));
                $("#total_price").html(Number($("#total_price").html()) - Number(kit['price']));
                selected_kits = selected_kits.filter(e => e !== kit['id']);
                enableButtons();
            }
        }
    </script>
@endsection
