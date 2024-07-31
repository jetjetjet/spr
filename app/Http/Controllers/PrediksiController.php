<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    public function __construct(protected Utils $helper)
    {
        //
    }

    public function index(Request $request)
    {
        $data = $this->helper->getPrediksiSheet();

        return view('prediksi', ['data' => $data]);
    }
}
