var UserDetailClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var options = {}
    var user = {}

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
        ele.orderTable = $('#list-order')
        ele.purchasingTable = $('#purchasing-table')
        ele.loadingField = $('.loading_tab')
        ele.totalOrder = $('#total-order')
        ele.totalPurchasing = $('#total-purchasing')
        ele.formUpdateInfor = $('#kt_modal_update_user_form')
        ele.modalUpdateInfor = $('#kt_modal_update_details')
        ele.inforTable = $('#kt_user_view_details')
        ele.username = $('#profile_username')
        ele.avatarInfo = $('#avatar-info')
        ele.avatarBackground  = $('.avatar-background')

        load(ele.loadingField)
    }

    this.bindEvents = function () {
        handleAssignPermission()
        handleRevokePermission()
        handleUpdatePassword()
        handleAssignRoles()
        paging()
        handleUpdateInfor()
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

    var load = function (target) {
        loadData(target)
        loadPurchasing()
    }

    var loadData = function (target) {
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            user = data.user
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/users/get-detail-data', 'GET', params, target, null, _cb);
    }

    var loadPurchasing = function () {
        var params = getParam()
        var target = ele.purchasingTable
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/users/get-purchasing-data', 'GET', params, target, null, _cb);
    }

    var drawContent = function (data) {
        if (data.purchasing) {
            renderPurchasing(data)
        } else {
            renderUserInfor(data)
            renderPermission(data)
            syncPermissions(data)
            renderRole(data)
            renderOrder(data)
        }

        $.app.checkboxAll(ele.checkAll, ele.checkItems)
    }

    var renderUserInfor = function(data) {
        let dttableid = 'infor-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        ele.inforTable.html(data.htmlInforTable)
        $('input[name="name"]').val(data.user.first_name + ' ' + data.user.last_name)
        $('input[name="phone"]').val(data.user.phone)
        $('input[name="email"]').val(data.user.email)

        if (data.user.avatar !== null) {
            ele.avatarBackground.css("background-image", `url("${ options.imageUrl + data.user.avatar }")`)
        } else {
            $('.image-input').addClass('image-input-empty')
        }
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

    var renderOrder = function (data) {
        let dttableid = 'order-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        var totalOrder = data.orders.total
        ele.orderTable.html(data.htmlOrderTable)
        ele.totalOrder.html(Lang.get('user.total_order', { 'attribute' : totalOrder }))
        $('.update-btn').tooltip()
    }

    var renderPurchasing = function (data) {
        let dttableid = 'purchasing-list'
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        var totalPurchasing = data.purchasing.total
        ele.purchasingTable.html(data.htmlPurchasingTable)
        ele.totalPurchasing.html(Lang.get('user.total_purchasing', { 'attribute' : totalPurchasing }))
        $('.update-btn').tooltip()
    }

    var paging = function(target) {
        $(document).on('click', '.page-link', function() {
            var $url = $(this).data('href')
            var target = $(this).closest('.loading_tab')
            var _cb = function(rs) {
                var data = rs.data
                drawContent(data)
            }
            $.app.ajax($url, 'GET', '', $(target), null, _cb)
        })
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

            var username = ele.username.html()
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
            var username = ele.username.html()
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

    var handleUpdateInfor = function () {
        ele.formUpdateInfor.on('submit', function () {
            var params = new FormData(ele.formUpdateInfor[0])
            params.append('id', options.id)
            var target = ele.formUpdateInfor
            var _cb = function(rs) {
                if(rs.status) {
                    var dataRs = rs.data
                    var htmlAvatar = ''
                    loadData(ele.inforTable)
                    if (dataRs.user.avatar !== null) {
                        htmlAvatar += `<img src="${ options.imageUrl + dataRs.user.avatar }" alt="image" />`
                    } else {
                        htmlAvatar += `<span class="symbol-label bg-light-danger text-danger fw-bold">${ dataRs.user.username.charAt(0).toUpperCase() }</span>`
                    }
                    ele.avatarInfo.html(htmlAvatar)
                    $.app.hideLoading(target)
                    ele.modalUpdateInfor.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.hideLoading(target)
                    $.app.pushNoty('error')
                }
            }
            let avatarBg = ele.avatarBackground.css('background-image')
            if (avatarBg === `url("${ options.imageUrl + user.avatar }")`) {
                var type = 'current'
            } else {
                var type = 'change'
            }
            params.append('type', type)
            var username = ele.username.html()
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_update_infor'),
                'text' : Lang.get('user.username') + ': ' + username,
                'callback' : function () {
                    $.app.showLoading(target);
                    $.ajax({
                        url: $.app.vars.url + '/users/update-infor',
                        type: 'POST',
                        data: params,
                        processData: false,
                        contentType: false,
                        success: _cb,
                    })
                },
                'unConfirm' : function () {
    
                }
            })
        })
    }
}