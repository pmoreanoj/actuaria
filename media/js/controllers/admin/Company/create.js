$(document).ready(function () {
    $(document).on("change", "#logo", function () {
        console.log('Upload LOGO');
        uploadTmpImage($("#logo"));
    });
});

function uploadTmpImage(element) {
    var formData = new FormData();
    formData.append('logo', $('input[type=file]')[0].files[0]);
    $.ajax({
        url: document_root + 'admin/company/uploadTmpImage',
        type: "POST", // Type of request to be send, called as method
        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        dataType: 'json',
        success: function (data)   // A function to be called if request succeeds
        {
           var status = data.status;
           
            if (status == 'OK') {
                //console.log(data.tmp);
                $('#file').val(data.tmp);
                $('#logo-container').html(data.view);
            }
            else if(status == 'FORMAT'){
                notification('No se recibi&oacute; una foto formato jpg, jpeg o png','error','top');
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