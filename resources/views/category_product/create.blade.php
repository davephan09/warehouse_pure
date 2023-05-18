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
<form id="kt_ecommerce_add_category_form" action="javascript:void(0)" class="form d-flex flex-column flex-lg-row" >
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Thumbnail settings-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('common.thumbnail')}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(assets/media/svg/files/blank-image.svg)">
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper w-150px h-150px"></div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('common.change_avatar')}}">
                        <!--begin::Icon-->
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--end::Icon-->
                        <!--begin::Inputs-->
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->
                    <!--begin::Cancel-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{__('common.cancel_avatar')}}">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Cancel-->
                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{__('common.remove_avatar')}}">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <!--begin::Description-->
                <div class="text-muted fs-7">{{__('category.thumb_rule')}}</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Thumbnail settings-->
        <!--begin::Status-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('common.status')}}</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status"></div>
                </div>
                <!--begin::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="{{__('common.select_an_option')}}" id="kt_ecommerce_add_category_status_select">
                    <option></option>
                    <option value="1" selected="selected">{{__('common.active')}}</option>
                    <option value="0">{{__('common.inactive')}}</option>
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7">{{__('category.status_des')}}</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Status-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::General options-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('common.general')}}</h2>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <!--begin::Label-->
                    <label class="required form-label">{{__('category.name')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="category_name" class="form-control mb-2" placeholder="{{__('category.type_name')}}" value="" />
                    <!--end::Input-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{__('category.name_des')}}</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div>
                    <!--begin::Label-->
                    <label class="form-label">{{__('common.description')}}</label>
                    <!--end::Label-->
                    <!--begin::Editor-->
                    <div id="kt_ecommerce_add_category_description" name="kt_ecommerce_add_category_description" class="min-h-200px mb-2">
                        <textarea name="description" id="description"></textarea>
                        {{-- <tinymce-editor id="description"
                            api-key="no-api-key"
                            height="350"
                            menubar="false"
                            plugins="advlist autolink lists link image charmap preview anchor
                                searchreplace visualblocks code fullscreen
                                insertdatetime media table code help wordcount"
                            toolbar="undo redo | blocks | bold italic backcolor |
                                alignleft aligncenter alignright alignjustify |
                                bullist numlist outdent indent | removeformat | help"
                            content_style="body
                            {
                                font-family:Helvetica,Arial,sans-serif;
                                font-size:14px
                            }"
                            >
                        </tinymce-editor> --}}
                    </div>
                    <!--end::Editor-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{__('category.description_des')}}</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card header-->
        </div>
        <!--end::General options-->
        <!--begin::Automation-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('common.parent_category')}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select store template-->
                <label for="kt_ecommerce_add_category_store_template" class="form-label">{{__('common.choose_parent_category')}}</label>
                <!--end::Select store template-->
                <!--begin::Select2-->
                <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="{{__('common.select_an_option')}}" id="kt_ecommerce_add_category_store_template">
                    <option value="no_parent">{{__('category.no_parent')}}</option>
                    {!!\App\Helpers\Helper::renderMultilevelOption($productCategories)!!}
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7">{{__('common.choose_parent_category_des')}}</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Automation-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('category.product.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">{{__('common.cancel')}}</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="submit" data-type="create" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
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
    <script src="https://cdn.tiny.cloud/1/3upvjsx9sauhrqg81rqh2m9quvaxwf3qrlq7vr21ssaso6ua/tinymce/6/tinymce.min.js"></script>\
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <script src="{{ url('assets/js/pages/category.product.create.js') }}"></script>
    <script>
        $(document).ready(function() {
            var instance = new CategoryProductCreateClass();
            instance.run();
        });
    </script>
@endsection