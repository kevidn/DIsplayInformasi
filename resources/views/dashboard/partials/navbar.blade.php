<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      @if(Request::is('dashboard')) <!-- Check if current page is dashboard -->
      <a class="navbar-brand" href="">Hai, Selamat Datang </a>
      @endif <!-- End if -->
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        @if(Request::is('dashboard')) <!-- Check if current page is dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            <i class="now-ui-icons objects_spaceship"></i>
            <p>
              <span class="d-lg-none d-md-block">Account</span>Tampilkan
            </p>
          </a>
        </li>
        <li class="nav-item">
        @if(Request::is('dashboard') || Request::is('akun'))
          <a class="nav-link" href="{{ route('akun') }}">
         
            <i class="now-ui-icons users_single-02"></i>
            <p>
              <span class="d-lg-none d-md-block">Account</span>
              Account Name
            </p>
          </a>
          @endif <!-- End if -->
        </li>
        <li class="nav-item">
        
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="now-ui-icons media-1_button-power"></i>
            <p>
                <span class="d-lg-none d-md-block">Account</span>Logout
            </p>
        </a>
    </form>
</li>

        @endif <!-- End if -->
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="now-ui-icons tech_watch-time"></i>
            <p>
              <span id="tanggalwaktu"></span>
              <script>
    function updateClock() {
        var dt = new Date();
        var hours = dt.getHours().toString().padStart(2, '0'); // Mengambil jam dengan format 2 digit (dipad dengan '0' jika hanya satu digit)
        var minutes = dt.getMinutes().toString().padStart(2, '0'); // Mengambil menit dengan format 2 digit (dipad dengan '0' jika hanya satu digit)
        document.getElementById("tanggalwaktu").innerHTML = hours + ":" + minutes;
    }

    // Memanggil updateClock setiap detik (1000 milidetik)
    setInterval(updateClock, 1000);
</script>
            </p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
