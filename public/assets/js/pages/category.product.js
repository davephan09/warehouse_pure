var CategoryProductClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.categoryTable = $('#kt_ecommerce_category_table')
        ele.searchField = $('#search-field')
        ele.statusFilter = $('#status-filter')
        
        loadData(ele.categoryTable)
    }

    this.bindEvents = function () {

    }

    var getParam = function () {
        var params = {

        }

        return params
    }

    var loadData = function (target) {
        var params = getParam()
        var _cb = function(rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/categories/product/get-data', 'GET', params, target, null, _cb);
    }

    var drawContent = function (data) {
        let dttableid = 'category-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.categoryTable.html(data.htmlCategoryTable)
        vars.datatable[dttableid] = ele.categoryTable.DataTable({
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
                targets: [0, 3],
                orderable: false,
                visible: true
            }],
        });

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value;
            vars.datatable[dttableid].column(1).search(text).draw();
        });

        ele.statusFilter.on('change', function (e) {
            var status = e.target.value;
            if (status === 'all') {
                vars.datatable[dttableid].column(2).search('').draw();
            } else {
                vars.datatable[dttableid].column(2).search('^'+status+'$', true, false).draw();
            }
        })
    }
}