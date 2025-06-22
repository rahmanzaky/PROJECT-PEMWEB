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

        <form id="login-form" method="POST" class="space-y-5">
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
            <button type="submit" id="login-button" class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md transform hover:scale-105">Login</button>
        </form>

        <div class="relative flex py-4 items-center">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="flex-shrink mx-4 text-gray-400 text-sm">Or</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <a href="/views/home.php" id="guest-button" class="block w-full text-center bg-gray-200 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-300 transition duration-200 shadow-md transform hover:scale-105">
            Continue as Guest
        </a>

        <div id="response-message" class="hidden text-sm p-3 rounded-lg mb-4 text-center"></div>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Don't have an account yet? <a href="/views/register.php" class="text-amber-600 font-semibold hover:underline">Register now</a></p>
        </div>
    </div>

    <script>
    document.getElementById('login-form').addEventListener('submit', async function(event) {
        event.preventDefault();
        const messageDiv = document.getElementById('response-message');
        const submitButton = document.getElementById('login-button');
        submitButton.disabled = true;
        submitButton.textContent = 'Processing...';
        messageDiv.className = 'hidden text-sm p-3 rounded-lg mb-4 text-center';
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        try {
            const response = await fetch('http://localhost:8080/auth/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (response.ok && result.token) {
                localStorage.setItem('jwt_token', result.token);
                if (result.user) {
                    localStorage.setItem('current_user', JSON.stringify(result.user));
                }
                messageDiv.textContent = result.message || 'Login successful! Redirecting...';
                messageDiv.classList.add('bg-green-100', 'text-green-700');
                messageDiv.classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = '/views/home.php';
                }, 1500);
            } else {
                messageDiv.textContent = result.message || 'Login failed.';
                messageDiv.classList.add('bg-red-100', 'text-red-700');
                messageDiv.classList.remove('hidden');
                submitButton.disabled = false;
                submitButton.textContent = 'Login';
            }
        } catch (error) {
            messageDiv.textContent = 'An error occurred. Please make sure the API server is running.';
            messageDiv.classList.add('bg-red-100', 'text-red-700');
            messageDiv.classList.remove('hidden');
            submitButton.disabled = false;
            submitButton.textContent = 'Login';
            console.error('Login Error:', error);
        }
    });

    document.getElementById('guest-button').addEventListener('click', function(event) {
        localStorage.removeItem('current_user');
        localStorage.removeItem('jwt_token');
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Clear any previous session info when visiting the login page
        localStorage.removeItem('current_user');
        localStorage.removeItem('jwt_token');
        const user = JSON.parse(localStorage.getItem('current_user') || 'null');
        if (user) {
            const userNameEls = document.querySelectorAll('.user-name, #currentUserName');
            userNameEls.forEach(el => el.textContent = user.user_name || 'Guest');
            const userRoleEls = document.querySelectorAll('.user-role, #userRole');
            userRoleEls.forEach(el => el.textContent = user.role || 'user');
        }
    });
    </script>
</body>
</html>