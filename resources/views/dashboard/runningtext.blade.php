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
                    <h4 class="card-title">RUNNING TEXT</h4>
                </div>
                <div class="card-body">
                    <div class="running-text-container">
                        <div class="running-text">
                            <!-- Tambahkan teks running text di sini -->
                            Bersyukurlah untuk setiap hari, karena setiap hari adalah kesempatan baru untuk menjadi lebih baik. || Jadilah pribadi yang memberi inspirasi, bukan hanya sekadar mengikuti arus.
                            || Keberanian bukanlah ketiadaan rasa takut, melainkan tindakan di tengah-tengah ketakutan.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_kendaraan"></label>
                        <input type="text" id="nama_kendaraan" name="nama_kendaraan" class="form-control" value="Bersyukurlah untuk setiap hari, karena setiap hari adalah kesempatan baru untuk menjadi lebih baik. || Jadilah pribadi yang memberi inspirasi, bukan hanya sekadar mengikuti arus.
                            || Keberanian bukanlah ketiadaan rasa takut, melainkan tindakan di tengah-tengah ketakutan.">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Perbaharui Running Text</button>
                        <button type="submit" class="btn btn-danger">Hapus Running Text</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS RUNNING TEXT -->
<style>
    .running-text-container {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        border: 1px solid #ccc;
        height: 60px; /* Sesuaikan tinggi running text */
        display: flex; /* Menggunakan flexbox untuk posisi tengah */
        align-items: center; /* Posisikan teks di tengah secara vertikal */
    }
    .running-text {
        position: absolute;
        animation: marquee linear infinite;
        animation-duration: 20s; /* Sesuaikan kecepatan berjalan */
        animation-timing-function: linear;
    }
    @keyframes marquee {
        0% { left: 100%; }
        100% { left: -100%; }
    }
</style>
@include('dashboard.partials.corejs')
