<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControllingController extends Controller
{
    public function __construct(protected Utils $helper)
    {
        //
    }

    public function index(Request $request)
    {
        $data = $this->helper->getGoogleSheet();
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

        return view('controlling', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $payload = $request->all();
            $device_shakira = $this->helper->postDataToDevice(Utils::APP_PRAMA, $payload);
            return response()->json("ok", 200);
        } catch (\Throwable $th) {
            return response()->json("error", 500);
        }
    }
}
