var ProductCreateClass = function() {
    var ele = {}
    var variations = {}
    var varSelected = []
    var allOptions = {}
    var product = {}
    
    this.run = (opt) => {
        variations = opt.variations
        allOptions = opt.options
        product = opt.product

        this.init()
        this.bindEvents()
    }

    this.init = () => {
        ele.summary = $('#summary')
        ele.description = $('#description')
        ele.addTax = $('#add_tax')
        ele.addTaxField = $('.add-tax-field:first')
        ele.listAddTax = $('#list-add-tax')
        ele.btnCreate = $('#kt_ecommerce_add_product_submit')
        ele.status = $('#kt_ecommerce_add_product_status_select')
        ele.thumb = $('input[name="avatar"]')
        ele.category = $('#product-category')
        ele.name = $('input[name="product_name"]')
        ele.summary = $('input[name="summary"]')
        ele.description = $('#description')
        ele.sku = $('#sku-product')
        ele.price = $('#price-product')
        ele.quantity = $('#quantity-product')
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
        ele.isVariation = $('#is-variation')
        ele.noVariation = $('#no-variation')
        ele.hasVariation = $('#has-variation')
        ele.btnAddvarField = $('#add_variation')
        ele.addVarField = $('.add-variation-field:first')
        ele.listAddVar = $('#list-add-variation')
        ele.detailVarDiv = $('#detail-variations')
        ele.bodyDetailVarDiv = $('#body-detail-variations')
    }

    this.bindEvents = () => {
        drawContent()
        duplicateTax()
        removeTax()
        createProduct()
        createTag()
        handleVariation()
        handleVariationSelect()
        handleAddVarField()
        handleRemoveVar()
        handleSelectOptions()
        syncDetailProduct()
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
                'tax' : [],
                'tax_value' : [],
                'variations' : [],
            }
            let target = ele.btnCreate
            $('select[name="product_option[]"]').each((i, el) => {
                params.tax.push($(el).val())
            })
            $('input[name="product_option_value[]"]').each((i, el) => {
                params.tax_value.push($(el).val())
            })
            if(ele.noVariation.hasClass('d-none')) {
                $.each($('.variation-item'), function(i, item) {
                    params.variations.push({
                        'variationName' : $('.variation-name', $(this)).val(),
                        'options' : $('.var-options', $(this)).val(),
                        'price' : $('.var-price', $(this)).val(),
                        'quantity' : $('.var-quantity', $(this)).val(),
                        'code' : $('.var-code', $(this)).val(),
                    })
                })
            } else {
                params.variations.push({
                    'variationName' : ele.name.val(),
                    'price' : ele.price.val(),
                    'quantity' : ele.quantity.val(),
                    'code' : ele.sku.val(),
                })
            }
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

    var handleVariation = function () {
        ele.isVariation.on('change', function() {
            ele.noVariation.toggleClass('d-none')
            ele.hasVariation.toggleClass('d-none')
        })
    }

    var handleVariationSelect = function () {
        $(document).on('change', '.form-select-variation', function(e) {
            let $id = $(this).val()
            let varOptions = variations[$id] ? variations[$id].options : false
            let optionSelect = $('.form-select-option', $(this).closest('.add-variation-field'))
            let html = '<option></option>'
            varSelected.push($id)
            if (varOptions) {
                $.each(varOptions, function(i, option) {
                    html += `<option value="${option.id}">${option.name}</option>`
                })
            }
            optionSelect.html(html)
            optionSelect.trigger('change')
            optionSelect.select2({
                minimumResultsForSearch : -1,
                tags : true,
                placeholder : Lang.get('product.select_var_options'),
                allowClear : true, 
            })
        })
    }

    var handleAddVarField = function () {
        ele.btnAddvarField.on('click', function() {
            var $clone = ele.addVarField.clone()
            $clone.find('.select2-container').each((i, el) => {
                $(el).remove();
            });
            var htmlVars = `<option>${Lang.get('product.select_variation')}</option>`
            $.each(variations, function(i, item) {
                if ($.inArray(i, varSelected) == -1) {
                    htmlVars += `<option value="${item.id}">${item.name}</option>`
                }
            })
            $('.form-select-variation', $clone).html(htmlVars)
            $('.form-select-option', $clone).html('')
            var btnRemove = `<button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger btn-remove-variation">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                        </svg>
                    </span>
                </button>`
            $clone.append(btnRemove)
            $clone.hide().appendTo(ele.listAddVar).promise().done(function() {
                $(this).slideDown()
            })
            $('.form-select-variation').select2({
                minimumResultsForSearch : -1,
                placeholder : Lang.get('product.select_variation'),
                // allowClear : true,
            })
            $('.form-select-option').select2()
        })
    }

    var handleRemoveVar = function () {
        $(document).on('click', '.btn-remove-variation', function () {
            let $thisField = $(this).closest('.add-variation-field')
            let varId = $('.form-select-variation', $thisField).val()
            varSelected = $.grep(varSelected, function(value) {
                return value !== varId;
            });
            $thisField.slideUp( 'easeOutCubic', function() {
                $(this).remove()
            })
        })
    }

    var handleSelectOptions = function () {
        $(document).on('change', '.form-select-option', function() {
            var optionArr = []
            var html = ''
            $.each($('select.form-select-option'), function(i, item) {
                if ($(this).val().length !== 0) {
                    optionArr.push($(this).val())
                }
            })
            var mixValues = getMixedValues(optionArr)
            $.each(mixValues, function(i, item) {
                html += `<tr class="variation-item">
                    <td><input type="text" class="form-control variation-name mw-100" name="" disabled value="${getOptionsName(item)}" /></td>
                    <td hidden><input type="text" class="form-control var-options" disabled value='${item}' /></td>
                    <td><input type="number" class="form-control var-price mw-100" name="" value="" /></td>
                    <td><input type="number" class="form-control var-quantity mw-100" name="" value="" /></td>
                    <td><input type="text" class="form-control var-code mw-100" name="" value="${getOptionsName(item)}" /></td>
                </tr>`
            })
            ele.bodyDetailVarDiv.html(html)
            if (mixValues.length === 0) {
                ele.detailVarDiv.addClass('d-none')
            } else {
                ele.detailVarDiv.removeClass('d-none')
            }
        })
    }

    var getOptionsName = function (str) {
        var words = JSON.parse(str).map(function(digit) {
            return allOptions[digit].name
        })
        return words.join(' - ')
    }

    var getMixedValues = function (arrs) {
        if (arrs.length === 0) {
            return []
        }
        if (arrs.length === 1) {
            arrs[0] = arrs[0].map(function(val) {
                return JSON.stringify([val])
            })
            return arrs[0];
        }
        var combinations = []
        var currentCombination = new Array(arrs.length)
        generateCombinations(arrs, 0, currentCombination, combinations)
        return combinations
    }

    var generateCombinations = function(arrs, currentIndex, currentCombination, combinations) {
        if (currentIndex === arrs.length) {
            combinations.push(JSON.stringify(currentCombination))
            return
        }
        
        for (var i=0; i < arrs[currentIndex].length; i++) {
            currentCombination[currentIndex] = arrs[currentIndex][i]
            generateCombinations(arrs, currentIndex + 1, currentCombination, combinations);
        }
    }

    var syncDetailProduct = function () {
        if(product) {
            if(product.variations.length > 1) {
                ele.isVariation.prop('checked', true)
                ele.noVariation.toggleClass('d-none')
                ele.hasVariation.toggleClass('d-none')

                ele.detailVarDiv.removeClass('d-none')
            }
        }
    }
}