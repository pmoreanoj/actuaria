$(document).ready(function() {
    $(document).on("click", ".upload_question", function() {
        upload_question($(this));
    });
    $(document).on("click", ".save_question", function() {
        alert("SAVING");
        save_question($(this));
    });
});

function upload_question(element) {
    var file_data = $('#data').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: document_root + 'admin/question/uploadcsvengine',
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
            //alert('DONE');
             notification('Las preguntas se han cargado','information','top');
            $("#csvData").html(response.view);
            console.log(response.data);
            //$("#dyn_content").getNiceScroll().resize();
            // Call resize whenever mouse
            $("#dyn_content").mouseover(function() {
                $("#dyn_content").getNiceScroll().resize();
            });
        }
    });
}

function save_question(element) {
    var file_data = $('#data').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: document_root + 'admin/question/savequestions',
        dataType: 'json', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
            //alert('SAVED');
            notification('Las preguntas se han guardado','success','top');
            $("#dyn_content").html(response.view);
            //console.log(response.data);
        }
    });
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

