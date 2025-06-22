<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>GrowTogether | Search Results</title>
</head>

<body class="bg-gray-100 font-sans text-gray-800 pb-24">

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white"><a href="/views/growTogether.php" class="hover:text-white">GrowTogether</a></h1>
            <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
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
                    <p class="font-semibold text-gray-900 user-name">Guest</p>
                    <p class="text-sm text-gray-500 user-role">user</p>
                </div>
            </div>

            <nav class="flex flex-col space-y-1 flex-grow">
                <a href="/views/home.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Home
                </a>
                
                <a href="/views/growTogether.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    GrowTogether
                </a>

                <a href="#" id="create-event-link" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Create Event
                </a>
                <a href="/views/registered.php" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Registered
                </a>

                <a href="/views/templates.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>
                    GrowHub
                </a>

                <a href="/views/list.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z" /></svg>
                    GrowForum
                </a>
            </nav>

            <div class="mt-auto">
                <a href="/views/login.php" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="py-4 px-4 mt-20">
        <div class="container mx-auto">
            <form id="search-form" class="flex w-full mb-6">
                <input 
                    type="text" name="query" placeholder="Search events..." 
                    class="p-2 w-full rounded-md border-2 border-amber-600 focus:outline-none focus:border-amber-800"
                >
            </form>
            <p id="showing-for" class="text-gray-700 mb-4 text-lg"></p>
            <div id="results-container" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
        </div>
    </main>

    <script src="/js/app-popups.js"></script>
    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');
        const openMenu = () => { mobileMenu.classList.remove('translate-x-full'); mobileMenu.classList.add('translate-x-0'); menuOverlay.classList.remove('invisible'); menuOverlay.classList.remove('opacity-0'); };
        const closeMenu = () => { mobileMenu.classList.add('translate-x-full'); mobileMenu.classList.remove('translate-x-0'); menuOverlay.classList.add('opacity-0'); setTimeout(() => { menuOverlay.classList.add('invisible'); }, 300); };
        hamburgerBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);

    document.addEventListener('DOMContentLoaded', () => {
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        const token = localStorage.getItem('jwt_token');

        document.querySelectorAll('.user-name').forEach(el => el.textContent = user ? user.user_name : 'Guest');
        document.querySelectorAll('.user-role').forEach(el => el.textContent = user ? user.role : 'user');

        const createEventLink = document.getElementById('create-event-link');
        if (createEventLink) {
            if (user && token) {
                createEventLink.href = user.role === 'speaker' ? '/views/createPost.php' : '/views/speakerSignUp.php';
            } else {
                createEventLink.href = '/views/login.php';
            }
        }
    });

    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name) || '';
    }
    const query = getQueryParam('query');
    document.querySelector('input[name="query"]').value = query;
    document.getElementById('showing-for').innerHTML = `Showing results for: <strong>${query}</strong>`;

    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const newQuery = this.query.value.trim();
        if (newQuery) {
            window.location.href = '/views/searchResults.php?query=' + encodeURIComponent(newQuery);
        }
    });

    async function fetchAndRenderResults() {
        const container = document.getElementById('results-container');
        container.innerHTML = '<p class="col-span-full text-center text-gray-500 py-10">Loading...</p>';
        try {
            const response = await fetch('http://localhost:8080/events');
            const result = await response.json();
            const events = result.data || result;
            const keyword = query.toLowerCase();
            const filtered = events.filter(ev =>
                (ev.title && ev.title.toLowerCase().includes(keyword)) ||
                (ev.topic && ev.topic.toLowerCase().includes(keyword)) ||
                (ev.description && ev.description.toLowerCase().includes(keyword))
            );
            if (filtered.length === 0) {
                container.innerHTML = '<p class="text-gray-600 col-span-full text-center py-10">No events found matching your search.</p>';
                return;
            }
            container.innerHTML = '';
            filtered.forEach(event => {
                const imageUrl = event.image_url ? `http://localhost:8080/${event.image_url}` : '/src/image/placeholder.png';
                const card = document.createElement('a');
                card.href = `/views/eventDetail.php?id=${event.id}`;
                card.className = 'block event-card-small border border-gray-200 rounded-lg p-4 shadow-lg hover:shadow-xl transition-shadow duration-200 bg-white flex flex-col';
                card.innerHTML = `
                    <div class="w-full bg-gray-200 rounded-md overflow-hidden mb-3 h-32 sm:h-36 md:h-40">
                        ${event.image_url ? `<img class="w-full h-full object-cover" src="${imageUrl}" alt="${event.title}">` : `<div class='w-full h-full flex items-center justify-center bg-gray-300'><span class='text-gray-500 text-sm'>No Image</span></div>`}
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-lg font-semibold mb-1 text-gray-800 truncate">${event.title}</h2>
                        <p class="text-xs text-gray-600 mb-1">By: ${event.user_name}</p>
                        <p class="text-xs text-gray-500">Topic: #${event.topic}</p>
                    </div>
                `;
                container.appendChild(card);
            });
        } catch (error) {
            container.innerHTML = '<p class="text-red-500 col-span-full text-center py-10">Failed to load events. Please make sure the API server is running.</p>';
            console.error('Search error:', error);
        }
    }
    fetchAndRenderResults();
    </script>
</body>
</html>