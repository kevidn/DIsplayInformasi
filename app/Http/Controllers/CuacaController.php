<?php

namespace App\Http\Controllers;

use App\Services\Cuaca;

class CuacaController extends Controller
{
    protected $cuacaService;

    public function __construct()
    {
        $apiKey = 'UU7VZRFUZENDLYEFXLH3KYLHQ'; // Masukkan kunci API Anda di sini
        $this->cuacaService = new Cuaca($apiKey);
    }

    public function index()
    {
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);

        return view('display.index', compact('cuaca'));
    }
}
