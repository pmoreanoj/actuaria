$(document).ready(function() {

    $('#default_password').hide();
    $(document).on("click", "#sbt_generate", function() {
        generate_users();
    });

    $(document).on("change", ".pass_type", function() {
        var type = $(this).val();
        if (type === 'default') {
            $('#default_password').show();
        }
        else {
            $('#default_password').hide();
        }
    });
});

function generate_users() {
    var campaign = $('#campaign').val();
    var default_password = $('#password').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/Users/ajaxGenerateUsersFromCampaign',
        data: {campaign: campaign,default_password:default_password},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            notification('Generadas las cuentas de usuario', 'top', 'success');
            $("#users").html(data.view);
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

    setTimeout(function() {
        $.noty.close(n.options.id);
    }, 3000);
}
