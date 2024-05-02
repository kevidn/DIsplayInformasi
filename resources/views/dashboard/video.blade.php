@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
             <div class="card-header">
                <h4 class="card-title">DAFTAR VIDEO</h4>
                
                <div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/e-B0VKTt5_Q?si=FKDpJryN6XjU7ona" allow="autoplay;"></iframe>
                </div>
            </div>
            <div class="card-footer">
                <a href="https://www.youtube.com/watch?v=e-B0VKTt5_Q" class="btn btn-primary">Watch on YouTube</a>
                <button type="submit" class="btn btn-success">Tampilkan ke Display</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/e-B0VKTt5_Q?si=FKDpJryN6XjU7ona" allow="autoplay;"></iframe>
                </div>
            </div>
            <div class="card-footer">
                <a href="https://www.youtube.com/watch?v=e-B0VKTt5_Q" class="btn btn-primary">Watch on YouTube</a>
                <button type="submit" class="btn btn-success">Tampilkan ke Display</button>
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

