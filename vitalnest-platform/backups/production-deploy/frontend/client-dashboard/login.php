<?php
// Check if already logged in
$token = $_COOKIE['client_token'] ?? '';
if (!empty($token)) {
    header('Location: ../');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalNest - Client Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        .tab-active {
            border-bottom: 2px solid #06b6d4;
            color: #06b6d4;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <!-- Logo floating particles background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-10">
        <div class="absolute top-20 left-20 w-64 h-64 bg-cyan-500 rounded-full filter blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-64 h-64 bg-orange-500 rounded-full filter blur-[100px] animate-pulse" style="animation-delay: 1s"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="../resources/logo.jpeg" alt="VitalNest" class="w-24 h-24 mx-auto rounded-2xl shadow-2xl shadow-cyan-500/50 mb-4">
            <h1 class="text-3xl font-bold text-white mb-2">VitalNest</h1>
            <p class="text-white/60">Client Portal Access</p>
        </div>

        <!-- Auth Card -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl overflow-hidden">

            <!-- Login Form -->
            <div class="p-8">
                <form onsubmit="handleLogin(event)">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Email</label>
                            <input type="email" id="login-email" required
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Password</label>
                            <input type="password" id="login-password" required
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                        </div>
                        <button type="submit" id="login-btn"
                                class="w-full py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-lg hover:opacity-90 transition">
                            Login
                        </button>

                        <div class="flex items-center justify-between text-sm mt-4">
                            <button type="button" onclick="openRegisterModal()" class="text-cyan-400 hover:text-cyan-300">
                                Create Account
                            </button>
                            <button type="button" onclick="openResetModal()" class="text-white/60 hover:text-white">
                                Forgot Password?
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-white/40 text-sm mt-6">
            &copy; 2026 VitalNest. All rights reserved.
        </p>
    </div>

    <!-- Register Modal -->
    <div id="register-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>
        <div class="relative bg-slate-800 rounded-2xl border border-white/10 shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeRegisterModal()" class="absolute top-4 right-4 w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition z-10">
                <i class="fas fa-times text-white/60"></i>
            </button>

            <!-- Register Form -->
            <div class="p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Create Account</h2>
                <form onsubmit="handleRegister(event)">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-white/60 text-sm mb-2">First Name</label>
                                <input type="text" id="register-firstname" required
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                            <div>
                                <label class="block text-white/60 text-sm mb-2">Last Name</label>
                                <input type="text" id="register-lastname" required
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Email</label>
                            <input type="email" id="register-email" required
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Phone (Optional)</label>
                            <input type="tel" id="register-phone"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Password</label>
                            <input type="password" id="register-password" required minlength="6"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            <p class="text-white/40 text-xs mt-1">Minimum 6 characters</p>
                        </div>
                        <div>
                            <label class="block text-white/60 text-sm mb-2">Confirm Password</label>
                            <input type="password" id="register-password-confirm" required minlength="6"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                        </div>
                        <button type="submit" id="register-btn"
                                class="w-full py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-lg hover:opacity-90 transition">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div id="reset-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md"></div>
        <div class="relative bg-slate-800 rounded-2xl border border-white/10 shadow-2xl w-full max-w-md">
            <!-- Close Button -->
            <button onclick="closeResetModal()" class="absolute top-4 right-4 w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition z-10">
                <i class="fas fa-times text-white/60"></i>
            </button>

            <!-- Reset Password Form -->
            <div class="p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Reset Password</h2>
                <div id="reset-step-1">
                    <form onsubmit="handleResetRequest(event)">
                        <div class="space-y-4">
                            <p class="text-white/60 text-sm mb-4">Enter your email to receive password reset instructions</p>
                            <div>
                                <label class="block text-white/60 text-sm mb-2">Email</label>
                                <input type="email" id="reset-email" required
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                            <button type="submit" id="reset-request-btn"
                                    class="w-full py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-lg hover:opacity-90 transition">
                                Send Reset Link
                            </button>
                        </div>
                    </form>
                </div>

                <div id="reset-step-2" class="hidden">
                    <form onsubmit="handleResetPassword(event)">
                        <div class="space-y-4">
                            <p class="text-white/60 text-sm mb-4">Enter your reset code and new password</p>
                            <div>
                                <label class="block text-white/60 text-sm mb-2">Reset Code</label>
                                <input type="text" id="reset-token" required
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                            <div>
                                <label class="block text-white/60 text-sm mb-2">New Password</label>
                                <input type="password" id="reset-new-password" required minlength="6"
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                            <div>
                                <label class="block text-white/60 text-sm mb-2">Confirm New Password</label>
                                <input type="password" id="reset-new-password-confirm" required minlength="6"
                                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/30 focus:outline-none focus:border-cyan-500">
                            </div>
                            <button type="submit" id="reset-password-btn"
                                    class="w-full py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-lg hover:opacity-90 transition">
                                Reset Password
                            </button>
                            <button type="button" onclick="showResetStep1()" class="w-full py-2 text-white/60 text-sm hover:text-white">
                                Back to email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alert-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60" onclick="closeAlert()"></div>
        <div class="relative bg-slate-800 rounded-2xl p-6 max-w-sm w-full border border-white/10">
            <div id="alert-icon" class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center"></div>
            <h3 id="alert-title" class="text-white font-bold text-center mb-2"></h3>
            <p id="alert-message" class="text-white/60 text-center text-sm mb-4"></p>
            <button onclick="closeAlert()" class="w-full py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded-lg">
                OK
            </button>
        </div>
    </div>

    <script>
        // Modal Functions
        function openRegisterModal() {
            document.getElementById('register-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeRegisterModal() {
            document.getElementById('register-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openResetModal() {
            document.getElementById('reset-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeResetModal() {
            document.getElementById('reset-modal').classList.add('hidden');
            document.getElementById('reset-step-1').classList.remove('hidden');
            document.getElementById('reset-step-2').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Show alert
        function showAlert(title, message, type = 'info') {
            const modal = document.getElementById('alert-modal');
            const icon = document.getElementById('alert-icon');
            const titleEl = document.getElementById('alert-title');
            const messageEl = document.getElementById('alert-message');

            if (type === 'success') {
                icon.className = 'w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center bg-green-500/20 border border-green-400/30';
                icon.innerHTML = '<i class="fas fa-check text-green-400"></i>';
            } else if (type === 'error') {
                icon.className = 'w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center bg-red-500/20 border border-red-400/30';
                icon.innerHTML = '<i class="fas fa-times text-red-400"></i>';
            } else {
                icon.className = 'w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center bg-cyan-500/20 border border-cyan-400/30';
                icon.innerHTML = '<i class="fas fa-info text-cyan-400"></i>';
            }

            titleEl.textContent = title;
            messageEl.textContent = message;
            modal.classList.remove('hidden');
        }

        function closeAlert() {
            document.getElementById('alert-modal').classList.add('hidden');
        }

        // Handle Login
        async function handleLogin(e) {
            e.preventDefault();
            const btn = document.getElementById('login-btn');
            const originalText = btn.textContent;
            btn.textContent = 'Logging in...';
            btn.disabled = true;

            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            try {
                const response = await fetch('http://localhost:9099/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password, role: 'client' })
                });

                const result = await response.json();

                if (result.success) {
                    localStorage.setItem('client_token', result.token);
                    localStorage.setItem('client_user', JSON.stringify(result.user));
                    localStorage.setItem('user_id', result.user.id);
                    document.cookie = `client_token=${result.token}; path=/; max-age=86400`;

                    showAlert('Success!', 'Login successful. Redirecting...', 'success');
                    setTimeout(() => window.location.href = '../', 1500);
                } else {
                    showAlert('Login Failed', result.message || 'Invalid credentials', 'error');
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
            } catch (error) {
                showAlert('Error', 'Connection failed. Please try again.', 'error');
                btn.textContent = originalText;
                btn.disabled = false;
            }
        }

        // Handle Registration
        async function handleRegister(e) {
            e.preventDefault();
            const btn = document.getElementById('register-btn');
            const originalText = btn.textContent;

            const firstName = document.getElementById('register-firstname').value;
            const lastName = document.getElementById('register-lastname').value;
            const email = document.getElementById('register-email').value;
            const phone = document.getElementById('register-phone').value;
            const password = document.getElementById('register-password').value;
            const passwordConfirm = document.getElementById('register-password-confirm').value;

            if (password !== passwordConfirm) {
                showAlert('Error', 'Passwords do not match', 'error');
                return;
            }

            btn.textContent = 'Creating Account...';
            btn.disabled = true;

            try {
                const response = await fetch('http://localhost:9099/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        email,
                        password,
                        first_name: firstName,
                        last_name: lastName,
                        phone
                    })
                });

                const result = await response.json();

                if (result.success) {
                    closeRegisterModal();
                    showAlert('Success!', result.message + ' You can now login.', 'success');
                } else {
                    showAlert('Registration Failed', result.message, 'error');
                }
            } catch (error) {
                showAlert('Error', 'Connection failed. Please try again.', 'error');
            }

            btn.textContent = originalText;
            btn.disabled = false;
        }

        // Handle Reset Request
        async function handleResetRequest(e) {
            e.preventDefault();
            const btn = document.getElementById('reset-request-btn');
            const originalText = btn.textContent;
            const email = document.getElementById('reset-email').value;

            btn.textContent = 'Sending...';
            btn.disabled = true;

            try {
                const response = await fetch('http://localhost:9099/request-reset', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email })
                });

                const result = await response.json();

                if (result.success) {
                    showAlert('Email Sent', result.message + (result.dev_token ? `\n\nDev Token: ${result.dev_token}` : ''), 'success');
                    setTimeout(() => {
                        document.getElementById('reset-step-1').classList.add('hidden');
                        document.getElementById('reset-step-2').classList.remove('hidden');
                        if (result.dev_token) {
                            document.getElementById('reset-token').value = result.dev_token;
                        }
                    }, 2000);
                } else {
                    showAlert('Error', result.message, 'error');
                }
            } catch (error) {
                showAlert('Error', 'Connection failed. Please try again.', 'error');
            }

            btn.textContent = originalText;
            btn.disabled = false;
        }

        // Handle Reset Password
        async function handleResetPassword(e) {
            e.preventDefault();
            const btn = document.getElementById('reset-password-btn');
            const originalText = btn.textContent;

            const token = document.getElementById('reset-token').value;
            const newPassword = document.getElementById('reset-new-password').value;
            const newPasswordConfirm = document.getElementById('reset-new-password-confirm').value;

            if (newPassword !== newPasswordConfirm) {
                showAlert('Error', 'Passwords do not match', 'error');
                return;
            }

            btn.textContent = 'Resetting...';
            btn.disabled = true;

            try {
                const response = await fetch('http://localhost:9099/reset-password', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ token, new_password: newPassword })
                });

                const result = await response.json();

                if (result.success) {
                    closeResetModal();
                    showAlert('Success!', result.message, 'success');
                } else {
                    showAlert('Error', result.message, 'error');
                }
            } catch (error) {
                showAlert('Error', 'Connection failed. Please try again.', 'error');
            }

            btn.textContent = originalText;
            btn.disabled = false;
        }

        function showResetStep1() {
            document.getElementById('reset-step-1').classList.remove('hidden');
            document.getElementById('reset-step-2').classList.add('hidden');
        }
    </script>
</body>
</html>

