<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display - Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color: black;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-3">

                <!--cuaca-->
                <div class="row" style="height: 14%; width: 100%">
                    <div class="col-12 bg-info p-4 " style="display: flex; justify-content:center;">

                    <p>
                        <img style="height: 43px; width: auto;" class="mt-1" src="{{ asset('/images/jam.png') }}" alt="">
                    </p>
                    <p>
                        {{ $cuaca['days'][0]['datetime'] }}
                        <br>
                        {{ $cuaca['days'][0]['conditions'] }}
                    </p>
                    </div>
                </div>

                <!--berita-->
                <div class="row" style="height: 74%; width: 100%;">
                    <div class="col-12 bg-danger">

                        <div class="container mt-3" style="background-color: white; width: 100%; height: 93%"></div>

                    </div>


                </div>

                <!--jam-->
                <div class="row" style="height: 12%; width: 100%;">
                    <div class="col-12 bg-success" style="display: flex; justify-content:center;">

                        <img style="height: 70px; width: 230px;" class="mt-1" src="{{ asset('/images/jam.png') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="col-9">

                <div class="row">
                    <!--header & video-->
                    <div class="col-9 bg-success" style="height: 420px;">
                        <div style="font-size: 20px; text-align: center; color: antiquewhite; margin: 15px;">
                            SMK FATAHILLAH CILEUNGSI
                        </div>
                        <div style="display: flex; justify-content:center; margin: 15px;">
                            <video width="800" height="300" controls>
                                <source src="movie.mp4" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                              </video>
                        </div>
                        <div style="font-size: 20px; text-align: center; color: antiquewhite; margin: 15px;">
                            SELAMAT DATANG
                        </div>
                    </div>

                    <!--jadwal shalat-->
                    <div class="col-3 bg-danger" style="height: 420px;">
                        <div style="font-size: 20px; text-align: center; color: antiquewhite; margin: 15px;">
                            JADWAL SHALAT
                        </div>

                        <div class="container" style="background-color: white; width: 100%; height: 300px"></div>
                    </div>
                </div>

                <!--agenda-->
                <div class="row">
                    <div class="col-12 bg-info d-flex flex-row" style="height: 150px;">

                        <div class="card" style="width: 30%; height: 140px; font-size: 15px; margin: 5px;">
                            <div class="card-body">
                                <div class="card-title"><b>Kegiatan Parenting Wali Murid</b></div>
                                <hr>
                                <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>

                        <div class="card" style="width: 30%; height: 140px; font-size: 15px; margin: 5px;">
                            <div class="card-body">
                                <div class="card-title"><b>Kegiatan Parenting Wali Murid</b></div>
                                <hr>
                                <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>

                        <div class="card" style="width: 30%; height: 140px; font-size: 15px; margin: 5px;">
                            <div class="card-body">
                                <div class="card-title"><b>Kegiatan Parenting Wali Murid</b></div>
                                <hr>
                                <div class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--running text-->
                <div class="row">
                    <div class="col-12 bg-primary" style="height: 70px;">
                        <div class="container" style="background-color: white; width: 100%; height: 50px; margin: 10px; color:black; text-align:center;">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur.
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <p>
            <h1>Cuaca di {{ $cuaca['resolvedAddress'] }}</h1>
            <p><strong>Deskripsi:</strong> {{ $cuaca['description'] }}</p>

            <h2>Prakiraan Cuaca</h2>
            <div>
                <p><strong>Tanggal:</strong> {{ $cuaca['days'][0]['datetime'] }}</p>
                <p><strong>Deskripsi Cuaca:</strong> {{ $cuaca['days'][0]['conditions'] }}</p>
            </div>
        </p> --}}

    </div>
</body>
</html>
