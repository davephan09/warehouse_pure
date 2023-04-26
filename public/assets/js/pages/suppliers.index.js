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
        ele.btnCreate = $('#kt_modal_add_customer_submit')
        ele.modalCreate = $('#kt_modal_add_customer')

        loadData()
    }

    this.bindEvents = function () {
        renderDistrict()
        renderWard()
        createSupplier()
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

    var createSupplier = function () {
        ele.btnCreate.on('click', function() {console.log('test')
            var params = {
                name : JSON.stringify($('input[name="name"]').val()),
                phone : JSON.stringify($('input[name="phone"]').val()),
                email : JSON.stringify($('input[name="email"]').val()),
                province : $('select[name="province"]').val(),
                district : $('select[name="district"]').val(),
                ward : $('select[name="ward"]').val(),
                detail_address : JSON.stringify($('input[name="address_detail"]').val()),
                bank_code : $('select[name="bank"]').val(),
                account_number : JSON.stringify($('input[name="account_number"]').val()),
                note: JSON.stringify($('input[name="description"]').val()),
                active: $('input[name="active"]').val(),
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalCreate.modal('hide')
                    $.app.pushNoty('success', rs.message)
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('supply.add_supplier'),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/suppliers/store', 'POST', params, '', null, _cb)
                }
            })
        })
    }
}