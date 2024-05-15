<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Clock</title>
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
      width: 200px;
      height: 49px;
      background-color: #fff;
      border-radius: 15px;
      display: flex;
      justify-content: center;
      text-align: center;
      font-size: 45px;
      color: #fff;
      background-color: #333;
      /* box-shadow: 0 0 20px rgba(0,0,0,0.5); */
    }


    .digit {
      display: inline-block;
    }

  </style>
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
