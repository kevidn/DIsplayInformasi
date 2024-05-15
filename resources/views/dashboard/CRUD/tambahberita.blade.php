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
                    <form name="myForm" action="{{ route('simpanBerita') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                        @csrf <!-- Tambahkan csrf token untuk keamanan -->
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" name="judul" placeholder="Masukkan Judul Berita" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label><br>
                            <textarea class="custom-textarea" placeholder="Masukan Isi Berita" id="isiBerita" name="isi" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar"  class="btn btn-info"  style="font-size: 12px; color: white;">Pilih Gambar Berita</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required><hr>
                        </div>
                        <button type="submit" class="btn btn-success">TAMBAH BERITA</button>

                    </form>
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
    </div>
</div>
<script>
    function validateForm() {
        var judul = document.forms["myForm"]["judul"].value;
        var isi = document.forms["myForm"]["isi"].value;



        if (isi.length > 255) {
            alert("Isi Berita tidak boleh lebih dari 255 karakter");
            return false;
        }
    }
</script>


@include('dashboard.partials.corejs')
