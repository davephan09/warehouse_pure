var BrandClass = function () {
    var ele = {}
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
        
        // loadData()
    }

    this.bindEvents = function () {
        addBrand()
    }

    var getParam = function () {
        var params = {

        }
        return params
    }

    var loadData = function () {
        var params = getParam()
        var target = ele.brandTable
        var _cb = function (rs) {
            var data = rs.data
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
        });
    }

    var addBrand = function () {
        ele.formCreate.on('submit', function () {
            var params = {
                'name' : ele.nameInput.val(),
                'active' : ele.status.val(),
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
}