<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalNest - Access Portal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Primary colors from brochure - MATCHING GATEWAY
                        'vital-black': '#1A1A1A',
                        'vital-dark': '#0D0D0D',
                        'vital-orange': '#F97316',
                        'vital-orange-light': '#FB923C',
                        'vital-orange-dark': '#EA580C',
                        // Teal accents
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                        'teal-accent': '#14B8A6',
                        // Supporting colors
                        'warm-orange': '#FDBA74',
                        'soft-amber': '#FCD34D',
                        'cream': '#FFFBEB',
                        // Grays
                        'gray-dark': '#262626',
                        'gray-medium': '#404040',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: linear-gradient(to bottom right, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            overflow: hidden;
            position: relative;
            height: 100vh;
        }

        /* Alien Grid Background */
        .grid-background {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(34, 211, 238, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 211, 238, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }

        /* Nebula Background */
        .nebula {
            position: fixed;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at 20% 30%, rgba(34, 211, 238, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 70%, rgba(249, 115, 22, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            filter: blur(60px);
            animation: nebulaPulse 8s ease-in-out infinite;
        }

        @keyframes nebulaPulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        /* Particle System */
        .particle {
            position: fixed;
            width: 2px;
            height: 2px;
            background: rgba(34, 211, 238, 0.8);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 15s infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translate(0, 100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), -100vh) scale(1);
                opacity: 0;
            }

        }

        /* Holographic Card */
        .holo-card {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 2px solid rgba(34, 211, 238, 0.3);
            box-shadow:
                0 0 40px rgba(34, 211, 238, 0.2),
                inset 0 0 40px rgba(34, 211, 238, 0.05),
                0 0 80px rgba(249, 115, 22, 0.1);
            position: relative;
            overflow: hidden;
        }

        .holo-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(34, 211, 238, 0.1) 50%,
                transparent 70%
            );
            animation: holoSweep 3s linear infinite;
        }

        @keyframes holoSweep {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Glitch Effect */
        .glitch {
            position: relative;
            animation: glitchMain 5s infinite;
        }

        @keyframes glitchMain {
            0%, 90%, 100% { transform: translate(0); }
            91% { transform: translate(-2px, 2px); }
            92% { transform: translate(2px, -2px); }
            93% { transform: translate(-2px, -2px); }
            94% { transform: translate(2px, 2px); }
            95% { transform: translate(0); }
        }

        /* Neon Text */
        .neon-text {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            background: linear-gradient(
                90deg,
                #22d3ee 0%,
                #06b6d4 25%,
                #F97316 50%,
                #FB923C 75%,
                #22d3ee 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: neonGlow 3s linear infinite;
            filter: drop-shadow(0 0 20px rgba(34, 211, 238, 0.5));
        }

        @keyframes neonGlow {
            0%, 100% { background-position: 0% 50%; filter: drop-shadow(0 0 20px rgba(34, 211, 238, 0.5)); }
            50% { background-position: 100% 50%; filter: drop-shadow(0 0 30px rgba(249, 115, 22, 0.7)); }
        }

        /* Cyber Input */
        .cyber-input {
            background: rgba(34, 211, 238, 0.05);
            border: 2px solid rgba(34, 211, 238, 0.3);
            color: #22d3ee;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
        }

        .cyber-input:focus {
            background: rgba(34, 211, 238, 0.1);
            border-color: #22d3ee;
            box-shadow:
                0 0 20px rgba(34, 211, 238, 0.4),
                inset 0 0 20px rgba(34, 211, 238, 0.1);
            outline: none;
        }

        .cyber-input::placeholder {
            color: rgba(34, 211, 238, 0.4);
            font-family: 'Rajdhani', sans-serif;
        }

        /* Cyber Button */
        .cyber-button {
            background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%);
            border: 2px solid #22d3ee;
            color: #000;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .cyber-button:hover {
            box-shadow:
                0 0 30px rgba(34, 211, 238, 0.6),
                inset 0 0 20px rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .cyber-button:active {
            transform: translateY(0);
        }

        /* Animated Border */
        @keyframes borderPulse {
            0%, 100% { border-color: rgba(34, 211, 238, 0.3); }
            50% { border-color: rgba(34, 211, 238, 0.8); }
        }

        .pulse-border {
            animation: borderPulse 2s ease-in-out infinite;
        }

        /* Floating Logo Container */
        .logo-container {
            width: 100px;
            height: 100px;
            position: relative;
            margin: 0 auto 20px;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Concentric Rings */
        .logo-ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid;
            animation: ringPulse 3s ease-in-out infinite;
        }

        .logo-ring:nth-child(1) {
            width: 100%;
            height: 100%;
            border-color: rgba(34, 211, 238, 0.4);
            animation-delay: 0s;
        }

        .logo-ring:nth-child(2) {
            width: 85%;
            height: 85%;
            top: 7.5%;
            left: 7.5%;
            border-color: rgba(249, 115, 22, 0.3);
            animation-delay: 0.3s;
        }

        .logo-ring:nth-child(3) {
            width: 70%;
            height: 70%;
            top: 15%;
            left: 15%;
            border-color: rgba(34, 211, 238, 0.2);
            animation-delay: 0.6s;
        }

        @keyframes ringPulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        /* Logo Image Container */
        .logo-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 65px;
            height: 65px;
            border-radius: 50%;
            z-index: 10;
            box-shadow:
                0 0 30px rgba(34, 211, 238, 0.6),
                0 0 60px rgba(249, 115, 22, 0.3),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
            border: 3px solid rgba(34, 211, 238, 0.5);
            overflow: hidden;
            animation: logoGlow 2s ease-in-out infinite;
        }

        @keyframes logoGlow {
            0%, 100% {
                box-shadow:
                    0 0 30px rgba(34, 211, 238, 0.6),
                    0 0 60px rgba(249, 115, 22, 0.3);
                border-color: rgba(34, 211, 238, 0.5);
            }
            50% {
                box-shadow:
                    0 0 40px rgba(34, 211, 238, 0.8),
                    0 0 80px rgba(249, 115, 22, 0.5);
                border-color: rgba(249, 115, 22, 0.7);
            }
        }

        .logo-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Status Indicator */
        .status-pulse {
            animation: statusPulse 2s ease-in-out infinite;
        }

        @keyframes statusPulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
                opacity: 1;
            }
            50% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
                opacity: 0.8;
            }
        }

        /* Data Stream */
        .data-stream {
            position: fixed;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: rgba(34, 211, 238, 0.3);
            white-space: nowrap;
            animation: streamFlow 10s linear infinite;
            pointer-events: none;
        }

        @keyframes streamFlow {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }

        /* Corner Decorations */
        .corner-deco {
            position: fixed;
            width: 100px;
            height: 100px;
            border: 2px solid rgba(34, 211, 238, 0.3);
            pointer-events: none;
        }

        // ...existing code...

        /* Loading Animation */
        .loading-bar {
            height: 2px;
            background: linear-gradient(90deg, transparent, #22d3ee, transparent);
            background-size: 200% 100%;
            animation: loadingSlide 1.5s ease-in-out infinite;
        }

        @keyframes loadingSlide {
            0% { background-position: -100% 0; }
            100% { background-position: 200% 0; }
        }

        /* Fade in animation */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .fade-in {
            animation: fadeInScale 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        .delay-5 { animation-delay: 0.5s; opacity: 0; }
    </style>
</head>
<body>

    <!-- Background Effects -->
    <div class="grid-background"></div>
    <div class="nebula"></div>
    
    <!-- Corner Decorations -->
    <div class="corner-deco top-left"></div>
    <div class="corner-deco top-right"></div>
    <div class="corner-deco bottom-left"></div>
    <div class="corner-deco bottom-right"></div>

    <!-- Particles Container -->
    <div id="particles"></div>

    <!-- Data Streams -->
    <div class="data-stream" style="top: 10%;">01001000 01100101 01100001 01101100 01110100 01101000 01100011 01100001 01110010 01100101</div>
    <div class="data-stream" style="top: 30%; animation-delay: 2s;">VITALNEST_SYSTEM_ONLINE_AUTH_REQUIRED</div>
    <div class="data-stream" style="top: 50%; animation-delay: 4s;">▓▓▓░░░▓▓▓░░░SECURE_CONNECTION_ESTABLISHED</div>
    <div class="data-stream" style="top: 70%; animation-delay: 6s;">█████ PATIENT_PORTAL_v2.0 █████</div>
    <div class="data-stream" style="top: 90%; animation-delay: 8s;">ENCRYPTION_LEVEL_256_AES_ACTIVE</div>

    <!-- Main Container -->
    <div class="flex items-center justify-center min-h-screen relative z-10 p-4">

        <div class="w-full max-w-md">

            <!-- Floating Logo with Rings -->
            <div class="logo-container fade-in delay-1">
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-image">
                    <img src="../resources/logo.jpeg" alt="VitalNest Logo">
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-6 fade-in delay-2">
                <h1 class="text-4xl font-black neon-text glitch mb-2">
                    VitalNest
                </h1>
                <p class="text-cyan-400 font-medium text-base tracking-widest uppercase" style="font-family: 'Orbitron', sans-serif;">
                    Nurse Portal
                </p>

                <!-- Status Indicator -->
                <div class="inline-flex items-center gap-3 mt-3 px-4 py-1.5 holo-card rounded-full">
                    <div class="relative">
                        <div class="w-2 h-2 rounded-full bg-green-500 status-pulse"></div>
                    </div>
                    <span class="text-green-400 text-xs font-semibold tracking-wider uppercase" style="font-family: 'Orbitron', sans-serif;">
                        System Online
                    </span>
                    <span class="text-cyan-400 text-xs">●</span>
                    <span class="text-cyan-400 text-xs font-mono">ID: 9099</span>
                </div>
            </div>

            <!-- Login Card -->
            <div class="holo-card rounded-2xl p-6 pulse-border fade-in delay-3">

                <!-- Alert Messages -->
                <div id="alert" class="hidden mb-4 rounded-xl overflow-hidden"></div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-4">

                    <!-- Email Field -->
                    <div class="fade-in delay-4">
                        <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="nurse@vitalnest.com"
                                required
                                class="cyber-input w-full px-4 py-3 rounded-xl focus:outline-none"
                                placeholder="ENTER_EMAIL"
                            >
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <div class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="fade-in delay-5">
                        <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-lock mr-2"></i>Security Code
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                value="patient123"
                                required
                                class="cyber-input w-full px-4 py-3 pr-12 rounded-xl focus:outline-none"
                                placeholder="ENTER_SECURITY_CODE"
                            >
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center text-cyan-400 hover:text-cyan-300 transition-colors rounded-lg"
                            >
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        id="submitBtn"
                        class="cyber-button w-full py-3 rounded-xl relative z-10 mt-6"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fas fa-unlock"></i>
                            <span>Authenticate</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </span>
                    </button>

                    <!-- Loading Bar -->
                    <div id="loadingBar" class="loading-bar hidden"></div>

                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-cyan-400/30"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-3 text-cyan-400/60 text-xs uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                            Secure Access
                        </span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-2 gap-2">
                    <a href="#" class="group flex flex-col items-center gap-1.5 p-3 holo-card rounded-xl hover:border-cyan-400 transition-all">
                        <i class="fas fa-key text-cyan-400 text-lg group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] text-cyan-400 uppercase tracking-wider font-semibold">Reset Key</span>
                    </a>
                    <a href="#" class="group flex flex-col items-center gap-1.5 p-3 holo-card rounded-xl hover:border-[#F97316] transition-all">
                        <i class="fas fa-user-plus text-[#F97316] text-lg group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] text-[#F97316] uppercase tracking-wider font-semibold">Register</span>
                    </a>
                </div>

            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-cyan-400/60 text-xs uppercase tracking-widest fade-in delay-5" style="font-family: 'Orbitron', sans-serif;">
                <p class="flex items-center justify-center gap-2">
                    <i class="fas fa-shield-halved"></i>
                    Secured by VitalNest HealthGuard
                </p>
                <p class="mt-1 text-cyan-400/40">© 2026 VitalNest Healthcare</p>
            </div>

        </div>

    </div>

    <script>
        // Create particle system
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const tx = (Math.random() - 0.5) * 200;
                particle.style.setProperty('--tx', `${tx}px`);
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 15}s`;
                particle.style.animationDuration = `${10 + Math.random() * 10}s`;

                // Random colors between teal and orange
                if (Math.random() > 0.5) {
                    particle.style.background = 'rgba(249, 115, 22, 0.8)';
                    particle.style.boxShadow = '0 0 10px rgba(249, 115, 22, 0.8)';
                }

                container.appendChild(particle);
            }
        }

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

            const styles = {
                success: 'bg-green-500/10 border-2 border-green-500/50',
                error: 'bg-red-500/10 border-2 border-red-500/50'
            };

            const icons = {
                success: 'check-circle',
                error: 'exclamation-triangle'
            };

            const textColor = type === 'success' ? 'text-green-400' : 'text-red-400';

            alert.className = `mb-6 rounded-xl overflow-hidden ${styles[type]}`;
            alert.innerHTML = `
                <div class="p-4 flex items-center gap-3 ${textColor}">
                    <div class="w-10 h-10 rounded-lg bg-${type === 'success' ? 'green' : 'red'}-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-${icons[type]} text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold uppercase tracking-wide" style="font-family: 'Orbitron', sans-serif;">${message}</span>
                    </div>
                </div>
                <div class="loading-bar"></div>
            `;
            alert.classList.remove('hidden');

            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => {
                    alert.classList.add('hidden');
                    alert.style.opacity = '1';
                    alert.style.transform = 'translateY(0)';
                }, 300);
            }, 5000);
        }

        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const loadingBar = document.getElementById('loadingBar');
            const originalHTML = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center gap-3">
                    <i class="fas fa-circle-notch fa-spin text-lg"></i>
                    <span>AUTHENTICATING</span>
                    <i class="fas fa-circle-notch fa-spin text-sm"></i>
                </span>
            `;
            submitBtn.disabled = true;
            loadingBar.classList.remove('hidden');

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('http://localhost:9099/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        role: 'nurse'
                    })
                });

                const data = await response.json();

                if (data.success && data.data.token) {
                    // Set authentication cookie
                    document.cookie = `nurse_token=${data.data.token}; path=/; max-age=28800; SameSite=Strict`;

                    // Store user data
                    localStorage.setItem('nurse_token', data.data.token);
                    // removed duplicate token storage
                    localStorage.setItem('nurse_user', JSON.stringify(data.data.user));

                    showAlert('ACCESS GRANTED • Entering Portal...', 'success');

                    // Success animation
                    submitBtn.innerHTML = `
                        <span class="relative z-10 flex items-center justify-center gap-3">
                            <i class="fas fa-check-circle text-lg"></i>
                            <span>ACCESS GRANTED</span>
                            <i class="fas fa-check-circle text-lg"></i>
                        </span>
                    `;

                    // Redirect to dashboard
                    setTimeout(() => {
                        window.location.href = '../';
                    }, 1500);
                } else {
                    showAlert('ACCESS DENIED • Invalid Credentials', 'error');
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                    loadingBar.classList.add('hidden');
                }
            } catch (error) {
                console.error('Login error:', error);
                showAlert('CONNECTION ERROR • Service Unavailable', 'error');
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
                loadingBar.classList.add('hidden');
            }
        });

        // Mouse trail effect
        document.addEventListener('mousemove', (e) => {
            const trail = document.createElement('div');
            trail.className = 'particle';
            trail.style.left = e.clientX + 'px';
            trail.style.top = e.clientY + 'px';
            trail.style.position = 'fixed';
            trail.style.width = '4px';
            trail.style.height = '4px';
            trail.style.opacity = '0.5';
            trail.style.animation = 'none';
            document.body.appendChild(trail);

            setTimeout(() => {
                trail.style.opacity = '0';
                trail.style.transform = 'scale(0)';
                trail.style.transition = 'all 0.5s ease';
            }, 100);

            setTimeout(() => {
                trail.remove();
            }, 600);
        });

        // Initialize
        window.addEventListener('DOMContentLoaded', () => {
            createParticles();
        });
    </script>
</body>
</html>

