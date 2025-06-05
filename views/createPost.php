<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GrowTogether - Create Post</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
  <header class="bg-gray-300 text-black p-5 fixed m-auto top-0 w-full shadow-md z-10">
    <div class="mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow">&lt;</a> Create Post</h1>
    </div>
  </header>

  <div class="mt-24 mb-24 w-9/10 mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex items-center mb-6">
      <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden">
        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
      </div>
      <h5 class="text-lg font-semibold ml-2"><?= htmlspecialchars($user['user_name'] ?? 'Speaker') ?></h5>
    </div>

    <form action="?c=Todos&m=store" method="POST" enctype="multipart/form-data" class="space-y-6">
      <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500" type="file" id="image" name="image" accept="image/*" required>
      </div>

      <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
        <input type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" name="title" required>
      </div>

      <div>
        <label for="topic" class="block text-sm font-medium text-gray-700 mb-2">Topic</label>
        <input type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" id="topic" name="topic" placeholder="e.g., Technology, Business, Health" required>
      </div>

      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Event Description</label>
        <textarea class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" id="description" name="description" rows="4"></textarea>
      </div>

      <div>
        <label for="keySum" class="block text-sm font-medium text-gray-700 mb-2">Key Summary (PDF)</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500" type="file" id="keySum" name="keySum" accept="application/pdf">
      </div>
      <button type="submit" class="w-full bg-gray-500 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Create</button>
    </form>
  </div>

  <footer  style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
    <nav class="flex justify-around items-center">
      </nav>
  </footer>
</body>
</html>