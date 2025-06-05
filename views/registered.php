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
    <header class="bg-gray-300 text-black p-5 fixed m-auto top-0 w-full shadow-md z-10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow">&lt;</a> GrowTogether</h1>
        </div>
    </header>
    <main>
        <div class="registered-list content-box mt-24 mb-24 w-9/10 mx-auto p-6 bg-white shadow-lg rounded-lg">
            <div class="user-info flex items-center space-x-4 mb-4">
                <span class="user-profile w-16 h-16"><img src="/src/image/profile.png"></span><br>
                <div class="user-name-topic">
                    <span class="user-name"><?= htmlspecialchars($username) ?></span>
                </div>
            </div>

            <div class="bg-gray-300 border-2 border-gray-300 mb-4 mt-8 rounded-lg">
                <h2 class="registered-list-title text-xl font-bold text-center mr-auto">Events Registered</h2>
            </div>

            <div class="flex overflow-x-auto gap-4 p-4">
                <?php if (empty($events)): ?>
                    <p class="text-gray-500">You haven't registered for any events yet.</p>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <div class="flex-none w-40 h-40 border-2 border-gray-200 rounded-lg overflow-hidden shadow-md">
                            <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="Event Image" class="w-full h-28 object-cover">
                            <h2 class="text-center p-2 font-semibold truncate"><?= htmlspecialchars($event['title']) ?></h2>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="bg-gray-300 border-2 border-gray-300 mb-4 mt-8 rounded-lg">
                <h2 class="registered-list-title text-xl font-bold text-center mr-auto">Need Review</h2>
            </div>

            <div class="flex overflow-x-auto gap-4 p-4">
                <?php if (empty($events)): ?>
                    <p class="text-gray-500">You have no events awaiting review.</p>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <div class="flex-none w-40 h-40 border-2 border-gray-200 rounded-lg overflow-hidden shadow-md">
                            <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="Event Image" class="w-full h-28 object-cover">
                            <h2 class="text-center p-2 font-semibold truncate"><?= htmlspecialchars($event['title']) ?></h2>
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
                <img src="/src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered">
                <span>My Activities</span>
            </a>
        </nav>
    </footer>
</body>
</html>