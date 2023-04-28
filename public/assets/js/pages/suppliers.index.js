var SupplierClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var address = {}
    var suppliers = {}
    var banks = {}

    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.supplierTable = $('#kt_customers_table')
        ele.searchField = $('#search-supplier')
        ele.modalCreate = $('#kt_modal_add_customer')
        ele.modalUpdate = $('#kt_modal_update_customer')
        ele.provinceSelect = $('#province-select')
        ele.districtSelect = $('#district-select')
        ele.wardSelect = $('#ward-select')
        ele.provinceSelectE = $('#province-select-update')
        ele.districtSelectE = $('#district-select-update')
        ele.wardSelectE = $('#ward-select-update')
        ele.btnCreate = $('#kt_modal_add_customer_submit')
        ele.btnUpdate = $('#kt_modal_update_customer_submit')
        ele.nameUpdate = $('#name-update', ele.modalUpdate)
        ele.phoneUpdate = $('#phone-update', ele.modalUpdate)
        ele.emailUpdate = $('#email-update', ele.modalUpdate)
        ele.addressDetailUpdate = $('#address-detail-update', ele.modalUpdate)
        ele.bankUpdate = $('#bank-select', ele.modalUpdate)
        ele.accountNumberUpdate = $('#account-number', ele.modalUpdate)
        ele.descriptionUpdate = $('#description-update', ele.modalUpdate)
        ele.activeUpdate = $('#kt_modal_update_customer_billing', ele.modalUpdate)

        loadData()
    }

    this.bindEvents = function () {
        renderDistrict()
        renderWard()
        createSupplier()
        changeActive()
        syncUpdateSupplier()
        updateSupplier()
        renderDistrictE()
        renderWardE()
    }

    var getParam = function () {

    }

    var loadData = function () {
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
            address = data.address
            suppliers = data.suppliers
            banks = data.banks
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
                targets: [3, 6],
                orderable: false,
                visible: true
            }],
            order: [
                [0, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value
            vars.datatable[dttableid].column(0).search(text).draw()
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
        ele.btnCreate.on('click', function() {
            var params = {
                name : JSON.stringify($('input[name="name"]', ele.modalCreate).val()),
                phone : JSON.stringify($('input[name="phone"]', ele.modalCreate).val()),
                email : JSON.stringify($('input[name="email"]', ele.modalCreate).val()),
                province : $('select[name="province"]', ele.modalCreate).val(),
                district : $('select[name="district"]', ele.modalCreate).val(),
                ward : $('select[name="ward"]', ele.modalCreate).val(),
                detail_address : JSON.stringify($('input[name="address_detail"]', ele.modalCreate).val()),
                bank_code : $('select[name="bank"]', ele.modalCreate).val(),
                account_number : JSON.stringify($('input[name="account_number"]', ele.modalCreate).val()),
                note: JSON.stringify($('input[name="description"]', ele.modalCreate).val()),
                active: $('input[name="active"]', ele.modalCreate).prop('checked'),
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalCreate.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
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

    var changeActive = function () {
        $(document).on('change', '.is-active-btn', function () {
            var $this = $(this)
            var params = {
                id : $this.val(),
                active : $(this).prop('checked')
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
                'title' : Lang.get('common.update_active'),
                'text' : (params.active ? Lang.get('common.wanna_active_true') : Lang.get('common.wanna_active_false')),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/suppliers/change-status', 'POST', params, '', null, _cb)
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

    var syncUpdateSupplier = function () {
        $(document).on('click', '.update-btn', function() {
            var $id = $(this).data('id')
            var supplier = suppliers[$id]
            ele.btnUpdate.attr('data-id', supplier.id)
            ele.nameUpdate.val(JSON.parse(supplier.name))
            ele.phoneUpdate.val(JSON.parse(supplier.phone))
            ele.emailUpdate.val(JSON.parse(supplier.email))
            ele.provinceSelectE.html('')
            var provinceList = '<option><option>'
            $.each(address, function(i, val) {
                provinceList += `<option value="${i}" ${i==supplier.province ? 'selected' : ''}>${val.name}</option>`
            })
            ele.provinceSelectE.html(provinceList)
            ele.districtSelectE.html('')
            var districtList = ''
            if (supplier.district) {
                $.each(address[supplier.province].districts, function(i, val) {
                    districtList += `<option value="${i}" ${i==supplier.district ? 'selected' : ''}>${val.name}</option>`
                })
            }
            ele.districtSelectE.html(districtList)
            ele.wardSelectE.html('')
            var wardList = ''
            if (supplier.ward) {
                $.each(address[supplier.province].districts[supplier.district].wards, function(i, val) {
                    wardList += `<option value="${i}" ${i==supplier.ward ? 'selected' : ''}>${val.name}</option>`
                })
            }
            ele.wardSelectE.html(wardList)
            ele.addressDetailUpdate.val(JSON.parse(supplier.detail_address))
            ele.bankUpdate.html('')
            var bankList = '<option></opption>'
            $.each(banks, function (i, val) {
                bankList += `<option value=${i} ${i===supplier.bank_code ? 'selected' : ''}>${val.shortName + ' - ' + val.name}</option>`
            })
            ele.bankUpdate.html(bankList)
            ele.accountNumberUpdate.val(JSON.parse(supplier.account_number))
            ele.descriptionUpdate.val(JSON.parse(supplier.note))
            supplier.active ? ele.activeUpdate.prop('checked', true) : ele.activeUpdate.prop('checked', false)

        })
    }

    var renderDistrictE = function () {
        ele.provinceSelectE.on('change', function(e) {
            var html = '<option value=""><option>'
            var $id = e.target.value
            $.each(address[$id].districts, function(i, val) {
                html += `<option value="${i}">${val.name}</option>`
            })
            ele.districtSelectE.html(html);
        })
    }

    var renderWardE = function () {
        ele.districtSelectE.on('change', function(e) {
            var html = '<option value=""><option>'
            var provinceId = ele.provinceSelectE.val()
            var $id = e.target.value
            $.each(address[provinceId].districts[$id].wards, function(i, val) {
                html += `<option value="${val.code}">${val.name}</option>`
            })
            ele.wardSelectE.html(html);
        })
    }

    var updateSupplier = function () {
        ele.btnUpdate.on('click', function () {
            var $id = $(this).data('id')
            var supplier = suppliers[$id]
            var params = {
                name : JSON.stringify(ele.nameUpdate.val()),
                phone : JSON.stringify(ele.phoneUpdate.val()),
                email : JSON.stringify(ele.emailUpdate.val()),
                province : ele.provinceSelectE.val(),
                district : ele.districtSelectE.val(),
                ward : ele.wardSelectE.val(),
                detail_address : JSON.stringify(ele.addressDetailUpdate.val()),
                bank_code : ele.bankUpdate.val(),
                account_number : JSON.stringify(ele.accountNumberUpdate.val()),
                note: JSON.stringify(ele.descriptionUpdate.val()),
                active: ele.activeUpdate.prop('checked'),
                id: $id,
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalUpdate.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('supply.update_supplier') + ' ' + JSON.parse(supplier.name),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/suppliers/update', 'POST', params, '', null, _cb)
                }
            })
        })
    }
}