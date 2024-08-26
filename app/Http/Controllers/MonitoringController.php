<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Http\Requests\GetDataRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function __construct(protected Utils $helper)
    {
        //
    }

    public function index(Request $request)
    {
        try {
            $data = $this->helper->getGoogleSheet();
            $temp = $data['temperature'];
            $lux = $data['lux'];
            $humidity = $data['humidity'];
            if ($lux > 50000 && $temp > 30 && $temp < 40) {
                $data['weather'] = "Cerah";
                $data['weather_icon'] = "sun";
            } else if ($lux > 20000 && $temp > 20 && $temp <= 30 && $humidity >= 30 && $humidity < 60) {
                $data['weather'] = "Berawan";
                $data['weather_icon'] = "cloud-wind";
            } else if ($lux <= 20000 && $temp <= 20 && $humidity >= 60) {
                $data['weather'] = "Hujan";
                $data['weather_icon'] = "cloud-showers-heavy";
            } else {
                $data['weather'] = "Lain-lain";
                $data['weather_icon'] = "x";
            }
        } catch (\Throwable $th) {
            $data = [
                'lux' => '-',
                'temperature' => '-',
                'humidity' => '-',
                'weather' => '-',
                'weather_icon' => '-',
            ];
        }

        // =IF(AND(C8451>50000, D8451>30, E8451<40), "Cerah", 
        // IF(AND(C8451>20000, C8451<=50000, D8451>20, D8451<=30, E8451>=30, E8451<60), "Berawan", 
        // IF(AND(C8451<=20000, D8451<=20, E8451>=60), "Hujan", "Lain-lain")))

        return view('monitoring', ['data' => $data]);
    }

    public function getDeviceData(GetDataRequest $request)
    {
        try{
            $payload = $request->validated();
            $start = Carbon::parse($payload['date'])->startOfDay();
            $end = Carbon::parse($payload['date'])->endOfDay();
            $start_date = $start->format('Ymd') . "T" . $start->format('His');
            $end_date = $end->format('Ymd') . "T" . $end->format('His');

            $device_shakira = $this->helper->getDataFromDevice(Utils::APP_SHAKIRA, $start_date, $end_date);
            $device_prama = $this->helper->getDataFromDevice(Utils::APP_PRAMA, $start_date, $end_date);
            $device_smartgarden = $this->helper->getDataFromDevice(Utils::APP_001, $start_date, $end_date);

            $data_shakira = [];
            foreach ($device_shakira as $item) {
                if (isset($item['m2m:cin'])) {
                // if (isset($item['m2m:cin'])) {
                    $temp_data = json_decode($item['m2m:cin']['con']);
                    if (isset($temp_data->counter)) {
                        try {
                            $time = Carbon::parse($item['m2m:cin']['ct'])->format('H:i:s');
                        } catch (\Throwable $th) {
                            $time = null;
                        }
                        $data_shakira[] = [
                            'time' => $time ?? '-',
                            'counter' => $temp_data->counter ?? '-',
                            'humidity_soil' => $temp_data->humidity_soil ?? '-',
                            'ph_soil' => $temp_data->ph_soil ?? '-',
                            'lux' => $temp_data->lux ?? '-',
                            'status_alert' => $temp_data->status_alert ?? '-',
                        ];
                    }
                }
            }
            $data_prama = [];
            foreach ($device_prama as $item) {
                if (isset($item['m2m:cin'])) {
                    $temp_data = json_decode($item['m2m:cin']['con']);
                    $dt = $item['m2m:cin']['ct'];
                    if (isset($temp_data->counter)) {
                        try {
                            $time = Carbon::parse($item['m2m:cin']['ct'])->format('H:i:s');
                        } catch (\Throwable $th) {
                            $time = null;
                        }
                        $data_prama[] = [
                            'time' => $time ?? '-',
                            'counter' => $temp_data->counter ?? '-',
                            'humidity_soil_lora' => $temp_data->humidity_soil ?? '-',
                            'status_valve' => $temp_data->status_valve ?? '-',
                            'rssi' => $temp_data->rssi ?? '-',
                            'snr' => $temp_data->snr ?? '-',
                            'automatic' => $temp_data->automatic ?? '-',
                        ];
                    }
                }
            }
            
            $data_tomat = [];
            foreach ($device_smartgarden as $item) {
                if (isset($item['m2m:cin'])) {
                    $temp_data = json_decode($item['m2m:cin']['con']);
                    if (isset($temp_data->temperature)) {
                        try {
                            $time = Carbon::parse($item['m2m:cin']['ct'])->format('H:i:s');
                        } catch (\Throwable $th) {
                            $time = null;
                        }

                        $data_tomat[] = [
                            'counter' => $temp_data->counter ?? '-',
                            'time' => $time,
                            'temperature' => $temp_data->temperature,
                            'humidity' => $temp_data->humidity,
                            'lux' => $temp_data->lux ?? '-',
                            'statusCuaca' => $temp_data->statusCuaca ?? '-',
                            'DataPH' => $temp_data->ph ?? '-',
                            'DataSensor1' => $temp_data->DataSensor1 ?? '-',
                            'DataTDS' => $temp_data->tds ?? '-',
                            'DataSensor2' => $temp_data->DataSensor2 ?? '-',
                            'dbm' => $temp_data->dbm ?? '-',
                        ];
                    }
                }
            }

            $data_tomat = collect($data_tomat)->sortByDesc('time')->all();
            $data_prama = collect($data_prama)->sortByDesc('time')->all();
            $data_shakira = collect($data_shakira)->sortByDesc('time')->all();
            $results = [
                'cabai' => [
                    'card_shakira' => $data_shakira[0] ?? [],
                    'card_prama' => $data_prama[0] ?? [],
                    'collection_prama' => $data_prama,
                    'collection_shakira' => $data_shakira,
                ],
                'tomat' => [
                    'card' => $data_tomat[0] ?? [],
                    'collection' => $data_tomat,
                ]
            ];

            return response()->json($results, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage() ?? 'Error.'], 500);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 500);
    }
}
