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
        ele.userTable = $('#users-table')
        ele.searchField = $('#search-user')
        ele.roleFilter = $('#role-filter')

        loadData()
    }

    this.bindEvents = function () {
        paging()
        handleSearch()
        handleFilter()
        handleSwitchUser()
        handleDelete()
    }

    var getParam = function () {
        var params = {
            roleId : ele.roleFilter.val(),
            text : ele.searchField.val(),
        }
        for(var i in params) {
            if (!params[i]) params[i] = '';
        }
        return params
    }

    var loadData = function () {
        var params = getParam()
        var target = ele.userTable
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
        vars.datatable[dttableid] = $('#kt_table_users').DataTable({
            // pageLength: 10,
            retrieve: true,
            searching: true,
            // lengthChange: false,
            paging: false,
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

        $('.action-dropdown').dropdown()
    }

    var paging = function () {
        $(document).on('click', '.page-link', function() {
            var $url = $(this).data('href')
            var target = ele.userTable
            var _cb = function(rs) {
                var data = rs.data
                drawContent(data)
            }
            $.app.ajax($url, 'GET', '', target, null, _cb)
        })
    }

    var handleSearch = function() {
        ele.searchField.on('keyup', function (e) {
            if (e.which === 13) {
                loadData()
            }
        })
    }

    var handleFilter = function() {
        ele.roleFilter.on('change', function () {
            loadData()
        })
    }

    var handleSwitchUser = function() {
        $(document).on('click', '.switch-user', function (e) {
            let target = ele.userTable
            let $id = $(this).data('id')
            let params = {
                id : $id,
            }
            let _cb = function (rs) {
                var data = rs.data
                if (rs.status) {
                    $.app.pushNoty('success')
                    setTimeout(function() {
                        window.location.href = $.app.vars.url + '/'
                    }, 1500)
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }

            $.app.pushConfirmNoti({
                'title' : Lang.get('switch.want_switch_user'),
                'text'  : 'User ID: ' + params.id,
                'callback' : function() {
                    $.app.ajax($.app.vars.url + '/switches/switch-user', 'POST', params, target, null, _cb)
                },
                'unConfirm' : function() {
                    //
                }
            })
        })
    }

    var handleDelete = function() {
        $(document).on('click', '.delete-user', function(e) {
            let target = ele.userTable
            let $id = $(this).data('id')
            let params = {
                id : $id,
            }
            let _cb = function (rs) {
                var data = rs.data
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error', rs.message)
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_delete'),
                'text' : Lang.get('user.user_id') + ': ' + $id,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/users/delete', 'POST', params, target, null, _cb)
                }
            })
        })
    }
}