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

        loadData()
    }

    this.bindEvents = function () {
        // checkAll()
        // createRole()
    }

    var getParam = function () {
        var params = {

        };

        for(var i in params){
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function () {
        // ele.contentPage.LoadingOverlay("show");
        let params = getParam();
        var _cb = function (rs) {
            var data = rs.data;
            drawContent(data);
        };
        $.app.ajax($.app.vars.url + '/roles/' + roleId + '/get-data-detail', 'GET', params, '', null, _cb);
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
    }

    // var checkAll = function () {
    //     $.app.checkboxAll(ele.checkAll, ele.checkItems)
    // }

    // var createRole = function () {
    //     ele.submitBtn.on('click', function() {
    //         var name = ele.roleName.val()
    //         var params = {
    //             name : name,
    //             permission : []
    //         }
    //         $.each(ele.checkItems, function (i, val) {
    //             if ($(this).prop('checked')) {
    //                 params.permission.push($(this).data('id'))
    //             }
    //         })
    //         var _cb = function(rs) {
    //             if (rs.status) {
    //                 $.app.pushNoty('success', rs.message)
    //                 ele.modalCreate.modal('hide')
    //                 loadData();
    //             } else {
    //                 $.app.pushNoty('error', rs.message)
    //             }
    //         }
    //         $.app.ajax($.app.vars.url + '/roles/store', 'POST', params, '', null, _cb);
    //     })
    // }


}