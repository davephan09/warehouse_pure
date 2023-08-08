@extends('layouts.master')

@section('breadcrumb')
{{ Breadcrumbs::render('purchasing') }}
@endsection

@section('content')
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1 me-4">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-ecommerce-order-filter="search" id="search-field" class="form-control form-control-sm form-control-solid w-250px ps-14" placeholder="{{__('purchasing.search_bill')}}" />
            </div>
            <!--end::Search-->
            <div class="">
                <select name="num_row" id="num-row-filter" class="form-select form-select-sm form-select-solid" data-control="select2" data-hide-search="true">
                    @foreach($numRowPage as $key => $num)
                    <option value="{{ $key }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <!--begin::Flatpickr-->
            <div class="input-group w-250px">
                <input class="form-control form-control-sm form-control-solid rounded rounded-end-0" placeholder="{{__('common.pick_date_range')}}" 
                    value="" data-plugin="daterangepicker" data-options="{&quot;opens&quot;:&quot;left&quot;}" id="kt_ecommerce_sales_flatpickr" />
            </div>
            <!--end::Flatpickr-->
            @can('purchasing.create')
            <!--begin::Add product-->
            <a href="{{ route('purchasing.create') }}" class="btn btn-sm btn-primary">{{ __('common.add_order') }}</a>
            <!--end::Add product-->
            @endcan
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0" id="purchasing-table">
        <!--begin::Table-->
        
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
@endsection

@section('pageJs')
    <script src="{{ url('assets/js/pages/purchasing.js') }}"></script>
    <script>
        $(document).ready(function() {
            var startdate = '{{ $fromdate->format('d/m/Y') }}'
            var todate = '{{ $todate->format('d/m/Y') }}'
            var options = {
                startdate : startdate,
                todate : todate,
            }
            var instance = new PurchasingClass();
            instance.run(options);
        });
    </script>
@endsection