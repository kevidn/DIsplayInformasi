
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Display Informasi
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('/demo/demo.css" rel="stylesheet') }}" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
       
        <a href="" class="simple-text">
          <img class="avatar border-gray" src="{{ asset ('/images/logobulet.png') }}" width="20%" alt="...">
          Display Informasi
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('dashboard') }}">
              <i class="now-ui-icons travel_info"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ route('berita') }}">
              <i class="now-ui-icons education_paper"></i>
              <p>List Berita</p>
            </a>
          </li>
          <li>
            <a href="{{ route('agenda') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p> List Agenda</p>
            </a>
          </li>
          <li>
            <a href="">
              <i class="now-ui-icons objects_umbrella-13"></i>
              <p>Cuaca</p>
            </a>
          </li>
          <li>
            <a href="">
              <i class="now-ui-icons travel_istanbul"></i>
              <p>Jadwal Sholat</p>
            </a>
          </li>
          <li>
            <a href="">
              <i class="now-ui-icons media-1_button-play"></i>
              <p>Video</p>
            </a>
          </li>
          <li>
            <a href="">
              <i class="now-ui-icons sport_user-run"></i>
              <p>Running Text</p>
            </a>
          </li>
          <!-- <li>
            <a href="./icons.html">
              <i class="now-ui-icons education_atom"></i>
              <p></p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p></p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p></p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p></p>
            </a>
          </li>
         
          <li>
            <a href="./typography.html">
              <i class="now-ui-icons text_caps-small"></i>
              <p></p>
            </a>
          </li> -->
          
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <!-- <a class="navbar-brand" href="#pablo">Table List</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="">
                <i class="now-ui-icons tech_watch-time"></i>
                <p>
                  
                  <span class="" id="tanggalwaktu"></span>
                  <script>
                    var dt = new Date();
                    document.getElementById("tanggalwaktu").innerHTML = dt.toLocaleTimeString();
                    </script>
                </p>
              </a>
              
            </li>
            <!-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form> -->
            <!-- <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul> -->
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
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
                  <label>Nama Judul Berita</label>
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
  <!--   Core JS Files   -->

  
  <script src="{{ asset('/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset ('/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('/demo/demo.js')}}"></script>
</body>

</html>


  <!-- DIAMANKAN UNTUK AKUN -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.html">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
                <p>
                  <span class="d-lg-none d-md-block">Account</span>Kembali ke Dashboard
                </p>
              </a>
            </li>
            <!-- <a class="navbar-brand" href="dashboard.html">Kembali ke Dashboard</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              
              <li class="nav-item">
                <a class="nav-link" href="">
                  <i class="now-ui-icons media-1_button-power"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>Logout
                  </p>
                </a>
              </li>
              
                <li class="nav-item">
                  <a class="nav-link" href="">
                    <i class="now-ui-icons tech_watch-time"></i>
                    <p>
                      
                      <span class="" id="tanggalwaktu"></span>
                      <script>
                        var dt = new Date();
                        document.getElementById("tanggalwaktu").innerHTML = dt.toLocaleTimeString();
                        </script>
                    </p>
                  </a>
                  
                </li>
              
            </ul>
            <!-- <form>
              <div class="input-group no-border">
                <button class="form-control btn-primary" >Update Profile</button>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <!-- <i class="now-ui-icons ui-1_zoom-bold"></i> -->
                  </div>
                </div>
              </div>
            </form>
           
            
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                
                <h5 class="title">Edit Profile</h5>
              </div>
            
              <div class="card-body">
                <form>
                  <div class="row">
                    <!-- <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                      </div>
                    </div> -->
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" >
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder=" User Email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" placeholder="User Full Name" >
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="User Addres">
                      </div>
                    </div>
                  </div>
                 
                  
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src=" {{ asset('/images/mobilhaikal.png') }}" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="{{ asset ('/images/mashaikal.jpg') }}" alt="...">
                    <h5 class="title">User FullName</h5>
                  </a>
                  <p class="description">
                    Username
                  </p>
                </div>
                <p class="description text-center">
                  "Lamborghini Mercy <br>
                  Your chick she so thirsty <br>
                  I'm in that two seat Lambo"
                </p>
              </div>
              <hr>
              <!-- <div class="button-container">
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-google-plus-g"></i>
                </button>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset ('/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('/demo/demo.js')}}"></script>
</body>

</html>