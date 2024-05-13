<?php

namespace App\Http\Controllers;
use App\Models\RT;
use App\Models\Berita;
use App\Services\Cuaca;
use App\Models\Header;
use Illuminate\Support\Facades\Http;
use App\Models\Agenda;
use App\Models\Video;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DisplayController extends Controller
{
    protected $cuacaService;

    public function __construct()
    {
        $cuacaApiKey = 'UU7VZRFUZENDLYEFXLH3KYLHQ'; // Masukkan kunci API Cuaca Anda di sini
        $this->cuacaService = new Cuaca($cuacaApiKey);


    }

    public function index(Request $request)
    {

        //array untuk cuaca
        $currentHour = Carbon::now('Asia/Jakarta')->format('H'); // Mendapatkan jam saat ini dalam format 24 jam dari zona waktu Asia/Jakarta

        //Ambil Data
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);
        $berita = Berita::all();
        $agenda = Agenda::all();
        $videodisplay = Video::where('tampil', 1)->first();
        $video = Video::paginate(1);
        $header = Header::all();
        $RTs = RT::all();
        $jadwalSholat = $this->getJadwalSholat();

        // dd($cuaca);


        return view('display.index', compact('currentHour','cuaca', 'berita', 'header', 'RTs', 'agenda', 'videodisplay', 'jadwalSholat'));
    }

    public function video()
    {
        $video = Video::all(); // Mengambil semua data video dari database

        return view('display.index', compact('video'));
    }

    public function getJadwalSholat()
    {
        $url = "https://api.myquran.com/v2/sholat/jadwal/1204/2024/05";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            $tanggalHariIni = date('Y-m-d'); // Tanggal hari ini

            $jadwalHariIni = collect($data['data']['jadwal'])->firstWhere('date', $tanggalHariIni);

            if ($jadwalHariIni) {
                return $jadwalHariIni;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
