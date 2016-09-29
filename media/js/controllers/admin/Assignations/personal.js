$(document).ready(function() {
    $(document).on("change", ".levels_selection", function() {
        var type = $('#types').attr('type');
        var area=$('.areas_selection').val();
        var level = $(this).val();
        get_employees(level,area, type);
        //alert("Change "+type);
    });
    
    $(document).on("change", ".areas_selection", function() {
        var level=$('.levels_selection').val();
        var type = $('#types').attr('type');
        var area = $(this).val();
        get_employees(level,area, type);
        //alert("Change "+area);
    });
    $(document).on("click", "#sbt_assignation", function() {
        do_assignment();
    });
    //delete_assignation
    $(document).on("click", ".delete_assignation", function() {
        //alert('DELETE');
        var id=$(this).attr('assignation');
        delete_assignation(id);
    });
});

function get_employees(level,area) {
    var campaign = $('#campaign').val();
    //alert(campaign);
    $.ajax({// ajax call starts
        url: document_root + 'admin/employee/employeebylevel',
        data: {campaign: campaign, level: level,area:area},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {

            $("#employees").html(data.view);



        }
    });
}

function do_assignment() {
    var type = $('#types').val();
    var campaign = $('#campaign').val();
    var employee = $('#employee').val();
    var action = 'PERSONAL';
    if (type == 'EVALUATOR') {
        var evaluator = $("#employee").val();
        var evaluated = $("#employees .ui-selected").attr('employee');
       // alert('evaluator: ' + evaluator + ' & evaluated: ' + evaluated);
    }
    else if (type == 'EVALUATED') {
        var evaluated = $("#employee").val();
        var evaluator = $("#employees .ui-selected").attr('employee');
       // alert('evaluator: ' + evaluator + ' & evaluated: ' + evaluated);
    }

    $.ajax({// ajax call starts
        url: document_root + 'admin/assignations/ajaxAddAssignation',
        data: {campaign: campaign,employee:employee ,evaluator: evaluator, evaluated: evaluated, action: action},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            $("#dyn_content").html(data.view);
            notification("Se ha agregado la asignacion", "success", "top");
        }
    });
}

function delete_assignation(id){
   var action='PERSONAL';
   var employee = $('#employee').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/assignations/ajaxDeleteAssignation',
        data: {id:id, action: action,employee:employee},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(data) {
            $("#dyn_content").html(data.view);
            notification("Se ha borrado la asignacion", "error", "top");
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
