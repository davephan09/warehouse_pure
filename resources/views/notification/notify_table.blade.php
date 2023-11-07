<table class="table align-middle table-row-dashed fs-6 gy-5" id="notification_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-50px">{{ __('common.stt') }}</th>
            <th class="min-w-75px">{{ __('notify.module') }}</th>
            <th class="min-w-200px">{{ __('notify.title') }}</th>
            <th class="text-end min-w-100px">{{ __('notify.time') }}</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @foreach($notifications as $notify)
        <tr>
            <td class="text-center">{{ $loop->index + $notifications->firstItem() }}</td>
            <td>
                <div class="badge badge-light-primary">{{ $notify->module_name }}</a>
            </td>
            <td class="text-start pe-0">{{ $notify->title }}</td>
            <td class="text-end pe-0">{{ date('H:i d/m/Y', strtotime($notify->created_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<div class="py-4 ml-2">
    {!! $notifications->appends(request()->all())->links('includes.paginations') !!}
</div>