$(document).ready(function () {
    $(document).on("click", "#ok-button", function (event) {
         //event.preventDefault();
        delete_users($(this));
    });
    $(document).on("click", ".edit_user", function () {

        edit_user($(this));
    });
    $(document).on("click", ".update_user", function (event) {
        event.preventDefault();
        update_user();
    });

    $(document).on("click", ".deletion_straight", function (event) {
        event.preventDefault();
        delete_users($(this));
    });

    $(document).on("change", "#type", function () {
        //alert('Change');
        get_selection();
    });

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var user = button.attr("user_id");
        //alert(user);
        var modal = $(this);
        modal.find('.modal-footer a').attr('href', button.data('link'));
        modal.find('#ok-button').attr('user_id', user);
    });
});

function delete_users(element) {
    var id = element.attr("user_id");
    // alert("DELETE: " + id);
    $.ajax({// ajax call starts
        url: document_root + 'admin/users/delete',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            $("#dyn_content").html(data.view);
            notification("Se ha eliminado al usuario", "error", "top");
        }
    });

}

function edit_user(element) {
    var id = element.attr("user_id");
    //alert("EDIT: " + id);

    $.ajax({// ajax call starts
        url: document_root + 'admin/Users/edit',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            //console.log(data.view); 
            $("#dyn_content").html(data.view);
            get_selection();
        }
    });
}

function update_user() {
    var data = get_from_data();
    var u = $('#username').val();
    //alert("UPDATE: " + data.id);
    $.ajax({// ajax call starts
        url: document_root + 'admin/users/update',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            //console.log(data.status);
            $("#dyn_content").html(data.view);
            notification("Se ha actualizado el usuario " + u, "success", "top");
        }
    });
}


function get_from_data() {
    var id = $('#id').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var type = $('#type').val();
    var email = $('#email').val();
    var company = $('#company').val();
    var campaign = $('#campaign').val();
    var data = {id: id, username: username, password: password, type: type, company: company, campaign: campaign,email:email};
    //console.log(data);
    return data;

}


function get_selection() {
    var option = $("#type").val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/users/ajaxGetSelection',
        data: {opt: option},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            //console.log(data.view); 
            $("#extra_type").html(data.view);
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