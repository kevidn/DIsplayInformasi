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
                    <a href="{{ route('tambahagenda') }}" class="badge badge-success custom-badge">TAMBAH AGENDA</a>
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
                                <p>&#128197; Tanggal: {{ $singleAgenda->tanggal }}</p>
                                <form action="{{ route('hapusAgenda', $singleAgenda->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('editagenda', ['id' => $singleAgenda->id]) }}" class="btn btn-warning">&#9998; Edit Agenda</a>

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">&#128465; Hapus Agenda</button>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

@include('dashboard.partials.corejs')




