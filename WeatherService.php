<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5';
    }

    public function getWeather(float $lat, float $lng): array
    {
        $cacheKey = 'weather_' . app()->getLocale() . "_{$lat}_{$lng}";

        return Cache::remember($cacheKey, 3600, function () use ($lat, $lng) {
            $response = Http::timeout(5)->withOptions(['verify' => false])->get("{$this->baseUrl}/weather", [
                'lat' => $lat,
                'lon' => $lng,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => app()->getLocale(),
            ]);

            if (!$response->successful()) {
                return $this->getDefaultWeather();
            }

            $data = $response->json();

            return [
                'temperature' => round($data['main']['temp']),
                'humidity' => $data['main']['humidity'],
                'rain_probability' => $this->getRainProbability($data),
                'condition' => $this->getCondition($data['weather'][0]['id']),
                'description' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
                'location' => $data['name'],
                'last_updated' => now(),
            ];
        });
    }

    public function getForecast(float $lat, float $lng, int $days = 3): array
{
    $cacheKey = 'forecast_' . app()->getLocale() . "_{$lat}_{$lng}_{$days}";

    return Cache::remember($cacheKey, 3600, function () use ($lat, $lng, $days) {
        try {
            $response = Http::timeout(5)->withOptions(['verify' => false])->get("{$this->baseUrl}/forecast", [
                'lat' => $lat,
                'lon' => $lng,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'cnt' => $days * 8,
                'lang' => app()->getLocale(),
            ]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
            $forecast = [];

            foreach (array_slice($data['list'], 0, $days * 8) as $item) {
                $date = date('Y-m-d', $item['dt']);
                
                if (!isset($forecast[$date])) {
                    $forecast[$date] = [
                        'date' => $date,
                        'temp_max' => $item['main']['temp_max'],
                        'temp_min' => $item['main']['temp_min'],
                        'condition' => $this->getCondition($item['weather'][0]['id']),
                        'icon' => $item['weather'][0]['icon'],
                        'rain_probability' => $this->getRainProbability($item),
                    ];
                } else {
                    $forecast[$date]['temp_max'] = max($forecast[$date]['temp_max'], $item['main']['temp_max']);
                    $forecast[$date]['temp_min'] = min($forecast[$date]['temp_min'], $item['main']['temp_min']);
                }
            }

            return array_values($forecast);
        } catch (\Exception $e) {
            return [];
        }
    });
}

    public function getIrrigationRecommendation(array $weather): array
    {
        $temp = $weather['temperature'];
        $humidity = $weather['humidity'];
        $rainProb = $weather['rain_probability'];

        if ($rainProb > 50) {
            return [
                'type' => 'no_irrigation',
                'message_ar' => 'لا حاجة للري اليوم',
                'message_en' => 'No irrigation needed today',
                'icon' => '☔',
                'color' => 'blue',
            ];
        }

        if ($temp > 30) {
            return [
                'type' => 'increase',
                'message_ar' => 'كمية ري أعلى',
                'message_en' => 'Increase watering',
                'icon' => '🌡️',
                'color' => 'orange',
            ];
        }

        if ($humidity > 70) {
            return [
                'type' => 'reduce',
                'message_ar' => 'تقليل الري',
                'message_en' => 'Reduce watering',
                'icon' => '💧',
                'color' => 'green',
            ];
        }

        return [
            'type' => 'normal',
            'message_ar' => 'ري عادي',
            'message_en' => 'Normal irrigation',
            'icon' => '✓',
            'color' => 'gray',
        ];
    }

    protected function getRainProbability(array $data): int
    {
        if (isset($data['rain']) && isset($data['rain']['1h'])) {
            return min(100, $data['rain']['1h'] * 10);
        }

        if (isset($data['clouds'])) {
            return $data['clouds']['all'];
        }

        return 0;
    }

    protected function getCondition(int $weatherId): string
    {
        if ($weatherId >= 200 && $weatherId < 300) return 'thunderstorm';
        if ($weatherId >= 300 && $weatherId < 400) return 'drizzle';
        if ($weatherId >= 500 && $weatherId < 600) return 'rain';
        if ($weatherId >= 600 && $weatherId < 700) return 'snow';
        if ($weatherId >= 700 && $weatherId < 800) return 'mist';
        if ($weatherId === 800) return 'clear';
        if ($weatherId > 800) return 'cloudy';

        return 'unknown';
    }

    protected function getDefaultWeather(): array
    {
        return [
            'temperature' => 25,
            'humidity' => 50,
            'rain_probability' => 0,
            'condition' => 'clear',
            'description' => 'Clear sky',
            'icon' => '01d',
            'location' => 'Unknown',
            'last_updated' => now(),
        ];
    }

    public function getUserLocation(): array
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            if (isset($user->latitude) && isset($user->longitude)) {
                return [
                    'lat' => $user->latitude,
                    'lng' => $user->longitude,
                ];
            }
        }

        return [
            'lat' => 32.5556, // Irbid, Jordan
            'lng' => 35.8942,
        ];
    }
}
