@extends('panel.theme.main')


@section('content')
    <div class="row">
        <div class="col-md-2"><a href="{{ url()->current() . '/create' }}" class="btn btn-info btn-block"><i
                    class="fa fa-pencil"></i> ایجاد </a></div>

        <div class="col-md-12">

            <div class="col-md-12 pmd-card pmd-z-depth pmd-card-custom-view" style="margin-top: 15px">
                <div id="clients_table" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
@endpush
