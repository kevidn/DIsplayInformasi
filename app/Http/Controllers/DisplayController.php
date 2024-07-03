<?php

namespace App\Http\Controllers;
use App\Models\RT;
use App\Models\Berita;
use App\Services\Cuaca;
use App\Models\Header;
use Illuminate\Support\Facades\Http;
use App\Models\Agenda;
use App\Models\Slideinformation;
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
    public function showMobileView()
{
    return view('display.mobile');
}


    public function index(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        //array untuk cuaca
        $currentHour = Carbon::now('Asia/Jakarta')->format('H'); // Mendapatkan jam saat ini dalam format 24 jam dari zona waktu Asia/Jakarta
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);

        //Ambil Data
        $berita = Berita::all();

        $header = Header::all();

        $videodisplay = Video::where('tampil', 1)->first();
        $video = Video::all();

        $header = Header::all();

        $RTs = RT::all();

        $agendadisplay = $this->agendadisplay();

        $jadwalSholat = $this->getJadwalSholat();
        $slideinfo = Slideinformation::all();

        $videoList = Video::where('tampil', 1)->get();

        $date = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY');

        // dd($slideinfo);

        return view('display.index', compact('header','videoList','slideinfo', 'video', 'date', 'currentHour', 'cuaca', 'berita', 'header', 'RTs', 'agendadisplay', 'videodisplay', 'jadwalSholat'));

    }

public function agendadisplay()
{
    $today = Carbon::today()->toDateString(); // Ambil hanya tanggal tanpa jam dan menit
    $agendaNow = Agenda::whereDate('tanggal', '>=', $today)->get(); // Hanya ambil agenda dengan tanggal setelah atau sama dengan hari ini


    return $agendaNow;
}


    public function getJadwalSholat()
    {

        $currentYear = date('Y');
        $currentMonth = date('m');

        $url = "https://api.myquran.com/v2/sholat/jadwal/1204/{$currentYear}/{$currentMonth}";

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
    public function nextVideo()
    {
        // Dapatkan video yang sedang ditampilkan saat ini
        $videodisplay = Video::where('tampil', 1)->first();

        if ($videodisplay) {
            // Dapatkan video berikutnya yang akan ditampilkan
            $nextVideo = Video::where('tampil', 1)
                              ->where('id', '>', $videodisplay->id) // Pilih video dengan ID lebih besar dari video saat ini
                              ->orderBy('id')
                              ->first();

            if ($nextVideo) {
                // Redirect ke halaman tampilan video berikutnya
                if ($nextVideo->youtubelinks) {
                    // Jika video dari YouTube, redirect ke URL YouTube
                    return redirect()->away($nextVideo->youtubelinks);
                } elseif ($nextVideo->videolokal) {
                    // Jika video lokal, redirect ke halaman yang menampilkan video lokal
                    return redirect()->route('videoDetail', $nextVideo->id);
                }
            }
        }

        // Jika tidak ada video yang ditampilkan saat ini atau tidak ada video berikutnya yang tersedia,
        // redirect ke halaman lain atau lakukan tindakan lainnya
        return redirect()->route('index'); // Ganti dengan rute atau tindakan yang sesuai
    }


}
