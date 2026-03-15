<?php
/**
 * Footer — Promise over navigation
 * “If you need care, we show up.”
 */
?>

<footer class="relative bg-gradient-to-b from-teal-900/40 to-teal-950/90 text-white">
    <div class="max-w-6xl mx-auto px-6 py-24 text-center">

        <!-- Promise -->
        <p class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
            If you need care,<br class="sm:hidden">
            <span class="text-vital-orange">we show up.</span>
        </p>

        <!-- Quiet proof -->
        <ul class="mt-10 flex flex-wrap justify-center gap-x-10 gap-y-4 text-sm text-white/70">
            <li class="flex items-center gap-2">
                <!-- Shield icon -->
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l8 4v6c0 5-3.5 9-8 10-4.5-1-8-5-8-10V6l8-4z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
                Licensed clinicians
            </li>

            <li class="flex items-center gap-2">
                <!-- Home icon -->
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 10l9-7 9 7"/>
                    <path d="M5 10v10h14V10"/>
                </svg>
                Home visits
            </li>

            <li class="flex items-center gap-2">
                <!-- Check icon -->
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
                No shortcuts
            </li>
        </ul>

        <!-- Divider -->
        <div class="mt-16 flex justify-center">
            <div class="h-px w-20 bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
        </div>

        <!-- Meta -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3 text-xs text-white/50">
            <span>© <?= date('Y') ?> VitalNest Homecare</span>
            <span class="hidden sm:inline">•</span>
            <div class="flex gap-4">
                <a href="/privacy" class="hover:text-white transition">Privacy</a>
                <a href="/terms" class="hover:text-white transition">Terms</a>
                <a href="/medical-disclaimer" class="hover:text-white transition">
                    Medical Disclaimer
                </a>
            </div>
        </div>

    </div>
</footer>
