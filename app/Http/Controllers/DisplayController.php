<?php

namespace App\Http\Controllers;
use App\Models\RT;
use App\Models\Berita;
use App\Services\Cuaca;
use App\Models\Header;
use App\Models\Agenda;

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
        $berita = Berita::paginate(1);
        $agenda = Agenda::paginate(3);

        $header = Header::all();
        $RTs = RT::all();

        return view('display.index', compact('cuaca', 'berita', 'header', 'RTs', 'agenda'));
    }
}
