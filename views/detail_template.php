<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Template | GrowHub</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="view/style.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100 antialiased"> 
    <header class="bg-gray-300 text-black p-4 fixed w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center"> <a href="index.php?c=GrowHub&m=list" class="text-xl font-bold flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Detail Template
            </a>
            </div>
    </header>

    <main class="container mx-auto px-4 py-8 mt-20"> <div class="profil flex items-center mt-4 mb-8"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mr-3 text-gray-700"> <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>
            <span class="nama text-2xl font-semibold text-gray-800"><?= htmlspecialchars($username) ?></span> </div>

        <div class="bg-white p-6 rounded-lg shadow-lg"> <?php if (!empty($template)): ?>
                <img src="<?= htmlspecialchars($template['file_path']) ?>"
                    class="detail_template w-full h-auto object-contain mx-auto mb-6 border border-gray-300 rounded-lg"
                    alt="<?= htmlspecialchars($template['title']) ?>">

                <div class="flex flex-col sm:flex-row justify-between items-center mt-4"> <strong class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0 text-center sm:text-left"><?= htmlspecialchars($template['title']) ?></strong>
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
                            Hapus
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-500 mt-8">Template tidak ditemukan atau data kosong.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>