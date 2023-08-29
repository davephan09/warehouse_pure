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
        ele.formUpdatePassword = $('#kt_modal_update_password_form')
        ele.modalUpdatePassword = $('#kt_modal_update_password')
        ele.currentPassword = $('input[name="current_password"]')
        ele.newPassword = $('input[name="new_password"]')
        ele.confirmPassword = $('input[name="confirm_password"]')
        ele.formAssignRole = $('#kt_modal_update_role_form')
        ele.modalAssignRole = $('#kt_modal_update_role')
        ele.roleInput = $('.role-input')
        ele.profileTable = $('#kt_table_users_login_session')

        loadData()
    }

    this.bindEvents = function () {
        handleAssignPermission()
        handleRevokePermission()
        handleUpdatePassword()
        handleAssignRoles()
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
        renderRole(data)

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

    var renderRole = function (data) {
        let roles = data.user.roles
        let profileHtml = ''
        let generalHtml = ''
        $.each(roles, function(i, item) {
            profileHtml += `<div class="badge badge-lg badge-light-primary d-inline me-2">${ item.name }</div>`
            generalHtml += `<a href="${ $.app.vars.url + '/roles/' + item.id + '/show' }" class="badge badge-lg badge-light-primary d-inline me-2">${ item.name }</a>`
        })
        $('#role-field').html(profileHtml)
        $('#role-general').html(profileHtml)
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

    var handleUpdatePassword = function () {
        ele.formUpdatePassword.on('submit', function() {
            var params = {
                id : options.id,
                currentPassword : ele.currentPassword.val(),
                newPassword : ele.newPassword.val(),
                newPassword_confirmation : ele.confirmPassword.val(),
            }

            if (params.newPassword !== params.newPassword_confirmation) {
                $.app.pushNoty('error', Lang.get('user.confirm_password_err'))
                return false
            }

            var target = ele.formUpdatePassword

            var _cb = function(rs) {
                if(rs.status) {
                    ele.modalUpdatePassword.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }

            var username = $('#profile_username').html()
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_change_pass'),
                'text' : Lang.get('user.username') + ': ' + username,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/users/change-password', 'POST', params, target, null, _cb);
                },
                'unConfirm' : function () {

                }
            })
        })
    }

    var handleAssignRoles = function () {
        ele.formAssignRole.on('submit', function () {
            var params = {
                id : options.id,
                roles : [],
            }
            $.each(ele.roleInput, function (i, val) {
                if ($(this).prop('checked')) {
                    params.roles.push($(this).val())
                }
            })
            var target = ele.formAssignRole
            var _cb = function(rs) {
                if(rs.status) {
                    loadData(ele.profileTable)
                    ele.modalAssignRole.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            var username = $('#profile_username').html()
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_assign_role'),
                'text' : Lang.get('user.username') + ': ' + username,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/users/assign-roles', 'POST', params, target, null, _cb);
                },
                'unConfirm' : function () {

                }
            })
        })
    }
}