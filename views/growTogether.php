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
<header class="bg-gray-300 text-black p-4 fixed m-auto w-full shadow-md z-10">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow">&lt;</a> GrowTogether</h1>
        <form action="?c=Todos&m=search" method="POST" class="flex">
            <input type="text" name="query" placeholder="Search" class="p-2 rounded-md border-2 border-gray-500 focus:outline-none focus:border-blue-700">
            <button type="submit" class="hidden"></button>
        </form>
    </div>
</header>

<main class="event-list py-8 px-4 mb-2">
    <div class="container mx-auto grid grid-cols-1 mb-20 gap-6 p-auto m-auto mt-14">
        <?php foreach ($events as $event): ?>
            <div class="event-card bg-white p-6 rounded-lg shadow-lg">
                <div class="user-info flex items-center space-x-4 mb-4">
                    <span class="user-profile">
                        <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden">
                            <img src="src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                        </div>
                    </span>
                    <div class="user-name-topic">
                        <span class="user-name font-semibold"><?= $event['user_name'] ?></span><br>
                        <span class="event-topic text-gray-500">#<?= htmlspecialchars($event['topic']) ?></span>
                    </div>
                </div>
                <h2 class="text-xl font-semibold mb-2"><?= $event['title'] ?></h2>
                <p class="text-gray-600 mb-4"><?= $event['description'] ?></p>
                <div class="border-2 border-gray-300 mb-4">
                    <img src="<?= $event['image_url'] ?>" class="w-full object-cover" alt="Event Image">
                </div>
                <div class="event-actions flex justify-between items-center">
                    <button onclick="location.href='?c=Todos&m=ulasan'" class="event-rating text-yellow-500 text-3xl">★</button>

                        <?php
                            // Check 1: Is this the user's own event?
                            if (isset($currentUserId) && $event['user_id'] == $currentUserId):
                        ?>
                            <button class="join-event bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>Your Event</button>

                        <?php
                            // Check 2: Has the user already joined this event?
                            elseif (isset($registeredEventIds) && in_array($event['id'], $registeredEventIds)):
                        ?>
                            <button class="join-event bg-green-600 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>✓ Joined</button>
                            
                        <?php else: ?>
                            <a href="?c=Todos&m=joinEvent&id=<?= $event['id'] ?>" class="join-event bg-gray-600 text-white px-4 py-2 rounded-lg transform transition-transform duration-200 hover:scale-110">Join Event</a>

                        <?php endif; ?>

                    <button class="comment-event text-3xl">💬</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
    <nav class="flex justify-around items-center">
        <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs pt-px mt-[-12]">
            <img src="src/image/icon-home.png" class="w-10 h-10 mb-0.5" alt="Home">
            <span>Home</span>
        </a>
        <?php
              $createLink = "?c=Todos&m=signUp"; // Default link for non-speakers
              if (isset($userRole) && $userRole === 'speaker') {
                  $createLink = "?c=Todos&m=create"; // Link for speakers
              }
            ?>
            <a href="<?= $createLink ?>" class="flex flex-col items-center text-xs">
                <img src="/src/image/icon-create.png" class="w-10 h-10 mb-0.5" alt="Create">
                <span>Create</span>
            </a>
        <a href="?c=Todos&m=registered" class="flex flex-col items-center text-xs">
            <img src="src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered">
            <span>My Activities</span>
        </a>
    </nav>
</footer>

</body>

</html>