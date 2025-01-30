<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shortening</title>
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
  @vite('resources/css/app.css')
</head>

<body class="h-dvh p-6 bg-neutral-300 space-y-4">
  <h1 class="text-neutral-600">Create Shortening URL</h1>
  <div class="p-6 bg-neutral-100 shadow-2xl rounded-xl">
    <form id="url_form" class="space-y-4">
      <input type="text" name="original_url" id="original_url" class="border p-2 my-2 w-full rounded-lg shadow-2xl" placeholder="Enter URL" required>
      <button class="w-full bg-sky-500 rounded-lg p-2" type="submit">Send</button>
    </form>
  </div>
  <div id="result"></div>

  <script>
    document.getElementById('url_form').addEventListener('submit', async (e) => {
      const isUrl = checkValidUrl();
      if (!isUrl) {
        return alert('Invalid');
      }

      e.preventDefault();

      const originalUrl = document.getElementById('original_url').value;

      try {
        const response = await fetch('/urls', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ original_url: originalUrl }),
        });

        const data = await response.json();
        document.getElementById('result').innerHTML = `<p>Short URL: <span id="short_url">${data.short_url}</span><button type="button" onClick="copyUrl('short_url')" class="border rounded-lg hover:bg-neutral-200 transition duration-300">Copy</button></p>`; 
      } catch (e) {
        console.error(e.message);
        alert('error');
      }
    });

    const checkValidUrl = () => {
      const url = document.getElementById('original_url').value;
      const pattern = new RegExp(
        '^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$',
        'i'
      ); //fragment locator
      const isValid = pattern.test(url);
      return isValid;
    }

    const copyUrl = async (elementId) => {
      const element = document.getElementById(elementId);

      await navigator.clipboard.writeText(element.innerText);
      console.log('Copied');

      element.insertAdjacentHTML('afterend', '<div class="bg-gray-800 text-white">Copied</div>');
      setTimeout(() => {
        document.querySelector('.bg-gray-800').remove();
      }, 2000);
    }
  </script>
</body>
</html>
