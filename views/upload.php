<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Template | GrowHub</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="view/style.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100 antialiased"> 
    <header class="bg-gray-300 text-black p-4 fixed w-full shadow-md z-10 top-0">
        <div class="container mx-auto flex items-center"> <a href="index.php?c=GrowHub&m=list" class="text-xl font-bold flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2"> <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Upload
            </a>
            </div>
    </header>

    <main class="container mx-auto px-4 py-8 mt-20"> <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto"> <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">New Template</h2> <form id="templateForm" action="index.php?c=GrowHub&m=add" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-6">

                <div>
                    <label for="template_file" class="block text-gray-700 font-semibold mb-2">Pilih File Template:</label>
                    <input type="file" id="template_file" name="template_file" class="w-full text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"> <p class="text-sm text-gray-500 mt-1">Format yang didukung: PDF, DOCX, PPTX, JPG, PNG.</p> </div>

                <div>
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Template:</label>
                    <input type="text" id="title" name="title" placeholder="Contoh: Proposal Kegiatan Sosial 2025" class="w-full border border-gray-300 rounded-md p-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"> </div>

                <div>
                    <label for="category" class="block text-gray-700 font-semibold mb-2">Kategori:</label>
                    <select id="category" name="category" class="w-full border border-gray-300 rounded-md p-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"> <option value="">-- Pilih Kategori --</option> <option value="1">Proposal</option>
                        <option value="2">LPJ (Laporan Pertanggungjawaban)</option>
                        <option value="3">TOR (Term of Reference)</option>
                        <option value="4">Cue Card</option>
                        <option value="5">Rundown</option>
                        <option value="6">Dokumen Lain</option>
                    </select>
                </div>

                <div class="flex justify-end pt-4"> <button type="submit" class="bg-blue-600 text-white text-lg py-2 px-6 rounded-md hover:bg-blue-700 transition duration-200 font-semibold">Upload</button> </div>

            </form>
        </div>
    </main>

    <script>
        document.getElementById("templateForm").addEventListener("submit", function(event) {
            const fileInput = document.getElementById("template_file");
            const title = document.getElementById("title").value.trim();
            const category = document.getElementById("category").value;

            if (fileInput.files.length === 0) {
                alert("Mohon pilih file template terlebih dahulu.");
                event.preventDefault();
                return;
            }

            if (title === "") {
                alert("Mohon masukkan judul template.");
                event.preventDefault();
                return;
            }

            if (category === "") {
                alert("Mohon pilih kategori template.");
                event.preventDefault();
                return;
            }

            // Optional: Validasi tipe file
            const allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'image/jpeg', 'image/png'];
            if (!allowedTypes.includes(fileInput.files[0].type)) {
                alert("Format file tidak didukung. Mohon unggah PDF, DOCX, PPTX, JPG, atau PNG.");
                event.preventDefault();
                return;
            }
        });
    </script>

</body>
</html>