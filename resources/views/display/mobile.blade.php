<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Dapat Diakses pada Perangkat Mobile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .warning {
            background-color: #ffdddd;
            color: #f44336;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 6px solid #f44336;
            border-radius: 4px;
        }
        .warning h2 {
            margin-top: 0;
        }
        .warning p {
            margin-bottom: 0;
        }
        .monitor {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        @media only screen and (min-width: 600px) {
            .container {
                padding: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning">
            <h2>Maaf, Halaman Tidak Dapat Diakses pada Perangkat Mobile</h2>
            <p>Silakan akses halaman ini melalui perangkat dengan layar lebih besar, seperti komputer atau Laptop.</p>
        </div>
        <img class="monitor" src="{{ asset('images/displaymobile.jpg') }}" alt="Monitor" width="600" height="400">

    </div>
</body>
</html>
