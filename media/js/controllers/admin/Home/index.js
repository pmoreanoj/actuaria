google.load("visualization", "1", {packages:["gauge"]});

$(document).ready(function () {
  //drawCompaniesGauge();

});


function getCompanies() {
    $.ajax({// ajax call starts
        url: document_root + 'admin/company/ajaxGetCompany',
        data: {},
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

function drawCompaniesGauge(){
    
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80]
        ]);

        var options = {
          //width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('company_chart'));

        chart.draw(data, options);
}