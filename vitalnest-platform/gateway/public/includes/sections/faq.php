<!-- FAQ Section - Elegant Accordion Design -->
<section id="faq" class="relative py-20 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-10 w-64 h-64 bg-vital-teal/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-72 h-72 bg-vital-orange/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/[0.03] rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-white/[0.03] rounded-full"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full border border-white/10 mb-6">
                <div class="w-2 h-2 bg-vital-orange rounded-full animate-pulse"></div>
                <span class="text-white/70 text-xs font-bold uppercase tracking-widest">FAQ</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4">
                Got <span class="bg-gradient-to-r from-vital-orange via-amber-400 to-vital-teal bg-clip-text text-transparent">Questions?</span>
            </h2>
            <p class="text-white/40 max-w-lg mx-auto">
                Find quick answers to common questions about our home healthcare services
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-4">

            <!-- FAQ Item 1 -->
            <details class="faq-accordion group" open>
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-teal/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-calendar-check text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">How do I book a visit?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-vital-teal/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-vital-teal text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-vital-teal text-xs font-bold">1</span>
                                </div>
                                <p class="text-white/60 text-sm">Click "Book a Visit" or fill out our contact form</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-vital-teal text-xs font-bold">2</span>
                                </div>
                                <p class="text-white/60 text-sm">Tell us about your healthcare needs</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-vital-teal text-xs font-bold">3</span>
                                </div>
                                <p class="text-white/60 text-sm">Our coordinator confirms your schedule</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-vital-teal/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-vital-teal text-xs font-bold">4</span>
                                </div>
                                <p class="text-white/60 text-sm">Licensed professional visits your home</p>
                            </div>
                        </div>
                        <div class="bg-vital-teal/10 border border-vital-teal/20 rounded-xl p-4 flex flex-col justify-center">
                            <p class="text-vital-teal text-xs uppercase tracking-wider mb-2">Quick Contact</p>
                            <p class="text-white font-bold text-lg mb-1"><i class="fas fa-phone mr-2"></i>+254 746 511 327</p>
                            <p class="text-white/50 text-xs">Available 24/7</p>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 2 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-vital-orange to-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-orange/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-credit-card text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">What payment methods do you accept?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-vital-orange/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-vital-orange text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white/5 rounded-xl p-4 text-center hover:bg-white/10 transition-colors cursor-pointer border border-transparent hover:border-green-500/30">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-mobile-alt text-green-400 text-xl"></i>
                            </div>
                            <p class="text-white font-semibold text-sm">M-Pesa</p>
                            <p class="text-green-400 text-[10px] mt-1">Recommended</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center hover:bg-white/10 transition-colors cursor-pointer border border-transparent hover:border-blue-500/30">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-university text-blue-400 text-xl"></i>
                            </div>
                            <p class="text-white font-semibold text-sm">Bank Transfer</p>
                            <p class="text-white/40 text-[10px] mt-1">Direct deposit</p>
                        </div>
                        <div class="bg-white/5 rounded-xl p-4 text-center opacity-50 cursor-not-allowed">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-credit-card text-purple-400 text-xl"></i>
                            </div>
                            <p class="text-white font-semibold text-sm">Cards</p>
                            <p class="text-white/40 text-[10px] mt-1">Coming soon</p>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 3 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg shadow-purple-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-box-open text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">Which package should I choose?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-purple-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-purple-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="bg-gradient-to-b from-vital-teal/20 to-transparent rounded-xl p-4 border border-vital-teal/20">
                            <p class="text-vital-teal font-black text-xs mb-2">BASIC</p>
                            <p class="text-white font-bold text-lg">25K<span class="text-white/40 text-xs">/mo</span></p>
                            <p class="text-white/50 text-[10px] mt-2">Routine checkups & preventive care</p>
                        </div>
                        <div class="bg-gradient-to-b from-vital-orange/20 to-transparent rounded-xl p-4 border border-vital-orange/20">
                            <p class="text-vital-orange font-black text-xs mb-2">STANDARD</p>
                            <p class="text-white font-bold text-lg">50K<span class="text-white/40 text-xs">/mo</span></p>
                            <p class="text-white/50 text-[10px] mt-2">Chronic disease management</p>
                        </div>
                        <div class="bg-gradient-to-b from-amber-500/20 to-transparent rounded-xl p-4 border border-amber-500/20 relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-amber-500 text-[8px] text-white px-2 py-0.5 rounded-bl-lg font-bold">POPULAR</div>
                            <p class="text-amber-400 font-black text-xs mb-2">PREMIUM</p>
                            <p class="text-white font-bold text-lg">200K<span class="text-white/40 text-xs">/mo</span></p>
                            <p class="text-white/50 text-[10px] mt-2">Daily intensive care</p>
                        </div>
                        <div class="bg-gradient-to-b from-rose-500/20 to-transparent rounded-xl p-4 border border-rose-500/20">
                            <p class="text-rose-400 font-black text-xs mb-2">MATERNAL</p>
                            <p class="text-white font-bold text-lg">50K<span class="text-white/40 text-xs">/tri</span></p>
                            <p class="text-white/50 text-[10px] mt-2">Pregnancy & postnatal</p>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 4 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">Is my data secure and private?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-green-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-green-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="flex items-center justify-center gap-6 flex-wrap">
                        <div class="text-center">
                            <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mx-auto mb-2 border border-green-500/20">
                                <i class="fas fa-lock text-green-400 text-xl"></i>
                            </div>
                            <p class="text-white/70 text-xs">HIPAA<br>Compliant</p>
                        </div>
                        <div class="text-center">
                            <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mx-auto mb-2 border border-green-500/20">
                                <i class="fas fa-key text-green-400 text-xl"></i>
                            </div>
                            <p class="text-white/70 text-xs">End-to-End<br>Encrypted</p>
                        </div>
                        <div class="text-center">
                            <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mx-auto mb-2 border border-green-500/20">
                                <i class="fas fa-user-shield text-green-400 text-xl"></i>
                            </div>
                            <p class="text-white/70 text-xs">Access<br>Controls</p>
                        </div>
                        <div class="text-center">
                            <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mx-auto mb-2 border border-green-500/20">
                                <i class="fas fa-history text-green-400 text-xl"></i>
                            </div>
                            <p class="text-white/70 text-xs">Audit<br>Trails</p>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 5 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-ambulance text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">What if I have an emergency?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-red-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-red-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="bg-gradient-to-r from-red-500/20 to-rose-500/20 border border-red-500/30 rounded-2xl p-6 text-center">
                        <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                            <i class="fas fa-phone-alt text-red-400 text-2xl"></i>
                        </div>
                        <p class="text-white font-black text-2xl mb-2">+254 746 511 327</p>
                        <p class="text-red-300 font-semibold text-sm mb-3">24/7 Emergency Hotline</p>
                        <p class="text-white/50 text-xs">For life-threatening emergencies, also call <span class="text-white">999</span> or <span class="text-white">112</span></p>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 6 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-user-md text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">Are your staff really licensed?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-blue-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-blue-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="flex items-center gap-2 bg-white/5 rounded-lg p-3">
                            <i class="fas fa-check-circle text-vital-teal"></i>
                            <span class="text-white/70 text-xs">Licensed & Certified</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-lg p-3">
                            <i class="fas fa-check-circle text-vital-teal"></i>
                            <span class="text-white/70 text-xs">Background Checked</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-lg p-3">
                            <i class="fas fa-check-circle text-vital-teal"></i>
                            <span class="text-white/70 text-xs">Continuously Trained</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-lg p-3">
                            <i class="fas fa-check-circle text-vital-teal"></i>
                            <span class="text-white/70 text-xs">Fully Insured</span>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 7 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">How often will I be visited?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-indigo-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-indigo-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="overflow-hidden rounded-xl border border-white/10">
                        <div class="grid grid-cols-2 bg-white/5">
                            <div class="p-3 text-white/40 text-xs font-semibold uppercase border-b border-r border-white/10">Package</div>
                            <div class="p-3 text-white/40 text-xs font-semibold uppercase border-b border-white/10">Visit Frequency</div>
                        </div>
                        <div class="grid grid-cols-2 hover:bg-white/5 transition-colors">
                            <div class="p-3 text-vital-teal font-semibold text-sm border-b border-r border-white/10">Basic</div>
                            <div class="p-3 text-white/60 text-sm border-b border-white/10">1x per week</div>
                        </div>
                        <div class="grid grid-cols-2 hover:bg-white/5 transition-colors">
                            <div class="p-3 text-vital-orange font-semibold text-sm border-b border-r border-white/10">Standard</div>
                            <div class="p-3 text-white/60 text-sm border-b border-white/10">1x per week + on-call</div>
                        </div>
                        <div class="grid grid-cols-2 hover:bg-white/5 transition-colors">
                            <div class="p-3 text-amber-400 font-semibold text-sm border-b border-r border-white/10">Premium</div>
                            <div class="p-3 text-white/60 text-sm border-b border-white/10">Daily + on-call</div>
                        </div>
                        <div class="grid grid-cols-2 hover:bg-white/5 transition-colors">
                            <div class="p-3 text-rose-400 font-semibold text-sm border-r border-white/10">Maternal</div>
                            <div class="p-3 text-white/60 text-sm">1-2x per week</div>
                        </div>
                    </div>
                </div>
            </details>

            <!-- FAQ Item 8 -->
            <details class="faq-accordion group">
                <summary class="faq-trigger">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20 group-open:rotate-6 transition-transform duration-300">
                            <i class="fas fa-flask text-white"></i>
                        </div>
                        <span class="text-white font-bold text-base md:text-lg">Do you offer lab services?</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-open:bg-amber-500/20 transition-colors">
                        <i class="fas fa-plus text-white/50 text-sm group-open:hidden"></i>
                        <i class="fas fa-minus text-amber-400 text-sm hidden group-open:block"></i>
                    </div>
                </summary>
                <div class="faq-answer">
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-4 py-2 bg-vital-teal/10 border border-vital-teal/20 text-vital-teal text-sm font-semibold rounded-full">Full Hemogram</span>
                        <span class="px-4 py-2 bg-vital-orange/10 border border-vital-orange/20 text-vital-orange text-sm font-semibold rounded-full">Blood Sugar</span>
                        <span class="px-4 py-2 bg-purple-500/10 border border-purple-500/20 text-purple-400 text-sm font-semibold rounded-full">UECs</span>
                        <span class="px-4 py-2 bg-green-500/10 border border-green-500/20 text-green-400 text-sm font-semibold rounded-full">LFTs</span>
                        <span class="px-4 py-2 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-semibold rounded-full">X-ray</span>
                        <span class="px-4 py-2 bg-pink-500/10 border border-pink-500/20 text-pink-400 text-sm font-semibold rounded-full">Urinalysis</span>
                    </div>
                    <p class="text-center text-white/40 text-sm"><i class="fas fa-clock mr-2"></i>Results delivered within 24-48 hours</p>
                </div>
            </details>

        </div>

        <!-- Still have questions CTA -->
        <div class="mt-14 text-center">
            <div class="inline-block relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-vital-teal via-purple-500 to-vital-orange rounded-2xl blur opacity-30"></div>
                <div class="relative bg-slate-900/90 backdrop-blur-xl rounded-2xl border border-white/10 p-6 flex flex-col sm:flex-row items-center gap-5">
                    <div class="w-14 h-14 bg-gradient-to-br from-vital-teal to-vital-orange rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-headset text-white text-xl"></i>
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="text-white font-bold text-lg">Still have questions?</h3>
                        <p class="text-white/50 text-sm">Our support team is available 24/7</p>
                    </div>
                    <a href="#contact" class="px-6 py-3 bg-gradient-to-r from-vital-teal to-teal-600 text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-vital-teal/30 hover:-translate-y-0.5 transition-all duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .faq-accordion {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-accordion:hover {
        background: rgba(255,255,255,0.04);
        border-color: rgba(255,255,255,0.1);
    }

    .faq-accordion[open] {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.15);
    }

    .faq-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem;
        cursor: pointer;
        list-style: none;
    }

    .faq-trigger::-webkit-details-marker {
        display: none;
    }

    .faq-answer {
        padding: 0 1.25rem 1.25rem 1.25rem;
        animation: faqSlideDown 0.3s ease;
    }

    @keyframes faqSlideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


