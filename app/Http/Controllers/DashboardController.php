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
use App\Models\User;
use App\Models\Slideinformation;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        $berita = Berita::all();
        $total_berita = count($berita);

        $videodisplay = Video::where('tampil', 1)->first();
        $video = Video::all();
        $total_video = count($video);

        $agendadisplay = $this->agendadisplay();
        $agenda = Agenda::all();
        $total_agenda = count($agenda);

        $header = Header::all();

        $RTs = RT::all();

        $jadwalSholat = $this->getJadwalSholat();
        $slideinfo = Slideinformation::all();
        $videoList = Video::where('tampil', 1)->get();


        $videoList = Video::where('tampil', 1)->get();
        $date = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY');

        return view('dashboard.index', compact('videoList' ,'slideinfo', 'date', 'currentHour', 'videodisplay', 'agendadisplay', 'cuaca', 'berita', 'header', 'RTs', 'agenda', 'total_berita', 'total_agenda', 'total_video', 'video', 'jadwalSholat'));

    }

    public function agendadisplay()
    {
        $today = Carbon::today()->toDateString(); // Ambil hanya tanggal tanpa jam dan menit
        $agendaNow = Agenda::whereDate('tanggal', '>=', $today)->get(); // Hanya ambil agenda dengan tanggal setelah atau sama dengan hari ini


        return $agendaNow;
    }
    public function header(Request $request)
    {
        $header = header::all();
        return view('dashboard.header', compact('header'));
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
    public function slideinformation(Request $request)
    {
        $slideinformation = Slideinformation::all();
        return view('dashboard.slideinformation', compact('slideinformation'));
    }


    public function akun(Request $request)
    {
        $loggedInUserId = auth()->id();
        $users = User::all()->sortBy(function ($user) use ($loggedInUserId) {
            if ($user->id === $loggedInUserId) {
                return 0; // Akun yang sedang login diberi prioritas tertinggi
            } elseif ($user->name === 'DefaultAdmin') {
                return 1; // Akun DefaultAdmin diberi prioritas kedua tertinggi
            } else {
                return $user->userlevel === 'Admin' ? 2 : 3; // Urutkan pengguna berdasarkan peran, dengan Admin di atas Guest
            }
        });

        return view('dashboard.akun', compact('users')); // Kirim data pengguna yang telah diurutkan ke tampilan
    }

    public function Runningtext(Request $request)
    {
        $runningtext = RT::all();
        return view('dashboard.runningtext', compact('runningtext'));
    }

    public function video(Request $request)
    {
        $video_ada_display = Video::where('tampil', 1)
            ->whereNotNull('youtubelinks')
            ->orderBy('tampil', 'desc')
            ->orWhereNotNull('videolokal')
            ->get();

        $video_tidak_display = Video::where('tampil', 0)
            ->whereNotNull('youtubelinks')
            ->orWhereNotNull('videolokal')
            ->get();

        $videos = $video_ada_display->merge($video_tidak_display);
        // Tambahkan path thumbnail untuk video lokal
        foreach ($videos as $video) {
            if (!empty($video->videolokal)) {
                $thumbnailPath = storage_path('app/public/videolokal/thumbnails/' . $video->thumbnail);
                if (file_exists($thumbnailPath)) {
                    $video->thumbnailPath = $thumbnailPath;
                }
            }
        }

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

    public function simpanVideolokal(Request $request)
    {
        // Validasi input
        $request->validate([
            'video_file' => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:61440', // max 60MB
        ]);

        // Proses upload video file
        if ($request->hasFile('video_file')) {
            $videoFile = $request->file('video_file');
            $hashedName = Str::random(40) . '.' . $videoFile->getClientOriginalExtension();
            $path = $videoFile->storeAs('public/videolokal', $hashedName);

            // Ekstrak thumbnail dari video
            $thumbnailPath = $this->extractThumbnail($path);

            // Simpan thumbnail ke penyimpanan
            if ($thumbnailPath) {
                $thumbnailName = pathinfo($hashedName, PATHINFO_FILENAME) . '.jpg';
                Storage::put('public/videolokal/thumbnails/' . $thumbnailName, file_get_contents($thumbnailPath));
            }

            // Simpan nama file dan thumbnail ke database
            $video = new Video();
            $video->videolokal = $hashedName;
            $video->thumbnail = $thumbnailName ?? null; // Jika thumbnail berhasil diekstrak, simpan nama thumbnail, jika tidak, simpan null
            $video->save();

            // Redirect atau tampilkan pesan berhasil
            return redirect()->route('video')->with('success', 'Video lokal berhasil diunggah.');
        }

        // Jika tidak ada file yang diunggah
        return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
    }

    private function extractThumbnail($videoPath)
    {
        // Path untuk menyimpan thumbnail sementara
        $tempThumbnailPath = public_path('temp/thumbnail.jpg');

        // Perintah untuk mengekstrak thumbnail menggunakan FFmpeg
        $ffmpegCommand = "ffmpeg -i " . storage_path('app/' . $videoPath) . " -ss 00:00:05 -vframes 1 " . $tempThumbnailPath;

        // Jalankan perintah FFmpeg
        exec($ffmpegCommand);

        // Periksa apakah thumbnail berhasil diekstrak
        if (file_exists($tempThumbnailPath)) {
            return $tempThumbnailPath;
        }

        return null; // Jika thumbnail tidak berhasil diekstrak
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
        // Validasi data
        $request->validate([
            'nama_kegiatan' => 'required|string|max:65',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Simpan data agenda ke database
        $agenda = new Agenda;
        $agenda->nama_kegiatan = $request->input('nama_kegiatan');
        $agenda->tempat = $request->input('tempat');
        $agenda->tanggal = $request->input('tanggal');
        $agenda->save();

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('agenda')->with('success', 'Agenda berhasil ditambahkan.');
    }


    public function simpanBerita(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required|string|max:80', // Batasan 80 karakter untuk judul
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi'       => 'required|string|max:425', // Batasan 425 karakter untuk isi
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

        // Create berita
        $berita = Berita::create([
            'judul'     => $request->judul,
            'gambar'    => $gambar->hashName(),
            'isi'       => $request->isi,
        ]);

        // Return response
        return redirect()->route('berita')->with('success', 'Berita berhasil disimpan.');
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


    public function simpanHeader(Request $request)
    {
         // Validate the request
    $validator = Validator::make($request->all(), [
        'logo1'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'logo2'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_sekolah'  => 'required|string|max:255',
        'sambutan'      => 'required|string|max:255',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Handle logo1 file upload
    if ($request->hasFile('logo1')) {
        $logo1 = $request->file('logo1');
        $logo1Name = time() . '_' . $logo1->getClientOriginalName();
        $logo1->move(public_path('images/header/logo1'), $logo1Name);
    }

    // Handle logo2 file upload
    if ($request->hasFile('logo2')) {
        $logo2 = $request->file('logo2');
        $logo2Name = time() . '_' . $logo2->getClientOriginalName();
        $logo2->move(public_path('images/header/logo2'), $logo2Name);
    }

    // Get the existing header or create a new one
    $header = Header::find(1); // Assuming the header has ID 1

    if (!$header) {
        $header = new Header();
    }

    // Update nama_sekolah and sambutan
    $header->nama_sekolah = $request->nama_sekolah;
    $header->sambutan = $request->sambutan;

    // Update logo1 and logo2 names if files were uploaded
    if (isset($logo1Name)) {
        $header->logo1 = $logo1Name;
    }

    if (isset($logo2Name)) {
        $header->logo2 = $logo2Name;
    }

    // Save the headerf
    $header->save();

    // Redirect atau kirim respons sesuai kebutuhan aplikasi
    return redirect()->route('dashboard');
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

    public function updateAgenda(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_kegiatan' => 'required|string|max:65',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Temukan agenda berdasarkan ID
        $agenda = Agenda::find($id);

        // Cek jika agenda tidak ditemukan
        if (!$agenda) {
            return redirect()->route('agenda')->with('error', 'Agenda tidak ditemukan.');
        }

        // Perbarui data agenda
        $agenda->update([
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'tempat' => $request->input('tempat'),
            'tanggal' => $request->input('tanggal'),
        ]);

        // Redirect atau kirim respons sesuai kebutuhan aplikasi
        return redirect()->route('agenda')->with('success', 'Agenda berhasil diperbaharui.');
    }


    public function updateberita(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required|string|max:80', // Batasan 80 karakter untuk judul
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi'       => 'required|string|max:425', // Batasan 425 karakter untuk isi
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find post by ID
        $berita = Berita::find($id);

        // Check if image is not empty
        if ($request->hasFile('gambar')) {

            // Upload image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

            // Delete old image
            Storage::delete('public/beritas/upload/' . basename($berita->gambar));

            // Update berita with new image
            $berita->update([
                'judul'     => $request->judul,
                'gambar'    => $gambar->hashName(),
                'isi'       => $request->isi,
            ]);
        } else {

            // Update berita without image
            $berita->update([
                'judul'     => $request->judul,
                'isi'       => $request->isi,
            ]);
        }

        // Return response
        return redirect()->route('berita')->with('success', 'Berita berhasil diperbaharui.');
    }
    public function updateImage(Request $request, $id)
{
    // Validasi file gambar
    $request->validate([
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maksimum 2MB
    ]);

    // Temukan slide information berdasarkan ID
    $slideInformation = Slideinformation::find($id);

    // Periksa apakah slide information ditemukan
    if (!$slideInformation) {
        return response()->json(['message' => 'Slide information not found'], 404);
    }

    // Hapus gambar lama jika ada
    if ($slideInformation->gambar) {
        Storage::delete('/public/slideinformation/upload/' . $slideInformation->gambar);
    }

    // Simpan gambar baru
    $gambar = $request->file('gambar');
    $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
    $gambar->storeAs('public/slideinformation/upload', $gambarName);

    // Update slide information dengan gambar baru
    $slideInformation->update(['gambar' => $gambarName]);

    // Redirect atau kirim respons sesuai kebutuhan aplikasi
    return redirect()->route('slideinformation')->with('success', 'Gambar berhasil diperbarui.');
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
    public function updateQuotes(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'quotes' => 'required|string', // Sesuaikan dengan aturan validasi Anda
    ]);

    // Jika validasi gagal, kembalikan pesan kesalahan
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Cari SlideInformation berdasarkan ID
    $slideInformation = SlideInformation::find($id);

    // Periksa apakah SlideInformation ditemukan
    if (!$slideInformation) {
        return response()->json(['message' => 'Quotes not found'], 404);
    }

    // Update quotes dengan data baru
    $slideInformation->update([
        'quotes' => $request->input('quotes'),
    ]);

    // Redirect dengan pesan sukses jika berhasil
    return redirect()->route('slideinformation')->with('success', 'Quotes berhasil diperbaharui.');
}

public function hapusQuotes($id)
{
    // Temukan quotes berdasarkan ID
    $slideInformation = SlideInformation::find($id);

    // Periksa apakah quotes ditemukan
    if (!$slideInformation) {
        return response()->json(['message' => 'Quotes not found'], 404);
    }

    // Hapus quotes dengan mengosongkan kolom quotes
    $slideInformation->update(['quotes' => '']);

    // Redirect atau kirim respons sesuai kebutuhan aplikasi
    return redirect()->route('slideinformation')->with('success', 'Quotes berhasil dihapus.');
}
public function deleteImage($id)
{
    // Temukan slide information berdasarkan ID
    $slideInformation = Slideinformation::find($id);

    // Periksa apakah slide information ditemukan
    if (!$slideInformation) {
        return response()->json(['message' => 'Slide information not found'], 404);
    }

    // Hapus gambar dari storage jika ada
    if ($slideInformation->gambar) {
        Storage::delete('/public/slideinformation/upload/' . $slideInformation->gambar);
    }

    // Update slide information dengan mengosongkan kolom gambar
    $slideInformation->update(['gambar' => null]);

    // Redirect atau kirim respons sesuai kebutuhan aplikasi
    return redirect()->route('slideinformation')->with('success', 'Gambar berhasil dihapus.');
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

        if ($user) {
            $user->delete();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
        }

        return redirect()->route('akun')->with('error', 'Failed to delete your account.');
    }

    public function hapusakunmanagemen(Request $request)
    {
        $userId = $request->input('user_id'); // Mengambil id pengguna dari request

        $user = \App\Models\User::find($userId); // Mengambil data pengguna berdasarkan id

        // Pastikan pengguna yang sedang login tidak dapat menghapus akunnya sendiri
        if ($user && $user->id !== Auth::id()) {
            // Hapus user dari database
            $user->delete();

            // Redirect ke halaman lain, misalnya halaman manajemen akun
            return redirect()->route('akun')->with('success', 'Akun telah dihapus dengan berhasil.');
        } else {
            // Redirect dengan pesan kesalahan jika pengguna mencoba menghapus akun sendiri
            return redirect()->route('akun')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
    }
    public function ubahLevelAkun($id, $newLevel)
    {
        $user = User::findOrFail($id);
        $user->userlevel = $newLevel;
        $user->save();

        $message = ($newLevel === 'Admin') ? 'User berhasil diubah menjadi Admin' : 'User berhasil diubah menjadi Guest';

        return redirect()->route('akun')->with('success', $message);
    }
    public function createUserAccount(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Cek apakah pengguna yang sedang melakukan permintaan adalah Admin
        if (auth()->user()->userlevel === 'Admin') {
            // Buat akun pengguna baru
            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->userlevel = 'Guest'; // Atur level pengguna baru sebagai Guest
            $user->save();

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'User account has been created successfully.');
        } else {
            // Redirect kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'You do not have permission to create user accounts.');
        }
    }
}
