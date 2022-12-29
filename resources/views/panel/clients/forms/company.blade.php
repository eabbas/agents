<div style="display:{{ isset($unhide) ? 'block' : 'none' }};" id="company" class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h3 class="panel-title">شخصیت حقوقی</h3>
        </div>

        <div class="panel-body">
            <form action="{{ $action ?? '#' }}" method="POST">

                @csrf
                <input type="hidden" name="form" value="company">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام شرکت</label>
                        <input type="text" class="form-control " name="name"
                            value="{{ old('name', $client['name'] ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>شماره ثبت</label>
                        <input type="text" class="form-control " name="submit_number"
                            value="{{ old('submit_number', $client['submit_number'] ?? '') }}">
                        @error('submit_number')
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>تاریخ ثبت</label>
                        <input type="text" class="form-control datepicker" name="birth" placeholder="1400/01/01"
                            value="{{ old('birth', isset($client['birth']) ? \Carbon\Carbon::parse($client['birth'])->format('Y/m/d') : '') }}">
                        @error('birth')
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>شغل</label>
                        <input type="text" class="form-control " name="job"
                            value="{{ old('job', $client['job'] ?? '') }}">
                        @error('job')
                            <div class="invalid-feedback">
                                <small style="color: red">{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                </div>

                @include('panel.modules.province_city',
                    isset($client)
                        ? ['province' => $client['province'], 'city' => $client['city'], 'form' => 'company']
                        : [])

                @include('panel.clients.forms.contact-form', [
                    'addresses' => $client['addresses'] ?? [],
                    'phones' => $client['phones'] ?? [],
                ])

                <button type="submit"
                    class="btn btn-block {{ old('personal') ? 'btn-success' : 'btn-primary' }}">{{ old('company') ? 'ویرایش' : 'ثبت' }}
                </button>
            </form>
        </div>

    </div>
</div>
