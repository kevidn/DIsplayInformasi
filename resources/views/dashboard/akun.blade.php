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
                    <h5 class="title">Account Settings</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    @if (Auth::check() && Auth::user()->name === 'DefaultAdmin')
                                        <!-- Jika akun yang login adalah DefaultAdmin -->
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" disabled>
                                        <small class="form-text text-muted text-danger" style="font-size: 10px;">This account cannot be renamed.</small>
                                    @else
                                        <!-- Jika bukan DefaultAdmin -->
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="{{ Auth::check() ? '********' : '' }}">
                                </div>
                            </div>


                            <div class="col-md-10 pr-1">
                                <div class="form-group">
                                    @if (Auth::check() && Auth::user()->name)
                                        <!-- Check if user is logged in and has a name -->
                                        <label for="quotes">About You</label>
                                        <textarea class="form-control" id="quotes" name="quotes" rows="5">{{ Auth::user()->quotes }}</textarea>
                                    @else
                                        <!-- Redirect ke halaman login jika pengguna belum masuk -->
                                        <script>
                                            window.location.href = "{{ route('login') }}";
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label for="gambar_akun" class="badge badge-warning"
                                        style="font-size: 12px; color: white;">Change Profile Picture</label>
                                    <input type="file" class="form-control" id="gambar_akun" name="gambar_akun"
                                        accept="image/*" onchange="validateAkunForm()">
                                    <span id="gambarAkunError" style="color: red; display: none;">Ukuran file gambar
                                        akun tidak boleh lebih dari 2MB</span>
                                    <!-- Elemen untuk menampilkan pesan kesalahan -->
                                </div>
                            </div>

                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label for="gambar_latar" class="badge badge-warning"
                                        style="font-size: 12px; color: white;"> Change Background Profile</label>
                                    <input type="file" class="form-control" id="gambar_latar" name="gambar_latar"
                                        accept="image/*" onchange="validateLatarForm()">
                                    <span id="gambarLatarError" style="color: red; display: none;">Ukuran file gambar
                                        latar tidak boleh lebih dari 2MB</span>
                                    <!-- Elemen untuk menampilkan pesan kesalahan -->
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <button type="submit" class="btn btn-success tombol">Update Profile</button>
                            </div>

                            <div class="col-md-3 pr-1"">
                                @if (Auth::check() && Auth::user()->name !== 'DefaultAdmin')
                                    <form id="logout-form" action="{{ route('hapusakun') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger tombol">&#128465; Delete
                                            Account</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            @if (auth()->user()->userlevel === 'Admin')
<div class="card">
    <div class="card-header">
        <h5 class="title">Account Management</h5>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach ($users as $user)
            <li class="list-group-item d-flex align-items-center flex-wrap">
                @if($user->name === 'DefaultAdmin')
                <img src="{{ asset('images/defaultadmin.png') }}" alt="Profile Image" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                @elseif(!$user->gambarakun)
                <img src="{{ asset('images/defaultakun.jpeg') }}" alt="Profile Image" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                @else
                <img src="{{ asset('storage/user_images/' . $user->gambarakun) }}" alt="Profile Image" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                @endif

                <div class="d-flex align-items-center flex-grow-1">
                    <h5 class="mb-0 custom-font-size">{{ $user->name }}</h5>
                    <style>
                        .custom-font-size {
                            font-size: 17px;
                        }

                        .custom-font-size-badge {
                            font-size: 11px;
                        }
                    </style>
                    <span style="margin-left: 5px;"></span>
                    @if (Auth::user()->id === $user->id)
                    <span class="badge badge-success custom-font-size-badge">Anda</span>
                    @elseif ($user->name === 'DefaultAdmin')
                    <span class="badge badge-primary custom-font-size-badge">Admin</span>
                    @elseif ($user->userlevel === 'Admin')
                    <span class="badge badge-info custom-font-size-badge">{{ $user->userlevel }}</span>
                    @elseif ($user->userlevel === 'Guest')
                    <span class="badge badge-dark custom-font-size-badge">{{ $user->userlevel }}</span>
                    @endif
                </div>

                <div class="ml-auto mt-2 mt-md-0">
                    @if (Auth::user()->id !== $user->id && $user->name !== 'DefaultAdmin')
                    <form action="{{ route('ubahlevel', ['id' => $user->id, 'newLevel' => $user->userlevel === 'Admin' ? 'Guest' : 'Admin']) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengubah peran pengguna ini menjadi {{ $user->userlevel === 'Admin' ? 'Guest' : 'Admin' }}?')">
                            {{ $user->userlevel === 'Admin' ? 'Make Guest' : 'Make Admin' }}
                        </button>
                    </form>

                    <form action="{{ route('hapusakunmanagemen', ['user_id' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Delete</button>
                    </form>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<style>

 /* CSS untuk Body Overflow saat Tampilan Mobile */
 @media (max-width: 768px) {
        body {
            overflow-y: auto;
        }
    }
    @media (max-width: 768px) {
        .list-group-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .ml-auto {
            margin-left: 0 !important;
            margin-top: 10px;
        }

        .custom-font-size {
            font-size: 15px;
        }

        .custom-font-size-badge {
            font-size: 9px;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }

        .rounded-circle {
            width: 40px;
            height: 40px;
        }
    }
</style>






        </div>


        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">

                    @if (Auth::check())
                        <a id="changeBackground">
                            @if(!Auth::user()->gambarlatar)
                            <img class="background-image" src="{{ asset('images/defaultlatar.jpg') }}" alt="...">
                        @else
                            <img class="background-image" src="{{ asset('storage/user_backgrounds/' . Auth::user()->gambarlatar) }}" alt="...">
                        </a>
                        @endif
                </div>
                @endif
                <div class="card-body">
                    <div class="author">
                        <a id="changeAvatar">

                            @if(Auth::check())
                            @if(Auth::user()->name === 'DefaultAdmin')
                                <img class="avatar border-gray" src="{{ asset('images/defaultadmin.png') }}" alt="...">
                            @elseif(!Auth::user()->gambarakun)
                                <img class="avatar border-gray" src="{{ asset('images/defaultakun.jpeg') }}" alt="...">
                            @else
                                <img class="avatar border-gray" src="{{ asset('storage/user_images/' . Auth::user()->gambarakun) }}" alt="...">
                            @endif
                            <h5 class="title">{{ Auth::user()->name }} ({{ Auth::user()->userlevel }})</h5>
                        @endif



                        </a>



                        <!-- Check if user is logged in -->
                        <p class="description text-center">
                            @if (Auth::check() && Auth::user()->name)
                                <!-- Check if user is logged in and has a name -->
                                "{{ Auth::user()->quotes }}"
                        </p>
                    @else
                        <!-- Redirect ke halaman login jika pengguna belum masuk -->
                        <script>
                            window.location.href = "{{ route('login') }}";
                        </script>
                        @endif

                        <style>
                            /* Mengatur ukuran tombol */
                            .tombol {

                                padding: 8px 16px;
                                /* Padding tombol (atas/bawah, kiri/kanan) */
                                width: 140px;
                                /* Lebar tombol dalam piksel */
                            }
                        </style>
                        @include('dashboard.partials.corejs')
                        <script>
                            function validateAkunForm() {
                                var gambarAkun = document.getElementById("gambar_akun").files[0]; // Mendapatkan file gambar akun

                                // Validasi ukuran file gambar akun (dalam byte)
                                var maxSize = 2 * 1024 * 1024; // 2MB
                                if (gambarAkun && gambarAkun.size > maxSize) {
                                    var gambarAkunErrorElement = document.getElementById("gambarAkunError");
                                    gambarAkunErrorElement.innerHTML = "Ukuran file gambar akun tidak boleh lebih dari 2MB";
                                    gambarAkunErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
                                    return false;
                                }

                                return true; // Form akan disubmit jika semua validasi berhasil
                            }

                            function validateLatarForm() {
                                var gambarLatar = document.getElementById("gambar_latar").files[0]; // Mendapatkan file gambar latar

                                // Validasi ukuran file gambar latar (dalam byte)
                                var maxSize = 2 * 1024 * 1024; // 2MB
                                if (gambarLatar && gambarLatar.size > maxSize) {
                                    var gambarLatarErrorElement = document.getElementById("gambarLatarError");
                                    gambarLatarErrorElement.innerHTML = "Ukuran file gambar latar tidak boleh lebih dari 2MB";
                                    gambarLatarErrorElement.style.display = "block"; // Menampilkan pesan kesalahan
                                    return false;
                                }

                                return true; // Form akan disubmit jika semua validasi berhasil
                            }
                        </script>
