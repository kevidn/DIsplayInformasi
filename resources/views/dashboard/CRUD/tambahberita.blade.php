@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TAMBAH BERITA</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('simpanBerita') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Tambahkan csrf token untuk keamanan -->
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" name="judul" placeholder="Masukkan Judul Berita" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label><br>
                            <textarea class="form-control" placeholder="Masukan Isi Berita" id="isiBerita" name="isi" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar"  class="badge badge-warning"  style="font-size: 12px; color: white;">Pilih Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">TAMBAH BERITA</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.partials.corejs')
