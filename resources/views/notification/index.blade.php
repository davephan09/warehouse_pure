@extends('layouts.master')

@section('breadcrumb')
{{ Breadcrumbs::render('notification') }}
@endsection

@section('content')
<div class="row g-7">
    <!--begin::Contact groups-->
    <div class="col-lg-3">
        <!--begin::Contact group wrapper-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{ __('notify.filter') }}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Contact groups-->
                <div class="d-flex flex-column gap-5">
                    @foreach ($notify_type as $key => $type)
                        <div class="d-flex flex-stack">
                            <a href="javascript:;" class="fs-6 fw-bolder text-gray-800 text-hover-primary notify-filter {{ $loop->first ? 'text-active-primary active' : '' }}" data-type="{{ $key }}">{{ $type }}</a>
                            <div class="badge badge-light-primary">9</div>
                        </div>
                    @endforeach
                </div>
                <!--end::Contact groups-->
                @can('notification.create')
                    <!--begin::Separator-->
                    <div class="separator my-7"></div>
                    <!--begin::Separator-->
                    <!--begin::Add new contact-->
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modal_add_notification">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="currentColor"/>
                                <path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->{{ __('notify.add_new') }}</button>
                    <!--end::Add new contact-->
                @endcan
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contact group wrapper-->
    </div>
    <!--end::Contact groups-->
    <!--begin::Content-->
    <div class="col-lg-9">
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                    <span class="svg-icon svg-icon-1 me-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="currentColor"/>
                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <h2>{{ __('notify.list_noti') }}</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar gap-3">
                    
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5" id="notification_list">
                
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
    <!--end::Content-->
</div>

@can('notification.create')
    @include('notification.modal_create')
@endcan

@endsection

@section('pageJs')
    <script src="{{ url('assets/js/pages/notification.js') }}"></script>
    <script>
        $(document).ready(function() {
            var options = {}
            var instance = new NotificationClass();
            instance.run(options);
        });
    </script>
@endsection