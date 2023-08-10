var OrderClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var orders = {}
    var options = {}
    
    this.run = function (opt) {
        options = opt

        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.dateRange = $('#kt_ecommerce_sales_flatpickr')
        ele.perPage = $('#num-row-filter')
        ele.orderTable = $('#order-table')
        ele.searchField = $('#search-field')

        var format = 'DD/MM/YYYY';
        ele.dateRange.daterangepicker({
                showCustomRangeLabel: true,
                locale: {
                    format : "DD/MM/YYYY",
                },
                startDate: options.startdate,
                endDate: options.todate,
                ranges: {
                    'Today': [moment().format(format), moment().format(format)],
                    'Yesterday': [moment().subtract(1, 'days').format(format), moment().subtract(1, 'days').format(format)],
                    'Last 7 Days': [moment().subtract(6, 'days').format(format), moment().format(format)],
                    'Last 30 Days': [moment().subtract(29, 'days').format(format), moment().format(format)],
                    'This Month': [moment().startOf('month').format(format), moment().endOf('month').format(format)],
                    'Last Month': [moment().subtract(1, 'month').startOf('month').format(format), moment().subtract(1, 'month').endOf('month').format(format)],
                }
            },
            function(start, end) {
                loadData();
            }
        );
        loadData()
    }

    this.bindEvents = function () {
        paging()
        handleDeleteItem()
    }

    var getParam = function() {
        let params = {
            perPage : ele.perPage.val(),
            text    : ele.searchField.val(),
        }

        var drp = ele.dateRange.data('daterangepicker');
        params.fromdate = drp.startDate.format('DD-MM-YYYY');
        params.todate = drp.endDate.format('DD-MM-YYYY');

        for(var i in params){
            if(!params[i]) params[i] = '';
        }

        return params
    }

    var loadData = function () {
        var params = getParam()
        var target = ele.orderTable
        var _cb = function (rs) {
            var data = rs.data
            orders = data.ordersData
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/orders/get-data', 'GET', params, target, null, _cb);
    }
    
    var drawContent = function (data) {
        let dttableid = 'order-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.orderTable.html(data.htmlOrderTable)
        vars.datatable[dttableid] = $('#kt_ecommerce_sales_table').DataTable({
            // pageLength: 10,
            searching: true,
            lengthChange: false,
            paging: false,
            info: false,
            // dom: "lrtip",
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                targets: [0],
                orderable: false,
                visible: true
            }],
            order: [
                [1, 'desc']
            ],
        });

        $('.action-btn').tooltip()

        ele.searchField.on('keyup', function (e) {
            var text = e.target.value
            vars.datatable[dttableid].column(2).search(text).draw()
            if (e.key === "Enter")
                return loadData()
        });
    }

    var paging = function () {
        $(document).on('click', '.page-link', function() {
            var $url = $(this).data('href') 
            var target = ele.orderTable
            var _cb = function(rs) {
                var data = rs.data
                drawContent(data)
            }
            $.app.ajax($url, 'GET', '', target, null, _cb)
        })
    }

    var handleDeleteItem = function () {
        $(document).on('click', '.delete-btn', function(e) {
            let $id = $(this).data('id')
            let name = orders[$id].order_name
            var params = {
                id : $id
            }
            let _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    $.app.pushNoty('success')
                } else {
                    $.app.pushNoty('error')
                }
            }
            $.app.pushConfirmNoti({
                'title' : Lang.get('common.are_you_delete'),
                'text' : Lang.get('order.order') + ': ' + name,
                'callback' : function () {
                    $.app.ajax($.app.vars.url + '/orders/delete', 'POST', params, '', null, _cb)
                }
            })
        })
    }
}