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

    <header class="bg-amber-600 flex items-center text-white p-4 pt-5 pb-5 fixed m-auto w-full shadow-md z-20 top-0">
        <h1 class="text-2xl font-bold ">
            <a href="/views/templates.php" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                My Templates
            </a>
        </h1>
    </header>

    <main class="container mx-auto px-4 py-8 mt-12"> 
        <div id="my-templates-grid" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 p-2">
            <p class="col-span-full text-center text-gray-500 text-lg py-10">Loading your templates...</p>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', async () => {
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        const token = localStorage.getItem('jwt_token');

        if (!user || !token) {
            alert('You must be logged in to view your templates.');
            window.location.href = '/views/login.php';
            return;
        }

        async function fetchMyTemplates() {
            try {
                const response = await fetch(`http://localhost:8080/templates`, {
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                if (!response.ok) throw new Error('Could not fetch your templates.');
                const result = await response.json();
                if(!result.success) throw new Error(result.message || 'API request failed');

                const myTemplates = result.data.filter(template => template.user_id === user.id);
                displayMyTemplates(myTemplates);
            } catch (error) {
                console.error(error);
                document.getElementById('my-templates-grid').innerHTML = '<p class="text-center text-red-500 col-span-full">Failed to load your templates.</p>';
            }
        }

        function displayMyTemplates(templates) {
            const templateGrid = document.getElementById('my-templates-grid');
            templateGrid.innerHTML = '';
            if (templates.length === 0) {
                templateGrid.innerHTML = '<p class="text-gray-500 col-span-full text-center py-10">You have not uploaded any templates yet.</p>';
                return;
            }

            templates.forEach(template => {
                const imageUrl = `http://localhost:8080/${template.file_path}`;
                const card = `
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between hover:shadow-xl transition-shadow">
                        <a href="detail_template.php?id=${template.id}">
                            <img src="${imageUrl}" alt="${template.title}" class="w-full h-40 object-cover rounded-md mb-4" onerror="this.src='/src/image/placeholder.png';">
                            <h3 class="font-semibold text-md truncate">${template.title}</h3>
                        </a>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs text-gray-500">#${template.category}</span>
                            <button onclick="deleteTemplate(${template.id})" class="text-red-500 hover:text-red-700 font-semibold text-xs">Delete</button>
                        </div>
                    </div>
                `;
                templateGrid.innerHTML += card;
            });
        }

        async function deleteTemplate(templateId) {
        }

        fetchMyTemplates();
    });
    </script>

</body>
</html>