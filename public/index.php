<?php

use PhpTest\Controller\WeatherController;

require __DIR__ . '/../vendor/autoload.php';

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $params = [
        'name'      => trim($_GET['name'] ?? ''),
        'id'        => trim($_GET['id'] ?? ''),
        'latitude'  => trim($_GET['latitude'] ?? ''),
        'longitude' => trim($_GET['longitude'] ?? '')
    ];

    $isNameProvided     = !empty($params['name']);
    $isIdProvided       = !empty($params['id']);
    $isLatitudeProvided = !empty($params['latitude']);
    $isLongitudeProvided = !empty($params['longitude']);

    if ($isNameProvided || $isIdProvided || ($isLatitudeProvided && $isLongitudeProvided)) {
        $controller = new WeatherController();
        $result = $controller->apiWeather($params);
    } else {
        $result = ['error' => 'Please provide either a city name, city ID, or both latitude and longitude.'];
    }
}

include '../view/weather.tpl.php';