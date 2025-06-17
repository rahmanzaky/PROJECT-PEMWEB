<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GrowForum</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
      .textarea {
        resize: none;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        width: 100%;
        height: 450px;
      }
      .btn-post {
        background-color: #ffffff;
        color: black;
        padding: 5px 10px;
        border: 3px solid black;
        border-radius: 25px;
        cursor: pointer;
        text-align: center;
        font-weight: bold;
      }
      .btn-post:hover {
        background-color: #f0f0f0;
        color: black;
      }
    </style>
  </head>
  <body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-screen-xs bg-white rounded-lg shadow-md h-screen flex flex-col">
      <!-- Header -->
      <header class="bg-gray-300 text-black p-4 fixed w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center"> <a href= 'index.php?c=GrowForum&m=index' class="text-xl font-bold flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Create Thread
            </a>
            </div>
      </header>

      <!-- Content -->
      <div class="p-4 flex-grow overflow-auto mt-24">
        <!-- Profile Section -->
        <div class="flex items-center mb-4">
          <img src="profile.png" alt="Profil" class="w-12 h-12 rounded-full border border-gray-1.000 mr-3" />
          <strong>Jey</strong>
        </div>

    <form method="POST" action="index.php?c=GrowForum&m=add" class="flex flex-col flex-grow">
    <textarea class="textarea" name="content" placeholder="Tulis isi thread..."></textarea>
    <p class="text-xs text-red-500 text-right mt-1">Maksimal 1.000 karakter</p>

  <!-- Footer -->
  <div class="p-4">
    <button type="submit" class="btn-post w-full">Post</button>
  </div>
</form>

    <!-- Scripts -->
    <script>
      const textarea = document.querySelector(".textarea");
      textarea.addEventListener("input", () => {
        const remaining = 1000 - textarea.value.length;
        textarea.nextElementSibling.textContent = `Maksimal 1.000 karakter (${remaining} sisa)`;
      });
    </script>
  </body>
</html>
