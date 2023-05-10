<!--begin::Table head-->
<thead>
    <!--begin::Table row-->
    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
        <th class="w-10px pe-2">
            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
            </div>
        </th>
        <th class="min-w-250px">{{__('common.category')}}</th>
        <th class="min-w-150px">{{__('common.status')}}</th>
        <th class="text-end min-w-70px">{{__('common.actions')}}</th>
    </tr>
    <!--end::Table row-->
</thead>
<!--end::Table head-->
<!--begin::Table body-->
<tbody class="fw-bold text-gray-600">
    {!! \App\Helpers\Helper::renderMultilevelHtml($categories) !!}
</tbody>
<!--end::Table body-->