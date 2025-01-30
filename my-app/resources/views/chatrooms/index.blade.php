<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chat App</title>
  @vite('resources/css/app.css')
</head>
<body class="p-4">
    <div class="space-y-4">
      <h1 class="text-xl font-bold">Chat App</h1>
      <form action="{{ route('chatRooms.store') }}" method="POST">
        @csrf
        <input type="text" class="border rounded p-2" name="name" placeholder="Enter your chat room name">
        <button class="border bg-sky-500 rounded p-2" type="submit">Create</button>
      </form>
      <ul>
        @foreach ($chatRooms as $chatRoom)
        <li class="hover:bg-gray-100 mb-2 rounded overflow-hidden">
          <a class="p-2 block" href="{{ route('chatRooms.show', $chatRoom) }}">{{ $chatRoom->name }}</a>
        </li>
        @endforeach
      </ul>

      @if ($chatRooms->isEmpty())
        <p>No chat rooms available</p>
      @endif
    </div>
</body>
</html>