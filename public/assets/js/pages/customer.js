var CustomerClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var address = {}
    var customers = {}
    var banks = {}

    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.provinceSelect = $('#province-select')
        ele.districtSelect = $('#district-select')
        ele.wardSelect = $('#ward-select')
        ele.modalCreate = $('#kt_modal_add_customer')
        ele.formCreate = $('#kt_modal_add_customer_form')
        ele.filterSelect = $('#filter-select')
        ele.customerTable = $('#kt_customers_table')
        ele.searchField = $('#search-field')
        ele.filterBtn = $('#filter-btn')

        loadData()
    }

    this.bindEvents = function () {
        renderDistrict()
        renderWard()
        createCustomer()
        paging()
        filter()
    }

    var getParam = function () {
        var params = {
            status : $('input[name="status"]:checked').val(),
            province : ele.filterSelect.val(),
            text : ele.searchField.val()
        }

        for(var i in params) {
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function () {
        var target = ele.customerTable
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
            address = data.address
            customers = data.customersMap
            banks = data.banks
        }
        $.app.ajax($.app.vars.url + '/customers/get-data', 'GET', params, target, null, _cb)
    }

    var drawContent = function (data) {
        let dttableid = 'customers-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.customerTable.html(data.htmlCustomerTable)
        vars.datatable[dttableid] = $('#customer-table').DataTable({
            // pageLength: 10,
            retrieve: true,
            searching: false,
            lengthChange: false,
            paging: false,
            aaSorting: [],
            info: false,
            dom: "lrtip",
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                targets: [3, 6],
                orderable: false,
                visible: true
            }],
            order: [
                [0, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            if(e.which ===  13) loadData()
        });
    }

    var paging = function () {
        $(document).on('click', '.page-link', function() {
            var $url = $(this).data('href')
            var target = ele.customerTable
            var _cb = function(rs) {
                var data = rs.data
                drawContent(data)
                address = data.address
                customers = data.customersMap
                banks = data.banks
            }
            $.app.ajax($url, 'GET', '', target, null, _cb)
        })
    }

    var filter = function () {
        ele.filterBtn.on('click', function() {
            loadData()
        })
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

    var createCustomer = function () {
        ele.formCreate.on('submit', function() {
            var params = {
                name : $('input[name="name"]', ele.modalCreate).val(),
                phone : $('input[name="phone"]', ele.modalCreate).val(),
                email : $('input[name="email"]', ele.modalCreate).val(),
                province : $('select[name="province"]', ele.modalCreate).val(),
                district : $('select[name="district"]', ele.modalCreate).val(),
                ward : $('select[name="ward"]', ele.modalCreate).val(),
                detail_address : $('input[name="address_detail"]', ele.modalCreate).val(),
                bank_code : $('select[name="bank"]', ele.modalCreate).val(),
                account_number : $('input[name="account_number"]', ele.modalCreate).val(),
                note: $('input[name="description"]', ele.modalCreate).val(),
                active: $('input[name="active"]', ele.modalCreate).prop('checked'),
            }
            var target = $('.modal-content', ele.modalCreate)
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalCreate.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('customer.add_customer'),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/customers/store', 'POST', params, target, null, _cb)
                }
            })
        })
    }
}