<div class="modal fade" id="kt_modal_update_variation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form id="kt_modal_update_variation_form" class="form" action="javascript:void(0)">
                <div class="modal-header">
                    <h2 class="fw-bolder">{{ __('variation.update_new_variation') }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close"
                        data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-lg-5 my-7">
                    <div class="fv-row mb-10">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">{{ __('variation.variation_name') }}</span>
                        </label>
                        <input class="form-control form-control-solid"
                            placeholder="{{ __('variation.add_new_variation_des') }}" name="variation_name"
                            id="variation-name-update" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">{{ __('variation.description') }}</span>
                        </label>
                        <input class="form-control form-control-solid"
                            placeholder="{{ __('variation.description_des') }}" name="variation_description"
                            id="variation-description-update" />
                    </div>
                    <div class="fv-row mb-12">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">{{ __('variation.options') }}</span>
                        </label>
                        <select class="form-select form-select-solid" name="options" id="var-options-update" data-control="select2" data-allow-clear="true" multiple
                            data-hide-search="true" data-tags="true" data-placeholder="{{__('variation.add_options')}}" tabindex="-1" aria-hidden="true" >
                        </select>
                    </div>
                    <div class="fv-row mb-4">
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
                                    value="1" id="kt_modal_update_customer_billing" checked />
                                <!--end::Input-->
                            </label>
                            <!--end::Switch-->
                        </div>
                    </div>
                    <input type="number" name="" id="variation-id" val="" hidden>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel"
                        data-bs-dismiss="modal">{{ trans('common.discard') }}</button>
                    <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit"
                        id="submit-variation-btn">
                        <span class="indicator-label">{{ trans('common.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
