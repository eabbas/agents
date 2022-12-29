@extends('panel.theme.main')
@section('content')


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel panel-red">
                <div class="panel-heading">
                    <h3 class="panel-title">اطلاعات نماینده</h3>
                </div>
                <div class="panel-body">
                    <p class="hoverP"> <span class="info-label"> شناسه کاربری :</span> <span class="info-body"> {{$client['id']}}</span> </p>
                    <p class="hoverP"> <span class="info-label">نام  :</span> <span class="info-body">{{(($client['name'])? $client['name'] : "وارد نشده" )}}</span> </p>
                    <p class="hoverP"> <span class="info-label"> نام خانوادگی :</span> <span class="info-body">{{(($client['family'])? $client['family'] : "وارد نشده" )}}</span> </p>
                    <p class="hoverP"> <span class="info-label">شماره موبایل :</span> <span class="info-body">{{(($client['phone'])? $client['phone'] : "وارد نشده" )}}</span> </p>
                    <p class="hoverP"> <span class="info-label">تاریخ ثبت نام :</span> <span class="info-body">{{piry_gregorian_to_jalali($client['created_at'])}}</span> </p>
                    <p class="hoverP"> <span class="info-label">ایمیل :</span> <span class="info-body">{{(($client['email'])? $client['email'] : "وارد نشده" )}}</span> </p>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title">سفارشات</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 pmd-card pmd-z-depth pmd-card-custom-view">
                        <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            {{$dataTable->table()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
