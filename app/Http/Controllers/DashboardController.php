<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

//MENGAMBIL DARI MODEL
use App\Services\Cuaca;
use App\Models\Header;
use App\Models\RT;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Video;

use Illuminate\Support\Facades\Http;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $cuacaService;

    public function __construct()
    {
        $cuacaApiKey = 'UU7VZRFUZENDLYEFXLH3KYLHQ'; // Masukkan kunci API Cuaca Anda di sini
        $this->cuacaService = new Cuaca($cuacaApiKey);
    }

    public function dashboard(Request $request)
    {
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);
        $berita = Berita::paginate(1);
        $agenda = Agenda::paginate(3);
        $berita = Berita::all();
        $total_berita = count($berita);
        $agenda = Agenda::all();
        $total_agenda = count($agenda);
        $video = Video::paginate(1);
        $total_video = count($video);
        $header = Header::all();
        $RTs = RT::all();

        return view('dashboard.index', compact('cuaca', 'berita', 'header', 'RTs', 'agenda', 'total_berita','total_agenda', 'total_video', 'video'));
    }

    public function berita(Request $request)
    {
        $berita = Berita::all();
        return view('dashboard.berita', compact('berita'));
    }
    public function agenda(Request $request)
    {
        $agenda = Agenda::all();
        return view('dashboard.agenda', compact('agenda'));
    }

    public function akun(Request $request)
    {
        return view('dashboard.akun');
    }

    public function Runningtext(Request $request)
    {
        $runningtext = RT::all();
        return view('dashboard.runningtext', compact('runningtext'));
    }

    public function video(Request $request)
    {
        $video = Video::all();
        return view('dashboard.video', compact('video'));
    }

    public function tambahagenda(Request $request)
    {
        return view('dashboard.CRUD.tambahagenda');
    }

    public function tambahberita(Request $request)
    {
        return view('dashboard.CRUD.tambahberita');
    }

    public function editagenda($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('dashboard.CRUD.editagenda', compact('agenda'));
    }

    public function editberita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('dashboard.CRUD.editberita', compact('berita'));
    }

    public function simpanVideo(Request $request)
    {
        // Simpan link YouTube ke database
        $video = new Video;
        $video->youtubelinks = $request->input('link_youtube');
        $video->save();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('video');
    }

    public function simpanAgenda(Request $request)
    {
        // Simpan data agenda ke database
        $agenda = new Agenda;
        $agenda->nama_kegiatan = $request->input('nama_kegiatan');
        $agenda->tempat = $request->input('tempat');
        $agenda->tanggal = $request->input('tanggal');
        $agenda->save();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('agenda');
    }

    public function simpanBerita(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

        //create berita
        $berita = berita::create([
            'judul'     => $request->judul,
            'gambar'     => $gambar->hashName(),
            'isi'   => $request->isi,
        ]);

        //return response
        return redirect()->route('berita');
    }

    public function destroyberita($id)
    {
        // Temukan berita berdasarkan ID
        $berita = Berita::find($id);

        // Hapus gambar terkait
        Storage::delete('public/beritas/upload/' . basename($berita->gambar));

        // Hapus berita
        $berita->delete();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('berita')->with('success', 'Berita berhasil dihapus.');
    }

    public function destroyagenda($id)
    {
        // Temukan agenda berdasarkan ID
        $agenda = Agenda::find($id);

        // Hapus agenda
        $agenda->delete();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('agenda')->with('success', 'Agenda berhasil dihapus.');
    }

    public function destroyVideo($id)
    {
        // Temukan video berdasarkan ID
        $video = Video::find($id);

        // Hapus video
        $video->delete();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('video')->with('success', 'Video berhasil dihapus.');
    }

    public function destroyRunningtext($id)
    {
        //find post by ID
        $RT = RT::find($id);

        //delete RT
        $RT->delete();

        //return response
        return redirect()->route('runningtext')->with('success', 'Running Text berhasil dihapus.');
    }

    public function updateagenda(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_kegiatan'     => 'required',
            'tempat'     => 'required',
            'tanggal'   => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find agenda by ID
        $agenda = Agenda::find($id);

        //check if agenda exists
        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        //update agenda data
        $agenda->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
        ]);

        //return response
        return redirect()->route('agenda')->with('success', 'Agenda berhasil diperbaharui.');
    }

    public function updateberita(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'isi'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $berita = Berita::find($id);

        //check if image is not empty
        if ($request->hasFile('gambar')) {

            //upload image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

            //delete old image
            Storage::delete('public/beritas/upload/' . basename($berita->gambar));

            //update berita with new image
            $berita->update([
                'judul'     => $request->judul,
                'gambar'     => $gambar->hashName(),
                'isi'   => $request->isi,
            ]);
        } else {

            //update berita without image
            $berita->update([
                'judul'     => $request->judul,
                'isi'   => $request->isi,
            ]);
        }

        //return response
        return redirect()->route('berita')->with('success', 'Berita berhasil diperbaharui.');
    }

    public function updatert(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'RT' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find RT by ID
        $RT = RT::find($id);

        // Check if RT exists
        if (!$RT) {
            return response()->json(['message' => 'RT not found'], 404);
        }

        // Update RT with new data
        $RT->update([
            'RT' => $request->input('RT'),
        ]);

        // Return response
        return redirect()->route('runningtext')->with('success', 'RunningText berhasil diperbaharui.');
    }
    public function updateTampilStatus($id)
{
    $video = Video::findOrFail($id);
    $video->tampil = !$video->tampil; // Toggle status tampil
    $video->save();

    return redirect()->route('video')->with('success', 'Video Berhasil Di Tampilkan Ke Display');
}

}
