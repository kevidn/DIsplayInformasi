<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                @if (Request::is('dashboard'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}" target="_blank">
                            <i class="now-ui-icons objects_spaceship"></i>
                            <p><span class="d-lg-none d-md-block"></span>Tampilkan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::check())
                            <a class="nav-link" href="{{ route('akun') }}">
                                @if (Auth::user()->name === 'DefaultAdmin')
                                    <img class="avatar border-gray" src="{{ asset('images/defaultadmin.png') }}" alt="..." style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                @elseif (!Auth::user()->gambarakun)
                                    <img class="avatar border-gray" src="{{ asset('images/defaultakun.jpeg') }}" alt="..." style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                @else
                                    <img class="avatar border-gray" src="{{ asset('storage/user_images/' . Auth::user()->gambarakun) }}" alt="..." style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                @endif
                                <p>
                                    <span class="d-lg-none d-md-block"></span>
                                    {{ Auth::user()->name }} ({{ Auth::user()->userlevel }})
                                </p>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="nav-link" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="now-ui-icons media-1_button-power"></i>
                                <p><span class="d-lg-none d-md-block"></span>Logout</p>
                            </a>
                        </form>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="now-ui-icons tech_watch-time"></i>
                        <p>
                            <span id="tanggalwaktu"></span>
                            <script>
                                function updateClock() {
                                    var dt = new Date();
                                    var hours = dt.getHours().toString().padStart(2, '0');
                                    var minutes = dt.getMinutes().toString().padStart(2, '0');
                                    document.getElementById("tanggalwaktu").innerHTML = hours + ":" + minutes;
                                }
                                setInterval(updateClock, 1000);
                            </script>
                        </p>
                    </a>
                </li>
                @if (Request::is('akun'))
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="nav-link" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="now-ui-icons media-1_button-power"></i>
                                <p><span class="d-lg-none d-md-block"></span>Logout</p>
                            </a>
                        </form>
                    </li>
                @endif
                @if(!Request::is('dashboard'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}" target="_blank">
                            <i class="now-ui-icons objects_spaceship"></i>
                            <p><span class="d-lg-none d-md-block"></span>Tampilkan</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<style>
    /* CSS untuk Navbar */
    @media (max-width: 768px) {
        .navbar-nav .nav-link {
            padding: 10px 15px;
            text-align: center;
        }
    }

    /* CSS untuk Body Overflow saat Tampilan Mobile */
    @media (max-width: 768px) {
        body {
            overflow-y: auto;
        }
    }
</style>
