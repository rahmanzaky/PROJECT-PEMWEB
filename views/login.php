<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GrowHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm mx-auto">
        <div class="flex flex-col items-center mb-6">
            <div class="border-2 border-amber-500 py-2 px-4 mb-2">
                <h1 class="text-3xl font-bold text-amber-600">Login</h1>
            </div>
            <p class="text-gray-600 text-sm">Login ke dalam akun Anda</p>
        </div>

        <form action="index.php?c=Auth&m=handleLogin" method="POST" class="space-y-5">
            <div>
                <label for="username" class="block text-amber-600 text-sm font-semibold mb-1">Username</label>
                <input type="text" id="username" name="user_name" placeholder="Masukkan username" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800" />
            </div>

            <div>
                <label for="password" class="block text-amber-600 text-sm font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required
                    class="w-full p-3 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-gray-800" />
            </div>

            <div class="text-right text-sm">
                <a href="#" class="text-amber-600 hover:underline">Lupa Password?</a>
            </div>

            <button type="submit"
                class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md">Login</button>
            
            <?php if (!empty($error)): ?>
                <p class="text-red-600 text-sm text-center mt-2"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Belum mempunyai akun? <a href="#" class="text-amber-600 font-semibold hover:underline">Register</a></p>
        </div>
    </div>
</body>
</html>