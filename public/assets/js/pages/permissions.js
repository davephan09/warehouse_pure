var PermissionsClass = function () {
    var ele = {};
    var vars = {
        datatable : {},
    };
    var permission = {}

    this.run = function () {
        this.init();
        this.bindEvents();
    }

    this.init = function () {
        ele.permissionTable = $('#kt_permissions_table')
        ele.searchField = $('#search-permission')
        ele.modalCreate = $('#kt_modal_add_permission')
        ele.modalUpdate = $('#kt_modal_update_permission')
        ele.submitButton = $('#submit-btn')
        ele.permissionName = $('#permission-name', ele.modalCreate)
        ele.permissionCore = $('#kt_permissions_core')
        ele.nameUpdate = $('#name-permission', ele.modalUpdate)
        ele.updateBtn = $('#update-modal-btn', ele.modalUpdate)
        ele.permissionId = $('#permission-id')

        loadData();
    }

    this.bindEvents = function () {
        submitPermission()
        syncPermission()
        updatePermission()
        coreBtn()
    }

    var getParam = function () {
        var params = {

        };

        for(var i in params) {
            if (!params[i]) params[i] = '';
        }
        return params;
    }

    var loadData = function () {
        var params = getParam();
        var _cb = function(rs) {
            var data = rs.data;
            drawContent(data);
            permission = data.listPermission
        }
        $.app.ajax($.app.vars.url + '/permissions/get-data', 'GET', params, '', null, _cb);
    }

    var drawContent = function(data) {
        let dttableid = 'permission-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        ele.permissionTable.html(data.htmlPermissionTable);
        vars.datatable[dttableid] = ele.permissionTable.DataTable({
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
                targets: [1, 3],
                orderable: false,
                visible: true
            }],
            order: [
                [0, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value;
            vars.datatable[dttableid].column(0).search(text).draw();
        });
    }

    var submitPermission = function () {
        ele.submitButton.on('click', function() {
            var name = ele.permissionName.val()
            var core = ele.permissionCore.prop('checked')
            var params ={
                name : name,
                is_core : core
            }
            var _cb = function (rs) {
                if (rs.status) {
                    $.app.pushNoty('success', rs.message)
                    ele.modalCreate.modal('hide')
                    loadData();
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.ajax($.app.vars.url + '/permissions/store', 'POST', params, '', null, _cb);
        })
    }

    var syncPermission = function () {
        $(document).on('click', '.update-btn', function () {
            var $id = $(this).data('id')
            ele.nameUpdate.val(permission[$id].name)
            ele.permissionId.val($id)
        })
    }

    var updatePermission = function () {
        ele.updateBtn.on('click', function() {
            var params = {
                id : ele.permissionId.val(),
                name : ele.nameUpdate.val()
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData();
                    ele.modalUpdate.modal('hide')
                    $.app.pushNoty('success', rs.message)
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('role_permission.update_permission'),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/permissions/update', 'POST', params, '', null, _cb);
                }
            })
        })
    }

    var coreBtn = function () {
        $(document).on('click', '.btn-core-permission', function() {
            $.app.pushNoty('error', Lang.get('role_permission.core_permission_noti'))
        })
    }
}