var RolesClass = function () {
    var ele = {};
    
    this.run = function () {
        this.init();
        this.bindEvents();
    }

    this.init = function () {
        ele.contentPage = $('#content-page');
        ele.submitBtn = $('#submit-btn')
        ele.roleName = $('#role-name')
        ele.checkAll = $('#kt_roles_select_all')
        ele.checkItems = $('.check-item')
        ele.modalCreate = $('#kt_modal_add_role')

        loadData();
    }

    this.bindEvents = function () {
        checkAll()
        createRole()
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
        };
        $.app.ajax($.app.vars.url + '/roles/get-data', 'GET', params, '', null, _cb);
    }

    var drawContent = function (data) {
        ele.contentPage.html(data.htmlListRoles);
    }

    var checkAll = function () {
        $.app.checkboxAll(ele.checkAll, ele.checkItems)
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
}