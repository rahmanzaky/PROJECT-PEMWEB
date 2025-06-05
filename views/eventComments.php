<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Comments for: <?= htmlspecialchars($event['title']) ?></title>
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
    <div id="errorPopup"
         style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%); background-color: #dc3545; color:white; padding:16px 20px; border-radius:8px; z-index:1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 16px; text-align: center;">
        <span id="errorMessage" style="margin-right: 20px;"></span>
        <button type="button" onclick="document.getElementById('errorPopup').style.display='none';"
                style="background:none; border:none; color:white; font-weight:bold; font-size:22px; line-height:1; cursor:pointer; vertical-align: middle;">
            &times;
        </button>
    </div>


    <header class="bg-gray-300 text-black p-4 fixed m-auto w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center">
            <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>" class="text-2xl font-bold hover:text-red-500">&lt;</a>
            <h1 class="text-xl font-bold ml-4 truncate" style="flex-grow: 1; text-align: center;"><?= htmlspecialchars($event['title']) ?></h1>
            <div style="width: 24px;"></div>
        </div>
    </header>

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-2xl">
            
            <div class="bg-white p-4 rounded-lg shadow mb-6 border-l-4 border-gray-700">
                <p class="text-sm text-gray-600">Commenting on event by: <?= htmlspecialchars($event['user_name']) ?></p>
                <h2 class="text-lg font-semibold text-red-500"><?= htmlspecialchars($event['title']) ?></h2>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4">Add Your Comment</h3>
                <form action="?c=Todos&m=storeComment" method="POST">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $currentUserId ?>">
                    
                    <div class="mb-4">
                        <textarea name="comment_text" rows="4" 
                                  class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  placeholder="Write your comment here, <?= htmlspecialchars($currentUserName) ?>..." required></textarea>
                    </div>
                    <button type="submit" 
                            class="w-full bg-gray-500 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-lg shadow hover:shadow-md transition-colors duration-150">
                        Post Comment
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-6 border-b pb-3">Comments (<?= count($comments) ?>)</h3>
                <?php if (empty($comments)): ?>
                    <p class="text-gray-500">Be the first to comment on this event!</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-item mb-6 pb-4 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="rounded-full bg-gray-200 w-10 h-10 flex items-center justify-center overflow-hidden">
                                        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="<?= htmlspecialchars($comment['user_name']) ?>'s Profile">
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($comment['user_name']) ?></p>
                                    <p class="text-xs text-gray-500 mb-1">
                                        <?php
                                            $utc_datetime = new DateTime($comment['created_at'], new DateTimeZone('UTC'));
                                            $utc_datetime->setTimezone(new DateTimeZone('Asia/Jakarta'));
                                            echo $utc_datetime->format('F j, Y, g:i a');
                                        ?>
                                    </p>
                                    <p class="text-gray-700 whitespace-pre-line"><?= nl2br(htmlspecialchars($comment['comment_text'])) ?></p>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            if (status === 'comment_added') {
                message = 'Your comment has been posted successfully!';
                popupToDisplay = successPopup;
                messageSpan = successMessageSpan;
            } else if (error === 'comment_failed') {
                message = 'Failed to post your comment. Please try again.';
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
                }, 2000);
            }
        });
    </script>
</body>
</html>