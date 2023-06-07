var ProductCreateClass = function() {
    var ele = {}
    
    this.run = () => {
        this.init()
        this.bindEvents()
    }

    this.init = () => {
        ele.summary = $('#summary')
        ele.description = $('#description')
        ele.addTax = $('#add_tax')
        ele.addTaxField = $('.add-tax-field')
        ele.listAddTax = $('#list-add-tax')
        ele.btnCreate = $('#kt_ecommerce_add_product_submit')
        ele.status = $('#kt_ecommerce_add_product_status_select')
        ele.thumb = $('input[name="avatar"]')
        ele.category = $('#product-category')
        ele.name = $('input[name="product_name"]')
        ele.summary = $('input[name="summary"]')
        ele.description = $('#description')
        ele.sku = $('input[name="sku"]')
        ele.quantity = $('input[name="warehouse"]')
        ele.variation = $('select[name="product_option[]"]')
        ele.var_value = $('input[name="product_option_value[]"]')
        ele.formSubmit = $('#kt_ecommerce_add_product_form')
        ele.productId = $('#product-id')
        ele.tagField = $('#kt_ecommerce_add_product_tags')
        ele.modalAddTag = $('#kt_modal_add_tag')
        ele.addTagForm = $('#kt_modal_add_tag_form')
        ele.tagNameCreate = $('#tag-name')
        ele.addTagBtn = $('#submit-tag-btn')
        ele.brandField = $('#kt_ecommerce_add_product_brand_select')
        ele.unitField = $('#kt_ecommerce_add_product_unit_select')
    }

    this.bindEvents = () => {
        drawContent()
        duplicateTax()
        removeTax()
        createProduct()
        createTag()
    }

    var drawContent = () => {
        ele.description.tinymce({
            height : 350,
            menubar : false,
            plugins : ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'],
            toolbar : "undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
            content_style : "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
        });
    }

    var duplicateTax = () => {
        ele.addTax.on('click', function () {
            var $clone = ele.addTaxField.clone()
            $clone.find('.select2-container').each((i, el) => {
                $(el).remove();
            });
            var btnRemove = `<button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger btn-remove-tax">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                        </svg>
                    </span>
                </button>`
            $clone.append(btnRemove)
            $clone.hide().appendTo(ele.listAddTax).promise().done(function() {
                $(this).slideDown()
            })
            $('.form-select-tax').select2()
        })
    }

    var removeTax = () => {
        $(document).on('click', '.btn-remove-tax', function () {
            $(this).closest('.add-tax-field').slideUp( 'easeOutCubic', function() {
                $(this).remove()
            })
        })
    }

    var createProduct = () => {
        ele.formSubmit.on('submit', function() {
            var type = $(ele.btnCreate, $(this)).data('type')
            var params = {
                'thumb' : ele.thumb.val(),
                'active' : ele.status.val(),
                'category_id' : ele.category.val(),
                'tags' : ele.tagField.val(),
                'brand_id' : ele.brandField.val(),
                'unit_id' : ele.unitField.val(),
                'product_name' : ele.name.val(),
                'summary' : ele.summary.val(),
                'description' : ele.description.val(),
                'product_code' : ele.sku.val(),
                'quantity' : ele.quantity.val(),
                'tax' : [],
                'tax_value' : []
            }
            let target = ele.btnCreate
            $('select[name="product_option[]"]').each((i, el) => {
                params.tax.push($(el).val())
            })
            $('input[name="product_option_value[]"]').each((i, el) => {
                params.tax_value.push($(el).val())
            })
            let _cb = (rs) => {
                if (rs.status) {
                    $.app.pushNotyCallback({
                        'type' : 'success',
                        'callback' : function () {
                            window.location.href = $.app.vars.url + '/products/'
                        }
                    })
                } else {
                    $.app.pushNoty('error')
                }
            }

            if(type === 'create') {
                $.app.ajax($.app.vars.url + '/products/store', 'POST', params, target, null, _cb);
            } else {
                params.id = ele.productId.val()
                $.app.ajax($.app.vars.url + '/products/update', 'POST', params, target, null, _cb);
            }
        })
    }

    var createTag = () => {
        ele.addTagForm.on('submit', function () {
            var params = {
                name : ele.tagNameCreate.val(),
            }
            var target = ele.addTagBtn
            var _cb = function (rs) {
                if (rs.status) {
                    ele.modalAddTag.modal('hide')
                    $.app.pushNotyCallback({
                        'type' : 'success',
                        'callback' : function () {
                            location.reload()
                        }
                    })
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.ajax($.app.vars.url + '/products/create-tag', 'POST', params, target, null, _cb)
        })
    }
}