<?php
namespace App\Helpers;

use App\Exceptions\ResponseException;
use Illuminate\Support\Facades\Http;

class Utils
{
    public const APP_PRAMA = 'SmartGarden_Prama';
    public const APP_SHAKIRA = 'SmartGarden_Shakira';
    public const APP_001 = 'SmartGarden_001';
    protected $filter = '?fu=1&drt=2&ty=4&cra=%s&crb=%s';

    protected $ghseet_url = "https://sheets.googleapis.com/v4/spreadsheets/1HA_cEF1nFvYXGo3DpZltPS9cwKaf5Y-7ZAcQPk3bYGs/values/%s?key=AIzaSyDVjLYR5-GzqyUdQ440QWL6pE8SyXc52ds";

    // public function __construct(protected Client $client)
    // {

    // }

    public function getPrediksiSheet()
    {
        try {
            $url = sprintf($this->ghseet_url, "forecasting!A2:C5");

            $response = Http::withOptions([
                'verify' => false,
            ])->get($url)
            ->json();

        $data = collect($response['values'])->map(function($item) {
            return [
                'quality' => $item[0],
                'suggestion' => $item[1],
                'percentage' => $item[2],
            ];
            })->first();
            
            return $data;
        } catch (\Throwable $th) {
            throw new \Exception("error_data");
        }
    }

    public function getGoogleSheet()
    {
        try {
            $url = sprintf($this->ghseet_url, "Sensor_cuaca!A2:E2");

            $response = Http::withOptions([
                    'verify' => false,
                ])->get($url)
                ->json();

            $data = collect($response['values'])->map(function($item) {
                return [
                    'lux' => $item[2],
                    'temperature' => $item[3],
                    'humidity' => $item[4],
                ];
                })->first();

            return $data;
        } catch (\Throwable $th) {
            throw new \Exception("error_data");
        }
    }

    public function getDataFromDevice(string $device_name, string $start_date, string $end_date)
    {
        try {
            $uri = env('ANTARES_URL') . '/' . $device_name;
            $filter = sprintf($this->filter, $start_date, $end_date);

            $response = Http::withHeaders([
                    'X-M2m-Origin' => env('ANTARES_KEY'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])->withOptions([
                    'verify' => false,
                ])->get($uri . $filter)
                ->json();
            
            if (count($response) > 0) {
                return $response['m2m:list'];
            }

        } catch (\Throwable $th) {
            //
        }
        
        return [];
    }

    public function postDataToDevice(string $device_name, array $payload) 
    {
        $uri = env('ANTARES_URL') . '/' . $device_name;
        $response = Http::withHeaders([
                'X-M2m-Origin' => env('ANTARES_KEY'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json;ty=4',
                'X-ANTARES-NOTIFY-MQTT' => '1',
            ])->withOptions([
                'verify' => false,
            ])->post($uri, $payload);
        
        if ($response->successful() || $response->status() == 201) {
            return true;
        }

        throw \Exception('gagal');
    }
}
