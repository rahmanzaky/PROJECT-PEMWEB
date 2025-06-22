<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Account | GrowTogether</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 font-sans flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md mx-auto">
        <div class="flex flex-col items-center mb-6 text-center">
            <h1 class="text-3xl font-bold text-amber-600">Create Your Account</h1>
            <p class="text-gray-500 text-sm mt-1">Join the GrowLink community today!</p>
        </div>

        <div id="response-message" class="hidden text-sm p-3 rounded-lg mb-4 text-center"></div>

        <form id="register-form" method="POST" class="space-y-5">
            <div>
                <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" id="user_name" name="user_name" placeholder="Choose a username" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a strong password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <button type="submit" id="submit-button"
                class="w-full bg-amber-600 text-white font-bold py-3 rounded-lg hover:bg-amber-700 transition duration-200 shadow-md transform hover:scale-105">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center text-sm">
            <p class="text-gray-600">Already have an account? 
                <a href="/views/login.php" class="text-amber-600 font-semibold hover:underline">Login here</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', async function(event) {
            event.preventDefault();
            const messageDiv = document.getElementById('response-message');
            const submitButton = document.getElementById('submit-button');
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';
            messageDiv.className = 'hidden text-sm p-3 rounded-lg mb-4 text-center';
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            try {
                const response = await fetch('http://localhost:8080/auth/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (response.ok) {
                    messageDiv.textContent = result.message + " Redirecting to login...";
                    messageDiv.classList.add('bg-green-100', 'text-green-700');
                    messageDiv.classList.remove('hidden');
                    setTimeout(() => {
                        window.location.href = '/views/login.php';
                    }, 2000);
                } else {
                    messageDiv.textContent = result.message || 'Registration failed.';
                    messageDiv.classList.add('bg-red-100', 'text-red-700');
                    messageDiv.classList.remove('hidden');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Create Account';
                }
            } catch (error) {
                messageDiv.textContent = 'An error occurred. Please make sure the API server is running.';
                messageDiv.classList.add('bg-red-100', 'text-red-700');
                messageDiv.classList.remove('hidden');
                submitButton.disabled = false;
                submitButton.textContent = 'Create Account';
                console.error('Registration Error:', error);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
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