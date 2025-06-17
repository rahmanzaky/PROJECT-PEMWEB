<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Template | GrowHub</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="view/style.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100 antialiased">

    <header class="bg-gray-300 text-black p-4 fixed w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php?c=GrowHub&m=list" class="text-xl font-bold flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                My Template
            </a>
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-gray-700"> <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653Zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438ZM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0Z" clip-rule="evenodd" />
                </svg>
                <span class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($username) ?></span> </div>
        </div>
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
                        <p class="template_title text-center font-bold text-base mt-2"><?= htmlspecialchars($template['title']) ?></p> </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-center text-gray-500 text-lg">Tidak ada template milik kamu yang ditemukan.</p> <?php endif; ?>
        </div>
    </main>

</body>
</html>