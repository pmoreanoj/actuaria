$(document).ready(function () {
//    $(document).on("click", ".upload_employee", function () {
//        upload_employee($(this));
//    });
    $(document).on("change", "#data", function (event) {
        event.preventDefault();
        upload_employee();
    });
    $(document).on("click", ".save_employee", function (event) {
        event.preventDefault();
        save_employee($(this));
    });
    $(document).on("click", ".delete_employee", function (event) {
        event.preventDefault();
        delete_employee($(this));
    });

});

function upload_employee() {
    var id = $('#id').val();
    var file_data = $('#data').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: document_root + 'admin/employee/employees?campaign=' + id,
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            //alert('Datos: ' + response.length);
            notification('Se han cargado los empleados', 'top', 'information');
            $("#csvData").html(response.view);
            console.log(response.data);
            //$("#dyn_content").html(data.view);
        }
    });
}

function save_employee(element) {
    var id = $('#id').val();
    var file_data = $('#data').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: document_root + 'admin/employee/saveEmployees?campaign=' + id,
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            $("#dyn_content").html(response.view);
            notification('Se han guardado los empleados', 'top', 'success');
            //console.log(response.data);
        }
    });
}

function delete_employee(element) {
    var id = $('#id').val();

    $.ajax({// ajax call starts
        url: document_root + 'admin/employee/deleteEmployees?id=' + id,
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            notification('Empleados Borrados', 'top', 'error');
            $("#dyn_content").html(data.view);
        }
    });
}

function notification(text, layout, type) {
    var n = noty({
        layout: layout,
        type: type,
        text: text,
        closeWith: ['backdrop'],
        timeout: true,
        animation: {
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOutUp', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });

    setTimeout(function () {
        $.noty.close(n.options.id);
    }, 3000);
}
