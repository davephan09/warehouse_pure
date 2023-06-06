var VariationClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.statusFilter = $('#status-filter')
        ele.formCreate = $('#kt_modal_add_variation_form')
        ele.varOprions = $('#var-options')
        ele.varName = $('#variation-name')
        ele.descriptionInput = $('#variation-description')
        ele.statusInput = $('#kt_modal_add_customer_billing')
        ele.modalCreate = $('#kt_modal_add_variation')

        loadData()
    }

    this.bindEvents = function () {
        handleCreateVariation()
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
        var target = ele.variationTable
        var _cb = function (rs) {
            var data = rs.data
            variations = data.variations
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/variations/get-data', 'GET', params, target, null, _cb)
    }

    var handleCreateVariation = function () {
        ele.formCreate.on('submit', function () {
            let params = {
                name : ele.varName.val(),
                description : ele.descriptionInput.val(),
                active : ele.statusInput.val(),
                options : ele.varOprions.val(),
            }

            var target = ele.modalCreate
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalCreate.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.ajax($.app.vars.url + '/variations/store', 'POST', params, target, null, _cb)
        })
    }
}