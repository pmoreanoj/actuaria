$(document).ready(function() {
    //alert('AUTO-SURVEY SECTION');
    //form_validation();
    setup();
    //save_answers();
});

var count = 0;
var answers = {};
var campaign;
var evaluator;
var status = "HOLA";
//var total_answers = {};

function setup() {

    $(".save_answers").click(function() {
        //alert('Save');
        console.log(answers, campaign, evaluator, evaluated);
        campaign = $("#campaign_id").val();
        evaluator = $("#evaluator_id").val();
        evaluated = $("#evaluated_id").val();
        status = "INCOMPLETE";
        cheking_evaluations();
        save_answers(answers);
        notification("Todas sus preguntas han sido guardadas.", "top", "success");
    });

    $(".answer").click(function() {

        var value = $(this).val();
        var id = $(this).attr("name");
        campaign = $("#campaign_id").val();
        evaluator = $("#evaluator_id").val();
        evaluated = $("#evaluated_id").val();
        status = "INCOMPLETE";
        count += 1;

        answers[id] = value;

        if (count == 5) {
            save_answers(answers);
            cheking_evaluations();
            notification("Todas sus preguntas han sido guardadas.", "top", "success");
            $("#dyn_content").html(response.view);
            count = 0;
        }
    });
}

function save_answers(answers) {
    $.ajax({// ajax call starts
        url: document_root + 'Evaluations/savequestions',
        data: {answers: answers, campaign: campaign, evaluator: evaluator, evaluated: evaluated, status: status},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        //success: function(data) {
        success: function(response) {
            //}
            console.log(data);
            //alert("ANSWERS SAVED");
        }
    });
}

function cheking_evaluations(){
    
    var all_radioButtons = $(".answer").length;
    var all_radioButtonsChecked = $(".answer:checked").length;
    if(((all_radioButtons)/5) === all_radioButtonsChecked){
        status = 'COMPLETE';
    }
    else{
        status = 'INCOMPLETE';
    }
    
}

function notification(text, layout, type) {
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
    setTimeout(function() {
        $.noty.close(n.options.id);
    }, 3000);
}