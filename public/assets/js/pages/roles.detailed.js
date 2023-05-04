var RolesDetailedClass = function () {
    var ele = {}
    var roleId = 0
    var vars = {
        datatable : {},
    }

    this.run = function (id) {
        roleId = id
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.roleUserTable = $('#kt_roles_view_table')
        ele.searchField = $('#seach-field')
        ele.userQuantity = $('#user-quantity')
        ele.checkAll = $('#kt_roles_select_all') 
        ele.checkItems = $('.check-item')
        ele.roleNameEdit = $('#role-name-edit')
        ele.modalUpdate = $('#kt_modal_update_role')
        ele.idRole = $('#id-role')
        ele.updateBtn = $('#update-btn', $('#kt_modal_update_role'))

        loadData(ele.roleUserTable)
    }

    this.bindEvents = function () {
        checkAll()
        updateRole()
    }

    var getParam = function () {
        var params = {

        };

        for(var i in params){
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function (target) {
        // ele.roleUserTable.LoadingOverlay("show");
        let params = getParam();
        var _cb = function (rs) {
            var data = rs.data;
            drawContent(data);
        };
        $.app.ajax($.app.vars.url + '/roles/' + roleId + '/get-data-detail', 'GET', params, target, null, _cb);
    }

    var drawContent = function (data) {
        let dttableid = 'role-user';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        ele.roleUserTable.html(data.htmlUserTable);
        vars.datatable[dttableid] = ele.roleUserTable.DataTable({
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
                targets: [0, 4],
                orderable: false,
                visible: true
            }],
            order: [
                [1, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value;
            vars.datatable[dttableid].column(2).search(text).draw();
        });

        ele.userQuantity.html(`(${data.listUsers.length})`)
    }

    var updateRole = function () {
        ele.updateBtn.on('click', function() {
            var params = {
                id : ele.idRole.val(),
                name : ele.roleNameEdit.val(),
                permission : []
            }
            var target = $('.modal-content', ele.modalUpdate)
            $.each(ele.checkItems, function (i, val) {
                if ($(this).prop('checked')) {
                    params.permission.push($(this).data('id'))
                }
            })
            var _cb = function (rs) {
                if (rs.status) {
                    loadData();
                    ele.modalUpdate.modal('hide')
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.ajax($.app.vars.url + '/roles/update', 'POST', params, target, null, _cb);
        })
    }

    var checkAll = function () {
        $.app.checkboxAll(ele.checkAll, ele.checkItems)
    }

}