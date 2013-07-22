<?php use_helper('Date'); ?>
<html>
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

        // Load the Visualization API and the piechart package.
        google.load('visualization', '1.0', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.setOnLoadCallback(drawChart);


        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Meses');

            data.addColumn('number', 'Sin medalla');
            data.addColumn({type:'string', role:'tooltip'});

            data.addColumn('number', 'Bronce');
            data.addColumn({type:'string', role:'tooltip'});

            data.addColumn('number', 'Plata');
            data.addColumn({type:'string', role:'tooltip'});

            data.addColumn('number', 'Oro');
            data.addColumn({type:'string', role:'tooltip'});

            data.addRows(<?php echo json_encode($sf_data->getRaw('rows'))?>);

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, {
                title:'Evolución de la excelencia',
                legend:true,
                isStacked:true,
                height:300,
                width:800,
                colors:[ '#429D29','#B41B1D','#BEC1C4','#F65E13'],
                vAxis:{ textPosition:'none' }
            });
        }
    </script>
</head>

<body>
<!--Div that will hold the pie chart-->
<div id="chart_div"></div>
</body>
</html>
