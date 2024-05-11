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
                        <input type="text" name="link_youtube" class="form-control mr-2 custom-input" value="" placeholder="Silahkan Masukkan URL YouTube Disini!">
                        <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($videos as $singleVideo)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    {{-- Badge "Video Ada di Display" --}}
                                    @if ($singleVideo->tampil == 1)
                                    <span class="badge badge-success mb-3">Ditampilkan Ke Display</span><br>
                                    @endif
                                    @if ($singleVideo->tampil == 0)
                                    <span class="badge badge-danger mb-3">Tidak Ditampilkan Ke Display</span><br>
                                    @endif
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $singleVideo->youtubelinks }}" allow="autoplay;"></iframe>
                                    </div>
                                    <div class="mt-3">
                                        {{-- Tombol "Tampilkan Video Ke Display" hanya muncul jika kolom tampil memiliki nilai 0 --}}
                                        @if ($singleVideo->tampil == 0)
                                        <form action="{{ route('tampilkanVideoKeDisplay', $singleVideo->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menampilkan video ini di display?')">
                                                Tampilkan Video Ke Display
                                            </button>
                                        </form>
                                        @endif

                                        {{-- Tombol "Hapus dari Display" hanya muncul jika kolom tampil memiliki nilai 1 --}}
                                        @if ($singleVideo->tampil == 1)
                                        <form action="{{ route('hapusVideoKeDisplay', $singleVideo->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini dari display?')">
                                                Hapus dari Display
                                            </button>
                                        </form>
                                        @endif
                                        @if ($singleVideo->tampil == 0)
                                        <form action="{{ route('hapusVideo', $singleVideo->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">&#128465; Hapus Video</button>
                                        </form>
                                        @endif
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



<style>
    .custom-input {
    width: 1060px; /* Sesuaikan lebar sesuai kebutuhan */
}

</style>

