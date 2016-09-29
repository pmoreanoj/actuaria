var sendEmail = false;
$(document).ready(function () {
    init_listeners();
    init_modal();
});

function init_listeners() {
    $(document).on("click", ".sendButton", function (event) {
        //alert("SEND BUTTON");
        event.preventDefault();
        sendEmail = true;
    });
    //form-login

    $(document).on("submit", ".form-modal-login", function (event) {
        event.preventDefault();
        $(".sendButton").click();
    });
}
function init_modal() {
    $('#myModal').on('show.bs.modal', function (event) {
        sendEmail = false;
    });
    $('#myModal').on('hidden.bs.modal', function (event) {
        ///alert("Modal closed");
        if (sendEmail) {
            var email = $("#email").val();
            var username = $("#username").val();
            resetPassword(username,email);
        }
    });
}

function resetPassword(username,email) {
    $.ajax({// ajax call starts
        url: document_root + 'admin/email/ajaxResetPassword',
        data: {username:username,email: email},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            console.log(response.status);
            var status=response.status;
            
            if(status==="FOUND"){
               notification("Se ha enviado el correo para la constrase&ntilde;a", "success", "top"); 
            }
            else if(status==="NOT_FOUND"){
                notification("No se ha encontrado al usuario", "error", "top"); 
            }
        }
    });
}


function notification(text, type, layout) {
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
