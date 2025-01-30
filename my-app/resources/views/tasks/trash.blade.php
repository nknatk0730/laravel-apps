<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Trash box</title>
  @vite('resources/css/app.css')
</head>
<body>
  <div class="mx-auto p-4 space-y-8">
    <nav class="flex">
      <h1 class="text-2xl font-bold mb-4">Trashed Lists</h1>
      <span class="flex-1"></span>
      <a href="{{ route('tasks.index') }}" class="flex bg-pink-500 items-center rounded-xl px-3 hover:bg-pink-300">Top</a>
    </nav>
    <ul class="space-y-8">
      @foreach ($tasks as $task)
        <li class="flex items-center">
          <span>{{ $task->task_name }}</span>
          <span class="flex-1"></span>
            <form action="{{ route('tasks.recover', ['id' => $task->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="button" onclick="recoverTask(event)" class="bg-sky-400 rounded-lg">Recover</button>
            </form>
        </li>
      @endforeach
    </ul>
    <div class="pt-6 text-center">
      @if (count($tasks) > 0)
          <form action="{{ route('tasks.deleteTrash') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="permanentDelete(event)" class="bg-rose-400 rounded-lg p-1">All Delete</button>
          </form>
      @endif
    </div>
    @if($tasks->isEmpty())
        <p class="text-center">Trash is empty</p>
    @endif
  </div>
</body>
<script>
  const recoverTask = (e) => {
    if (confirm('recover This Task?')) {
      e.target.closest('form').submit();
    }
  }

  const permanentDelete = (e) => {
    if (confirm('All Delete?')) {
      e.target.closest('form').submit();
    }
  }
</script>
</html>