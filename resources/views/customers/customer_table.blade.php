<table class="table align-middle table-row-dashed fs-6 gy-5" id="customer-table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px" data-priority="1">{{trans('customer.customer_name')}}</th>
            <th class="min-w-125px">{{trans('common.phone')}}</th>
            <th class="min-w-125px">{{trans('customer.payment_method')}}</th>
            <th class="min-w-125px">{{trans('common.is_active')}}</th>
            <th class="min-w-125px">{{trans('common.create_date')}}</th>
            <th class="">{{trans('common.address')}}</th>
            <th class="text-end min-w-70px" data-priority="2">{{trans('common.actions')}}</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fw-bold text-gray-600">
        @forelse ($customers as $customer)
        <tr>
            <!--begin::Name=-->
            <td class="text-start">
                <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">{{$customer->name}}</a>
            </td>
            <!--end::Name=-->
            <!--begin::Email=-->
            <td>
                <a href="tel:{{$customer->phone}}" class="text-gray-600 text-hover-primary mb-1">{{$customer->phone}}</a>
            </td>
            <!--end::Email=-->
            <!--begin::Payment method=-->
            <td data-filter="mastercard">
                <img src="{{$customer->bank_code ? $banks[$customer->bank_code]->logo : ''}}" class="w-35px me-3 bank-icon" alt="{{$customer->bank_code ? $banks[$customer->bank_code]->shortName : ''}}" 
                data-bs-toggle="tooltip" data-trigger="click" title="{{$customer->bank_code ? $banks[$customer->bank_code]->shortName : ''}}" />{{$customer->account_number ? $customer->account_number : ''}}
            </td>
            <!--end::Payment method=-->
            <td><label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                <!--begin::Input-->
                <input class="form-check-input is-active-btn" name="active" type="checkbox"
                    value="{{$customer->id}}" {{$customer->active ? 'checked' : ''}} @if(!auth()->user()->can('customer.update')) {{'disabled'}} @endif/>
                <!--end::Input-->
            </label></td>
            <!--begin::Date=-->
            <td>{{date('H:i, d M Y', strtotime($customer->created_at))}}</td>
            <!--end::Date=-->
            <!--begin::Company=-->
            @php
                $province = $customer->province ? $address[$customer->province]->name : '';
                $district = $customer->district ? $address[$customer->province]->districts[$customer->district]->name : '';
                $ward = $customer->ward ? $address[$customer->province]->districts[$customer->district]->wards[$customer->ward]->name : '';
            @endphp
            <td style="overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;">{{$customer->detail_address . ', ' . $ward . ', ' . $district . ', ' . $province}}</td>
            <!--end::Company=-->
            <!--begin::Action=-->
            <td class="text-end">
                @can('customer.update')
                <!--begin::Update-->
                <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn" data-bs-toggle="modal" data-id="{{$customer->id}}"
                    data-bs-target="#kt_modal_update_customer" title="{{__('common.update')}}">
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
                @can('customer.delete')
                <!--begin::Delete-->
                <button class="btn btn-icon btn-active-light-primary w-30px h-30px delete-btn" data-id="{{$customer->id}}" title="{{__('common.delete')}}"
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
            </td>
            <!--end::Action=-->
        </tr>
        @empty
        @endforelse
        
    </tbody>
    <!--end::Table body-->
</table>

<div class="py-2 ml-2">
    {!! $customers->appends(request()->all())->links('includes.paginations') !!}
</div>