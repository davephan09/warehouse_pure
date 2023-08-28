var UserDetailClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var options = {}

    this.run = function (opt) {
        options = opt
        
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.permissionTable = $('#kt_table_user_permissions')
        ele.checkItems = $('.check-item')
        ele.checkAll = $('#kt_roles_select_all')
        ele.formAssignPermission = $('#kt_modal_assign_permission_form')
        ele.modalAssignPermission = $('#kt_modal_assign_permission')

        loadData()
    }

    this.bindEvents = function () {
        handleAssignPermission()
        handleRevokePermission()
    }

    var getParam = function () {
        var params = {
            id : options.id,
        }
        for(var i in params) {
            if (!params[i]) params[i] = '';
        }
        return params
    }

    var loadData = function (target) {
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/users/get-detail-data', 'GET', params, target, null, _cb);
    }

    var drawContent = function (data) {
        renderPermission(data)
        syncPermissions(data)

        $.app.checkboxAll(ele.checkAll, ele.checkItems)
    }
    
    var renderPermission = function (data) {
        let dttableid = 'permissions-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        ele.permissionTable.html(data.htmlPermissionTable)
        vars.datatable[dttableid] = ele.permissionTable.DataTable({
            pageLength: 10,
            retrieve: true,
            searching: true,
            lengthChange: false,
            paging: true,
            aaSorting: [],
            info: false,
            dom: "lrtip",
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                targets: [1],
                orderable: false,
                visible: true
            }],
            order: [
                [0, 'asc']
            ],
        });

        $('.delete-btn').tooltip()
    }

    var handleAssignPermission = function() {
        ele.formAssignPermission.on('submit', function () {
            var params = {
                id : options.id,
                permissions : [],
            }
            $.each(ele.checkItems, function (i, val) {
                if ($(this).prop('checked')) {
                    params.permissions.push($(this).data('id'))
                }
            })
            var target = ele.formAssignPermission
            var _cb = function(rs) {
                if (rs.status) {
                    loadData(ele.permissionTable)
                    ele.modalAssignPermission.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
        
            $.app.ajax($.app.vars.url + '/users/assign-permissions', 'POST', params, target, null, _cb);
        })
    }

    var syncPermissions = function (data) {
        $.each(ele.checkItems, function (i, item) {
            let permissionIds = data.permissionIds
            if (permissionIds.includes($(item).data('id'))) {
                $(item).prop('checked', true)
            } else {
                $(item).prop('checked', false)
            }
        })
    }

    var handleRevokePermission = function () {
        $(document).on('click', '.delete-btn', function (e) {
            let tr = $(this).closest('tr')
            let name = $('.permission-name', $(tr)).html()
            var params = {
                id : options.id,
                permission : $(this).data('id'),
            }
            var target = ele.permissionTable
            var _cb = function(rs) {
                if (rs.status) {
                    loadData(target)
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_revoke'),
                'text' : Lang.get('role_permission.permission') + ': ' + name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/users/revoke-permissions', 'POST', params, '', null, _cb);
                },
                'unConfirm' : function () {
                    
                }
            })
        })
    }
}