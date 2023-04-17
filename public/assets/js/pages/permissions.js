var PermissionsClass = function () {
    var ele = {};
    var vars = {
        datatable : {},
    };

    this.run = function () {
        this.init();
        this.bindEvents();
    }

    this.init = function () {
        ele.permissionTable = $('#kt_permissions_table');
        ele.searchField = $('#search-permission');

        loadData();
    }

    this.bindEvents = function () {

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
            pageLength: 3,
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
}