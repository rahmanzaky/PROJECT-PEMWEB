<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title id="event-title">Comments for: Event</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24"> 

    <div id="successPopup"
         style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #28a745; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="popupMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="this.parentElement.style.display='none';"
                style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">
            &times;
        </button>
    </div>
    <div id="errorPopup"
         style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #dc3545; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="errorMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="this.parentElement.style.display='none';"
                style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">
            &times;
        </button>
    </div>

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white"><a href="#" id="event-detail-link" class="mr-2">Comments</a></h1>
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
                <a href="/views/growTogether.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
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
            <div class="bg-white p-4 rounded-lg shadow mb-6 border-l-4 border-amber-600" id="event-header">
                <!-- JS will render event title and user here -->
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mb-8" id="comment-form-section">
                <!-- JS will render comment form here -->
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md" id="comments-section">
                <!-- JS will render comments here -->
            </div>
        </div>
    </main>

    <script src="/js/app-popups.js"></script>
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

        // Event and comments fetch logic
        document.addEventListener('DOMContentLoaded', async () => {
            const user = JSON.parse(localStorage.getItem('current_user') || 'null');
            const token = localStorage.getItem('jwt_token');
            const currentUserNameEl = document.getElementById('currentUserName');
            const userRoleEl = document.getElementById('userRole');
            const createLink = document.getElementById('createLink');

            if (user && token) {
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
            const eventId = params.get('event_id');
            if (!eventId) return;
            try {
                // Fetch event details
                const eventRes = await fetch('http://localhost:8080/events/' + eventId);
                if (!eventRes.ok) throw new Error('Event not found');
                const event = await eventRes.json();
                document.getElementById('event-title').textContent = 'Comments for: ' + event.title;
                document.getElementById('event-detail-link').textContent = 'Comments';
                document.getElementById('event-detail-link').href = '/views/eventDetail.php?id=' + event.id;
                document.getElementById('event-header').innerHTML = `
                    <p class="text-sm text-gray-600">Commenting on: <strong class="text-gray-800">${event.title}</strong></p>
                    <p class="text-xs text-gray-500">by ${event.user_name}</p>
                `;
                // Render comment form
                document.getElementById('comment-form-section').innerHTML = `
                    <h3 class="text-xl font-semibold mb-4">Add Your Comment</h3>
                    <form id="comment-form">
                        <div class="mb-4">
                            <textarea name="comment_text" rows="4" class="w-full p-3 border border-amber-600 rounded-md focus:outline-none focus:border-amber-800" placeholder="Write your comment here..." required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-800 text-white font-semibold py-3 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150">Post Comment</button>
                    </form>
                `;
                // Handle comment form submit
                document.getElementById('comment-form').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const commentText = e.target.comment_text.value.trim();
                    if (!commentText) return;
                    try {
                        const res = await fetch('http://localhost:8080/events/' + eventId + '/comments', {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('jwt_token')}`
                            },
                            body: JSON.stringify({ comment: commentText })
                        });
                        
                        const result = await res.json();
                        if (!res.ok) throw new Error(result.message || 'Failed to post comment');
                        
                        e.target.reset();
                        loadComments();
                        showPopup('Your comment has been posted successfully!');
                    } catch (err) {
                        console.error('Failed to post comment:', err);
                        if (err.message && err.message.toLowerCase().includes('foreign key constraint fails')) {
                            alert('Your session is invalid or has expired. You will be redirected to the login page.');
                            localStorage.removeItem('jwt_token');
                            localStorage.removeItem('current_user');
                            window.location.href = '/views/login.php';
                        } else {
                            showPopup(err.message || 'Failed to post your comment. Please try again.', true);
                        }
                    }
                });
                // Load comments
                async function loadComments() {
                    const commentsRes = await fetch('http://localhost:8080/events/' + eventId + '/comments');
                    const comments = await commentsRes.json();
                    const commentsSection = document.getElementById('comments-section');
                    if (!comments.length) {
                        commentsSection.innerHTML = '<p class="text-gray-500">Be the first to comment on this event!</p>';
                    } else {
                        commentsSection.innerHTML = `<h3 class="text-xl font-semibold mb-6 border-b border-amber-600/60 pb-3">Comments (${comments.length})</h3>` +
                            comments.map(comment => `
                            <div class="comment-item mb-6 pb-4 border-b border-amber-600/60 last:border-b-0 last:mb-0 last:pb-0">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0"><div class="rounded-full bg-gray-200 w-10 h-10 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="${comment.user_name}'s Profile"></div></div>
                                    <div class="flex-grow">
                                        <p class="font-semibold text-gray-800">${comment.user_name}</p>
                                        <p class="text-xs text-gray-500 mb-1">${new Date(comment.created_at).toLocaleString('en-US', { timeZone: 'Asia/Jakarta' })}</p>
                                        <p class="text-gray-700 whitespace-pre-line">${comment.comment_text}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    }
                }
                loadComments();
                // Helper for popups
                function showPopup(message, isError) {
                    const popup = isError ? document.getElementById('errorPopup') : document.getElementById('successPopup');
                    const span = isError ? document.getElementById('errorMessage') : document.getElementById('popupMessage');
                    span.textContent = message;
                    popup.style.display = 'block';
                    setTimeout(() => { popup.style.display = 'none'; }, 3000);
                }
            } catch (e) {
                document.getElementById('event-header').innerHTML = `<div class='text-center text-red-500'>Event not found.</div>`;
            }
        });
    </script>
</body>
</html>