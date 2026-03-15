<!-- Reset Password Modal -->
<div id="reset-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-xl"></div>
    <div class="relative w-full max-w-lg z-10">
        <div class="holo-card rounded-2xl p-8 relative">
            <button onclick="closeResetModal()" class="absolute top-4 right-4 w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 hover:rotate-90 transition-all duration-300 z-20">
                <i class="fas fa-times text-white/80 text-lg"></i>
            </button>

            <div class="logo-container mx-auto mb-4" style="width: 80px; height: 80px;">
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-image">
                    <img src="../resources/logo.jpeg" alt="VitalNest Logo">
                </div>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-3xl font-black neon-text mb-2" style="font-family: 'Orbitron', sans-serif;">RESET PASSWORD</h2>
                <p class="text-cyan-400/60 text-sm uppercase tracking-wider" id="reset-subtitle">Secure Account Recovery</p>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-cyan-400 to-transparent mx-auto mt-3"></div>
            </div>

            <!-- Alert Messages -->
            <div id="reset-alert" class="hidden mb-4 rounded-xl overflow-hidden"></div>

            <div id="reset-step-1">
                <form onsubmit="handleResetRequest(event)">
                    <div class="space-y-4">
                        <div class="p-4 bg-cyan-400/10 border border-cyan-400/30 rounded-lg">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-cyan-400 text-lg mt-0.5"></i>
                                <p class="text-white/70 text-sm">Enter your registered email or phone number and we'll send you a secure reset code.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                                <i class="fas fa-id-card mr-1"></i>Email or Phone Number
                            </label>
                            <input type="text" id="reset-identifier" required class="cyber-input w-full px-4 py-3 rounded-lg focus:outline-none relative z-10" placeholder="EMAIL@EXAMPLE.COM OR +254712345678">
                            <p class="text-white/40 text-xs mt-2"><i class="fas fa-shield-alt mr-1"></i>Both email and phone are unique to your account</p>
                        </div>

                        <button type="submit" id="reset-request-btn" class="cyber-button w-full py-3 rounded-xl relative z-10 mt-6">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>SEND RESET CODE</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </button>

                        <div class="text-center mt-4 relative z-10" style="position: relative; z-index: 30;">
                            <button type="button" onclick="event.preventDefault(); closeResetModal();" class="text-white/60 hover:text-white text-xs transition-colors" style="position: relative; z-index: 31; pointer-events: auto;">
                                <i class="fas fa-arrow-left mr-1"></i>Back to Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="reset-step-2" class="hidden">
                <form onsubmit="handleResetPassword(event)">
                    <div class="space-y-4">
                        <div class="p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-green-400 text-lg mt-0.5"></i>
                                <div>
                                    <p class="text-green-400 font-semibold text-sm mb-1">Code Sent Successfully!</p>
                                    <p class="text-white/70 text-xs">Check your email for the reset code. It expires in 1 hour.</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                                <i class="fas fa-key mr-1"></i>Reset Code
                            </label>
                            <input type="text" id="reset-token" required class="cyber-input w-full px-4 py-3 rounded-lg focus:outline-none text-center text-lg tracking-widest relative z-10" placeholder="ENTER_CODE" style="font-family: 'Orbitron', sans-serif;">
                            <p class="text-white/40 text-xs mt-2 text-center"><i class="fas fa-clock mr-1"></i>Code expires in 60 minutes</p>
                        </div>

                        <div>
                            <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                                <i class="fas fa-lock mr-1"></i>New Password
                            </label>
                            <div class="relative">
                                <input type="password" id="reset-new-password" required minlength="6" class="cyber-input w-full px-4 py-3 pr-10 rounded-lg focus:outline-none relative z-10" placeholder="NEW_PASSWORD">
                                <button type="button" onclick="toggleResetPassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-cyan-400 hover:text-cyan-300 z-20">
                                    <i class="fas fa-eye text-sm" id="reset-password-icon"></i>
                                </button>
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <div id="reset-password-strength" class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
                                    <div id="reset-password-strength-bar" class="h-full bg-red-500 transition-all duration-300" style="width: 0%"></div>
                                </div>
                                <span id="reset-password-strength-text" class="text-xs text-white/40">WEAK</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                                <i class="fas fa-lock mr-1"></i>Confirm New Password
                            </label>
                            <input type="password" id="reset-new-password-confirm" required minlength="6" class="cyber-input w-full px-4 py-3 rounded-lg focus:outline-none relative z-10" placeholder="CONFIRM_PASSWORD">
                        </div>

                        <button type="submit" id="reset-password-btn" class="cyber-button w-full py-3 rounded-xl relative z-10 mt-6">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fas fa-shield-alt"></i>
                                <span>RESET PASSWORD</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </button>

                        <div class="text-center mt-4 relative z-10" style="position: relative; z-index: 30;">
                            <button type="button" onclick="event.preventDefault(); showResetStep1();" class="text-white/60 hover:text-white text-xs transition-colors" style="position: relative; z-index: 31; pointer-events: auto;">
                                <i class="fas fa-arrow-left mr-1"></i>Back to Email
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

