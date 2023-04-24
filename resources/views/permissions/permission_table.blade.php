<!--begin::Table head-->
<thead>
    <!--begin::Table row-->
    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
        <th class="min-w-125px">{{trans('common.name')}}</th>
        <th class="min-w-250px">{{trans('common.assign_to')}}</th>
        <th class="min-w-125px">{{trans('common.create_date')}}</th>
        <th class="text-end min-w-100px">{{trans('common.actions')}}</th>
    </tr>
    <!--end::Table row-->
</thead>
<!--end::Table head-->
<!--begin::Table body-->
<tbody class="fw-bold text-gray-600">
    @foreach ($listPermission as $permission)
    <tr>
        <!--begin::Name=-->
        <td>{{ $permission->name }}</td>
        <!--end::Name=-->
        <!--begin::Assigned to=-->
        <td>
            @forelse ($permission->roles as $key => $role)
            <a href="{{route('roles.show', ['role' => $role->id])}}" class="badge badge-light-primary fs-7 m-1">{{$role->name}}</a>
            @empty
            @endforelse
        </td>
        <!--end::Assigned to=-->
        <!--begin::Created Date-->
        <td>{{date('H:m d M Y', strtotime($permission->created_at))}}</td>
        <!--end::Created Date-->
        <!--begin::Action=-->
        <td class="text-end">
            @if(!$permission->is_core)
            @can('permission.update')
            <!--begin::Update-->
            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn" data-bs-toggle="modal" data-id="{{$permission->id}}"
                data-bs-target="#kt_modal_update_permission">
                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Update-->
            @endcan
            @can('permission.delete')
            <!--begin::Delete-->
            <button class="btn btn-icon btn-active-light-primary w-30px h-30px delete-btn" data-id="{{$permission->id}}"
                data-kt-permissions-table-filter="delete_row">
                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                            fill="currentColor" />
                        <path opacity="0.5"
                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                            fill="currentColor" />
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </button>
            <!--end::Delete-->
            @endcan
            @else 
            <button type="button" class="btn btn-sm btn-light-danger btn-danger btn-core-permission">Core</button>
            @endif
        </td>
        <!--end::Action=-->
    </tr>
    @endforeach
</tbody>
<!--end::Table body-->
