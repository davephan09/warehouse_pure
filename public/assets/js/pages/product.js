var ProductClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.productTable = $('#kt_ecommerce_products_table')
        ele.searchField = $('#search-field')
        ele.statusFilter = $('#status-filter')

        loadData()
    }

    this.bindEvents = function () {
        handleUpdate()
        handleDelete()
    }

    var getParam = () => {
        var params = {}
        return params
    }

    var loadData = () => {
        var params = getParam()
        var target = ele.productTable
        var _cb = (rs) => {
            data = rs.data
            drawContent(data)
        }

        $.app.ajax($.app.vars.url + '/products/get-data', 'GET', params, target, null, _cb);
    }

    var drawContent = function(data) {
        let dttableid = 'product-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.productTable.html(data.htmlProductTable)
        vars.datatable[dttableid] = ele.productTable.DataTable({
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
                targets: [0,6],
                orderable: false,
                visible: true
            }],
        })
        
        ele.searchField.on('keyup', function(e) {
            var text = e.target.value
            vars.datatable[dttableid].column(1).search(text).draw()
        })

        ele.statusFilter.on('change', function(e) {
            var status = e.target.value
            if (status === 'all') {
                vars.datatable[dttableid].column(5).search('').draw()
            } else {
                val = '^'+status+'$'
                vars.datatable[dttableid].column(5).search(val, true, true).draw()
            }
        })
    }

    var handleUpdate = function() {
        $(document).on('click', '.update-btn', function() {
            let $id = $(this).data('id')
            let name = $(this).data('name')
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_update'),
                'text' : Lang.get('common.product') + ': ' + name,
                'callback' : function () {
                    window.location.href = $.app.vars.url + '/products/show/' + $id
                }
            })
        })
    }

    var handleDelete = function() {
        $(document).on('click', '.delete-btn', function() {
            let $id = $(this).data('id')
            let name = $(this).data('name')
            var params = {
                id : $id
            }
            let _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_delete'),
                'text' : Lang.get('common.product') + ': ' + name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/products/delete', 'POST', params, '', null, _cb);
                }
            })
        })
    }
}