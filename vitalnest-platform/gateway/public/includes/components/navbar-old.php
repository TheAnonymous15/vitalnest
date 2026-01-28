<!-- Modern Fixed Navigation Bar -->
<header id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-xl border-b border-white/5"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex justify-between items-center h-16 lg:h-18">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 rounded-xl overflow-hidden border border-vital-teal/30 group-hover:border-vital-orange/50 transition-all duration-300 shadow-lg shadow-vital-teal/10">
                    <img src="resources/logo.jpeg" alt="Vitalnest" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-black text-white leading-tight">Vital<span class="text-vital-teal">nest</span></span>
                    <span class="text-[10px] text-white/40 font-medium -mt-0.5 hidden sm:block">HOME HEALTHCARE</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center">
                <div class="flex items-center bg-white/5 rounded-full p-1 border border-white/5">
                    <a href="#hero" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300">
                        Home
                    </a>
                    <a href="#services" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300">
                        Services
                    </a>
                    <a href="#packages" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300">
                        Packages
                    </a>
                    <a href="#faq" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300">
                        FAQ
                    </a>
                    <button id="compliance-trigger" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300 flex items-center gap-1.5">
                        <i class="fas fa-shield-alt text-xs text-vital-teal"></i>
                        Compliance
                    </button>
                    <a href="#contact" class="nav-link px-4 py-2 rounded-full text-sm font-medium text-white/70 hover:text-white hover:bg-white/10 transition-all duration-300">
                        Contact
                    </a>
                </div>
            </nav>

            <!-- Right Side Actions -->
            <div class="flex items-center gap-3">
                <!-- Phone - Desktop -->
                <a href="tel:+254746511327" class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-full text-sm group">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-white/60 group-hover:text-vital-teal transition-colors font-medium">0746 511 327</span>
                </a>

                <!-- CTA Button -->
                <?php if ($isLoggedIn): ?>
                    <a href="/dashboard" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-teal to-teal-600 rounded-full text-white font-bold text-sm hover:shadow-lg hover:shadow-vital-teal/30 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-th-large text-xs"></i>
                        <span>Dashboard</span>
                    </a>
                <?php else: ?>
                    <a href="/register.php" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-orange to-amber-500 rounded-full text-white font-bold text-sm hover:shadow-lg hover:shadow-vital-orange/30 hover:-translate-y-0.5 transition-all duration-300">
                        <span>Get Started</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                <?php endif; ?>

                <!-- Mobile Menu Trigger -->
                <button id="nav-trigger" class="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 hover:border-vital-orange/40 transition-all group">
                    <div class="flex flex-col gap-1.5 w-5">
                        <span class="block h-0.5 w-full bg-white/70 group-hover:bg-vital-orange transition-all origin-center" id="bar1"></span>
                        <span class="block h-0.5 w-3/4 bg-white/70 group-hover:bg-vital-orange transition-all ml-auto" id="bar2"></span>
                        <span class="block h-0.5 w-1/2 bg-white/70 group-hover:bg-vital-orange transition-all ml-auto" id="bar3"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Navigation Overlay -->
<div id="mobile-nav" class="fixed inset-0 z-[100] pointer-events-none lg:hidden">
    <!-- Backdrop -->
    <div id="mobile-backdrop" class="absolute inset-0 bg-slate-950/95 backdrop-blur-2xl opacity-0 transition-all duration-500"></div>

    <!-- Content -->
    <div id="mobile-nav-content" class="absolute inset-0 flex flex-col opacity-0 translate-y-4 transition-all duration-500">

        <!-- Mobile Header -->
        <div class="flex justify-between items-center px-6 py-5 border-b border-white/5">
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl overflow-hidden border border-vital-teal/30">
                    <img src="resources/logo.jpeg" alt="Vitalnest" class="w-full h-full object-cover">
                </div>
                <span class="text-lg font-black text-white">Vital<span class="text-vital-teal">nest</span></span>
            </a>
            <button id="close-mobile-nav" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-vital-orange/20 hover:border-vital-orange/30 transition-all">
                <i class="fas fa-times text-white"></i>
            </button>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 flex flex-col justify-center px-6 py-8">
            <div class="space-y-2">
                <a href="#hero" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal/20 to-vital-teal/5 rounded-xl flex items-center justify-center border border-vital-teal/20 group-hover:border-vital-teal/40 transition-all">
                        <i class="fas fa-home text-vital-teal text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">Home</span>
                        <span class="text-white/40 text-xs">Back to top</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-vital-teal group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#services" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-orange/20 to-vital-orange/5 rounded-xl flex items-center justify-center border border-vital-orange/20 group-hover:border-vital-orange/40 transition-all">
                        <i class="fas fa-heartbeat text-vital-orange text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">Services</span>
                        <span class="text-white/40 text-xs">What we offer</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-vital-orange group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#packages" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-purple-500/5 rounded-xl flex items-center justify-center border border-purple-500/20 group-hover:border-purple-500/40 transition-all">
                        <i class="fas fa-box-open text-purple-400 text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">Packages</span>
                        <span class="text-white/40 text-xs">Care plans & pricing</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-purple-400 group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#faq" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500/20 to-amber-500/5 rounded-xl flex items-center justify-center border border-amber-500/20 group-hover:border-amber-500/40 transition-all">
                        <i class="fas fa-question-circle text-amber-400 text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">FAQ</span>
                        <span class="text-white/40 text-xs">Common questions</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-amber-400 group-hover:translate-x-1 transition-all"></i>
                </a>

                <a href="#contact" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-green-500/5 rounded-xl flex items-center justify-center border border-green-500/20 group-hover:border-green-500/40 transition-all">
                        <i class="fas fa-paper-plane text-green-400 text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">Contact</span>
                        <span class="text-white/40 text-xs">Get in touch</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-green-400 group-hover:translate-x-1 transition-all"></i>
                </a>

                <button id="compliance-trigger-mobile" class="mobile-nav-item group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-all w-full text-left">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500/20 to-blue-500/5 rounded-xl flex items-center justify-center border border-blue-500/20 group-hover:border-blue-500/40 transition-all">
                        <i class="fas fa-shield-alt text-blue-400 text-lg"></i>
                    </div>
                    <div>
                        <span class="text-white font-bold text-lg block">Compliance</span>
                        <span class="text-white/40 text-xs">Security & Privacy</span>
                    </div>
                    <i class="fas fa-chevron-right text-white/20 ml-auto group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                </button>
            </div>
        </nav>

        <!-- Bottom Actions -->
        <div class="px-6 py-6 border-t border-white/5 space-y-4">
            <!-- Phone -->
            <a href="tel:+254746511327" class="flex items-center justify-center gap-3 p-4 bg-white/5 rounded-2xl border border-white/10">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-white font-semibold">+254 746 511 327</span>
                <span class="text-white/40 text-sm">24/7</span>
            </a>

            <!-- CTA -->
            <?php if ($isLoggedIn): ?>
                <a href="/dashboard" class="flex items-center justify-center gap-2 p-4 bg-gradient-to-r from-vital-teal to-teal-600 rounded-2xl text-white font-bold shadow-lg shadow-vital-teal/20">
                    <i class="fas fa-th-large"></i>
                    <span>Go to Dashboard</span>
                </a>
            <?php else: ?>
                <a href="/register.php" class="flex items-center justify-center gap-2 p-4 bg-gradient-to-r from-vital-orange to-amber-500 rounded-2xl text-white font-bold shadow-lg shadow-vital-orange/20">
                    <span>Get Started Free</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <p class="text-center text-white/40 text-sm">
                    Already have an account? <a href="/login.php" class="text-vital-teal hover:underline">Sign In</a>
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
            <div class="p-6 space-y-8">

                <!-- Trust Badges Row -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-vital-teal/30 transition-all">
                        <div class="w-14 h-14 mx-auto mb-3 bg-gradient-to-br from-vital-teal/20 to-vital-teal/5 rounded-xl flex items-center justify-center border border-vital-teal/20">
                            <i class="fas fa-lock text-vital-teal text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">256-bit SSL</p>
                        <p class="text-white/40 text-xs">Encryption</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-green-500/30 transition-all">
                        <div class="w-14 h-14 mx-auto mb-3 bg-gradient-to-br from-green-500/20 to-green-500/5 rounded-xl flex items-center justify-center border border-green-500/20">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">HIPAA</p>
                        <p class="text-white/40 text-xs">Compliant</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-blue-500/30 transition-all">
                        <div class="w-14 h-14 mx-auto mb-3 bg-gradient-to-br from-blue-500/20 to-blue-500/5 rounded-xl flex items-center justify-center border border-blue-500/20">
                            <i class="fas fa-user-shield text-blue-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">GDPR</p>
                        <p class="text-white/40 text-xs">Ready</p>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all">
                        <div class="w-14 h-14 mx-auto mb-3 bg-gradient-to-br from-purple-500/20 to-purple-500/5 rounded-xl flex items-center justify-center border border-purple-500/20">
                            <i class="fas fa-certificate text-purple-400 text-xl"></i>
                        </div>
                        <p class="text-white font-bold text-sm">ISO 27001</p>
                        <p class="text-white/40 text-xs">Standards</p>
                    </div>
                </div>

                <!-- Data Protection Section -->
                <div class="bg-white/[0.03] rounded-2xl p-6 border border-white/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-teal to-teal-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-database text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Data Protection</h3>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-vital-teal text-xs"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">End-to-End Encryption</p>
                                <p class="text-white/50 text-xs">All data encrypted in transit and at rest</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-vital-teal text-xs"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Secure Cloud Storage</p>
                                <p class="text-white/50 text-xs">AWS-hosted with multi-region backup</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-vital-teal text-xs"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Access Controls</p>
                                <p class="text-white/50 text-xs">Role-based permissions with 2FA</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-vital-teal text-xs"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Audit Trails</p>
                                <p class="text-white/50 text-xs">Complete logs of all data access</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Practices -->
                <div class="bg-white/[0.03] rounded-2xl p-6 border border-white/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-eye-slash text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Privacy Practices</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-user-secret text-vital-orange"></i>
                                <span class="text-white/80 text-sm">Your data is never sold to third parties</span>
                            </div>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Guaranteed</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-trash-alt text-vital-orange"></i>
                                <span class="text-white/80 text-sm">Request data deletion anytime</span>
                            </div>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Your Right</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-download text-vital-orange"></i>
                                <span class="text-white/80 text-sm">Export your data in standard formats</span>
                            </div>
                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs font-bold rounded-full">Available</span>
                        </div>
                    </div>
                </div>

                <!-- Healthcare Compliance -->
                <div class="bg-white/[0.03] rounded-2xl p-6 border border-white/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Healthcare Compliance</h3>
                    </div>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="p-4 bg-gradient-to-b from-green-500/10 to-transparent rounded-xl border border-green-500/20 text-center">
                            <i class="fas fa-file-medical text-green-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-sm">PHI Protection</p>
                            <p class="text-white/40 text-xs mt-1">Protected Health Information secured</p>
                        </div>
                        <div class="p-4 bg-gradient-to-b from-blue-500/10 to-transparent rounded-xl border border-blue-500/20 text-center">
                            <i class="fas fa-clipboard-check text-blue-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-sm">Regular Audits</p>
                            <p class="text-white/40 text-xs mt-1">Quarterly security assessments</p>
                        </div>
                        <div class="p-4 bg-gradient-to-b from-purple-500/10 to-transparent rounded-xl border border-purple-500/20 text-center">
                            <i class="fas fa-user-md text-purple-400 text-2xl mb-2"></i>
                            <p class="text-white font-bold text-sm">Staff Training</p>
                            <p class="text-white/40 text-xs mt-1">Annual compliance certification</p>
                        </div>
                    </div>
                </div>

                <!-- Contact for Compliance -->
                <div class="bg-gradient-to-r from-vital-teal/20 to-vital-orange/20 rounded-2xl p-6 border border-white/10 text-center">
                    <h3 class="text-white font-bold text-lg mb-2">Questions about our security practices?</h3>
                    <p class="text-white/60 text-sm mb-4">Our compliance team is happy to answer any questions</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="mailto:compliance@vitalnest.com" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-white font-semibold text-sm transition-all">
                            <i class="fas fa-envelope"></i>
                            <span>compliance@vitalnest.com</span>
                        </a>
                        <a href="#contact" id="compliance-contact-btn" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-vital-teal to-teal-600 rounded-xl text-white font-bold text-sm hover:shadow-lg hover:shadow-vital-teal/30 transition-all">
                            <i class="fas fa-comments"></i>
                            <span>Contact Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Nav scroll state */
    #main-nav.scrolled .absolute {
        background: rgba(15, 23, 42, 0.95);
    }

    /* Active nav link */
    .nav-link.active {
        background: rgba(255, 255, 255, 0.1);
        color: white;
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
        transform: translateY(0);
    }

    /* Menu trigger animation */
    #mobile-nav.active ~ header #bar1 {
        transform: rotate(45deg) translate(4px, 4px);
        width: 100%;
    }
    #mobile-nav.active ~ header #bar2 {
        opacity: 0;
    }
    #mobile-nav.active ~ header #bar3 {
        transform: rotate(-45deg) translate(4px, -4px);
        width: 100%;
    }

    /* Mobile nav item animations */
    .mobile-nav-item {
        opacity: 0;
        transform: translateX(-20px);
    }
    #mobile-nav.active .mobile-nav-item {
        animation: slideIn 0.4s ease forwards;
    }
    .mobile-nav-item:nth-child(1) { animation-delay: 0.1s; }
    .mobile-nav-item:nth-child(2) { animation-delay: 0.15s; }
    .mobile-nav-item:nth-child(3) { animation-delay: 0.2s; }
    .mobile-nav-item:nth-child(4) { animation-delay: 0.25s; }
    .mobile-nav-item:nth-child(5) { animation-delay: 0.3s; }
    .mobile-nav-item:nth-child(6) { animation-delay: 0.35s; }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
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

    /* Custom scrollbar for modal */
    #compliance-content::-webkit-scrollbar {
        width: 6px;
    }
    #compliance-content::-webkit-scrollbar-track {
        background: transparent;
    }
    #compliance-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
    #compliance-content::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainNav = document.getElementById('main-nav');
    const navTrigger = document.getElementById('nav-trigger');
    const mobileNav = document.getElementById('mobile-nav');
    const closeMobileNav = document.getElementById('close-mobile-nav');
    const mobileNavLinks = document.querySelectorAll('#mobile-nav-content a[href^="#"]');
    const navLinks = document.querySelectorAll('.nav-link');

    // Compliance Modal
    const complianceModal = document.getElementById('compliance-modal');
    const complianceTrigger = document.getElementById('compliance-trigger');
    const complianceTriggerMobile = document.getElementById('compliance-trigger-mobile');
    const closeCompliance = document.getElementById('close-compliance');
    const complianceBackdrop = document.getElementById('compliance-backdrop');
    const complianceContactBtn = document.getElementById('compliance-contact-btn');

    // Scroll handling
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;

        // Add scrolled class
        if (currentScroll > 50) {
            mainNav.classList.add('scrolled');
        } else {
            mainNav.classList.remove('scrolled');
        }

        // Update active section
        const sections = ['hero', 'services', 'packages', 'faq', 'contact'];
        let current = 'hero';

        sections.forEach(section => {
            const el = document.getElementById(section);
            if (el) {
                const rect = el.getBoundingClientRect();
                if (rect.top <= 150) {
                    current = section;
                }
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
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

    // Compliance Modal Toggle
    function openComplianceModal() {
        complianceModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        // Close mobile nav if open
        mobileNav.classList.remove('active');
    }

    function closeComplianceModal() {
        complianceModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (complianceTrigger) {
        complianceTrigger.addEventListener('click', openComplianceModal);
    }

    if (complianceTriggerMobile) {
        complianceTriggerMobile.addEventListener('click', openComplianceModal);
    }

    if (closeCompliance) {
        closeCompliance.addEventListener('click', closeComplianceModal);
    }

    if (complianceBackdrop) {
        complianceBackdrop.addEventListener('click', closeComplianceModal);
    }

    if (complianceContactBtn) {
        complianceContactBtn.addEventListener('click', closeComplianceModal);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && complianceModal.classList.contains('active')) {
            closeComplianceModal();
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80; // Account for fixed header
                const targetPosition = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

