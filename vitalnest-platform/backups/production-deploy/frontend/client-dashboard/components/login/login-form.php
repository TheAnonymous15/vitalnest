<!-- Login Form Section -->
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
            <h1 class="text-4xl font-black neon-text glitch mb-2">VitalNest</h1>
            <p class="text-cyan-400 font-medium text-base tracking-widest uppercase" style="font-family: 'Orbitron', sans-serif;">
                Patient Access Portal
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
                        <input type="email" id="email" name="email" value="patient@vitalnest.com" required
                               class="cyber-input w-full px-4 py-3 rounded-xl focus:outline-none"
                               placeholder="ENTER_EMAIL">
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
                        <input type="password" id="password" name="password" value="patient123" required
                               class="cyber-input w-full px-4 py-3 pr-12 rounded-xl focus:outline-none"
                               placeholder="ENTER_SECURITY_CODE">
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center text-cyan-400 hover:text-cyan-300 transition-colors rounded-lg">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn" class="cyber-button w-full py-3 rounded-xl relative z-10 mt-6">
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
                <button onclick="openResetModal()" class="group flex flex-col items-center gap-1.5 p-3 holo-card rounded-xl hover:border-cyan-400 transition-all cursor-pointer">
                    <i class="fas fa-key text-cyan-400 text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="text-[10px] text-cyan-400 uppercase tracking-wider font-semibold">Reset Key</span>
                </button>
                <button onclick="openRegisterModal()" class="group flex flex-col items-center gap-1.5 p-3 holo-card rounded-xl hover:border-[#F97316] transition-all cursor-pointer">
                    <i class="fas fa-user-plus text-[#F97316] text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="text-[10px] text-[#F97316] uppercase tracking-wider font-semibold">New User</span>
                </button>
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

