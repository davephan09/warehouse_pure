<!--begin::Table head-->
<thead>
    <!--begin::Table row-->
    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
        <th class="min-w-125px" data-priority="1">{{trans('supply.supplier_name')}}</th>
        <th class="min-w-125px">{{trans('common.phone')}}</th>
        <th class="min-w-125px">{{trans('supply.payment_method')}}</th>
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
    @forelse ($suppliers as $supplier)
    <tr>
        <!--begin::Name=-->
        <td class="text-start">
            <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">{{json_decode($supplier->name)}}</a>
        </td>
        <!--end::Name=-->
        <!--begin::Email=-->
        <td>
            <a href="#" class="text-gray-600 text-hover-primary mb-1">{{json_decode($supplier->phone)}}</a>
        </td>
        <!--end::Email=-->
        <!--begin::Payment method=-->
        <td data-filter="mastercard">
            <img src="{{$supplier->bank_code ? $banks[$supplier->bank_code]->logo : ''}}" class="w-35px me-3" alt="{{$supplier->bank_code ? $banks[$supplier->bank_code]->shortName : ''}}" data-toggle="tooltip" data-trigger="click" title="{{$supplier->bank_code ? $banks[$supplier->bank_code]->shortName : ''}}" />{{$supplier->account_number ? json_decode($supplier->account_number) : ''}}
        </td>
        <!--end::Payment method=-->
        <td><label class="form-check form-switch form-check-custom form-check-solid">
            <!--begin::Input-->
            <input class="form-check-input is-active-btn" name="active" type="checkbox"
                value="{{$supplier->id}}" {{$supplier->active ? 'checked' : ''}}/>
            <!--end::Input-->
        </label></td>
        <!--begin::Date=-->
        <td>{{date('H:i, d M Y', strtotime($supplier->created_at))}}</td>
        <!--end::Date=-->
        <!--begin::Company=-->
        @php
            $province = $supplier->province ? $address[$supplier->province]->name : '';
            $district = $supplier->district ? $address[$supplier->province]->districts[$supplier->district]->name : '';
            $ward = $supplier->ward ? $address[$supplier->province]->districts[$supplier->district]->wards[$supplier->ward]->name : '';
        @endphp
        <td style="overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;">{{json_decode($supplier->detail_address) . ', ' . $ward . ', ' . $district . ', ' . $province}}</td>
        <!--end::Company=-->
        <!--begin::Action=-->
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-end">{{__('common.actions')}}
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                <span class="svg-icon svg-icon-5 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
        <!--end::Action=-->
    </tr>
    @empty
    @endforelse
    
</tbody>
<!--end::Table body-->
