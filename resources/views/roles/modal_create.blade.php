<!--begin::Modal - Add role-->
<div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{__('role_permission.add_role')}}</h2>
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
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form" action="javascript:void(0)">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                        data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Role name</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a role name"
                                name="role_name" id="role-name"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">
                                        <!--begin::Table row-->
                                        <tr>
                                            <td class="text-gray-800">Administrator Access
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                    title="Allows a full access to the system"></i>
                                            </td>
                                            <td>
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="kt_roles_select_all" />
                                                    <span class="form-check-label" for="kt_roles_select_all">Select
                                                        all</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </td>
                                        </tr>
                                        <!--end::Table row-->
                                        @foreach($listPermission as $key => $permission)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">{{ucfirst($key)}}</td>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    @foreach($permission as $action => $item)
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input check-item" type="checkbox" value=""
                                                            name="user_management_read" data-id="{{$item->id ?? ''}}"/>
                                                        <span class="form-check-label">{{ucfirst($action)}}</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    @endforeach
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Options-->
                                        </tr>
                                        <!--end::Table row-->
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel"
                            data-bs-dismiss="modal">{{ trans('common.discard') }}</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit" id="submit-btn">
                            <span class="indicator-label">{{trans('common.submit')}}</span>
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
</div>
<!--end::Modal - Add role-->
