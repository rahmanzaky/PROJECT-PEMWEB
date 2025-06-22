<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>GrowTogether</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div id="successPopup" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #28a745; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="popupMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="this.parentElement.style.display='none';" style="background:none; border:none; color:white; font-weight:bold; font-size:22px;">&times;</button>
    </div>

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold"><a href="/views/growTogether.php">GrowTogether</a></h1>
            <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            </button>
        </div>
    </header>

    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-orange-50 backdrop-blur-lg shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="flex flex-col h-full p-6">
            <div class="flex justify-between items-center mb-8"><h2 class="text-xl font-bold text-gray-800">Menu</h2><button id="close-menu-btn" class="p-2 text-gray-500 hover:text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></div>
            <div class="flex items-center space-x-3 mb-8 border-b border-amber-600 pb-6"><div class="flex-shrink-0"><div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile"></div></div><div><p class="font-semibold text-gray-900 user-name"></p><p class="text-sm text-gray-500 user-role"></p></div></div>
            <nav class="flex flex-col space-y-1 flex-grow">
                <a href="/views/home.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>Home</a>
                <a href="/views/growTogether.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>GrowTogether</a>
                <a id="create-event-link" href="#" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Create Event</a>
                <a href="/views/registered.php" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>My Activities</a>
                <a href="/views/templates.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors mt-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>GrowHub</a>
                <a href="/views/list.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z" /></svg>GrowForum</a>
            </nav>
            <div class="mt-auto"><a href="/views/login.php" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>Logout</a></div>
        </div>
    </div>
    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="event-list py-8 px-4 mb-2 pt-24">
        <form id="search-form" class="flex w-full mb-6">
            <input type="text" name="query" placeholder="Search events..." class="p-2 w-full rounded-md border-2 border-amber-600 focus:outline-none focus:border-amber-800">
        </form>
        <div id="event-list-container" class="container mx-auto grid grid-cols-1 gap-6 p-auto m-auto">
            <p id="loading-message" class="text-center text-gray-500 col-span-full">Loading events...</p>
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
            const popup = document.getElementById('successPopup');
            const popupMessageSpan = document.getElementById('popupMessage');
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            let message = '';
            if (status === 'joined') { message = 'Successfully joined the event!'; }
            if (status === 'event_created') { message = 'Event created successfully!'; }
            if (status === 'speaker_signup_success') { message = 'Congratulations! You are now signed up as a speaker.'; }
            if (message && popup && popupMessageSpan) {
                popupMessageSpan.textContent = message;
                popup.style.display = 'block';
                setTimeout(() => { if (popup) popup.style.display = 'none'; }, 3000);
            }
        });

        async function joinEvent(eventId) {
            const token = localStorage.getItem('jwt_token');
            if (!token) {
                alert('You must be logged in to join an event.');
                window.location.href = '/views/login.php';
                return;
            }
            try {
                const response = await fetch(`http://localhost:8080/events/${eventId}/register`, {
                    method: 'POST',
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Failed to join event');
                const popup = document.getElementById('successPopup');
                const msgSpan = document.getElementById('popupMessage');
                if (popup && msgSpan) {
                    msgSpan.textContent = result.message || 'Successfully joined the event!';
                    popup.style.display = 'block';
                    setTimeout(() => { popup.style.display = 'none'; }, 2000);
                }
                // Update the registeredEventIds and re-render events
                if (window.registeredEventIds) {
                    window.registeredEventIds.push(eventId);
                }
                if (typeof fetchAndDisplayEvents === 'function') {
                    fetchAndDisplayEvents();
                }
            } catch(error) {
                console.error('Failed to join event:', error);
                if (error.message && error.message.toLowerCase().includes('foreign key constraint fails')) {
                    alert('Your session is invalid or has expired. You will be redirected to the login page.');
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('current_user');
                    window.location.href = '/views/login.php';
                } else {
                    alert(`Error: ${error.message}`);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const user = JSON.parse(localStorage.getItem('current_user') || 'null');
            const token = localStorage.getItem('jwt_token');
            const createEventLink = document.getElementById('create-event-link');
            const userNameEls = document.querySelectorAll('.user-name');
            const userRoleEls = document.querySelectorAll('.user-role');
            const myActivitiesLink = document.querySelector('a[href="/views/registered.php"]');

            if (user && token) {
                userNameEls.forEach(el => el.textContent = user.user_name || 'Guest');
                userRoleEls.forEach(el => el.textContent = user.role || 'user');
                if (createEventLink) {
                    createEventLink.href = user.role === 'speaker' ? '/views/createPost.php' : '/views/speakerSignUp.php';
                }
            } else {
                userNameEls.forEach(el => el.textContent = 'Guest');
                userRoleEls.forEach(el => el.textContent = 'user');
                if (createEventLink) {
                    createEventLink.href = '/views/login.php';
                }
                if (myActivitiesLink) {
                   myActivitiesLink.style.display = 'none'; 
                }
                const logoutButton = document.querySelector('a[href="/views/login.php"]');
                if(logoutButton.innerHTML.includes('Logout')){
                    logoutButton.innerHTML = logoutButton.innerHTML.replace('Logout', 'Login');
                }
            }
            
            const eventsContainer = document.getElementById('event-list-container');
            const loadingMessage = document.getElementById('loading-message');
            const currentUserId = user ? user.id : null;
            
            window.fetchAndDisplayEvents = async () => {
                try {
                    const [eventsResponse, registeredResponse] = await Promise.all([
                        fetch('http://localhost:8080/events'),
                        token ? fetch(`http://localhost:8080/users/me/registered-events`, { headers: { 'Authorization': `Bearer ${token}` } }) : Promise.resolve(null)
                    ]);
                    if (!eventsResponse.ok) throw new Error('Failed to fetch events list');
                    const eventsResult = await eventsResponse.json();
                    const events = eventsResult.data || eventsResult;
                    
                    let registeredEventIds = [];
                    if (registeredResponse && registeredResponse.ok) {
                        const registeredResult = await registeredResponse.json();
                        registeredEventIds = registeredResult.data || [];
                    }
                    
                    window.registeredEventIds = registeredEventIds;

                    if (!eventsContainer) return;
                    if (!events || events.length === 0) {
                        loadingMessage.textContent = 'No events found.';
                        return;
                    }
                    eventsContainer.innerHTML = '';

                    events.forEach(event => {
                        const hasJoined = registeredEventIds.includes(event.id);
                        let actionButtonHTML = '';

                        if (currentUserId && currentUserId === event.user_id) {
                            actionButtonHTML = `<button class="join-event bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>Your Event</button>`;
                        } else if (hasJoined) {
                            actionButtonHTML = `<button class="join-event bg-green-600 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>✓ Joined</button>`;
                        } else {
                            actionButtonHTML = `<button onclick="joinEvent(${event.id})" class="join-event bg-amber-500 text-white px-4 py-2 rounded-lg transform transition-transform duration-200 hover:scale-110">Join Event</button>`;
                        }

                        const eventDescription = (event.description || '').substring(0, 100) + ((event.description || '').length > 100 ? '...' : '');
                        const imageUrl = event.image_url ? `http://localhost:8080/${event.image_url}` : '/src/image/placeholder.png';
                        const cardHTML = ` 
                            <div class="event-card bg-white p-6 rounded-lg shadow-lg">
                                <div class="user-info flex items-center space-x-4 mb-4">
                                    <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden">
                                        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                                    </div>
                                    <div>
                                        <span class="font-semibold">${event.user_name || 'Anonymous'}</span><br>
                                        <span class="text-gray-500">${event.topic || 'General'}</span>
                                    </div>
                                </div>
                                <a href="/views/eventDetail.php?id=${event.id}">
                                    <h2 class="text-xl font-semibold mb-2 hover:text-blue-600">${event.title}</h2>
                                </a>
                                <p class="text-gray-600 mb-4">${eventDescription}</p>
                                <a href="/views/eventDetail.php?id=${event.id}">
                                    <div class="border-2 border-gray-300 mb-4 h-64 overflow-hidden rounded-md">
                                        <img src="${imageUrl}" class="w-full h-full object-cover hover:scale-105" alt="Event Image" onerror="this.parentElement.innerHTML = '<div class=\\'w-full h-full flex items-center justify-center bg-gray-200 text-gray-500\\'>Image not available</div>';">
                                    </div>
                                </a>
                                <div class="event-actions flex justify-between items-center">
                                    <a href="/views/reviewForm.php?event_id=${event.id}" class="event-rating text-yellow-500 text-3xl hover:text-yellow-400">★</a>
                                    ${actionButtonHTML}
                                    <a href="/views/eventComments.php?event_id=${event.id}" class="comment-event text-3xl text-gray-500 hover:text-gray-700">💬</a>
                                </div>
                            </div>
                        `;
                        eventsContainer.innerHTML += cardHTML;
                    });

                } catch (error) {
                    if(loadingMessage) loadingMessage.innerHTML = '<p class="text-red-500">Failed to load events. Please make sure the API server is running.</p>';
                    console.error('Error fetching data:', error);
                }
            };

            window.fetchAndDisplayEvents();
        });

        // Search bar logic
        const searchForm = document.getElementById('search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const query = this.query.value.trim();
                if (query) {
                    const newPath = '/views/searchResults.php';
                    window.location.href = newPath + '?query=' + encodeURIComponent(query);
                }
            });
        }
    </script>
</body>
</html>