<?php
/**
 * Footer — Promise over navigation
 * "If you need care, we show up."
 */
?>

<footer class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-black text-white overflow-hidden">
    <!-- Animated Background Effects -->
    <div class="absolute inset-0">
        <!-- Gradient Orbs -->
        <div class="absolute top-20 -left-40 w-96 h-96 bg-vital-teal/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 -right-40 w-96 h-96 bg-vital-orange/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(15, 118, 110, 0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(15, 118, 110, 0.3) 1px, transparent 1px); background-size: 80px 80px;"></div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/50 to-black"></div>
    </div>


    <div class="relative z-10 max-w-6xl mx-auto px-6 py-16 text-center">

        <!-- Promise Statement -->
        <div class="relative inline-block mb-12">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
                When you need care,<br class="sm:hidden">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-vital-orange to-amber-500 animate-pulse">we show up.</span>
            </h2>
        </div>

        <!-- Trust Badges with Glassmorphism -->
        <div class="flex flex-wrap justify-center gap-6 mb-12">
            <div class="trust-badge-card group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal/20 to-cyan-500/10 rounded-xl flex items-center justify-center border border-vital-teal/20 group-hover:border-vital-teal/50 group-hover:bg-vital-teal/30 transition-all shadow-lg">
                        <svg class="w-6 h-6 text-vital-teal group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V6l8-4z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs text-white/40 uppercase tracking-wider font-semibold">Certified</p>
                        <p class="text-sm font-bold text-white">Licensed Clinicians</p>
                    </div>
                </div>
            </div>

            <div class="trust-badge-card group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-orange/20 to-amber-500/10 rounded-xl flex items-center justify-center border border-vital-orange/20 group-hover:border-vital-orange/50 group-hover:bg-vital-orange/30 transition-all shadow-lg">
                        <svg class="w-6 h-6 text-vital-orange group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 10l9-7 9 7"/>
                            <path d="M5 10v10h14V10"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs text-white/40 uppercase tracking-wider font-semibold">Available</p>
                        <p class="text-sm font-bold text-white">24/7 Home Visits</p>
                    </div>
                </div>
            </div>

            <div class="trust-badge-card group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/10 rounded-xl flex items-center justify-center border border-purple-500/20 group-hover:border-purple-500/50 group-hover:bg-purple-500/30 transition-all shadow-lg">
                        <svg class="w-6 h-6 text-purple-400 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs text-white/40 uppercase tracking-wider font-semibold">Commitment</p>
                        <p class="text-sm font-bold text-white">No Shortcuts</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Glowing Divider -->
        <div class="flex justify-center">
            <div class="relative">
                <div class="h-px w-48 bg-gradient-to-r from-transparent via-vital-teal to-transparent"></div>
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-px bg-vital-teal blur-md"></div>
            </div>
        </div>

        <!-- Legal Links -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm">
            <a href="privacy-policy.php" class="flex items-center gap-2 text-white/50 hover:text-vital-teal transition-colors group">
                <i class="fas fa-shield-halved text-vital-teal/70 group-hover:text-vital-teal"></i>
                <span>Privacy Policy</span>
            </a>
            <span class="text-white/20">|</span>
            <a href="terms-of-service.php" class="flex items-center gap-2 text-white/50 hover:text-vital-orange transition-colors group">
                <i class="fas fa-file-contract text-vital-orange/70 group-hover:text-vital-orange"></i>
                <span>Terms of Service</span>
            </a>
            <span class="text-white/20">|</span>
            <a href="cookie-policy.php" class="flex items-center gap-2 text-white/50 hover:text-purple-400 transition-colors group">
                <i class="fas fa-cookie-bite text-purple-400/70 group-hover:text-purple-400"></i>
                <span>Cookie Policy</span>
            </a>
        </div>

        <!-- Meta Information -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3 text-xs text-white/40">
            <div class="flex items-center gap-2">
                <i class="far fa-copyright"></i>
                <span><?= date('Y') ?></span>
                <span class="text-vital-teal font-semibold">VitalNest</span>
            </div>
            <span class="hidden sm:inline text-white/20">•</span>
            <span>All rights reserved</span>
            <span class="hidden sm:inline text-white/20">•</span>
            <span>Developed by</span>
            <a href="https://synavuetechnologies.com" target="_blank" rel="noopener noreferrer" class="text-vital-orange hover:text-vital-teal transition-colors font-semibold hover:underline">
                SynaVue Technologies
            </a>
        </div>

    </div>
</footer>

<style>
    /* Trust Badge Cards with Glassmorphism */
    .trust-badge-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .trust-badge-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15, 118, 110, 0.05), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .trust-badge-card:hover::before {
        opacity: 1;
    }

    .trust-badge-card:hover {
        transform: translateY(-4px);
        border-color: rgba(15, 118, 110, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
</style>

<script>
    // Smooth scroll for any anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
</body>
</html>
