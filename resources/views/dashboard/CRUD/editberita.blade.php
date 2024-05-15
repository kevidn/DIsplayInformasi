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
                                <input type="file" name="gambar" id="gambar" class="form-control">

                            </div>
                            <div class="form-group">

                                <textarea class="form-control" id="isiBerita" name="isi" rows="5">{{ $berita->isi }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">UPDATE BERITA</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
