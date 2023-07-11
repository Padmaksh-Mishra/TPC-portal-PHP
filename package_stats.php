<?php
require 'config.php';

$currentYear = date('Y');
$prefix = 'year_';
$tableName = $prefix . $currentYear; // concatenate prefix and date to create table name

$query = "SELECT c.name, AVG(y.SalaryPackage) AS avg_package
          FROM companies c
          JOIN $tableName y ON c.id = y.id
          GROUP BY c.name";
$result = mysqli_query($conn, $query);

// Create a data table for the chart
$table = array();
$table['cols'] = array(
    array('label' => 'Company', 'type' => 'string'),
    array('label' => 'Average Package', 'type' => 'number')
);
$rows = array();
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $avgPackage = (float) $row['avg_package'];
    $rows[] = array('c' => array(
        array('v' => $name),
        array('v' => $avgPackage)
    ));
}
$table['rows'] = $rows;

// Encode the data table as JSON
$jsonTable = json_encode($table);

// Print the chart with CSS styling
echo "<html><head>";
echo "<style>html, body { height: 100%; margin: 0; padding: 0; }</style>";
echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>";
echo "<script type='text/javascript'>";
echo "google.charts.load('current', {'packages':['corechart']});";
echo "google.charts.setOnLoadCallback(drawChart);";
echo "function drawChart() {";
echo "var data = new google.visualization.DataTable(" . $jsonTable . ");";
echo "var options = {'title':'Average Package provided by Companies this Season:', 'width':'100%', 'height':'100%'};";
echo "var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));";
echo "chart.draw(data, options);";
echo "}";
echo "</script></head><body>";
echo "<div id='chart_div' style='width: 100%; height: 100%;'></div>";
echo "</body></html>";
?>
