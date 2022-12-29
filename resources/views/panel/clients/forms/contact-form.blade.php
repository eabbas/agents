<div class="row">
    <div class="col-md-12 contact_info">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">اطلاعات تماس</h3>
            </div>
            <div class="panel-body">
                @include('panel.modules.phone', isset($phones) ? compact('phones') : [])
                @include('panel.modules.address', isset($addresses) ? compact('addresses') : [])
            </div>
        </div>
    </div>
</div>
