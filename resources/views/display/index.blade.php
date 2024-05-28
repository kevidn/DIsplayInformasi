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
    </style>

</head>

<body style="background-image: url('/images/bg.jpg'); background-size: 115%;">
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
                        <div style="width: 100%; height: 16%; margin-bottom: 4mm;"
                            class="col-11 p-2 d-flex align-items-center justify-content-center text-white">
                            <img id="weather-icon-indeks" class="mr-2"
                                src="{{ asset('images/icon/' . $weatherIcon . '.png') }}" alt="Weather Icon"
                                style="height: 60px; width: 70px;">
                            <div class="m-0" style="font-family: 'Segoe UI';">
                                <span id="datetime">{{ $cuaca['days'][0]['datetime'] }}</span>
                                <br>
                                <span
                                    id="conditions">{{ $cuaca['days'][0]['hours'][intval($currentHour)]['conditions'] }}</span>
                                <br>
                            </div>
                        </div>
                    </div>

                    <!--berita-->
                    <div class="container" style="height: 670px; width: 100%;">
                        <div class="row" style="width: 100%;">
                            <div id="news-container"
                                style="background-color: rgba(175, 41, 41, 0.288); padding: 10px; border-radius: 15px;">
                                @foreach ($berita as $item)
                                    <div class="card p-2">
                                        <img style="max-height: 150px;" class="card-img-top"
                                            src="{{ asset('/storage/beritas/upload/' . $item->gambar) }}"></img>
                                        <div class="card-body" style="font-size: 18px;">
                                            <h5 class="card-title">{{ $item->judul }}</h5>
                                            <div style="font-size: 14px;" class="card-text">
                                                {{ Str::limit($item->isi, 330, '...') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!--jam-->
                    <div class="row" style="height: 100%; width: 100%">
                        <div style="width: 100%; height: 15%; margin-bottom: 4mm;"
                            class="col-11 d-flex align-items-center justify-content-center text-white">
                            <h6>
                                <div class="p-1"></div>
                                @include('partials.jam')
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="row">

                    <!--header & video-->
                    <div class="col-9" style="height: 590px;">
                        <div
                            style="display: flex; justify-content: space-around; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; text-align: center; color: white; margin: 15px;">

                            <img src="{{ asset('/images/bogor.png') }}" alt="Logo 1"
                                style="height: 80px; width: 80px;">

                            SMK FATAHILLAH CILEUNGSI

                            <img src="{{ asset('/images/fatahillah.png') }}" alt="Logo 2"
                                style="height: 80px; width: 80px;">

                        </div>
                        <div style="display: flex; justify-content:center; margin: 10px;">
                            @if ($videodisplay && $videodisplay->tampil == 1)
                                @if ($videodisplay->youtubelinks)
                                    {{-- Jika video dari YouTube --}}
                                    <iframe width="800" height="420" src="{{ $videodisplay->youtubelinks }}" allow="autoplay" autoplay></iframe>
                                @elseif ($videodisplay->videolokal)
                                    {{-- Jika video dari lokal --}}
                                    <video width="800" height="420" controls autoplay muted loop>
                                        <source src="{{ asset('storage/videolokal/' . $videodisplay->videolokal) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                @endif
                            @endif
                        </div>



                        <div
                            style="text-align: center; font-size: 25px; font-family: 'Segoe UI'; font-weight: bold; color: white; margin: 15px;">
                            SELAMAT DATANG
                        </div>
                    </div>

                    <!--jadwal shalat-->
                    <div class="col-3" style="height: 470px; font-family: 'Segoe UI'; font-weight: bold;">
                        <div style="font-size: 25px; text-align: center; color: white; margin: 15px;">
                            JADWAL SHALAT
                        </div>
                        <div class="container"
                            style="font-size: 140%; border-radius: 15px; background-color: rgba(175, 41, 41, 0.288); width: 100%; height: 400px;">
                            @if ($jadwalSholat)
                                <div style="color: white;">
                                    <br>
                                    <div>Subuh: {{ $jadwalSholat['subuh'] }}</div>
                                    <div>Dhuha: {{ $jadwalSholat['dhuha'] }}</div>
                                    <div>Dzuhur: {{ $jadwalSholat['dzuhur'] }}</div>
                                    <div>Ashar: {{ $jadwalSholat['ashar'] }}</div>
                                    <div>Maghrib: {{ $jadwalSholat['maghrib'] }}</div>
                                    <div>Isya: {{ $jadwalSholat['isya'] }}</div>
                                </div>
                            @else
                                <p>Jadwal sholat untuk hari ini tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- agenda -->
                <div id="agenda-container" class="row" style="background-color: rgba(175, 41, 41, 0.288); border-radius: 18px; padding: 8px; width: 98%; overflow: auto;">
                    <div class="col-12 d-flex flex-row" id="agenda-content">
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($agenda as $item_agenda)
                            @if ($counter < 3)
                                <div class="col-4">
                                    <div class="card" style="height: 140px; font-size: 13px; margin: 5px;">
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
                        <div class="container"
                            style="background-color: rgba(175, 41, 41, 0.288); border-radius: 18px; width: 94%; height: 50px; margin: 10px; color:white; text-align:center;">
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
                        <div class="card" style="height: 140px; font-size: 13px; margin: 5px;">
                            <div class="card-body">
                                <h5 class="card-title">${agenda.nama_kegiatan}</h5>
                                <hr>
                                <div class="card-text mb-2">&#128205; Tempat: ${agenda.tempat}</div>
                                <div>&#128197; Tanggal: ${new Date(agenda.tanggal).toISOString().split('T')[0]}</div>
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
                var $newsContainers = $('.card.p-2'); // Ambil semua container card berita
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
    </script>
</body>

</html>
