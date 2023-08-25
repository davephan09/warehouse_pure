<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="mw-75px">{{ __('switch.userid') }}</th>
            <th class="min-w-125px">{{ __('switch.username') }}</th>
            <th class="min-w-125px">{{ __('switch.fullname') }}</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @forelse($users as $user)
        <!--begin::Table row-->
        <tr data-id="{{ $user->id }}">
            <td>{{ $user->id }}</td>
            <td>
                <a href="javascript:;" class="text-gray-800 text-hover-primary mb-1 switch-user">{{ $user->username }}</a>
            </td>
            <td class="d-flex align-items-center">
                <a href="javascript:;" class="text-gray-800 text-hover-primary mb-1 switch-user">{{ $user->first_name . ' ' . $user->last_name }}</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3"></td>
        </tr>
        @endforelse
    </tbody>
    <!--end::Table body-->
</table>
<div class="py-4 ml-2">
    {!! $users->appends(request()->all())->links('includes.paginations') !!}
</div>