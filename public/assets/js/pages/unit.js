var UnitClass = function () {
    var ele = {}
    var units = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.unitTable = $('#kt_ecommerce_unit_table')
        ele.formCreate = $('#kt_modal_add_unit_form')
        ele.modalCreate = $('#kt_modal_add_unit')
        ele.nameInput = $('#name-input')
        ele.descInput = $('#description')
        ele.status = $('#kt_modal_add_customer_billing')
        ele.searchField = $('#search-field')
        ele.statusFilter = $('#status-filter')
        ele.formUpdate = $('#kt_modal_update_unit_form')
        ele.modalUpdate = $('#kt_modal_update_unit')
        ele.nameInputE = $('#name-input-update')
        ele.statusE = $('#kt_modal_update_customer_billing')
        ele.unitId = $('#unit-id')
        
        // loadData()
    }

    this.bindEvents = function () {
        addUnit()
        // handleStatus()
        // syncUnit()
        // updateUnit()
        // handleUpdateStatus()
        // handleDelete()
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
        var target = ele.unitTable
        var _cb = function (rs) {
            var data = rs.data
            units = data.units
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/units/get-data', 'GET', params, target, null, _cb)
    }

    var addUnit = function () {
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
            $.app.ajax($.app.vars.url + '/units/store', 'POST', params, target, null, _cb)
        })
    }
}