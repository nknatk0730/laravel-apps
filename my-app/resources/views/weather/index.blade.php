<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Weather App</title>
  @vite('resources/css/app.css')
</head>
<body class="p-4 space-y-4 text-center mt-10">
  <div class="space-y-4">
    <h1 class="text-2xl">Weather</h1>
    <select name="city" id="city" class="p-2 border border-gray-300 rounded">
      @foreach ($cities as $city)
        <option value="{{ $city['english_name'] }}" @selected ($city['english_name'] === $selectedCity->name)>{{ $city['kanji_name'] }}</option>
      @endforeach
    </select>
  </div>
  <div class="space-y-4">
    <h2>{{ $selectedCity }}</h2>
    <p>Date: {{ date('Y-m-d H:i', strtotime($weatherData['current']['time'])) }}</p>
    <p>Temperature: {{ $weatherData['current']['temperature_2m'] }}</p>
    <p>Wind speed: {{ $weatherData['current']['wind_speed_10m'] }} m/s</p>
  </div>
  <div>
    <button class="bg-sky-500 rounded-xl p-2 text-neutral-200 hover:bg-sky-300 transition duration-300" onclick="openModal()">Detail</button>
  </div>
  <div id='weatherModal' class="fixed hidden insert-0 space-y-4">
    <div class="space-y-4">
      <h2>Weather Detail</h2>
      <button onclick="closeModal()">&times;</button>
    </div>
    <div>
      <ul class="overflow-scroll h-96">
        @foreach ($weatherData['hourly']['time'] as $index => $hourlyTime)
            <li>
              <span>{{ date('H:i', strtotime($hourlyTime)) }}: {{ $weatherData['hourly']['temperature_2m'][$index] }}˚</span>
            </li>
        @endforeach
      </ul>
    </div>
  </div>
  <script>
    const city = document.getElementById('city');
    city.addEventListener('change', () => {
      window.location.href = `/weather?city=${city.value}`;
    });

    const openModal = () => {
      console.log('first');
      document.getElementById('weatherModal').classList.remove('hidden');
    }

    const closeModal = () => {
      document.getElementById('weatherModal').classList.add('hidden');
    }
  </script>
</body>
</html>