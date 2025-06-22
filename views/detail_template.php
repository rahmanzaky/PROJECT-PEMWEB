<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowHub | Template Details</title>
    <link rel="stylesheet" href="/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-amber-600 text-white p-4 pt-5 pb-5 fixed m-auto w-full shadow-md z-20 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/views/templates.php" class="flex items-center hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                <h1 class="text-xl font-bold">Template Details</h1>
            </a>
        </div>
    </header>

    <main class="py-8 px-4 mt-16">
        <div class="container mx-auto max-w-2xl">
            <div id="template-card" class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center text-gray-500">Loading...</div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const params = new URLSearchParams(window.location.search);
            const templateId = params.get('id');
            const card = document.getElementById('template-card');

            if (!templateId) {
                card.innerHTML = '<p class="text-center text-red-500">No template ID provided.</p>';
                return;
            }

            const user = JSON.parse(localStorage.getItem('current_user') || 'null');
            const token = localStorage.getItem('jwt_token');

            try {
                const response = await fetch(`http://localhost:8080/templates/${templateId}`);
                if (!response.ok) throw new Error(`Template not found.`);
                
                const result = await response.json();
                if (!result.success) throw new Error(result.message || 'Could not fetch template details.');

                const data = result.data;
                document.title = `GrowHub | ${data.title}`;

                const imageUrl = `http://localhost:8080/${data.file_path}`;
                const isOwner = user && parseInt(user.id) === parseInt(data.user_id);

                card.innerHTML = `
                    <div class="user-info flex items-center space-x-4 mb-4 pb-4 border-b border-gray-200">
                        <div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden">
                            <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                        </div>
                        <div>
                            <span class="font-semibold text-lg">${data.user_name}</span>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-800 mt-4 mb-2">${data.title}</h2>
                    <p class="text-md text-gray-500 mb-4">#${data.category}</p>
                    
                    <div class="mb-6 bg-gray-50 rounded-lg border border-gray-200 p-2">
                        <img src="${imageUrl}" alt="${data.title}" class="w-full h-auto object-contain max-h-[70vh]">
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="${imageUrl}" download="${data.title}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-200 text-lg font-semibold shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Download Template
                        </a>
                        ${isOwner ? `
                        <button id="delete-btn" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-lg font-semibold shadow-md">
                            Delete
                        </button>
                        ` : ''}
                    </div>
                `;

                if (isOwner) {
                    const deleteBtn = document.getElementById('delete-btn');
                    deleteBtn.addEventListener('click', () => deleteTemplate(templateId, token));
                }

            } catch (error) {
                console.error('Failed to load template details:', error);
                card.innerHTML = `<p class="text-center text-red-500">${error.message}</p>`;
            }
        });

        async function deleteTemplate(templateId, token) {
            if (!confirm('Are you sure you want to delete this template?')) {
                return;
            }
            try {
                const response = await fetch(`http://localhost:8080/templates/${templateId}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                const result = await response.json();
                if (response.ok && result.success) {
                    alert('Template deleted successfully!');
                    window.location.href = '/views/templates.php';
                } else {
                    throw new Error(result.message || 'Failed to delete template.');
                }
            } catch (error) {
                alert(error.message);
                console.error('Delete error:', error);
            }
        }
    </script>
</body>
</html>