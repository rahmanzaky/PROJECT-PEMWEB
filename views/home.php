<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GrowLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans text-gray-800 leading-relaxed w-full">
    <div class="w-full bg-white min-h-screen">
        
        <header class="bg-amber-600 text-black p-4 fixed m-auto w-full shadow-md z-20">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">
                    <a href="?c=Home&m=index" class="hover:text-white">GrowLink</a>
                </h1>
                <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-white rounded-md text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </header>

           <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-orange-50 backdrop-blur-lg shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="flex flex-col h-full p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-800">Menu</h2>
                <button id="close-menu-btn" class="p-2 text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex items-center space-x-3 mb-8 border-b border-amber-600 pb-6">
                <div class="flex-shrink-0">
                    <div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden">
                        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                    </div>
                </div>
                <div>
                    <p class="font-semibold text-gray-900"><?= htmlspecialchars($currentUserName ?? 'Guest') ?></p>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($userRole ?? 'user') ?></p>
                </div>
            </div>

            <nav class="flex flex-col space-y-1 flex-grow">
                <a href="?c=Home&m=index" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Home
                </a>
                
                <a href="?c=GrowTogether&m=grow" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    GrowTogether
                </a>

                <a href="?c=GrowHub&m=list" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>
                    GrowHub
                </a>

                <a href="?c=GrowForum&m=index" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z" /></svg>
                    GrowForum
                </a>
            </nav>

            <div class="mt-auto">
                <a href="?c=Auth&m=logout" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

        <main class="pt-20">
            <div class="m-5 bg-white rounded-xl border-4 border-amber-600 p-5 flex justify-between items-center relative overflow-hidden shadow-lg">
                <div class="pr-4 flex-1">
                    <h2 class="text-gray-800 text-lg font-bold mb-2">Welcome to GrowLink!</h2>
                    <p class="text-gray-600 text-sm"> Let's start your journey of self-development and project-building with GrowLink!</p>
                </div>
                <div class="relative w-24 h-20 flex-shrink-0 text-xl">
                    <!-- <div class="absolute top-2 left-5 text-blue-500">⚙️</div><div class="absolute top-9 right-2 text-blue-500">⚙️</div><div class="absolute top-1 right-6 text-purple-500">🧩</div><div class="absolute top-6 left-1 text-red-500">🧩</div><div class="absolute bottom-2 left-6 text-amber-500">🧩</div><div class="absolute top-4 left-12 text-yellow-400">⭐</div><div class="absolute bottom-4 right-5 text-yellow-400">⭐</div><div class="absolute bottom-1 right-1 text-gray-400">📄</div><div class="absolute top-10 left-9 text-green-500">📊</div> -->
                </div>
            </div>

            <div class="px-5 pb-8">
                <h3 class="text-amber-600 text-xl font-bold mb-3">Menu</h3>
                <p class="text-gray-800 text-sm text-justify mb-6">
                    Discover a variety of main features designed to help you learn, collaborate, and grow. Please log in first to enjoy all of GrowLink's features!
                </p>

                <a href="?c=GrowHub&m=list" class="block bg-white rounded-lg border-l-4 border-amber-600 p-5 mb-4 shadow-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <h4 class="text-amber-600 text-base font-bold mb-1">GrowHub</h4>
                    <p class="text-gray-800 text-sm">A collection of templates like proposals, event rundowns, and more. Search, upload, download, and save with ease!</p>
                </a>
                <a href="?c=GrowTogether&m=grow" class="block bg-white rounded-lg border-l-4 border-amber-600 p-5 mb-4 shadow-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <h4 class="text-amber-600 text-base font-bold mb-1">GrowTogether</h4>
                    <p class="text-gray-800 text-sm"> Free mentoring & webinars! Join as a participant or speaker, plus get access to ratings and reviews.</p>
                </a>
                <a href="?c=GrowForum&m=index" class="block bg-white rounded-lg border-l-4 border-amber-600 p-5 mb-4 shadow-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <h4 class="text-amber-600 text-base font-bold mb-1">GrowForum</h4>
                    <p class="text-gray-800 text-sm">A thread of short experiences and tips. Save, create, and enjoy exploring them all!</p>
                </a>
            </div>
        </main>
    </div>

    <script>
        // Hamburger Menu Logic
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');
        const openMenu = () => { mobileMenu.classList.remove('translate-x-full'); mobileMenu.classList.add('translate-x-0'); menuOverlay.classList.remove('invisible'); menuOverlay.classList.remove('opacity-0'); };
        const closeMenu = () => { mobileMenu.classList.add('translate-x-full'); mobileMenu.classList.remove('translate-x-0'); menuOverlay.classList.add('opacity-0'); setTimeout(() => { menuOverlay.classList.add('invisible'); }, 300); };
        if(hamburgerBtn) hamburgerBtn.addEventListener('click', openMenu);
        if(closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
        if(menuOverlay) menuOverlay.addEventListener('click', closeMenu);
    </script>
</body>
</html>