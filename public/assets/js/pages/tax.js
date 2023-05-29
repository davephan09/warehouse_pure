var TaxClass = function () {
    var ele = {}
    var taxes = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.taxTable = $('#kt_ecommerce_tax_table')
        ele.formCreate = $('#kt_modal_add_tax_form')
        ele.modalCreate = $('#kt_modal_add_tax')
        ele.nameInput = $('#name-input')
        ele.descInput = $('#description')
        ele.status = $('#kt_modal_add_customer_billing')
        ele.searchField = $('#search-field')
        ele.statusFilter = $('#status-filter')
        ele.formUpdate = $('#kt_modal_update_tax_form')
        ele.modalUpdate = $('#kt_modal_update_tax')
        ele.nameInputE = $('#name-input-update')
        ele.statusE = $('#kt_modal_update_customer_billing')
        ele.taxId = $('#tax-id')
        ele.descInputE = $('#description-update')
        
        loadData()
    }

    this.bindEvents = function () {
        addTax()
        handleStatus()
        syncTax()
        updateTax()
        handleUpdateStatus()
        handleDelete()
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
        var target = ele.taxTable
        var _cb = function (rs) {
            var data = rs.data
            taxes = data.taxes
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/taxes/get-data', 'GET', params, target, null, _cb)
    }

    var drawContent = function (data) {
        let dttableid = 'tax-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.taxTable.html(data.htmlTaxTable)
        vars.datatable[dttableid] = ele.taxTable.DataTable({
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
            vars.datatable[dttableid].column(0).search(text).draw()
        }); 
    }

    var addTax = function () {
        ele.formCreate.on('submit', function () {
            var params = {
                'name' : ele.nameInput.val(),
                'description' : ele.descInput.val(),
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
            $.app.ajax($.app.vars.url + '/taxes/store', 'POST', params, target, null, _cb)
        })
    }

    var handleStatus = function () {
        ele.statusFilter.on('change', function () {
            loadData()
        })
    }

    var syncTax = function () {
        $(document).on('click', '.update-btn', function() {
            var $id = $(this).data('id')
            var tax = taxes[$id]
            ele.nameInputE.val(tax.name)
            ele.descInputE.val(tax.description)
            tax.active ? ele.statusE.prop('checked', true) : ele.statusE.prop('checked', false)
            ele.taxId.val(tax.id)
        })
    }

    var updateTax = function () {
        ele.formUpdate.on('submit', function () {
            var $id = ele.taxId.val()
            var params = {
                'name' : ele.nameInputE.val(),
                'description' : ele.descInputE.val(),
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
                'text' : Lang.get('tax.update_tax') + ': ' + taxes[parseInt($id)].name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/taxes/update', 'POST', params, target, null, _cb)
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
                'title' : Lang.get('common.update_active') + ': ' + taxes[parseInt($id)].name,
                'text' : (params.active ? Lang.get('common.wanna_active_true') : Lang.get('common.wanna_active_false')),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/taxes/update-status', 'POST', params, '', null, _cb)
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

    var handleDelete = function () {
        $(document).on('click', '.delete-btn', function () {
            var $id = $(this).data('id')
            var params = {
                'id' : $id
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('tax.delete_tax') + ': ' + taxes[parseInt($id)].name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/taxes/delete', 'POST', params, '', null, _cb)
                },
                'unConfirm' : function () {
                }
            })
        })
    }
}