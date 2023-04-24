var RolesClass = function () {
    var ele = {};
    var rolesInfo = {}
    var listRoles = {}
    var rolePermission = {}
    
    this.run = function () {
        this.init();
        this.bindEvents();
    }

    this.init = function () {
        ele.contentPage = $('#content-page');
        ele.submitBtn = $('#submit-btn', $('#kt_modal_add_role'))
        ele.updateBtn = $('#update-btn', $('#kt_modal_update_role'))
        ele.roleName = $('#role-name')
        ele.checkAll = $('#kt_roles_select_all', $('#kt_modal_add_role'))
        ele.checkItems = $('.check-item', $('#kt_modal_add_role'))
        ele.modalCreate = $('#kt_modal_add_role')
        ele.roleNameEdit = $('#role-name-edit')
        ele.checkAllE = $('#kt_roles_select_all', $('#kt_modal_update_role'))
        ele.checkItemsE = $('.check-item', $('#kt_modal_update_role'))
        ele.modalUpdate = $('#kt_modal_update_role')
        ele.idRole = $('#id-role')

        loadData();
    }

    this.bindEvents = function () {
        checkAll()
        createRole()
        syncRole()
        updateRole()
        removeRole()
    }

    var getParam = function () {
        var params = {

        };

        for(var i in params){
            if(!params[i]) params[i] = '';
        }
        return params;
    }

    var loadData = function () {
        // ele.contentPage.LoadingOverlay("show");
        let params = getParam();
        var _cb = function (rs) {
            var data = rs.data;
            drawContent(data);
            rolesInfo = data.rolesInfo
            listRoles = data.listRoles
            rolePermission = data.rolePermission
        };
        $.app.ajax($.app.vars.url + '/roles/get-data', 'GET', params, '', null, _cb);
    }

    var drawContent = function (data) {
        ele.contentPage.html(data.htmlListRoles);
    }

    var checkAll = function () {
        $.app.checkboxAll(ele.checkAll, ele.checkItems)
        $.app.checkboxAll(ele.checkAllE, ele.checkItemsE)
    }

    var createRole = function () {
        ele.submitBtn.on('click', function() {
            var name = ele.roleName.val()
            var params = {
                name : name,
                permission : []
            }
            $.each(ele.checkItems, function (i, val) {
                if ($(this).prop('checked')) {
                    params.permission.push($(this).data('id'))
                }
            })
            var _cb = function(rs) {
                if (rs.status) {
                    $.app.pushNoty('success', rs.message)
                    ele.modalCreate.modal('hide')
                    loadData();
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.ajax($.app.vars.url + '/roles/store', 'POST', params, '', null, _cb);
        })
    }

    var syncRole = function () {
        $(document).on('click', '.edit-btn', function () {
            var $id = $(this).data('id')
            ele.roleNameEdit.val(listRoles[$id])
            ele.idRole.val($id)
            $.each(ele.checkItemsE, function(i, val) {
                if (rolePermission[$id].includes($(this).data('id'))) {
                    $(this).prop('checked', true);
                }
            })
        })
    }

    var updateRole = function () {
        ele.updateBtn.on('click', function() {
            var params = {
                id : ele.idRole.val(),
                name : ele.roleNameEdit.val(),
                permission : []
            }
            $.each(ele.checkItemsE, function (i, val) {
                if ($(this).prop('checked')) {
                    params.permission.push($(this).data('id'))
                }
            })
            var _cb = function (rs) {
                if (rs.status) {
                    loadData();
                    ele.modalUpdate.modal('hide')
                    $.app.pushNoty('success', rs.message)
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.ajax($.app.vars.url + '/roles/update', 'POST', params, '', null, _cb);
        })
    }

    var removeRole = function () {
        $(document).on('click', '.remove-role', function () {
            var params = {
                id : $(this).data('id')
            }
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success', rs.message)
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_sure'),
                'text' : Lang.get('role_permission.delete_role'),
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/roles/delete', 'POST', params, '', null, _cb);
                }
            })
        })
    }
}