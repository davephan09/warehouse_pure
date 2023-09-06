@extends('layouts.master')

@section('breadcrumb')
{{ Breadcrumbs::render('role_detail', $roleInfo) }}
@endsection

@section('content')
    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="mb-0">{{$roleInfo->name}}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">
                        @foreach ($permissions as $permission => $actions)
                        @php
                            $actions = implode(', ', $actions->toArray());
                        @endphp
                        <div class="d-flex align-items-center py-2">
                            <span class="bullet bg-primary me-3"></span>{{ucwords($actions) . ' ' . ucfirst($permission)}}
                        </div>
                        @endforeach
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->
                @can('role.update')
                <!--begin::Card footer-->
                <div class="card-footer pt-0">
                    <button type="button" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_update_role">{{ __('role_permission.edit_role') }}</button>
                </div>
                <!--end::Card footer-->
                @endcan
            </div>
            <!--end::Card-->
            <!--begin::Modal-->
            @include('roles.modal_update')
            <!--end::Modal-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-10">
            <!--begin::Card-->
            <div class="card card-flush mb-6 mb-xl-9">
                <!--begin::Card header-->
                <div class="card-header pt-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="d-flex align-items-center">{{ __('role_permission.users_assigned') }}
                            <span class="text-gray-600 fs-6 ms-1" id="user-quantity"></span>
                        </h2>
                    </div>
                    <!--end::Card title-->
                    @can('user.read')
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        @can('user_detail.assign_role')
                        <div class="d-flex align-items-center position-relative my-1 me-20">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_assign_user">
                                <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"/>
                                    </svg>
                                </span>{{ __('role_permission.assign_user') }}
                            </button>
                        </div>
                        @endcan
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1"
                            data-kt-view-roles-table-toolbar="base">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-roles-table-filter="search" id="seach-field"
                                class="form-control form-control-sm form-control-solid w-250px ps-15" placeholder="{{ __('user.search_user') }}" />
                        </div>
                        <!--end::Search-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-view-roles-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-sm btn-danger"
                                data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                    @endcan
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                        
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Layout-->
    @include('roles.modal_assign_user')
@endsection

@section('pageJs')
    {{-- <script src="{{ url('assets/js/custom/apps/user-management/roles/view/view.js') }}"></script> --}}
    <script src="{{ url('assets/js/pages/roles.detailed.js') }}"></script>
    <script>
        $(document).ready(function() {
            var roleId = {{$roleInfo->id}}
            var instance = new RolesDetailedClass()
            instance.run(roleId)
        })
    </script>
@endsection
