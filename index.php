<?php
	
require 'vendor/autoload.php';
require 'helper.php';

$app = new \Slim\Slim();
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/ss/temperature/:value', function ($value) {
    //echo "Temperature value: $value °C";
    echo writeToDb('temperature', $value);
});

$app->post('/ss/lightsensor/:value', function ($value) {
    echo writeToDb('lightsensor', $value);
});

$app->run();