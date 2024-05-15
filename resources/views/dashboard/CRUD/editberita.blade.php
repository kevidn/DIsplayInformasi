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
                    <h4 class="card-title">EDIT BERITA</h4>
                    <div class="card-body">
                        <form action="{{ route('updateBerita', ['id' => $berita->id]) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" name="judul" placeholder="Masukkan Nama Agenda" class="form-control" value="{{ $berita->judul }}">
                            </div>

                            <div class="form-group">
                                <label>Gambar Berita</label><br>
                                <img class="card-img-top" src="{{ asset('/storage/beritas/upload/'.$berita->gambar) }}" style="width: 550px; height: auto;" alt="Gambar Berita">

                            <div class="form-group"><br>
                                <label for="gambar"  class="btn btn-info"  style="font-size: 12px; color: white;">Ganti Gambar Berita</label>
                                <input type="file" name="gambar" id="gambar" class="form-control">
                            </div>

                            </div>
                            <div class="form-group">

                                <textarea class="custom-textarea" id="isiBerita" name="isi" rows="5">{{ $berita->isi }}</textarea>
                            </div><hr>

                            <button type="submit" class="btn btn-success">UPDATE BERITA</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* CSS untuk menambahkan border pada textarea */
    .custom-textarea {
        width: 100%; /* Menjadikan textarea lebar 100% dari container */
        border: 1px solid #ced4da; /* Warna dan ketebalan border */
        border-radius: 4px; /* Mengatur sudut border */
        padding: .375rem .75rem; /* Mengatur padding */
        line-height: 1.5; /* Mengatur jarak antar baris */
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out; /* Efek transisi */
    }

    /* CSS untuk menambahkan style ketika textarea di-focus */
    .custom-textarea:focus {
        border-color: #80bdff; /* Warna border saat di-focus */
        outline: 0; /* Menghilangkan outline saat di-focus */
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25); /* Efek bayangan saat di-focus */
    }
</style>
