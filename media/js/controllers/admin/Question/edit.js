$(document).ready(function () {
    init_switchs();
    $(document).on("click", "#sbt_update", function () {
        var data = get_data();
        ajax_message('START');
        update_question(data);
    });
});

function init_switchs() {
    $('.switch-360').bootstrapSwitch(
            {
                size: 'mini',
                onColor: 'warning',
                onText: '360'
            }
    );
    $('.switch-360').on('switchChange.bootstrapSwitch', function (event, state) {
        var question = $(this).attr('question');
    });
    $('.switch-laboral').bootstrapSwitch(
            {
                size: 'mini',
                onText: 'Laboral'
            }
    );
    $('.switch-laboral').on('switchChange.bootstrapSwitch', function (event, state) {
        var question = $(this).attr('question');
    });
}

function get_data() {
    var question = $('#question').val();
    var type = $('#type').val();
    var actuaria_360 = $(".switch-360").bootstrapSwitch('state');
    var work = $('.switch-laboral').bootstrapSwitch('state');
    var text = $('#text').val();

    if (actuaria_360) {
        actuaria_360 = 'YES';
    }
    else {
        actuaria_360 = 'NO';
    }
    if (work) {
        work = 'YES';
    }
    else {
        work = 'NO';
    }

    var data = {question: question, type: type, actuaria: actuaria_360, work: work, text: text};
    console.log(data);
    return data;
}

function update_question(data) {
    $.ajax({
        url: document_root + 'admin/Question/ajaxUpdateQuestion',
        data: data,
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            console.log(response.status);
            ajax_message('DONE');

            setTimeout(function () {
                ajax_message('CLEAN');
            }, 3000);

            $("#dyn_content").html(response.view);
            init_switchs();
            init_listeners();
        }

    });
}

function ajax_message(option) {
    if (option == 'START') {
        $('.ajax-message').html("Guardando...");
    }
    else if (option == 'DONE') {
        $('.ajax-message').html("Guardado");
        notification();
        setTimeout(function () {
            $('.ajax-message').html("");
        }, 3000);
    }
}

function notification() {
    var n = noty({
        layout: 'top',
        type: 'success',
        text: 'Guardado',
        closeWith: ['backdrop'],
        timeout: true,
        animation: {
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOut', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });

    setTimeout(function () {
        $.noty.close(n.options.id);
    }, 3000);
}

function init_listeners() {
    $(document).on("change", "#question_type", function () {
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
        success: function (response) {
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
    $('.switch-360').on('switchChange.bootstrapSwitch', function (event, state) {
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
    $('.switch-laboral').on('switchChange.bootstrapSwitch', function (event, state) {
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
        success: function (response) {
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
        setTimeout(function () {
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