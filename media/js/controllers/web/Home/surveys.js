$(document).ready(function() {
    alert('SURVEY SECTION');
    form_validation();
});

function submit_form_text() {
    var question1 = $('input:radio[name=question1]:checked').val();

    var postData = {question1: question1};

    var request = $.ajax({
        url: document_root + 'home/surveys',
        data: postData,
        type: "post",
        dataType: 'json',
    });
    // callback handler that will be called on success

    request.done(function(response, textStatus, jqXHR) {
        if (response.success == 'BAD') {
            alert('Error: ' + response.error);
        }
    });

    // callback handler that will be called on failure
    request.fail(function(jqXHR, textStatus, errorThrown) {
        // log the error to the console
        console.error(
                "The following error occured: " +
                textStatus, errorThrown
                );
    });

    // callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function() {
        window.location.href = document_root + 'home/index';
        // reenable the inputs
        //$inputs.prop("disabled", false);
    });
}

function form_validation() {
    $('#clothes-validation').validate({
        rules: {
            question1: {
                required: true
            },
            type: {
                required: true
            },
            highlight: function(element) {
                $(element).closest('.input-prepend').removeClass('success').text('Ingrese al menos 3 caracteres');
            },
            success: function(element) {
                element
                        .text('OK!').addClass('valid')
                        .closest('.span').removeClass('error').addClass('success');
            }
        }
    });
    $("#survey-validation").on('submit', function(e) {
        var isvalidate = $("#survey-validation").valid();
        //var image = $('#image_src').val();
        if ((isvalidate))
        {
            e.preventDefault();
            submit_form_text();
        }
    });
}