@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form action="{{ route('simpanVideo') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="text" name="link_youtube" class="form-control mr-2 custom-input" value=""
                            placeholder="Silahkan Masukkan URL YouTube Disini!" style="width: 400px;">
                        <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                    </form>
                    <form action="{{ route('simpanVideolokal') }}" method="POST" class="d-flex align-items-center"
                    enctype="multipart/form-data" onsubmit="return validateFileSize()">
                    @csrf
                    <div class="custom-file" style="width: 400px; margin-right: 10px;">
                        <input type="file" name="video_file" class="custom-file-input" id="video_file">
                        <label class="custom-file-label" for="video_file" id="file_label">Pilih video dari Komputer Anda!</label>
                    </div>
                    <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                </form>

                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($videos as $singleVideo)
                            @if ($singleVideo->youtubelinks)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            {{-- Badge "Video Ada di Display" --}}
                                            @if ($singleVideo->tampil == 1)
                                                <span class="badge badge-success mb-3">Ditampilkan Ke Display</span><br>
                                            @elseif ($singleVideo->tampil == 0)
                                                <span class="badge badge-danger mb-3">Tidak Ditampilkan Ke
                                                    Display</span><br>
                                            @endif

                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item"
                                                    src="{{ $singleVideo->youtubelinks }}" allow="autoplay;"></iframe>
                                            </div>

                                            <div class="mt-3">
                                                {{-- Tombol "Tampilkan Video Ke Display" hanya muncul jika kolom tampil memiliki nilai 0 --}}
                                                @if ($singleVideo->tampil == 0)
                                                    <form
                                                        action="{{ route('tampilkanVideoKeDisplay', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"
                                                            onclick="return confirm('Apakah Anda yakin ingin menampilkan video ini di display?')">
                                                            Tampilkan Video Ke Display
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Tombol "Hapus dari Display" hanya muncul jika kolom tampil memiliki nilai 1 --}}
                                                @if ($singleVideo->tampil == 1)
                                                    <form action="{{ route('hapusVideoKeDisplay', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus video ini dari display?')">
                                                            &#128465; Hapus dari Display
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Tombol "Hapus Video" --}}
                                                @if ($singleVideo->tampil == 0)
                                                    <form action="{{ route('hapusVideo', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                                            &#128465; Hapus Video
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($singleVideo->videolokal)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            {{-- Badge "Video Ada di Display" --}}
                                            @if ($singleVideo->tampil == 1)
                                                <span class="badge badge-success mb-3">Ditampilkan Ke Display</span><br>
                                            @elseif ($singleVideo->tampil == 0)
                                                <span class="badge badge-danger mb-3">Tidak Ditampilkan Ke
                                                    Display</span><br>
                                            @endif

                                            <video width="100%" height="auto" controls autoplay muted
                                                poster="{{ asset('storage/videolokal/thumbnails/' . $singleVideo->thumbnail) }}">
                                                <source
                                                    src="{{ asset('storage/videolokal/' . $singleVideo->videolokal) }}"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>




                                            <div class="mt-3">
                                                {{-- Tombol "Tampilkan Video Ke Display" hanya muncul jika kolom tampil memiliki nilai 0 --}}
                                                @if ($singleVideo->tampil == 0)
                                                    <form
                                                        action="{{ route('tampilkanVideoKeDisplay', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success"
                                                            onclick="return confirm('Apakah Anda yakin ingin menampilkan video ini di display?')">
                                                            Tampilkan Video Ke Display
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Tombol "Hapus dari Display" hanya muncul jika kolom tampil memiliki nilai 1 --}}
                                                @if ($singleVideo->tampil == 1)
                                                    <form action="{{ route('hapusVideoKeDisplay', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus video ini dari display?')">
                                                            &#128465; Hapus dari Display
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Tombol "Hapus Video" --}}
                                                @if ($singleVideo->tampil == 0)
                                                    <form action="{{ route('hapusVideo', $singleVideo->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                                            &#128465; Hapus Video
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('video_file').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files
    });


</script>

<style>
    .custom-input {
        width: 1060px;
        /* Sesuaikan lebar sesuai kebutuhan */
    }

    .custom-file-input {
        display: none;
    }

    .custom-file-label {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        cursor: pointer;
        display: inline-block;
        width: 100%;
    }

    .form-control,
    .custom-badge {
        height: 38px;
    }

    .badge {
        line-height: 1.5;
    }
</style>
