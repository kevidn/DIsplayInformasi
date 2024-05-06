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
                <h4 class="card-title">TAMBAH AGENDA</h4>

                <div class="row">



            </div>
            <div class="card-body">
                <form action="{{ route('simpanAgenda') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label>Nama Agenda</label>
                        <input type="text" name="nama_kegiatan" placeholder="Masukkan Nama Agenda" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tempat/Lokasi</label>
                        <input type="text" name="tempat" placeholder="Masukkan Tempat/Lokasi Agenda" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">TAMBAH AGENDA</button>
                    <a href="{{ route('agenda') }}" class="btn btn-warning">RESET</a>
                    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                </form>
            </div>




            </div>
          </div>
        </div>

              </div>






              </div>
            </div>
          </div>


    </div>
  </div>
@include('dashboard.partials.corejs')
