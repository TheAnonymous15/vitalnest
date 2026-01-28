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
        <a href="/register.php" class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-orange to-amber-500 rounded-full text-white font-bold text-sm shadow-lg shadow-vital-orange/25 hover:shadow-vital-orange/40 hover:-translate-y-0.5 transition-all duration-300">
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

<!-- Floating Center Navigation (Desktop) -->
<nav id="floating-nav" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 hidden lg:block">
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

            <a href="#contact" class="nav-item group relative px-4 py-2.5 rounded-full transition-all duration-300" data-section="contact">
                <div class="flex items-center gap-2">
                    <i class="fas fa-paper-plane text-sm text-white/50 group-hover:text-green-400 transition-colors"></i>
                    <span class="text-sm font-medium text-white/70 group-hover:text-white transition-colors">Contact</span>
                </div>
                <div class="nav-indicator absolute inset-0 bg-white/10 rounded-full scale-0 group-hover:scale-100 transition-transform -z-10"></div>
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

                <a href="#contact" class="mobile-nav-item flex items-center gap-4 p-4 rounded-2xl bg-white/[0.02] hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-all group">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/30 to-green-500/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-paper-plane text-green-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <span class="text-white font-bold text-lg">Contact</span>
                        <p class="text-white/40 text-xs">Get in touch</p>
                    </div>
                    <i class="fas fa-arrow-right text-white/20 group-hover:text-green-400 group-hover:translate-x-1 transition-all"></i>
                </a>
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
                <a href="/register.php" class="flex items-center justify-center gap-2 p-4 bg-gradient-to-r from-vital-orange to-amber-500 rounded-2xl text-white font-bold shadow-lg">
                    <span>Get Started Free</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <p class="text-center text-white/40 text-sm">
                    Already have an account? <a href="/login.php" class="text-vital-teal hover:underline font-semibold">Sign In</a>
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

                <!-- Trust Badges -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-vital-teal/30 transition-all">
                        <div class="w-12 h-12 mx-auto mb-3 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-lock text-vital-teal text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">256-bit SSL</p>
                        <p class="text-white/40 text-xs">Encryption</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-green-500/30 transition-all">
                        <div class="w-12 h-12 mx-auto mb-3 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">HIPAA</p>
                        <p class="text-white/40 text-xs">Compliant</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-blue-500/30 transition-all">
                        <div class="w-12 h-12 mx-auto mb-3 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-shield text-blue-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">GDPR</p>
                        <p class="text-white/40 text-xs">Ready</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all">
                        <div class="w-12 h-12 mx-auto mb-3 bg-purple-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-certificate text-purple-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">ISO 27001</p>
                        <p class="text-white/40 text-xs">Standards</p>
                    </div>
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
                <div class="text-center p-5 bg-gradient-to-r from-vital-teal/10 to-vital-orange/10 rounded-2xl border border-white/10">
                    <h3 class="text-white font-bold mb-2">Questions about security?</h3>
                    <p class="text-white/50 text-sm mb-4">Our compliance team is here to help</p>
                    <a href="mailto:compliance@vitalnest.com" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-white font-semibold text-sm transition-all">
                        <i class="fas fa-envelope"></i>
                        <span>compliance@vitalnest.com</span>
                    </a>
                </div>
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

    /* Scrollbar */
    #compliance-content::-webkit-scrollbar {
        width: 6px;
    }
    #compliance-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    /* Hide floating nav when scrolled to top */
    #floating-nav {
        opacity: 0;
        transform: translate(-50%, 20px);
        transition: all 0.4s ease;
    }
    #floating-nav.visible {
        opacity: 1;
        transform: translate(-50%, 0);
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

    // Show/hide floating nav based on scroll
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;

        // Show floating nav after scrolling 300px
        if (currentScroll > 300) {
            floatingNav.classList.add('visible');
        } else {
            floatingNav.classList.remove('visible');
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
</script>
