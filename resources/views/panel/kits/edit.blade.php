@extends('panel.theme.main')
@section('content')
    @php
    $ready = false;
    if (isset($data) && $data !== null) {
        $ready = true;
        $reqData = $data;
    }

    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">فرم ویرایش کیت </h3>
                </div>
                <div class="panel-body">
                    {{ isset($message) ? "<p class=\"alert alert-success\">$message</p>" : '' }}
                    {{ isset($error) ? "<p class=\"alert alert-danger\">$error</p>" : '' }}

                    <form class="ls_form" role="form" action="{{ route('product.kits.update', ['kit' => $reqData['id']]) }}"
                        method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ $ready ? $reqData['id'] : '0' }}">
                        <div class="col-lg-6 col-sm-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>عنوان</label>
                                        <input name="title" class="form-control"
                                            value="{{ $ready ? $reqData['title'] : '' }}" placeholder="عنوان را وارد کنید">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>شناسه کمپانی</label>
                                        <input name="company_id" class="form-control"
                                            value="{{ $ready ? $reqData['company_id'] : '' }}"
                                            placeholder="شناسه کمپانی را وارد کنید .">
                                        @error('company_id')
                                            <div class="invalid-feedback">
                                                <small style="color: red">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>توضیحات</label>
                                        <textarea name="description" cols="80" rows="10" placeholder="توضیحات را وارد کنید">{{ $ready ? $reqData['description'] : '' }}
                                        </textarea>
                                        @error('description')
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
                                            <label>قیمت</label>
                                            <input name="price" class="form-control"
                                                value="{{ $ready ? $reqData['price'] : '' }}"
                                                placeholder="قیمت را وارد کنید">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    <small style="color: red">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
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
