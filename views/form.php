<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GrowForum</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
      <header class="bg-amber-600 text-white p-4 pt-5 pb-5 fixed m-auto w-full shadow-md z-20 top-0">
          <div class="container mx-auto flex items-center">
              <a href="/views/list.php" class="flex items-center group"> 
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-3 group-hover:-translate-x-1 transition-transform"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                  </svg>
                  <h1 class="text-2xl font-bold">
                      Create Thread
                  </h1>
              </a>
          </div>
      </header>

      <div class="p-4 flex-grow overflow-auto mt-24">
        <div class="flex items-center mb-4">
          <img src="/src/image/profile.png" alt="Profil" class="w-12 h-12 rounded-full border border-gray-300 object-cover mr-3" />
          <span id="user-name-display" class="text-xl font-semibold">Loading...</span>
        </div>

    <form id="thread-form" class="flex flex-col space-y-4">
      <textarea name="content" class="textarea" placeholder="Write your thread here..." required></textarea>
      <button type="submit" class="btn-post">Post</button>
    </form>
    <div id="response-message" class="hidden text-sm p-3 rounded-lg mb-4 text-center"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const user = JSON.parse(localStorage.getItem('current_user') || 'null');
      const token = localStorage.getItem('jwt_token');
      const userNameDisplay = document.getElementById('user-name-display');

      if (user && token) {
          userNameDisplay.textContent = user.full_name || user.user_name || 'User';
      } else {
          alert('You must be logged in to create a thread.');
          window.location.href = '/views/login.php';
          return;
      }

      document.getElementById('thread-form').addEventListener('submit', async function(event) {
          event.preventDefault();
          const messageDiv = document.getElementById('response-message');
          const submitButton = this.querySelector('button[type="submit"]');
          submitButton.disabled = true;
          submitButton.textContent = 'Posting...';
          messageDiv.className = 'hidden text-sm p-3 rounded-lg mb-4 text-center';
          const formData = new FormData(this);
          const data = Object.fromEntries(formData.entries());

          try {
              const response = await fetch('http://localhost:8080/threads', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'Authorization': `Bearer ${token}`
                  },
                  body: JSON.stringify(data)
              });
              const result = await response.json();
              if (response.ok) {
                  messageDiv.textContent = result.message || 'Thread created successfully!';
                  messageDiv.classList.add('bg-green-100', 'text-green-700');
                  messageDiv.classList.remove('hidden');
                  setTimeout(() => {
                      window.location.href = '/views/list.php';
                  }, 1500);
              } else {
                  messageDiv.textContent = result.message || 'Failed to create thread.';
                  messageDiv.classList.add('bg-red-100', 'text-red-700');
                  messageDiv.classList.remove('hidden');
                  submitButton.disabled = false;
                  submitButton.textContent = 'Post';
              }
          } catch (error) {
              messageDiv.textContent = 'An error occurred. Please make sure the API server is running.';
              messageDiv.classList.add('bg-red-100', 'text-red-700');
              messageDiv.classList.remove('hidden');
              submitButton.disabled = false;
              submitButton.textContent = 'Post';
              console.error('Thread Creation Error:', error);
          }
      });
    });
    </script>
  </body>
</html>
