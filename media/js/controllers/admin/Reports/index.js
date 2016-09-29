// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages': ['corechart']});
//google.load("visualization", "1.1", {packages:["bar"]});
google.load("visualization", "1.1", {packages: ["bar"]});
google.load("visualization", "1", {packages: ["treemap"]});
// Set a callback to run when the Google Visualization API is loaded.
//google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.

$(document).ready(function() {
    //alert('Reportes');
    addAccordion();
    employeeSelected();
    getLevels();
    getAreas();
    getGenre();
    getAge();
    getIncome();
    getQuestion_t_per_level();
    getQuestion_t_per_area();
    getQuestion_t_per_gender();
    getQuestion_t_per_age();
    getAverage_perLevel();
    getAverage_perArea();
    getAverage_perAge();
    getAverage_perIncome();
    getIndividualLevel1Performance();
    getIndividualLevel2Performance();
    getIndividualLevel3Performance();
    getIndividualLevel4Performance();
    getIndividualLevel5Performance();
    //getQuestion_per_individual_performance();//no se si quieren de reporte
    //getQuestion_per_level_performance();//no se si quieren de reporte
    //getEmployeeReport();
});


var campaign = $('#campaign_id').val();
//var employee = $(".employee_selected").val();


function addAccordion() {
    $("#tabs").tabs();
}

//TAB #1
function getLevels() {

    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetLevels',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#levels_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawLevels_Chart(response.data);
            }
        }
    });
}
function drawLevels_Chart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nivel');
    data.addColumn('number', 'Level');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Niveles',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('levels_chart'));
    chart.draw(data, options);
}

function getAreas() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAreas',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#areas_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawAreas_Chart(response.data);
            }
        }
    });
}
function drawAreas_Chart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Áreas');
    data.addColumn('number', 'Áreas');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Áreas',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('areas_chart'));
    chart.draw(data, options);
}

function getGenre() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetGenre',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#genre_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawGenre_Chart(response.data);
            }
        }
    });
}
function drawGenre_Chart(rows) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'genre');
    data.addColumn('number', 'gender');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Género',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('genre_chart'));
    chart.draw(data, options);
}

function getAge() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAge',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#age_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawAge_Chart(response.data);
            }
        }
    });
}
function drawAge_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'age');
    data.addColumn('number', 'Puntaje');
    data.addRows(rows);

    /*var data = google.visualization.arrayToDataTable([
     ['Year', 'Sales', 'Expenses', 'Profit'],
     ['2014', 1000, 400, 200],
     ['2015', 1170, 460, 250],
     ['2016', 660, 1120, 300],
     ['2017', 1030, 540, 350]
     ]);*/  //Tengo que usar este formato

    // Set chart options
    var options = {
        'title': 'Edades',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('age_chart'));
    chart.draw(data, options);
}

function getIncome() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIncome',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#income_chart').html('<h5>No hay suficientes datos de salarios de los empleados para mostrar este\n\
                                         reporte.</h5>');
            }
            else {
                console.log(response.data);
                drawIncome_Chart(response.data);
            }
        }
    });
}
function drawIncome_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'income');
    data.addColumn('number', 'Puntaje');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Edades',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('income_chart'));
    chart.draw(data, options);
}

//TAB #2
function getQuestion_t_per_level() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionsTPerLevel',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#questions_per_level_chart').html('<h1>0</h1>');
            }
            else {

                //console.log(response.qt);
                console.log(response.data);
                drawQuestion_t_per_level_Chart(response.data);
            }
        }
    });
}
function drawQuestion_t_per_level_Chart(data) {

    // Create the data table.

    var data = google.visualization.arrayToDataTable(data);

    var options = {
        title: "Preguntas por Nivel",
                bar:{groupWidth: "60%"}
                //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}
        //width:700,
//var options = {
        //title: "Preguntas",
        // bar: {groupWidth: "90%"},
        //legend: {position: "none"},
        //colors: ['#f49b20'],
        //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}


    //};
        //chartArea:{left:150, top:10}//,width:"80%",height:"50%"},
        //bar: {groupWidth: "80%"}
        //legend: {position: "none"}
        //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}


    };

    var chart = new google.visualization.BarChart(document.getElementById('questions_per_level_chart'));
    chart.draw(data, options);

    // Instantiate and draw our chart, passing in some options.
    //var chart = new google.visualization.charts.Bar(document.getElementById('questions_per_level_chart'));
    //chart.draw(data, options);
}

function getQuestion_t_per_area() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionsTPerArea',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#questions_per_area_chart').html('<h1>0</h1>');
            }
            else {

                //console.log(response.qt);
                console.log(response.data);
                drawQuestion_t_per_area_Chart(response.data);
            }
        }
    });
}
function drawQuestion_t_per_area_Chart(data) {
    // Create the data table.
    var data = google.visualization.arrayToDataTable(data);

    var options = {
        title: "Preguntas por Área",
        //width:700,
        //chartArea:{left:150, top:10}//,width:"80%",height:"50%"},
        //bar: {groupWidth: "80%"}
        //legend: {position: "none"}
        //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}


    };

    var chart = new google.visualization.BarChart(document.getElementById('questions_per_area_chart'));
    ;
    chart.draw(data, options);

    // Instantiate and draw our chart, passing in some options.
    //var chart = new google.visualization.charts.Bar(document.getElementById('questions_per_level_chart'));
    //chart.draw(data, options);
}

function getQuestion_t_per_gender() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerGender',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#questions_per_gender_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawQuestion_t_per_gender_Chart(response.data);
            }
        }
    });
}
function drawQuestion_t_per_gender_Chart(data) {
    // Create the data table.
    var data = google.visualization.arrayToDataTable(data);

    var options = {
        title: "Preguntas por Género",
        //width:700,
        //chartArea:{left:150, top:10}//,width:"80%",height:"50%"},
        //bar: {groupWidth: "80%"}
        //legend: {position: "none"}
        //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}


    };

    var chart = new google.visualization.BarChart(document.getElementById('questions_per_gender_chart'));
    ;
    chart.draw(data, options);
}

function getQuestion_t_per_age() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerAge',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#questions_per_age_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawQuestion_t_per_age_Chart(response.data);
            }
        }
    });
}
function drawQuestion_t_per_age_Chart(data) {
    // Create the data table.
    var data = google.visualization.arrayToDataTable(data);

    var options = {
        title: "Preguntas por Edad",
        //width:700,
        //chartArea:{left:150, top:10}//,width:"80%",height:"50%"},
        //bar: {groupWidth: "80%"}
        //legend: {position: "none"}
        //hAxis: {minValue: 0, format: '0', gridlines: {count: max + 1}}
    };

    var chart = new google.visualization.BarChart(document.getElementById('questions_per_age_chart'));
    ;
    chart.draw(data, options);

    // Instantiate and draw our chart, passing in some options.
    //var chart = new google.visualization.charts.Bar(document.getElementById('questions_per_level_chart'));
    //chart.draw(data, options);
}

function getAverage_perLevel() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAveragePerLevel',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#average_per_level').html('<h5>No se ha calificado a por lo menos un empleado de cada nivel\n\
                                                de la empresa.</h5>');
            }
            else {
                console.log(response.data);
                drawAverage_perLevel_Chart(response.data);
            }
        }
    });
}
function drawAverage_perLevel_Chart(rows) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nivel');
    data.addColumn('number', 'Level');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Niveles',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('average_per_level'));
    chart.draw(data, options);
}

function getAverage_perArea() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAveragePerArea',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#average_per_area').html('<h5>No se ha calificado a por lo menos un empleado de cada área.</h5>');
            }
            else {
                console.log(response.data);
                drawAverage_perArea_Chart(response.data);
            }
        }
    });
}
function drawAverage_perArea_Chart(rows) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Area');
    data.addColumn('number', 'Area');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Areas',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('#average_per_area'));
    chart.draw(data, options);
}

function getAverage_perAge() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAveragePerAge',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#average_per_age').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawAverage_perAge_Chart(response.data);
            }
        }
    });
}
function drawAverage_perAge_Chart(rows) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Edades');
    data.addColumn('number', 'Age');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Edades',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('average_per_age'));
    chart.draw(data, options);
}

function getAverage_perIncome() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetAveragePerIncome',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#average_per_income').html('<h5>No se tienen datos de los salarios de los empleados.</h5>');
            }
            else {
                console.log(response.data);
                drawAverage_perIncome_Chart(response.data);
            }
        }
    });
}
function drawAverage_perIncome_Chart(rows) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Nivel');
    data.addColumn('number', 'Level');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Niveles',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('average_per_income'));
    chart.draw(data, options);
}

//TAB 3
function getIndividualLevel1Performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIndividualLevel1Performance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level1_performance_chart').html('<h5>No todos los empleados de Nivel 1 han sido calificados\n\
                                                        para poder mostrar los reportes.</h5>');
            }
            else if (response.data === NULL) {
                $('#level1_performance_chart').html('<h1>Faltan datos para mostrar reporte.</h1>');
            }
            else {
                console.log(response.data);
                drawLevel1Performance_Chart(response.data);
            }
        }
    });
}
function drawLevel1Performance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleados Nivel 1');
    data.addColumn('number', 'Nivel 1');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados Nivel 1',
        //backgroundColor: {fill: 'transparent'},
        //is3D: true
        //'width': 600,
        //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level1_performance_chart'));
    chart.draw(data, options);
}

function getIndividualLevel2Performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIndividualLevel2Performance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level2_performance_chart').html('<h5>No todos los empleados de Nivel 2 han sido calificados\n\
                                                        para poder mostrar los reportes.</h5>');
            }
            else {
                console.log(response.data);
                drawLevel2Performance_Chart(response.data);
            }
        }
    });
}
function drawLevel2Performance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleados');
    data.addColumn('number', 'Nivel 2');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados Nivel 2',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 600,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level2_performance_chart'));
    chart.draw(data, options);
}

function getIndividualLevel3Performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIndividualLevel3Performance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level3_performance_chart').html('<h5>No todos los empleados de Nivel 3 han sido calificados\n\
                                                        para poder mostrar los reportes.</h5>');
            }
            else {
                console.log(response.data);
                drawLevel3Performance_Chart(response.data);
            }
        }
    });
}
function drawLevel3Performance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleados Nivel 3');
    data.addColumn('number', 'Nivel 2');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados Nivel 3',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 600,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level3_performance_chart'));
    chart.draw(data, options);
}

function getIndividualLevel4Performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIndividualLevel4Performance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level4_performance_chart').html('<h5>No todos los empleados de Nivel 4 han sido calificados\n\
                                                        para poder mostrar los reportes.</h5>');
            }
            else {
                console.log(response.data);
                drawLevel4Performance_Chart(response.data);
            }
        }
    });
}
function drawLevel4Performance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleados Nivel 4');
    data.addColumn('number', 'Nivel 4');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados Nivel 4',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 600,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level4_performance_chart'));
    chart.draw(data, options);
}

function getIndividualLevel5Performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetIndividualLevel5Performance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level5_performance_chart').html('<h5>No todos los empleados de Nivel 5 han sido calificados\n\
                                                        para poder mostrar los reportes.</h5>');
            }
            else {
                console.log(response.data);
                drawLevel5Performance_Chart(response.data);
            }
        }
    });
}
function drawLevel5Performance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleados Nivel 5');
    data.addColumn('number', 'Nivel 5');
    data.addRows(rows);

    // Set chart options
    var options = {
        'title': 'Empleados Nivel 5',
        //backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 600,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level5_performance_chart'));
    chart.draw(data, options);
}

function getQuestion_per_individual_performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerIndividualPerformance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#individual_performance_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawIndividualPerformance_Chart(response.data);
            }
        }
    });
}
function drawIndividualPerformance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'genre');
    data.addColumn('number', 'gender');
    data.addRows(rows);

    /*var data = google.visualization.arrayToDataTable([
     ['Year', 'Sales', 'Expenses', 'Profit'],
     ['2014', 1000, 400, 200],
     ['2015', 1170, 460, 250],
     ['2016', 660, 1120, 300],
     ['2017', 1030, 540, 350]
     ]);*/  //Tengo que usar este formato

    // Set chart options
    var options = {
        'title': 'GÃ©nero de los empleados',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.LineChart(document.getElementById('individual_performance_chart'));
    chart.draw(data, options);
}

function getQuestion_per_level_performance() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerLevelPerformance',
        data: {campaign: campaign},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#level_performance_chart').html('<h1>0</h1>');
            }
            else {
                console.log(response.data);
                drawLevelPerformance_Chart(response.data);
            }
        }
    });
}
function drawLevelPerformance_Chart(rows) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'genre');
    data.addColumn('number', 'Niveles');
    data.addRows(rows);

    /*var data = google.visualization.arrayToDataTable([
     ['Year', 'Sales', 'Expenses', 'Profit'],
     ['2014', 1000, 400, 200],
     ['2015', 1170, 460, 250],
     ['2016', 660, 1120, 300],
     ['2017', 1030, 540, 350]
     ]);*/  //Tengo que usar este formato

    // Set chart options
    var options = {
        'title': 'DesempeÃ±o por niveles (todas las preguntas)',
        backgroundColor: {fill: 'transparent'},
        is3D: true
                //'width': 400,
                //'height': 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('level_performance_chart'));
    chart.draw(data, options);
}

//TAB #4

function employeeSelected() {
    //alert("HOLA");
    
    $(document).on("change", "#employee", function() {
        //alert("change");
        var employee = $("#employee").val();
        alert(employee);
        getEmployeeReport(employee);

        /*$.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerSingleEmployee',
        data: {campaign: campaign, employee: employee},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.count == 0) {
                $('#singleEmployee').html('<p>0</p>');
            }
            else {
                console.log(response.data);
                getEmployeeReport(response.data);
            }
        }
    });*/
        //getEmployeeReport();
    });
}

function getEmployeeReport(employee){
    $.ajax({// ajax call starts
        url: document_root + 'admin/reports/ajaxGetQuestionPerSingleEmployee',
        data: {campaign: campaign, employee: employee},
        method: "POST",
        dataType: 'json', // Choosing a JSON datatype
        success: function(response) {
            if (response.rows == 0) {
                $('#canvas').html('<h1>0</h1>');
                console.log(response.rows, response.data);
            }
            else {
                //console.log(response.data);
                drawEmployeeReport(response.data, response.rows);
            }
        }
    });
}

function drawEmployeeReport(data, rows) {
    
    //var mydata = JSON.parse(rows);
    //var radarChartData = {[rows]};
    //data.addColumn('string', 'genre');
    //data.addColumn('number', 'Niveles');
    //data.addRows(rows);
    console.log(rows);
    var radarChartData = {
        labels: rows,
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,100,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fef",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: data
            }
            /*
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }*/
        ]
    };
    var myRadar = new Chart(document.getElementById("canvas").getContext("2d")).Radar(radarChartData, {
        responsive: true
    });
}