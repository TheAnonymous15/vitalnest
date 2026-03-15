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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full border border-white/10 mb-6">
                <div class="w-2 h-2 bg-vital-orange rounded-full animate-pulse"></div>
                <span class="text-white/70 text-xs font-bold uppercase tracking-widest">FAQ</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-4">
                Got <span class="text-vital-teal">Questions?</span>
            </h2>
            <p class="text-white/40 max-w-lg mx-auto">
                Find quick answers to common questions about our home healthcare services
            </p>
        </div>

        <!-- FAQ Three Column Layout -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left Column - Questions 1-4 -->
            <div class="bg-gradient-to-br from-white/[0.03] to-white/[0.01] backdrop-blur-xl border border-white/10 rounded-2xl p-4 space-y-3">

                <!-- FAQ Item 1 -->
                <button class="faq-question-card group w-full text-left active" onclick="showFaqAnswer(1)" data-faq="1">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-teal to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-vital-teal/20">
                            <i class="fas fa-calendar-check text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">How do I book a visit?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-vital-teal transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 2 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(2)" data-faq="2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-vital-orange/20">
                            <i class="fas fa-credit-card text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">What payment methods do you accept?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-vital-orange transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 3 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(3)" data-faq="3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/20">
                            <i class="fas fa-box-open text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">Which package should I choose?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-purple-400 transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 4 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(4)" data-faq="4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/20">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">Is my data secure and private?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-green-400 transition-colors"></i>
                    </div>
                </button>

            </div>
            <!-- End Left Column -->

            <!-- Center Column - Questions 5-8 -->
            <div class="bg-gradient-to-br from-white/[0.03] to-white/[0.01] backdrop-blur-xl border border-white/10 rounded-2xl p-4 space-y-3">

                <!-- FAQ Item 5 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(5)" data-faq="5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-rose-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20">
                            <i class="fas fa-ambulance text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">What if I have an emergency?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-red-400 transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 6 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(6)" data-faq="6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <i class="fas fa-user-md text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">Are your staff really licensed?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-blue-400 transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 7 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(7)" data-faq="7">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-clock text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">How often will I be visited?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-indigo-400 transition-colors"></i>
                    </div>
                </button>

                <!-- FAQ Item 8 -->
                <button class="faq-question-card group w-full text-left" onclick="showFaqAnswer(8)" data-faq="8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                            <i class="fas fa-flask text-white text-sm"></i>
                        </div>
                        <span class="text-white font-bold text-sm flex-1">Do you offer lab services?</span>
                        <i class="fas fa-chevron-right text-white/30 text-xs group-hover:text-amber-400 transition-colors"></i>
                    </div>
                </button>

            </div>
            <!-- End Center Column -->

            <!-- Right Column - Reading Card -->
            <div class="lg:sticky lg:top-6 h-fit">
                <div class="faq-reading-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl p-6 min-h-[400px]">

                    <!-- FAQ Answer 1 -->
                    <div class="faq-answer-content active" data-answer="1">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-vital-teal/20">
                                <i class="fas fa-calendar-check text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">How do I book a visit?</h3>
                        </div>
                        <div class="space-y-4">
                            <p class="text-white/60 text-sm">Simply call us or click the "Contact Us" button to reach out via your preferred channel. We're available 24/7 to schedule your visit.</p>
                            <div class="bg-vital-teal/10 border border-vital-teal/20 rounded-xl p-4">
                                <p class="text-vital-teal text-xs uppercase tracking-wider mb-2">Quick Contact</p>
                                <p class="text-white font-bold text-lg mb-1"><i class="fas fa-phone mr-2"></i>+254 746 511 327</p>
                                <p class="text-white/50 text-xs">Available 24/7</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Answer 2 -->
                    <div class="faq-answer-content hidden" data-answer="2">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-vital-orange to-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-vital-orange/20">
                                <i class="fas fa-credit-card text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">What payment methods do you accept?</h3>
                        </div>
                        <p class="text-white/60 text-sm">We accept M-Pesa, bank transfers, and major insurance providers. Payment plans are available for long-term care packages.</p>
                    </div>

                    <!-- FAQ Answer 3 -->
                    <div class="faq-answer-content hidden" data-answer="3">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/20">
                                <i class="fas fa-box-open text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">Which package should I choose?</h3>
                        </div>
                        <p class="text-white/60 text-sm">Choose based on your needs: Basic for routine care, Standard for chronic conditions, Premium for daily intensive care, or Maternal for pregnancy support. Contact us for personalized recommendations.</p>
                    </div>

                    <!-- FAQ Answer 4 -->
                    <div class="faq-answer-content hidden" data-answer="4">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/20">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">Is my data secure and private?</h3>
                        </div>
                        <p class="text-white/60 text-sm">Absolutely. We use end-to-end encryption, strict access controls, and comply with healthcare data protection regulations. Your privacy is our priority.</p>
                    </div>

                    <!-- FAQ Answer 5 -->
                    <div class="faq-answer-content hidden" data-answer="5">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20">
                                <i class="fas fa-ambulance text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">What if I have an emergency?</h3>
                        </div>
                        <div class="bg-gradient-to-r from-red-500/20 to-rose-500/20 border border-red-500/30 rounded-2xl p-6 text-center">
                            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                                <i class="fas fa-phone-alt text-red-400 text-2xl"></i>
                            </div>
                            <p class="text-white font-black text-2xl mb-2">+254 746 511 327</p>
                            <p class="text-red-300 font-semibold text-sm mb-3">24/7 Emergency Hotline</p>
                            <p class="text-white/50 text-xs">For life-threatening emergencies, also call 999 or 112</p>
                        </div>
                    </div>

                    <!-- FAQ Answer 6 -->
                    <div class="faq-answer-content hidden" data-answer="6">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <i class="fas fa-user-md text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">Are your staff really licensed?</h3>
                        </div>
                        <p class="text-white/60 text-sm">Yes! All our healthcare professionals are licensed, certified, background-checked, continuously trained, and fully insured. We only work with qualified medical experts.</p>
                    </div>

                    <!-- FAQ Answer 7 -->
                    <div class="faq-answer-content hidden" data-answer="7">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">How often will I be visited?</h3>
                        </div>
                        <p class="text-white/60 text-sm">Visit frequency depends on your package: Basic (1x/week), Standard (1x/week + on-call), Premium (daily + on-call), Maternal (1-2x/week). Customize as needed.</p>
                    </div>

                    <!-- FAQ Answer 8 -->
                    <div class="faq-answer-content hidden" data-answer="8">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/10">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                                <i class="fas fa-flask text-white"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg">Do you offer lab services?</h3>
                        </div>
                        <p class="text-white/60 text-sm">Yes! We offer comprehensive lab services including blood tests, urinalysis, X-rays, and more. Samples are collected at home with results delivered within 24-48 hours.</p>
                    </div>

                </div>
            </div>
            <!-- End Right Column -->

        </div>
        <!-- End FAQ Grid -->

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
                    <button onclick="openContactModal()" class="px-6 py-3 bg-gradient-to-r from-vital-teal to-teal-600 text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-vital-teal/30 hover:-translate-y-0.5 transition-all duration-300">
                        Contact Us
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/70 backdrop-blur-md">
    <div class="contact-modal-container relative w-full max-w-4xl">
        <!-- Decorative Background Elements -->
        <div class="absolute -top-8 -left-8 w-32 h-32 bg-vital-teal/10 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-vital-orange/10 rounded-full blur-2xl animate-pulse"></div>

        <!-- Modal Content -->
        <div class="relative bg-gradient-to-br from-slate-900/95 via-slate-800/95 to-slate-900/95 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl overflow-hidden">

            <!-- Close Button -->
            <button onclick="closeContactModal()" class="absolute top-4 right-4 w-8 h-8 bg-white/5 hover:bg-white/10 rounded-full flex items-center justify-center transition-all duration-300 z-10 group">
                <i class="fas fa-times text-white/60 group-hover:text-white transition-colors text-sm"></i>
            </button>

            <div class="grid md:grid-cols-2">

                <!-- Left Side - Contact Info & Brand -->
                <div class="bg-gradient-to-br from-vital-teal/10 to-vital-orange/10 p-8 md:p-10 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-5">
                        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 mb-4">
                            <div class="w-1.5 h-1.5 bg-vital-teal rounded-full animate-pulse"></div>
                            <span class="text-white/90 text-[10px] font-bold uppercase tracking-widest">Get In Touch</span>
                        </div>

                        <h3 class="text-3xl font-black text-white mb-3">
                            Let's Start Your <span class="bg-gradient-to-r from-vital-teal to-vital-orange bg-clip-text text-transparent">Healthcare Journey</span>
                        </h3>
                        <p class="text-white/60 text-sm mb-6">
                            Our team is ready to provide exceptional home healthcare services. Reach out anytime!
                        </p>

                        <!-- Contact Methods -->
                        <div class="space-y-4">
                            <a href="tel:+254746511327" class="flex items-start gap-3 group cursor-pointer">
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all duration-300">
                                    <i class="fas fa-phone-alt text-vital-teal text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-white/40 text-[10px] uppercase tracking-wider mb-0.5">Phone</p>
                                    <p class="text-white font-bold text-sm">+254 746 511 327</p>
                                    <p class="text-vital-teal text-[10px]">Available 24/7</p>
                                </div>
                            </a>

                            <a href="mailto:info@vitalnest.com" class="flex items-start gap-3 group cursor-pointer">
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-vital-orange/30 transition-all duration-300">
                                    <i class="fas fa-envelope text-vital-orange text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-white/40 text-[10px] uppercase tracking-wider mb-0.5">Email</p>
                                    <p class="text-white font-bold text-sm">info@vitalnest.com</p>
                                    <p class="text-vital-orange text-[10px]">Response within 2 hours</p>
                                </div>
                            </a>

                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-purple-400 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-white/40 text-[10px] uppercase tracking-wider mb-0.5">Location</p>
                                    <p class="text-white font-bold text-sm">Nairobi, Kenya</p>
                                    <p class="text-purple-400 text-[10px]">Serving all counties</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-6 pt-6 border-t border-white/10">
                            <p class="text-white/40 text-[10px] uppercase tracking-wider mb-3">Follow Us</p>
                            <div class="flex gap-2">
                                <a href="#" class="w-8 h-8 bg-white/5 hover:bg-vital-teal/20 border border-white/10 hover:border-vital-teal/30 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                    <i class="fab fa-facebook-f text-white/60 group-hover:text-vital-teal transition-colors text-xs"></i>
                                </a>
                                <a href="#" class="w-8 h-8 bg-white/5 hover:bg-vital-teal/20 border border-white/10 hover:border-vital-teal/30 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                    <i class="fab fa-twitter text-white/60 group-hover:text-vital-teal transition-colors text-xs"></i>
                                </a>
                                <a href="#" class="w-8 h-8 bg-white/5 hover:bg-vital-teal/20 border border-white/10 hover:border-vital-teal/30 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                    <i class="fab fa-instagram text-white/60 group-hover:text-vital-teal transition-colors text-xs"></i>
                                </a>
                                <a href="#" class="w-8 h-8 bg-white/5 hover:bg-vital-teal/20 border border-white/10 hover:border-vital-teal/30 rounded-lg flex items-center justify-center transition-all duration-300 group">
                                    <i class="fab fa-linkedin-in text-white/60 group-hover:text-vital-teal transition-colors text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="p-6 md:p-8">
                    <form id="contactForm" class="space-y-4">

                        <!-- Name Input -->
                        <div class="space-y-1.5">
                            <label for="contactName" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-user text-vital-teal text-[10px]"></i>
                                Full Name
                            </label>
                            <input
                                type="text"
                                id="contactName"
                                name="name"
                                required
                                placeholder="Enter your name"
                                class="w-full px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder:text-white/30 focus:bg-white/10 focus:border-vital-teal focus:outline-none transition-all duration-300"
                            >
                        </div>

                        <!-- Email Input -->
                        <div class="space-y-1.5">
                            <label for="contactEmail" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-envelope text-vital-orange text-[10px]"></i>
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="contactEmail"
                                name="email"
                                required
                                placeholder="your.email@example.com"
                                class="w-full px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder:text-white/30 focus:bg-white/10 focus:border-vital-orange focus:outline-none transition-all duration-300"
                            >
                        </div>

                        <!-- Phone Input with Country Code -->
                        <div class="space-y-1.5">
                            <label for="contactPhone" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-phone text-purple-400 text-[10px]"></i>
                                Phone Number
                            </label>
                            <div class="flex gap-2">
                                <!-- Country Code Selector -->
                                <select
                                    id="countryCode"
                                    name="countryCode"
                                    class="w-32 px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:bg-white/10 focus:border-purple-400 focus:outline-none transition-all duration-300"
                                >
                                    <option value="+254" selected>🇰🇪 +254</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+91">🇮🇳 +91</option>
                                    <option value="+86">🇨🇳 +86</option>
                                    <option value="+81">🇯🇵 +81</option>
                                    <option value="+49">🇩🇪 +49</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+39">🇮🇹 +39</option>
                                    <option value="+34">🇪🇸 +34</option>
                                    <option value="+61">🇦🇺 +61</option>
                                    <option value="+27">🇿🇦 +27</option>
                                    <option value="+234">🇳🇬 +234</option>
                                    <option value="+20">🇪🇬 +20</option>
                                    <option value="+255">🇹🇿 +255</option>
                                    <option value="+256">🇺🇬 +256</option>
                                    <option value="+250">🇷🇼 +250</option>
                                </select>

                                <!-- Phone Number Input -->
                                <input
                                    type="tel"
                                    id="contactPhone"
                                    name="phone"
                                    required
                                    placeholder="712 345 678"
                                    pattern="[0-9\s]{9,15}"
                                    class="flex-1 px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder:text-white/30 focus:bg-white/10 focus:border-purple-400 focus:outline-none transition-all duration-300"
                                >
                            </div>
                        </div>

                        <!-- Subject Input -->
                        <div class="space-y-1.5">
                            <label for="contactSubject" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-tag text-cyan-400 text-[10px]"></i>
                                Subject
                            </label>
                            <input
                                type="text"
                                id="contactSubject"
                                name="subject"
                                required
                                placeholder="What can we help you with?"
                                class="w-full px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder:text-white/30 focus:bg-white/10 focus:border-cyan-400 focus:outline-none transition-all duration-300"
                            >
                        </div>

                        <!-- Priority Level Selector -->
                        <div class="space-y-1.5">
                            <label for="contactPriority" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-flag text-amber-400 text-[10px]"></i>
                                Priority Level
                            </label>
                            <div class="grid grid-cols-3 gap-2">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="priority" value="normal" checked class="peer sr-only" />
                                    <div class="px-3 py-2 bg-white/5 border-2 border-blue-500/30 rounded-lg text-center transition-all peer-checked:bg-blue-500/20 peer-checked:border-blue-400/50 hover:bg-white/10">
                                        <i class="fas fa-info-circle text-blue-400 text-sm mb-1"></i>
                                        <p class="text-white text-xs font-semibold">Normal</p>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="priority" value="medium" class="peer sr-only" />
                                    <div class="px-3 py-2 bg-white/5 border-2 border-amber-500/30 rounded-lg text-center transition-all peer-checked:bg-amber-500/20 peer-checked:border-amber-400/50 hover:bg-white/10">
                                        <i class="fas fa-exclamation-triangle text-amber-400 text-sm mb-1"></i>
                                        <p class="text-white text-xs font-semibold">Medium</p>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="priority" value="high" class="peer sr-only" />
                                    <div class="px-3 py-2 bg-white/5 border-2 border-red-500/30 rounded-lg text-center transition-all peer-checked:bg-red-500/20 peer-checked:border-red-400/50 hover:bg-white/10">
                                        <i class="fas fa-exclamation-circle text-red-400 text-sm mb-1"></i>
                                        <p class="text-white text-xs font-semibold">High</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Message Textarea -->
                        <div class="space-y-1.5">
                            <label for="contactMessage" class="text-white/70 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fas fa-comment-dots text-green-400 text-[10px]"></i>
                                Message
                            </label>
                            <textarea
                                id="contactMessage"
                                name="message"
                                required
                                rows="2"
                                placeholder="Tell us your needs..."
                                class="w-full px-3 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder:text-white/30 focus:bg-white/10 focus:border-green-400 focus:outline-none transition-all duration-300 resize-none"
                            ></textarea>
                        </div>

                        <!-- Communication Channels Grid -->
                        <div class="pt-3 border-t border-white/10">
                            <p class="text-white/50 text-[10px] uppercase tracking-wider mb-3 text-center font-semibold">Contact Via</p>

                            <!-- Direct Message Button (Full Width - Top) -->
                            <button
                                type="submit"
                                class="w-full contact-channel-btn group bg-white/5 backdrop-blur-md hover:bg-white/10 border border-purple-500/30 hover:border-purple-400/50 rounded-lg p-2.5 transition-all duration-300 mb-2"
                            >
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-7 h-7 bg-gradient-to-br from-purple-400/20 to-purple-500/10 group-hover:from-purple-400/30 group-hover:to-purple-500/20 rounded-lg flex items-center justify-center transition-all duration-300">
                                        <i class="fas fa-comment-dots text-purple-300 text-sm"></i>
                                    </div>
                                    <span class="text-white font-semibold text-sm">Send Direct Message</span>
                                </div>
                            </button>

                            <!-- WhatsApp and Call (Side by Side - Bottom) -->
                            <div class="grid grid-cols-2 gap-2">
                                <!-- WhatsApp Button -->
                                <button
                                    type="button"
                                    onclick="initiateWhatsApp()"
                                    class="contact-channel-btn group bg-white/5 backdrop-blur-md hover:bg-white/10 border border-emerald-500/30 hover:border-emerald-400/50 rounded-lg p-2.5 transition-all duration-300"
                                >
                                    <div class="flex items-center justify-center gap-1.5">
                                        <div class="w-7 h-7 bg-gradient-to-br from-emerald-400/20 to-emerald-500/10 group-hover:from-emerald-400/30 group-hover:to-emerald-500/20 rounded-lg flex items-center justify-center transition-all duration-300">
                                            <i class="fab fa-whatsapp text-emerald-300 text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-xs">WhatsApp</span>
                                    </div>
                                </button>

                                <!-- Call Button -->
                                <button
                                    type="button"
                                    onclick="initiateCall()"
                                    class="contact-channel-btn group bg-white/5 backdrop-blur-md hover:bg-white/10 border border-green-500/30 hover:border-green-400/50 rounded-lg p-2.5 transition-all duration-300"
                                >
                                    <div class="flex items-center justify-center gap-1.5">
                                        <div class="w-7 h-7 bg-gradient-to-br from-green-400/20 to-green-500/10 group-hover:from-green-400/30 group-hover:to-green-500/20 rounded-lg flex items-center justify-center transition-all duration-300">
                                            <i class="fas fa-phone-alt text-green-300 text-xs"></i>
                                        </div>
                                        <span class="text-white font-semibold text-xs">Call Us</span>
                                    </div>
                                </button>

                            </div>
                        </div>

                        <!-- Quick Contact Info -->
                        <div class="pt-3 border-t border-white/10">
                            <div class="flex items-center justify-center gap-4 text-xs">
                                <a href="tel:+254746511327" class="text-vital-teal hover:text-vital-teal/80 transition-colors flex items-center gap-1.5">
                                    <i class="fas fa-phone-alt text-[10px]"></i>
                                    <span>+254 746 511 327</span>
                                </a>
                                <span class="text-white/20">|</span>
                                <span class="text-white/40">24/7 Available</span>
                            </div>
                        </div>

                        <!-- Success/Info Message (Hidden by default) -->
                        <div id="contactSuccessMessage" class="hidden bg-green-500/10 border border-green-500/30 rounded-lg p-3 text-center">
                            <i class="fas fa-check-circle text-green-400 text-lg mb-1"></i>
                            <p class="text-green-400 font-semibold text-sm" id="successMessageText">Opening your preferred channel...</p>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .faq-question-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 1rem;
        padding: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .faq-question-card:hover {
        background: rgba(255,255,255,0.04);
        border-color: rgba(255,255,255,0.1);
        transform: translateX(4px);
    }

    .faq-question-card.active {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.15);
    }

    .faq-reading-card {
        position: relative;
        overflow: hidden;
    }

    .faq-answer-content {
        animation: fadeIn 0.4s ease;
    }

    .faq-answer-content.hidden {
        display: none;
    }

    .faq-answer-content.active {
        display: block;
    }

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

    /* Contact Modal Styles */
    #contactModal {
        animation: modalFadeIn 0.3s ease;
    }

    #contactModal.show {
        display: flex !important;
    }

    .contact-modal-container {
        animation: modalSlideUp 0.4s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Custom scrollbar for modal */
    #contactModal ::-webkit-scrollbar {
        width: 8px;
    }

    #contactModal ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    #contactModal ::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }

    #contactModal ::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Form input focus glow effects */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    /* Contact Channel Buttons - 3D Effect */
    .contact-channel-btn {
        position: relative;
        overflow: hidden;
        transform-style: preserve-3d;
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.3),
            0 2px 4px -1px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
    }

    .contact-channel-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        border-radius: inherit;
        pointer-events: none;
    }

    .contact-channel-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
        pointer-events: none;
    }

    .contact-channel-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 15px -3px rgba(0, 0, 0, 0.4),
            0 4px 6px -2px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.15);
    }

    .contact-channel-btn:hover::after {
        width: 200px;
        height: 200px;
    }

    .contact-channel-btn:active {
        transform: translateY(0px) scale(0.98);
        box-shadow:
            0 2px 4px -1px rgba(0, 0, 0, 0.3),
            0 1px 2px -1px rgba(0, 0, 0, 0.2),
            inset 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }

    /* 3D Icon Circles */
    .contact-channel-btn .w-8 {
        box-shadow:
            0 2px 4px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transform: translateZ(10px);
    }

    .contact-channel-btn:hover .w-8 {
        transform: translateZ(15px) scale(1.05);
        box-shadow:
            0 4px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Result Modal Animation */
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-scale-in {
        animation: scaleIn 0.3s ease-out forwards;
    }
</style>

<script>

function showFaqAnswer(faqNumber) {
    // Remove active class from all question cards
    document.querySelectorAll('.faq-question-card').forEach(card => {
        card.classList.remove('active');
    });

    // Add active class to clicked card
    const clickedCard = document.querySelector(`[data-faq="${faqNumber}"]`);
    if (clickedCard) {
        clickedCard.classList.add('active');
    }

    // Hide all answers
    document.querySelectorAll('.faq-answer-content').forEach(answer => {
        answer.classList.remove('active');
        answer.classList.add('hidden');
    });

    // Show selected answer
    const selectedAnswer = document.querySelector(`[data-answer="${faqNumber}"]`);
    if (selectedAnswer) {
        selectedAnswer.classList.remove('hidden');
        selectedAnswer.classList.add('active');
    }
}

// Contact Modal Functions
function openContactModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

function closeContactModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Match animation duration
        document.body.style.overflow = ''; // Restore scrolling
    }
}

// Get form data helper
function getFormData() {
    const name = document.getElementById('contactName')?.value || '';
    const countryCode = document.getElementById('countryCode')?.value || '+254';
    const phoneNumber = document.getElementById('contactPhone')?.value || '';
    const phone = phoneNumber ? `${countryCode}${phoneNumber.replace(/\s/g, '')}` : ''; // Combine country code with phone, remove spaces
    const email = document.getElementById('contactEmail')?.value || '';
    const subject = document.getElementById('contactSubject')?.value || '';
    const message = document.getElementById('contactMessage')?.value || '';
    const priority = document.querySelector('input[name="priority"]:checked')?.value || 'normal';
    return { name, phone, email, subject, message, priority };
}

// Handle form submission - Save to database via notification service
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn?.innerHTML || '';

            // Get form data
            const formData = getFormData();

            // Validate required fields
            if (!formData.name.trim()) {
                showResultModal(false, 'Please enter your name');
                document.getElementById('contactName')?.focus();
                return;
            }

            if (!formData.email.trim()) {
                showResultModal(false, 'Please enter your email address');
                document.getElementById('contactEmail')?.focus();
                return;
            }

            if (!formData.phone.trim()) {
                showResultModal(false, 'Please enter your phone number');
                document.getElementById('contactPhone')?.focus();
                return;
            }

            if (!formData.subject.trim()) {
                showResultModal(false, 'Please enter a subject');
                document.getElementById('contactSubject')?.focus();
                return;
            }

            if (!formData.message.trim()) {
                showResultModal(false, 'Please enter your message');
                document.getElementById('contactMessage')?.focus();
                return;
            }

            // Show rotating progress for 2 seconds
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<div class="flex items-center justify-center gap-2"><i class="fas fa-circle-notch fa-spin text-lg"></i><span>Sending...</span></div>';
            }

            // Wait 2 seconds to show progress
            await new Promise(resolve => setTimeout(resolve, 2000));

            try {
                // Send to notification service
                const response = await fetch('http://localhost:9033/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: formData.name.trim(),
                        email: formData.email.trim(),
                        phone: formData.phone.trim(),
                        subject: formData.subject.trim(),
                        message: formData.message.trim(),
                        priority: formData.priority
                    })
                });

                // Check if response is ok
                if (!response.ok) {
                    throw new Error('SERVICE_ERROR');
                }

                const result = await response.json();

                if (result.success) {
                    // Show success modal
                    showResultModal(true, 'Your message has been sent successfully! Our team will get back to you within 24 hours.');

                    // Reset form
                    contactForm.reset();

                    // Close contact modal after showing result
                    setTimeout(() => {
                        closeContactModal();
                    }, 3000);
                } else {
                    // Show fail modal with user-friendly message
                    showResultModal(false, result.message || 'Unable to send your message at this time. Please try again or call us directly.');
                }
            } catch (error) {
                console.error('Error sending message:', error);

                // User-friendly error messages - no technical details exposed
                let userMessage = 'We\'re experiencing technical difficulties. Please try one of these alternatives:\n\n';
                userMessage += '📞 Call us: +254 746 511 327 (24/7)\n';
                userMessage += '💬 WhatsApp: Click the WhatsApp button below\n';
                userMessage += '📧 Email: info@vitalnest.com';

                showResultModal(false, userMessage);
            } finally {
                // Re-enable submit button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            }
        });
    }
});

// Show result modal (success or fail)
function showResultModal(success, message) {
    // Create modal
    const modal = document.createElement('div');
    modal.id = 'resultModal';
    modal.className = 'fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/70 backdrop-blur-md';

    modal.innerHTML = `
        <div class="relative w-full max-w-md transform transition-all animate-scale-in">
            <div class="relative bg-gradient-to-br from-slate-800/95 to-slate-900/95 backdrop-blur-xl rounded-3xl border ${success ? 'border-green-500/30' : 'border-red-500/30'} shadow-2xl overflow-hidden">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r ${success ? 'from-green-500/10 via-transparent to-emerald-500/10' : 'from-red-500/10 via-transparent to-orange-500/10'} pointer-events-none"></div>

                <div class="relative p-8">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 rounded-full ${success ? 'bg-gradient-to-br from-green-500/20 to-emerald-500/20 border border-green-500/30' : 'bg-gradient-to-br from-red-500/20 to-orange-500/20 border border-red-500/30'} flex items-center justify-center ${success ? 'animate-bounce' : 'animate-pulse'}">
                            <i class="fas ${success ? 'fa-check-circle text-green-400' : 'fa-exclamation-circle text-red-400'} text-4xl drop-shadow-lg"></i>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-white text-center mb-2">
                        ${success ? 'Message Sent!' : 'Unable to Send'}
                    </h3>

                    <p class="text-slate-300 text-center mb-6 text-sm">
                        ${message}
                    </p>

                    <button onclick="document.getElementById('resultModal').remove()"
                            class="w-full px-6 py-3 rounded-xl ${success ? 'bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600' : 'bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600'} text-white font-semibold transition-all duration-300 shadow-lg">
                        <i class="fas fa-check mr-2"></i>OK
                    </button>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    // Auto remove after 5 seconds
    setTimeout(() => {
        const existingModal = document.getElementById('resultModal');
        if (existingModal) {
            existingModal.remove();
        }
    }, 5000);
}

// Show success message
function showSuccessMessage(text) {
    const successMessage = document.getElementById('contactSuccessMessage');
    const messageText = document.getElementById('successMessageText');
    if (successMessage && messageText) {
        messageText.textContent = text;
        successMessage.classList.remove('hidden');
        setTimeout(() => {
            successMessage.classList.add('hidden');
        }, 3000);
    }
}

// Initiate Call
function initiateCall() {
    const data = getFormData();
    const phoneNumber = '+254746511327'; // VitalNest phone number

    if (!data.name) {
        alert('Please enter your name first');
        document.getElementById('contactName')?.focus();
        return;
    }

    showSuccessMessage('Initiating call...');

    // Open phone dialer
    window.location.href = `tel:${phoneNumber}`;

    // Log the contact attempt
    console.log('Call initiated:', { ...data, channel: 'call', to: phoneNumber });

    setTimeout(() => {
        closeContactModal();
    }, 1500);
}

// Initiate SMS
function initiateSMS() {
    const data = getFormData();
    const phoneNumber = '+254746511327'; // VitalNest phone number

    if (!data.name) {
        alert('Please enter your name first');
        document.getElementById('contactName')?.focus();
        return;
    }

    // Compose SMS message
    let smsBody = `Hi VitalNest! I'm ${data.name}.`;
    if (data.message) {
        smsBody += ` ${data.message}`;
    } else {
        smsBody += ' I would like to inquire about your home healthcare services.';
    }
    if (data.email) {
        smsBody += ` You can reach me at ${data.email}.`;
    }

    showSuccessMessage('Opening SMS app...');

    // Open SMS app with pre-filled message
    const smsUrl = `sms:${phoneNumber}${/iPhone|iPad|iPod/i.test(navigator.userAgent) ? '&' : '?'}body=${encodeURIComponent(smsBody)}`;
    window.location.href = smsUrl;

    // Log the contact attempt
    console.log('SMS initiated:', { ...data, channel: 'sms', to: phoneNumber, message: smsBody });

    setTimeout(() => {
        closeContactModal();
    }, 1500);
}

// Initiate WhatsApp
function initiateWhatsApp() {
    const data = getFormData();
    const phoneNumber = '254746511327'; // VitalNest phone number (without +)

    if (!data.name) {
        alert('Please enter your name first');
        document.getElementById('contactName')?.focus();
        return;
    }

    // Compose WhatsApp message
    let whatsappMessage = `Hi VitalNest! 👋\n\nI'm *${data.name}*`;
    if (data.phone) {
        whatsappMessage += `\nPhone: ${data.phone}`;
    }
    if (data.email) {
        whatsappMessage += `\nEmail: ${data.email}`;
    }
    whatsappMessage += '\n\n';
    if (data.message) {
        whatsappMessage += data.message;
    } else {
        whatsappMessage += 'I would like to inquire about your home healthcare services.';
    }
    whatsappMessage += '\n\nLooking forward to hearing from you! 🏥';

    showSuccessMessage('Opening WhatsApp...');

    // Open WhatsApp with pre-filled message
    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappMessage)}`;
    window.open(whatsappUrl, '_blank');

    // Log the contact attempt
    console.log('WhatsApp initiated:', { ...data, channel: 'whatsapp', to: phoneNumber, message: whatsappMessage });

    setTimeout(() => {
        closeContactModal();
    }, 1500);
}

// Initiate Email
function initiateEmail() {
    const data = getFormData();
    const emailAddress = 'info@vitalnest.com'; // VitalNest email

    if (!data.name) {
        alert('Please enter your name first');
        document.getElementById('contactName')?.focus();
        return;
    }

    if (!data.email) {
        alert('Please enter your email address');
        document.getElementById('contactEmail')?.focus();
        return;
    }

    // Compose email
    const subject = `Healthcare Inquiry from ${data.name}`;
    let emailBody = `Dear VitalNest Team,\n\n`;
    emailBody += `Name: ${data.name}\n`;
    if (data.phone) {
        emailBody += `Phone: ${data.phone}\n`;
    }
    emailBody += `Email: ${data.email}\n\n`;
    emailBody += `Message:\n`;
    if (data.message) {
        emailBody += data.message;
    } else {
        emailBody += 'I would like to inquire about your home healthcare services.';
    }
    emailBody += `\n\nBest regards,\n${data.name}`;

    showSuccessMessage('Opening email client...');

    // Open email client with pre-filled content
    const emailUrl = `mailto:${emailAddress}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(emailBody)}`;
    window.location.href = emailUrl;

    // Log the contact attempt
    console.log('Email initiated:', { ...data, channel: 'email', to: emailAddress, subject, body: emailBody });

    setTimeout(() => {
        closeContactModal();
    }, 1500);
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeContactModal();
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});
</script>


