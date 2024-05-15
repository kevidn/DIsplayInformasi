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
          <h4 class="card-title">EDIT AGENDA</h4>

          <div class="row">



      </div>
      <div class="card-body">
        <form action="{{ route('updateAgenda', ['id' => $agenda->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Agenda</label>
                <input type="text" name="nama_kegiatan" placeholder="Masukkan Nama Agenda" class="form-control" value="{{ $agenda->nama_kegiatan }}">
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






        </div>
      </div>
    </div>


</div>
</div>
@include('dashboard.partials.corejs')
