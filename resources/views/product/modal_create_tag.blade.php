<div class="modal fade" id="kt_modal_add_tag" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{__('product.add_new_tag')}}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close"
                    data-bs-dismiss="modal">
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
            <div class="modal-body scroll-y mx-lg-5 my-7">
                <form id="kt_modal_add_tag_form" class="form" action="javascript:void(0)">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">{{__('product.tag_name')}}</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-sm form-control-solid" placeholder="{{__('product.add_new_tag_des')}}"
                            name="tag_name" id="tag-name"/>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-sm btn-light me-3" data-kt-roles-modal-action="cancel"
                            data-bs-dismiss="modal">{{ trans('common.discard') }}</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-roles-modal-action="submit" id="submit-tag-btn">
                            <span class="indicator-label">{{trans('common.submit')}}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>
    </div>
</div>