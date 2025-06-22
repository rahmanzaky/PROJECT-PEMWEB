<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Template | GrowHub</title> 
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100 antialiased"> 
    <header class="bg-amber-600 text-white p-4 pt-5 pb-5 fixed m-auto w-full shadow-md z-20 top-0">
        <h1 class="text-2xl font-bold ">
            <a href="/views/templates.php" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Upload
            </a>
        </h1>
    </header>
    
    <main class="container mx-auto px-4 py-8 mt-20"> <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto"> <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">New Template</h2> <form id="templateForm" enctype="multipart/form-data" class="flex flex-col space-y-6">

                <div>
                    <label for="template_file" class="block text-gray-700 font-semibold mb-2">Select Template File:</label>
                    <input type="file" id="template_file" name="template_file" class="w-full text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"> <p class="text-sm text-gray-500 mt-1">Format file: PDF, DOCX, PPTX, JPG, PNG.</p> </div>

                <div>
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Template Title:</label>
                    <input type="text" id="title" name="title" placeholder="Ex: Proposal Kegiatan Sosial 2025" class="w-full border border-gray-300 rounded-md p-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"> </div>

                <div>
                    <label for="category" class="block text-gray-700 font-semibold mb-2">Category:</label>
                    <select id="category" name="category" class="w-full border border-gray-300 rounded-md p-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"> <option value="">-- Category --</option> <option value="1">Proposal</option>
                        <option value="2">LPJ (Laporan Pertanggungjawaban)</option>
                        <option value="3">TOR (Term of Reference)</option>
                        <option value="4">Cue Card</option>
                        <option value="5">Rundown</option>
                        <option value="6">Another Document</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md transform hover:scale-105">Upload Template</button>

            </form>
        </div>
        <div id="response-message" class="hidden text-sm p-3 rounded-lg mb-4 text-center"></div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        const token = localStorage.getItem('jwt_token');

        if (!user || !token) {
            alert('You must be logged in to upload templates.');
            window.location.href = '/views/login.php';
            return;
        }

        document.getElementById('templateForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const messageDiv = document.getElementById('response-message');
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Uploading...';
            messageDiv.className = 'hidden text-sm p-3 rounded-lg mb-4 text-center';
            const formData = new FormData(this);
            
            try {
                const response = await fetch('http://localhost:8080/templates', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    body: formData
                });
                const result = await response.json();
                if (response.ok) {
                    messageDiv.textContent = result.message || 'Template uploaded successfully!';
                    messageDiv.classList.add('bg-green-100', 'text-green-700');
                    messageDiv.classList.remove('hidden');
                    setTimeout(() => {
                        window.location.href = 'templates.php';
                    }, 2000);
                } else {
                    messageDiv.textContent = result.message || 'Failed to upload template.';
                    messageDiv.classList.add('bg-red-100', 'text-red-700');
                    messageDiv.classList.remove('hidden');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Upload Template';
                    
                    // Check for foreign key constraint error specifically
                    if (result.error && result.error.toLowerCase().includes('foreign key constraint fails')) {
                        alert('Your session is invalid or has expired. You will be redirected to the login page.');
                        localStorage.removeItem('jwt_token');
                        localStorage.removeItem('current_user');
                        window.location.href = '/views/login.php';
                    }
                }
            } catch (error) {
                messageDiv.textContent = 'An error occurred. Please make sure the API server is running.';
                messageDiv.classList.add('bg-red-100', 'text-red-700');
                messageDiv.classList.remove('hidden');
                submitButton.disabled = false;
                submitButton.textContent = 'Upload Template';
                console.error('Template Upload Error:', error);
            }
        });
    });
    </script>

</body>
</html>