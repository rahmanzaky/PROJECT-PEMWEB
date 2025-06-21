<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | GrowLink</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-orange-50 font-sans flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm mx-auto">
        <div class="flex flex-col items-center mb-6">
            <div class="py-2 px-4 mb-2">
                <h1 class="text-3xl font-bold text-amber-600">Register</h1>
            </div>
            <p class="text-gray-600 text-sm">Create your GrowLink account</p>
        </div>

        <form action="index.php?c=Auth&m=handleRegister" method="POST" class="space-y-5">
            <div>
                <label for="full_name" class="block text-gray-700 text-sm font-semibold mb-1">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800 transition duration-150">
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800 transition duration-150">
            </div>

            <div>
                <label for="user_name" class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
                <input type="text" id="user_name" name="user_name" placeholder="Enter your username" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800 transition duration-150">
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 text-gray-800">
            </div>

            <button type="submit"
                class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md">
                Register
            </button>

            <?php if (!empty($error)): ?>
                <p class="text-red-600 text-sm text-center mt-2"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Already have an account? <a href="index.php?c=Auth&m=index" class="text-amber-600 font-semibold hover:underline">Login</a></p>
        </div>
    </div>
</body>
</html>
