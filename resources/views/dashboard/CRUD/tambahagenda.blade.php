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
              <form action="simpankendaraan.php" method="POST" enctype="multipart/from-data">
             
                
                <div class="form-group">
                  <label>Nama Agenda</label>
                  <input type="text" name="nama_kendaraan" placeholder="Masukkan Nama Agenda" class="form-control">
                </div>

                <div class="form-group">
                  <label>Tempat/Lokasi</label>
                  <input type="text" name="plat_nomor" placeholder="Masukkan Tempat/Lokasi Agenda" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="plat_nomor" class="form-control">
                </div>

             

                <!-- <div class="form-group">
                  <label>Masukan Gambar Mobil</label>
                  <input type="file" name="gambar_kendaraan" class="form-control">
                </div> -->

            
                
                <a class="btn btn-success" href="{{ route('agenda') }}">TAMBAH AGENDA</a>
                <a class="btn btn-warning" href="">RESET</a>
                <!-- <button type="reset" class="btn btn-warning">RESET</button> -->

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
@include('dashboard.partials.corejs')