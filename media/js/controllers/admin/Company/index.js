var deleteCompany = false;

$(document).ready(function () {

    $(document).on("click", ".delete_company", function (event) {
        event.preventDefault();
        delete_company($(this));
    });
    $(document).on("click", ".edit_company", function (event) {
        event.preventDefault();
        edit_company($(this));
    });
    $(document).on("click", ".update_company", function (event) {
        event.preventDefault();
        update_company();
    });


    $(document).on("click", "button.btn.btn-primary", function () {
        deleteCompany = true;
    });

    $(document).on("change", "#logo", function () {
        console.log('Upload LOGO');
        uploadTmpImage($("#logo"));
    });
    addModal();

});

function addModal() {
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var companyid = button.data('companyid');
        var modal = $(this);
        modal.find('#company-name').text(button.data('company'));
        $('button.btn.btn-primary').attr('company', companyid);

    });

    $('#myModal').on('hidden.bs.modal', function (event) {
        if (deleteCompany) {
            var okButton = $('button.btn.btn-primary');
            delete_company(okButton);
            deleteCompany = false;
        }
    });
}
function delete_company(element) {
    var id = element.attr("company");
    $.ajax({// ajax call starts
        url: document_root + 'admin/company/delete',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            $("#dyn_content").html(data.view);
            //alert("DELETED "+id);
            addModal();
            notification('Se ha eliminado la compa&ntilde;ia', 'error', 'top');
        }
    });
}

function edit_company(element) {
    var id = element.attr("id");
    $.ajax({// ajax call starts
        url: document_root + 'admin/company/edit',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            $("#dyn_content").html(data.view);
        }
    });
}

function update_company() {
    var data = get_from_data();
    // alert("UPDATE: " + data.id);
    $.ajax({// ajax call starts
        url: document_root + 'admin/company/update',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            //console.log(data.status);
            $("#dyn_content").html(data.view);
            addModal();
            notification('Se ha guardado los cambios', 'success', 'top');
            console.log('Updated');
        }
    });
}


function get_from_data() {
    var id = $('#id').val();
    var name = $('#name').val();
    var address = $('#address').val();
    var email = $('#email').val();
    var more = $("#more").val();
    var file = $("#file").val();

    var data = {id: id, name: name, address: address, email: email, more: more, file: file};
    console.log(data);
    return data;

}

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




