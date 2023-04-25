@extends('layouts.master')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">{{trans('common.home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">{{trans('common.user_management')}}</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{trans('role_permission.role')}}</li>
</ul>
@endsection

@section('content')
<!--begin::Row-->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9" id="content-page">
    
</div>
<!--end::Row-->
<!--begin::Modals-->
@include('roles.modal_create')
@include('roles.modal_update')
<!--end::Modals-->
@endsection

@section('pageJs')
    {{-- <script src="{{ url('assets/js/custom/apps/user-management/roles/list/add.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/js/custom/apps/user-management/roles/list/update-role.js') }}"></script> --}}
    <script src="{{ url('assets/js/pages/roles.index.js') }}"></script>
    <script>
        $(document).ready(function () {
            var instance = new RolesClass();
            instance.run();
        })
    </script>
@endsection