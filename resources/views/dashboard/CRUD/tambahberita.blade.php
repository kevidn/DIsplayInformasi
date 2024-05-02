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
                <h4 class="card-title">TAMBAH BERITA</h4>
                
                <div class="row">
        
        
             
            </div>
           
            <div class="card-body">
              <form action="simpankendaraan.php" method="POST" enctype="multipart/from-data">
              
                
                <div class="form-group">
                  <label>Judul Berita</label>
                  <input type="text" name="nama_kendaraan" placeholder="Masukkan Judul Berita" class="form-control">
                </div>

                <div class="form-group">
                  <label>Isi Berita</label><br>
                  <input type="textbox" name="plat_nomor" placeholder="Masukan Isi Berita" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Masukan Gambar</label>
                  <input type="file" name="gambar_kendaraan" class="form-control">
                </div>

            
                <a class="btn btn-success" href="{{ route('berita') }}">TAMBAH BERITA</a>
                <a class="btn btn-warning" href="">RESET</a>

              </form>
            </div>
               
                
              </div>
              
            </div>
          </div>
          <!--  -->
      
    </div>
  </div>
@include('dashboard.partials.corejs')