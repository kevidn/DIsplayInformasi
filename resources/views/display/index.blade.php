<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/images/logomonitortrans.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/images/logomonitortrans.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display - Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <style>
        .card-transition {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in {
            opacity: 1;
        }

        /* Tambahkan gaya CSS ini ke file CSS Anda atau di dalam tag <style> di halaman Anda */
        .card hr {
            margin-top: 6px; /* Atur margin atas */
            margin-bottom: 6px; /* Atur margin bawah */
            border: none; /* Hapus border default */
            border-top: 1px solid #000000; /* Tambahkan border atas */
        }

    </style>



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

                    @if (Request::is("index"))

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.body.style.zoom = '110%';
                        });
                    </script>

                        <div class="row mb-3" style="height: 100%; width: 100%;">
                            <div style="width: 100%; height: 16%; margin-bottom: 3mm; background-color: #00324946; margin: 10px; border-radius: 15px; padding: 5px;" class="col-11 d-flex align-items-center text-white">
                                <div class="d-flex align-items-center" style="width: 100%;">
                                    <img id="weather-icon-indeks" class="ml-2" src="{{ asset('images/icon/' . $weatherIcon . '.png') }}" alt="Weather Icon" style="margin-left: 15px; width: 30%; height: 30%;" >

                                    <div class="row" style="width: 100%; margin-left: 10px;">
                                        <!--jam-->
                                        <div class="col-12 d-flex align-items-center justify-content-center text-white">
                                            <h6>
                                                <div class="p-1"></div>
                                                @include('partials.jam')
                                            </h6>
                                        </div>

                                        <!-- Tanggal dan kondisi cuaca -->
                                        <div class="col-12 text-center mt-2" style="font-family: 'Segoe UI'; font-size: 18px; margin-bottom: 15px;">
                                            <span id="datetime">{{ $date }}</span>
                                            <br>
                                            <span id="conditions">{{ $cuaca['days'][0]['hours'][intval($currentHour)]['conditions'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="row mb-3" style="height: 100%; width: 100%;">
                            <div style="width: 100%; height: 16%; margin-bottom: 3mm; background-color: #00324946; margin: 10px; border-radius: 15px; padding: 2px;" class="col-11 d-flex align-items-center text-white">
                                <div class="d-flex align-items-center" style="width: 100%;">
                                    <img id="weather-icon-indeks" src="{{ asset('images/icon/' . $weatherIcon . '.png') }}" alt="Weather Icon" class="ml-4" style="width: 45%; height: 45%;">
                                    <div class="row" style="width: 100%; margin-left: 10px;">
                                        <!--jam-->
                                        <div class="col-12 d-flex align-items-center justify-content-center text-white">
                                            <h6>
                                                <div class="p-1"></div>
                                                @include('partials.jam')
                                            </h6>
                                        </div>

                                        <!-- Tanggal dan kondisi cuaca -->
                                        <div class="col-12 text-center mt-2" style="font-family: 'Segoe UI'; font-size: 13px; margin-bottom: 15px;">
                                            <span id="datetime">{{ $date}}</span>
                                            <br>
                                            <span id="conditions">{{ $cuaca['days'][0]['hours'][intval($currentHour)]['conditions'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif



                    <!--berita-->
                    <div class="container" style="height: 530px; width: 100%;">
                        <div class="row" style="width: 100%;">
                            <div id="news-container" style="background-color: #00324946; padding: 10px; border-radius: 15px; height: 565px">
                                <div style="background-color: #ffffff; padding: 10px; border-radius: 15px; height: 540px;">
                                    @foreach ($berita as $item)

                                        <div class="card berita p-1">

                                            <img style="max-height: 150px;" class="card-img-top"
                                                src="{{ asset('/storage/beritas/upload/' . $item->gambar) }}"></img>

                                            @if (Request::is("index"))
                                                <div class="card-body" style="font-size: 18px;">
                                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                                    <div style="font-size: 13px; text-align: justify; text-justify: inter-word;" class="card-text">
                                                        {{ Str::limit($item->isi, 500, '...') }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-body" style="font-size: 15px;">
                                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                                    <div style="font-size: 11px; text-align: justify; text-justify: inter-word;" class="card-text">
                                                        {{ Str::limit($item->isi, 275, '...') }}
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-9">
                <div class="row">

                    <!--header & video-->
                    <div class="col-9" style="height: 550px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; text-align: center; color: white; margin: 10px; border-radius: 15px; background-color: #00324946; padding: 5px;">
                            <img src="{{ asset('/images/bogor.png') }}" alt="Logo 1" style="height: 75px; width: 110px;">
                            <div style="flex-grow: 1; display: flex; justify-content: center;">
                                SMK FATAHILLAH CILEUNGSI
                            </div>
                            <img src="{{ asset('/images/fatahillah.png') }}" alt="Logo 2" style="height: 75px; width: 75px;">
                        </div>

                        <div style="display: flex; justify-content:center; margin: 10px;">
                            @if ($videodisplay && $videodisplay->tampil == 1)
                                @if ($videodisplay->youtubelinks)
                                    {{-- Jika video dari YouTube --}}
                                    <iframe width="800" height="375" src="{{ $videodisplay->youtubelinks }}" allow="autoplay" autoplay></iframe>
                                @elseif ($videodisplay->videolokal)
                                    {{-- Jika video dari lokal --}}
                                    <video width="800" height="375" controls autoplay muted loop>
                                        <source src="{{ asset('storage/videolokal/' . $videodisplay->videolokal) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    {{-- Jika tidak ada video dari YouTube atau lokal --}}
                                    <video width="800" height="375" controls autoplay muted loop>
                                        <source src="{{ asset('videos/dummy.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            @else
                                {{-- Jika tidak ada video yang tersedia --}}
                                <video width="800" height="375" controls autoplay muted loop>
                                    <source src="{{ asset('videos/dummy.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>


                        <div style="text-align: center; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; color: white; margin: 15px;">
                            SELAMAT DATANG
                        </div>
                    </div>

                    <!--jadwal shalat-->
                    <div class="col-3" style="height: 410px; font-family: 'Segoe UI'; font-weight: bold;">
                        <div style="display: flex; justify-content: center; align-items: center; font-size: 25px; text-align: center; color: white; margin-top: 10px; border-radius: 15px; background-color: #00324946; padding: 5px; width: 100%; height: 85px;">
                            JADWAL SHALAT
                        </div>

                        <div class="container" style="font-size: 140%; border-radius: 15px; background-color: #00324946; width: 100%; height: 400px;">
                            @if ($jadwalSholat)
                                <div style="color: white; margin: 8px; text-align: center;">
                                    <div style="margin-top: 13px;">_______________</div>
                                    <div style="margin-top: 9px;">Subuh: {{ $jadwalSholat['subuh'] }}</div>
                                    <div style="margin-top: 9px;">Dhuha: {{ $jadwalSholat['dhuha'] }}</div>
                                    <div style="margin-top: 9px;">Dzuhur: {{ $jadwalSholat['dzuhur'] }}</div>
                                    <div style="margin-top: 9px;">Ashar: {{ $jadwalSholat['ashar'] }}</div>
                                    <div style="margin-top: 9px;">Maghrib: {{ $jadwalSholat['maghrib'] }}</div>
                                    <div style="margin-top: 9px;">Isya: {{ $jadwalSholat['isya'] }}</div>
                                    <div>_______________</div>
                                    <div style="font-size: 45px">🕌</div>
                                </div>
                            @else
                                <p>Jadwal sholat untuk hari ini tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- agenda -->
                <div id="agenda-container" class="row" style="background-color: #00324946; border-radius: 18px; padding: 8px; width: 98%; overflow: auto;">
                    <div class="col-12 d-flex flex-row" id="agenda-content">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($agenda as $item_agenda)
                            @if ($counter < 3)
                                <div class="col-4">
                                    <div class="card" style="height: 950px; margin: 5px;">
                                        <div class="card-body">
                                            <p class="card-text">{{ $item_agenda->nama_kegiatan }}</p>
                                            <hr>
                                            <div class="card-text mb-2">&#128205; Tempat: {{ $item_agenda->tempat }}</div>
                                            <div class="card-text">&#128197; Tanggal: {{ date('D-m-y', strtotime($item_agenda->tanggal)) }}</div>
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
                    <div class="col-12" style="height: 35px;">
                        <div class="container"
                            style="background-color: #00324946; border-radius: 18px; width: 94%; height: 35px; margin: 5px; color:white; text-align:center;">
                            <marquee behavior="" scrollamount='' direction="" class="p-2">
                                @foreach ($RTs as $item)
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

    //Agenda

    var currentAgendaIndex = 0;
var agendaItems = {!! json_encode($agenda) !!}; // Ambil data agenda dari PHP

function formatTanggal(tanggal) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Intl.DateTimeFormat('id-ID', options).format(new Date(tanggal));
}

function updateAgenda() {
    var agendaContent = document.getElementById('agenda-content');

    // Tambahkan kelas fade-out sebelum mengubah konten
    agendaContent.classList.add('fade-out');
    agendaContent.classList.remove('fade-in');

    // Gunakan setTimeout untuk menunggu transisi selesai
    setTimeout(function() {
        var newHTML = '';
        for (var i = currentAgendaIndex; i < currentAgendaIndex + 3 && i < agendaItems.length; i++) {
            var agenda = agendaItems[i];
            newHTML += `
                <div class="col-4 card-transition fade-in">
                    <div class="card" style="height: 140px; font-size: 12px; margin: 5px;">
                        <div class="card-body">
                            <h6 class="card-title">${agenda.nama_kegiatan}</h6>
                            <hr>
                            <div class="card-text mb-2">&#128205; Tempat: ${agenda.tempat}</div>
                            <div>&#128197; Tanggal: ${formatTanggal(agenda.tanggal)}</div>
                        </div>
                    </div>
                </div>
            `;
        }

        agendaContent.innerHTML = newHTML;

        // Hapus kelas fade-out dan tambahkan kelas fade-in setelah mengubah konten
        agendaContent.classList.remove('fade-out');
        agendaContent.classList.add('fade-in');
    }, 500); // Durasi sesuai dengan durasi transisi CSS

    currentAgendaIndex += 3;
    if (currentAgendaIndex >= agendaItems.length) {
        currentAgendaIndex = 0; // Reset index jika sudah mencapai akhir data
    }
}

setInterval(updateAgenda, 15000); // Update agenda setiap 15 detik (15000 ms)
updateAgenda(); // Panggil fungsi pertama kali saat halaman dimuat




    // Berita
        $(document).ready(function() {
            var currentNewsIndex = -
                1; // Mulai dari -1 untuk menampilkan berita pertama segera setelah fungsi dijalankan

            function updateNews() {
                var $newsContainers = $('.card.berita.p-1'); // Ambil semua container card berita
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

            // Update berita setiap 20 detik menggunakan setInterval
            setInterval(updateNews, 20000);
        });

        //cuaca
        function updateWeather() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var weatherIcon = response.days[0].hours[parseInt(response.currentHour)].icon;
                        var datetime = response.days[0].datetime;
                        var conditions = response.days[0].hours[parseInt(response.currentHour)].conditions;

                        document.getElementById('weather-icon-indeks').src = "{{ asset('images/icon/') }}" + '/' +
                            weatherIcon + '.png';
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


         //auto refresh

         function autoRefresh() {
            location.reload();
        }

        // Set interval untuk memanggil fungsi autoRefresh setiap 1 jam (3600000 milidetik)
        setInterval(autoRefresh, 1800000);
    </script>
</body>

</html>
