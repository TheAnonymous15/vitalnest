<!-- Care Packages Section - Unique Journey Design -->
<section id="packages" class="relative py-16 overflow-hidden">
    <!-- Animated Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>

    <!-- Animated Orbs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-vital-teal/15 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-vital-orange/15 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header with Unique Treatment -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-vital-orange/20 rounded-full mb-4">
                    <span class="w-1.5 h-1.5 bg-vital-orange rounded-full animate-pulse"></span>
                    <span class="text-vital-orange text-[10px] font-bold uppercase tracking-wider">Care Plans</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-white leading-tight">
                    Your Care,<br>
                    <span class="bg-gradient-to-r from-vital-orange via-amber-400 to-vital-teal bg-clip-text text-transparent">Your Choice</span>
                </h2>
            </div>
            <p class="text-white/50 text-sm max-w-sm lg:text-right">
                From essential check-ups to comprehensive daily care — find the perfect fit for your family.
            </p>
        </div>

        <!-- Unique Package Selector - Tab Pills -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button onclick="showPackage('basic')" class="package-tab active px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-tab="basic">
                <i class="fas fa-leaf mr-2"></i>Basic
            </button>
            <button onclick="showPackage('standard')" class="package-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-tab="standard">
                <i class="fas fa-fire mr-2"></i>Standard
            </button>
            <button onclick="showPackage('premium')" class="package-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-tab="premium">
                <i class="fas fa-crown mr-2"></i>Premium
            </button>
            <button onclick="showPackage('maternal')" class="package-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-tab="maternal">
                <i class="fas fa-baby mr-2"></i>Maternal
            </button>
        </div>

        <!-- Package Display Area -->
        <div class="relative">

            <!-- Basic Package -->
            <div id="pkg-basic" class="package-content active">
                <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                    <!-- Left: Big Price Display -->
                    <div class="lg:col-span-2 relative">
                        <div class="h-full bg-gradient-to-br from-vital-teal/20 to-teal-900/40 backdrop-blur-xl rounded-3xl p-8 border border-vital-teal/20 overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-vital-teal/20 rounded-full blur-2xl"></div>
                            <div class="relative">
                                <span class="inline-block px-3 py-1 bg-vital-teal/30 text-vital-teal text-xs font-bold rounded-full mb-4">STARTER</span>
                                <div class="mb-6">
                                    <span class="text-white/40 text-lg">KES</span>
                                    <span class="text-6xl md:text-7xl font-black text-white ml-1">25K</span>
                                    <span class="text-white/40 text-lg">/mo</span>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Basic Care</h3>
                                <p class="text-white/60 text-sm mb-6">Essential health monitoring for independent seniors and individuals needing routine check-ups.</p>
                                <button class="w-full py-3 bg-vital-teal text-white font-bold rounded-xl hover:bg-teal-600 transition-all duration-300">
                                    Get Started <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Features in Creative Layout -->
                    <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-calendar-check text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Weekly Visits</h4>
                                    <p class="text-white/40 text-xs mt-1">Scheduled clinician check-ups</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-flask text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Basic Labs</h4>
                                    <p class="text-white/40 text-xs mt-1">CBC, glucose, urinalysis</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-heartbeat text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Vitals Monitoring</h4>
                                    <p class="text-white/40 text-xs mt-1">BP, pulse, temperature, SpO2</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-user-nurse text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Care Team</h4>
                                    <p class="text-white/40 text-xs mt-1">Clinician, Nurse, Physio, Nutritionist</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-clipboard-list text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Health Reports</h4>
                                    <p class="text-white/40 text-xs mt-1">Monthly progress summary</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-vital-teal/30 transition-all">
                                    <i class="fas fa-phone-alt text-vital-teal"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">Phone Support</h4>
                                    <p class="text-white/40 text-xs mt-1">Business hours availability + Emergency</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Standard Package -->
            <div id="pkg-standard" class="package-content hidden">
                <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                    <div class="lg:col-span-2 relative">
                        <div class="h-full bg-gradient-to-br from-vital-orange/20 to-orange-900/40 backdrop-blur-xl rounded-3xl p-8 border border-vital-orange/20 overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-vital-orange/20 rounded-full blur-2xl"></div>
                            <div class="relative">
                                <span class="inline-block px-3 py-1 bg-vital-orange/30 text-vital-orange text-xs font-bold rounded-full mb-4">POPULAR</span>
                                <div class="mb-6">
                                    <span class="text-white/40 text-lg">KES</span>
                                    <span class="text-6xl md:text-7xl font-black text-white ml-1">50K</span>
                                    <span class="text-white/40 text-lg">/mo</span>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Standard Care</h3>
                                <p class="text-white/60 text-sm mb-6">Enhanced care with on-call support and extended diagnostics for those needing more attention.</p>
                                <button class="w-full py-3 bg-vital-orange text-white font-bold rounded-xl hover:bg-orange-600 transition-all duration-300">
                                    Get Started <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-calendar-alt text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Weekly + On-Call</h4><p class="text-white/40 text-xs mt-1">Scheduled & emergency visits</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-x-ray text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Extended Labs</h4><p class="text-white/40 text-xs mt-1">+ X-rays, LFTs, UECs, RFTs</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-band-aid text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Wound Care</h4><p class="text-white/40 text-xs mt-1">Professional dressing & care</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-utensils text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">NGT Feeding</h4><p class="text-white/40 text-xs mt-1">Tube feeding management</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-users text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Full Care Team</h4><p class="text-white/40 text-xs mt-1">All specialists included</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-headset text-vital-orange"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Extended Support</h4><p class="text-white/40 text-xs mt-1">7AM - 10PM availability</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Premium Package -->
            <div id="pkg-premium" class="package-content hidden">
                <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                    <div class="lg:col-span-2 relative">
                        <div class="h-full bg-gradient-to-br from-amber-500/30 via-rose-500/20 to-purple-900/40 backdrop-blur-xl rounded-3xl p-8 border border-amber-500/30 overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/20 rounded-full blur-2xl"></div>
                            <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center"><i class="fas fa-crown text-amber-400"></i></div>
                            <div class="relative">
                                <span class="inline-block px-3 py-1 bg-gradient-to-r from-amber-500/40 to-rose-500/40 text-amber-300 text-xs font-bold rounded-full mb-4">COMPLETE CARE</span>
                                <div class="mb-6">
                                    <span class="text-white/40 text-lg">KES</span>
                                    <span class="text-6xl md:text-7xl font-black text-white ml-1">200K</span>
                                    <span class="text-white/40 text-lg">/mo</span>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Premium Care</h3>
                                <p class="text-white/60 text-sm mb-6">Intensive daily care for chronically ill and elderly patients requiring constant attention.</p>
                                <button class="w-full py-3 bg-gradient-to-r from-amber-500 to-rose-500 text-white font-bold rounded-xl hover:opacity-90 transition-all duration-300">
                                    Get Premium <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-sun text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Daily Nursing</h4><p class="text-white/40 text-xs mt-1">Professional care every day</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-stethoscope text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">On-Call Clinical</h4><p class="text-white/40 text-xs mt-1">Doctor visits when needed</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-walking text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Weekly Physio</h4><p class="text-white/40 text-xs mt-1">Rehabilitation & mobility</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-vials text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Full Lab Suite</h4><p class="text-white/40 text-xs mt-1">All tests + ECG, imaging</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-apple-alt text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Nutrition Plans</h4><p class="text-white/40 text-xs mt-1">Custom diet & supplements</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-clock text-amber-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">24/7 Support</h4><p class="text-white/40 text-xs mt-1">Round-the-clock care</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maternal Package -->
            <div id="pkg-maternal" class="package-content hidden">
                <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                    <div class="lg:col-span-2 relative">
                        <div class="h-full bg-gradient-to-br from-rose-500/20 to-pink-900/40 backdrop-blur-xl rounded-3xl p-8 border border-rose-500/20 overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-rose-500/20 rounded-full blur-2xl"></div>
                            <div class="relative">
                                <span class="inline-block px-3 py-1 bg-rose-500/30 text-rose-300 text-xs font-bold rounded-full mb-4">FOR MOTHERS</span>
                                <div class="mb-6">
                                    <span class="text-white/40 text-lg">KES</span>
                                    <span class="text-6xl md:text-7xl font-black text-white ml-1">50K</span>
                                    <span class="text-white/40 text-lg">/trimester</span>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">Maternal Care</h3>
                                <p class="text-white/60 text-sm mb-6">Complete pregnancy journey support from conception through postnatal recovery.</p>
                                <button class="w-full py-3 bg-rose-500 text-white font-bold rounded-xl hover:bg-rose-600 transition-all duration-300">
                                    Get Started <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-user-md text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Midwife Visits</h4><p class="text-white/40 text-xs mt-1">Regular prenatal check-ups</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-baby text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Ultrasounds</h4><p class="text-white/40 text-xs mt-1">Fetal growth monitoring</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-vial text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Antenatal Labs</h4><p class="text-white/40 text-xs mt-1">Full pregnancy profile</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-heart text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Postnatal Care</h4><p class="text-white/40 text-xs mt-1">Mother & baby wellness</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-apple-alt text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Nutrition</h4><p class="text-white/40 text-xs mt-1">Pregnancy diet guidance</p></div>
                            </div>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-hands-helping text-rose-400"></i></div>
                                <div><h4 class="text-white font-semibold text-sm">Birth Prep</h4><p class="text-white/40 text-xs mt-1">Delivery planning support</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Package Banner -->
        <div class="mt-10 relative overflow-hidden rounded-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-vital-teal/30 via-transparent to-vital-orange/30"></div>
            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-4 p-6 bg-white/5 backdrop-blur-xl border border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-vital-orange rounded-xl flex items-center justify-center">
                        <i class="fas fa-puzzle-piece text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold">Need something different?</h4>
                        <p class="text-white/50 text-sm">We can build a custom care plan just for you</p>
                    </div>
                </div>
                <button class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all duration-300">
                    <i class="fas fa-comments mr-2"></i>Let's Talk
                </button>
            </div>
        </div>
    </div>
</section>

<style>
    /* Package Tab Styles */
    .package-tab {
        background: rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.6);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .package-tab:hover {
        background: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.9);
    }
    .package-tab.active {
        background: linear-gradient(135deg, #0F766E, #0D9488);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.4);
    }
    .package-tab[data-tab="standard"].active {
        background: linear-gradient(135deg, #F97316, #EA580C);
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
    }
    .package-tab[data-tab="premium"].active {
        background: linear-gradient(135deg, #F59E0B, #EC4899);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }
    .package-tab[data-tab="maternal"].active {
        background: linear-gradient(135deg, #F43F5E, #EC4899);
        box-shadow: 0 4px 15px rgba(244, 63, 94, 0.4);
    }

    /* Package Content Transitions */
    .package-content {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
        display: none;
    }
    .package-content.active {
        opacity: 1;
        transform: translateY(0);
        display: block;
    }

    /* Blob Animation */
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -30px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(30px, 10px) scale(1.05); }
    }
    #packages .animate-blob { animation: blob 15s ease-in-out infinite; }
    #packages .animation-delay-2000 { animation-delay: 2s; }
</style>

<script>
function showPackage(pkg) {
    // Hide all packages
    document.querySelectorAll('.package-content').forEach(el => {
        el.classList.remove('active');
        el.classList.add('hidden');
    });

    // Remove active from all tabs
    document.querySelectorAll('.package-tab').forEach(el => {
        el.classList.remove('active');
    });

    // Show selected package
    const pkgEl = document.getElementById('pkg-' + pkg);
    if (pkgEl) {
        pkgEl.classList.remove('hidden');
        setTimeout(() => pkgEl.classList.add('active'), 10);
    }

    // Activate selected tab
    const tabEl = document.querySelector(`.package-tab[data-tab="${pkg}"]`);
    if (tabEl) tabEl.classList.add('active');
}
</script>

