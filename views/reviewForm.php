<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Review: <?= htmlspecialchars($event['title']) ?> - GrowTogether</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24">

    <div id="successPopup" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #28a745; color:white; padding:16px 20px; border-radius:8px; z-index:1000;">
        <span id="popupMessage"></span><button type="button" onclick="this.parentElement.style.display='none';" style="background:none; border:none; color:white; font-weight:bold; font-size:22px;">&times;</button>
    </div>
    <div id="errorPopup" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #dc3545; color:white; padding:16px 20px; border-radius:8px; z-index:1000;">
        <span id="errorMessage"></span><button type="button" onclick="this.parentElement.style.display='none';" style="background:none; border:none; color:white; font-weight:bold; font-size:22px;">&times;</button>
    </div>

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white"><a href="?c=GrowTogether&m=showEvent&id=<?= $event['id'] ?>" class="mr-2">Event Review</a></h1>
            <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-gray-500 rounded-md">
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

                <?php
                    $createLink = "?c=GrowTogether&m=signUp"; 
                    if (isset($userRole) && $userRole === 'speaker') {
                        $createLink = "?c=GrowTogether&m=create"; 
                    }
                ?>
                <a href="<?= $createLink ?>" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Create Event
                </a>
                <a href="?c=GrowTogether&m=registered" class="flex items-center p-3 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Registered
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

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-lg">
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 border-l-4 border-amber-600">
                <p class="text-sm text-gray-600">You are reviewing:</p>
                <h2 class="text-xl font-semibold text-red-500"><?= htmlspecialchars($event['title']) ?></h2>
                <p class="text-xs text-gray-500">by <?= htmlspecialchars($event['user_name']) ?></p>
            </div>
            
            <?php if ($hasReviewed): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow mb-8" role="alert"><p class="font-bold">Already Reviewed</p><p>You have already submitted a review for this event.</p></div>
            <?php else: ?>
                <form action="?c=GrowTogether&m=storeReview" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $currentUserId ?>">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Rating (1-5 Stars):</label>
                        <div class="flex space-x-1" id="star-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="<?= $i ?>" class="sr-only star-radio" required>
                                    <span class="text-3xl text-gray-300 star-visual">&#9733;</span>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="review_text" class="block text-sm font-medium text-gray-700 mb-1">Your Review (Optional):</label>
                        <textarea name="review_text" id="review_text" rows="5" class="w-full p-3 border border-amber-600 rounded-md focus:outline-none focus:border-amber-800" placeholder="Share your thoughts about the event..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-800 text-white font-semibold py-3 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150">Submit Review</button>
                </form>
            <?php endif; ?>

            <div class="mt-10 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-6 border-b border-amber-600/60 pb-3 text-gray-700">Event Reviews (<?= isset($reviews) ? count($reviews) : 0 ?>)</h3>
                <?php if (empty($reviews)): ?>
                    <p class="text-gray-500">No reviews yet for this event. <?php if(!$hasReviewed) echo "Be the first!" ?></p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-item mb-6 pb-4 border-b border-amber-600/60 last:border-b-0 last:mb-0 last:pb-0">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0"><div class="rounded-full bg-gray-200 w-10 h-10 flex items-center justify-center overflow-hidden"><img src="/src/image/profile.png" class="w-full h-full object-cover" alt="<?= htmlspecialchars($review['user_name']) ?>'s Profile"></div></div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($review['user_name']) ?></p>
                                    <div class="flex items-center mb-1"><?php $rating = $review['rating'] ?? 0; for ($s = 1; $s <= 5; $s++): ?><span class="text-2xl <?= $s <= $rating ? 'text-yellow-500' : 'text-gray-300' ?>">&#9733;</span><?php endfor; ?><?php if ($rating > 0): ?><span class="ml-2 text-xs text-gray-500">(<?= $rating ?> star<?= $rating == 1 ? '' : 's' ?>)</span><?php endif; ?></div>
                                    <p class="text-xs text-gray-500 mb-1">Reviewed on: <?= date('F j, Y, g:i a', strtotime($review['created_at'])) ?></p>
                                    <?php if (!empty(trim($review['review_text']))): ?><p class="text-gray-700 whitespace-pre-line mt-2 text-sm"><?= nl2br(htmlspecialchars($review['review_text'])) ?></p><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
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

        // Star rating form interaction
        const starRatingContainer = document.getElementById('star-rating');
        if (starRatingContainer) {
            const stars = starRatingContainer.querySelectorAll('label span.star-visual');
            const radios = starRatingContainer.querySelectorAll('input[type="radio"].star-radio');
            function highlightStars(selectedIndex) {
                stars.forEach((star, i) => {
                    star.classList.toggle('text-yellow-500', i < selectedIndex);
                    star.classList.toggle('text-gray-300', i >= selectedIndex);
                });
            }
            radios.forEach((radio, idx) => {
                radio.addEventListener('change', function() { highlightStars(idx + 1); });
                const label = radio.parentElement;
                label.addEventListener('mouseleave', function() {
                    const checkedIndex = Array.from(radios).findIndex(r => r.checked);
                    highlightStars(checkedIndex >= 0 ? checkedIndex + 1 : 0);
                });
                if (radio.checked) { highlightStars(idx + 1); }
            });
        }

        // Pop-up logic specific to this page
        const successPopup = document.getElementById('successPopup');
        const successMessageSpan = document.getElementById('popupMessage');
        const errorPopup = document.getElementById('errorPopup');
        const errorMessageSpan = document.getElementById('errorMessage');
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const error = urlParams.get('error');
        let message = '';
        let popupToDisplay = null;
        let messageSpan = null;
        if (status === 'review_added') {
            message = 'Your review has been posted successfully!';
            popupToDisplay = successPopup;
            messageSpan = successMessageSpan;
        } else if (error === 'review_failed_or_exists' || error === 'invalid_review_data') {
            message = 'Failed to post review. You may have already reviewed this event.';
            popupToDisplay = errorPopup;
            messageSpan = errorMessageSpan;
        }
        if (message && popupToDisplay && messageSpan) {
            messageSpan.textContent = message;
            popupToDisplay.style.display = 'block';
            setTimeout(() => { if (popupToDisplay) { popupToDisplay.style.display = 'none'; } }, 3000);
        }
    </script>
</body>
</html>