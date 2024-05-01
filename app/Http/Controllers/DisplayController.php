<?php

namespace App\Http\Controllers;

use App\Services\Cuaca;
use App\Services\Jam;
use App\Models\Berita;
use App\Models\Header;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    protected $cuacaService;
    protected $jamService;

    public function __construct()
    {
        $cuacaApiKey = 'UU7VZRFUZENDLYEFXLH3KYLHQ'; // Masukkan kunci API Cuaca Anda di sini
        $this->cuacaService = new Cuaca($cuacaApiKey);


    }

    public function index(Request $request)
    {
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);
        $berita = Berita::all();
        $header = Header::all();

        return view('display.index', compact('cuaca', 'berita', 'header'));
    }
}
