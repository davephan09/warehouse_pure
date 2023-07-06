@extends('layouts.master')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">{{trans('common.home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">{{trans('common.user_management')}}</li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-300 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">{{trans('role_permission.permission')}}</li>
</ul>
@endsection

@section('content')
<form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" action="javascript:;">
    <!--begin::Aside column-->
    <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
        <!--begin::Order details-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('purchasing.purchasing_details')}}</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="d-flex flex-column gap-10">
                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="form-label">{{__('purchasing.order_id')}}</label>
                        <!--end::Label-->
                        <!--begin::Auto-generated ID-->
                        <div class="fw-bolder fs-3">#{{$orderId}}</div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('purchasing.supplier')}}</label>
                        <!--end::Label-->
                        <!--begin::Select2-->
                        <select class="form-select mb-2" data-control="select2" data-allow-clear="true" data-hide-search="true" data-placeholder="{{__('purchasing.select_supplier')}}"
                            name="payment_method" id="kt_ecommerce_edit_order_payment">
                            <option></option>
                            @forelse($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @empty
                                <option></option>
                            @endforelse
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">{{__('purchasing.supplier_des')}}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row d-none border-dashed rounded p-2" id="supplier-detail">
                        
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{__('purchasing.date')}}</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <div class="d-flex align-items-center position-relative mb-n7">
                            <input id="kt_ecommerce_edit_order_date" type="text" name="order_date" placeholder="{{__('purchasing.select_date')}}" data-plugin="daterangepicker" 
                                data-options="{&quot;open&quot;:&quot;left&quot;}" data-single-date-picker="true" data-show-dropdowns="true" data-auto-apply="true" class="form-control" value="" />
                            <span class="svg-icon svg-icon-1 position-absolute me-4 end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 3H18V1H16V3H8V1H6V3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V8H19V19ZM19 6H5V5H19V6Z" fill="currentColor"></path>
                                    <rect x="8" y="10" width="8" height="2" rx="1" fill="currentColor"></rect>
                                    <rect x="8" y="14" width="8" height="2" rx="1" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                        <!--end::Editor-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">{{__('purchasing.date_des')}}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Order details-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
        <!--begin::Order details-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('purchasing.new_purchasing_order')}}</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="d-flex flex-column gap-10">
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label">{{__('purchasing.order_purchasing_des')}}</label>
                        <!--end::Label-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Separator-->
                    <div class="separator"></div>
                    <!--end::Separator-->
                    <div class="mb-0">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive mb-10">
                            <!--begin::Table-->
                            <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700" data-kt-element="items">
                                <colgroup>
                                    <col class="w-40" style="width: 40%">
                                    <col class="w-10" style="width: 12%">
                                    <col class="w-20" style="width: 20%">
                                    <col class="w-20" style="width: 20%">
                                    <col class="w-10" style="width: 8%">
                                </colgroup>
                                <thead>
                                    <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                        <th class="min-w-300px w-475px w-40">{{__('purchasing.item')}}</th>
                                        <th class="min-w-100px w-100px w-10">{{__('product.quantity')}}</th>
                                        <th class="min-w-150px w-150px text-center w-20">{{__('product.price')}}</th>
                                        <th class="min-w-100px w-150px text-end w-20">{{__('purchasing.total')}}</th>
                                        <th class="min-w-75px w-75px text-end w-10">{{__('common.action')}}</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id="list-item">
                                    <tr class="product-item border-bottom border-bottom-dashed" data-kt-element="item">
                                        <td colspan="5">
                                            <table class="w-100">
                                                <colgroup>
                                                    <col class="w-40" style="width: 40%">
                                                    <col class="w-10" style="width: 12%">
                                                    <col class="w-20" style="width: 20%">
                                                    <col class="w-20" style="width: 20%">
                                                    <col class="w-10" style="width: 8%">
                                                </colgroup>
                                                <tbody class="body-item">
                                                    <tr>
                                                        <td class="pe-7 pb-8 product-field">
                                                            <select class="form-select form-select-solid product-input">
                                                                
                                                            </select>
                                                        </td>
                                                        <td class="ps-0 pb-8">
                                                            <input class="form-control form-control-solid auto-cal quantity-input" type="number" min="1" name="quantity[]" placeholder="1" value="1" data-kt-element="quantity" />
                                                            
                                                        </td>
                                                        <td class=" pb-8 input-group input-group-solid">
                                                            <input type="text" class="form-control form-control-solid auto-cal text-end price-input" name="price[]" placeholder="0" value="" data-kt-element="price" />
                                                            <span class="input-group-text">đ</span>
                                                        </td>
                                                        <td class="text-end pb-8 text-nowrap">
                                                            <span data-kt-element="total" class="item-total ">0</span> đ
                                                        </td>
                                                        <td class="pb-8 text-end">
                                                            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary btn-remove-item" data-kt-element="remove-item">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr index="0">
                                                        <td class="py-0"></td>
                                                        <td colspan="4" class="ps-0 py-0 tax-field">
                                                            <div class="position-relative">
                                                                <div class="position-absolute" style="top:-1.5rem; left:3rem;">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-link py-1 add-tax-btn" data-bs-toggle="tooltip" type="button" data-bs-trigger="hover" title="">{{__('purchasing.add_tax')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                                <!--end::Table body-->
                                <!--begin::Table foot-->
                                <tfoot>
                                    <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                                        <th class="text-primary">
                                            <button class="btn btn-link py-1" id="add-item" data-kt-element="add-item">{{__('purchasing.add_item')}}</button>
                                        </th>
                                        <th colspan="2" class="border-bottom border-bottom-dashed ps-0" id="sub-total-text-div">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="fs-5 pb-2">{{__('purchasing.subtotal')}}</div>
                                                <div class="">
                                                    <button class="btn btn-link py-1" data-bs-toggle="tooltip" type="button" id="add_discount" data-bs-trigger="hover" title="{{__("purchasing.add_discount")}}">{{__("purchasing.add_discount")}}</button>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="2" class="border-bottom border-bottom-dashed text-end" id="sub-total-div">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="pb-2 fs-5">
                                                    <span data-kt-element="sub-total" id="sub-total">0</span> đ
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="d-none align-top fs-6 fw-bolder text-gray-700" id="discount-field">
                                        <th class="pt-0"></th>
                                        <th colspan="2" class="pt-0 border-bottom border-bottom-dashed ps-0">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="input-group input-group-solid">
                                                    <input type="text" class="form-control form-control-solid auto-cal text-end discount-cal" id="discount_value" name="discount[]" placeholder="0" value="" data-kt-element="price" />
                                                    <input type="radio" class="btn-check auto-cal discount-cal" name="discount_options" id="dc-percent" autocomplete="off" checked>
                                                    <label class="btn btn-outline-primary" for="dc-percent">%</label>
                                                    <input type="radio" class="btn-check auto-cal discount-cal" name="discount_options" id="dc-price" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="dc-price">đ</label>
                                                </div>
                                            </div>
                                        </th>
                                        <th colspan="2" class="pt-0 border-bottom align-middle border-bottom-dashed">
                                            <div class="float-end">
                                                <span data-kt-element="sub-total" id="discount-price">0</span> đ
                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="align-top fw-bolder text-gray-700">
                                        <th></th>
                                        <th colspan="2" class="fs-4 ps-0">{{__('purchasing.total')}}</th>
                                        <th colspan="2" class="text-end fs-4 text-nowrap">
                                        <span data-kt-element="grand-total" id="total">0</span> đ</th>
                                    </tr>
                                </tfoot>
                                <!--end::Table foot-->
                            </table>
                        </div>
                        <!--end::Table-->
                        <!--begin::Item template-->
                        <table class="table d-none" data-kt-element="item-template">
                            <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                <td class="pe-7">
                                    <input type="text" class="form-control form-control-solid mb-2" name="name[]" placeholder="Item name" />
                                    <input type="text" class="form-control form-control-solid" name="description[]" placeholder="Description" />
                                </td>
                                <td class="ps-0">
                                    <input class="form-control form-control-solid" type="number" min="1" name="quantity[]" placeholder="1" data-kt-element="quantity" />
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-solid text-end" name="price[]" placeholder="0.00" data-kt-element="price" />
                                </td>
                                <td class="pt-8 text-end">$
                                <span data-kt-element="total">0.00</span></td>
                                <td class="pt-5 text-end">
                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </td>
                            </tr>
                        </table>
                        <table class="table d-none" data-kt-element="empty-template">
                            <tr data-kt-element="empty">
                                <th colspan="5" class="text-muted text-center py-10">No items</th>
                            </tr>
                        </table>
                        <!--end::Item template-->
                        <!--begin::Notes-->
                        <div class="mb-0">
                            <label class="form-label fs-6 fw-bolder text-gray-700">Notes</label>
                            <textarea name="notes" class="form-control form-control-solid" id="note-field" rows="3" placeholder="Thanks for your business"></textarea>
                        </div>
                        <!--end::Notes-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Order details-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('purchasing.payment_info')}}</h2>
                </div>
            </div>
            <!--end::Card header-->
        
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Billing address-->
                <div class="d-flex flex-column gap-5 gap-md-7">
                    <!--begin::Title-->
                    <div class="fs-4 fw-bold mb-n2">{{__('purchasing.paid')}}</div>
                    <!--end::Title-->
        
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid fv-plugins-icon-container  col-6">
                            {{-- <label class="required form-label">Address Line 1</label> --}}
                            <div class="d-flex">
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="0" type="button">0%</button>
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="10" type="button">10%</button>
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="25" type="button">25%</button>
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="50" type="button">50%</button>
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="75" type="button">75%</button>
                                <button class="btn btn-sm btn-outline-primary percent-paid" data-value="100" type="button">100%</button>
                            </div>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
        
                        <div class="flex-row-fluid  col-6">
                            {{-- <label class="form-label">Address Line 2</label> --}}
                            <div class="d-flex input-group input-group-solid">
                                <input class="form-control" id="amount-paid" type="text" name="billing_order_address_2" placeholder="{{__('purchasing.type_price')}}">
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
        
                    <!--begin::Input group-->
                    <div class="d-flex flex-column flex-md-row gap-5">
                        <div class="fv-row flex-row-fluid fv-plugins-icon-container col-6">
                            <div class="fs-4 fw-bold mb-n2">{{__('purchasing.debt')}}</div>
                        </div>
        
                        <div class="flex-row-fluid  col-6">
                            {{-- <label class="form-label">Address Line 2</label> --}}
                            <div class="d-flex input-group input-group-solid">
                                <input class="form-control" id="amount-debt" disabled name="billing_order_address_2" placeholder="">
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                    </div>
        
                    <!--begin::Shipping address-->
                    <div class="d-none d-flex flex-column gap-5 gap-md-7" id="kt_ecommerce_edit_order_shipping_form">
                        <!--begin::Title-->
                        <div class="fs-3 fw-bold mb-n2">Shipping Address</div>
                        <!--end::Title-->
        
                        <!--begin::Input group-->
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">Address Line 1</label>
                                <!--end::Label-->
        
                                <!--begin::Input-->
                                <input class="form-control" name="kt_ecommerce_edit_order_address_1" placeholder="Address Line 1" value="">
                                <!--end::Input-->
                            </div>
        
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">Address Line 2</label>
                                <!--end::Label-->
        
                                <!--begin::Input-->
                                <input class="form-control" name="kt_ecommerce_edit_order_address_2" placeholder="Address Line 2">
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">City</label>
                                <!--end::Label-->
        
                                <!--begin::Input-->
                                <input class="form-control" name="kt_ecommerce_edit_order_city" placeholder="" value="">
                                <!--end::Input-->
                            </div>
        
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">Postcode</label>
                                <!--end::Label-->
        
                                <!--begin::Input-->
                                <input class="form-control" name="kt_ecommerce_edit_order_postcode" placeholder="" value="">
                                <!--end::Input-->
                            </div>
        
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">State</label>
                                <!--end::Label-->
        
                                <!--begin::Input-->
                                <input class="form-control" name="kt_ecommerce_edit_order_state" placeholder="" value="">
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->
        
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label">Country</label>
                            <!--end::Label-->
        
                            <!--begin::Select2-->
                            <select class="form-select select2-hidden-accessible" data-placeholder="Select an option" id="kt_ecommerce_edit_order_shipping_country" data-select2-id="select2-data-kt_ecommerce_edit_order_shipping_country" tabindex="-1" aria-hidden="true">
                                <option data-select2-id="select2-data-125-vyc4"></option>
                                                            <option value="AF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/afghanistan.svg">Afghanistan</option>
                                                            <option value="AX" data-kt-select2-country="/metronic8/demo1/assets/media/flags/aland-islands.svg">Aland Islands</option>
                                                            <option value="AL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/albania.svg">Albania</option>
                                                            <option value="DZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/algeria.svg">Algeria</option>
                                                            <option value="AS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/american-samoa.svg">American Samoa</option>
                                                            <option value="AD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/andorra.svg">Andorra</option>
                                                            <option value="AO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/angola.svg">Angola</option>
                                                            <option value="AI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/anguilla.svg">Anguilla</option>
                                                            <option value="AG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/antigua-and-barbuda.svg">Antigua and Barbuda</option>
                                                            <option value="AR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/argentina.svg">Argentina</option>
                                                            <option value="AM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/armenia.svg">Armenia</option>
                                                            <option value="AW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/aruba.svg">Aruba</option>
                                                            <option value="AU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/australia.svg">Australia</option>
                                                            <option value="AT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/austria.svg">Austria</option>
                                                            <option value="AZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/azerbaijan.svg">Azerbaijan</option>
                                                            <option value="BS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bahamas.svg">Bahamas</option>
                                                            <option value="BH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bahrain.svg">Bahrain</option>
                                                            <option value="BD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bangladesh.svg">Bangladesh</option>
                                                            <option value="BB" data-kt-select2-country="/metronic8/demo1/assets/media/flags/barbados.svg">Barbados</option>
                                                            <option value="BY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/belarus.svg">Belarus</option>
                                                            <option value="BE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/belgium.svg">Belgium</option>
                                                            <option value="BZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/belize.svg">Belize</option>
                                                            <option value="BJ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/benin.svg">Benin</option>
                                                            <option value="BM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bermuda.svg">Bermuda</option>
                                                            <option value="BT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bhutan.svg">Bhutan</option>
                                                            <option value="BO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bolivia.svg">Bolivia, Plurinational State of</option>
                                                            <option value="BQ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bonaire.svg">Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="BA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bosnia-and-herzegovina.svg">Bosnia and Herzegovina</option>
                                                            <option value="BW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/botswana.svg">Botswana</option>
                                                            <option value="BR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/brazil.svg">Brazil</option>
                                                            <option value="IO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/british-indian-ocean-territory.svg">British Indian Ocean Territory</option>
                                                            <option value="BN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/brunei.svg">Brunei Darussalam</option>
                                                            <option value="BG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/bulgaria.svg">Bulgaria</option>
                                                            <option value="BF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/burkina-faso.svg">Burkina Faso</option>
                                                            <option value="BI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/burundi.svg">Burundi</option>
                                                            <option value="KH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cambodia.svg">Cambodia</option>
                                                            <option value="CM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cameroon.svg">Cameroon</option>
                                                            <option value="CA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/canada.svg">Canada</option>
                                                            <option value="CV" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cape-verde.svg">Cape Verde</option>
                                                            <option value="KY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cayman-islands.svg">Cayman Islands</option>
                                                            <option value="CF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/central-african-republic.svg">Central African Republic</option>
                                                            <option value="TD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/chad.svg">Chad</option>
                                                            <option value="CL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/chile.svg">Chile</option>
                                                            <option value="CN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/china.svg">China</option>
                                                            <option value="CX" data-kt-select2-country="/metronic8/demo1/assets/media/flags/christmas-island.svg">Christmas Island</option>
                                                            <option value="CC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cocos-island.svg">Cocos (Keeling) Islands</option>
                                                            <option value="CO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/colombia.svg">Colombia</option>
                                                            <option value="KM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/comoros.svg">Comoros</option>
                                                            <option value="CK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cook-islands.svg">Cook Islands</option>
                                                            <option value="CR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/costa-rica.svg">Costa Rica</option>
                                                            <option value="CI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ivory-coast.svg">Côte d'Ivoire</option>
                                                            <option value="HR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/croatia.svg">Croatia</option>
                                                            <option value="CU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/cuba.svg">Cuba</option>
                                                            <option value="CW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/curacao.svg">Curaçao</option>
                                                            <option value="CZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/czech-republic.svg">Czech Republic</option>
                                                            <option value="DK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/denmark.svg">Denmark</option>
                                                            <option value="DJ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/djibouti.svg">Djibouti</option>
                                                            <option value="DM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/dominica.svg">Dominica</option>
                                                            <option value="DO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/dominican-republic.svg">Dominican Republic</option>
                                                            <option value="EC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ecuador.svg">Ecuador</option>
                                                            <option value="EG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/egypt.svg">Egypt</option>
                                                            <option value="SV" data-kt-select2-country="/metronic8/demo1/assets/media/flags/el-salvador.svg">El Salvador</option>
                                                            <option value="GQ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/equatorial-guinea.svg">Equatorial Guinea</option>
                                                            <option value="ER" data-kt-select2-country="/metronic8/demo1/assets/media/flags/eritrea.svg">Eritrea</option>
                                                            <option value="EE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/estonia.svg">Estonia</option>
                                                            <option value="ET" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ethiopia.svg">Ethiopia</option>
                                                            <option value="FK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/falkland-islands.svg">Falkland Islands (Malvinas)</option>
                                                            <option value="FJ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/fiji.svg">Fiji</option>
                                                            <option value="FI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/finland.svg">Finland</option>
                                                            <option value="FR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/france.svg">France</option>
                                                            <option value="PF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/french-polynesia.svg">French Polynesia</option>
                                                            <option value="GA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/gabon.svg">Gabon</option>
                                                            <option value="GM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/gambia.svg">Gambia</option>
                                                            <option value="GE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/georgia.svg">Georgia</option>
                                                            <option value="DE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/germany.svg">Germany</option>
                                                            <option value="GH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ghana.svg">Ghana</option>
                                                            <option value="GI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/gibraltar.svg">Gibraltar</option>
                                                            <option value="GR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/greece.svg">Greece</option>
                                                            <option value="GL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/greenland.svg">Greenland</option>
                                                            <option value="GD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/grenada.svg">Grenada</option>
                                                            <option value="GU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/guam.svg">Guam</option>
                                                            <option value="GT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/guatemala.svg">Guatemala</option>
                                                            <option value="GG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/guernsey.svg">Guernsey</option>
                                                            <option value="GN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/guinea.svg">Guinea</option>
                                                            <option value="GW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/guinea-bissau.svg">Guinea-Bissau</option>
                                                            <option value="HT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/haiti.svg">Haiti</option>
                                                            <option value="VA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/vatican-city.svg">Holy See (Vatican City State)</option>
                                                            <option value="HN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/honduras.svg">Honduras</option>
                                                            <option value="HK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/hong-kong.svg">Hong Kong</option>
                                                            <option value="HU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/hungary.svg">Hungary</option>
                                                            <option value="IS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/iceland.svg">Iceland</option>
                                                            <option value="IN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/india.svg">India</option>
                                                            <option value="ID" data-kt-select2-country="/metronic8/demo1/assets/media/flags/indonesia.svg">Indonesia</option>
                                                            <option value="IR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/iran.svg">Iran, Islamic Republic of</option>
                                                            <option value="IQ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/iraq.svg">Iraq</option>
                                                            <option value="IE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ireland.svg">Ireland</option>
                                                            <option value="IM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/isle-of-man.svg">Isle of Man</option>
                                                            <option value="IL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/israel.svg">Israel</option>
                                                            <option value="IT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/italy.svg">Italy</option>
                                                            <option value="JM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/jamaica.svg">Jamaica</option>
                                                            <option value="JP" data-kt-select2-country="/metronic8/demo1/assets/media/flags/japan.svg">Japan</option>
                                                            <option value="JE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/jersey.svg">Jersey</option>
                                                            <option value="JO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/jordan.svg">Jordan</option>
                                                            <option value="KZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/kazakhstan.svg">Kazakhstan</option>
                                                            <option value="KE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/kenya.svg">Kenya</option>
                                                            <option value="KI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/kiribati.svg">Kiribati</option>
                                                            <option value="KP" data-kt-select2-country="/metronic8/demo1/assets/media/flags/north-korea.svg">Korea, Democratic People's Republic of</option>
                                                            <option value="KW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/kuwait.svg">Kuwait</option>
                                                            <option value="KG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/kyrgyzstan.svg">Kyrgyzstan</option>
                                                            <option value="LA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/laos.svg">Lao People's Democratic Republic</option>
                                                            <option value="LV" data-kt-select2-country="/metronic8/demo1/assets/media/flags/latvia.svg">Latvia</option>
                                                            <option value="LB" data-kt-select2-country="/metronic8/demo1/assets/media/flags/lebanon.svg">Lebanon</option>
                                                            <option value="LS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/lesotho.svg">Lesotho</option>
                                                            <option value="LR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/liberia.svg">Liberia</option>
                                                            <option value="LY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/libya.svg">Libya</option>
                                                            <option value="LI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/liechtenstein.svg">Liechtenstein</option>
                                                            <option value="LT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/lithuania.svg">Lithuania</option>
                                                            <option value="LU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/luxembourg.svg">Luxembourg</option>
                                                            <option value="MO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/macao.svg">Macao</option>
                                                            <option value="MG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/madagascar.svg">Madagascar</option>
                                                            <option value="MW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/malawi.svg">Malawi</option>
                                                            <option value="MY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/malaysia.svg">Malaysia</option>
                                                            <option value="MV" data-kt-select2-country="/metronic8/demo1/assets/media/flags/maldives.svg">Maldives</option>
                                                            <option value="ML" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mali.svg">Mali</option>
                                                            <option value="MT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/malta.svg">Malta</option>
                                                            <option value="MH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/marshall-island.svg">Marshall Islands</option>
                                                            <option value="MQ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/martinique.svg">Martinique</option>
                                                            <option value="MR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mauritania.svg">Mauritania</option>
                                                            <option value="MU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mauritius.svg">Mauritius</option>
                                                            <option value="MX" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mexico.svg">Mexico</option>
                                                            <option value="FM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/micronesia.svg">Micronesia, Federated States of</option>
                                                            <option value="MD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/moldova.svg">Moldova, Republic of</option>
                                                            <option value="MC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/monaco.svg">Monaco</option>
                                                            <option value="MN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mongolia.svg">Mongolia</option>
                                                            <option value="ME" data-kt-select2-country="/metronic8/demo1/assets/media/flags/montenegro.svg">Montenegro</option>
                                                            <option value="MS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/montserrat.svg">Montserrat</option>
                                                            <option value="MA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/morocco.svg">Morocco</option>
                                                            <option value="MZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/mozambique.svg">Mozambique</option>
                                                            <option value="MM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/myanmar.svg">Myanmar</option>
                                                            <option value="NA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/namibia.svg">Namibia</option>
                                                            <option value="NR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/nauru.svg">Nauru</option>
                                                            <option value="NP" data-kt-select2-country="/metronic8/demo1/assets/media/flags/nepal.svg">Nepal</option>
                                                            <option value="NL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/netherlands.svg">Netherlands</option>
                                                            <option value="NZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/new-zealand.svg">New Zealand</option>
                                                            <option value="NI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/nicaragua.svg">Nicaragua</option>
                                                            <option value="NE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/niger.svg">Niger</option>
                                                            <option value="NG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/nigeria.svg">Nigeria</option>
                                                            <option value="NU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/niue.svg">Niue</option>
                                                            <option value="NF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/norfolk-island.svg">Norfolk Island</option>
                                                            <option value="MP" data-kt-select2-country="/metronic8/demo1/assets/media/flags/northern-mariana-islands.svg">Northern Mariana Islands</option>
                                                            <option value="NO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/norway.svg">Norway</option>
                                                            <option value="OM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/oman.svg">Oman</option>
                                                            <option value="PK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/pakistan.svg">Pakistan</option>
                                                            <option value="PW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/palau.svg">Palau</option>
                                                            <option value="PS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/palestine.svg">Palestinian Territory, Occupied</option>
                                                            <option value="PA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/panama.svg">Panama</option>
                                                            <option value="PG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/papua-new-guinea.svg">Papua New Guinea</option>
                                                            <option value="PY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/paraguay.svg">Paraguay</option>
                                                            <option value="PE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/peru.svg">Peru</option>
                                                            <option value="PH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/philippines.svg">Philippines</option>
                                                            <option value="PL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/poland.svg">Poland</option>
                                                            <option value="PT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/portugal.svg">Portugal</option>
                                                            <option value="PR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/puerto-rico.svg">Puerto Rico</option>
                                                            <option value="QA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/qatar.svg">Qatar</option>
                                                            <option value="RO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/romania.svg">Romania</option>
                                                            <option value="RU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/russia.svg">Russian Federation</option>
                                                            <option value="RW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/rwanda.svg">Rwanda</option>
                                                            <option value="BL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/st-barts.svg">Saint Barthélemy</option>
                                                            <option value="KN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/saint-kitts-and-nevis.svg">Saint Kitts and Nevis</option>
                                                            <option value="LC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/st-lucia.svg">Saint Lucia</option>
                                                            <option value="MF" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sint-maarten.svg">Saint Martin (French part)</option>
                                                            <option value="VC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/st-vincent-and-the-grenadines.svg">Saint Vincent and the Grenadines</option>
                                                            <option value="WS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/samoa.svg">Samoa</option>
                                                            <option value="SM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/san-marino.svg">San Marino</option>
                                                            <option value="ST" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sao-tome-and-prince.svg">Sao Tome and Principe</option>
                                                            <option value="SA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/saudi-arabia.svg">Saudi Arabia</option>
                                                            <option value="SN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/senegal.svg">Senegal</option>
                                                            <option value="RS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/serbia.svg">Serbia</option>
                                                            <option value="SC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/seychelles.svg">Seychelles</option>
                                                            <option value="SL" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sierra-leone.svg">Sierra Leone</option>
                                                            <option value="SG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/singapore.svg">Singapore</option>
                                                            <option value="SX" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sint-maarten.svg">Sint Maarten (Dutch part)</option>
                                                            <option value="SK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/slovakia.svg">Slovakia</option>
                                                            <option value="SI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/slovenia.svg">Slovenia</option>
                                                            <option value="SB" data-kt-select2-country="/metronic8/demo1/assets/media/flags/solomon-islands.svg">Solomon Islands</option>
                                                            <option value="SO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/somalia.svg">Somalia</option>
                                                            <option value="ZA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/south-africa.svg">South Africa</option>
                                                            <option value="KR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/south-korea.svg">South Korea</option>
                                                            <option value="SS" data-kt-select2-country="/metronic8/demo1/assets/media/flags/south-sudan.svg">South Sudan</option>
                                                            <option value="ES" data-kt-select2-country="/metronic8/demo1/assets/media/flags/spain.svg">Spain</option>
                                                            <option value="LK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sri-lanka.svg">Sri Lanka</option>
                                                            <option value="SD" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sudan.svg">Sudan</option>
                                                            <option value="SR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/suriname.svg">Suriname</option>
                                                            <option value="SZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/swaziland.svg">Swaziland</option>
                                                            <option value="SE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/sweden.svg">Sweden</option>
                                                            <option value="CH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/switzerland.svg">Switzerland</option>
                                                            <option value="SY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/syria.svg">Syrian Arab Republic</option>
                                                            <option value="TW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/taiwan.svg">Taiwan, Province of China</option>
                                                            <option value="TJ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tajikistan.svg">Tajikistan</option>
                                                            <option value="TZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tanzania.svg">Tanzania, United Republic of</option>
                                                            <option value="TH" data-kt-select2-country="/metronic8/demo1/assets/media/flags/thailand.svg">Thailand</option>
                                                            <option value="TG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/togo.svg">Togo</option>
                                                            <option value="TK" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tokelau.svg">Tokelau</option>
                                                            <option value="TO" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tonga.svg">Tonga</option>
                                                            <option value="TT" data-kt-select2-country="/metronic8/demo1/assets/media/flags/trinidad-and-tobago.svg">Trinidad and Tobago</option>
                                                            <option value="TN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tunisia.svg">Tunisia</option>
                                                            <option value="TR" data-kt-select2-country="/metronic8/demo1/assets/media/flags/turkey.svg">Turkey</option>
                                                            <option value="TM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/turkmenistan.svg">Turkmenistan</option>
                                                            <option value="TC" data-kt-select2-country="/metronic8/demo1/assets/media/flags/turks-and-caicos.svg">Turks and Caicos Islands</option>
                                                            <option value="TV" data-kt-select2-country="/metronic8/demo1/assets/media/flags/tuvalu.svg">Tuvalu</option>
                                                            <option value="UG" data-kt-select2-country="/metronic8/demo1/assets/media/flags/uganda.svg">Uganda</option>
                                                            <option value="UA" data-kt-select2-country="/metronic8/demo1/assets/media/flags/ukraine.svg">Ukraine</option>
                                                            <option value="AE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/united-arab-emirates.svg">United Arab Emirates</option>
                                                            <option value="GB" data-kt-select2-country="/metronic8/demo1/assets/media/flags/united-kingdom.svg">United Kingdom</option>
                                                            <option value="US" data-kt-select2-country="/metronic8/demo1/assets/media/flags/united-states.svg">United States</option>
                                                            <option value="UY" data-kt-select2-country="/metronic8/demo1/assets/media/flags/uruguay.svg">Uruguay</option>
                                                            <option value="UZ" data-kt-select2-country="/metronic8/demo1/assets/media/flags/uzbekistan.svg">Uzbekistan</option>
                                                            <option value="VU" data-kt-select2-country="/metronic8/demo1/assets/media/flags/vanuatu.svg">Vanuatu</option>
                                                            <option value="VE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/venezuela.svg">Venezuela, Bolivarian Republic of</option>
                                                            <option value="VN" data-kt-select2-country="/metronic8/demo1/assets/media/flags/vietnam.svg">Vietnam</option>
                                                            <option value="VI" data-kt-select2-country="/metronic8/demo1/assets/media/flags/virgin-islands.svg">Virgin Islands</option>
                                                            <option value="YE" data-kt-select2-country="/metronic8/demo1/assets/media/flags/yemen.svg">Yemen</option>
                                                            <option value="ZM" data-kt-select2-country="/metronic8/demo1/assets/media/flags/zambia.svg">Zambia</option>
                                                            <option value="ZW" data-kt-select2-country="/metronic8/demo1/assets/media/flags/zimbabwe.svg">Zimbabwe</option>
                                                    </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-124-rsfg" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kt_ecommerce_edit_order_shipping_country-container" aria-controls="select2-kt_ecommerce_edit_order_shipping_country-container"><span class="select2-selection__rendered" id="select2-kt_ecommerce_edit_order_shipping_country-container" role="textbox" aria-readonly="true" title="Select an option"><span class="select2-selection__placeholder">Select an option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <!--end::Select2-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Shipping address-->
                </div>
                <!--end::Billing address-->
        
        
            </div>
            <!--end::Card body-->
        </div>
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('purchasing.index')}}" id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5">{{__('common.cancel')}}</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
                <span class="indicator-label">{{__('common.submit')}}</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
        </div>
    </div>
    <!--end::Main column-->
</form>
@endsection

@section('pageJs')
    <script src="{{ url('assets/js/pages/purchasing.create.js') }}"></script>
    <script>
        $(document).ready(function() {
            var options = {
                suppliers : {!! json_encode($suppliers) !!},
                address : {!! json_encode($address) !!},
                taxes : {!! json_encode($taxes) !!}
            }
            var instance = new PurchasingCreateClass();
            instance.run(options);
        });
    </script>
@endsection