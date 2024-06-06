@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">DAFTAR BERITA</h4>
                    @if (auth()->user()->userlevel === 'Admin')
                    <a href="{{ route('tambahberita') }}" class="badge badge-success custom-badge">TAMBAH BERITA</a>
                    @endif
                    <style>
                        .custom-badge {
                            font-size: 12px;
                            /* Atur ukuran teks sesuai kebutuhan */
                            padding: 10px 15px;
                            /* Atur padding sesuai kebutuhan */
                        }
                    </style>

                </div>
                <div class="card-body">
                    <div class="card-columns">
                        @foreach ($berita as $singleBerita)
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('/storage/beritas/upload/' . $singleBerita->gambar) }}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $singleBerita->judul }}</h5>
                                    <p class="card-text">{{ $singleBerita->isi }}</p>

                                    @if (auth()->user()->userlevel === 'Admin')
                                        <form action="{{ route('hapusBerita', $singleBerita->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('editberita', ['id' => $singleBerita->id]) }}"
                                                class="btn btn-warning">&#9998; Edit Berita</a>
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">&#128465;
                                                Hapus Berita</button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('dashboard.partials.corejs')
