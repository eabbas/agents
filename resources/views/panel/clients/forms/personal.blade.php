<div style="display: {{ isset($unhide) ? 'block' : 'none' }};" id="personal" class="col-md-12">
    <div class="panel panel-red">
        <div class="panel-heading">
            <h3 class="panel-title">شخصیت حقیقی</h3>
        </div>
        <div class="panel-body">

            <form action="{{ $action ?? '#' }}" method="POST">
                @csrf

                <input type="hidden" name="form" value="personal">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام</label>
                        <input type="text" class="form-control " name="name"
                            value="{{ old('name', $client['name'] ?? '') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $errors->first('name') }}</small>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>نام خانوادگی</label>
                        <input type="text" class="form-control " name="family"
                            value="{{ old('family', $client['family'] ?? '') }}">
                        @if ($errors->has('family'))
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $errors->first('family') }}</small>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>تاریخ تولد</label>
                        <input type="text" class="form-control datepicker" name="birth"
                            value="{{ old('birth', isset($client['birth']) ? \Carbon\Carbon::parse($client['birth'])->format('Y/m/d') : '') }}">
                        @if ($errors->has('birth'))
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $errors->first('birth') }}</small>
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-md-6">
                        <label>نام پدر</label>

                        <input type="text" class="form-control " name="father_name"
                            value="{{ old('father_name', $client['father_name'] ?? '') }}">
                        @if ($errors->has('father_name'))
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $errors->first('father_name') }}</small>
                            </div>
                        @endif
                    </div>

                </div>

                @include('panel.modules.province_city',
                    isset($client)
                        ? ['province' => $client['province'], 'city' => $client['city'], 'form' => 'personal']
                        : [])

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>شغل</label>
                        <input type="text" class="form-control " name="job"
                            value="{{ old('job', $client['job'] ?? '') }}">
                        @if ($errors->has('job'))
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $errors->first('job') }}</small>
                            </div>
                        @endif
                    </div>
                </div>


                @include('panel.clients.forms.contact-form', [
                    'addresses' => $client['addresses'] ?? [],
                    'phones' => $client['phones'] ?? [],
                ])

                <button type="submit"
                    class="btn btn-block {{ old('personal') ? 'btn-success' : 'btn-primary' }}">{{ 'ثبت' }}
                </button>

            </form>

        </div>

    </div>

</div>
