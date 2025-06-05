<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>GrowTogether</title>
</head>

<body class="bg-gray-100 font-sans text-gray-800">
    <header class="bg-gray-300 text-black p-5 fixed top-0 w-full shadow-md z-10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                <a href="?c=Todos&m=grow">&lt;</a> GrowTogether
            </h1>
        </div>
        <form method="POST" action="?c=Todos&m=search" class="flex mt-2">
            <input 
                type="text" name="query" placeholder="Search events..." 
                class="border border-gray-500 rounded-lg px-4 py-2 w-full"
                value="<?php echo isset($_POST['query']) ? htmlspecialchars($_POST['query']) : ''; ?>"
            >
            <button 
                type="submit" 
                class="ml-4 mt-2 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600"
            >
                Search
            </button>
        </form>
    </header>

    <main class="event-search-list py-8 px-4 mt-28 mb-2">
        <div class="container mx-auto grid grid-cols-1 mb-2 gap-6 p-auto m-auto">
            <p class="text-gray-600 mb-2">
                Showing results for: 
                <strong><?php echo isset($_POST['query']) ? htmlspecialchars($_POST['query']) : 'All Events'; ?></strong>
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-16">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="event-card-small border border-gray-300 rounded-lg p-4 shadow-sm">
                        <h2 class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($event['title']); ?></h2>
                        
                        <?php if (!empty($event['image_url']) && file_exists($event['image_url'])): ?>
                            <img 
                                class="w-full h-40 sm:h-50 md:h-60 rounded-lg object-cover" 
                                src="<?= htmlspecialchars($event['image_url']); ?>" 
                                alt="Event Image"
                            >
                        <?php else: ?>
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">No events found.</p>
            <?php endif; ?>
            </div>
        </div>
    </main>

    <footer style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
        <nav class="flex justify-around items-center">
            <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs">
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
            <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs">
                <img src="src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered">
                <span>My Activities</span>
            </a>
        </nav>
    </footer>
</body>
</html>
