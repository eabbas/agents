@extends('panel.theme.main')
@section('content')

    <div class="col-md-12" style="margin-bottom: 30px">

        @error('error')
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $message }}
        </div>
        @enderror

        <p style="margin-top: 10px;margin-right: 15px;">نوع شخصیت : </p>

        <div class="col-md-3">
            <label class="radio">
                <input class="icheck-red" type="radio" name="personality" id="real_type" value="personal" {{$client['type'] === 'real' ? 'checked' : 'disabled'}}>
                شخصیت حقیقی
            </label>
        </div>

        <div class="col-md-3">
            <label class="radio">
                <input class="icheck-black" type="radio" name="personality" id="legal_type" value="company" {{$client['type'] === 'legal' ? 'checked' : 'disabled'}}> شخصیت
                حقوقی
            </label>
        </div>

    </div>

    @includeWhen($client['type'] === 'legal', 'panel.clients.forms.company', ['unhide' => true, 'action' => route('agent.clients.update.company', compact('client')) ])
    @includeWhen($client['type'] === 'real', 'panel.clients.forms.personal', ['unhide' => true, 'action' => route('agent.clients.update.personal', compact('client'))])

    <script>
        $(document).ready(function() {
            @error('failed')
                alert('ثبت اطلاعات با مشکل مواجه شد.');
            @enderror
        });
    </script>
@endsection
