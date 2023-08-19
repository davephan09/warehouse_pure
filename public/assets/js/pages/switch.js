var SwitchClass = function () {
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
        ele.roleFilter = $('#filter-role')
        ele.switchForm = $('#form-switch')
        ele.usernameText = $('#switch-user')

        loadData()
    }

    this.bindEvents = function () {
        handleFilter()
        paging()
        handleSwitch()
        handleSwitchForm()
    }

    var getParam = function () {
        var params = {
            text : ele.searchField.val(),
            role : ele.roleFilter.val(),
        }

        for(var i in params) {
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function () {
        var target = ele.userTable
        var params = getParam()
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/switches/get-data', 'GET', params, target, null, _cb);
    }

    var paging = function () {
        $(document).on('click', '.page-link', function() {
            var $url = $(this).data('href')
            var target = ele.customerTable
            var _cb = function(rs) {
                var data = rs.data
                drawContent(data)
            }
            $.app.ajax($url, 'GET', '', target, null, _cb)
        })
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
            lengthChange: false,
            paging: false,
            aaSorting: [],
            info: false,
            dom: "lrtip",
            responsive: true,
            autoWidth: false,
            // columnDefs: [{
            //     targets: [0, 6],
            //     orderable: false,
            //     visible: true
            // }],
            order: [
                [0, 'desc']
            ],
        });

        ele.searchField.on('keyup', function (e) {
            if (e.which === 13) loadData()
        });
    }

    var handleFilter = function () {
        ele.roleFilter.on('change', function () {
            loadData()
        })
    }

    var handleSwitch = function () {
        $(document).on('click', '.switch-user', function() {
            let thisTr = $(this).closest('tr')
            let $id = $(thisTr).data('id')
            let params = {
                id : $id,
            }
            switchUser(params)
        })
    }

    var handleSwitchForm = function () {
        ele.switchForm.on('submit', function () {
            let params = {
                username : ele.usernameText.val()
            }
            switchUser(params)
        })
    }

    var switchUser = function (params) {
        let target = ele.userTable
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
            'text'  : params.id? 'User ID: ' + params.id : 'Username: ' + params.username,
            'callback' : function() {
                $.app.ajax($.app.vars.url + '/switches/switch-user', 'POST', params, target, null, _cb)
            },
            'unConfirm' : function() {
                //
            }
        })
    }
}