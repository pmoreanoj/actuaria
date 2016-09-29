$(document).ready(function() {
     $(document).on("click", "#button_update", function() {
        //update_level();
        console.log("update area");
     });
});


function update_level() {
    var data= get_from_data();
    //alert("EDIT: " + data.id);
    $.ajax({// ajax call starts
        url: document_root + 'admin/levels/update',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            notification('Se ha guardado el nivel', 'success','top');
            $("#dyn_content").html(response.view);
        }
    });
}

function get_from_data() {
    var id = $('#id').val();
    var name = $('#name').val();
    var level = $('#level').val();
    var data = {id: id, name: name, level: level};
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



