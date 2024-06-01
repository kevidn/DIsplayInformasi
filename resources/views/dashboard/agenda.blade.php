@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">DAFTAR AGENDA</h4>
                    @if (auth()->user()->userlevel === 'Admin')
                    <a href="{{ route('tambahagenda') }}" class="badge badge-success custom-badge">TAMBAH AGENDA</a>
                    @endif
                    <style>
                        .custom-badge {
                            font-size: 12px; /* Atur ukuran teks sesuai kebutuhan */
                            padding: 10px 15px; /* Atur padding sesuai kebutuhan */
                        }
                    </style>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($agenda as $singleAgenda)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $singleAgenda->nama_kegiatan }}</h5>
                                    <p class="card-text">&#128205; Tempat: {{ $singleAgenda->tempat }}</p>
                                    <p>&#128197; Tanggal: <span class="agenda-tanggal" data-tanggal="{{ $singleAgenda->tanggal }}"></span></p>
                                    @if (auth()->user()->userlevel === 'Admin')
                                    <form action="{{ route('hapusAgenda', $singleAgenda->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('editagenda', ['id' => $singleAgenda->id]) }}" class="btn btn-warning">&#9998; Edit Agenda</a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">&#128465; Hapus Agenda</button>
                                    </form>
                                    @endif
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var agendaTanggalElements = document.querySelectorAll('.agenda-tanggal');

        agendaTanggalElements.forEach(function(element) {
            var tanggal = element.getAttribute('data-tanggal');
            element.textContent = formatTanggal(tanggal);
        });

        function formatTanggal(tanggal) {
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return new Intl.DateTimeFormat('id-ID', options).format(new Date(tanggal));
        }
    });
</script>

@include('dashboard.partials.corejs')
