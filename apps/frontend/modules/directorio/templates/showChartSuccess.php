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

            data.addColumn('number', 'Recomendaciones');
            data.addColumn({type:'string', role:'tooltip'});

            data.addColumn('number', 'Desaprobaciones');
            data.addColumn({type:'string', role:'tooltip'});


            data.addRows(<?php echo json_encode($sf_data->getRaw('rows'))?>);

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, {
                title:'Cartas recibidas',
                legend:true,
                isStacked:true,
                height:300,
                width:800,
                colors:[ '#008000','#ff0000'],
                vAxis:{ 'max': 100, 'min': 10},
                chartArea:{left:25,top:10,width:"78%",height:"75%"},
                
            });
        }
    </script>
</head>

<body>
<!--Div that will hold the pie chart-->
<div id="chart_div" width="800px;" height="300px;"></div>
</body>
</html>
