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

    <div id="successPopup"
         style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #28a745; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="popupMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="document.getElementById('successPopup').style.display='none';"
                style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">
            &times;
        </button>
    </div>

    <header class="bg-amber-600 text-black p-4 fixed m-auto w-full shadow-md z-20">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">
                <a href="?c=Todos&m=grow" class="hover:text-white">GrowTogether</a>
            </h1>
            <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-gray-500 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
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
                <a href="?c=Todos&m=grow" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Home
                </a>
                
                <a href="?c=Todos&m=grow" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    GrowTogether
                </a>

                <?php
                    $createLink = "?c=Todos&m=signUp"; 
                    if (isset($userRole) && $userRole === 'speaker') {
                        $createLink = "?c=Todos&m=create"; 
                    }
                ?>
                <a href="<?= $createLink ?>" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Create Event
                </a>
                <a href="?c=Todos&m=registered" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Registered
                </a>

                <a href="?c=Templates&m=list" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>
                    GrowHub
                </a>

                <a href="?c=Thread&m=index" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
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

    <main class="event-list py-8 px-4 mb-2 pt-24">
        <form action="?c=Todos&m=search" method="POST" class="flex w-full mb-6">
            <input type="text" name="query" placeholder="Search events..." class="p-2 w-full rounded-md border-2 border-amber-600 focus:outline-none focus:border-amber-800">
        </form>
        <div class="container mx-auto grid grid-cols-1 gap-6 p-auto m-auto">
            <?php if (empty($events)): ?>
                <p class="text-center text-gray-500">No events found.</p>
            <?php else: ?>
                <?php foreach ($events as $event): ?>
                    <div class="event-card bg-white p-6 rounded-lg shadow-lg">
                        <div class="user-info flex items-center space-x-4 mb-4">
                            <span class="user-profile">
                                <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden">
                                    <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                                </div>
                            </span>
                            <div class="user-name-topic">
                                <span class="user-name font-semibold"><?= htmlspecialchars($event['user_name']) ?></span><br>
                                <span class="event-topic text-gray-500">#<?= htmlspecialchars($event['topic']) ?></span>
                            </div>
                        </div>
                        <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>">
                            <h2 class="text-xl font-semibold mb-2 hover:text-blue-600"><?= htmlspecialchars($event['title']) ?></h2>
                        </a>
                        <p class="text-gray-600 mb-4">
                            <?= htmlspecialchars(substr($event['description'], 0, 100)) . (strlen($event['description']) > 100 ? '...' : '') ?>
                        </p>
                        <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>">
                            <div class="border-2 border-gray-300 mb-4 h-64 overflow-hidden rounded-md">
                                <img src="<?= htmlspecialchars($event['image_url']) ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-200" alt="Event Image">
                            </div>
                        </a>
                        <div class="event-actions flex justify-between items-center">
                            <a href="?c=Todos&m=showReviewForm&event_id=<?= $event['id'] ?>" class="event-rating text-yellow-500 text-3xl hover:text-yellow-400">★</a>
                            <?php
                                if (isset($currentUserId) && $event['user_id'] == $currentUserId):
                            ?>
                                <button class="join-event bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>Your Event</button>
                            <?php
                                elseif (isset($registeredEventIds) && in_array($event['id'], $registeredEventIds)):
                            ?>
                                <button class="join-event bg-green-600 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>✓ Joined</button>
                            <?php else: ?>
                                <a href="?c=Todos&m=joinEvent&id=<?= $event['id'] ?>" class="join-event bg-amber-500 text-white px-4 py-2 rounded-lg transform transition-transform duration-200 hover:scale-110">Join Event</a>
                            <?php endif; ?>
                            <a href="?c=Todos&m=showComments&event_id=<?= $event['id'] ?>" class="comment-event text-3xl text-gray-500 hover:text-gray-700">💬</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

   <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');

        const openMenu = () => {
            mobileMenu.classList.remove('translate-x-full');
            mobileMenu.classList.add('translate-x-0');
            menuOverlay.classList.remove('invisible');
            menuOverlay.classList.remove('opacity-0');
        };

        const closeMenu = () => {
            mobileMenu.classList.add('translate-x-full');
            mobileMenu.classList.remove('translate-x-0');
            menuOverlay.classList.add('opacity-0');
            setTimeout(() => {
                menuOverlay.classList.add('invisible');
            }, 300);
        };

        hamburgerBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);
    </script>
</body>
</html>