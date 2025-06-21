<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GrowTogether</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/style.css">
</head>
<body class="bg-orange-50 font-sans flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-sm mx-auto">
        <div class="flex flex-col items-center mb-6 text-center">
            <h1 class="text-3xl font-bold text-amber-600">Welcome!</h1>
            <p class="text-gray-500 text-sm mt-1">Please log in or continue as a guest.</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 text-sm" role="alert">
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form action="index.php?c=Auth&m=handleLogin" method="POST" class="space-y-5">
            <div>
                <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" id="user_name" name="user_name" placeholder="Enter your username" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800 transition duration-150" />
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800 transition duration-150" />
            </div>
            
            <div class="text-right text-sm">
                <a href="index.php?c=GrowTogether&m=grow" class="font-medium text-amber-600 hover:text-amber-800 transition-colors duration-150">
                    Continue as Guest &rarr;
                </a>
            </div>
            <button type="submit"
                class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md transform hover:scale-105">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center text-sm">
            <p class="text-gray-600">Don't have an account yet? 
                <a href="index.php?c=Auth&m=register" class="text-amber-600 font-semibold hover:underline">Register now</a>
            </p>
        </div>
    </div>
</body>
</html>