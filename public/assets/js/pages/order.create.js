var OrderCreateClass = function () {
    var ele = {}
    var vars = {
        datatable: {}
    }
    var options = {}
    var taxIndex = 0
    var productIds = []

    this.run = function (opt) {
        options = opt
        if (options.productIdArr) {
            Object.keys(options.productIdArr).forEach(key => {
                productIds[key] = options.productIdArr[key]
            })
        }

        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.customerSelect = $('#kt_ecommerce_edit_order_payment')
        ele.dateInput = $('#kt_ecommerce_edit_order_date')
        ele.customerDetail = $('#customer-detail')
        ele.listItem = $('#list-item')
        ele.addItem = $('#add-item')
        ele.productInput = $('.product-input')
        ele.subTotal = $('#sub-total')
        ele.addDiscount = $('#add_discount')
        ele.discountField = $('#discount-field')
        ele.subTotalTextDiv = $('#sub-total-text-div')
        ele.subTotalDiv = $('#sub-total-div')
        ele.discountVal = $('#discount_value')
        ele.discountTypePercent = $('#dc-percent')
        ele.totalDiscount = $('#discount-price')
        ele.total = $('#total')
        ele.percentPaid = $('.percent-paid')
        ele.amountPaid = $('#amount-paid')
        ele.amountDebt = $('#amount-debt')
        ele.formCreate = $('#kt_ecommerce_edit_order_form')
        ele.noteField = $('#note-field')
        ele.btnSubmit = $('#kt_ecommerce_edit_order_submit')
        ele.orderId = $('#order-id')

        var format = 'DD/MM/YYYY';
        ele.dateInput.daterangepicker({
                showCustomRangeLabel: true,
                locale: {
                    format : "DD/MM/YYYY",
                },
                singleDatePicker: true,
                startDate: options.startDate,
            },
            function(start, end) {
            }
        );
    }

    this.bindEvents = function () {
        handleCalculate()
        handleSelectCustomer()
        handleSearchProduct(ele.productInput)
        handleAddItem()
        handleRemoveItem()
        // handleAddTax()
        // handleRemoveTax()
        handleAddDiscount()
        handleAmountPaid()
        handleCreate()
        calTotal()
        customerSelected(ele.customerSelect.val())
        handleSelectProduct()
    }

    var handleSelectCustomer = function () {
        ele.customerSelect.on('change', function (e) {
            if (e.target.value) {
                let $id = e.target.value
                customerSelected($id)
            } else {
                ele.customerDetail.addClass('d-none').fadeOut()
            }
        })
    }

    var customerSelected = function (id) {
        let $id = id
        let customer = options.customers[$id]
        if (!customer) return false
        let address = options.address
        let province = customer.province ? ', ' + address[customer.province].name : ''
        let district = customer.district ? ', ' + address[customer.province].districts[customer.district].name : ''
        let ward = customer.ward ? ', ' + address[customer.province].districts[customer.district].wards[customer.ward].name : ''
        let html = `<div class="h4 pb-2 mb-2">${customer.name}</div>
            <div>
                <p class="mb-3">${Lang.get('common.address')}: ${customer.detail_address}${ward}${district}${province}</p>
                <p class="mb-3">${Lang.get('common.phone')}: ${customer.phone}</p>
                <p class="mb-1">${Lang.get('common.email')}: ${customer.email}</p>
            </div>`
        ele.customerDetail.html(html)
        ele.customerDetail.removeClass('d-none').fadeIn(1000, 'easeOutCubic')        
    }

    var handleSearchProduct = function (select) {
        select.select2({
            placeholder : Lang.get('order.select_product'),
            minimumInputLength : 1,
            minimumResultsForSearch : 0,
            allowClear : true,
            ajax: {
                url: $.app.vars.url + '/products/search-product',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        keyword: term
                    }
                },
                processResults: function (data) {
                    if (data.status) {
                        return {
                            results: data.data.products
                        }
                    }
                },
                cache : true,
            },
            templateResult: function (data) {
                return data.text
            },
            templateSelection: function (data, $this) {
                productIds[data.id] = data.productId ?? productIds[data.id]
                syncProductData(productIds[data.id], data.id, $this)
                return data.textSelected ?? data.text
            }
        })
    }

    var handleSelectProduct = function () {
        $(document).on('change', '.product-input', function(e) {
            let thisProduct = $(this).closest('.body-item')
            if(!e.target.value) {
                $('.quantity-input', $(thisProduct)).val('1').trigger('input')
                $('.price-input', $(thisProduct)).val('0').trigger('input')
                $('.tax-field', $(thisProduct)).html('').slideDown()
                $('.tax-desc', $(thisProduct)).hide()
            }
        })
    }

    var syncProductData = function (productId, variationId, $this) {
        var params = {
            productId : productId,
            variationId : variationId,
        }
        var taxHtml = ''
        var _cb = function(rs) {
            if (rs.status) {
                let thisProduct = $($this).closest('.body-item')
                if(!rs.data.product) {
                    return false
                }
                let product = rs.data.product[variationId]
                let taxes = rs.data.taxes

                $.each(taxes, function(i, tax) {
                    taxHtml += `<div index="${taxIndex}" class="d-flex flex-row align-items-center tax-item mt-4 mb-2">
                            <div class="flex-fill pe-2" style="width: 30%;">
                                <input disabled class="form-control form-control-sm form-control-solid text-end" value="${tax.name}">
                                <input hidden class="tax-select" value="${tax.id}"/>
                            </div>
                            <div class="flex-fill pe-2 input-group input-group-sm input-group-solid" style="width: 28%;">
                                <input disabled type="text" data-plugin="inputmask-numeric" class="form-control form-control-sm form-control-solid text-end tax-value" value="${tax.pivot.value}"/>
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="flex-fill pe-7 text-end text-nowrap" style="width: 30%;">
                                <span class="tax-price">0</span> đ
                            </div>
                            <div class="flex-fill text-end" style="width: 12%;">
        
                            </div>
                        </div>`
                })

                if (taxes) $('.tax-desc', $(thisProduct)).show()
                $('.tax-field', $(thisProduct)).html(taxHtml).slideDown()

                $('.price-input', $(thisProduct)).val(formatNumber(product.price)).trigger('input')
            }
        }
        $.app.ajax($.app.vars.url + '/products/sync-product', 'GET', params, '', null, _cb);

    }

    var handleAddItem = function () {
        ele.addItem.on('click', function(e) {
            e.preventDefault()
            var html = `<tr class="product-item border-bottom border-bottom-dashed" data-kt-element="item">
                <td colspan="5">
                    <table class="w-100">
                        <colgroup>
                            <col class="w-40" style="width: 40%">
                            <col class="w-10" style="width: 12%">
                            <col class="w-20" style="width: 20%">
                            <col class="w-20" style="width: 20%">
                            <col class="w-10" style="width: 8%">
                        </colgroup>
                        <tbody class="body-item">
                            <tr>
                                <td class="pe-7 pb-8 product-field">
                                    <select class="form-select form-select-sm form-select-solid product-input">
                                        
                                    </select>
                                </td>
                                <td class="ps-0 pb-8">
                                    <input class="form-control form-control-sm form-control-solid auto-cal quantity-input" data-plugin="inputmask-numeric" type="text" name="quantity[]" placeholder="1" value="1" data-kt-element="quantity" />
                                    
                                </td>
                                <td class=" pb-8 input-group input-group-sm input-group-solid">
                                    <input type="text" class="form-control form-control-sm form-control-solid auto-cal text-end price-input" disabled data-plugin="inputmask-numeric" name="price[]" placeholder="0" value="" data-kt-element="price" />
                                    <span class="input-group-text">đ</span>
                                </td>
                                <td class="text-end pb-8 text-nowrap">
                                    <span data-kt-element="total" class="item-total ">0</span> đ
                                </td>
                                <td class="pb-8 text-end">
                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary btn-remove-item" data-kt-element="remove-item">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-0 text-end fw-bold tax-desc" style="display: none"><span class="pe-8">${ Lang.get('tax.taxes') }</span></td>
                                <td colspan="4" class="ps-0 py-0 tax-field">
                                
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>`
            
            $(html).hide().appendTo(ele.listItem).fadeIn('slow', function() {
                handleSearchProduct($('.product-input', $(this)))
                $('input[data-plugin="inputmask-numeric"]', $(this)).addMaskNumeric()
            })
        })
    }

    var handleCalculate = function () {
        $(document).on('input', '.auto-cal', function(e) {
            if (!$(e.target).hasClass('discount-cal')) {
                var $thisProduct = $(e.target).closest('.product-item')
                let qtyInput = $('.quantity-input', $thisProduct)
                let priceInput = $('.price-input', $thisProduct)
                let qty = cleanNumber(qtyInput.val())
                let price = cleanNumber(priceInput.val())
                let total = qty*price
                $('.item-total', $thisProduct).html(formatNumber(total))

                if($('.tax-item', $thisProduct)) {
                    $.each($('.tax-item', $thisProduct), function(i, item) {
                        let taxInput = $('.tax-value', $(item)).val()
                        let tax = cleanNumber(taxInput)
                        let taxPrice = (tax/100)*total
                        $('.tax-price', $(item)).html(formatNumber(taxPrice))
                    })
                }
            }

            calTotal()
        })
    }

    var calTotal = function () {
        let sum = 0
        $.each($('.product-item'), function(i, item) {
            let price = $('.item-total', $(item)).html()
            let value = cleanNumber(price)
            if($('.tax-item', $(item))) {
                $.each($('.tax-item', $(item)), function(i, taxItem) {
                    let tax = $('.tax-price', $(taxItem)).html()
                    let taxVal = cleanNumber(tax)
                    value += taxVal
                })
            }
            sum += value
        })
        ele.subTotal.html(formatNumber(sum))

        if(ele.discountField.hasClass('d-none')) {
            ele.total.html(formatNumber(sum))
            calcPayment(sum)
            return 0
        }
        
        let discountVal = cleanNumber(ele.discountVal.val())
        let discountTotal = ele.discountTypePercent.prop('checked') ? (discountVal/100) * sum : discountVal * 1
        ele.totalDiscount.html(formatNumber(discountTotal))
        let total = sum - discountTotal
        ele.total.html(formatNumber(total))

        calcPayment(total)
    }

    var calcPayment = function (total) {
        let moneyPaid = cleanNumber(ele.amountPaid.val())
        let moneyDebt = total - moneyPaid
        ele.amountDebt.val(formatNumber(moneyDebt))
    }

    var handleRemoveItem = function () {
        $(document).on('click', '.btn-remove-item', function() {
            $(this).closest('.product-item').fadeOut('easeOutSine', function() {
                $(this).remove()
                calTotal()
            })
        })
    }

    var handleAddTax = function () {
        $(document).on('click', '.add-tax-btn', function (e) {
            e.preventDefault()
            let html = ``
            let taxOption = ``
            taxIndex++
            $.each(options.taxes, function (i, item) {
                taxOption += `<option value="${item.id}">${item.name}</option>`
            })
            html += `
                <div index="${taxIndex}" class="d-flex flex-row align-items-center tax-item mt-4 mb-2">
                    <div class="flex-fill pe-2" style="width: 30%;">
                        <select class="form-select form-select-sm form-select-solid tax-select" data-plugin="select2" data-control="select2" tabindex="-1" 
                            aria-hidden="true" data-placeholder="${Lang.get('tax.choose_tax')}" >
                            ${ taxOption }
                        </select>
                    </div>
                    <div class="flex-fill pe-2 input-group input-group-sm input-group-solid" style="width: 28%;">
                        <input type="text" data-plugin="inputmask-numeric" class="form-control form-control-sm form-control-solid text-end tax-value auto-cal" placeholder="0"/>
                        <span class="input-group-text">%</span>
                    </div>
                    <div class="flex-fill pe-7 text-end text-nowrap" style="width: 30%;">
                        <span class="tax-price">0</span> đ
                    </div>
                    <div class="flex-fill text-end" style="width: 12%;">
                        <button type="button" class="btn btn-sm btn-icon btn-active-color-primary btn-remove-tax">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                    </div>
                </div>
            `
            let thisProduct = $(this).closest('.tax-field')
            $(thisProduct).append(html).slideDown(500)
            $('.tax-select', $('div[index='+taxIndex+']')).select2({
                placeholder : Lang.get('tax.choose_tax'),
                allowClear : true,
                minimumResultsForSearch : -1,
            })
            $('.tax-value', $('div[index='+taxIndex+']')).addMaskNumeric()
        })
    }

    var handleRemoveTax = function () {
        $(document).on('click', '.btn-remove-tax', function() {
            $(this).closest('.tax-item').fadeOut('easeOutSine', function() {
                $(this).remove()
                calTotal()
            })
        })
    }

    var handleAddDiscount = function () {
        ele.addDiscount.on('click', function() {
            ele.discountField.toggleClass('d-none')
            ele.subTotalTextDiv.toggleClass('border-bottom')
            ele.subTotalDiv.toggleClass('border-bottom')
            calTotal()
        })
    }

    var handleAmountPaid = function () {
        ele.percentPaid.on('click', function () {
            let value = $(this).data('value')
            let total = cleanNumber(ele.total.html())
            let paid = (value/100) * total
            let debt = total - paid
            ele.amountPaid.val(formatNumber(paid))
            ele.amountDebt.val(formatNumber(debt))
        })
        ele.amountPaid.on('input', function(e) {
            let value = e.target.value
            let paid = cleanNumber(value)
            let total = cleanNumber(ele.total.html())
            let debt = total - paid
            ele.amountDebt.val(formatNumber(debt))
        })
    }

    var handleCreate = function () {
        ele.formCreate.on('submit', function() {
            var type = ele.btnSubmit.data('type')
            var target = ele.btnSubmit
            var params = {
                name        : ele.orderId.html(),
                customer    : ele.customerSelect.val(),
                date        : ele.dateInput.val(),
                note        : ele.noteField.val(),
                paid        : ele.amountPaid.val(),
                debt        : ele.amountDebt.val(),
                total       : ele.total.html(),
                items       : [],
                discount_percent : false,
                discount_value : null,
                discount_amount : null,
                productIds  : productIds,
            }
            $.each($('.product-item'), function() {
                let arrItem = {
                    itemId      : $('.product-input', $(this)).val(),
                    quantity    : $('.quantity-input', $(this)).val(),
                    price       : $('.price-input', $(this)).val(),
                    total       : $('.item-total', $(this)).html(),
                    taxes         : [],
                }
                $.each($('.tax-item', $(this)), function() {
                    let arrTax = {
                        type    : $('.tax-select', $(this)).val(),
                        value   : $('.tax-value', $(this)).val(),
                        amount  : $('.tax-price', $(this)).html(),
                    }
                    arrItem.taxes.push(arrTax)
                })
                params.items.push(arrItem)
            })
            if (!ele.discountField.hasClass('d-none')) {
                params.discount_percent = ele.discountTypePercent.prop('checked') ? true : false
                params.discount_value = ele.discountVal.val()
                params.discount_amount = ele.totalDiscount.html()
            }
            var _cb = function(rs) {
                if(rs.status) {
                    $.app.pushNotyCallback({
                        'type' : 'success',
                        'callback' : function () {
                            window.location.href = $.app.vars.url + '/orders/'
                        }
                    })
                } else {
                    $.app.pushNoty('error')
                }
            }
            if (type === 'create') {
                $.app.ajax($.app.vars.url + '/orders/store', 'POST', params, target, null, _cb);
            } else {
                params.id = options.billId
                $.app.ajax($.app.vars.url + '/orders/update', 'POST', params, target, null, _cb);
            }
        })
    }
}