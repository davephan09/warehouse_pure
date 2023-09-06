@foreach ($rolesInfo as $key => $role)
<!--begin::Col-->
<div class="col-md-4">
    <!--begin::Card-->
    <div class="card card-flush h-md-100">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>{{$listRoles[$key]}}</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-1">
            <!--begin::Users-->
            <div class="fw-bolder text-gray-600 mb-5">{{ __('role_permission.total_users_role') }} {{ $roles[$key]->users->count() }}</div>
            <!--end::Users-->
            <!--begin::Permissions-->
            <div class="d-flex flex-column text-gray-600">
                @foreach ($role as $permission => $action)
                @if ($loop->iteration <= 5)
                    @php
                        $action = implode(', ', $action->toArray());
                    @endphp    
                    <div class="d-flex align-items-center py-2">
                        <span class="bullet bg-primary me-3"></span>{{ ucwords($action) . ' ' . ucfirst($permission) }}
                    </div>
                @endif
                @endforeach
                @if(count($role) > 5)
                <div class='d-flex align-items-center py-2'>
                    <span class='bullet bg-primary me-3'></span>
                    <em>{{ __('common.and') }} {{ count($role) - 5 }} {{ __('common.more') }}...</em>
                </div>
                @endif
            </div>
            <!--end::Permissions-->
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <div class="card-footer flex-wrap pt-0">
            @can('role.read')
            <a href="{{route('roles.show', ['role' => $key])}}"
                class="btn btn-sm btn-light btn-active-primary my-1 me-2">{{ __('role_permission.view_role') }}</a>
            @endcan
            @can('role.update')
            <button type="button" class="btn btn-sm btn-light btn-active-light-primary my-1 edit-btn" data-bs-toggle="modal" data-id="{{$key}}"
                data-bs-target="#kt_modal_update_role">{{ __('role_permission.edit_role') }}</button>
            @endcan
            @can('role.delete')
            <button type="button" class="btn btn-sm btn-light btn-active-light-danger my-1 remove-role" data-id="{{$key}}">{{ __('common.remove') }}</button>
            @endcan
            </div>
        <!--end::Card footer-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->
@endforeach

@can('role.create')
<!--begin::Add new card-->
<div class="ol-md-4">
    <!--begin::Card-->
    <div class="card h-md-100">
        <!--begin::Card body-->
        <div class="card-body d-flex flex-center">
            <!--begin::Button-->
            <button type="button" class="btn btn-sm btn-clear d-flex flex-column flex-center" data-bs-toggle="modal"
                data-bs-target="#kt_modal_add_role">
                <!--begin::Illustration-->
                <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                <!--end::Illustration-->
                <!--begin::Label-->
                <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{ __('role_permission.add_new_role') }}</div>
                <!--end::Label-->
            </button>
            <!--begin::Button-->
        </div>
        <!--begin::Card body-->
    </div>
    <!--begin::Card-->
</div>
<!--begin::Add new card-->
@endcan
