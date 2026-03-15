<!-- Ultra Modern Floating Navigation -->

<!-- Floating Logo (Top Left) -->
<a href="/" class="fixed top-5 left-5 z-50 flex items-center gap-2.5 group">
    <div class="relative w-11 h-11 rounded-2xl overflow-hidden border border-white/10 group-hover:border-vital-teal/50 transition-all duration-500 shadow-xl shadow-black/20 group-hover:shadow-vital-teal/20">
        <img src="resources/logo.jpeg" alt="Vitalnest" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-tr from-vital-teal/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
    </div>
    <div class="hidden sm:flex flex-col opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300">
        <span class="text-white font-black text-sm leading-tight">Vitalnest</span>
        <span class="text-white/40 text-[9px] font-medium">Home Healthcare</span>
    </div>
</a>

<!-- Contact Pill (Top Right) -->
<div class="fixed top-5 right-5 z-50 flex items-center gap-3">
    <a href="tel:+254746511327" class="hidden md:flex items-center gap-2 px-4 py-2.5 bg-white/5 backdrop-blur-2xl rounded-full border border-white/10 hover:border-vital-teal/30 transition-all duration-300 group">
        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
        <span class="text-white/70 group-hover:text-white text-sm font-medium transition-colors">24/7 Support</span>
    </a>

    <?php if ($isLoggedIn): ?>
        <a href="/dashboard" class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-teal to-cyan-500 rounded-full text-white font-bold text-sm shadow-lg shadow-vital-teal/25 hover:shadow-vital-teal/40 hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-th-large text-xs"></i>
            <span>Dashboard</span>
        </a>
    <?php else: ?>
        <a href="http://localhost:3456/" target="_blank" class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-orange to-amber-500 rounded-full text-white font-bold text-sm shadow-lg shadow-vital-orange/25 hover:shadow-vital-orange/40 hover:-translate-y-0.5 transition-all duration-300">
            <span>Get Started</span>
            <i class="fas fa-arrow-right text-xs"></i>
        </a>
    <?php endif; ?>

    <!-- Mobile Menu Trigger -->
    <button id="nav-trigger" class="lg:hidden w-11 h-11 flex items-center justify-center rounded-2xl bg-white/5 backdrop-blur-2xl border border-white/10 hover:border-vital-orange/40 transition-all group">
        <div class="flex flex-col gap-1.5 w-5">
            <span class="block h-0.5 w-full bg-white/70 group-hover:bg-vital-orange transition-all origin-center" id="bar1"></span>
            <span class="block h-0.5 w-3/4 bg-white/70 group-hover:bg-vital-orange transition-all ml-auto" id="bar2"></span>
            <span class="block h-0.5 w-1/2 bg-white/70 group-hover:bg-vital-orange transition-all ml-auto" id="bar3"></span>
        </div>
    </button>
</div>

<!-- Floating Navigation -->
<nav id="floating-nav" class="fixed left-1/2 -translate-x-1/2 z-50">
    <div class="relative">
        <!-- Glow Effect -->
        <div class="absolute -inset-1 bg-gradient-to-r from-vital-teal/30 via-purple-500/20 to-vital-orange/30 rounded-full blur-xl opacity-60"></div>

        <!-- Nav Container -->
        <div class="relative flex items-center gap-1 px-2 py-2 bg-slate-900/80 backdrop-blur-2xl rounded-full border border-white/10 shadow-2xl shadow-black/40">

            <a href="#hero" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="hero">
                <div class="flex items-center gap-2">
                    <i class="fas fa-home text-sm text-white/50 group-hover:text-vital-teal transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Home</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </a>

            <a href="#services" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="services">
                <div class="flex items-center gap-2">
                    <i class="fas fa-heartbeat text-sm text-white/50 group-hover:text-vital-orange transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Services</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </a>

            <a href="#packages" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="packages">
                <div class="flex items-center gap-2">
                    <i class="fas fa-box-open text-sm text-white/50 group-hover:text-purple-400 transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Packages</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </a>

            <!-- Divider -->
            <div class="w-px h-6 bg-white/10 mx-1"></div>

            <a href="#faq" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="faq">
                <div class="flex items-center gap-2">
                    <i class="fas fa-question-circle text-sm text-white/50 group-hover:text-amber-400 transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">FAQ</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </a>

            <button id="compliance-trigger" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300">
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-alt text-sm text-vital-teal"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Compliance</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </button>

            <button onclick="openContactModal()" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="contact">
                <div class="flex items-center gap-2">
                    <i class="fas fa-paper-plane text-sm text-white/50 group-hover:text-green-400 transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Contact</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </button>

            <!-- Divider -->
            <div class="w-px h-6 bg-white/10 mx-1"></div>

            <!-- Book Now Button (matches nav style) -->
            <a href="http://localhost:3456/" target="_blank" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300">
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-plus text-sm text-vital-orange group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Book Now</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-gradient-to-r from-vital-orange/20 to-amber-500/20 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
            </a>
        </div>
    </div>
</nav>

<!-- Mobile Full-Screen Navigation -->
<div id="mobile-nav" class="fixed inset-0 z-[100] pointer-events-none lg:hidden">
    <!-- Backdrop -->
    <div id="mobile-backdrop" class="absolute inset-0 bg-slate-950/98 backdrop-blur-2xl opacity-0 transition-all duration-500"></div>

    <!-- Content -->
    <div id="mobile-nav-content" class="absolute inset-0 flex flex-col opacity-0 scale-95 transition-all duration-500">

        <!-- Mobile Header -->
        <div class="flex justify-between items-center px-6 py-6">
            <a href="/" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl overflow-hidden border border-vital-teal/30 shadow-lg">
                    <img src="resources/logo.jpeg" alt="Vitalnest" class="w-full h-full object-cover">
                </div>
                <div>
                    <span class="text-xl font-black text-white">Vital<span class="text-vital-teal">nest</span></span>
                    <p class="text-white/40 text-xs">Home Healthcare</p>
                </div>
            </a>
            <button id="close-mobile-nav" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500/20 hover:border-red-500/30 transition-all group">
                <i class="fas fa-times text-white/60 group-hover:text-red-400 text-xl transition-colors"></i>
            </button>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 flex flex-col justify-center px-6">
            <div class="space-y-3">
                <a href="#hero" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal/30 to-vital-teal/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-home text-vital-teal text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Home</span>
                        <p class="text-white/40 text-xs">Back to top</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-vital-teal group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#services" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-orange/30 to-vital-orange/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-heartbeat text-vital-orange text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Services</span>
                        <p class="text-white/40 text-xs">What we offer</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-vital-orange group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#packages" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/30 to-purple-500/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box-open text-purple-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Packages</span>
                        <p class="text-white/40 text-xs">Pricing & plans</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-purple-400 group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#faq" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500/30 to-amber-500/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-question-circle text-amber-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">FAQ</span>
                        <p class="text-white/40 text-xs">Common questions</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-amber-400 group-hover:translate-x-1 transition-all"></i>
                </a>

                <button id="compliance-trigger-mobile" class="mobile-nav-item w-full flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group text-left">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500/30 to-blue-500/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-blue-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Compliance</span>
                        <p class="text-white/40 text-xs">Security & Privacy</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                </button>

                <button onclick="openContactModal(); closeMobileMenu();" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group w-full text-left">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/30 to-green-500/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-paper-plane text-green-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Contact</span>
                        <p class="text-white/40 text-xs">Get in touch</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-green-400 group-hover:translate-x-1 transition-all"></i>
                </button>
            </div>
        </nav>

        <!-- Bottom Actions -->
        <div class="px-6 py-6 space-y-4">
            <a href="tel:+254746511327" class="flex items-center justify-center gap-3 p-4 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-white font-bold">+254 746 511 327</span>
                <span class="px-2 py-0.5 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">24/7</span>
            </a>

            <?php if ($isLoggedIn): ?>
                <a href="/dashboard" class="flex items-center justify-center gap-2 p-4 bg-gradient-to-r from-vital-teal to-cyan-500 rounded-2xl text-white font-bold shadow-lg">
                    <i class="fas fa-th-large"></i>
                    <span>Go to Dashboard</span>
                </a>
            <?php else: ?>
                <a href="http://localhost:3456/" target="_blank" class="flex items-center justify-center gap-2 p-4 bg-gradient-to-r from-vital-orange to-amber-500 rounded-2xl text-white font-bold shadow-lg">
                    <span>Get Started Free</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <p class="text-center text-white/40 text-sm">
                    Already have an account? <a href="http://localhost:3456/login" target="_blank" class="text-vital-teal hover:underline font-semibold">Sign In</a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Compliance Modal -->
<div id="compliance-modal" class="fixed inset-0 z-[200] pointer-events-none opacity-0 transition-opacity duration-300">
    <!-- Backdrop -->
    <div id="compliance-backdrop" class="absolute inset-0 bg-slate-950/90 backdrop-blur-xl"></div>

    <!-- Modal Content -->
    <div class="absolute inset-0 flex items-center justify-center p-4 overflow-y-auto">
        <div id="compliance-content" class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-gradient-to-br from-slate-800/95 via-slate-900/95 to-slate-950/95 backdrop-blur-2xl rounded-3xl border border-white/10 shadow-2xl transform scale-95 transition-transform duration-300">

            <!-- Modal Header -->
            <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-white/10 bg-slate-900/80 backdrop-blur-xl rounded-t-3xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-teal/30">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white">Security & Compliance</h2>
                        <p class="text-white/50 text-sm">Your data protection is our priority</p>
                    </div>
                </div>
                <button id="close-compliance" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500/20 hover:border-red-500/30 transition-all group">
                    <i class="fas fa-times text-white/60 group-hover:text-red-400 transition-colors"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6">

                <!-- Badges View (Default) -->
                <div id="badges-view">
                    <!-- Trust Badges - Interactive with Clear Click Indicators -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-4">
                    <button onclick="showCertDetail('ssl')" class="cert-badge relative text-center p-3 bg-white/5 rounded-xl border-2 border-white/10 hover:border-vital-teal/50 transition-all cursor-pointer group hover:bg-white/10 hover:-translate-y-2 hover:shadow-xl hover:shadow-vital-teal/30 active:scale-95">
                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-vital-teal/30 rounded-full flex items-center justify-center group-hover:bg-vital-teal group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-hand-pointer text-white text-[8px] group-hover:animate-pulse"></i>
                        </div>
                        <div class="w-10 h-10 mx-auto mb-2 bg-vital-teal/20 rounded-lg flex items-center justify-center group-hover:bg-vital-teal/40 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-lock text-vital-teal text-base group-hover:text-white"></i>
                        </div>
                        <p class="text-white font-bold text-xs">256-bit SSL</p>
                        <p class="text-white/40 text-[10px] mb-1">Encryption</p>
                        <div class="flex items-center justify-center gap-1 text-white/30 group-hover:text-vital-teal text-[9px] transition-colors">
                            <i class="fas fa-info-circle"></i>
                            <span class="font-semibold">Click</span>
                        </div>
                    </button>

                    <button onclick="showCertDetail('hipaa')" class="cert-badge relative text-center p-3 bg-white/5 rounded-xl border-2 border-white/10 hover:border-green-500/50 transition-all cursor-pointer group hover:bg-white/10 hover:-translate-y-2 hover:shadow-xl hover:shadow-green-500/30 active:scale-95">
                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500/30 rounded-full flex items-center justify-center group-hover:bg-green-500 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-hand-pointer text-white text-[8px] group-hover:animate-pulse"></i>
                        </div>
                        <div class="w-10 h-10 mx-auto mb-2 bg-green-500/20 rounded-lg flex items-center justify-center group-hover:bg-green-500/40 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-check-circle text-green-400 text-base group-hover:text-white"></i>
                        </div>
                        <p class="text-white font-bold text-xs">HIPAA</p>
                        <p class="text-white/40 text-[10px] mb-1">Compliant</p>
                        <div class="flex items-center justify-center gap-1 text-white/30 group-hover:text-green-400 text-[9px] transition-colors">
                            <i class="fas fa-info-circle"></i>
                            <span class="font-semibold">Click</span>
                        </div>
                    </button>

                    <button onclick="showCertDetail('gdpr')" class="cert-badge relative text-center p-3 bg-white/5 rounded-xl border-2 border-white/10 hover:border-blue-500/50 transition-all cursor-pointer group hover:bg-white/10 hover:-translate-y-2 hover:shadow-xl hover:shadow-blue-500/30 active:scale-95">
                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-blue-500/30 rounded-full flex items-center justify-center group-hover:bg-blue-500 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-hand-pointer text-white text-[8px] group-hover:animate-pulse"></i>
                        </div>
                        <div class="w-10 h-10 mx-auto mb-2 bg-blue-500/20 rounded-lg flex items-center justify-center group-hover:bg-blue-500/40 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-user-shield text-blue-400 text-base group-hover:text-white"></i>
                        </div>
                        <p class="text-white font-bold text-xs">GDPR</p>
                        <p class="text-white/40 text-[10px] mb-1">Ready</p>
                        <div class="flex items-center justify-center gap-1 text-white/30 group-hover:text-blue-400 text-[9px] transition-colors">
                            <i class="fas fa-info-circle"></i>
                            <span class="font-semibold">Click</span>
                        </div>
                    </button>

                    <button onclick="showCertDetail('iso')" class="cert-badge relative text-center p-3 bg-white/5 rounded-xl border-2 border-white/10 hover:border-purple-500/50 transition-all cursor-pointer group hover:bg-white/10 hover:-translate-y-2 hover:shadow-xl hover:shadow-purple-500/30 active:scale-95">
                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-purple-500/30 rounded-full flex items-center justify-center group-hover:bg-purple-500 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-hand-pointer text-white text-[8px] group-hover:animate-pulse"></i>
                        </div>
                        <div class="w-10 h-10 mx-auto mb-2 bg-purple-500/20 rounded-lg flex items-center justify-center group-hover:bg-purple-500/40 group-hover:scale-110 transition-all shadow-lg">
                            <i class="fas fa-certificate text-purple-400 text-base group-hover:text-white"></i>
                        </div>
                        <p class="text-white font-bold text-xs">ISO 27001</p>
                        <p class="text-white/40 text-[10px] mb-1">Standards</p>
                        <div class="flex items-center justify-center gap-1 text-white/30 group-hover:text-purple-400 text-[9px] transition-colors">
                            <i class="fas fa-info-circle"></i>
                            <span class="font-semibold">Click</span>
                        </div>
                    </button>
                </div>

                <!-- Reading Panel - Shows below badges when clicked -->
                <div id="cert-reading-panel" style="display: none;" class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl p-5 mb-6">
                    <!-- Content will be dynamically inserted -->
                </div>

                <!-- Data Protection -->
                <div class="bg-white/[0.03] rounded-2xl p-5 border border-white/5">
                    <h3 class="text-white font-bold flex items-center gap-2 mb-4">
                        <i class="fas fa-database text-vital-teal"></i> Data Protection
                    </h3>
                    <div class="grid md:grid-cols-2 gap-3">
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                            <i class="fas fa-check text-vital-teal"></i>
                            <span class="text-white/70 text-sm">End-to-End Encryption</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                            <i class="fas fa-check text-vital-teal"></i>
                            <span class="text-white/70 text-sm">Secure Cloud Storage</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                            <i class="fas fa-check text-vital-teal"></i>
                            <span class="text-white/70 text-sm">Role-Based Access</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                            <i class="fas fa-check text-vital-teal"></i>
                            <span class="text-white/70 text-sm">Complete Audit Trails</span>
                        </div>
                    </div>
                </div>

                <!-- Privacy Practices -->
                <div class="bg-white/[0.03] rounded-2xl p-5 border border-white/5">
                    <h3 class="text-white font-bold flex items-center gap-2 mb-4">
                        <i class="fas fa-eye-slash text-vital-orange"></i> Privacy Practices
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <span class="text-white/70 text-sm">Your data is never sold</span>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Guaranteed</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <span class="text-white/70 text-sm">Request deletion anytime</span>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Your Right</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <span class="text-white/70 text-sm">Export your data</span>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Available</span>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center p-4 bg-gradient-to-r from-vital-teal/10 to-vital-orange/10 rounded-xl border border-white/10">
                    <h3 class="text-white font-bold text-sm mb-1">Questions about security?</h3>
                    <p class="text-white/50 text-xs mb-3">Our compliance team is here to help</p>
                    <a href="mailto:compliance@vitalnest.com" class="security-email-btn inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-br from-vital-teal to-cyan-600 rounded-lg text-white font-bold text-xs shadow-lg shadow-vital-teal/30 hover:shadow-xl hover:shadow-vital-teal/50 transition-all duration-300 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <div class="relative flex items-center gap-2">
                            <div class="w-7 h-7 bg-white/20 rounded-md flex items-center justify-center group-hover:bg-white/30 transition-all">
                                <i class="fas fa-envelope text-white text-xs"></i>
                            </div>
                            <span class="text-white font-bold text-xs">Email Compliance</span>
                            <i class="fas fa-arrow-right text-white/60 group-hover:text-white group-hover:translate-x-1 transition-all text-xs"></i>
                        </div>
                    </a>
                </div>
                </div>
                <!-- End Badges View -->

            </div>
        </div>
    </div>
</div>


<style>
    /* Nav active states */
    .nav-item.active .nav-indicator {
        transform: scale(1);
        background: linear-gradient(135deg, rgba(15, 118, 110, 0.3), rgba(249, 115, 22, 0.2));
    }
    .nav-item.active i {
        color: #0f766e !important;
    }
    .nav-item.active span {
        color: white !important;
    }

    /* Mobile nav states */
    #mobile-nav.active {
        pointer-events: auto;
    }
    #mobile-nav.active #mobile-backdrop {
        opacity: 1;
    }
    #mobile-nav.active #mobile-nav-content {
        opacity: 1;
        transform: scale(1);
    }

    /* Hamburger animation */
    #mobile-nav.active ~ div #bar1 {
        transform: rotate(45deg) translate(4px, 4px);
        width: 100%;
    }
    #mobile-nav.active ~ div #bar2 {
        opacity: 0;
    }
    #mobile-nav.active ~ div #bar3 {
        transform: rotate(-45deg) translate(4px, -4px);
        width: 100%;
    }

    /* Mobile nav item animations */
    .mobile-nav-item {
        opacity: 0;
        transform: translateY(20px);
    }
    #mobile-nav.active .mobile-nav-item {
        animation: fadeUp 0.4s ease forwards;
    }
    .mobile-nav-item:nth-child(1) { animation-delay: 0.05s; }
    .mobile-nav-item:nth-child(2) { animation-delay: 0.1s; }
    .mobile-nav-item:nth-child(3) { animation-delay: 0.15s; }
    .mobile-nav-item:nth-child(4) { animation-delay: 0.2s; }
    .mobile-nav-item:nth-child(5) { animation-delay: 0.25s; }
    .mobile-nav-item:nth-child(6) { animation-delay: 0.3s; }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Compliance Modal */
    #compliance-modal.active {
        pointer-events: auto;
        opacity: 1;
    }
    #compliance-modal.active #compliance-content {
        transform: scale(1);
    }

    /* Certificate Badge Animations */
    .cert-badge {
        position: relative;
        overflow: visible;
        transform-style: preserve-3d;
    }

    .cert-badge::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        pointer-events: none;
    }

    .cert-badge:hover::before {
        width: 300px;
        height: 300px;
    }

    .cert-badge:active {
        transform: scale(0.95) translateY(-2px);
    }

    /* Security Email Button 3D Effect */
    .security-email-btn {
        transform-style: preserve-3d;
        position: relative;

        box-shadow:
            0 4px 8px -2px rgba(15, 118, 110, 0.4),
            0 2px 4px -2px rgba(15, 118, 110, 0.3),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.2),
            inset 0 -1px 0 0 rgba(0, 0, 0, 0.1);
    }

    .security-email-btn::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 6px;
        right: 6px;
        height: 4px;
        background: rgba(15, 118, 110, 0.3);
        filter: blur(4px);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .security-email-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 8px 14px -2px rgba(15, 118, 110, 0.5),
            0 4px 8px -2px rgba(15, 118, 110, 0.4),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.3),
            inset 0 -1px 0 0 rgba(0, 0, 0, 0.15);
    }

    .security-email-btn:hover::after {
        bottom: -6px;
        filter: blur(6px);
        opacity: 0.8;
    }

    .security-email-btn:active {
        transform: translateY(-1px) scale(0.98);
        box-shadow:
            0 3px 6px -2px rgba(15, 118, 110, 0.4),
            0 1px 3px -1px rgba(15, 118, 110, 0.3),
            inset 0 2px 3px 0 rgba(0, 0, 0, 0.15);
    }

    .security-email-btn:active::after {
        bottom: -3px;
        filter: blur(3px);
    }

    /* Hand pointer pulse animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    /* Fade-in animation for cert detail */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.4s ease forwards;
    }

    /* Scrollbar */
    #compliance-content::-webkit-scrollbar {
        width: 6px;
    }
    #compliance-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    /* Floating nav always visible - default bottom position */
    #floating-nav {
        opacity: 1;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        transition: transform 1.2s cubic-bezier(0.25, 0.1, 0.25, 1);
    }

    /* Move to top when near footer - smooth trailing slide animation */
    #floating-nav.move-to-top {
        /* Calculate distance to move: viewport height - bottom margin - top margin - nav height */
        transform: translateX(-50%) translateY(calc(-100vh + 4rem + var(--nav-height, 80px)));
    }

    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const floatingNav = document.getElementById('floating-nav');
    const navTrigger = document.getElementById('nav-trigger');
    const mobileNav = document.getElementById('mobile-nav');
    const closeMobileNav = document.getElementById('close-mobile-nav');
    const mobileNavLinks = document.querySelectorAll('#mobile-nav-content a[href^="#"]');
    const navItems = document.querySelectorAll('.nav-item[data-section]');

    // Compliance Modal
    const complianceModal = document.getElementById('compliance-modal');
    const complianceTrigger = document.getElementById('compliance-trigger');
    const complianceTriggerMobile = document.getElementById('compliance-trigger-mobile');
    const closeCompliance = document.getElementById('close-compliance');
    const complianceBackdrop = document.getElementById('compliance-backdrop');

    // Position navbar based on footer proximity
    let lastScroll = 0;

    // Set nav height CSS variable for smooth transitions
    const setNavHeight = () => {
        const navHeight = floatingNav.offsetHeight;
        floatingNav.style.setProperty('--nav-height', `${navHeight}px`);
    };

    setNavHeight();
    window.addEventListener('resize', setNavHeight);

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        const footer = document.querySelector('footer');

        // Check if footer is in viewport
        if (footer) {
            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            // Move to top when footer is 200px from bottom of screen
            const isNearFooter = footerRect.top <= windowHeight + 200;

            if (isNearFooter) {
                // Move navbar to top when near footer
                floatingNav.classList.add('move-to-top');
            } else {
                // Return navbar to bottom when away from footer
                floatingNav.classList.remove('move-to-top');
            }
        }

        // Update active section
        const sections = ['hero', 'services', 'packages', 'faq', 'contact'];
        let current = 'hero';

        sections.forEach(section => {
            const el = document.getElementById(section);
            if (el) {
                const rect = el.getBoundingClientRect();
                if (rect.top <= 200) {
                    current = section;
                }
            }
        });

        navItems.forEach(item => {
            item.classList.remove('active');
            if (item.dataset.section === current) {
                item.classList.add('active');
            }
        });

        lastScroll = currentScroll;
    });

    // Mobile nav toggle
    if (navTrigger) {
        navTrigger.addEventListener('click', () => {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeMobileNav) {
        closeMobileNav.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Compliance Modal
    function openComplianceModal() {
        complianceModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        mobileNav.classList.remove('active');
    }

    function closeComplianceModal() {
        complianceModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (complianceTrigger) complianceTrigger.addEventListener('click', openComplianceModal);
    if (complianceTriggerMobile) complianceTriggerMobile.addEventListener('click', openComplianceModal);
    if (closeCompliance) closeCompliance.addEventListener('click', closeComplianceModal);
    if (complianceBackdrop) complianceBackdrop.addEventListener('click', closeComplianceModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeComplianceModal();
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 20;
                const targetPosition = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }
        });
    });
});

// Certification Details
const certificationDetails = {
    ssl: {
        icon: 'fa-lock',
        iconColor: 'vital-teal',
        title: '256-bit SSL Encryption',
        subtitle: 'Bank-Level Security',
        description: 'SSL (Secure Sockets Layer) encryption is like a protective tunnel for your data as it travels between your device and our servers.',
        whatItMeans: 'Every piece of information you share with us - from your health records to personal details - is scrambled into unreadable code during transmission. This makes it impossible for hackers or unauthorized parties to intercept and read your data.',
        benefits: [
            {
                icon: 'fa-shield-alt',
                title: 'Military-Grade Protection',
                description: 'Your data is encrypted with the same 256-bit standard used by banks, military, and government agencies worldwide.'
            },
            {
                icon: 'fa-lock',
                title: 'Automatic Encryption',
                description: 'All communications are automatically encrypted - you don\'t need to do anything special. It works seamlessly in the background.'
            },
            {
                icon: 'fa-eye-slash',
                title: 'Privacy Guaranteed',
                description: 'Even if someone intercepts the data, they would need billions of years to decrypt it without the proper key.'
            },
            {
                icon: 'fa-check-circle',
                title: 'Industry Standard',
                description: 'We use the highest level of SSL/TLS encryption available, ensuring your information is protected at all times.'
            }
        ],
        simpleTerms: 'Think of it as a secret code that only you and VitalNest can understand. When you send us information, it\'s instantly scrambled into gibberish that only our secure servers can decode.'
    },
    hipaa: {
        icon: 'fa-shield-alt',
        iconColor: 'green-400',
        title: 'HIPAA Compliant',
        subtitle: 'Healthcare Privacy Protection',
        description: 'HIPAA (Health Insurance Portability and Accountability Act) is a federal law specifically designed to protect your medical information and health records.',
        whatItMeans: 'This means we follow strict rules about how we collect, store, and share your health information. We can\'t share your medical records with anyone without your explicit permission.',
        benefits: [
            {
                icon: 'fa-user-lock',
                title: 'You Control Your Data',
                description: 'You decide who sees your medical information. We never share it with anyone - not even family members - without your written consent.'
            },
            {
                icon: 'fa-clipboard-check',
                title: 'Strict Access Controls',
                description: 'Only authorized healthcare providers directly involved in your care can access your records. Every access is logged and monitored.'
            },
            {
                icon: 'fa-balance-scale',
                title: 'Legal Protection',
                description: 'HIPAA violations carry serious penalties, including fines and criminal charges. This ensures everyone takes your privacy seriously.'
            },
            {
                icon: 'fa-history',
                title: 'Regular Audits',
                description: 'We undergo regular security audits and compliance checks to ensure we\'re meeting all HIPAA requirements to protect your data.'
            }
        ],
        simpleTerms: 'Your health information is YOUR private property. We treat it with the same confidentiality as your doctor does. What happens in your healthcare stays in your healthcare - unless you explicitly say otherwise.'
    },
    gdpr: {
        icon: 'fa-user-shield',
        iconColor: 'blue-400',
        title: 'GDPR Ready',
        subtitle: 'European Data Protection Standard',
        description: 'GDPR (General Data Protection Regulation) is Europe\'s comprehensive data privacy law that gives you complete control over your personal information.',
        whatItMeans: 'You have the right to know what data we collect, why we collect it, how we use it, and you can access, modify, or delete it anytime.',
        benefits: [
            {
                icon: 'fa-download',
                title: 'Access Your Data Anytime',
                description: 'You can request a complete copy of all your data at any time. We\'ll provide it in an easy-to-read format within 30 days.'
            },
            {
                icon: 'fa-trash-alt',
                title: 'Right to Be Forgotten',
                description: 'Want to delete your account and data? Just ask. We\'ll permanently erase your information from our systems (except what\'s legally required to keep).'
            },
            {
                icon: 'fa-hand-paper',
                title: 'Clear Consent Required',
                description: 'We only collect and use data you explicitly agree to. No hidden data collection or sneaky practices - ever.'
            },
            {
                icon: 'fa-bell',
                title: 'Breach Notifications',
                description: 'If there\'s ever a data breach (which we work hard to prevent), we\'ll notify you within 72 hours. Transparency is key.'
            }
        ],
        simpleTerms: 'Think of GDPR as your personal data "Bill of Rights." You own your information, and you get to decide what happens with it. We\'re just the caretakers, and you\'re always in charge.'
    },
    iso: {
        icon: 'fa-certificate',
        iconColor: 'purple-400',
        title: 'ISO 27001 Standards',
        subtitle: 'International Security Certification',
        description: 'ISO 27001 is the world\'s most recognized standard for information security management. It\'s an independent certification that proves we meet international best practices.',
        whatItMeans: 'This certification means an independent third-party auditor has verified that our security systems, processes, and procedures meet rigorous international standards.',
        benefits: [
            {
                icon: 'fa-tasks',
                title: 'Systematic Security',
                description: 'We have documented policies and procedures for every aspect of data security - from how we store information to how we respond to threats.'
            },
            {
                icon: 'fa-user-graduate',
                title: 'Trained Team',
                description: 'Every employee undergoes regular security training. Everyone on our team understands their role in protecting your data.'
            },
            {
                icon: 'fa-sync-alt',
                title: 'Continuous Improvement',
                description: 'We regularly assess our security measures and update them to address new threats. Security isn\'t a one-time thing - it\'s ongoing.'
            },
            {
                icon: 'fa-search',
                title: 'Regular Audits',
                description: 'Independent auditors regularly review our systems to ensure we maintain compliance. We can\'t fake it - we have to prove it.'
            }
        ],
        simpleTerms: 'ISO 27001 is like having a security expert constantly checking our work. It means we don\'t just say we\'re secure - we can prove it with internationally recognized standards.'
    }
};

function showCertDetail(certType) {
    const readingPanel = document.getElementById('cert-reading-panel');
    const cert = certificationDetails[certType];

    if (!cert) {
        console.error('Certification type not found:', certType);
        return;
    }

    if (!readingPanel) {
        console.error('Reading panel not found');
        return;
    }

    console.log('Showing certification detail for:', certType);

    readingPanel.innerHTML = `
        <div class="flex items-start gap-4 mb-5 pb-5 border-b border-white/10">
            <div class="w-14 h-14 bg-gradient-to-br from-${cert.iconColor}/20 to-${cert.iconColor}/10 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                <i class="fas ${cert.icon} text-${cert.iconColor} text-xl"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-white font-black text-lg mb-1">${cert.title}</h3>
                <p class="text-${cert.iconColor} text-xs font-semibold mb-2">${cert.subtitle}</p>
                <p class="text-white/70 text-sm leading-relaxed">${cert.description}</p>
            </div>
        </div>

        <div class="mb-5">
            <div class="bg-gradient-to-r from-${cert.iconColor}/10 to-transparent border-l-4 border-${cert.iconColor} rounded-lg p-4">
                <h4 class="text-white font-bold text-sm mb-2 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-${cert.iconColor}"></i>
                    What This Means For You
                </h4>
                <p class="text-white/80 text-sm leading-relaxed">${cert.whatItMeans}</p>
            </div>
        </div>

        <div class="mb-5">
            <h4 class="text-white font-bold text-sm mb-3 flex items-center gap-2">
                <i class="fas fa-star text-${cert.iconColor}"></i>
                Key Benefits
            </h4>
            <div class="grid md:grid-cols-2 gap-3">
                ${cert.benefits.map(benefit => `
                    <div class="bg-white/5 rounded-xl p-3 hover:bg-white/10 transition-all border border-white/5">
                        <div class="flex items-start gap-2">
                            <div class="w-8 h-8 bg-${cert.iconColor}/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas ${benefit.icon} text-${cert.iconColor} text-xs"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm mb-1">${benefit.title}</p>
                                <p class="text-white/60 text-xs leading-relaxed">${benefit.description}</p>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>

        <div class="bg-gradient-to-r from-${cert.iconColor}/5 to-transparent rounded-xl p-4 border border-${cert.iconColor}/20">
            <div class="flex gap-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-${cert.iconColor}/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-comment-dots text-${cert.iconColor}"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm mb-2">In Simple Terms</h4>
                    <p class="text-white/70 text-sm leading-relaxed">${cert.simpleTerms}</p>
                </div>
            </div>
        </div>
    `;

    // Show the reading panel
    readingPanel.style.display = 'block';

    // Smooth scroll to reading panel
    setTimeout(() => {
        readingPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }, 100);

    console.log('Reading panel is now visible');
}

function showBadgesView() {
    // No longer needed - kept for compatibility
}

function closeCertDetail() {
    // No longer needed - kept for compatibility
}
</script>
