@extends('panel.theme.main')
@section('content')
    @php
    $ready = false;
    if (isset($requestedData) && $requestedData !== null) {
        $ready = true;
        $reqData = $requestedData;
    }

    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">فرم ویرایش نماینده </h3>
                </div>
                <div class="panel-body">
                    {{ isset($message) ? "<p class=\"alert alert-success\">$message</p>" : '' }}
                    {{ isset($error) ? "<p class=\"alert alert-danger\">$error</p>" : '' }}

                    <form class="ls_form" role="form" action="{{ route('agent.users.update', ['user' => $reqData['id']]) }}"
                        method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ $ready ? $reqData['id'] : '0' }}">
                        <div class="col-lg-6 col-sm-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نام نماینده</label>
                                        <input name="name" class="form-control"
                                            value="{{ $ready ? $reqData['name'] : '' }}"
                                            placeholder="نام نماینده را وارد کنید .">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نام خانوادگی نماینده</label>
                                        <input name="family" class="form-control"
                                            value="{{ $ready ? $reqData['family'] : '' }}"
                                            placeholder="نام خانوادگی نماینده را وارد کنید .">
                                        @error('family')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>شماره موبایل نماینده</label>
                                        <input name="phone" class="form-control"
                                            value="{{ $ready ? $reqData['phone'] : '' }}" placeholder="مثل : 09121234567">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>رمز ورود برای سیستم</label>

                                        <input name="password" type='text' class="form-control"
                                            placeholder="{{ $ready ? 'درصورتی که میخواید پسورد نماینده همان پسورد قبلی باشد این فیلد را پر نکنید' : 'رمز عبور نماینده' }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ایمیل نماینده</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $ready ? $reqData['email'] : '' }}" placeholder="ایمیل نماینده">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <small style="color: red">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نام کاربری</label>
                                            <input name="username" class="form-control"
                                                value="{{ $ready ? $reqData['username'] : '' }}" placeholder="نام کاربری">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    <small style="color: red">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <p class="alert alert-info">تایین درصد فروش برای نماینده</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>درصد فروش</label>
                                        <input class="form-control" value="{{ $ready ? $reqData['username'] : '' }}"
                                            placeholder="۰ تا ۱۰۰">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>درصد کیت </label>
                                        <input class="form-control" value="{{ $ready ? $reqData['username'] : '' }}"
                                            placeholder="۰ تا ۱۰۰">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>درصد ارتقا</label>
                                        <input class="form-control" value="{{ $ready ? $reqData['username'] : '' }}"
                                            placeholder="۰ تا ۱۰۰">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>درصد تمدید</label>
                                        <input class="form-control" value="{{ $ready ? $reqData['username'] : '' }}"
                                            placeholder="۰ تا ۱۰۰">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <hr>
                        <div class="col-md-12">
                            @include('panel.modules.phone')
                            @include('panel.modules.address')
                        </div>


                        <button type="submit" class="btn btn-block {{ !$ready ? 'btn-primary' : 'btn-success' }}">
                            {{ !$ready ? 'ثبت ' : 'ویرایش' }} </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        function copy_clip(element) {
            var range, selection, worked;
            if (document.body.createTextRange) {
                range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
            } else if (window.getSelection) {
                selection = window.getSelection();
                range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }
            try {
                var x = document.execCommand('copy');
                console.log(element.innerText);
                if (element.innerText) {
                    Swal.fire({
                        "title": "کپی شد!",
                        "text": "",
                        "timer": "1500",
                        "width": "1",
                        "heightAuto": true,
                        "padding": "1.25rem",
                        "animation": true,
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "type": "success",
                        "position": "center"
                    });
                }
            } catch (err) {
                console.log('خطا! متن کپی نشد.');
                // alert('خطا! متن کپی نشد.');
            }
        }
    </script>
@endsection
