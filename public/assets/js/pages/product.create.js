var ProductCreateClass = function() {
    var ele = {}
    
    this.run = () => {
        this.init()
        this.bindEvents()
    }

    this.init = () => {
        ele.summary = $('#summary')
        ele.description = $('#description')
        ele.addVar = $('#add_variation')
        ele.addVarField = $('.add-variation-field')
        ele.listAddVar = $('#list-add-variation')
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
        ele.addTagForm = $('#kt_modal_add_tag_form')
        ele.tagNameCreate = $('#tag-name')
        ele.addTagBtn = $('#submit-tag-btn')
    }

    this.bindEvents = () => {
        drawContent()
        duplicateVar()
        removeVar()
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

    var duplicateVar = () => {
        ele.addVar.on('click', function () {
            var $clone = ele.addVarField.clone()
            $clone.find('.select2-container').each((i, el) => {
                $(el).remove();
            });
            $clone.hide().appendTo(ele.listAddVar).promise().done(function() {
                $(this).slideDown()
            })
            $('.form-select-var').select2()
        })
    }

    var removeVar = () => {
        $(document).on('click', '.btn-remove-var', function () {
            $(this).closest('.add-variation-field').slideUp( 'easeOutCubic', function() {
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
                'product_name' : ele.name.val(),
                'summary' : ele.summary.val(),
                'description' : ele.description.val(),
                'product_code' : ele.sku.val(),
                'quantity' : ele.quantity.val(),
                'variation' : [],
                'var_value' : []
            }
            let target = ele.btnCreate
            $('select[name="product_option[]"]').each((i, el) => {
                params.variation.push($(el).val())
            })
            $('input[name="product_option_value[]"]').each((i, el) => {
                params.var_value.push($(el).val())
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
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.ajax($.app.vars.url + '/products/create-tag', 'POST', params, target, null, _cb)
        })
    }
}