$(document).ready(function () {
//    $(document).on("click", ".upload_employee", function () {
//        upload_employee($(this));
//    });
    $
    $(document).on("click", ".delete_employee", function (event) {
        event.preventDefault();
        delete_employee($(this));
    });

});

function delete_employee(element){
    var id = element.attr('employee');

    $.ajax({// ajax call starts
        url: document_root + 'admin/employee/ajaxDelete',
        data: {employee: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            notification('Empleados Borrado', 'top', 'error');
            //$("#dyn_content").html(data.view);
            window.location = document_root+"admin/employee/campaignview?id="+data.campaign;
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
