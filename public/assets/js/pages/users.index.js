var UsersClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }

    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.userTable = $('#kt_table_users')
        ele.searchField = $('#search-user')

        loadData(ele.userTable)
    }

    this.bindEvents = function () {

    }

    var getParam = function () {

    }

    var loadData = function (target) {
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/users/get-data', 'GET', params, target, null, _cb);
    }
    
    var drawContent = function (data) {
        let dttableid = 'users-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy();
        }
        ele.userTable.html(data.htmlUserTable)
        vars.datatable[dttableid] = ele.userTable.DataTable({
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
                targets: [0, 6],
                orderable: false,
                visible: true
            }],
            order: [
                [1, 'asc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value;
            vars.datatable[dttableid].column(1).search(text).draw();
        });
    }
}