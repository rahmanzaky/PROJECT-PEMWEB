<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>GrowTogether - Search Results</title>
</head>

<body class="bg-gray-100 font-sans text-gray-800 pb-24">
    <header class="bg-gray-300 text-black p-5 fixed top-0 w-full shadow-md z-10">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    <a href="?c=Todos&m=grow" class="hover:text-blue-700">&lt;</a> GrowTogether
                </h1>
            </div>
            <form method="POST" action="?c=Todos&m=search" class="flex mt-2">
                <input 
                    type="text" name="query" placeholder="Search events..." 
                    class="border border-gray-500 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="<?= htmlspecialchars($_POST['query'] ?? '') ?>"
                >
                <button 
                    type="submit" 
                    class="ml-2 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700"
                >
                    Search
                </button>
            </form>
        </div>
    </header>

    <main class="event-search-list py-8 px-4 mt-32">
        <div class="container mx-auto">
            <p class="text-gray-700 mb-4 text-lg">
                Showing results for: 
                <strong><?= htmlspecialchars($_POST['query'] ?? 'All Events') ?></strong>
            </p>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-16">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>" class="block event-card-small border border-gray-200 rounded-lg p-4 shadow-lg hover:shadow-xl transition-shadow duration-200 bg-white">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800 truncate"><?= htmlspecialchars($event['title']) ?></h2>
                        
                        <div class="w-full h-36 md:h-48 bg-gray-200 rounded-md overflow-hidden mb-3">
                            <?php if (!empty($event['image_url']) && file_exists($event['image_url'])): ?>
                                <img 
                                    class="w-full h-full object-cover" 
                                    src="/<?= htmlspecialchars($event['image_url']) ?>" 
                                    alt="<?= htmlspecialchars($event['title']) ?>"
                                >
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            By: <?= htmlspecialchars($event['user_name']) ?>
                        </p>
                        <p class="text-sm text-gray-500">
                            Topic: #<?= htmlspecialchars($event['topic']) ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600 col-span-full text-center py-10">No events found matching your search.</p>
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
    
    <script src="src/js/main.js"></script> 
</body>
</html>