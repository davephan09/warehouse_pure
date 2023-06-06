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
        ele.variationTable = $('#kt_ecommerce_variation_table')
        ele.searchField = $('#search-field')

        loadData()
    }

    this.bindEvents = function () {
        handleCreateVariation()
        handleStatus()
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

    var drawContent = function (data) {
        let dttableid = 'variation-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.variationTable.html(data.htmlVariationTable)
        vars.datatable[dttableid] = ele.variationTable.DataTable({
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

    var handleStatus = function () {
        ele.statusFilter.on('change', function () {
            loadData()
        })
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