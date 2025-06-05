<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>My Activities - GrowTogether</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800 pb-24">
    <header class="bg-gray-300 text-black p-5 fixed m-auto top-0 w-full shadow-md z-10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow" class="hover:text-blue-700">&lt;</a> My Activities</h1>
        </div>
    </header>
    <main class="py-8 px-4 mt-20">
        <div class="container mx-auto max-w-2xl">
            <div class="user-info flex items-center space-x-4 mb-8 p-4 bg-white rounded-lg shadow">
                <span class="user-profile w-16 h-16"><img src="/src/image/profile.png" class="rounded-full"></span>
                <div>
                    <span class="user-name text-xl font-semibold"><?= htmlspecialchars($username) ?></span>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($userRole) === 'speaker' ? 'Speaker Account' : 'User Account' ?></p>
                </div>
            </div>

            <!-- Events Registered Section -->
            <section class="mb-10">
                <div class="bg-gray-200 p-3 rounded-t-lg shadow">
                    <h2 class="text-xl font-bold text-center text-gray-700">Events Joined</h2>
                </div>
                <div class="bg-white p-4 rounded-b-lg shadow">
                    <?php if (empty($registeredEvents)): ?>
                        <p class="text-gray-500 text-center py-3">You haven't joined any events yet.</p>
                    <?php else: ?>
                        <div class="flex overflow-x-auto gap-4 p-2 -mx-2">
                            <?php foreach ($registeredEvents as $event): ?>
                                <a href="?c=Todos&m=showEvent&id=<?= $event['id'] ?>" class="flex-none w-40 border border-gray-200 rounded-lg overflow-hidden shadow hover:shadow-md transition-shadow">
                                    <img src="/<?= htmlspecialchars($event['image_url']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-24 object-cover">
                                    <h3 class="text-center p-2 text-sm font-semibold truncate"><?= htmlspecialchars($event['title']) ?></h3>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Events Needing Review Section -->
            <section>
                <div class="bg-red-200 p-3 rounded-t-lg shadow">
                    <h2 class="text-xl font-bold text-center text-red-700">Events Needing Your Review</h2>
                </div>
                <div class="bg-white p-4 rounded-b-lg shadow">
                     <?php if (empty($eventsNeedingReview)): ?>
                        <p class="text-gray-500 text-center py-3">No events awaiting your review. Great job!</p>
                    <?php else: ?>
                        <div class="flex overflow-x-auto gap-4 p-2 -mx-2">
                            <?php foreach ($eventsNeedingReview as $event): ?>
                                <a href="?c=Todos&m=showReviewForm&event_id=<?= $event['id'] ?>" class="flex-none w-40 border border-gray-200 rounded-lg overflow-hidden shadow hover:shadow-md transition-shadow">
                                    <img src="/<?= htmlspecialchars($event['image_url']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-24 object-cover">
                                    <h3 class="text-center p-2 text-sm font-semibold truncate"><?= htmlspecialchars($event['title']) ?></h3>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
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
</body>
</html>