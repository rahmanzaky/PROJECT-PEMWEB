<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Template | GrowHub</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100 antialiased"> 
    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20 top-0">
        <h1 class="text-2xl font-bold ">
            <a href="?c=GrowHub&m=list" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Upload
            </a>
        </h1>
    </header>
    
    <main class="container mx-auto px-4 py-8 mt-20"> <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto"> <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">New Template</h2> <form id="templateForm" action="index.php?c=GrowHub&m=add" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-6">

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

                <div class="flex justify-end pt-4"> 
                    <button type="submit" class="bg-gray-600 text-white text-lg py-2 px-6 rounded-md hover:bg-gray-700 transition duration-200 font-semibold">
                        Upload
                    </button> 
                </div>

            </form>
        </div>
    </main>

    <script>
        document.getElementById("templateForm").addEventListener("submit", function(event) {
            const fileInput = document.getElementById("template_file");
            const title = document.getElementById("title").value.trim();
            const category = document.getElementById("category").value;

            if (fileInput.files.length === 0) {
                alert("Please select a template file first.");
                event.preventDefault();
                return;
            }

            if (title === "") {
                alert(" Please enter the template title.");
                event.preventDefault();
                return;
            }

            if (category === "") {
                alert("Please select a template category.");
                event.preventDefault();
                return;
            }

            // Optional: Validasi tipe file
            const allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'image/jpeg', 'image/png'];
            if (!allowedTypes.includes(fileInput.files[0].type)) {
                alert("Unsupported file format. Please upload a PDF, DOCX, PPTX, JPG, or PNG file.");
                event.preventDefault();
                return;
            }
        });
    </script>

</body>
</html>