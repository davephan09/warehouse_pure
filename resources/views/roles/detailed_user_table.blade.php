<!--begin::Table head-->
<thead>
    <!--begin::Table row-->
    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
        <th class="w-10px pe-2">
            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true"
                    data-kt-check-target="#kt_roles_view_table .form-check-input"
                    value="1" />
            </div>
        </th>
        <th class="min-w-50px">{{ __('user.user_id') }}</th>
        <th class="min-w-150px">{{ __('user.user') }}</th>
        <th class="min-w-125px">{{ __('user.joined_date') }}</th>
        <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
    </tr>
    <!--end::Table row-->
</thead>
<!--end::Table head-->
<!--begin::Table body-->
<tbody class="fw-bold text-gray-600">
    @foreach ($listUsers as $user)
    <tr>
        <!--begin::Checkbox-->
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <!--end::Checkbox-->
        <!--begin::ID-->
        <td>{{'ID-' . $user->id}}</td>
        <!--begin::ID-->
        <!--begin::User=-->
        <td class="d-flex align-items-center">
            <!--begin:: Avatar -->
            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                <a href="{{ route('users.show', ['id' => $user->id]) }}">
                    <div class="symbol-label">
                        @if (isset($user->avatar))
                            <img src="{{ config('custom.image_api') . $user->avatar }}" alt="{{ $user->first_name . ' ' . $user->last_name }}"
                            class="w-100" />
                        @else
                            <span class="symbol-label bg-light-danger text-danger fw-bold">{{ strtoupper(substr($user->username, 0, 1)) }}</span>
                        @endif
                    </div>
                </a>
            </div>
            <!--end::Avatar-->
            <!--begin::User details-->
            <div class="d-flex flex-column">
                <a href="{{ route('users.show', ['id' => $user->id]) }}"
                    class="text-gray-800 text-hover-primary mb-1">{{ $user->first_name . ' ' . $user->last_name }}</a>
                <span>{{ $user->email }}</span>
            </div>
            <!--begin::User details-->
        </td>
        <!--end::user=-->
        <!--begin::Joined date=-->
        <td>{{date('H:i, d M Y', strtotime($user->created_at))}}</td>
        <!--end::Joined date=-->
        <!--begin::Action=-->
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="dropdown" aria-expanded="false"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{__('common.actions')}}
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                <span class="svg-icon svg-icon-5 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none">
                        <path
                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column dropdown-menu menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ route('users.show', ['id' => $user->id]) }}"
                        class="menu-link px-3">{{ __('common.view') }}</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:;" class="menu-link px-3 delete-user"
                        data-kt-roles-table-filter="delete_row">{{ __('common.delete') }}</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
        <!--end::Action=-->
    </tr>
    @endforeach
</tbody>
<!--end::Table body-->