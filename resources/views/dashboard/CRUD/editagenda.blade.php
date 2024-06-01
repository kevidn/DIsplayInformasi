@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT AGENDA</h4>
                </div>
                <div class="card-body">
                    <form name="agendaForm" onsubmit="return validateAgendaForm()" action="{{ route('updateAgenda', ['id' => $agenda->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Agenda</label>
                            <input type="text" name="nama_kegiatan" placeholder="Masukkan Nama Agenda" class="form-control" value="{{ $agenda->nama_kegiatan }}">
                            <span id="namaAgendaError" style="color: red; display: none;">Nama Agenda tidak boleh lebih dari 65 karakter</span>
                        </div>

                        <div class="form-group">
                            <label>Tempat/Lokasi</label>
                            <input type="text" name="tempat" placeholder="Masukkan Tempat/Lokasi Agenda" class="form-control" value="{{ $agenda->tempat }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ $agenda->tanggal }}">
                        </div>

                        <button type="submit" class="btn btn-success">Update Agenda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateAgendaForm() {
        var namaKegiatan = document.forms["agendaForm"]["nama_kegiatan"].value;

        // Reset pesan kesalahan
        var namaAgendaErrorElement = document.getElementById("namaAgendaError");
        namaAgendaErrorElement.style.display = "none";

        // Validasi nama agenda
        if (namaKegiatan == "") {
            alert("Nama Agenda harus diisi");
            return false;
        }
        if (namaKegiatan.length > 65) {
            namaAgendaErrorElement.innerHTML = "Nama Agenda tidak boleh lebih dari 65 karakter";
            namaAgendaErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
            return false;
        }

        return true; // Form akan disubmit jika semua validasi berhasil
    }
</script>

@include('dashboard.partials.corejs')
