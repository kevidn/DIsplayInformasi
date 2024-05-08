@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')


<div class="panel-header panel-header-sm">
</div>

<!--Display-->
<div class="content">
    <div class="row mx-auto mt-4 mb-4">
        <div class="col-md-12">
            <div class="card" style="background-image: url('/images/bg.jpg'); background-size: 140%; font-size: small;">
                <div class="card-body">
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Video Yang DiPutar</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.partials.corejs')
