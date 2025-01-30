<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  @vite('resources/css/app.css')
</head>
<body>
  <div>
    <h1>404 Not found </h1>
    <p>Check for URL expires</p>
    <a class="border p-2" href="{{ route('urls.index') }}">TOP</a>
  </div>
</body>
</html>