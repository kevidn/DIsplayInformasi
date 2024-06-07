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
                        <form name="myForm" action="{{ route('updateBerita', ['id' => $berita->id]) }}" method="POST"  enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}">
                                <span id="judulError" style="color: red; display: none;">Judul Berita tidak boleh lebih dari 80 karakter</span>
                            </div>

                            <div class="form-group">
                                <label>Gambar Berita</label><br>
                                <img class="card-img-top" src="{{ asset('/storage/beritas/upload/'.$berita->gambar) }}" style="width: 550px; height: auto;" alt="Gambar Berita">
                                <div class="form-group"><br>
                                    <label for="gambar" class="btn btn-info" style="font-size: 12px; color: white;">Ganti Gambar Berita</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">
                                    <span id="gambarError" style="color: red; display: none;"></span> <!-- Elemen untuk menampilkan pesan kesalahan -->
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea class="custom-textarea" placeholder="Masukan Isi Berita" id="isiBerita" name="isi" rows="5">{{ $berita->isi }}</textarea>
                                <span id="isiError" style="color: red; display: none;">Isi Berita tidak boleh lebih dari 425 karakter</span> <!-- Elemen untuk menampilkan pesan kesalahan -->
                            </div><hr>

                            <button type="submit" class="btn btn-success">UPDATE BERITA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var judul = document.forms["myForm"]["judul"].value;
        var isi = document.forms["myForm"]["isi"].value;
        var gambar = document.forms["myForm"]["gambar"].files[0]; // Mendapatkan file gambar

        // Reset pesan kesalahan
        var judulErrorElement = document.getElementById("judulError");
        var isiErrorElement = document.getElementById("isiError");
        var gambarErrorElement = document.getElementById("gambarError");

        judulErrorElement.style.display = "none";
        isiErrorElement.style.display = "none";
        gambarErrorElement.style.display = "none";

        // Validasi judul berita
        if (judul == "") {
            alert("Judul Berita harus diisi");
            return false;
        }
        if (judul.length > 80) {
            judulErrorElement.innerHTML = "Judul Berita tidak boleh lebih dari 80 karakter";
            judulErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
            return false;
        }

        // Validasi isi berita
        if (isi == "") {
            alert("Isi Berita harus diisi");
            return false;
        }
        if (isi.length > 425) {
            isiErrorElement.innerHTML = "Isi Berita tidak boleh lebih dari 425 karakter";
            isiErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
            return false;
        }

        // Validasi ukuran file gambar (dalam byte)
        var maxSize = 2 * 1024 * 1024; // 2MB
        if (gambar && gambar.size > maxSize) {
            gambarErrorElement.innerHTML = "Ukuran file gambar tidak boleh lebih dari 2MB";
            gambarErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
            return false;
        }

        return true; // Form akan disubmit jika semua validasi berhasil
    }
</script>

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

@include('dashboard.partials.corejs')
