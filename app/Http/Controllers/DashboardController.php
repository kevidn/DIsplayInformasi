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
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        //array untuk cuaca
        $currentHour = Carbon::now('Asia/Jakarta')->format('H'); // Mendapatkan jam saat ini dalam format 24 jam dari zona waktu Asia/Jakarta
        // Buat array jam dari 1 sampai 24
        $city = 'Cileungsi'; // Ganti dengan kota yang ingin Anda cek cuacanya
        $cuaca = $this->cuacaService->getWeather($city);
        $agenda = Agenda::paginate(3);
        $berita = Berita::all();
        $videodisplay = Video::where('tampil', 1)->first();
        $total_berita = count($berita);
        $agenda = Agenda::all();
        $total_agenda = count($agenda);
        $video = Video::paginate(1);
        $total_video = count($video);
        $header = Header::all();
        $RTs = RT::all();
        $jadwalSholat = $this->getJadwalSholat();


        return view('dashboard.index', compact('currentHour','videodisplay', 'cuaca', 'berita', 'header', 'RTs', 'agenda', 'total_berita','total_agenda', 'total_video', 'video', 'jadwalSholat'));
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
        $video_ada_display = Video::where('tampil', 1)->get();
        $video_tidak_display = Video::where('tampil', 0)->get();
        $videos = $video_ada_display->merge($video_tidak_display);
        return view('dashboard.video', compact('videos'));
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
    // Mendapatkan ID video dari link YouTube
    $videoId = $this->getId($request->input('link_youtube'));

    // Jika berhasil mendapatkan ID video
    if ($videoId) {
        // Membuat kode embed dari ID video
        $embedCode = '//www.youtube.com/embed/' . $videoId . '';

        // Simpan kode embed ke database
        $video = new Video;
        $video->youtubelinks = $embedCode;
        $video->tampil = 0;
        $video->save();
    }

    // Redirect atau kirim respons sesuai kebutuhan aplikasi
    return redirect()->route('video');
}
// Fungsi untuk mendapatkan ID video dari link YouTube
private function getId($url)
{
    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
    preg_match($regExp, $url, $matches);

    return (isset($matches[2]) && strlen($matches[2]) === 11) ? $matches[2] : null;
}
public function updateTampilStatus($id)
{
    $video = Video::findOrFail($id);
    $video->tampil = 1;
    $video->save();

    return redirect()->route('video')->with('success', 'Video Berhasil Di Tampilkan Ke Display');
}
public function hapusTampilStatus($id)
{
    $video = Video::findOrFail($id);
    $video->tampil = 0;
    $video->save();

    return redirect()->route('video')->with('success', 'Video Berhasil Di Hapus Dari Display');
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
    public function simpanRT(Request $request)
    {
        // Simpan link YouTube ke database
        $RT = new RT;
        $RT->RT = $request->input('RT');
        $RT->save();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('runningtext');
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

    public function destroyRT($id)
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
            'gambar'     => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
     /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request)
     {
         $user = \App\Models\User::find(Auth::id());

         // Validasi request
         $request->validate([
             'name' => 'required|string|max:255',
             'password' => 'nullable|string|min:8',
             'quotes' => 'required|string|max:255',
             'gambar_akun' => 'nullable|file|image|max:2048',
             'gambar_latar' => 'nullable|file|image|max:2048',

         ]);

         // Perbarui nama pengguna
         $user->name = $request->name;
         $user->quotes = $request->quotes;

         // Perbarui password jika dimasukkan
         if ($request->password) {
             $user->password = Hash::make($request->password);
         }

         // Proses Upload Gambar Akun
         if ($request->hasFile('gambar_akun')) {
             $gambarAkun = $request->file('gambar_akun');
             $namaGambarAkun = $gambarAkun->hashName();

             $gambarAkun->storeAs('public/user_images/', $namaGambarAkun);

             $user->gambarakun = $namaGambarAkun;
         }

         // Proses Upload Gambar Latar
         if ($request->hasFile('gambar_latar')) {
             $gambarLatar = $request->file('gambar_latar');
             $namaGambarLatar = $gambarLatar->hashName();

             $gambarLatar->storeAs('public/user_backgrounds/', $namaGambarLatar);

             $user->gambarlatar = $namaGambarLatar;
         }

         // Simpan Perubahan
         $user->save();

         // Pesan Sukses
         return redirect()->back()->with('success', 'Profile updated successfully!');
     }
     // Fungsi lain di sini

    /**
     * Delete the user's account.
     *
     * @return \Illuminate\Http\Response
     */
    public function hapusakun()
    {
        $user = \App\Models\User::find(Auth::id());

        // Hapus user dari database
        $user->delete();

        // Logout user setelah menghapus akun
        Auth::logout();

        // Redirect ke halaman lain, misalnya halaman beranda
        return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
    }

}
