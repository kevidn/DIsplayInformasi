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

                <!--cuaca-->
                {{-- <div class="row" style="height: 14%; width: 100%">
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
                </div> --}}

                <!--berita-->
                <div class="row" style="height: 74%; width: 100%;">
                    <div>
                        @foreach ($berita as $item)
                        <div class="card p-3">
                            <img class="card-img-top" src="{{ asset('/storage/beritas/upload/'.$item->gambar) }}"></img>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                <div class="card-text">{{ $item->isi }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!--jam-->
                <div class="row" style="height: 12%; width: 100%;">
                    <div class="col-12 bg-success" style="display: flex; justify-content:center;">
                        <h2>
                            {{ $jam }}
                        </h2>
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur.
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <h1>Cuaca dan Jam</h1>
    <div>
        <h2>Waktu Saat Ini:</h2>
        <p>{{ $jam }}</p>
    </div>

    </div> --}}


    <script>
        $(document).ready(function(berita) {
        var currentNewsIndex = 0;

        function updateNews() {
            if (currentNewsIndex >= berita.length) {
            currentNewsIndex = 0; // Reset index if all news displayed
            }

            var currentNews = berita[currentNewsIndex];
            var newsHtml = `
            <div class="card p-3">
                <img class="card-img-top" src="{{ asset('/storage/beritas/upload/') }}/${currentNews.gambar}"></img>
                <div class="card-body">
                <h5 class="card-title">${currentNews.judul}</h5>
                <div class="card-text">${currentNews.isi}</div>
                </div>
            </div>
            `;

            // Update the news container with the current news HTML with fadeIn and fadeOut animation
            $("#news-container").fadeOut(500, function() {
            $(this).html(newsHtml).fadeIn(500);
            });

            currentNewsIndex++;
        }

        // Initial display
        updateNews();

        // Update news every 5 seconds using setInterval
        setInterval(updateNews, 5000);
        });

    </script>
    
</body>
</html>
