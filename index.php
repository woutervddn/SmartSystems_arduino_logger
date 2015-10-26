<?php
	
require 'vendor/autoload.php';
require 'helper.php';

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/ss/temperature/:value', function ($value) {
    //echo "Temperature value: $value °C";
    $temp = floatval ( intval($value) / 100 );
    echo writeToDb('temperature', $temp);
});

$app->post('/ss/:sensor/:value', function ($sensor, $value) {
    //echo "Temperature value: $value °C";
    echo writeToDb($sensor, $value);
});

$app->run();