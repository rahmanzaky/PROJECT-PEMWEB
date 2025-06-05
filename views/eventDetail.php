<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>GrowTogether - <?= htmlspecialchars($event['title']) ?></title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24"> 

    <div id="successPopup"
         style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #28a745; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="popupMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="document.getElementById('successPopup').style.display='none';"
                style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">
            &times;
        </button>
    </div>

    <header class="bg-gray-300 text-black p-4 fixed m-auto w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center">
            <a href="?c=Todos&m=grow" class="text-2xl font-bold hover:text-blue-700">&lt;</a>
            <h1 class="text-xl font-bold ml-4 py-2 truncate" style="flex-grow: 1; text-align: center;"><?= htmlspecialchars($event['title']) ?></h1>
            <div style="width: 24px;"></div> 
        </div>
    </header>

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-2xl">
            <div class="event-card bg-white p-6 rounded-lg shadow-lg">
                
                <div class="user-info flex items-center space-x-4 mb-6">
                    <span class="user-profile">
                        <div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden">
                            <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="<?= htmlspecialchars($event['user_name']) ?>'s Profile">
                        </div>
                    </span>
                    <div>
                        <span class="user-name block font-semibold text-lg"><?= htmlspecialchars($event['user_name']) ?></span>
                        <span class="event-topic text-gray-600 text-sm">#<?= htmlspecialchars($event['topic']) ?></span>
                    </div>
                </div>

                <?php if (!empty($event['image_url'])): ?>
                    <div class="mb-6 rounded-lg overflow-hidden shadow-md">
                        <img src="/<?= htmlspecialchars($event['image_url']) ?>" class="w-full h-auto object-contain max-h-[60vh]" alt="<?= htmlspecialchars($event['title']) ?>">
                    </div>
                <?php endif; ?>
                
                <h2 class="text-2xl font-bold mb-3 sr-only"><?= htmlspecialchars($event['title']) ?></h2>

                <div class="prose max-w-none mb-6">
                    <h3 class="text-xl font-semibold mt-4 mb-2">Description:</h3>
                    <p class="text-gray-700 whitespace-pre-line"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                </div>

                <?php if (!empty($event['key_summary_path'])): ?>
                    <div class="mt-6 mb-6">
                        <h3 class="text-lg font-semibold mb-2">Key Summary:</h3>
                        <a href="/<?= htmlspecialchars($event['key_summary_path']) ?>" 
                           target="_blank" 
                           download="<?= basename(htmlspecialchars($event['key_summary_path'])) ?>"
                           class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150 ease-in-out">
                           Download PDF Summary
                        </a>
                    </div>
                <?php endif; ?>

                <div class="event-actions flex justify-around items-center mt-8 pt-6 border-t border-gray-200">
                    <a href="?c=Todos&m=showReviewForm&event_id=<?= $event['id'] ?>" class="event-rating text-yellow-500 text-3xl hover:text-yellow-400">★</a>
                    
                    <?php
                        if (isset($currentUserId) && $event['user_id'] == $currentUserId):
                    ?>
                        <button class="join-event bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed text-lg font-semibold" disabled>Your Event</button>
                    <?php
                        elseif (isset($registeredEventIds) && in_array($event['id'], $registeredEventIds)):
                    ?>
                        <button class="join-event bg-green-600 text-white px-6 py-3 rounded-lg cursor-not-allowed text-lg font-semibold" disabled>✓ Joined</button>
                    <?php else: ?>
                        <a href="?c=Todos&m=joinEvent&id=<?= $event['id'] ?>" class="join-event bg-gray-700 hover:bg-gray-800 text-white px-6 py-3 rounded-lg text-lg font-semibold transition-transform duration-200 hover:scale-105">Join Event</a>
                    <?php endif; ?>
                    <a href="?c=Todos&m=showComments&event_id=<?= $event['id'] ?>" class="comment-event text-3xl text-gray-500 hover:text-gray-700">💬</a>
                </div>
            </div>
        </div>
    </main>

    <footer style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
        <nav class="flex justify-around items-center">
            <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs">
                <img src="/src/image/icon-home.png" class="w-10 h-10 mb-0.5" alt="Home">
                <span>Home</span>
            </a>
            <?php
                $createLink = "?c=Todos&m=signUp"; 
                if (isset($userRole) && $userRole === 'speaker') {
                    $createLink = "?c=Todos&m=create"; 
                }
            ?>
            <a href="<?= $createLink ?>" class="flex flex-col items-center text-xs">
                <img src="/src/image/icon-create.png" class="w-10 h-10 mb-0.5" alt="Create">
                <span>Create</span>
            </a>
            <a href="?c=Todos&m=registered" class="flex flex-col items-center text-xs">
                <img src="/src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered">
                <span>My Activities</span>
            </a>
        </nav>
    </footer>

    <script src="src/js/main.js"></script> 
</body>
</html>