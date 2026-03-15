<?php
/**
 * VitalNest - Unified Medical Login Template (New Version)
 * Clean, professional medical theme with 3D effects
 * Used by all dashboard login pages
 * Includes OTP verification for unverified emails
 */

function renderLoginPage($role, $title, $icon = 'fa-user-shield') {
    $roleColors = [
        'admin' => ['primary' => '#0F766E', 'accent' => '#14B8A6', 'gradient' => 'from-teal-600 to-teal-800'],
        'doctor' => ['primary' => '#0F766E', 'accent' => '#14B8A6', 'gradient' => 'from-teal-600 to-teal-800'],
        'clinician' => ['primary' => '#0F766E', 'accent' => '#14B8A6', 'gradient' => 'from-teal-600 to-teal-800'],
        'nurse' => ['primary' => '#0F766E', 'accent' => '#14B8A6', 'gradient' => 'from-teal-600 to-teal-800'],
        'lab' => ['primary' => '#7C3AED', 'accent' => '#A78BFA', 'gradient' => 'from-violet-600 to-violet-800'],
        'pharmacy' => ['primary' => '#059669', 'accent' => '#34D399', 'gradient' => 'from-emerald-600 to-emerald-800'],
        'patient' => ['primary' => '#F97316', 'accent' => '#FB923C', 'gradient' => 'from-orange-500 to-orange-700'],
        'client' => ['primary' => '#F97316', 'accent' => '#FB923C', 'gradient' => 'from-orange-500 to-orange-700'],
        'caregiver' => ['primary' => '#EC4899', 'accent' => '#F472B6', 'gradient' => 'from-pink-500 to-pink-700'],
        'hr' => ['primary' => '#6366F1', 'accent' => '#818CF8', 'gradient' => 'from-indigo-600 to-indigo-800'],
        'receptionist' => ['primary' => '#0EA5E9', 'accent' => '#38BDF8', 'gradient' => 'from-sky-500 to-sky-700'],
        'triage' => ['primary' => '#EF4444', 'accent' => '#F87171', 'gradient' => 'from-red-500 to-red-700'],
    ];

    $colors = $roleColors[$role] ?? $roleColors['admin'];
    $cookieName = $role . '_token';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalNest - <?php echo htmlspecialchars($title); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0f1a 0%, #111827 50%, #0a0f1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }

        /* Subtle grid background */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Floating orb */
        .orb {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            background: <?php echo $colors['primary']; ?>;
            top: -100px;
            right: -100px;
            animation: orbFloat 6s ease-in-out infinite;
        }
        @keyframes orbFloat {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30px, 30px); }
        }

        /* 3D Card */
        .login-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.6),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transform: rotateX(2deg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-card:hover {
            transform: rotateX(0deg) translateY(-4px);
            box-shadow:
                0 35px 60px -15px rgba(0, 0, 0, 0.7),
                0 0 0 1px rgba(255, 255, 255, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        /* Icon container 3D */
        .icon-3d {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, <?php echo $colors['primary']; ?>, <?php echo $colors['accent']; ?>);
            box-shadow:
                0 10px 30px <?php echo $colors['primary']; ?>66,
                inset 0 2px 0 rgba(255,255,255,0.2),
                inset 0 -2px 0 rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateZ(20px);
        }

        /* Input 3D */
        .input-3d {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            padding: 10px 14px;
            color: white;
            font-size: 14px;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3);
        }
        .input-3d:focus {
            outline: none;
            border-color: <?php echo $colors['primary']; ?>;
            box-shadow:
                inset 0 2px 4px rgba(0,0,0,0.3),
                0 0 0 3px <?php echo $colors['primary']; ?>22;
        }
        .input-3d::placeholder { color: #64748b; }

        /* Button 3D */
        .btn-3d {
            background: linear-gradient(135deg, <?php echo $colors['primary']; ?>, <?php echo $colors['accent']; ?>);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            box-shadow:
                0 4px 15px <?php echo $colors['primary']; ?>44,
                inset 0 1px 0 rgba(255,255,255,0.2),
                inset 0 -2px 0 rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        }
        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px <?php echo $colors['primary']; ?>55,
                inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .btn-3d:active { transform: translateY(0); }
        .btn-3d:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Heartbeat line animation */
        .heartbeat-line {
            stroke-dasharray: 300;
            stroke-dashoffset: 300;
            animation: heartbeat-draw 2.5s ease-in-out infinite;
        }
        @keyframes heartbeat-draw {
            0%, 100% { stroke-dashoffset: 300; }
            50% { stroke-dashoffset: 0; }
        }

        /* OTP Input Styles */
        .otp-input {
            width: 42px;
            height: 52px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            transition: all 0.2s ease;
        }
        .otp-input:focus {
            outline: none;
            border-color: <?php echo $colors['primary']; ?>;
            box-shadow: 0 0 0 3px <?php echo $colors['primary']; ?>33;
        }

        /* Modal backdrop */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal-backdrop.hidden { display: none; }

        /* Alert styles */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #f87171;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.5);
            color: #34d399;
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>
    <div class="orb"></div>

    <div class="login-card p-6 w-full max-w-sm relative z-10">
        <!-- Header -->
        <div class="text-center mb-5">
            <div class="icon-3d mx-auto mb-3">
                <i class="fas <?php echo $icon; ?> text-xl text-white"></i>
            </div>
            <h1 class="text-lg font-bold text-white"><?php echo htmlspecialchars($title); ?></h1>
            <?php
            $subtitles = [
                'patient' => 'Access your health records & care',
                'client' => 'Access your health records & care',
                'admin' => 'System administration & management',
                'doctor' => 'Patient care & consultations',
                'clinician' => 'Clinical services & patient care',
                'nurse' => 'Nursing care & patient support',
                'lab' => 'Laboratory results & testing',
                'pharmacy' => 'Medication & prescriptions',
                'caregiver' => 'Home care & patient assistance',
                'hr' => 'Staff management & HR services',
                'receptionist' => 'Appointments & front desk',
                'triage' => 'Emergency assessment & priority',
            ];
            $subtitle = $subtitles[$role] ?? 'Sign in to access your dashboard';
            ?>
            <p class="text-slate-400 text-xs mt-1"><?php echo $subtitle; ?></p>

            <!-- Heartbeat Line SVG -->
            <svg class="w-40 h-6 mx-auto mt-3" viewBox="0 0 160 24">
                <path class="heartbeat-line"
                      d="M0,12 L30,12 L40,4 L50,20 L60,8 L70,16 L80,12 L160,12"
                      fill="none"
                      stroke="<?php echo $colors['primary']; ?>"
                      stroke-width="2"
                      stroke-linecap="round"/>
            </svg>
        </div>

        <!-- Alert -->
        <div id="alert" class="hidden"></div>

        <!-- Form -->
        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-slate-300 text-xs font-medium mb-1.5">Email</label>
                <input type="email" id="email" required class="input-3d" placeholder="you@example.com">
            </div>

            <div>
                <label class="block text-slate-300 text-xs font-medium mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" id="password" required class="input-3d pr-10" placeholder="••••••••">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white text-sm">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center text-slate-400 cursor-pointer">
                    <input type="checkbox" class="w-3.5 h-3.5 rounded border-slate-600 bg-slate-700 mr-1.5">
                    Remember me
                </label>
                <a href="#" class="text-slate-400 hover:text-white">Forgot password?</a>
            </div>

            <button type="submit" id="submitBtn" class="btn-3d w-full">
                <span id="btnText"><i class="fas fa-sign-in-alt mr-2"></i>Sign In</span>
                <span id="btnLoading" class="hidden"><i class="fas fa-circle-notch fa-spin mr-2"></i>Signing in...</span>
            </button>
        </form>

        <?php if ($role === 'patient' || $role === 'client'): ?>
        <p class="text-center text-slate-400 text-xs mt-4">
            New to our platform? <button type="button" onclick="showRegisterModal()" class="text-[<?php echo $colors['accent']; ?>] hover:underline font-medium">Register here</button>
        </p>
        <?php endif; ?>

        <div class="mt-4 pt-4 border-t border-slate-700/50 text-center">
            <p class="text-slate-500 text-[10px]"><i class="fas fa-shield-halved mr-1"></i>Secured by VitalNest Healthcare</p>
        </div>
    </div>

    <?php if ($role === 'patient' || $role === 'client'): ?>
    <!-- Registration Modal -->
    <div id="registerModal" class="modal-backdrop hidden">
        <div class="login-card p-6 w-full max-w-sm relative">
            <button type="button" onclick="hideRegisterModal()" class="absolute top-3 right-3 text-slate-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>

            <div class="text-center mb-4">
                <div class="icon-3d mx-auto mb-3" style="width:48px;height:48px;border-radius:12px;">
                    <i class="fas fa-user-plus text-lg text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-white">Create Account</h2>
                <p class="text-slate-400 text-xs mt-1">Join VitalNest for quality healthcare</p>
            </div>

            <div id="registerAlert" class="hidden"></div>

            <form id="registerForm" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-slate-300 text-xs font-medium mb-1">First Name</label>
                        <input type="text" id="regFirstName" required class="input-3d" placeholder="John">
                    </div>
                    <div>
                        <label class="block text-slate-300 text-xs font-medium mb-1">Last Name</label>
                        <input type="text" id="regLastName" required class="input-3d" placeholder="Doe">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-300 text-xs font-medium mb-1">Email</label>
                    <input type="email" id="regEmail" required class="input-3d" placeholder="john@example.com">
                </div>

                <div>
                    <label class="block text-slate-300 text-xs font-medium mb-1">Phone</label>
                    <input type="tel" id="regPhone" required class="input-3d" placeholder="+254 7XX XXX XXX">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-slate-300 text-xs font-medium mb-1">Password</label>
                        <input type="password" id="regPassword" required minlength="8" class="input-3d" placeholder="Min 8 chars">
                    </div>
                    <div>
                        <label class="block text-slate-300 text-xs font-medium mb-1">Confirm</label>
                        <input type="password" id="regConfirmPassword" required class="input-3d" placeholder="Confirm">
                    </div>
                </div>

                <div class="flex items-start gap-2">
                    <input type="checkbox" id="regTerms" required class="w-3.5 h-3.5 mt-0.5 rounded border-slate-600 bg-slate-700">
                    <label for="regTerms" class="text-slate-400 text-xs leading-tight">
                        I agree to the <a href="/terms-of-service" class="text-[<?php echo $colors['accent']; ?>] hover:underline">Terms</a> & <a href="/privacy-policy" class="text-[<?php echo $colors['accent']; ?>] hover:underline">Privacy</a>
                    </label>
                </div>

                <button type="submit" id="registerBtn" class="btn-3d w-full">
                    <span id="regBtnText"><i class="fas fa-user-plus mr-2"></i>Create Account</span>
                    <span id="regBtnLoading" class="hidden"><i class="fas fa-circle-notch fa-spin mr-2"></i>Creating...</span>
                </button>
            </form>

            <p class="text-center text-slate-400 text-xs mt-3">
                Have an account? <button type="button" onclick="hideRegisterModal()" class="text-[<?php echo $colors['accent']; ?>] hover:underline font-medium">Sign In</button>
            </p>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div id="otpModal" class="modal-backdrop hidden">
        <div class="login-card p-6 w-full max-w-sm relative">
            <button type="button" onclick="hideOtpModal()" class="absolute top-3 right-3 text-slate-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>

            <div class="text-center mb-4">
                <div class="icon-3d mx-auto mb-3" style="width:48px;height:48px;border-radius:12px;">
                    <i class="fas fa-envelope-open-text text-lg text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-white">Verify Your Email</h2>
                <p class="text-slate-400 text-xs mt-1">Enter the 8-digit OTP sent to your email</p>
                <p id="otpEmailDisplay" class="text-[<?php echo $colors['accent']; ?>] text-sm font-medium mt-2"></p>
            </div>

            <div id="otpAlert" class="hidden"></div>

            <form id="otpForm" class="space-y-4">
                <div class="flex justify-center gap-1.5">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="0" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="1" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="2" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="3" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="4" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="5" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="6" autocomplete="off">
                    <input type="text" maxlength="1" class="otp-input" data-otp-index="7" autocomplete="off">
                </div>

                <button type="submit" id="verifyOtpBtn" class="btn-3d w-full">
                    <span id="otpBtnText"><i class="fas fa-check-circle mr-2"></i>Verify OTP</span>
                    <span id="otpBtnLoading" class="hidden"><i class="fas fa-circle-notch fa-spin mr-2"></i>Verifying...</span>
                </button>
            </form>

            <p class="text-center text-slate-400 text-xs mt-4">
                Didn't receive the code?
                <button type="button" onclick="resendOtp()" id="resendOtpBtn" class="text-[<?php echo $colors['accent']; ?>] hover:underline font-medium">Resend OTP</button>
            </p>
        </div>
    </div>
    <?php endif; ?>

    <script>
        // Store email for OTP verification
        let pendingVerificationEmail = '';

        // ===================
        // Utility Functions
        // ===================
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        function showAlert(message, type = 'error') {
            const alert = document.getElementById('alert');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i><span>${message}</span>`;
            alert.classList.remove('hidden');
            if (type === 'error') setTimeout(() => alert.classList.add('hidden'), 5000);
        }

        function hideAlert() {
            document.getElementById('alert').classList.add('hidden');
        }

        // ===================
        // Login Form Handler
        // ===================
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            hideAlert();

            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btn.disabled = true;

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            try {
                const response = await fetch(window.location.origin + '/api/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        role: '<?php echo $role; ?>'
                    })
                });

                const data = await response.json();
                console.log('Login Response:', data);

                if (data.success && data.data?.token) {
                    // Successful login
                    document.cookie = `<?php echo $cookieName; ?>=${data.data.token}; path=/; max-age=28800; SameSite=Strict`;
                    localStorage.setItem('<?php echo $cookieName; ?>', data.data.token);
                    localStorage.setItem('<?php echo $role; ?>_user', JSON.stringify(data.data.user));
                    showAlert('Success! Redirecting...', 'success');
                    // Redirect to parent directory (dashboard root, not components folder)
                    setTimeout(() => window.location.href = '../', 1000);

                } else if (data.requires_verification || data.requires_otp ||
                           (data.message && (data.message.toLowerCase().includes('verify') ||
                            data.message.toLowerCase().includes('not verified')))) {
                    // Email not verified - need OTP verification
                    <?php if ($role === 'patient' || $role === 'client'): ?>
                    pendingVerificationEmail = email;

                    // Check if OTP was already sent by the server
                    if (data.otp_sent) {
                        showAlert('Please verify your email. OTP has been sent.', 'error');
                        showOtpModal(email);
                    } else {
                        showAlert('Email not verified. Sending verification code...', 'error');
                        await sendOtp(email);
                    }
                    <?php else: ?>
                    showAlert('Email not verified. Please contact administrator.');
                    <?php endif; ?>

                    btnText.classList.remove('hidden');
                    btnLoading.classList.add('hidden');
                    btn.disabled = false;

                } else {
                    // Other errors (invalid credentials, etc.)
                    showAlert(data.message || 'Invalid credentials');
                    btnText.classList.remove('hidden');
                    btnLoading.classList.add('hidden');
                    btn.disabled = false;
                }

            } catch (error) {
                console.error('Login Error:', error);
                showAlert('Connection error. Please try again.');
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                btn.disabled = false;
            }
        });

        <?php if ($role === 'patient' || $role === 'client'): ?>
        // ===================
        // OTP Functions
        // ===================

        /**
         * Send OTP to user's email via backend API
         */
        async function sendOtp(email) {
            try {
                const response = await fetch(window.location.origin + '/api/auth/resend-otp', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email: email })
                });

                const data = await response.json();
                console.log('Send OTP Response:', data);

                // Always show the OTP modal
                showOtpModal(email);

            } catch (error) {
                console.error('Send OTP Error:', error);
                // Still show the modal - user can click resend if needed
                showOtpModal(email);
            }
        }

        /**
         * Verify OTP via backend API
         */
        async function verifyOtp(email, otp) {
            try {
                const response = await fetch(window.location.origin + '/api/auth/verify-email', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email: email, otp: otp })
                });

                const data = await response.json();
                console.log('Verify OTP Response:', data);
                return data;

            } catch (error) {
                console.error('Verify OTP Error:', error);
                return { success: false, message: 'Connection error. Please try again.' };
            }
        }

        /**
         * Show OTP verification modal
         */
        function showOtpModal(email) {
            pendingVerificationEmail = email;
            document.getElementById('otpEmailDisplay').textContent = email;
            document.getElementById('otpModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Clear any previous OTP inputs
            document.querySelectorAll('.otp-input').forEach(input => input.value = '');

            // Focus first OTP input
            const firstInput = document.querySelector('.otp-input[data-otp-index="0"]');
            if (firstInput) setTimeout(() => firstInput.focus(), 100);
        }

        /**
         * Hide OTP verification modal
         */
        function hideOtpModal() {
            document.getElementById('otpModal').classList.add('hidden');
            document.body.style.overflow = '';
            document.querySelectorAll('.otp-input').forEach(input => input.value = '');
            document.getElementById('otpAlert')?.classList.add('hidden');
        }

        /**
         * Show alert in OTP modal
         */
        function showOtpAlert(message, type = 'error') {
            const alert = document.getElementById('otpAlert');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i><span>${message}</span>`;
            alert.classList.remove('hidden');
            if (type === 'error') setTimeout(() => alert.classList.add('hidden'), 5000);
        }

        // OTP Input handling - auto focus next input
        document.querySelectorAll('.otp-input').forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (value.length === 1) {
                    const nextInput = document.querySelector(`.otp-input[data-otp-index="${index + 1}"]`);
                    if (nextInput) nextInput.focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value) {
                    const prevInput = document.querySelector(`.otp-input[data-otp-index="${index - 1}"]`);
                    if (prevInput) {
                        prevInput.focus();
                        prevInput.value = '';
                    }
                }
            });

            // Allow paste of full OTP
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/\s/g, '');
                const inputs = document.querySelectorAll('.otp-input');
                for (let i = 0; i < Math.min(pastedData.length, inputs.length); i++) {
                    inputs[i].value = pastedData[i];
                }
                const lastFilledIndex = Math.min(pastedData.length - 1, inputs.length - 1);
                if (inputs[lastFilledIndex]) inputs[lastFilledIndex].focus();
            });
        });

        // OTP Form submission
        document.getElementById('otpForm')?.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Collect OTP from inputs
            let otp = '';
            document.querySelectorAll('.otp-input').forEach(input => {
                otp += input.value;
            });

            if (otp.length < 8) {
                showOtpAlert('Please enter the complete 8-digit OTP');
                return;
            }

            const btn = document.getElementById('verifyOtpBtn');
            const btnText = document.getElementById('otpBtnText');
            const btnLoading = document.getElementById('otpBtnLoading');

            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btn.disabled = true;

            const result = await verifyOtp(pendingVerificationEmail, otp);

            if (result.success) {
                showOtpAlert('Email verified successfully!', 'success');

                // If the verification returned a token, auto-login
                if (result.data?.token) {
                    document.cookie = `<?php echo $cookieName; ?>=${result.data.token}; path=/; max-age=28800; SameSite=Strict`;
                    localStorage.setItem('<?php echo $cookieName; ?>', result.data.token);
                    if (result.data.user) {
                        localStorage.setItem('<?php echo $role; ?>_user', JSON.stringify(result.data.user));
                    }
                    // Redirect to parent directory (dashboard root, not components folder)
                    setTimeout(() => {
                        window.location.href = '../';
                    }, 1500);
                } else {
                    // No token returned - ask user to sign in
                    setTimeout(() => {
                        hideOtpModal();
                        showAlert('Email verified! Please sign in.', 'success');
                    }, 1500);
                }

            } else {
                showOtpAlert(result.message || 'Invalid OTP. Please try again.');
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                btn.disabled = false;
            }
        });

        /**
         * Resend OTP
         */
        async function resendOtp() {
            const btn = document.getElementById('resendOtpBtn');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Sending...';

            await sendOtp(pendingVerificationEmail);

            btn.textContent = originalText;
            btn.disabled = false;
            showOtpAlert('New OTP sent to your email', 'success');
        }

        // ===================
        // Registration Functions
        // ===================
        function showRegisterModal() {
            document.getElementById('registerModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideRegisterModal() {
            document.getElementById('registerModal').classList.add('hidden');
            document.body.style.overflow = '';
            document.getElementById('registerAlert')?.classList.add('hidden');
        }

        // Close modals on backdrop click
        document.getElementById('registerModal')?.addEventListener('click', function(e) {
            if (e.target === this) hideRegisterModal();
        });
        document.getElementById('otpModal')?.addEventListener('click', function(e) {
            if (e.target === this) hideOtpModal();
        });

        function showRegisterAlert(message, type = 'error') {
            const alert = document.getElementById('registerAlert');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i><span>${message}</span>`;
            alert.classList.remove('hidden');
            if (type === 'error') setTimeout(() => alert.classList.add('hidden'), 5000);
        }

        // Registration Form submission
        document.getElementById('registerForm')?.addEventListener('submit', async (e) => {
            e.preventDefault();

            const password = document.getElementById('regPassword').value;
            const confirmPassword = document.getElementById('regConfirmPassword').value;

            if (password !== confirmPassword) {
                showRegisterAlert('Passwords do not match');
                return;
            }
            if (password.length < 8) {
                showRegisterAlert('Password must be at least 8 characters');
                return;
            }

            const btn = document.getElementById('registerBtn');
            const btnText = document.getElementById('regBtnText');
            const btnLoading = document.getElementById('regBtnLoading');

            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btn.disabled = true;

            const email = document.getElementById('regEmail').value.trim();

            try {
                const response = await fetch(window.location.origin + '/api/auth/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        first_name: document.getElementById('regFirstName').value.trim(),
                        last_name: document.getElementById('regLastName').value.trim(),
                        email: email,
                        phone: document.getElementById('regPhone').value.trim(),
                        password: password,
                        role: 'patient'
                    })
                });

                const data = await response.json();
                console.log('Registration Response:', data);

                if (data.success) {
                    showRegisterAlert('Account created! Sending verification code...', 'success');

                    // Close register modal
                    setTimeout(() => {
                        hideRegisterModal();

                        // Pre-fill email in login form
                        document.getElementById('email').value = email;

                        // Show OTP modal for verification
                        pendingVerificationEmail = email;
                        showOtpModal(email);
                    }, 1000);

                } else {
                    showRegisterAlert(data.message || 'Registration failed. Please try again.');
                    btnText.classList.remove('hidden');
                    btnLoading.classList.add('hidden');
                    btn.disabled = false;
                }

            } catch (error) {
                console.error('Registration Error:', error);
                showRegisterAlert('Connection error. Please try again.');
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                btn.disabled = false;
            }
        });
        <?php endif; ?>
    </script>
</body>
</html>
<?php
}

