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
        <span id="popupMessage"></span> <button type="button" onclick="this.parentElement.style.display='none';" style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">&times;</button>
    </div>
    <div id="errorPopup" style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #dc3545; color:white; padding:16px 20px; border-radius:8px; z-index:1000;">
        <span id="errorMessage"></span> <button type="button" onclick="this.parentElement.style.display='none';" style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">&times;</button>
    </div>

    <header class="bg-gray-300 text-black p-4 fixed m-auto w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center">
            <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>" class="text-2xl font-bold hover:text-gray-700">&lt;</a>
            <h1 class="text-xl font-bold ml-4 truncate" style="flex-grow: 1; text-align: center;">Write a Review</h1>
             <div style="width: 24px;"></div>
        </div>
    </header>

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-lg">
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 border-l-4 border-gray-700">
                <p class="text-sm text-gray-600">You are reviewing:</p>
                <h2 class="text-xl font-semibold text-red-500"><?= htmlspecialchars($event['title']) ?></h2>
                <p class="text-xs text-gray-500">by <?= htmlspecialchars($event['user_name']) ?></p>
            </div>

            <?php if ($hasReviewed): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow mb-8" role="alert">
                    <p class="font-bold">Already Reviewed</p>
                    <p>You have already submitted a review for this event.</p>
                </div>
            <?php else: ?>
                <form action="?c=Todos&m=storeReview" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
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
                        <textarea name="review_text" id="review_text" rows="5" 
                                  class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500 focus:border-gray-500" 
                                  placeholder="Share your thoughts about the event..."></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150">
                        Submit Review
                    </button>
                </form>
            <?php endif; ?>

            <div class="mt-10 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-6 border-b border-gray-200 pb-3 text-gray-700">Event Reviews (<?= isset($reviews) ? count($reviews) : 0 ?>)</h3>
                <?php if (empty($reviews)): ?>
                    <p class="text-gray-500">No reviews yet for this event. <?php if(!$hasReviewed) echo "Be the first!" ?></p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-item mb-6 pb-4 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="rounded-full bg-gray-200 w-10 h-10 flex items-center justify-center overflow-hidden">
                                        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="<?= htmlspecialchars($review['user_name']) ?>'s Profile">
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($review['user_name']) ?></p>
                                    <div class="flex items-center mb-1">
                                        <?php 
                                            $rating = $review['rating'] ?? 0; 
                                            for ($s = 1; $s <= 5; $s++): 
                                        ?>
                                            <span class="text-2xl <?= $s <= $rating ? 'text-yellow-500' : 'text-gray-300' ?>">&#9733;</span>
                                        <?php endfor; ?>
                                        <?php if ($rating > 0): ?>
                                            <span class="ml-2 text-xs text-gray-500">(<?= $rating ?> star<?= $rating == 1 ? '' : 's' ?>)</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-500 mb-1">
                                        Reviewed on: <?= date('F j, Y, g:i a', strtotime($review['created_at'])) ?>
                                    </p>
                                    <?php if (!empty(trim($review['review_text']))): ?>
                                    <p class="text-gray-700 whitespace-pre-line mt-2 text-sm"><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            </div>
    </main>

    <footer style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
       <nav class="flex justify-around items-center">
            <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs"><img src="/src/image/icon-home.png" class="w-10 h-10 mb-0.5" alt="Home"><span>Home</span></a>
            <?php $createLink = (isset($userRole) && $userRole === 'speaker') ? "?c=Todos&m=create" : "?c=Todos&m=signUp"; ?>
            <a href="<?= $createLink ?>" class="flex flex-col items-center text-xs"><img src="/src/image/icon-create.png" class="w-10 h-10 mb-0.5" alt="Create"><span>Create</span></a>
            <a href="?c=Todos&m=registered" class="flex flex-col items-center text-xs"><img src="/src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered"><span>My Activities</span></a>
        </nav>
    </footer>
    <script src="src/js/main.js"></script> 
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Star rating form interaction
        const starRatingContainer = document.getElementById('star-rating');
        if (starRatingContainer) { // Check if the container exists (i.e., if the form is displayed)
            const stars = starRatingContainer.querySelectorAll('label span.star-visual'); // Use a more specific class
            const radios = starRatingContainer.querySelectorAll('input[type="radio"].star-radio');
            
            function highlightStars(selectedIndex) {
                stars.forEach((star, i) => {
                    star.classList.toggle('text-yellow-500', i < selectedIndex);
                    star.classList.toggle('text-gray-300', i >= selectedIndex);
                });
            }

            radios.forEach((radio, idx) => {
                radio.addEventListener('change', function() {
                    highlightStars(idx + 1);
                });

                // Keep visual consistency with a more robust hover
                const label = radio.parentElement;
                label.addEventListener('mouseenter', function() {
                    const currentlyChecked = Array.from(radios).findIndex(r => r.checked);
                    if (currentlyChecked === -1 || (idx +1 > currentlyChecked +1) ){ // only highlight on hover if not "behind" a selected star
                         // highlightStars(idx + 1); // This can be a bit jumpy if you move mouse fast
                    }
                });
                label.addEventListener('mouseleave', function() {
                    const checkedIndex = Array.from(radios).findIndex(r => r.checked);
                    highlightStars(checkedIndex >= 0 ? checkedIndex + 1 : 0);
                });

                // Initial state for already checked radio (e.g. if form reloads with error and retains value)
                if (radio.checked) {
                    highlightStars(idx + 1);
                }
            });
        }

        // Pop-up logic (from your app-popups.js, but can be here too if specific to this page's statuses)
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
            message = 'Failed to post your review. You might have already reviewed this event or provided invalid data.';
            popupToDisplay = errorPopup;
            messageSpan = errorMessageSpan;
        }

        if (message && popupToDisplay && messageSpan) {
            messageSpan.textContent = message;
            popupToDisplay.style.display = 'block';

            setTimeout(function() {
                if (popupToDisplay) {
                    popupToDisplay.style.display = 'none';
                }
            }, 3000);
        }
    });
    </script>
</body>
</html>