<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display - Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color: black;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column">

                    <!--cuaca-->
                    <div class="row mb-3" style="height: 14%; width: 100%">
                        <div class="col-12 bg-info p-2" style="display: flex; justify-content:center;">
                            <p>
                                {{-- <img style="height: 43px; width: auto;" class="mt-1" src="{{ asset('/images/jam.png') }}" alt=""> --}}
                            </p>
                            <p>

                                {{ $cuaca['days'][0]['datetime'] }}
                                <br>
                                {{ $cuaca['days'][0]['conditions'] }}
                            </p>
                        </div>
                    </div>

                    <!--berita-->

                    <div class="container" style="height: 470px; width: 100%;">
                        <div class="row" style="width: 100%;">
                            <div id="news-container">
                                @foreach ($berita as $item)
                                <div class="card p-3">
                                    <img class="card-img-top" src="{{ asset('/storage/beritas/upload/'.$item->gambar) }}"></img>
                                    <div class="card-body" style="font-size: 15px;">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                        <div class="card-text">{{ $item->isi }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!--jam-->
                    <div class="container" style="height: 50px; width: 375px;">
                        <div class="row" style="height: 12%; width: 100%;">
                            <div class="col-12 bg-success" style="display: flex; justify-content:center;">
                                <h2>
                                    <div class="p-2"></div>
                                    @include("slicing.jam")
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">

                <div class="row">
                    <!--header & video-->
                    <div class="col-9 bg-success" style="height: 420px;">
                        <div style="display: flex; justify-content: space-around; font-size: 25px; font-family: Georgia; font-weight: bold; text-align: center; color: antiquewhite; margin: 15px;">
                            <!-- Logo Pertama -->
                            @if($header->count() > 0)
                            <img src="{{ asset('/storage/header/upload/' . $header[0]->logo1) }}" alt="Logo 1" style="height: 50px; width: 50px;">
                            @endif

                            SMK FATAHILLAH CILEUNGSI

                            @if($header->count() > 0)
                                    <img src="{{ asset('/storage/header/upload/' . $header[0]->logo2) }}" alt="Logo 2" style="height: 50px; width: 50px;">
                            @endif
                        </div>
                        <div style="display: flex; justify-content:center; margin: 10px;">
                            <iframe width="600" height="285"
                                src="https://www.youtube.com/embed/e-B0VKTt5_Q?si=FKDpJryN6XjU7ona"
                                allow = "autoplay;">
                            </iframe>
                        </div>
                        <div style="text-align: center; font-size: 25px; font-family: Georgia; font-weight: bold; color: antiquewhite; margin: 15px;">
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
                        <marquee behavior="" scrollamount='' direction="" class="p-2">

                            @foreach ( $RTs as $item )
                            {{ $item->RT }}
                            @endforeach

                        </marquee>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            var currentNewsIndex = 0;

            function updateNews() {
                var $newsContainers = $('.card.p-3'); // Ambil semua container card berita
                var totalNews = $newsContainers.length;

                // Sembunyikan berita saat ini dengan efek fadeOut
                $($newsContainers[currentNewsIndex]).fadeOut(500, function() {
                    // Geser ke berita selanjutnya
                    currentNewsIndex = (currentNewsIndex + 1) % totalNews;
                    // Tampilkan berita selanjutnya dengan efek fadeIn
                    $($newsContainers[currentNewsIndex]).fadeIn(500);
                });
            }

            // Panggil fungsi pertama kali
            updateNews();

            // Update berita setiap 5 detik menggunakan setInterval
            setInterval(updateNews, 5000);
        });
    </script>
</body>
</html>
