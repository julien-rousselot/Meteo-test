<?php

namespace PhpTest\Controller;

class WeatherController
{
    private string $apiKey;
    private string $apiUrl;

    /**
     * WeatherController constructor
     * 
     * @param string $apiKey API key for accessing OpenWeatherMap services
     * @param string $apiUrl Base URL for the OpenWeatherMap API
     */
    public function __construct(string $apiKey = OPENWEATHER_API_KEY, string $apiUrl = 'https://api.openweathermap.org/data/2.5/')
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Find the weather data on the given parameters
     * 
     * @param array $params Request parameters (city name, city ID, latitude, longitude)
     * @return array Weather data or error message
     */
    public function apiWeather(array $params): array
    {
        if (!empty($params['name'])) {
            $url = $this->apiUrl . "weather?q=" . urlencode($params['name']) . "&appid=" . $this->apiKey . "&units=metric";
        } elseif (!empty($params['id'])) {
            $url = $this->apiUrl . "weather?id=" . urlencode($params['id']) . "&appid=" . $this->apiKey . "&units=metric";
        } elseif (!empty($params['latitude']) && !empty($params['longitude'])) {
            $url = $this->apiUrl . "weather?lat=" . urlencode($params['latitude']) . "&lon=" . urlencode($params['longitude']) . "&appid=" . $this->apiKey . "&units=metric";
        } else {
            return ['error' => 'Please provide either a city name, city ID, or both latitude and longitude.'];
        }

        $data = @file_get_contents($url);

        if ($data === FALSE) {
            return ['error' => 'Result not found.'];
        }

        $result = json_decode($data, true);

        return $result;
    }
}
