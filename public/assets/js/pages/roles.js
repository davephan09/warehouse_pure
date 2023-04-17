var RolesClass = function () {
    var ele = {};
    
    this.run = function () {
        this.init();
        this.bindEvents();
    }

    this.init = function () {
        ele.contentPage = $('#content-page');
        loadData();
    }

    this.bindEvents = function () {

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
}