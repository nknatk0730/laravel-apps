<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tasks</title>
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
  @vite('resources/css/app.css')
</head>

<body>
  <div class="mx-auto p-4">
    <nav class="flex mb-8">
      <h1 class="text-2xl font-bold mb-4">Todo Lists</h1>
      <span class="flex-1"></span>
      <a href="{{ route('tasks.trash') }}" class="flex items-center bg-pink-500 rounded-xl px-1">Trash</a>
    </nav>

    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
      @csrf
      <div class="flex gap-2">
        <div class="space-y-2">
          <label for="task_name">Task</label>
          <input type="text" name="task_name" class="border border-gray-300 rounded-md">
        </div>
        <span class="flex-1"></span>
        <div class="space-y-2">
          <label for="due_date">Due date</label>
          <input type="datetime-local" value="{{ now()->format('Y-m-d H:i') }}" name="due_date" class="border rounded-md border-gray-300">
        </div>
        <span class="flex-1"></span>
        <div class="flex items-end mb-0.5">
          <button type="submit" class="bg-sky-500 rounded px-3">add</button>
        </div>
      </div>
    </form>
  </div>

  <ul class="pl-4">
    @foreach ($tasks as $task)
      <li class="mb-2 flex gap-8 p-4 items-center">
        <p>{{ $task->task_name }}</p>
        <span>{{ date('Y-m-d H:i', strtotime($task->due_date)) }}</span>
        <span class="flex-1"></span>
        <form action="{{ route('tasks.markAsDeleted', ['id' => $task->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <button type="submit" class="bg-rose-500 hover:bg-rose-300 rounded-lg px-1 text-neutral-100 ">Trash</button>
        </form>
      </li>
    @endforeach
  </ul>
</body>

</html>
