<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-650px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header">
            <!--begin::Modal title-->
            <h2 class="fw-bolder">{{__('role_permission.add_permission')}}</h2>
            <!--end::Modal title-->
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close"
                data-bs-dismiss="modal">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                            transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
            <!--begin::Form-->
            <form id="kt_modal_add_permission_form" class="form" action="javascript:void(0)">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">Permission Name</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover"
                            data-bs-html="true" data-bs-content="Permission names is required to be unique."></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-solid" placeholder="Enter a permission name"
                        name="permission_name" id="permission-name"/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-9">
                        <input class="form-check-input" type="checkbox" value="" name="permissions_core"
                            id="kt_permissions_core" />
                        <span class="form-check-label" for="kt_permissions_core">Set as core permission</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Input group-->
                <!--begin::Disclaimer-->
                <div class="text-gray-600">Permission set as a
                    <strong class="me-1">Core Permission</strong>will be locked and
                    <strong class="me-1">not editable</strong>in future
                </div>
                <!--end::Disclaimer-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel"
                        data-bs-dismiss="modal">{{ trans('common.discard') }}</button>
                    <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit" id="submit-btn">
                        <span class="indicator-label">{{__('common.submit')}}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
