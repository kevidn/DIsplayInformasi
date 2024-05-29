<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Clock</title>
  
  @if (Request::is("index"))
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: ;
        background-color: #f2f2f2;
      }

      .clock {
        font-family: Arial, sans-serif;
        width: 170px;
        height: 49px;
        background-color: #fff;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        text-align: center;
        font-size: 45px;
        color: #fff;
        background-color: #01263746;
        /* box-shadow: 0 0 20px rgba(0,0,0,0.5); */
      }


      .digit {
        display: inline-block;
      }

    </style>
  @else
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: ;
        background-color: #f2f2f2;
      }

      .clock {
        font-family: Arial, sans-serif;
        width: 110px;
        height: 40px;
        background-color: #fff;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        text-align: center;
        font-size: 35px;
        color: #fff;
        background-color: #01263746;
        /* box-shadow: 0 0 20px rgba(0,0,0,0.5); */
      }


      .digit {
        display: inline-block;
      }

    </style>
  @endif

</head>
<body>
  <div class="clock">
    <div id="hour" class="digit"></div>:
    <div id="minute" class="digit"></div>
  </div>
  <script>
    function updateClock() {
      const now = new Date();
      const hour = String(now.getHours()).padStart(2, '0');
      const minute = String(now.getMinutes()).padStart(2, '0');
      const second = String(now.getSeconds()).padStart(2, '0');

      document.getElementById('hour').textContent = hour;
      document.getElementById('minute').textContent = minute;
      document.getElementById('second').textContent = second;
    }

    setInterval(updateClock, 1000);
  </script>
</body>
</html>
