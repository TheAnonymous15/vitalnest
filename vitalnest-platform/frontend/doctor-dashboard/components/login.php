<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalNest - Doctor Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vital-black': '#1A1A1A',
                        'vital-dark': '#0D0D0D',
                        'vital-orange': '#F97316',
                        'vital-orange-light': '#FB923C',
                        'vital-orange-dark': '#EA580C',
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                        'teal-accent': '#14B8A6',
                        'warm-orange': '#FDBA74',
                        'soft-amber': '#FCD34D',
                        'cream': '#FFFBEB',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0F766E 0%, #134E4A 50%, #0F766E 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Login Container -->
    <div class="w-full max-w-md">

        <!-- Logo & Branding -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl mb-4 shadow-2xl">
                <i class="fas fa-user-md text-vital-teal text-3xl"></i>
            </div>
            <h1 class="text-4xl font-black text-white mb-2">VitalNest</h1>
            <p class="text-white/90 font-medium">Doctor Portal</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-3xl p-8 shadow-2xl">

            <!-- Alert Messages -->
            <div id="alert" class="hidden mb-6 p-4 rounded-xl"></div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-6">

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-vital-teal"></i>Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="doctor@vitalnest.com"
                        required
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vital-teal focus:border-transparent transition-all"
                        placeholder="Enter your email"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-vital-teal"></i>Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            value="Doctor@123"
                            required
                            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vital-teal focus:border-transparent transition-all pr-12"
                            placeholder="Enter your password"
                        >
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-vital-teal transition-colors"
                        >
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="remember" class="w-4 h-4 rounded border-gray-300 text-vital-teal focus:ring-vital-teal">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-vital-teal hover:text-deep-teal transition-colors font-medium">Forgot password?</a>
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    id="loginBtn"
                    class="w-full py-4 bg-gradient-to-r from-vital-teal to-teal-accent hover:from-deep-teal hover:to-vital-teal text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>

            </form>

            <!-- Footer Links -->
            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Need help? <a href="#" class="text-vital-teal hover:text-deep-teal transition-colors font-medium">Contact Support</a>
                </p>
            </div>

        </div>

        <!-- Version Info -->
        <div class="text-center mt-6">
            <p class="text-xs text-white/70">VitalNest Platform v1.0.0</p>
        </div>

    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Show alert message
        function showAlert(message, type = 'error') {
            const alert = document.getElementById('alert');
            alert.className = `mb-6 p-4 rounded-xl flex items-center gap-3 ${
                type === 'error' ? 'bg-red-50 border-2 border-red-200 text-red-700' :
                'bg-green-50 border-2 border-green-200 text-green-700'
            }`;
            alert.innerHTML = `
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'}"></i>
                <span class="font-medium">${message}</span>
            `;
            alert.classList.remove('hidden');

            if (type === 'success') {
                setTimeout(() => alert.classList.add('hidden'), 3000);
            }
        }

        // Handle form submission
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const loginBtn = document.getElementById('loginBtn');
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Signing in...';

            try {
                const response = await fetch('http://localhost:9099/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value
                    })
                });

                const data = await response.json();

                if (data.success && (data.data.user.role === 'doctor' || data.data.user.role === 'clinician')) {
                    localStorage.setItem('auth_token', data.data.token);
                    localStorage.setItem('token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    document.cookie = `token=${data.data.token}; path=/; max-age=86400`;

                    showAlert('Login successful! Redirecting...', 'success');

                    // Redirect to root (clean URL)
                    setTimeout(() => {
                        window.location.href = '../';
                    }, 1000);
                } else {
                    showAlert(data.message || 'Invalid credentials');
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> Sign In';
                }
            } catch (error) {
                console.error('Login error:', error);
                showAlert('Connection error. Make sure the Identity Service is running on port 9099.');
                loginBtn.disabled = false;
                loginBtn.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> Sign In';
            }
        });

        // Check if already logged in
        if (localStorage.getItem('auth_token')) {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.role === 'doctor' || user.role === 'clinician') {
                window.location.href = '../';
            }
        }
    </script>

</body>
</html>
