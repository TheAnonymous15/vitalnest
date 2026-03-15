<!-- Register Modal -->
<div id="register-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-xl"></div>
    <div class="relative w-full max-w-lg max-h-[95vh] overflow-y-auto z-10">
        <div class="holo-card rounded-2xl p-8 relative">
            <!-- Close Button -->
            <button onclick="closeRegisterModal()" class="absolute top-4 right-4 w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 hover:rotate-90 transition-all duration-300 z-20">
                <i class="fas fa-times text-white/80 text-lg"></i>
            </button>

            <!-- Logo -->
            <div class="logo-container mx-auto mb-4" style="width: 80px; height: 80px;">
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-ring"></div>
                <div class="logo-image">
                    <img src="../resources/logo.jpeg" alt="VitalNest Logo">
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-black neon-text mb-2" style="font-family: 'Orbitron', sans-serif;">CREATE ACCOUNT</h2>
                <p class="text-cyan-400/60 text-sm uppercase tracking-wider">Join VitalNest Healthcare</p>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-cyan-400 to-transparent mx-auto mt-3"></div>
            </div>

            <!-- Registration Form -->
            <form onsubmit="handleRegister(event)" class="space-y-4">
                <!-- Name Fields -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-user mr-1"></i>First Name
                        </label>
                        <input type="text" id="register-firstname" required class="cyber-input w-full px-4 py-2.5 rounded-lg focus:outline-none text-sm relative z-10" placeholder="FIRST_NAME">
                    </div>
                    <div>
                        <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                            <i class="fas fa-user mr-1"></i>Last Name
                        </label>
                        <input type="text" id="register-lastname" required class="cyber-input w-full px-4 py-2.5 rounded-lg focus:outline-none text-sm relative z-10" placeholder="LAST_NAME">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                        <i class="fas fa-envelope mr-1"></i>Email Address
                    </label>
                    <input type="email" id="register-email" required class="cyber-input w-full px-4 py-2.5 rounded-lg focus:outline-none text-sm relative z-10" placeholder="EMAIL@EXAMPLE.COM">
                </div>

                <!-- Phone with Country Code -->
                <div>
                    <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                        <i class="fas fa-phone mr-1"></i>Phone Number
                    </label>
                    <div class="flex gap-2">
                        <select id="register-country-code" required class="cyber-input px-3 py-2.5 rounded-lg focus:outline-none text-sm relative z-10 w-28">
                            <option value="+254">🇰🇪 +254</option>
                            <option value="+255">🇹🇿 +255</option>
                            <option value="+256">🇺🇬 +256</option>
                            <option value="+250">🇷🇼 +250</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                        </select>
                        <input type="tel" id="register-phone" required placeholder="712345678" class="cyber-input flex-1 px-4 py-2.5 rounded-lg focus:outline-none text-sm relative z-10" pattern="[0-9]{9,10}">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                        <i class="fas fa-lock mr-1"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="register-password" required minlength="6" class="cyber-input w-full px-4 py-2.5 pr-10 rounded-lg focus:outline-none text-sm relative z-10" placeholder="MIN_6_CHARACTERS">
                        <button type="button" onclick="toggleRegisterPassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-cyan-400 hover:text-cyan-300 z-20">
                            <i class="fas fa-eye text-sm" id="register-password-icon"></i>
                        </button>
                    </div>
                    <div class="mt-2 flex items-center gap-2">
                        <div id="password-strength" class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
                            <div id="password-strength-bar" class="h-full bg-red-500 transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <span id="password-strength-text" class="text-xs text-white/40">WEAK</span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-cyan-400 text-xs font-bold mb-2 uppercase tracking-wider" style="font-family: 'Orbitron', sans-serif;">
                        <i class="fas fa-lock mr-1"></i>Confirm Password
                    </label>
                    <input type="password" id="register-password-confirm" required minlength="6" class="cyber-input w-full px-4 py-2.5 rounded-lg focus:outline-none text-sm relative z-10" placeholder="CONFIRM_PASSWORD">
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-start gap-3 p-3 bg-cyan-400/5 border border-cyan-400/20 rounded-lg">
                    <input type="checkbox" id="register-terms" required class="mt-1 w-4 h-4 rounded border-cyan-400/30 bg-white/5 text-cyan-500 focus:ring-cyan-500 relative z-10">
                    <label for="register-terms" class="text-xs text-white/70 leading-relaxed">
                        I agree to VitalNest's <span class="text-cyan-400 cursor-pointer hover:underline">Terms of Service</span>
                        and <span class="text-cyan-400 cursor-pointer hover:underline">Privacy Policy</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="register-btn" class="cyber-button w-full py-3 rounded-xl relative z-10 mt-6">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        <span>CREATE ACCOUNT</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </button>

                <!-- Login Link -->
                <div class="text-center mt-4 relative z-10" style="position: relative; z-index: 30;">
                    <p class="text-white/50 text-xs">
                        Already have an account?
                        <button type="button" onclick="event.preventDefault(); event.stopPropagation(); closeRegisterModal();"
                                class="text-cyan-400 hover:text-cyan-300 font-semibold ml-1 underline cursor-pointer transition-colors"
                                style="position: relative; z-index: 31; pointer-events: auto;">
                            LOGIN HERE
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

