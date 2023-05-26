var BrandClass = function () {
    var ele = {}
    var brands = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.brandTable = $('#kt_ecommerce_brand_table')
        ele.formCreate = $('#kt_modal_add_brand_form')
        ele.modalCreate = $('#kt_modal_add_brand')
        ele.nameInput = $('#name-input')
        ele.status = $('#kt_modal_add_customer_billing')
        ele.searchField = $('#search-field')
        ele.statusFilter = $('#status-filter')
        ele.formUpdate = $('#kt_modal_update_brand_form')
        ele.modalUpdate = $('#kt_modal_update_brand')
        ele.nameInputE = $('#name-input-update')
        ele.statusE = $('#kt_modal_update_customer_billing')
        ele.brandId = $('#brand-id')
        
        loadData()
    }

    this.bindEvents = function () {
        addBrand()
        handleStatus()
        syncBrand()
        updateBrand()
        handleUpdateStatus()
    }

    var getParam = function () {
        var params = {
            'status' : ele.statusFilter.val()
        }

        for(var i in params){
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function () {
        var params = getParam()
        var target = ele.brandTable
        var _cb = function (rs) {
            var data = rs.data
            brands = data.brands
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/brands/get-data', 'GET', params, target, null, _cb)
    }

    var drawContent = function (data) {
        let dttableid = 'brand-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.brandTable.html(data.htmlBrandTable)
        vars.datatable[dttableid] = ele.brandTable.DataTable({
            pageLength: 10,
            retrieve: true,
            searching: true,
            lengthChange: false,
            pagination: true,
            aaSorting: [],
            info: false,
            dom: "lrtip",
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                targets: [0, 3],
                orderable: false,
                visible: true
            }],
            order: [
                [2, 'desc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value
            vars.datatable[dttableid].column(0).search(text, true, false, true).draw()
        }); 
    }

    var addBrand = function () {
        ele.formCreate.on('submit', function () {
            var params = {
                'name' : ele.nameInput.val(),
                'active' : ele.status.prop('checked'),
            }
            var _cb = function (rs) {
                if (rs.status) {
                    $.app.pushNoty('success')
                    ele.modalCreate.modal('hide')
                    loadData();
                } else {
                    $.app.pushNoty('error')
                }
            }
            var target = ele.formCreate
            $.app.ajax($.app.vars.url + '/brands/store', 'POST', params, target, null, _cb)
        })
    }

    var handleStatus = function () {
        ele.statusFilter.on('change', function () {
            loadData()
        })
    }

    var syncBrand = function () {
        $(document).on('click', '.update-btn', function() {
            var $id = $(this).data('id')
            var brand = brands[$id]
            ele.nameInputE.val(brand.name)
            brand.active ? ele.statusE.prop('checked', true) : ele.statusE.prop('checked', false)
            ele.brandId.val(brand.id)
        })
    }

    var updateBrand = function () {
        ele.formUpdate.on('submit', function () {
            var $id = ele.brandId.val()
            var params = {
                'name' : ele.nameInputE.val(),
                'active' : ele.statusE.prop('checked'),
                'id' : $id,
            }
            var _cb = function (rs) {
                if (rs.status) {
                    $.app.pushNoty('success')
                    ele.modalUpdate.modal('hide')
                    loadData();
                } else {
                    $.app.pushNoty('error')
                }
            }
            var target = ele.formUpdate
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('brand.update_brand') + ': ' + brands[parseInt($id)].name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/brands/update', 'POST', params, target, null, _cb)
                },
                'unConfirm' : function () {

                }
            })
        })
    }

    var handleUpdateStatus = function () {
        $(document).on('click', '.is-active-btn', function () {
            var $this = $(this)
            var $id = $this.val()
            var params = {
                id : $id,
                active : $(this).prop('checked')
            }
            var _cb = function(rs) {
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.update_active') + ': ' + brands[parseInt($id)].name,
                'text' : (params.active ? Lang.get('common.wanna_active_true') : Lang.get('common.wanna_active_false')),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/brands/update-status', 'POST', params, '', null, _cb)
                },
                'unConfirm' : function () {
                    if ($this.attr('checked')) {
                        $this.prop('checked', true)
                    } else {
                        $this.prop('checked', false)
                    }
                }
            })
        })
    }
}