<?php

namespace App\Http\Controllers;
use App\Models\RT;
use App\Models\Berita;
use App\Services\Cuaca;
use App\Models\Header;
use App\Models\Agenda;
use App\Models\Video;

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
        $video = Video::paginate(1);
        $header = Header::all();
        $RTs = RT::all();

        return view('display.index', compact('cuaca', 'berita', 'header', 'RTs', 'agenda', 'video'));
    }

    public function video()
    {
        $video = Video::all(); // Mengambil semua data video dari database

        return view('display.index', compact('video'));
    }
}
