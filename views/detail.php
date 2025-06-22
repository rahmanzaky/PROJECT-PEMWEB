<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Thread | GrowForum</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>
<body class="bg-gray-100 font-sans antialiased"> 

    <div class="w-full min-h-screen flex flex-col">
        <header class="bg-amber-600 text-white p-4 pt-5 pb-5 fixed m-auto w-full shadow-md z-20 top-0">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/views/list.php" class="flex items-center group"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-3 group-hover:-translate-x-1 transition-transform"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <h1 class="text-2xl font-bold">Thread</h1>
                </a>
            </div>
        </header>

        <main id="thread-container" class="flex-grow p-4 mt-24">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="/src/image/profile.png" alt="Profil" class="w-12 h-12 rounded-full border border-gray-200 object-cover">
                    <div>
                        <strong id="thread-author" class="text-lg text-gray-900">Loading...</strong>
                        <p id="thread-date" class="text-sm text-gray-500">Loading...</p>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-800">
                    <p id="thread-content" class="break-words">Loading...</p>
                </div>
            </div>
        </main>
        
        <div id="delete-button-container"></div>

        <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
                <h2 class="text-lg font-semibold mb-4">Yakin ingin menghapus thread?</h2>
                <div class="flex justify-center gap-4">
                    <button id="cancel-delete-btn" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 font-semibold">Batal</button>
                    <button id="confirm-delete-btn" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', async () => {
        const urlParams = new URLSearchParams(window.location.search);
        const threadId = urlParams.get('id');

        const mainContainer = document.getElementById('thread-container');
        const threadAuthorEl = document.getElementById('thread-author');
        const threadDateEl = document.getElementById('thread-date');
        const threadContentEl = document.getElementById('thread-content');
        const deleteButtonContainer = document.getElementById('delete-button-container');
        const confirmModal = document.getElementById('confirmModal');
        const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

        if (!threadId) {
            mainContainer.innerHTML = '<p class="text-center text-red-500 py-10">Thread ID is missing.</p>';
            return;
        }

        try {
            const response = await fetch(`http://localhost:8080/threads/${threadId}`);
            if (!response.ok) {
                const errorResult = await response.json().catch(() => ({ message: 'Thread not found or API error.' }));
                throw new Error(errorResult.message || `Status: ${response.status}`);
            }
            const thread = await response.json();

            threadAuthorEl.textContent = thread.author;
            threadDateEl.textContent = `Posted on ${new Date(thread.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}`;
            threadContentEl.innerHTML = thread.content.replace(/\n/g, '<br>');

            const currentUser = JSON.parse(localStorage.getItem('current_user') || 'null');
            const token = localStorage.getItem('jwt_token');

            if (currentUser && token && currentUser.id === thread.user_id) {
                const deleteButton = document.createElement('button');
                deleteButton.id = 'delete-thread-btn';
                deleteButton.className = 'fixed bottom-6 right-6 bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-5 shadow-lg rounded-full flex items-center space-x-2 transform transition-all duration-200 hover:scale-105';
                deleteButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus</span>
                `;
                deleteButtonContainer.appendChild(deleteButton);
                
                deleteButton.addEventListener('click', () => {
                    confirmModal.classList.remove('hidden');
                });
            }

            cancelDeleteBtn.addEventListener('click', () => {
                confirmModal.classList.add('hidden');
            });

            confirmDeleteBtn.addEventListener('click', async () => {
                const token = localStorage.getItem('jwt_token'); // Re-check token in case of expiry
                if (!token) {
                    alert('Authentication error. Please log in again.');
                    window.location.href = '/views/login.php';
                    return;
                }
                try {
                    const deleteResponse = await fetch(`http://localhost:8080/threads/${threadId}`, {
                        method: 'DELETE',
                        headers: { 'Authorization': `Bearer ${token}` }
                    });
                    const result = await deleteResponse.json();
                    if (deleteResponse.ok) {
                        alert(result.message || 'Thread deleted successfully!');
                        window.location.href = 'list.php';
                    } else {
                        alert(result.message || 'Failed to delete thread.');
                    }
                } catch (error) {
                    alert('An error occurred while deleting the thread.');
                    console.error('Thread Delete Error:', error);
                } finally {
                    confirmModal.classList.add('hidden');
                }
            });

        } catch (error) {
            console.error("Failed to fetch thread details:", error);
            mainContainer.innerHTML = `<p class="text-center text-red-500 py-10">${error.message}</p>`;
        }
    });
    </script>
</body>
</html>