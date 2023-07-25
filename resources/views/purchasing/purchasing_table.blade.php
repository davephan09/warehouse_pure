<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                </div>
            </th>
            <th class="min-w-50px">Order ID</th>
            <th class="min-w-175px">Supplier</th>
            <th class="text-end min-w-70px">Date</th>
            <th class="text-end min-w-100px">Total</th>
            <th class="text-end min-w-100px">Paid</th>
            <th class="text-end min-w-100px">Debt</th>
            <th class="text-end min-w-100px">Actions</th>
        </tr>
    </thead>
    <tbody class="fw-bold text-gray-600">
        @foreach($bills as $bill)
        <tr>
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" />
                </div>
            </td>
            <td data-kt-ecommerce-order-filter="order_id">{{ $bill->id }}</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="ms-5">
                        <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ json_decode($bill->supplier->name) }}</a>
                    </div>
                </div>
            </td>
            <td class="text-end pe-0" data-order="Completed">
                <div class="badge badge-light-success">{{ date('d/m/Y', strtotime($bill->date)) }}</div>
            </td>
            <td class="text-end pe-0">
                <span class="fw-bolder">{{ number_format($bill->cost) }}</span>
            </td>
            <td class="text-end" >
                <span class="fw-bolder">{{ number_format($bill->paid) }}</span>
            </td>
            <!--end::Date Added=-->
            <!--begin::Date Modified=-->
            <td class="text-end" >
                <span class="fw-bolder">{{ number_format($bill->debt) }}</span>
            </td>
            <!--end::Date Modified=-->
            <!--begin::Action=-->
            <td class="text-end">
                <a class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn action-btn" href="{{ route('purchasing.show', ['id' => $bill->id]) }}" data-bs-toggle="tooltip" data-id="{{ $bill->id }}" data-bs-placement="top" title="{{__('common.update')}}">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
                <button class="btn btn-icon btn-active-light-primary w-30px h-30px delete-btn action-btn" data-id="{{ $bill->id }}" data-bs-toggle="tooltip" title="{{__('common.delete')}}" data-kt-permissions-table-filter="delete_row">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </button>
            </td>
            <!--end::Action=-->
        </tr>
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<div class="py-2 ml-2">
    {!! $bills->appends(request()->all())->links('includes.paginations') !!}
</div>