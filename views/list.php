<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowForum | Discussion</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100 pb-24">

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                <a href="/views/list.php">GrowForum</a>
            </h1>
            <div class="flex items-center space-x-2">
                <a href="/views/form.php" title="Buat Thread Baru" class="p-2 rounded-full hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </a>
                <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
    
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-orange-50 backdrop-blur-lg shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="flex flex-col h-full p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-800">Menu</h2>
                <button id="close-menu-btn" class="p-2 text-gray-500 hover:text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <div class="flex items-center space-x-3 mb-8 border-b border-amber-600 pb-6">
                <div class="flex-shrink-0"><div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile"></div></div>
                <div>
                    <p class="font-semibold text-gray-900 user-name"></p>
                    <p class="text-sm text-gray-500 user-role"></p>
                </div>
            </div>
            <nav class="flex flex-col space-y-1 flex-grow">
                <a href="/views/home.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>Home</a>
                <a href="/views/growTogether.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>GrowTogether</a>
                <a href="/views/templates.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>GrowHub</a>
                <a href="/views/list.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z" /></svg>GrowForum</a>
            </nav>
            <div class="mt-auto"><a href="/views/login.php" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>Logout</a></div>
        </div>
    </div>
    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="container mx-auto px-4 pt-24 pb-8">
        
        <div id="thread-list" class="space-y-4 "> 
            <p class="text-center text-gray-500 py-10">Loading threads...</p>
        </div>
    </main>
    
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        const threadListContainer = document.getElementById('thread-list');
        const userNameEls = document.querySelectorAll('.user-name');
        const userRoleEls = document.querySelectorAll('.user-role');

        if (user) {
            userNameEls.forEach(el => el.textContent = user.user_name || 'Guest');
            userRoleEls.forEach(el => el.textContent = user.role || 'user');
        } else {
            userNameEls.forEach(el => el.textContent = 'Guest');
            userRoleEls.forEach(el => el.textContent = 'user');
        }

        async function fetchThreads() {
            try {
                const response = await fetch('http://localhost:8080/threads');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const result = await response.json();
                const threads = result.data || result;
                
                if (threadListContainer) {
                    threadListContainer.innerHTML = '';
                    if (threads && threads.length > 0) {
                        threads.forEach(thread => {
                            const threadElement = document.createElement('a');
                            threadElement.href = `/views/detail.php?id=${thread.id}`;
                            threadElement.className = 'thread-item block';
                            threadElement.innerHTML = `
                                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                                    <div class="flex items-start space-x-4">
                                        <img src="/src/image/profile.png" alt="Profil" class="w-10 h-10 rounded-full border border-gray-300 object-cover">
                                        <div>
                                            <strong class="text-lg text-gray-900">${thread.author || 'Anonymous'}</strong>
                                            <p class="mt-1 text-gray-700 leading-relaxed break-words">
                                                ${thread.content.replace(/\n/g, '<br>')}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            threadListContainer.appendChild(threadElement);
                        });
                    } else {
                        threadListContainer.innerHTML = '<p class="text-center text-gray-500 py-10">No threads found.</p>';
                    }
                }
            } catch (error) {
                console.error("Could not fetch threads:", error);
                if (threadListContainer) {
                    threadListContainer.innerHTML = '<p class="text-center text-red-500 py-10">Failed to load threads. Please try again later.</p>';
                }
            }
        }

        fetchThreads();

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');
        const openMenu = () => { mobileMenu.classList.remove('translate-x-full'); mobileMenu.classList.add('translate-x-0'); menuOverlay.classList.remove('invisible'); menuOverlay.classList.remove('opacity-0'); };
        const closeMenu = () => { mobileMenu.classList.add('translate-x-full'); mobileMenu.classList.remove('translate-x-0'); menuOverlay.classList.add('opacity-0'); setTimeout(() => { menuOverlay.classList.add('invisible'); }, 300); };
        if(hamburgerBtn) hamburgerBtn.addEventListener('click', openMenu);
        if(closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
        if(menuOverlay) menuOverlay.addEventListener('click', closeMenu);
    });
    </script>

</body>
</html>