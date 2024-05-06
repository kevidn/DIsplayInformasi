@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form action="{{ route('simpanVideo') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="link_youtube" class="form-control mr-2" value="" placeholder="Silahkan Masukkan Link Youtube Disini!">
                        <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($video as $singleVideo)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $singleVideo->youtubelinks }}" allow="autoplay;"></iframe>
                                    </div>
                                    <div class="mt-3">
                                        <form action="{{ route('tampilkanVideoKeDisplay', $singleVideo->id) }}" method="POST" style="display: inline;">
                                            @csrf

                                            {{-- Tombol "Tampilkan Video Ke Display" --}}
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menampilkan video ini di display?')">
                                                Tampilkan Video Ke Display
                                            </button>

                                        </form>
                                        <form action="{{ route('hapusVideo', $singleVideo->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">&#128465; Hapus Video</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- SCIRPT API BUAT JUDUL LINK YT -->
<!-- <script>
    // Fungsi untuk mendapatkan judul video berdasarkan ID video
    function getVideoTitle(videoId) {
        // Ganti 'YOUR_API_KEY' dengan API Key YouTube Anda
        const apiKey = 'YOUR_API_KEY';
        // URL endpoint untuk mengambil informasi video
        const url = `https://www.googleapis.com/youtube/v3/videos?id=${videoId}&part=snippet&key=${apiKey}`;

        // Kirim permintaan fetch ke API YouTube
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Ambil judul dari data yang diterima
                const title = data.items[0].snippet.title;
                // Set judul video ke dalam card
                document.getElementById('video-title').innerText = title;
            })
            .catch(error => console.error('Error:', error));
    }

    // Panggil fungsi saat dokumen dimuat
    document.addEventListener('DOMContentLoaded', function () {
        // Panggil fungsi getVideoTitle dengan ID video yang diperoleh dari link YouTube
        getVideoTitle('e-B0VKTt5_Q');
    });
</script> -->

