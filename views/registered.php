<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Registered | GrowTogether</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24">

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white"><a href="/views/growTogether.php" class="mr-2">My Activities</a></h1>
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
                    <p class="font-semibold text-gray-900 user-name"></p>
                    <p class="text-sm text-gray-500 user-role"></p>
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

                <a id="create-event-link" href="#" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Create Event
                </a>
                <a href="/views/registered.php" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    My Activities
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
                <a id="logout-button" href="#" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="py-8 px-4 mt-20">
        <div class="container mx-auto max-w-2xl">
            <div class="user-info flex items-center space-x-4 mb-8 p-4 bg-white rounded-lg shadow">
                <div class="flex-shrink-0"><div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile"></div></div>
                <div>
                    <span class="user-name text-xl font-semibold"></span>
                    <p class="text-sm text-gray-500 user-role-description"></p>
                </div>
            </div>

            <section class="mb-10">
                <div class="bg-amber-600 p-3 rounded-t-lg shadow">
                    <h2 class="text-xl font-bold text-center text-white">Events Joined</h2>
                </div>
                <div id="registered-events-list" class="bg-white p-4 rounded-b-lg shadow">
                    <p class="text-gray-500 text-center py-3">Loading your events...</p>
                </div>
            </section>

            <section>
                <div class="bg-amber-600/40 p-3 rounded-t-lg shadow">
                    <h2 class="text-xl font-bold text-center text-red-700">Events Needing Your Review</h2>
                </div>
                <div id="events-needing-review-list" class="bg-white p-4 rounded-b-lg shadow">
                     <p class="text-gray-500 text-center py-3">Loading events to review...</p>
                </div>
            </section>
        </div>
    </main>
    
    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');
        if (hamburgerBtn && mobileMenu && closeMenuBtn && menuOverlay) {
            const openMenu = () => { mobileMenu.classList.remove('translate-x-full'); mobileMenu.classList.add('translate-x-0'); menuOverlay.classList.remove('invisible', 'opacity-0'); };
            const closeMenu = () => { mobileMenu.classList.add('translate-x-full'); mobileMenu.classList.remove('translate-x-0'); menuOverlay.classList.add('opacity-0'); setTimeout(() => { menuOverlay.classList.add('invisible'); }, 300); };
            hamburgerBtn.addEventListener('click', openMenu);
            closeMenuBtn.addEventListener('click', closeMenu);
            menuOverlay.addEventListener('click', closeMenu);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('current_user') || 'null');
            const token = localStorage.getItem('jwt_token');
            const userNameEls = document.querySelectorAll('.user-name');
            const userRoleEls = document.querySelectorAll('.user-role');
            const userRoleDescEls = document.querySelectorAll('.user-role-description');
            
            if (user && token) {
                userNameEls.forEach(el => el.textContent = user.user_name || 'Guest');
                userRoleEls.forEach(el => el.textContent = user.role || 'user');
                userRoleDescEls.forEach(el => el.textContent = user.role === 'speaker' ? 'Speaker Account' : 'User Account');

                const createEventLink = document.getElementById('create-event-link');
                if (createEventLink) {
                    createEventLink.href = user.role === 'speaker' ? '/views/createPost.php' : '/views/speakerSignUp.php';
                }
            } else {
                 window.location.href = '/views/login.php';
                return;
            }
            
            const logoutButton = document.getElementById('logout-button');
            if(logoutButton) {
                logoutButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    localStorage.removeItem('current_user');
                    localStorage.removeItem('jwt_token');
                    window.location.href = '/views/login.php';
                });
            }

            const renderEventCards = (container, events, link_prefix, no_content_message) => {
                container.innerHTML = '';
                if (!events || events.length === 0) {
                    container.innerHTML = `<p class="text-gray-500 text-center py-3">${no_content_message}</p>`;
                    return;
                }
                const list = document.createElement('div');
                list.className = 'flex overflow-x-auto gap-4 p-2';
                events.forEach(event => {
                    const imageUrl = event.image_url ? `http://localhost:8080/${event.image_url}` : '/src/image/placeholder.png';
                    const card = `
                        <a href="${link_prefix}${event.id}" class="flex-none w-40 border border-gray-200 rounded-lg overflow-hidden shadow hover:shadow-md transition-shadow">
                            <img src="${imageUrl}" alt="${event.title}" class="w-full h-24 object-cover" onerror="this.src='/src/image/placeholder.png';">
                            <h3 class="text-center p-2 text-sm font-semibold truncate">${event.title}</h3>
                        </a>
                    `;
                    list.innerHTML += card;
                });
                container.appendChild(list);
            };

            const registeredEventsContainer = document.getElementById('registered-events-list');
            fetch('http://localhost:8080/users/me/registered-events/details', {
                headers: { 'Authorization': `Bearer ${token}` }
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    renderEventCards(registeredEventsContainer, result.data, '/views/eventDetail.php?id=', "You haven't joined any events yet.");
                } else {
                    throw new Error(result.message || 'Failed to load registered events.');
                }
            })
            .catch(error => {
                console.error('Error fetching registered events:', error);
                registeredEventsContainer.innerHTML = `<p class="text-red-500 text-center py-3">Could not load your events.</p>`;
            });

            const eventsNeedingReviewContainer = document.getElementById('events-needing-review-list');
             fetch('http://localhost:8080/users/me/events-needing-review', {
                headers: { 'Authorization': `Bearer ${token}` }
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    renderEventCards(eventsNeedingReviewContainer, result.data, '/views/reviewForm.php?event_id=', "No events awaiting your review. Great job!");
                } else {
                    throw new Error(result.message || 'Failed to load events for review.');
                }
            })
            .catch(error => {
                console.error('Error fetching events needing review:', error);
                eventsNeedingReviewContainer.innerHTML = `<p class="text-red-500 text-center py-3">Could not load events to review.</p>`;
            });
        });
    </script>
</body>
</html>