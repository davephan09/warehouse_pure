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
        ele.provinceSelectE = $('#province-select-update')
        ele.districtSelectE = $('#district-select-update')
        ele.wardSelectE = $('#ward-select-update')
        ele.btnCreate = $('#kt_modal_add_customer_submit')
        ele.btnUpdate = $('#kt_modal_update_customer_submit')
        ele.nameUpdate = $('#name-update', ele.modalUpdate)
        ele.phoneUpdate = $('#phone-update', ele.modalUpdate)
        ele.emailUpdate = $('#email-update', ele.modalUpdate)
        ele.addressDetailUpdate = $('#address-detail-update', ele.modalUpdate)
        ele.bankUpdate = $('#bank-select-update', ele.modalUpdate)
        ele.accountNumberUpdate = $('#account-number', ele.modalUpdate)
        ele.descriptionUpdate = $('#description-update', ele.modalUpdate)
        ele.activeUpdate = $('#kt_modal_update_customer_billing', ele.modalUpdate)
        ele.modalUpdate = $('#kt_modal_update_customer')
        ele.idUpdate = $('#id-update')
        ele.formUpdate = $('#kt_modal_update_customer_form')

        loadData()
    }

    this.bindEvents = function () {
        renderDistrict()
        renderWard()
        createCustomer()
        paging()
        filter()
        changeActive()
        syncUpdateCustomer()
        renderDistrictE()
        renderWardE()
        updateCustomer()
        deleteCustomer()
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

        $('.bank-icon').tooltip()
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
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.update_active'),
                'text' : (params.active ? Lang.get('common.wanna_active_true') : Lang.get('common.wanna_active_false')),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/customers/change-status', 'POST', params, '', null, _cb)
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

    var syncUpdateCustomer = function () {
        $(document).on('click', '.update-btn', function() {
            var $id = $(this).data('id')
            var customer = customers[$id]
            ele.idUpdate.val(customer.id)
            ele.nameUpdate.val(customer.name)
            ele.phoneUpdate.val(customer.phone)
            ele.emailUpdate.val(customer.email)
            ele.provinceSelectE.html('')
            var provinceList = '<option><option>'
            $.each(address, function(i, val) {
                provinceList += `<option value="${i}" ${i==customer.province ? 'selected' : ''}>${val.name}</option>`
            })
            ele.provinceSelectE.html(provinceList)
            ele.districtSelectE.html('')
            var districtList = ''
            if (customer.district) {
                $.each(address[customer.province].districts, function(i, val) {
                    districtList += `<option value="${i}" ${i==customer.district ? 'selected' : ''}>${val.name}</option>`
                })
            }
            ele.districtSelectE.html(districtList)
            ele.wardSelectE.html('')
            var wardList = ''
            if (customer.ward) {
                $.each(address[customer.province].districts[customer.district].wards, function(i, val) {
                    wardList += `<option value="${i}" ${i==customer.ward ? 'selected' : ''}>${val.name}</option>`
                })
            }
            ele.wardSelectE.html(wardList)
            ele.addressDetailUpdate.val(customer.detail_address)
            ele.bankUpdate.html('')
            var bankList = '<option></opption>'
            $.each(banks, function (i, val) {
                bankList += `<option value=${i} ${i===customer.bank_code ? 'selected' : ''}>${val.shortName + ' - ' + val.name}</option>`
            })
            console.log(ele.bankUpdate, bankList)
            ele.bankUpdate.html(bankList)
            ele.accountNumberUpdate.val(customer.account_number)
            ele.descriptionUpdate.val(customer.note)
            customer.active ? ele.activeUpdate.prop('checked', true) : ele.activeUpdate.prop('checked', false)
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

    var updateCustomer = function () {
        ele.formUpdate.on('submit', function () {
            var $id = ele.idUpdate.val()
            var customer = customers[$id]
            var params = {
                name : ele.nameUpdate.val(),
                phone : ele.phoneUpdate.val(),
                email : ele.emailUpdate.val(),
                province : ele.provinceSelectE.val(),
                district : ele.districtSelectE.val(),
                ward : ele.wardSelectE.val(),
                detail_address : ele.addressDetailUpdate.val(),
                bank_code : ele.bankUpdate.val(),
                account_number : ele.accountNumberUpdate.val(),
                note: ele.descriptionUpdate.val(),
                active: ele.activeUpdate.prop('checked'),
                id: $id,
            }
            var target = $('.modal-content', ele.modalUpdate)
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
                'text' : Lang.get('customer.update_customer') + ' ' + customer.name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/customers/update', 'POST', params, target, null, _cb)
                },
                'unConfirm' : function () {

                }
            })
        })
    }

    var deleteCustomer = function () {
        $(document).on('click', '.delete-btn', function () {
            var $id = $(this).data('id')
            var customer = customers[$id]
            var params = {
                id : $id
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
                'text' : Lang.get('customer.delete_customer') + ': ' + customer.name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/customers/delete', 'POST', params, '', null, _cb)
                },
            })
        })
    }
}