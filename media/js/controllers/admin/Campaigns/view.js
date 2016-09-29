// Load the Visualization API and the piechart package.

google.load('visualization', '1.0', {'packages': ['corechart']});
google.load("visualization", "1", {packages: ["treemap"]});
// Set a callback to run when the Google Visualization API is loaded.
//google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.

$(document).ready(function () {
    addListeners();
    getLevels();
    getQuestions();
    getProgress();
    getGender();
    getAreas();
});

function addListeners() {
    $(document).on("click", ".c-play", function (event) {
        event.preventDefault();
        //alert('played');
        changeStatus('IN_PROGRESS');
    });
    $(document).on("click", ".c-stop", function (event) {
        event.preventDefault();
        //alert('stopped');
        changeStatus('DONE');
    });
}

function changeStatus(status) {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/campaigns/ajaxChangeStatus',
        data: {campaign: campaign,status:status},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
          if(response.status=="OK"){
              //console.log("OK trigger");
              $("#c-status").html(response.new_status);
          }
          else if(response.status=="QUESTIONS"){
               alert("No se encuentran preguntas asignadas");
          }
          else if(response.status=="ACCOUNTS"){
              //console.log("Accounts trigger");
              alert("Se necesita crear cuentas para los empleados");
          }
        }
    });
}
function getLevels() {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/levels/ajaxGetLevelsCampaign',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            if (response.count == 0) {
                $('#levels_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawLevelsChart(response.data);
            }
        }
    });
}

function getAreas() {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/areas/ajaxGetAreasCampaign',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            //console.log(response.data);
            if (response.count == 0) {
                $('#areas_chart').html("<h2>0</h2>");
            }
            else {
                drawAreasChart(response.data);
            }
        }
    });
}

function getQuestions() {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/question/ajaxGetCampaignQuestions',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            if (response.count == 0) {
                $('#questions_chart').html('<div class="row data"><h1>0</h1></div>');
            }
            else {
                console.log(response.data);
                drawQuestionsChart(response.data, response.max);
            }
        }
    });
}

function getProgress() {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/assignations/ajaxGetProgress',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            if (response.count == 0) {
                $('#progress_chart').html("<a href="+document_root+"admin/Assignations?id="+campaign+">No existen asignaciones");
            }
            else {
                console.log(response.data);
                drawProgressChart(response.data);
            }


        }
    });
}

function getGender() {
    var campaign = $('#campaign').val();
    $.ajax({// ajax call starts
        url: document_root + 'admin/campaigns/ajaxGetGender',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function (response) {
            if (response.count == 0) {
                $('#gender_chart').html("<h2>0</h2>");
            }
            else {
                drawGenderChart(response.data);
            }
        }
    });
}
function drawLevelsChart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nivel');
    data.addColumn('number', 'Levels');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Niveles',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('levels_chart'));
    chart.draw(data, options);
}

function drawAreasChart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Area');
    data.addColumn('number', '');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Areas',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('areas_chart'));
    chart.draw(data, options);
}

function drawProgressChart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Progreso');
    data.addColumn('number', 'Encuestas');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Niveles',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('progress_chart'));
    chart.draw(data, options);
}

function drawQuestionsChart(rows, max) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nivel');
    data.addColumn('number', 'Preguntas');
    data.addRows(rows);
    var options = {
        title: "Preguntas",
        bar: {groupWidth: "90%"},
        legend: {position: "none"},
        colors: ['#f49b20'],
        hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}


    };
    var chart = new google.visualization.BarChart(document.getElementById("questions_chart"));
    chart.draw(data, options);

}

function drawGenderChart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Genero');
    data.addColumn('number', '');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('gender_chart'));
    chart.draw(data, options);
}