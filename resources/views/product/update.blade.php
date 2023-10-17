@extends('layouts.master')
@section('breadcrumb')
{{ Breadcrumbs::render('product_update', $product) }}
@endsection

@section('content')
<!--begin::Form-->
<form id="kt_ecommerce_add_product_form" action="javascript:void(0)" class="form d-flex flex-column flex-lg-row">
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
                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{ config('custom.get_image_api') . $product->thumb }})"></div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{__('common.change_avatar')}}">
                        <i class="bi bi-pencil-fill fs-7"></i>
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
                <div class="text-muted fs-7">{{__('product.thumb_rule')}}</div>
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
                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                </div>
                <!--begin::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select form-select-sm mb-2" name="active" data-control="select2" data-hide-search="true" data-placeholder="{{__('common.select_an_option')}}" id="kt_ecommerce_add_product_status_select">
                    <option></option>
                    <option value="1" {{$product->active == 1 ? 'selected' : ''}}>{{__('common.active')}}</option>
                    <option value="0" {{$product->active == 0 ? 'selected' : ''}}>{{__('common.inactive')}}</option>
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7">{{__('product.status_des')}}</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Status-->
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{__('product.detail')}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <!--begin::Label-->
                <label class="form-label">{{__('common.category')}}</label>
                <!--end::Label-->
                <!--begin::Select2-->
                <select class="form-select form-select-sm mb-2" data-control="select2" name="category_id" id="product-category" data-placeholder="{{__('common.select_an_option')}}" data-allow-clear="true">
                    <option></option>
                    @php
                        $categoryId = !empty($product->category) ? $product->category->id : '';
                    @endphp
                    {!! \App\Helpers\Helper::renderMultilevelOption($categories, 0, '', $categoryId) !!}
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7 mb-5">{{__('product.category_des')}}</div>
                <!--end::Description-->
                <!--end::Input group-->
                <!--begin::Button-->
                <a href="{{route('category.product.create')}}" class="btn btn-light-primary btn-sm mb-10">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->{{__('product.create_category')}}</a>
                <!--end::Button-->
                <!--begin::Input group-->
                <label class="form-label d-block">{{__('common.tags')}}</label>
                <select id="kt_ecommerce_add_product_tags" name="tags[]" data-placeholder="{{__('common.select_an_option')}}" class="form-select form-select-sm mb-2" data-control="select2" data-allow-clear="true" multiple="multiple">
                    @foreach($tags as $key => $tag)
                        <option value="{{$tag->id}}" {{in_array($tag->id, $productTags) ? 'selected' : ''}}>{{$tag->name}}</option>
                    @endforeach
                </select>
                <div class="text-muted fs-7 mb-5">{{__('product.tag_des')}}</div>
                <!--begin::Button-->
                <button type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_add_tag" class="btn btn-light-primary btn-sm mb-3">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->{{__('product.create_tag')}}</button>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('product.brand')}}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <select class="form-select form-select-sm mb-2" name="brand_id" data-control="select2" data-hide-search="true" data-allow-clear="true" data-placeholder="{{__('common.select_an_option')}}" id="kt_ecommerce_add_product_brand_select">
                    <option></option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}" {{$brand->id === $product->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                    @endforeach
                </select>
                <div class="text-muted fs-7">{{__('product.brand_des')}}</div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{__('product.unit')}}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <select class="form-select form-select-sm mb-2" name="unit_id" data-control="select2" data-hide-search="true" data-allow-clear="true" data-placeholder="{{__('common.select_an_option')}}" id="kt_ecommerce_add_product_unit_select">
                    <option></option>
                    @foreach ($units as $unit)
                    <option value="{{$unit->id}}" {{$unit->id === $product->unit_id ? 'selected' : ''}}>{{$unit->name}}</option>
                    @endforeach
                </select>
                <div class="text-muted fs-7">{{__('product.unit_des')}}</div>
            </div>
        </div>
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">{{__('common.general')}}</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">{{__('common.advanced')}}</a>
            </li>
            <!--end:::Tab item-->
        </ul>
        <!--end:::Tabs-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
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
                                <label class="required form-label">{{__('product.name')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="product_name" class="form-control form-control-sm mb-2" placeholder="{{__('product.name')}}" value="{{$product->product_name}}" />
                                <!--end::Input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">{{__('product.name_des')}}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label">{{__('common.summary')}}</label>
                                <!--end::Label-->
                                <!--begin::Editor-->
                                <input type="text" name="summary" class="form-control form-control-sm mb-2" placeholder="{{__('common.summary')}}" value="{{$product->summary}}" />
                                <!--end::Editor-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">{{__('product.summary_des')}}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div>
                                <!--begin::Label-->
                                <label class="form-label">{{__('common.description')}}</label>
                                <!--end::Label-->
                                <!--begin::Editor-->
                                <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2">
                                    <textarea name="description" id="description">{!! $product->description !!}</textarea>
                                </div>
                                <!--end::Editor-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">{{__('product.description_des')}}</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <!--begin::Media-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__('common.media')}}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="fv-row mb-2">
                                <!--begin::Dropzone-->
                                <div class="dropzone  {{ $product->medias->isNotEmpty() ? 'dz-started' : '' }}" id="kt_ecommerce_add_product_media">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{__('common.upload_title')}}</h3>
                                            <span class="fs-7 fw-bold text-gray-400">{{__('common.upload_des')}}</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    @forelse ($product->medias as $media)
                                    @php
                                        $urlArr = explode('/', $media->url);
                                        $fileName = end($urlArr);
                                    @endphp
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete custom-dropzone-img">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail="" alt="{{ $media->alt }}" src="{{ $media->url }}" width="120" height="120">
                                        </div> 
                                        <div class="dz-details"> 
                                            <div class="dz-size">
                                                {{-- <span data-dz-size=""><strong>0.1</strong> MB</span> --}}
                                            </div> 
                                            <div class="dz-filename">
                                                <span data-dz-name="">{{ $fileName }}</span>
                                            </div> 
                                        </div> 
                                        <a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove file</a>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                                <!--end::Dropzone-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">{{__('product.media_des')}}</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Media-->
                </div>
            </div>
            <!--end::Tab pane-->
            <!--begin::Tab pane-->
            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__('common.inventory')}}</h2>
                            </div>
                            <div class="">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input me-2" name="is_variation" type="checkbox"
                                        value="1" id="is-variation"/>
                                        {{__('product.has_variation')}}
                                </label>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div id="no-variation">
                                @php
                                    $hasOptions = $product->variations->count() > 1 ? true : false;
                                @endphp
                                <div class="mb-10 fv-row">
                                    <label class="form-label required" for="price-product">{{__('product.price')}}</label>
                                    <input type="text" id="price-product" data-plugin="inputmask-numeric" class="form-control form-control-sm mb-2" placeholder="{{__('product.price_example')}}" value="{{$hasOptions ? '' : $product->variations[0]->price}}">
                                    <div class="text-muted fs-7">{{__('product.price_des')}}</div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="form-label required" for="quantity-product">{{__('product.quantity')}}</label>
                                    <input type="text" id="quantity-product" data-plugin="inputmask-numeric" class="form-control form-control-sm mb-2" placeholder="{{__('product.quantity_example')}}" value="{{$hasOptions ? '' : $product->variations[0]->quantity}}">
                                    <div class="text-muted fs-7">{{__('product.quantity_des')}}</div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="form-label" for="sku-product">{{__('product.code')}}</label>
                                    <input type="text" id="sku-product" class="form-control form-control-sm mb-2" placeholder="{{__('product.code_example')}}" value="{{$hasOptions ? '' : $product->variations[0]->sku}}">
                                    <div class="text-muted fs-7">{{__('product.code_des')}}</div>
                                </div>
                            </div>
                            <div id="has-variation" class="d-none">
                                <div class="mb-10 fv-row">
                                    <div class="form-group">
                                        <div data-repeater-list="kt_ecommerce_add_product_options" id="list-add-variation" class="d-flex flex-column gap-3">
                                            @forelse ($variationsProduct as $key => $var)
                                                <div data-repeater-item="" class="form-group add-variation-field d-flex flex-wrap gap-5">
                                                    <div class="w-100 w-md-400px">
                                                        <select class="form-select form-select-sm form-select-variation" name="list_variations[]" data-control="select2" data-placeholder="{{__('product.select_variation')}}" data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option>{{__('product.select_variation')}}</option>
                                                            @foreach ($variations as $variation)
                                                                <option value="{{$variation->id}}" {{$var == $variation->id ? 'selected' : ''}}>{{$variation->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-400px">
                                                        <select class="form-select form-select-sm form-select-option" name="var_options[]" data-control="select2" multiple data-placeholder="{{__('product.select_var_options')}}">
                                                        @foreach($variations[$var]->options as $opt)
                                                            <option value="{{$opt->id}}" {{in_array($opt->id, $options) ? 'selected' : ''}}>{{$opt->name}}</option>    
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($key != 0)
                                                        <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger btn-remove-variation">
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                                    <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    @endif
                                                </div>
                                            @empty
                                                <div data-repeater-item="" class="form-group add-variation-field d-flex flex-wrap gap-5">
                                                    <div class="w-100 w-md-400px">
                                                        <select class="form-select form-select-sm form-select-variation" name="list_variations[]" data-control="select2" data-placeholder="{{__('product.select_variation')}}" data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option>{{__('product.select_variation')}}</option>
                                                            @foreach ($variations as $variation)
                                                                <option value="{{$variation->id}}">{{$variation->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-100 w-md-400px">
                                                        <select class="form-select form-select-sm form-select-option" name="var_options[]" data-control="select2" multiple data-placeholder="{{__('product.select_var_options')}}">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="button" data-repeater-create="" id="add_variation" class="btn btn-sm btn-light-primary">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        {{__('product.add_another_variation')}}</button>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row d-none" id="detail-variations">
                                    <div class="">
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead class="fw-bold">
                                                    <tr>
                                                        <th>{{__('common.variation')}}</th>
                                                        <th hidden></th>
                                                        <th>{{__('product.price')}}</th>
                                                        <th>{{__('product.quantity')}}</th>
                                                        <th>{{__('product.sku')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body-detail-variations">
                                                    @if ($product->variations->count() > 1)
                                                        @foreach($product->variations as $item)
                                                            <tr class="variation-item">
                                                                <td><input type="text" class="form-control form-control-sm variation-name mw-100" name="" disabled value="{{$item->name}}" /></td>
                                                                <td hidden><input type="text" class="form-control form-control-sm var-options" disabled value='{{$item->options}}' /></td>
                                                                <td><input type="input" data-plugin="inputmask-numeric" class="form-control form-control-sm var-price mw-100" name="" value="{{$item->price}}" /></td>
                                                                <td><input type="input" data-plugin="inputmask-numeric" class="form-control form-control-sm var-quantity mw-100" name="" value="{{$item->quantity}}" /></td>
                                                                <td><input type="text" class="form-control form-control-sm var-code mw-100" name="" value="{{$item->sku}}" /></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__('product.taxes')}}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                <!--begin::Label-->
                                <label class="form-label">{{__('product.add_tax')}}</label>
                                <!--end::Label-->
                                <!--begin::Repeater-->
                                <div id="kt_ecommerce_add_product_options">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_ecommerce_add_product_options" id="list-add-tax" class="d-flex flex-column gap-3">
                                            @forelse ($product->taxes as $item)
                                                <div data-repeater-item="" class="form-group add-tax-field d-flex flex-wrap gap-5">
                                                    <!--begin::Select2-->
                                                    <div class="w-100 w-md-325px">
                                                        <select class="form-select form-select-sm form-select-tax" name="product_option[]" data-control="select2" data-placeholder="{{__('product.select_tax')}}" data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option></option>
                                                            @foreach($taxes as $tax)
                                                            <option value="{{$tax->id}}" {{ isset($product->taxes) && $tax->id == $item->pivot->tax_id ? 'selected' : ''}}>{{$tax->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Select2-->
                                                    <!--begin::Input-->
                                                    <div class="input-group input-group-sm mw-100 w-325px">
                                                        <input type="text" class="form-control form-control-sm " name="product_option_value[]" multiple placeholder="{{__('product.tax_value')}}" value="{{$item->pivot->value}}"/> 
                                                        <span class="d-flex input-group-text align-items-center">% ({{__('common.percent')}})</span>
                                                    </div>
                                                    {{-- <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger btn-remove-tax">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </button> --}}
                                                </div>
                                            @empty
                                                <div data-repeater-item="" class="form-group add-tax-field d-flex flex-wrap gap-5">
                                                    <!--begin::Select2-->
                                                    <div class="w-100 w-md-325px">
                                                        <select class="form-select form-select-sm form-select-tax" name="product_option[]" data-control="select2" data-placeholder="{{__('product.select_tax')}}" data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option></option>
                                                            @foreach($taxes as $tax)
                                                            <option value="{{$tax->id}}" {{ isset($product->taxes) && $tax->id == $product->taxes}}>{{$tax->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Select2-->
                                                    <!--begin::Input-->
                                                    <div class="input-group input-group-sm  mw-100 w-325px">
                                                        <input type="text" class="form-control form-control-sm" name="product_option_value[]" multiple placeholder="{{__('product.tax_value')}}" /> 
                                                        <span class="d-flex input-group-text align-items-center">% ({{__('common.percent')}})</span>
                                                    </div>
                                                    {{-- <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger btn-remove-tax">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </button> --}}
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <button type="button" data-repeater-create="" id="add_tax" class="btn btn-sm btn-light-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{__('product.add_another_tax')}}</button>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                </div>
            </div>
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
        <input type="number" name="product_id" hidden id="product-id" value="{{$product->id}}">
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{route('product.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-sm btn-light me-5">{{__('common.cancel')}}</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="submit" data-type="update" id="kt_ecommerce_add_product_submit" class="btn btn-sm btn-primary">
                <span class="indicator-label">{{__('common.submit')}}</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
        </div>
    </div>
    <!--end::Main column-->
    @forelse ($product->medias as $media)
    <input type='hidden' name="current_images[]" value="{{ $media->url }}">
    @empty
    @endforelse
</form>
<!--end::Form-->

@include('product.modal_create_tag')

@endsection

@section('pageJs')
    <script src="https://cdn.tiny.cloud/1/3upvjsx9sauhrqg81rqh2m9quvaxwf3qrlq7vr21ssaso6ua/tinymce/6/tinymce.min.js"></script>\
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <script src="{{ url('assets/js/pages/product.create.js') }}"></script>
    <script>
        $(document).ready(function() {
            var options = {
                variations : {!! json_encode($variations) !!},
                options : {!! json_encode($allOptions) !!},
                product : {!! json_encode($product) !!}
            }
            var instance = new ProductCreateClass();
            instance.run(options);
        });
    </script>
@endsection