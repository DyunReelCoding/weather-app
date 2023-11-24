<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $apiKey = 'e1e6443d29e4889515fef857081b0b42';
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";

        $client = new Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        return view('weather', ['data' => $data]);
    }
}
