<!-- SIDEBAR START -->
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
    <div class="logo">

        <a href="" class="simple-text">
          <img class="avatar border-gray" src="{{ asset ('/images/logobulet.png') }}" width="20%" alt="...">
          Display Informasi
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="now-ui-icons travel_info"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="{{ Request::is('berita*') || Request::is('tambahberita') || Request::is('editberita/*') ? 'active' : '' }}">
    <a href="{{ route('berita') }}">
        <i class="now-ui-icons education_paper"></i>
        <p>List Berita</p>
    </a>
</li>
    <li class="{{ Request::is('agenda') || Request::is('tambahagenda') || Request::is('editagenda/*') ? 'active' : '' }}">
        <a href="{{ route('agenda') }}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p> List Agenda</p>
        </a>
    </li>
    <li class="{{ Request::is('slideinformation') ? 'active' : '' }}">
        <a href="{{ route('slideinformation') }}">
            <i class="now-ui-icons files_paper"></i>
            <p>Slide Information</p>
        </a>
    </li>
    <li class="{{ Request::is('header') ? 'active' : '' }}">
        <a href="{{ route('header') }}">
            <i class="now-ui-icons business_badge"></i>
            <p>Header</p>
        </a>
    </li>
          <li class="{{ Request::is('video') ? 'active' : '' }}">
            <a href="{{ route('video') }}">
              <i class="now-ui-icons media-1_button-play"></i>
              <p>Video</p>
            </a>
          </li>
          <li class="{{ Request::is('runningtext') ? 'active' : '' }}">
            <a href="{{ route('runningtext') }}">
              <i class="now-ui-icons sport_user-run"></i>
              <p>Running Text</p>
            </a>
          </li>
    <!-- Sisipkan kode untuk link lainnya -->
</ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
    <!-- SIDEBAR END -->
