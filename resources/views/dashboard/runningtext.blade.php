@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')

<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">RUNNING TEXT</h4>


                        <div class="form-group mb-0">



                        </div>

                    </form>
                </div>
                <div class="card-body">
                    <div class="running-text-container">
                        @if ($runningtext->isEmpty())
                            <div class="running-text">

                            </div>
                        @else
                            @foreach ($runningtext as $item_rt)
                                <div class="running-text">
                                    <marquee>{{ $item_rt->RT }}</marquee>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if ($runningtext->isEmpty())
                        <form action="{{ route('simpanRT') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="runningtext"></label>
                                <textarea class="form-control" id="runningText" name="RT" rows="5" placeholder="Tambah Running Text"></textarea>
                            </div>
                            <button type="submit" class="badge badge-success custom-badge buattombol">Tambah Running Text</button>
                        </form>
                    @else
                        <form action="{{ route('updateRt', ['id' => $runningtext[0]->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="runningtext"></label>
                                <textarea class="form-control" id="runningText" name="RT" rows="5">{{ $runningtext[0]->RT }}</textarea>
                            </div>
                            <button type="submit" class="badge badge-warning custom-badge buattombol">Perbaharui Running Text</button>
                        </form>

                        <form action="{{ route('hapusRT', ['id' => $runningtext[0]->id]) }}" method="POST" style="margin-top: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge badge-danger custom-badge buattombol" onclick="return confirm('Apakah Anda yakin ingin menghapus running text ini?')">&#128465; Hapus Running Text</button>
                        </form>
                    @endif
                </div>









                    <style>
                        .custom-badge {
                        font-size: 12px; /* Atur ukuran teks sesuai kebutuhan */
                        color: white;
                        padding: 10px 15px; /* Atur padding sesuai kebutuhan */
                        }
                        .form-control {
                        width: 1010px; /* Sesuaikan lebar input form */
                        margin-right: 10px; /* Sesuaikan jarak antara input dan tombol */
                        }
                        .buattombol {
                        width: 200px; /* Atur panjang sesuai kebutuhan Anda */
                        }


                    </style>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- CSS RUNNING TEXT -->
<style>
    .running-text-container {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        border: 1px solid #ccc;
        height: 60px; /* Sesuaikan tinggi running text */
        display: flex; /* Menggunakan flexbox untuk posisi tengah */
        align-items: center; /* Posisikan teks di tengah secara vertikal */
    }
</style>
@include('dashboard.partials.corejs')
