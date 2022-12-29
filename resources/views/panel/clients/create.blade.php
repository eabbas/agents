@extends('panel.theme.main')
@section('content')
    <div class="col-md-12" style="margin-bottom: 30px">

        <p style="margin-top: 10px;margin-right: 15px;">نوع شخصیت : </p>

        <div class="col-md-3">
            <label class="radio">
                <input class="icheck-red" type="radio" name="personality" id="radioRedCheckbox1" value="personal"> شخصیت حقیقی
            </label>
        </div>

        <div class="col-md-3">
            <label class="radio">
                <input class="icheck-black" type="radio" name="personality" id="radioRedCheckbox5" value="company"> شخصیت
                حقوقی
            </label>
        </div>

    </div>


    @include('panel.clients.forms.company', ['action' => route('agent.clients.save.company')])
    @include('panel.clients.forms.personal', ['action' => route('agent.clients.save.personal')])



    <script>
        $(document).ready(function() {

            @error('failed')
                alert('ثبت اطلاعات با مشکل مواجه شد.');
            @enderror

            function showForm(name) {
                if (name === 'personal') {
                    $("#personal").css('display', 'block');
                    $("#company").css('display', 'none');
                }

                if (name === 'company') {
                    $("#company").css('display', 'block');
                    $("#personal").css('display', 'none');
                }
            }

            let personality = $("input[type=radio][name=personality]");
            personality.prop('checked', false);
            personality.on('ifChecked', function(event) {
                showForm(this.value);
            });

            @if (old('form'))
                const old_form = '{{ old('form') }}';
                personality.each(function() {
                    if (this.value === old_form) {
                        $(this).prop('checked', true);
                        showForm(this.value);
                    }
                });
            @endif

        });
    </script>
@endsection
