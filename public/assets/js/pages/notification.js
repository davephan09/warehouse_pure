var NotificationClass = function () {
    var ele = {}
    var vars = {
        datatable : {}
    }
    var options = {}
    
    this.run = function (opt) {
        options = opt

        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.notifyTable = $('#notification_list')
        ele.searchField = $('#search-field')
        ele.modalCreate = $('#modal_add_notification')
        ele.selectUsers = $('.user-add-field')
        ele.formCreate = $('#kt_modal_add_notification_form')
        
        ele.selectUsers.select2({
            minimumInputLength: 3,
            placeholder: Lang.get('role_permission.select_users'),
            multiple : true,
            ajax: {
                url: $.app.vars.url + '/roles/search-user',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        keyword: term  //search term
                    };
                },
                processResults: function(data) {
                    if (data.status) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.title
                                }
                            })
                        }
                    }
                },   
            },
            templateResult : function (data) {
                return data.text
            },
            templateSelection : function (data) {
                return data.text
            },
        })

        loadData()
    }

    this.bindEvents = function () {
        handleNotifyFilter()
        handleAddNotification()
    }

    var getParam = function () {
        var params = {
            text : ele.searchField.val(),
            type : $('.notify-filter.text-active-primary.active').data('type')
        }

        for(var i in params) {
            if(!params[i]) params[i] = ''
        }
        return params
    }

    var loadData = function () {
        var params = getParam()
        var target = ele.notifyTable
        var _cb = function (rs) {
            var data = rs.data
            drawContent(data)
        }
        $.app.ajax($.app.vars.url + '/notifications/get-data', 'GET', params, target, null, _cb);
    }

    var drawContent = function (data) {
        let dttableid = 'notification-list';
        if (typeof vars.datatable[dttableid] !== 'undefined') {
            vars.datatable[dttableid].destroy()
        }
        ele.notifyTable.html(data.htmlNotificationTable)
        vars.datatable[dttableid] = $('#notification_table').DataTable({
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
            if (e.key === "Enter")
                return loadData()
        });
    }

    var handleNotifyFilter = function () {
        $(document).on('click', '.notify-filter', function (e) {
            let $this = $(this)
            $.each($('.notify-filter'), function (i, item) {
                $(item).removeClass('text-active-primary active')
                $this.addClass('text-active-primary active')
            })
            loadData()
        })
    }

    var handleAddNotification = function () {
        ele.formCreate.on('submit', function () {
            var params = {
                title : $('input[name="title"]', ele.modalCreate).val(),
                users : $('#user-add-field', ele.modalCreate).val(),
            }
            var target = $('.modal-content', ele.modalCreate)
            var _cb = function (rs) {
                if (rs.status) {
                    loadData()
                    ele.modalCreate.modal('hide')
                    $.app.pushToastr('success')
                } else {
                    $.app.pushToastr('error', rs.message)
                }
            }
            $.app.ajax($.app.vars.url + '/notifications/store', 'POST', params, target, null, _cb)
        })
    }
}