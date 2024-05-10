<div class="row mb-3" style="height: 100%; width: 100%;">
    <div style="width: 100%; height: 16%; margin-bottom: 4mm;" class="col-11 p-2 d-flex align-items-center justify-content-center text-white">
      <img id="weather-icon-indeks" class="mr-2" src="" alt="Weather Icon" style="height: 50px; width: 50px;">
      <div class="m-0" style="font-family: 'Segoe UI';">
        <?php
          // Assuming you have a function to retrieve weather data from the API
          $weatherData = getWeatherData();

          if ($weatherData) {
            $currentCondition = $weatherData['currentCondition'];
            $formattedDate = date('Y-m-d', strtotime($weatherData['datetime']));
          } else {
            // Handle data unavailable scenario (e.g., display message)
            $currentCondition = 'Data unavailable';
            $formattedDate = '';
          }
        ?>

        {{ ucfirst($currentCondition) }} <br>
        {{ $formattedDate }}
      </div>
    </div>
  </div>
