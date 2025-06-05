<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GrowTogether</title>
    </head>

    <body class="bg-gray-100 font-sans text-gray-800">
        <header class="bg-gray-300 text-black p-5 fixed m-auto top-0 w-full shadow-md z-10">
            <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold"><a href="?c=Todos&m=grow">&lt;</a> GrowTogether</h1>
            </div>
        </header>

        <main>
            <div class="ulasan mt-24 mb-24 mx-6 w-auto p-6 bg-white shadow-lg rounded-lg">
            <div class="user-info flex items-center space-x-4 mb-4">
                <span class="user-profile">
                <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center overflow-hidden">
                    <img src="src/image/profile.png" class="w-full h-full object-cover" alt="User Profile">
                </div>
                </span>
                <div class="user-name-topic">
                <span class="user-name font-semibold">Joe</span><br>
                </div>
            </div>

            <form action="?c=Todos&m=grow" method="post" class="create-ulasan">
                <label for="description" class="ulasan-title text-xl font-bold label-center mr-auto">Ulasan:</label>
                <textarea id="description" name="description" rows="4" cols="50" class="create-input w-full border border-gray-500 p-6 m-2 rounded-lg" placeholder="..."></textarea><br>

                <label class="rating-title text-xl font-bold label-center mr-auto">Rating:</label><br>
                <div class="flex items-center space-x-1 m-2">
                <button type="button" class="star text-gray-400 text-3xl focus:outline-none" data-value="1">&#9733;</button>
                <button type="button" class="star text-gray-400 text-3xl focus:outline-none" data-value="2">&#9733;</button>
                <button type="button" class="star text-gray-400 text-3xl focus:outline-none" data-value="3">&#9733;</button>
                <button type="button" class="star text-gray-400 text-3xl focus:outline-none" data-value="4">&#9733;</button>
                <button type="button" class="star text-gray-400 text-3xl focus:outline-none" data-value="5">&#9733;</button>
                </div>

                <input type="hidden" id="rating" name="rating" value="0">

                <button type="submit" class="submit-ulasan bg-gray-600 text-white px-4 py-2 rounded-lg">Submit</button>
            </form>
            </div>
        </main>

            <script>
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
            star.addEventListener('click', () => {
                const ratingValue = parseInt(star.getAttribute('data-value'));
                
                stars.forEach(s => {
                if (parseInt(s.getAttribute('data-value')) <= ratingValue) {
                    s.classList.remove('text-gray-400');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-400');
                }
                });

                ratingInput.value = ratingValue;
            });
            });
            </script>
    </body>
</html>
