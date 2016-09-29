$(document).ready(function() {
    $(document).on("change", "#questionType", function() {
        var id = $(this).val();
        get_questions(id);
    });
    $(document).on("click", "#button_add", function() {
        var question = $(".ui-selected").attr("question");
        var level = $("#levels").val();
        var campaign = $("#campaign").val();
        var question_type=$("#questionType").val();;
        if (question) {
            saveQuestions(question,question_type ,level, campaign);
            console.log("question " + question + " level " + level + " campaign " + campaign);
        }
        else {
            alert("Seleccione la pregunta");
            console.log("NO_QUESTION_SELECTED");
        }
    });

    $(document).on("click", ".button_remove", function() {
        var id = $(this).attr("remove");
        //alert("Remove "+id);
        removeQuestion(id);
    });

    $(document).on("click", ".button_edit", function() {
        var id = $(this).attr("edit");
        get_questionsText(id);

    });

    $(document).on("click", "#sbt_edit", function() {
        var id = $(this).attr('question');
        edit_questionText(id);
    });
    
    $(document).on("click", "#sbt_reset", function() {
        var id = $(this).attr('question');
        reset_questionText(id);
    });

    addAccordion();

    $("#dialog").dialog({
        autoOpen: false,
        show: {
            effect: "blind",
            duration: 1000
        },
        width: 600
    });
});

function get_questions(id) {
    var campaign = $("#campaign").val();
    $.ajax({
        url: document_root + 'admin/Questiontype/getTypesAjax',
        data: {id: id, campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            //alert("Loaded");
            $("#questions").html(response.view);
            //$("#selectable").selectable();
        }
    })
            .done(function() {
                $("#selectable").selectable({
                    selecting: function(event, ui) {
                        if ($("#evaluator .ui-selected, .ui-selecting").length > 1) {
                            $(ui.selecting).removeClass("ui-selecting");
                        }
                    }
                });
                //alert("Saved");
            });
}

function saveQuestions(question, question_type ,level, campaign) {
    $.ajax({
        url: document_root + 'admin/Question/addQuestionToCampaign',
        data: {question: question, question_type:question_type ,level: level, campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
           notification('Pregunta Guardada','top','success');
            $("#savedQuestions").html(response.view);
            addAccordion();
        }

    });
}

function removeQuestion(id) {
    $.ajax({
        url: document_root + 'admin/Question/removeQuestionFromCampaign',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
           notification('Pregunta Eliminada','top','error');
            $("#savedQuestions").html(response.view);
            addAccordion();
        }

    });

}

function addAccordion() {
    $("#tabs").tabs();
}

function edit_questionText(id) {
    var text = $('#new_text').val();
    $.ajax({
        url: document_root + 'admin/Question/ajaxQuestionPersonalized',
        data: {id: id, text: text},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            notification('Pregunta Editada','top','information');
            $("#savedQuestions").html(response.questions);
            addAccordion();    
        }
    });
    $("#dialog").dialog('close');
}

function reset_questionText(id) {
    $.ajax({
        url: document_root + 'admin/Question/ajaxQuestionPersonalizedReset',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
           notification('Pregunta Restablecida','top','warning');
            $("#savedQuestions").html(response.questions);
            addAccordion();    
        }
    });
    $("#dialog").dialog('close');
}

function get_questionsText(id) {
    $.ajax({
        url: document_root + 'admin/Question/ajaxQuestionText',
        data: {id: id},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            var text = response.text;
            //alert(text);
            $('#dialog').html(text);
            $("#dialog").dialog("open");
        }

    });

}

function notification(text,layout,type) {
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