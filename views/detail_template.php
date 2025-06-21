<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Template | GrowHub</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100 antialiased"> 
    <header class="bg-amber-600 text-white p-4 pb-5 pt-5 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex items-center">
            <a href="?c=GrowHub&m=list"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <h1 class="text-2xl font-bold">
                <a href="?c=GrowForum&m=list">Template Details</a>
            </h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 mt-12"> 
        <div class="profil flex items-center mt-4 mb-8"> 
            <img src="/src/image/profile.png" alt="Profil" class="w-12 h-12 rounded-full border border-gray-1.000 mr-3" />
            <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($currentUserName) ?></h1>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg"> <?php if (!empty($template)): ?>
                <img src="<?= htmlspecialchars($template['file_path']) ?>"
                    class="detail_template w-full h-auto object-contain mx-auto mb-6 border border-gray-300 rounded-lg"
                    alt="<?= htmlspecialchars($template['title']) ?>">

                <div class="flex flex-col sm:flex-row justify-between items-center mt-4"> 
                    <strong class="text-xl font-bold text-gray-900 mb-4 sm:mb-0  sm:text-left"><?= htmlspecialchars($template['title']) ?></strong>
                    <div class="flex justify-center sm:justify-end space-x-4"> <a href="<?= htmlspecialchars($template['file_path']) ?>" download class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200 text-base font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            Download
                        </a>
                        <a href="?c=GrowHub&m=delete&id=<?= $template['id']; ?>" class="flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white rounded-full hover:bg-red-700 transition duration-200 text-base font-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus template ini?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Delete
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-500 mt-8">No template found or empty data.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>