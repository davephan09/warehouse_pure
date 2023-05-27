var CategoryProductCreateClass = function () {
    var ele = {}
    
    this.run = function () {
        this.init()
        this.bindEvents()
    }

    this.init = function () {
        ele.categoryAddForm = $('#kt_ecommerce_add_category_form')
        ele.name = $('input[name="category_name"]')
        ele.status = $('#kt_ecommerce_add_category_status_select')
        ele.description = $('#description')
        ele.submitBtn = $('#kt_ecommerce_add_category_submit')
        ele.parentCat = $('#kt_ecommerce_add_category_store_template')
        ele.statusColor = $('#kt_ecommerce_add_category_status')
        ele.catId = $('#cat-id')
        ele.formSubmit = $('#kt_ecommerce_add_category_form')

        // loadData()
    }

    this.bindEvents = function () {
        drawContent()
        createCategory()
        changeStatus()
    }

    // var getParam = function () {
    //     var params = {

    //     }

    //     return params
    // }

    // var loadData = function (target) {
    //     var params = getParam()
    //     var _cb = function(rs) {
    //         var data = rs.data
    //         drawContent(data)
    //     }
    //     $.app.ajax($.app.vars.url + '/categories/product/get-data', 'GET', params, target, null, _cb)
    // }

    var drawContent = function () {
        ele.description.tinymce({
            height : "350",
            menubar : false,
            plugins : ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'],
            toolbar : "undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
            content_style : "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
        });
    }

    var createCategory = function () {
        ele.formSubmit.on('submit', function () {
            var target = ele.submitBtn
            var type = $(ele.submitBtn, $(this)).data('type')
            var params = {
                name : ele.name.val(),
                thumb : '',
                active : ele.status.val(),
                description : ele.description.val(),
                parent_id : ele.parentCat.val() === 'no_parent' ? null : ele.parentCat.val()
            }
            var _cb = function (rs) {
                if (rs.status) {
                    window.location.href = $.app.vars.url + '/categories/product/'
                } else {
                    $.app.pushNoty('error')
                }
            }
            if (type == 'create') {
                $.app.ajax($.app.vars.url + '/categories/product/store', 'POST', params, target, null, _cb)
            } else {
                params.id = ele.catId.val()
                $.app.ajax($.app.vars.url + '/categories/product/update', 'POST', params, target, null, _cb)
            }
        })
    }

    var changeStatus = function () {
        ele.status.on('change', function () {
            ele.statusColor.toggleClass('bg-success').toggleClass('bg-danger')
        })
    }
}