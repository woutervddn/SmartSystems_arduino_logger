<?php
	
require 'vendor/autoload.php';
require 'helper.php';

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/ss/dashboard', function () {
    // Displays the dashboard
    echo"<html><head><script type='text/javascript' src=\"https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}\"></script><script type='text/javascript'>google.setOnLoadCallback(drawCharts);";
    echo "function drawCharts() {";
    echo "var data = google.visualization.arrayToDataTable([['Time', 'Temperature Value'],";

	  $data = getFromDb('temperature');
	  $notFirst = false;
	  foreach($data as $key => $datapoint){
	  	if( $notFirst ){ echo ","; }
	  	$notFirst = true;
	  	echo "['" . $datapoint['timestamp'] . "', " . $datapoint['sensor_value'] . "]";
	  }
	echo "]);var options = {title: 'Temperature Sensor',curveType: 'function',legend: { position: 'bottom' }};var chart = new google.visualization.LineChart(document.getElementById('temp_chart'));chart.draw(data, options);";

	echo "var data = google.visualization.arrayToDataTable([['Time', 'Light Value'],";

	  $data = getFromDb('lichtsensor');
	  $notFirst = false;
	  foreach($data as $key => $datapoint){
	  	if( $notFirst ){ echo ","; }
	  	$notFirst = true;
	  	echo "['" . $datapoint['timestamp'] . "', " . $datapoint['sensor_value'] . "]";
	  }
	echo "]);var options = {title: 'Light Sensor',curveType: 'function',legend: { position: 'bottom' }};var chart = new google.visualization.LineChart(document.getElementById('licht_chart'));chart.draw(data, options);";
	
	echo "}</script></head>";
	echo "<body><div id='temp_chart' style='width: 900px; height: 500px'></div><br/><div id='licht_chart' style='width: 900px; height: 500px'></div></body></html>";


});

$app->post('/ss/temperature/:value', function ($value) {
    // Does some magic specifically for the temperature sensor.
    $temp = floatval ( intval($value) / 100 );
    echo writeToDb('temperature', $temp);
});

$app->post('/ss/:sensor/:value', function ($sensor, $value) {
    // Works for any sensor
    echo writeToDb($sensor, $value);
});

$app->run();