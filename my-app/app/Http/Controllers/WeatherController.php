<?php

namespace App\Http\Controllers;

use App\Enum\City;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cityName = $request->input('city', 'Tokyo');
        try {
            $city = City::from($cityName);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $location = $city->getLocation();

        try {
            $weatherData = $this->weatherService->fetchWeatherData($location['latitude'], $location['longitude']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $cities = City::getAllCities();

        return view('weather.index', ['selectedCity' => $city, 'cities' => $cities, 'weatherData' => $weatherData]);
    }
}
