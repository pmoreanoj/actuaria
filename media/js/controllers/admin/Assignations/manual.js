$(document).ready(function () {
    $(document).on("change", ".levels_selection", function () {
        var type = $(this).attr('type');
        if (type == "EVALUATED") {
            var area = $('.areas_evaluated').val();
            var level = $(this).val();
            get_employees(level, area, type);
        }
        else if (type == "EVALUATOR") {
            var area = $('.areas_evaluator').val();
            var level = $(this).val();
            get_employees(level, area, type);
        }

        //alert("Change "+type);
    });
    $(document).on("change", ".areas_selection", function () {
        var type = $(this).attr('type');
        if (type == "EVALUATED") {
            var level = $('.levels_evaluated').val();
            var area = $(this).val();
            get_employees(level, area, type);
        }
        else if (type == "EVALUATOR") {
            var level = $('.levels_evaluator').val();
            var area = $(this).val();
            get_employees(level, area, type);
        }
        
        //alert("Change "+area);
    });
    $(document).on("click", "#sbt_assignation", function () {
        do_assignment();
    });
});

function get_employees(level, area, type) {
    var campaign = $('#campaign').val();
    //alert(campaign);
    $.ajax({// ajax call starts
        url: document_root + 'admin/employee/employeebylevel',
        data: {campaign: campaign, level: level, area: area},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {
            if (type == 'EVALUATED') {
                $("#evaluated").html(data.view);
            }
            else if (type == 'EVALUATOR') {
                $("#evaluator").html(data.view);
            }

        }
    });
}

function do_assignment() {
    var evaluator = $("#evaluator .ui-selected").attr('employee');
    var evaluated = $("#evaluated .ui-selected").attr('employee');
    //alert('evaluator: '+evaluator+' & evaluated: '+evaluated);
    var campaign = $('#campaign').val();
    var action = 'MANUAL';
    $.ajax({// ajax call starts
        url: document_root + 'admin/assignations/ajaxAddAssignation',
        data: {campaign: campaign, evaluator: evaluator, evaluated: evaluated, action: action},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (data) {

            $("#dyn_content").html(data.view);
            notification("Se ha agregado la asignacion", "success", "top");

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