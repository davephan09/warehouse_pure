<!--begin::Modal - Customers - Add-->
<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_add_customer_form"
                data-kt-redirect="../../demo1/dist/apps/customers/list.html">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_customer_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{__('supply.add_supplier')}}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"> 
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{__('supply.supplier_name')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{__('supply.type_supplier_name')}}" name="name"
                                value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="">{{__('common.phone')}}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="tel" class="form-control form-control-solid" placeholder="{{__('supply.type_supplier_phone')}}" name="phone"
                                value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="">{{__('common.email')}}</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                    title="Email address must be active"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" class="form-control form-control-solid" placeholder="{{__('supply.type_supplier_email')}}" name="email"
                                value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Billing toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false"
                            aria-controls="kt_customer_view_details">{{__('common.address')}}
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Billing toggle-->
                        <!--begin::Billing form-->
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class=" fs-6 fw-bold mb-2">{{__('common.province')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="province" aria-label="{{__('common.select_province')}}" 
                                data-control="select2"
                                data-placeholder="{{__('common.select_province')}} ..."
                                data-dropdown-parent="#kt_modal_add_customer" 
                                id="province-select"
                                class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    @forelse ($address as $province)
                                    <option value="{{$province->code}}">{{$province->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class=" fs-6 fw-bold mb-2">{{__('common.district')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="district" aria-label="{{__('common.select_district')}}" 
                                data-control="select2"
                                data-placeholder="{{__('common.select_district')}} ..."
                                data-dropdown-parent="#kt_modal_add_customer" 
                                id="district-select"
                                class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>

                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class=" fs-6 fw-bold mb-2">{{__('common.ward')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="ward" aria-label="{{__('common.select_ward')}}" 
                                data-control="select2"
                                data-placeholder="{{__('common.select_ward')}} ..."
                                data-dropdown-parent="#kt_modal_add_customer" 
                                id="ward-select"
                                class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{__('common.address_detail')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="{{__('common.type_address_detail')}}" name="address_detail"
                                    value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Billing form-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_add_customer_payment_info" role="button" aria-expanded="false"
                            aria-controls="kt_customer_view_details">{{__('common.payment_information')}}
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div id="kt_modal_add_customer_payment_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class=" fs-6 fw-bold mb-2">{{__('common.bank')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="province" aria-label="{{__('common.select_bank')}}" 
                                data-control="select2"
                                data-placeholder="{{__('common.select_bank')}} ..."
                                data-dropdown-parent="#kt_modal_add_customer" 
                                id="bank-select"
                                class="form-select form-select-solid fw-bolder">
                                    <option value=""></option>
                                    @forelse ($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->shortName . ' - ' . $bank->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class=" fs-6 fw-bold mb-2">{{__('common.account_number')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="{{__('common.type_account_number')}}" name="account_number"
                                    value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">{{__('supply.description')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder=""
                                name="description" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="me-5">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold">{{__('common.is_active')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="fs-7 fw-bold text-muted">{{__('common.is_active_description')}}</div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="active" type="checkbox"
                                        value="1" id="kt_modal_add_customer_billing" checked="checked" />
                                    <!--end::Input-->
                                </label>
                                <!--end::Switch-->
                            </div>
                            <!--begin::Wrapper-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_customer_cancel" data-bs-dismiss="modal"
                        class="btn btn-light me-3">{{__('common.discard')}}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="kt_modal_add_customer_submit" class="btn btn-primary">
                        <span class="indicator-label">{{__('common.submit')}}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Customers - Add-->
