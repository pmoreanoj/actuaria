$(document).ready(function() {
    init_switchs();
    init_listeners();
});

function init_listeners() {
    $(document).on("change", "#question_type", function() {
        var id = $(this).val();
        //alert(id);
        getQuestions(id);
    });
}
function getQuestions(id) {
    $.ajax({
        url: document_root + 'admin/Question/ajaxGetQuestionsByType',
        data: {question_type: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            $("#questions").html(response.view);
            init_switchs();
        }

    });
}
function init_switchs() {
    $('.switch-360').bootstrapSwitch(
            {
                size: 'mini',
                onColor: 'warning',
                onText: '360'
            }
    );
    $('.switch-360').on('switchChange.bootstrapSwitch', function(event, state) {
        var question = $(this).attr('question');
        //alert(question+" "+state);
        if (state) {
            saveChange(question, 'YES', null);
        }
        else {
            saveChange(question, 'NO', null);
        }
    });
    $('.switch-laboral').bootstrapSwitch(
            {
                size: 'mini',
                onText: 'Laboral'
            }
    );
    $('.switch-laboral').on('switchChange.bootstrapSwitch', function(event, state) {
        var question = $(this).attr('question');
        //alert(question+" "+state);
        if (state) {
            saveChange(question, null, 'YES');
        }
        else {
            saveChange(question, null, 'NO');
        }
    });
}


function saveChange(question, actuaria, work) {
    ajax_message('START');
    $.ajax({
        url: document_root + 'admin/Question/ajaxChangeDefault',
        data: {question: question, actuaria: actuaria, work: work},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            ajax_message('DONE');
            console.log(response.status);
        }

    });
}

function ajax_message(option) {
    if (option == 'START') {
        $('.ajax-message').html("Guardando...");
    }
    else if (option == 'DONE') {
        notification();
        $('.ajax-message').html("Guardado");
        setTimeout(function() {
            $('.ajax-message').html("");
        }, 3000);
    }
}

function notification() {
    var n = noty({
        layout: 'topRight',
        type: 'information',
        text: 'Guardado',
        closeWith: ['backdrop'],
        timeout: true,
        animation: {
            open: 'animated bounceInLeft', // Animate.css class names
            close: 'animated bounceOutLeft', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });
    
     setTimeout(function () {
            $.noty.close(n.options.id);
        }, 2000);
}