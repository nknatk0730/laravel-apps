<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $chatRoom->name }}</title>
  @vite('resources/css/app.css')
</head>

<body>
  <div class="p-4 space-y-4">
    <h1 class="text-xl font-bold">{{ $chatRoom->name }}</h1>
    <div id="messages"></div>
    <form id="message_form" class="space-y-4">
      <input type="hidden" name="chat_room_id" value="{{ $chatRoom->id }}">
      <div class="flex flex-col space-y-2">
        <input type="text" name="nickname" placeholder="Enter your nickname" id="nickname" required maxlength="8"
          class="border rounded">
        <textarea name="message" id="message" required class="border rounded" placeholder="Write Message"></textarea>
      </div>
      <button type="submit"
        class="w-full rounded bg-sky-400 p-1 hover:bg-sky-500 transition duration-500">Submit</button>
    </form>
  </div>

  <script>
    const messages = document.getElementById('messages');
    const messageForm = document.getElementById('message_form');
    const nickname = document.getElementById('nickname');
    const message = document.getElementById('message');

    messageForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = {
        chat_room_id: {{ $chatRoom->id }},
        nickname: nickname.value,
        message: message.value
      };

      try {
        const response = await fetch("{{ route('messages.store') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify(formData)
        });

        const data = await response.json();

        const newMessage = document.createElement('div');
        newMessage.innerHTML = `
          <div class="">
            <strong>${data.nickname}</strong>: ${data.message}
          </div>
        `;
        messages.appendChild(newMessage);
        message.value = '';
        messages.scrollTop = messages.scrollHeight;
      } catch (error) {
        console.error(error.message);
      }
    });

    // const fetchMessages = async () => {
    //   const response = await fetch(`/messages?chat_room_id={{ $chatRoom->id }}`);
    //   const data = await response.json();

    //   messages.innerHTML = data.map(message => `
  //     <div class="p-2 bg-gray-100 rounded mb-2">
  //       <strong>${message.nickname}</strong>: ${message.message}
  //     </div>
  //   `).join('');
    // };

    // fetchMessages();
    // setInterval(fetchMessages, 1000);
  </script>
</body>

</html>
