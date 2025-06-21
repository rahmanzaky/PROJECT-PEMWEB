<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Template | GrowHub</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100 antialiased">

    <header class="bg-amber-600 flex items-center text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <h1 class="text-2xl font-bold ">
            <a href="?c=GrowHub&m=list" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                My Templates
            </a>
        </h1>
    </header>

    <main class="container mx-auto px-4 py-8 mt-12"> 
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 p-2">
            <?php if (!empty($templates)): ?>
                <?php foreach($templates as $template): ?>
                    <div class="template_item bg-white shadow-md hover:shadow-lg transition-all duration-300 p-4 rounded-xl flex flex-col items-center">
                        <a href="index.php?c=GrowHub&m=detail&id=<?= $template['id']; ?>" class="w-full">
                            <img
                                src="<?= htmlspecialchars($template['file_path']) ?>"
                                alt="<?= htmlspecialchars($template['title']) ?>"
                                class="w-full h-48 object-cover rounded-md mb-4" >
                        </a>
                        <p class="template_title text-center font-bold text-base mt-2"><?= htmlspecialchars($template['title']) ?></p> 
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-center text-gray-500 text-lg">No templates of yours were found.</p> <?php endif; ?>
        </div>
    </main>

</body>
</html>