<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset ('/images/logomonitortrans.png') }}">
    <link rel="icon" type="image/png" href="{{ asset ('/images/logomonitortrans.png') }}">
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
                    <div class="row mb-3" style="height: 100%; width: 100%">
                        <div style="width: 100%; height: 16%; margin-bottom: 4mm;" class="col-11 bg-info p-2 d-flex align-items-center justify-content-center text-white">

                            <!-- Menampilkan icon cuaca -->
                        <img id="weather-icon-indeks" class="mr-2" src="" alt="Weather Icon" style="height: 50px; width: 50px;">
                            <!-- Menampilkan datetime dan conditions -->
                            <p class="m-0 ">
                                {{ $cuaca['days'][0]['datetime'] }}
                                <br>
                                {{ str($cuaca['currentConditions']['conditions']) }}
                            </p>
                        </div>
                    </div>

                    <!--berita-->

                    <div class="container" style="height: 476px; width: 100%;">
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


                    <div class="row mb-3" style="height: 100%; width: 100%">
                        <div style="width: 100%; height: 15%; margin-bottom: 4mm;" class="col-11 bg-success d-flex align-items-center justify-content-center text-white">
                            <h6>
                                <div class="p-2"></div>
                                @include("partials.jam")
                            </h6>
                        </div>
                    </div>


                    {{-- <div class="container" style="height: 50px; width: 112%;">
                        <div class="row" style="height: 11%; width: 100%;">
                            <div class="col-12 bg-success" style="display: flex; justify-content:center;">
                                <h2>
                                    <div class="p-2"></div>
                                    @include("partials.jam")
                                </h2>
                            </div>
                        </div>
                    </div> --}}
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
                                src="https://www.youtube.com/embed/dQw4w9WgXcQ"
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
                        <div class="container" style="font-size: 130%; background-color: white; width: 100%; height: 300px">
                            @if($jadwalSholat)
                                    <ul>
                                        <br>
                                        <li>Subuh: {{ $jadwalSholat['subuh'] }}</li>
                                        <li>Dhuha: {{ $jadwalSholat['dhuha'] }}</li>
                                        <li>Dzuhur: {{ $jadwalSholat['dzuhur'] }}</li>
                                        <li>Ashar: {{ $jadwalSholat['ashar'] }}</li>
                                        <li>Maghrib: {{ $jadwalSholat['maghrib'] }}</li>
                                        <li>Isya: {{ $jadwalSholat['isya'] }}</li>
                                    </ul>
                                    @else
                                        <p>Jadwal sholat untuk hari ini tidak tersedia.</p>
                                    @endif
                        </div>
                    </div>
                </div>

               <!--agenda-->
<div class="row">
    <div class="col-12 bg-info d-flex flex-row" style="height: 150px;">
        @php
        $counter = 0;
        @endphp
        @foreach ($agenda as $item_agenda)
            @if ($counter < 3)
                <div class="col-4"> <!-- Tambahkan class col-4 untuk membuat card lebih panjang -->
                    <div class="card" style="height: 140px; font-size: 14px; margin: 5px;"> <!-- Tambahkan class card dan p-3 -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $item_agenda->nama_kegiatan }}</h5>
                            <p class="card-text">&#128205; Tempat: {{ $item_agenda->tempat }}</p>
                            <p>&#128197; Tanggal: {{ date('Y-m-d', strtotime($item_agenda->tanggal)) }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @php
            $counter++;
            @endphp
        @endforeach





                        {{-- <div class="card" style="width: 30%; height: 140px; font-size: 15px; margin: 5px;">
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
                        </div> --}}

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

        // Berita

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



    // Cuaca


    function setWeatherIcon(weatherCondition) {
        let iconUrl;

        switch (weatherCondition) {
            case 'Partially Cloudy':
                iconUrl = 'https://via.placeholder.com/50?text=Sunny';
                break;
            case 'cloudy':
                iconUrl = 'https://via.placeholder.com/50?text=Cloudy';
                break;
            case 'rainy':
                iconUrl = 'https://via.placeholder.com/50?text=Rainy';
                break;
            default:
                iconUrl = 'https://via.placeholder.com/50?text=Unknown';
        }

        // Mengubah src gambar dengan id 'weather-icon-indeks'
        document.getElementById('weather-icon-indeks').src = iconUrl;
    }

    // Panggil fungsi saat halaman dimuat
    window.onload = function() {
        // Misalnya, $cuaca['days'][0]['conditions'] berisi kondisi cuaca dari API
        let weatherCondition = "{{ str($cuaca['currentConditions']['conditions']) }}";
        setWeatherIcon(weatherCondition);
    };

    </script>


</body>
</html>
