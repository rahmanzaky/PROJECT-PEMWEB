

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Thread | GrowForum</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .btn-delete {
            background-color: #ffffff;
            color: black;
            padding: 10px 20px;
            border: 3px solid black;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        .btn-delete:hover {
            background-color: #f0f0f0;
        }
    </style>
    <script>
        function showConfirmModal() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function hideConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function confirmDelete() {
            const threadId = <?php echo $thread['id']; ?>;
            window.location.href = 'index.php?c=GrowForum&m=delete&id=' + threadId;
        }
    </script>
</head>
<body class="bg #f8f8f8 font-sans">

    <div class="w-full min-h-screen flex flex-col">

        <!-- Header -->
        
    <!-- <header class="bg-amber-600 text-black p-4 fixed w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center"> <a href= 'index.php?c=GrowForum&m=index' class="text-xl font-bold flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Thread Details
            </a>
            </div>
    </header> -->
        
    <header class="bg-amber-600 text-white p-4 pb-5 pt-5 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex items-center">
            <a href="?c=GrowForum&m=index"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <h1 class="text-2xl font-bold">
                <a href="?c=GrowForum&m=index">Thread Details</a>
            </h1>
        </div>
    </header>

        <!-- Konten Utama -->
        <main class="flex-grow p-4">
            <div class="flex items-center space-x-3 mb-4 mt-24">
                <img src="uploads/images/profile_growlink.jpg" alt="Profil" class="w-12 h-12 rounded-full border border-gray-100">
                <strong class="text-gray-800"><?php echo $thread['author']; ?></strong>
            </div>

            <div class="pl-14 text-gray-800">
                <p class="text-sm"><?php echo nl2br($thread['content']); ?></p>
            </div>
        </main>

        
        <?php if ($thread['user_id'] == $currentUserId): ?>
    <button class="btn-delete" onclick="showConfirmModal()">Delete</button>
<?php endif; ?>


    </div>

    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
            <h2 class="text-lg font-semibold mb-4">Are you sure you want to delete this thread?</h2>
            <div class="flex justify-center gap-4">
                <button onclick="hideConfirmModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button onclick="confirmDelete()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

</body>
</html>
