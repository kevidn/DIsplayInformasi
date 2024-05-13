@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')
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
                <form method="POST" action="{{ route('update_profile') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" value="{{ Auth::check() ? '********' : '' }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <form method="POST" action="{{ route('update_profile') }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form id="logout-form" action="{{ route('hapusakun') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </form>
                        </div>
                    </div>


              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                @if(Auth::check()) <!-- Check if user is logged in -->
                <a href="#" id="changeBackground">
                <img class="background-image" src="{{ Auth::user()->gambarlatar }}" alt="...">
                @endif <!-- End if -->
              </div>
              <div class="card-body">
                <div class="author">
                    <a href="#" id="changeAvatar">
                        @if(Auth::check()) <!-- Check if user is logged in -->
                        <img class="avatar border-gray" src="{{ Auth::user()->gambarakun }}" alt="...">
                        <h5 class="title">{{ Auth::user()->name }}</h5>
                        @endif <!-- End if -->
                    </a>
                    <form id="avatarForm" action="" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" name="avatar" id="avatarInput" accept="image/*">
                    </form>


                    <form id="backgroundForm" action="" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" name="background" id="backgroundInput" accept="image/*">
                    </form>

<script>
   document.getElementById('changeAvatar').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('avatarInput').click();
});

document.getElementById('changeBackground').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('backgroundInput').click();
});



</script>

                </div>
                @if(Auth::check()) <!-- Check if user is logged in -->
                <p class="description text-center">
                    "{{ Auth::user()->quotes }}""
                </p>
                @endif <!-- End if -->
              </div>
              <hr>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@include('dashboard.partials.corejs')
