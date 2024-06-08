@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Daftar Agenda</h2>
        <p class="category">Kamu Bisa Menambah, Mengubah Dan Menghapus Agenda Disini</p>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">

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
                        @php
                            // Menghitung selisih hari antara tanggal agenda dan tanggal hari ini
                            $selisihHari = (strtotime($singleAgenda->tanggal) - strtotime('today')) / (60 * 60 * 24);

                            // Tambahkan kelas CSS tambahan untuk badge berdasarkan selisih hari
                            $badgeClass = $selisihHari < 0 ? 'badge-danger' : ($selisihHari == 0 ? 'badge-success' : '');

                            // Tambahkan juga teks notifikasi sesuai dengan selisih hari
                            $badgeText = $selisihHari < 0 ? 'SUDAH LEWAT ' . abs($selisihHari) . ' HARI' : ($selisihHari == 0 ? 'HARI INI' : '');
                        @endphp


                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $singleAgenda->nama_kegiatan }}</h5>
                                        <p class="card-text">&#128205; Tempat: {{ $singleAgenda->tempat }}</p>
                                        <p>
                                            &#128197; Tanggal: <span class="agenda-tanggal" data-tanggal="{{ $singleAgenda->tanggal }}"></span>
                                            <span class="badge {{ $badgeClass }}">{{ $badgeText }} </span> <!-- Badge pemberitahuan -->
                                        </p>
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
