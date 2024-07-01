@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Menu Header</h2>
        <p class="category">Kamu Bisa Mengubah Dan Menghapus Header Disini</p>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Header</h4>
                    <form action="{{ route('simpanHeader') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="logo1">Logo 1</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo1" name="logo1" required>
                                <label class="custom-file-label" for="logo1">Pilih file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo2">Logo 2</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo2" name="logo2" required>
                                <label class="custom-file-label" for="logo2">Pilih file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Masukkan nama sekolah" required>
                        </div>
                        <div class="form-group">
                            <label for="sambutan">Sambutan</label>
                            <input type="text" class="form-control" id="sambutan" name="sambutan" placeholder="Masukkan sambutan" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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
