<!--begin::Table head-->
<thead>
    <!--begin::Table row-->
    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
        <th class="w-10px pe-2">
            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
            </div>
        </th>
        <th class="text-center min-w-200px">{{__('common.product')}}</th>
        <th class="text-center min-w-100px">{{__('product.sku')}}</th>
        <th class="text-center min-w-70px">{{__('product.quantity')}}</th>
        <th class="text-center min-w-100px">{{__('common.category')}}</th>
        <th class="text-center min-w-100px">{{__('common.status')}}</th>
        <th class="text-center min-w-70px">{{__('common.actions')}}</th>
    </tr>
    <!--end::Table row-->
</thead>
<!--end::Table head-->
<!--begin::Table body-->
<tbody class="fw-bold text-gray-600">
    @foreach ($products as $product)
    <!--begin::Table row-->
    <tr>
        <!--begin::Checkbox-->
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <!--end::Checkbox-->
        <!--begin::Category=-->
        <td>
            <div class="d-flex align-items-center">
                <!--begin::Thumbnail-->
                <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                    <span class="symbol-label" style="background-image:url({{ config('custom.image_api') . $product->thumb }});"></span>
                </a>
                <!--end::Thumbnail-->
                <div class="ms-5">
                    <!--begin::Title-->
                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{$product->product_name}}</a>
                    <!--end::Title-->
                </div>
            </div>
        </td>
        <!--end::Category=-->
        <!--begin::SKU=-->
        <td class="text-center pe-0">
            <span class="fw-bolder">{{$product->product_code}}</span>
        </td>
        <!--end::SKU=-->
        <!--begin::Qty=-->
        <td class="text-end pe-0">
            <span class="fw-bolder ms-3 text-dark">{{$product->quantity}}</span>
        </td>
        <!--end::Qty=-->
        <!--begin::Price=-->
        <td class="text-center pe-0">
            <span class="fw-bolder ">{{$product->category ? $product->category->name : ''}}</span>
        </td>
        <!--end::Price=-->
        <!--begin::Status=-->
        <td class="text-center pe-0">
            <!--begin::Badges-->
            <div class="badge badge-light-{{\App\Helpers\Helper::renderStatusColor($product->active)}}">{{\App\Helpers\Helper::renderStatus($product->active)}}</div>
            <!--end::Badges-->
        </td>
        <!--end::Status=-->
        <!--begin::Action=-->
        <td class="text-end">
            @can('product.update')
            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn" data-name="{{ $product->product_name }}" data-id="{{ $product->id }}" title="{{ __('common.update') }}">
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                            fill="currentColor" />
                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </button>
            @endcan
            @can('product.delete')
            <button class="btn btn-icon btn-active-light-primary w-30px h-30px delete-btn" data-name="{{ $product->product_name }}" data-id="{{ $product->id }}" title="{{ __('common.delete') }}"
                data-kt-permissions-table-filter="delete_row">
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                            fill="currentColor" />
                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                            fill="currentColor" />
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </button>
            @endcan
        </td>
        <!--end::Action=-->
    </tr>
    <!--end::Table row-->
    @endforeach
</tbody>
<!--end::Table body-->