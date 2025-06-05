<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/src/style.css">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>GrowTogether</title>
    </head>
    <body class="bg-gray-100 font-sans text-gray-800">
        <header class="bg-gray-300 text-black p-5 fixed m-auto top-0 w-full shadow-md z-10">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow">&lt;</a> Sign Up as Speaker</h1>
            </div>
        </header>

        <main class="container mx-auto py-8 px-4 mt-20 mb-24">
            <section class="bg-gray-200 p-6 rounded-lg shadow-md  mb-4">
                <h2 class="text-xl font-semibold mb-4 text-red-500">Become a Speaker</h2>
                <p class="text-gray-700 mb-4">Share your knowledge and inspire others by signing up as a speaker. <br> Fill out the form below to get started.</p>
            </section>
            <section class="bg-gray-200 p-6 rounded-lg shadow-md mb-4">
                <form action="?c=User&m=applyAsSpeaker" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="linkedin-url">LinkedIn Profile URL</label>
                        <input type="url" name="linkedin-url" id="linkedin-url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your LinkedIn URL">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cv">Upload CV</label>
                        <input type="file" name="cv" id="cv" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Category</label>
                        <select name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="technology">Technology</option>
                        <option value="business">Business</option>
                        <option value="health">Health</option>
                        <option value="education">Education</option>
                        <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-gray-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Sign Up
                        </button>
                    </div>
                </form>
            </section>
        </main>

        <footer  style="box-shadow: 0 -2px 1px rgba(0,0,0,0.2);" class="fixed bottom-0 w-full bg-white text-black shadow-top-md z-10 p-4">
            <nav class="flex justify-around items-center">
                <a href="?c=Todos&m=grow" class="flex flex-col items-center text-xs pt-px mt-[-12]">
                    <img src="src/image/icon-home.png" class="w-10 h-10 mb-0.5" alt="Home"> <!-- w-6 h-6 = 24px square -->
                    <span>Home</span>
                </a>
                <?php
                    $createLink = "?c=Todos&m=signUp"; // Default link for non-speakers
                    if (isset($userRole) && $userRole === 'speaker') {
                        $createLink = "?c=Todos&m=create"; // Link for speakers
                    }
                ?>
                <a href="<?= $createLink ?>" class="flex flex-col items-center text-xs">
                    <img src="/src/image/icon-create.png" class="w-10 h-10 mb-0.5" alt="Create">
                    <span>Create</span>
                </a>
                <a href="?c=Todos&m=registered" class="flex flex-col items-center text-xs">
                    <img src="src/image/icon-activities.png" class="w-10 h-10 mb-0.5" alt="Registered">
                    <span>My Activities</span>
                </a>
            </nav>
        </footer>