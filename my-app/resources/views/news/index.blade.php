<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>News</title>
  @vite('resources/css/app.css')
</head>

<body class="p-4 space-y-4">
  <h1 class="text-2xl font-bold">News</h1>
  @foreach ($articles as $article)
    <div class="border p-4">
      <h2 class="text-xl mb-4">{{ $article['title'] }}</h2>
      <p class="text-sm text-neutral-400">{{ $article['description'] }}</p>
      <a href="{{ $article['url'] }}" class="text-blue-500">Read more</a>
    </div>
  @endforeach
</body>

</html>
