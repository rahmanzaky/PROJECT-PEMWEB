<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowHub | Template Sharing</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>

<body class="font-sans bg-gray-100">

    <header class="bg-amber-600 text-white p-4 fixed m-auto w-full shadow-md z-20">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                <a href="/views/templates.php">GrowHub</a>
            </h1>
            <div class="flex items-center space-x-2">
                <a href="/views/upload.php" title="Unggah Template" class="p-2 rounded-full hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </a>
                <button id="hamburger-btn" class="p-2 focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
    
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-orange-50 backdrop-blur-lg shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="flex flex-col h-full p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-800">Menu</h2>
                <button id="close-menu-btn" class="p-2 text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center space-x-3 mb-8 border-b border-amber-600 pb-6">
                <div class="flex-shrink-0">
                    <div class="rounded-full bg-gray-200 w-12 h-12 flex items-center justify-center overflow-hidden">
                        <img src="/src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                    </div>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 user-name">Guest</p>
                    <p class="text-sm text-gray-500 user-role">user</p>
                </div>
            </div>
            <nav class="flex flex-col space-y-1 flex-grow">
                <a href="/views/home.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>Home</a>
                <a href="/views/growTogether.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>GrowTogether</a>
                <a href="/views/templates.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0l2-2m-2 2l-2-2" /></svg>GrowHub</a>
                <a href="/views/list.php" class="flex items-center p-3 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H17z" /></svg>GrowForum</a>
            </nav>
            <div class="mt-auto">
                <a href="/views/login.php" class="flex items-center w-full p-3 text-red-500 font-semibold rounded-lg hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>Logout</a>
            </div>
        </div>
    </div>
    <div id="menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 opacity-0 invisible transition-opacity duration-300 ease-in-out"></div>

    <main class="container mx-auto px-4 pt-24 pb-8">
        <div class="w-full flex items-center gap-2 mb-6">
            <input type="text" id="search" placeholder="Cari template..." onkeyup="searchTemplates()"
                class="flex-grow text-base p-3 border-2 border-amber-500 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-600"
            />
            <a href="/views/my_template.php" title="Template Saya"
               class="p-3 rounded-lg bg-white border-2 border-amber-500 text-amber-600 hover:bg-amber-50 transition shadow-sm flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </a>
        </div>

        <div id="template-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            <p class="col-span-full text-center text-gray-500 text-lg py-10">Loading templates...</p>
        </div>
    </main>

    <script>
    function searchTemplates() {
        const input = document.getElementById("search").value.toLowerCase();
        const grid = document.getElementById("template-grid");

        const items = grid.getElementsByClassName("template_item");
        for (let i = 0; i < items.length; i++) {
            const title = items[i].querySelector(".template_title");
            const author = items[i].querySelector("p:last-child"); // Author element
            if (title) {
                const titleText = title.textContent.toLowerCase() || title.innerText.toLowerCase();
                const authorText = author ? (author.textContent.toLowerCase() || author.innerText.toLowerCase()) : '';
                const searchText = titleText + ' ' + authorText;
                items[i].style.display = searchText.includes(input) ? "" : "none";
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        const userNameEls = document.querySelectorAll('.user-name');
        const userRoleEls = document.querySelectorAll('.user-role');

        if (user) {
            userNameEls.forEach(el => el.textContent = user.full_name || user.user_name || 'Guest');
            userRoleEls.forEach(el => el.textContent = user.role || 'user');
        } else {
            userNameEls.forEach(el => el.textContent = 'Guest');
            userRoleEls.forEach(el => el.textContent = 'user');
        }

        async function fetchTemplates() {
            try {
                const response = await fetch('http://localhost:8080/templates');
                if (!response.ok) {
                    throw new Error('Failed to fetch templates from the server.');
                }
                const result = await response.json();
                if (!result.success) {
                    throw new Error(result.message || 'API returned an error.');
                }
                allTemplates = result.data; // Correctly access the data array
                displayTemplates(allTemplates);
            } catch (error) {
                console.error('Error fetching templates:', error);
                const container = document.getElementById('template-grid');
                if (container) {
                    container.innerHTML = '<p class="col-span-full text-center text-red-500 py-10">Failed to load templates. Please try again later.</p>';
                }
            }
        }

        function displayTemplates(templates) {
            const templateGrid = document.getElementById('template-grid');
            if (!templateGrid) return;
            templateGrid.innerHTML = '';
            
            if (templates && templates.length > 0) {
                templates.forEach(template => {
                    const templateElement = document.createElement('div');
                    templateElement.className = 'template_item';
                    templateElement.innerHTML = `
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                            <a href="/views/detail_template.php?id=${template.id}" class="block">
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <img src="http://localhost:8080/${template.file_path}" alt="${template.title}" class="w-full h-full object-cover">
                                </div>
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="template_title font-semibold text-gray-800 truncate flex-grow">${template.title}</h3>
                                <p class="text-sm text-gray-500 mt-2">By: ${template.user_name || 'Anonymous'}</p>
                            </div>
                        </div>
                    `;
                    templateGrid.appendChild(templateElement);
                });
            } else {
                templateGrid.innerHTML = '<p class="col-span-full text-center text-gray-500 text-lg py-10">No templates found.</p>';
            }
        }

        fetchTemplates();

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuOverlay = document.getElementById('menu-overlay');

        const openMenu = () => {
            mobileMenu.classList.remove('translate-x-full');
            mobileMenu.classList.add('translate-x-0');
            menuOverlay.classList.remove('invisible');
            menuOverlay.classList.remove('opacity-0');
        };

        const closeMenu = () => {
            mobileMenu.classList.add('translate-x-full');
            mobileMenu.classList.remove('translate-x-0');
            menuOverlay.classList.add('opacity-0');
            setTimeout(() => {
                menuOverlay.classList.add('invisible');
            }, 300);
        };

        hamburgerBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);
    });
    </script>
</body>
</html></html>
