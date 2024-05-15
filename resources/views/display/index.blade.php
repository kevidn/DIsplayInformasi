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
<body style="background-image: url('/images/bg.jpg'); background-size: 100%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column">

            <!--cuaca-->
            @php
                // Ambil data ikon cuaca dari variabel $cuaca
                $weatherIcon = $cuaca['days'][0]['hours'][intval($currentHour)]['icon'];
            @endphp

            <div class="row mb-3" style="height: 100%; width: 100%;">
                <div style="width: 100%; height: 16%; margin-bottom: 4mm;" class="col-11 p-2 d-flex align-items-center justify-content-center text-white">
                    <img id="weather-icon-indeks" class="mr-2"

                    src="{{ asset('images/icon/' . $weatherIcon . '.png') }}"

                    alt="Weather Icon" style="height: 50px; width: 50px;">
                    <div class="m-0" style="font-family: 'Segoe UI';">
                        <span id="datetime">{{ $cuaca['days'][0]['datetime'] }}</span>
                        <br>
                        <span id="conditions">{{ $cuaca['days'][0]['hours'][intval($currentHour)]['conditions'] }}</span>
                        <br>
                    </div>
                </div>
            </div>

                    <!--berita-->
                    <div class="container" style="height: 590px; width: 100%;">
                        <div class="row" style="width: 100%;">
                            <div id="news-container">
                                @foreach ($berita as $item)
                                <div class="card p-3">
                                    <img class="card-img-top" src="{{ asset('/storage/beritas/upload/'.$item->gambar) }}"></img>
                                    <div class="card-body" style="font-size: 18px;">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                        <div class="card-text">{{ $item->isi }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!--jam-->
                    <div class="row" style="height: 100%; width: 100%">
                        <div style="width: 100%; height: 15%; margin-bottom: 4mm;" class="col-11 d-flex align-items-center justify-content-center text-white">
                            <h6>
                                <div class="p-1"></div>
                                @include("partials.jam")
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="row">
                    <!--header & video-->
                    <div class="col-9" style="height: 540px;">
                        <div style="display: flex; justify-content: space-around; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; text-align: center; color: white; margin: 15px;">
                            @if($header->count() > 0)
                            <img src="{{ asset('/storage/header/upload/' . $header[0]->logo1) }}" alt="Logo 1" style="height: 80px; width: 80px;">
                            @endif

                            SMK FATAHILLAH CILEUNGSI

                            @if($header->count() > 0)
                                    <img src="{{ asset('/storage/header/upload/' . $header[0]->logo2) }}" alt="Logo 2" style="height: 80px; width: 80px;">
                            @endif
                        </div>
                        <div style="display: flex; justify-content:center; margin: 10px;">
                            @if ($videodisplay)
                                <iframe width="580" height="350" src="{{ $videodisplay->youtubelinks }}"
                                    allow="autoplay;"></iframe>
                            @endif

                        </div>

                        <div style="text-align: center; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; color: white; margin: 15px;">
                            SELAMAT DATANG
                        </div>
                    </div>

                    <!--jadwal shalat-->
                    <div class="col-3" style="height: 420px; font-family: 'Segoe UI'; font-weight: bold;">
                        <div style="font-size: 25px; text-align: center; color: white; margin: 15px;">
                            JADWAL SHALAT
                        </div>
                        <div class="container" style="font-size: 140%; border-radius: 15px; background-color: white; width: 100%; height: 400px;">
                            @if($jadwalSholat)
                                    <ul style="color: black;">
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
                    <div class="col-12 d-flex flex-row" style="height: 150px;">
                        @php
                        $counter = 0;
                        @endphp
                        @foreach ($agenda as $item_agenda)
                            @if ($counter < 3)
                                <div class="col-4"> <!-- Tambahkan class col-4 untuk membuat card lebih panjang -->
                                    <div class="card" style="height: 140px; font-size: 13px; margin: 5px;"> <!-- Tambahkan class card dan p-3 -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item_agenda->nama_kegiatan }}</h5>
                                            <hr>
                                            <div class="card-text mb-2">&#128205; Tempat: {{ $item_agenda->tempat }}</div>
                                            <div>&#128197; Tanggal: {{ date('Y-m-d', strtotime($item_agenda->tanggal)) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @php
                        $counter++;
                        @endphp
                        @endforeach
                    </div>
                </div>

                <!--running text-->
                <div class="row">
                    <div class="col-12" style="height: 70px;">
                        <div class="container" style="background-color: white; border-radius: 18px; width: 100%; height: 50px; margin: 10px; color:black; text-align:center;">
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
    var currentNewsIndex = -1; // Mulai dari -1 untuk menampilkan berita pertama segera setelah fungsi dijalankan

    function updateNews() {
        var $newsContainers = $('.card.p-3'); // Ambil semua container card berita
        var totalNews = $newsContainers.length;

        // Sembunyikan semua berita dengan efek fadeOut
        $newsContainers.hide();

        // Geser ke berita selanjutnya
        currentNewsIndex = (currentNewsIndex + 1) % totalNews;

        // Tampilkan berita saat ini dengan efek fadeIn
        $($newsContainers[currentNewsIndex]).fadeIn(500);
    }

    // Panggil fungsi pertama kali
    updateNews();

    // Update berita setiap 5 detik menggunakan setInterval
    setInterval(updateNews, 5000);
});


    function updateWeather() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var weatherIcon = response.days[0].hours[parseInt(response.currentHour)].icon;
                    var datetime = response.days[0].datetime;
                    var conditions = response.days[0].hours[parseInt(response.currentHour)].conditions;

                    document.getElementById('weather-icon-indeks').src = "{{ asset('images/icon/') }}" + '/' + weatherIcon + '.png';
                    document.getElementById('datetime').innerHTML = datetime;
                    document.getElementById('conditions').innerHTML = conditions;
                } else {
                    console.error('Gagal memperbarui cuaca');
                }
            }
        };
        xhr.open('GET', 'URL_ENDPOINT', true);
        xhr.send();
    }

    setInterval(updateWeather, 1800000); // Setiap 30 menit (1800000 ms)
</script>
</body>
</html>
