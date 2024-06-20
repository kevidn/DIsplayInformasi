@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Daftar Video</h2>
        <p class="category">Kamu Bisa Menambah, Mengubah Dan Menghapus Video Disini</p>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    @if (auth()->user()->userlevel === 'Admin')
                    <form action="{{ route('simpanVideo') }}" method="POST" class="d-flex align-items-center mb-3 flex-grow-1">
                        @csrf
                        <input type="text" name="link_youtube" class="form-control mr-2 custom-input" value=""
                            placeholder="Video YouTube">
                        <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                    </form>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <form action="{{ route('simpanVideolokal') }}" method="POST" class="d-flex align-items-center mb-3 flex-grow-1"
                    enctype="multipart/form-data" onsubmit="return validateFile()">
                    @csrf
                    <div class="custom-file mr-2 flex-grow-1">
                        <input type="file" name="video_file" class="custom-file-input" id="video_file" accept="video/*">
                        <label class="custom-file-label" for="video_file" id="file_label">Video Lokal</label>
                    </div>
                    <button type="submit" class="badge badge-success custom-badge">TAMBAH VIDEO</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <small id="error_message" class="form-text text-danger"></small>
                </div>
                @endif
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
                                                <span class="badge badge-danger mb-3">Tidak Ditampilkan Ke Display</span><br>
                                            @endif

                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="{{ $singleVideo->youtubelinks }}" allow="autoplay;"></iframe>
                                            </div>

                                            <div class="mt-3">
                                                {{-- Tombol "Tampilkan Video Ke Display" hanya muncul jika kolom tampil memiliki nilai 0 --}}
                                                @if (auth()->user()->userlevel === 'Admin')
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
                                                                &#128465; Hapus dari Display
                                                            </button>
                                                        </form>
                                                    @endif

                                                    {{-- Tombol "Hapus Video" --}}
                                                    <form action="{{ route('hapusVideo', $singleVideo->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
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
                                                <span class="badge badge-danger mb-3">Tidak Ditampilkan Ke Display</span><br>
                                            @endif

                                            <video width="100%" height="auto" controls autoplay muted
                                                poster="{{ asset('storage/videolokal/thumbnails/' . $singleVideo->thumbnail) }}">
                                                <source src="{{ asset('storage/videolokal/' . $singleVideo->videolokal) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>

                                            <div class="mt-3">
                                                {{-- Tombol hanya muncul jika user adalah admin --}}
                                                @if(auth()->user()->userlevel === 'Admin')
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
                                                                &#128465; Hapus dari Display
                                                            </button>
                                                        </form>
                                                    @endif

                                                    {{-- Tombol "Hapus Video" --}}
                                                    <form action="{{ route('hapusVideo', $singleVideo->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
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
@include('dashboard.partials.corejs')

<script>
    document.getElementById('video_file').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : 'Pilih video dari Komputer Anda!';
        document.getElementById('file_label').innerText = fileName;
    });

    function validateFile() {
        var fileInput = document.getElementById('video_file');
        var fileSize = fileInput.files[0].size;
        var maxSize = 100 * 1024 * 1024; // 100MB
        var errorMessage = document.getElementById('error_message');
        errorMessage.innerText = '';

        if (fileSize > maxSize) {
            errorMessage.innerText = 'Ukuran file melebihi 100MB.';
            return false;
        }

        return new Promise((resolve, reject) => {
            var video = document.createElement('video');
            video.preload = 'metadata';

            video.onloadedmetadata = function() {
                window.URL.revokeObjectURL(video.src);
                var duration = video.duration;

                if (duration > 1800) { // 1800 detik = 30 menit
                    errorMessage.innerText = 'Durasi video melebihi 30 menit.';
                    resolve(false);
                } else {
                    resolve(true);
                }
            };

            video.onerror = function() {
                errorMessage.innerText = 'Tidak dapat memuat video. Silakan coba lagi.';
                resolve(false);
            };

            video.src = URL.createObjectURL(fileInput.files[0]);
        });
    }
</script>

<style>
    .custom-input {
        width: 100%;
        /* Adjust width as needed */
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

    @media (max-width: 768px) {
        .custom-input {
            width: 100%;
        }

        .custom-file {
            width: 100%;
        }

        .form-control {
            margin-bottom: 10px;
        }
    }
</style>
