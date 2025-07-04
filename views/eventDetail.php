<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title id="event-title">GrowTogether - Event</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24"> 

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-white truncate">
                <a href="/views/growTogether.php" class="hover:text-white mr-2 text-2xl" id="event-title-link">Event Title</a> 
            </h1>
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
                    <p class="font-semibold text-gray-900" id="currentUserName">Guest</p>
                    <p class="text-sm text-gray-500" id="userRole">user</p>
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

                <a href="#" id="createLink" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
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
                <a href="/views/login.php" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-2xl">
            <div class="event-card bg-white p-6 rounded-lg shadow-lg" id="event-card">
            </div>
        </div>
    </main>
    
    <script src="/src/js/app-popups.js"></script>
    <script src="/src/js/main.js"></script>
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
        document.addEventListener('DOMContentLoaded', async () => {

            const user = JSON.parse(localStorage.getItem('current_user') || 'null');
            const currentUserNameEl = document.getElementById('currentUserName');
            const userRoleEl = document.getElementById('userRole');
            const createLink = document.getElementById('createLink');

            if (user) {
                currentUserNameEl.textContent = user.user_name || 'Guest';
                userRoleEl.textContent = user.role || 'user';
                if(createLink) {
                    createLink.href = user.role === 'speaker' ? '/views/createPost.php' : '/views/speakerSignUp.php';
                }
            } else {
                currentUserNameEl.textContent = 'Guest';
                userRoleEl.textContent = 'user';
                if(createLink) {
                    createLink.href = '/views/login.php';
                }
            }

            const params = new URLSearchParams(window.location.search);
            const eventId = params.get('id');
            if (!eventId) return;

            const token = localStorage.getItem('jwt_token');
            let registeredEventIds = [];
            if (token && user) {
                try {
                    const registeredRes = await fetch(`http://localhost:8080/users/me/registered-events`, {
                        headers: { 'Authorization': `Bearer ${token}` }
                    });
                    if (registeredRes.ok) {
                        const registeredResult = await registeredRes.json();
                        registeredEventIds = registeredResult.data || [];
                    }
                } catch (e) {
                    console.error("Could not fetch user's registered events", e);
                }
            }

            try {
                const res = await fetch('http://localhost:8080/events/' + eventId);
                if (!res.ok) throw new Error('Event not found');
                const event = await res.json();
                document.getElementById('event-title').textContent = 'GrowTogether - ' + event.title;
                document.getElementById('event-title-link').textContent = event.title;

                const hasJoined = registeredEventIds.includes(event.id);
                let actionButtonHTML = '';

                if (user && user.id === event.user_id) {
                    actionButtonHTML = `<button class="join-event bg-gray-400 text-white px-6 py-3 rounded-lg text-lg font-semibold cursor-not-allowed" disabled>Your Event</button>`;
                } else if (hasJoined) {
                    actionButtonHTML = `<button class="join-event bg-green-600 text-white px-6 py-3 rounded-lg text-lg font-semibold cursor-not-allowed" disabled>✓ Joined</button>`;
                } else {
                    actionButtonHTML = `<button id="join-event-btn" class="join-event bg-amber-500 hover:bg-amber-800 text-white px-6 py-3 rounded-lg text-lg font-semibold transition-transform duration-200 hover:scale-105">Join Event</button>`;
                }

                document.getElementById('event-card').innerHTML = `
                    <div class="user-info flex items-center space-x-4 mb-6">
                        <span class="user-profile"><div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="${event.user_name}'s Profile"></div></span>
                        <div><span class="user-name block font-semibold text-lg">${event.user_name}</span><span class="event-topic text-gray-600 text-sm">#${event.topic}</span></div>
                    </div>
                    ${event.image_url ? `<div class="mb-6 rounded-lg overflow-hidden shadow-md"><img src="/${event.image_url}" class="w-full h-auto object-contain max-h-[60vh]" alt="${event.title}"></div>` : ''}
                    <div class="prose max-w-none mb-6"><h3 class="text-xl font-semibold mt-4 mb-2">Description:</h3><p class="text-gray-700 whitespace-pre-line">${event.description}</p></div>
                    ${event.key_summary_path ? `<div class="mt-6 mb-6"><h3 class="text-lg font-semibold mb-2">Key Summary:</h3><a href="/${event.key_summary_path}" target="_blank" download class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150 ease-in-out">View/Download PDF Summary</a></div>` : ''}
                    <div class="event-actions flex justify-around items-center mt-8 pt-6 border-t border-gray-200">
                        <a href="/views/reviewForm.php?event_id=${event.id}" class="event-rating text-yellow-500 text-4xl hover:text-yellow-400 transition-colors duration-150">★</a>
                        ${actionButtonHTML}
                        <a href="/views/eventComments.php?event_id=${event.id}" class="comment-event text-3xl text-gray-500 hover:text-gray-700">💬</a>
                    </div>
                `;

                const joinButton = document.getElementById('join-event-btn');
                if (joinButton) {
                    joinButton.addEventListener('click', async () => {
                        const token = localStorage.getItem('jwt_token');
                        if (!token) {
                            alert('You must be logged in to join an event.');
                            window.location.href = '/views/login.php';
                            return;
                        }

                        try {
                            console.log('Attempting to join event:', eventId);
                            console.log('Using token:', token.substring(0, 20) + '...');
                            
                            const res = await fetch(`http://localhost:8080/events/${eventId}/register`, {
                                method: 'POST',
                                headers: {
                                    'Authorization': `Bearer ${token}`,
                                    'Content-Type': 'application/json'
                                }
                            });

                            console.log('Response status:', res.status);
                            const result = await res.json();
                            console.log('Response body:', result);

                            if (res.ok) {
                                showPopup('Successfully joined the event!', 'success');
                                joinButton.textContent = '✓ Joined';
                                joinButton.disabled = true;
                                joinButton.classList.remove('bg-amber-500', 'hover:bg-amber-800');
                                joinButton.classList.add('bg-green-600', 'cursor-not-allowed');
                            } else {
                                throw new Error(result.message || 'Failed to join event');
                            }
                        } catch (error) {
                            console.error('Error joining event:', error);
                            showPopup(error.message, 'error');
                        }
                    });
                }

            } catch (e) {
                document.getElementById('event-card').innerHTML = `<div class='text-center text-red-500'>Event not found.</div>`;
            }
        });
    </script>
</body>
</html>