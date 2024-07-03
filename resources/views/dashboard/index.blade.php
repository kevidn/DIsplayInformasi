@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')


<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Hai, Selamat Datang {{ Auth::user()->name }}</h2>
        <p class="category">Ini Adalah Menu Utama Pada Dashboard. Kamu Dapat Melakukan Seluruh Konfigurasi Display Disini.</p>

    </div>
</div>

<!--Display-->
<div class="">
    <div class="row mx-auto mt-4 mb-4">
        <div class="col-md-12">
            <div class="card" style="background-image: url('{{ $bg }}'); background-size: 140%; font-size: small;">
                <div class="card-body" id="preview">
                    @include('display.index')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row mx-auto mt-4 mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <!-- Informasi tambahan -->
                    <div class="row mx-auto mt-4 mb-4 justify-content-center">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-3">
                                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="fas fa-newspaper text-lg opacity-10"></i> <!-- Icon untuk berita -->
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Berita Yang Ditampilkan</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $total_berita }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-3">
                                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="fas fa-calendar-alt text-lg opacity-10"></i> <!-- Icon untuk agenda -->
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Agenda Yang Ditampilkan</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $total_agenda }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-3">
                                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="fas fa-video text-lg opacity-10"></i> <!-- Icon untuk video -->

                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Daftar Video Yang Tersedia</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $total_video }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                               {{-- Tampilkan pesan sukses jika ada --}}
                               @if (session('success'))
                                   <div class="alert alert-success">
                                       {{ session('success') }}
                                   </div>
                               @endif
                       
                               {{-- Form untuk memilih tema --}}
                               <form method="POST" action="{{ route('updateTema') }}">
                                   @csrf
                                   <div class="form-group">
                                       <label for="theme_choice">Pilih Tema:</label>
                                       <select name="theme_choice" id="theme_choice" class="form-control">
                                           @foreach ([
                                               'blue' => [
                                                   'bg' => '/images/bg-blue.jpg',
                                                   'color' => '#00324946'
                                               ],
                                               'green' => [
                                                   'bg' => '/images/bg-green.jpg',
                                                   'color' => '#00491646'
                                               ]
                                           ] as $key => $option)
                                               <option value="{{ $key }}" @if (isset($tema) && $option['bg'] == $tema->bg) selected @endif>{{ ucfirst($key) }} Theme</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <button type="submit" class="btn btn-primary">Simpan Tema</button>
                               </form>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.partials.corejs')
