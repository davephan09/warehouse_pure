@extends('layouts.master')

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
    <script src="{{ url('assets/js/custom/apps/user-management/roles/list/add.js') }}"></script>
    {{-- <script src="{{ url('assets/js/custom/apps/user-management/roles/list/update-role.js') }}"></script> --}}
    <script src="{{ url('assets/js/pages/roles.index.js') }}"></script>
    <script>
        $(document).ready(function () {
            var instance = new RolesClass();
            instance.run();
        })
    </script>
@endsection