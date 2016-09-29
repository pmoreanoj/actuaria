$(document).ready(function () {
    $(document).on("click", "#button_save", function (event) {
        event.preventDefault();
        update_company();
    });

});


function update_company() {
    var data = get_from_data();
    $.ajax({// ajax call starts
        url: document_root + 'admin/Campaignsettings/update',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            $("#dyn_content").html(response.view);
            //console.log(response.view);
            notification("Se ha actualizado la configuraci&oacute;n de la campa&ntilde;a", "success","top");
        }
    });
}


function get_from_data() {
    var id = $('#id').val();
    var upper_level = $('#upper_level').val();
    var same_level = $('#same_level').val();
    var lower_level = $('#lower_level').val();
    var upper_level_weight = $('#upper_level_weight').val();
    var same_level_weight = $('#same_level_weight').val();
    var lower_level_weight = $('#lower_level_weight').val();

    var data = {
        id: id,
        upper_level: upper_level,
        same_level: same_level,
        lower_level: lower_level,
        upper_level_weight: upper_level_weight,
        same_level_weight: same_level_weight,
        lower_level_weight: lower_level_weight
    };
    console.log(data);
    return data;

}




function notification(text, type,layout) {
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

