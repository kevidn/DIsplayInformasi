
    @include('dashboard.partials.title')
    @include('dashboard.partials.sidebar')
    @include('dashboard.partials.navbar')

    <div class="panel-header">
        <div class="header text-center">
            <h2 class="title">Menu Header</h2>
            <p class="category">Kamu Bisa Mengubah Logo dan Kata-Kata Dalam Header Disini</p>
        </div>
    </div>

    <div class="content">
        <div class="row">
            @if (auth()->user()->userlevel === 'Admin')
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Di Dalam Header</h4>
                        <form action="{{ route('simpanHeader') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="logo1">Logo 1 (KIRI)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo1" name="logo1" >
                                    <label class="custom-file-label" for="logo1">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo2">Logo 2 (KANAN)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo2" name="logo2" >
                                    <label class="custom-file-label" for="logo2">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"  maxlength="60" placeholder="Masukkan nama sekolah" >
                            </div>
                            <div class="form-group">
                                <label for="sambutan">Sambutan</label>
                                <input type="text" class="form-control" id="sambutan" name="sambutan"  maxlength="60" placeholder="Masukkan sambutan" >
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- Kotak untuk logo 1 --}}
                            <div class="col-md-6 text-center">
                                <h5>Logo 1 (KIRI) Saat Ini</h5>
                                @if(!empty($header[0]->logo1))
                                    <img src="{{ asset('images/header/logo1/' . $header[0]->logo1) }}" >
                                @else
                                    <p>Belum ada logo yang dipilih.</p>
                                @endif
                            </div>

                            {{-- Kotak untuk logo 2 --}}
                            <div class="col-md-6 text-center">
                                <h5>Logo 2 (KANAN) Saat Ini</h5>
                                @if(!empty($header[0]->logo2))
                                    <img src="{{ asset('images/header/logo2/' . $header[0]->logo2) }}">
                                @else
                                    <p>Belum ada logo yang dipilih.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.partials.corejs')

    <!-- Script to show the file name when a file is selected -->
    <script>
        document.querySelectorAll('.custom-file-input').forEach((input) => {
            input.addEventListener('change', function() {
                let fileName = this.files[0].name;
                let nextSibling = this.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        });
    </script>

