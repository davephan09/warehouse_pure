var SupplierClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var address = {}

    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.supplierTable = $('#kt_customers_table')
        ele.searchField = $('#search-supplier')
        ele.provinceSelect = $('#province-select')
        ele.districtSelect = $('#district-select')
        ele.wardSelect = $('#ward-select')

        loadData()
    }

    this.bindEvents = function () {
        renderDistrict()
        renderWard()
    }

    var getParam = function () {

    }

    var loadData = function () {
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
            address = data.address
        }
        $.app.ajax($.app.vars.url + '/suppliers/get-data', 'GET', params, '', null, _cb)
    }

    var drawContent = function (data) {
        let dttableid = 'suppliers-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.supplierTable.html(data.htmlSupplierTable)
        vars.datatable[dttableid] = ele.supplierTable.DataTable({
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
                targets: [0, 6],
                orderable: false,
                visible: true
            }],
            order: [
                [1, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value
            vars.datatable[dttableid].column(1).search(text).draw()
        });
    }

    var renderDistrict = function () {
        ele.provinceSelect.on('change', function(e) {
            var html = '<option value=""><option>'
            var $id = e.target.value
            $.each(address[$id].districts, function(i, val) {
                html += `<option value="${i}">${val.name}</option>`
            })
            ele.districtSelect.html(html);
        })
    }

    var renderWard = function () {
        ele.districtSelect.on('change', function(e) {
            var html = '<option value=""><option>'
            var provinceId = ele.provinceSelect.val()
            var $id = e.target.value
            $.each(address[provinceId].districts[$id].wards, function(i, val) {
                html += `<option value="${val.code}">${val.name}</option>`
            })
            ele.wardSelect.html(html);
        })
    }
}