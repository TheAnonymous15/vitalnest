<!-- Services Section - Stunning Glassmorphic Design -->
<section id="services" class="relative py-16 overflow-hidden">
    <!-- Animated Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>

    <!-- Animated Mesh Gradient Orbs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 -left-40 w-80 h-80 bg-vital-teal/20 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-1/2 -right-20 w-72 h-72 bg-vital-orange/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/4 w-80 h-80 bg-purple-500/15 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-pink-500/10 rounded-full blur-3xl animate-blob animation-delay-3000"></div>
    </div>

    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 50px 50px;"></div>

    <div class="max-w-full mx-auto px-2 sm:px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 mb-4">
                <span class="w-2 h-2 bg-vital-teal rounded-full animate-pulse"></span>
                <span class="text-white/80 text-xs font-semibold uppercase tracking-wider">Comprehensive Care</span>
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-3">
                Services <span class="bg-gradient-to-r from-vital-teal via-teal-400 to-vital-orange bg-clip-text text-transparent">We Offer</span>
            </h2>
            <p class="text-white/60 max-w-2xl mx-auto text-sm md:text-base">
                Professional home healthcare services designed to improve your quality of life and health outcomes
            </p>
        </div>

        <?php
            $services = [
                [
                    'icon' => 'fa-clipboard-list',
                    'title' => 'Comprehensive Assessment',
                    'desc' => 'Complete health evaluation including medical history, physical examination, and vital signs monitoring to create personalized care plans.',
                    'color' => 'teal',
                    'gradient' => 'from-vital-teal to-teal-600'
                ],
                [
                    'icon' => 'fa-pills',
                    'title' => 'Medication Management',
                    'desc' => 'Professional administration and monitoring of medications, ensuring proper dosage, timing, and tracking of any side effects.',
                    'color' => 'orange',
                    'gradient' => 'from-vital-orange to-orange-600'
                ],
                [
                    'icon' => 'fa-hand-holding-heart',
                    'title' => 'Daily Living Assistance',
                    'desc' => 'Compassionate support with hygiene, grooming, mobility, and daily activities to maintain dignity and independence.',
                    'color' => 'purple',
                    'gradient' => 'from-purple-500 to-pink-500'
                ],
                [
                    'icon' => 'fa-bandage',
                    'title' => 'Wound Care',
                    'desc' => 'Professional wound cleaning, dressing changes, and infection prevention using sterile techniques and advanced wound care products.',
                    'color' => 'red',
                    'gradient' => 'from-red-500 to-rose-500'
                ],
                [
                    'icon' => 'fa-apple-alt',
                    'title' => 'Nutritional Support',
                    'desc' => 'Personalized nutrition plans, dietary counseling, and meal planning for optimal health and disease management.',
                    'color' => 'green',
                    'gradient' => 'from-green-500 to-emerald-500'
                ],
                [
                    'icon' => 'fa-dumbbell',
                    'title' => 'Physiotherapy',
                    'desc' => 'Rehabilitation services including exercises, mobility training, and pain management to improve strength and function.',
                    'color' => 'blue',
                    'gradient' => 'from-blue-500 to-cyan-500'
                ],
                [
                    'icon' => 'fa-network-wired',
                    'title' => 'Specialist Coordination',
                    'desc' => 'Seamless coordination with medical specialists, hospitals, and laboratories for comprehensive care management.',
                    'color' => 'indigo',
                    'gradient' => 'from-indigo-500 to-purple-500'
                ],
                [
                    'icon' => 'fa-utensils',
                    'title' => 'NGT Feeding',
                    'desc' => 'Professional nasogastric tube insertion, feeding management, and care for patients requiring enteral nutrition.',
                    'color' => 'amber',
                    'gradient' => 'from-amber-500 to-yellow-500'
                ],
                [
                    'icon' => 'fa-heartbeat',
                    'title' => 'ECG Testing',
                    'desc' => 'Professional cardiac assessment with 12-lead ECG testing at home, with results interpreted by qualified clinicians.',
                    'color' => 'pink',
                    'gradient' => 'from-pink-500 to-rose-500'
                ],
                [
                    'icon' => 'fa-flask',
                    'title' => 'Lab Services',
                    'desc' => 'Comprehensive laboratory testing including blood work, urinalysis, and X-ray services all from the comfort of home.',
                    'color' => 'violet',
                    'gradient' => 'from-violet-500 to-purple-500'
                ],
                [
                    'icon' => 'fa-baby',
                    'title' => 'Maternal Care',
                    'desc' => 'Complete antenatal, perinatal, and postnatal care including checkups, ultrasounds, and mother-baby wellness support.',
                    'color' => 'rose',
                    'gradient' => 'from-rose-500 to-pink-500'
                ],
                [
                    'icon' => 'fa-user-md',
                    'title' => 'Doctor Visits',
                    'desc' => 'Licensed physicians providing consultations, examinations, prescriptions, and follow-up care at your doorstep.',
                    'color' => 'teal',
                    'gradient' => 'from-teal-500 to-cyan-500'
                ],
            ];

            $colorMap = [
                'teal' => ['text' => 'text-vital-teal', 'bg' => 'bg-vital-teal', 'glow' => 'shadow-vital-teal/50'],
                'orange' => ['text' => 'text-vital-orange', 'bg' => 'bg-vital-orange', 'glow' => 'shadow-vital-orange/50'],
                'purple' => ['text' => 'text-purple-400', 'bg' => 'bg-purple-500', 'glow' => 'shadow-purple-500/50'],
                'red' => ['text' => 'text-red-400', 'bg' => 'bg-red-500', 'glow' => 'shadow-red-500/50'],
                'green' => ['text' => 'text-green-400', 'bg' => 'bg-green-500', 'glow' => 'shadow-green-500/50'],
                'blue' => ['text' => 'text-blue-400', 'bg' => 'bg-blue-500', 'glow' => 'shadow-blue-500/50'],
                'indigo' => ['text' => 'text-indigo-400', 'bg' => 'bg-indigo-500', 'glow' => 'shadow-indigo-500/50'],
                'amber' => ['text' => 'text-amber-400', 'bg' => 'bg-amber-500', 'glow' => 'shadow-amber-500/50'],
                'pink' => ['text' => 'text-pink-400', 'bg' => 'bg-pink-500', 'glow' => 'shadow-pink-500/50'],
                'violet' => ['text' => 'text-violet-400', 'bg' => 'bg-violet-500', 'glow' => 'shadow-violet-500/50'],
                'rose' => ['text' => 'text-rose-400', 'bg' => 'bg-rose-500', 'glow' => 'shadow-rose-500/50'],
            ];

            // Split services into two groups
            $leftServices = array_slice($services, 0, 6);
            $rightServices = array_slice($services, 6, 6);
            ?>

        <!-- Radial Services Layout -->
        <div class="flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-6">

            <!-- Left Radial Circle -->
            <div class="relative w-80 h-80 md:w-96 md:h-96 flex-shrink-0">
                <!-- Multiple Glow Layers for 3D Effect -->
                <div class="absolute inset-4 rounded-full bg-gradient-to-br from-vital-teal/30 via-purple-500/20 to-blue-500/30 blur-2xl animate-pulse"></div>
                <div class="absolute inset-8 rounded-full bg-gradient-to-tl from-vital-teal/20 to-cyan-500/20 blur-xl"></div>

                <!-- Outer 3D Ring -->
                <div class="absolute inset-0 rounded-full bg-gradient-to-b from-white/20 via-transparent to-black/20 p-[2px]">
                    <div class="w-full h-full rounded-full bg-gradient-to-br from-slate-800/90 via-slate-900/95 to-slate-950/90 backdrop-blur-xl"></div>
                </div>

                <!-- Middle Ring with Glow -->
                <div class="absolute inset-6 rounded-full border-2 border-vital-teal/30 shadow-[0_0_30px_rgba(15,118,110,0.3),inset_0_0_30px_rgba(15,118,110,0.1)]"></div>

                <!-- Inner Ring -->
                <div class="absolute inset-12 rounded-full border border-white/10 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm"></div>

                <!-- Animated Dashed Circle -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 384 384">
                    <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#0F766E"/>
                            <stop offset="50%" style="stop-color:#8B5CF6"/>
                            <stop offset="100%" style="stop-color:#06B6D4"/>
                        </linearGradient>
                    </defs>
                    <circle class="animate-spin-slow" cx="192" cy="192" r="140" fill="none" stroke="url(#grad1)" stroke-width="2" stroke-dasharray="8 6" opacity="0.5" style="transform-origin: center;"/>
                </svg>

                <!-- Center Content with 3D Effect -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center relative">
                        <!-- Glow behind icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 bg-vital-teal/40 rounded-2xl blur-xl"></div>
                        </div>
                        <div class="relative w-16 h-16 mx-auto mb-2 bg-gradient-to-br from-vital-teal via-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-teal/50 border border-white/20">
                            <i class="fas fa-stethoscope text-white text-xl"></i>
                        </div>
                        <span class="text-white/80 text-xs font-bold uppercase tracking-wider">Clinical</span>
                    </div>
                </div>

                <!-- Service Items - Positioned around the circle -->
                <?php
                $angles = [270, 330, 30, 90, 150, 210]; // Starting from top, going clockwise
                foreach ($leftServices as $i => $service):
                    $angle = $angles[$i];
                    $rad = deg2rad($angle);
                    $radius = 140; // Distance from center
                    $x = 192 + $radius * cos($rad);
                    $y = 192 + $radius * sin($rad);
                    $colors = $colorMap[$service['color']];
                ?>
                <div class="service-item absolute cursor-pointer group"
                     style="left: <?= $x ?>px; top: <?= $y ?>px; transform: translate(-50%, -50%);"
                     data-title="<?= htmlspecialchars($service['title']) ?>"
                     data-desc="<?= htmlspecialchars($service['desc']) ?>"
                     data-icon="<?= $service['icon'] ?>"
                     data-gradient="<?= $service['gradient'] ?>"
                     onclick="showServiceDetail(this)">
                    <!-- Icon with 3D effect -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br <?= $service['gradient'] ?> rounded-xl blur-md opacity-60 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-11 h-11 md:w-12 md:h-12 bg-gradient-to-br <?= $service['gradient'] ?> rounded-xl flex items-center justify-center shadow-lg border border-white/20 group-hover:scale-110 group-hover:shadow-xl group-hover:-translate-y-1 transition-all duration-300">
                            <i class="fas <?= $service['icon'] ?> text-white text-xs md:text-sm"></i>
                        </div>
                    </div>
                    <!-- Hover Tooltip Label -->
                    <div class="absolute left-1/2 -translate-x-1/2 mt-1 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none z-30" style="top: 100%;">
                        <div class="bg-slate-900/95 backdrop-blur-sm px-2.5 py-1.5 rounded-lg border border-white/20 shadow-xl whitespace-nowrap">
                            <span class="text-white text-[10px] font-semibold"><?= $service['title'] ?></span>
                        </div>
                        <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900/95 border-l border-t border-white/20 rotate-45"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Center Reading Card -->
            <div class="relative z-10 flex-shrink-0">
                <!-- Connector Lines -->
                <div class="hidden lg:block absolute top-1/2 -left-6 w-6 h-px bg-gradient-to-r from-vital-teal/50 to-white/30"></div>
                <div class="hidden lg:block absolute top-1/2 -right-6 w-6 h-px bg-gradient-to-l from-vital-orange/50 to-white/30"></div>

                <!-- Multiple Glow Layers -->
                <div class="absolute -inset-6 bg-gradient-to-br from-vital-teal/50 via-purple-500/40 to-vital-orange/50 rounded-[2rem] blur-2xl opacity-70"></div>
                <div class="absolute -inset-3 bg-gradient-to-br from-vital-teal/30 to-vital-orange/30 rounded-3xl blur-xl opacity-50"></div>

                <!-- Main Card -->
                <div id="service-detail-card" class="relative w-64 md:w-72 lg:w-80 overflow-hidden">
                    <!-- Outer Ring / Border -->
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-b from-white/30 via-white/10 to-white/5 p-[1px]">
                        <div class="w-full h-full rounded-3xl bg-gradient-to-br from-slate-800/95 via-slate-900/98 to-slate-950/95"></div>
                    </div>

                    <!-- Inner Content -->
                    <div class="relative p-6 md:p-7">
                        <!-- Top Decorative Shine -->
                        <div class="absolute top-0 left-0 right-0 h-1/3 bg-gradient-to-b from-white/10 to-transparent rounded-t-3xl"></div>

                        <!-- Corner Accents -->
                        <div class="absolute top-3 right-3 w-16 h-16 bg-gradient-to-bl from-vital-orange/30 to-transparent rounded-bl-2xl"></div>
                        <div class="absolute bottom-3 left-3 w-14 h-14 bg-gradient-to-tr from-vital-teal/20 to-transparent rounded-tr-2xl"></div>

                        <div class="relative text-center">
                            <!-- Badge -->
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-4">
                                <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                                <span class="text-white/70 text-[10px] font-semibold uppercase tracking-wider">Service Details</span>
                            </div>

                            <!-- Icon Container with Glow -->
                            <div class="relative mb-4">
                                <div id="detail-icon-glow" class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-20 h-20 bg-vital-teal/40 rounded-2xl blur-xl"></div>
                                </div>
                                <div id="detail-icon" class="relative w-16 h-16 mx-auto bg-gradient-to-br from-vital-teal to-teal-600 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-teal/40 border border-white/20">
                                    <i class="fas fa-hand-pointer text-white text-2xl"></i>
                                </div>
                            </div>

                            <!-- Title -->
                            <h4 id="detail-title" class="text-lg md:text-xl font-black text-white mb-2 leading-tight">Select a Service</h4>

                            <!-- Divider -->
                            <div class="w-12 h-1 mx-auto bg-gradient-to-r from-vital-teal via-purple-500 to-vital-orange rounded-full mb-3"></div>

                            <!-- Description -->
                            <p id="detail-desc" class="text-white/60 text-xs md:text-sm leading-relaxed mb-5">
                                Click on any service icon around the circles to learn more about what we offer.
                            </p>

                            <!-- CTA Button -->
                            <a href="#packages" id="detail-cta" class="inline-flex items-center justify-center gap-2 w-full px-5 py-2.5 bg-gradient-to-r from-vital-teal/20 to-vital-orange/20 hover:from-vital-teal hover:to-teal-600 border border-white/20 hover:border-transparent rounded-xl text-white text-sm font-bold transition-all duration-300 opacity-0 group">
                                <span>View Packages</span>
                                <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Radial Circle -->
            <div class="relative w-80 h-80 md:w-96 md:h-96 flex-shrink-0">
                <!-- Multiple Glow Layers for 3D Effect -->
                <div class="absolute inset-4 rounded-full bg-gradient-to-br from-vital-orange/30 via-pink-500/20 to-rose-500/30 blur-2xl animate-pulse"></div>
                <div class="absolute inset-8 rounded-full bg-gradient-to-tl from-vital-orange/20 to-amber-500/20 blur-xl"></div>

                <!-- Outer 3D Ring -->
                <div class="absolute inset-0 rounded-full bg-gradient-to-b from-white/20 via-transparent to-black/20 p-[2px]">
                    <div class="w-full h-full rounded-full bg-gradient-to-br from-slate-800/90 via-slate-900/95 to-slate-950/90 backdrop-blur-xl"></div>
                </div>

                <!-- Middle Ring with Glow -->
                <div class="absolute inset-6 rounded-full border-2 border-vital-orange/30 shadow-[0_0_30px_rgba(249,115,22,0.3),inset_0_0_30px_rgba(249,115,22,0.1)]"></div>

                <!-- Inner Ring -->
                <div class="absolute inset-12 rounded-full border border-white/10 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm"></div>

                <!-- Animated Dashed Circle -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 384 384">
                    <defs>
                        <linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#F97316"/>
                            <stop offset="50%" style="stop-color:#EC4899"/>
                            <stop offset="100%" style="stop-color:#F43F5E"/>
                        </linearGradient>
                    </defs>
                    <circle class="animate-spin-slow-reverse" cx="192" cy="192" r="140" fill="none" stroke="url(#grad2)" stroke-width="2" stroke-dasharray="8 6" opacity="0.5" style="transform-origin: center;"/>
                </svg>

                <!-- Center Content with 3D Effect -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center relative">
                        <!-- Glow behind icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 bg-vital-orange/40 rounded-2xl blur-xl"></div>
                        </div>
                        <div class="relative w-16 h-16 mx-auto mb-2 bg-gradient-to-br from-vital-orange via-orange-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg shadow-vital-orange/50 border border-white/20">
                            <i class="fas fa-heart text-white text-xl"></i>
                        </div>
                        <span class="text-white/80 text-xs font-bold uppercase tracking-wider">Wellness</span>
                    </div>
                </div>

                <!-- Service Items - Positioned around the circle -->
                <?php
                foreach ($rightServices as $i => $service):
                    $angle = $angles[$i];
                    $rad = deg2rad($angle);
                    $radius = 140;
                    $x = 192 + $radius * cos($rad);
                    $y = 192 + $radius * sin($rad);
                    $colors = $colorMap[$service['color']];
                ?>
                <div class="service-item absolute cursor-pointer group"
                     style="left: <?= $x ?>px; top: <?= $y ?>px; transform: translate(-50%, -50%);"
                     data-title="<?= htmlspecialchars($service['title']) ?>"
                     data-desc="<?= htmlspecialchars($service['desc']) ?>"
                     data-icon="<?= $service['icon'] ?>"
                     data-gradient="<?= $service['gradient'] ?>"
                     onclick="showServiceDetail(this)">
                    <!-- Icon with 3D effect -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br <?= $service['gradient'] ?> rounded-xl blur-md opacity-60 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-11 h-11 md:w-12 md:h-12 bg-gradient-to-br <?= $service['gradient'] ?> rounded-xl flex items-center justify-center shadow-lg border border-white/20 group-hover:scale-110 group-hover:shadow-xl group-hover:-translate-y-1 transition-all duration-300">
                            <i class="fas <?= $service['icon'] ?> text-white text-xs md:text-sm"></i>
                        </div>
                    </div>
                    <!-- Hover Tooltip Label -->
                    <div class="absolute left-1/2 -translate-x-1/2 mt-1 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none z-30" style="top: 100%;">
                        <div class="bg-slate-900/95 backdrop-blur-sm px-2.5 py-1.5 rounded-lg border border-white/20 shadow-xl whitespace-nowrap">
                            <span class="text-white text-[10px] font-semibold"><?= $service['title'] ?></span>
                        </div>
                        <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900/95 border-l border-t border-white/20 rotate-45"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Why Choose Us - Two Column Layout -->
        <div class="mt-16 relative">
            <!-- Gradient Border Top -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-px bg-gradient-to-r from-transparent via-vital-teal/50 to-transparent"></div>

            <div class="pt-12 grid lg:grid-cols-2 gap-8 lg:gap-12 items-center max-w-7xl mx-auto">

                <!-- Left: Why Us Features (Cards) -->
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-vital-orange/20 to-vital-teal/20 backdrop-blur-sm rounded-full border border-white/10 mb-4">
                        <i class="fas fa-award text-vital-orange text-xs"></i>
                        <span class="text-white/80 text-xs font-bold uppercase tracking-wider">Why Choose Us</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-black text-white mb-3">
                        The VitalNest <span class="bg-gradient-to-r from-vital-orange via-amber-400 to-vital-teal bg-clip-text text-transparent">Difference</span>
                    </h3>
                    <p class="text-white/50 text-sm mb-6">
                        Experience healthcare that puts your family first — professional, compassionate, and always available.
                    </p>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="group p-4 bg-white/[0.03] rounded-xl hover:bg-white/[0.08] transition-all duration-300">
                            <div class="w-10 h-10 mb-3 bg-gradient-to-br from-vital-teal to-teal-600 rounded-lg flex items-center justify-center shadow-lg shadow-vital-teal/20 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                            <h4 class="text-white font-bold text-sm mb-1">Licensed & Verified</h4>
                            <p class="text-white/40 text-xs leading-relaxed">Background-checked professionals</p>
                        </div>
                        <div class="group p-4 bg-white/[0.03] rounded-xl hover:bg-white/[0.08] transition-all duration-300">
                            <div class="w-10 h-10 mb-3 bg-gradient-to-br from-vital-orange to-amber-500 rounded-lg flex items-center justify-center shadow-lg shadow-vital-orange/20 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <h4 class="text-white font-bold text-sm mb-1">24/7 Available</h4>
                            <p class="text-white/40 text-xs leading-relaxed">Round-the-clock care</p>
                        </div>
                        <div class="group p-4 bg-white/[0.03] rounded-xl hover:bg-white/[0.08] transition-all duration-300">
                            <div class="w-10 h-10 mb-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/20 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <h4 class="text-white font-bold text-sm mb-1">Real-Time Tracking</h4>
                            <p class="text-white/40 text-xs leading-relaxed">Live health monitoring</p>
                        </div>
                        <div class="group p-4 bg-white/[0.03] rounded-xl hover:bg-white/[0.08] transition-all duration-300">
                            <div class="w-10 h-10 mb-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-lg shadow-green-500/20 group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <h4 class="text-white font-bold text-sm mb-1">100% Secure</h4>
                            <p class="text-white/40 text-xs leading-relaxed">HIPAA compliant</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Glassmorphic CTA Card -->
                <div class="relative">
                    <!-- Outer Glow -->
                    <div class="absolute -inset-4 bg-gradient-to-br from-vital-teal/30 via-purple-500/20 to-vital-orange/30 rounded-3xl blur-2xl opacity-60"></div>

                    <!-- Main Card -->
                    <div class="relative bg-white/[0.08] backdrop-blur-2xl rounded-3xl p-8 border border-white/20 overflow-hidden shadow-2xl">
                        <!-- Decorative Elements -->
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-bl from-vital-orange/30 to-transparent rounded-bl-full"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-vital-teal/20 to-transparent rounded-tr-full"></div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-radial from-white/5 to-transparent rounded-full blur-2xl"></div>

                        <div class="relative">
                            <!-- Badge -->
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-5">
                                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                <span class="text-white/80 text-xs font-semibold">5,000+ Happy Families</span>
                            </div>

                            <h3 class="text-2xl md:text-3xl font-black text-white mb-3 leading-tight">
                                Ready to Experience <br><span class="bg-gradient-to-r from-vital-orange via-amber-400 to-yellow-300 bg-clip-text text-transparent">Quality Care?</span>
                            </h3>

                            <p class="text-white/60 text-sm leading-relaxed mb-6">
                                Join thousands of families who trust VitalNest for professional, compassionate home healthcare. Your journey to better health starts today.
                            </p>

                            <!-- Key Points -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-vital-teal/30 rounded-full flex items-center justify-center flex-shrink-0 backdrop-blur-sm border border-vital-teal/30">
                                        <i class="fas fa-check text-vital-teal text-xs"></i>
                                    </div>
                                    <span class="text-white/70 text-sm">No long-term contracts required</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-vital-teal/30 rounded-full flex items-center justify-center flex-shrink-0 backdrop-blur-sm border border-vital-teal/30">
                                        <i class="fas fa-check text-vital-teal text-xs"></i>
                                    </div>
                                    <span class="text-white/70 text-sm">Flexible packages you can adjust</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-vital-teal/30 rounded-full flex items-center justify-center flex-shrink-0 backdrop-blur-sm border border-vital-teal/30">
                                        <i class="fas fa-check text-vital-teal text-xs"></i>
                                    </div>
                                    <span class="text-white/70 text-sm">Verified & licensed professionals</span>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <a href="#packages" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-vital-teal to-teal-600 text-white rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-vital-teal/40 hover:-translate-y-0.5 transition-all duration-300 group">
                                    <i class="fas fa-calendar-check group-hover:scale-110 transition-transform"></i>
                                    <span>Book a Visit</span>
                                </a>
                                <a href="tel:+254700000000" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-xl border border-white/30 text-white rounded-xl font-bold text-sm hover:bg-white/20 hover:-translate-y-0.5 transition-all duration-300">
                                    <i class="fas fa-phone"></i>
                                    <span>Call Us Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Blob Animation for Services */
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -30px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(30px, 10px) scale(1.05); }
    }

    #services .animate-blob {
        animation: blob 15s ease-in-out infinite;
    }

    #services .animation-delay-2000 {
        animation-delay: 2s;
    }

    #services .animation-delay-3000 {
        animation-delay: 3s;
    }

    #services .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Slow spin animations for the radial circles */
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes spin-slow-reverse {
        from { transform: rotate(0deg); }
        to { transform: rotate(-360deg); }
    }

    .animate-spin-slow {
        animation: spin-slow 60s linear infinite;
    }

    .animate-spin-slow-reverse {
        animation: spin-slow-reverse 60s linear infinite;
    }

    /* Service item active state */
    .service-item.active > div:first-child {
        transform: scale(1.2);
        box-shadow: 0 0 30px rgba(255,255,255,0.3);
    }

    /* Card transition */
    #service-detail-card {
        transition: all 0.4s ease;
    }

    #service-detail-card.updating {
        transform: scale(0.95);
        opacity: 0.8;
    }
</style>

<script>
function showServiceDetail(element) {
    const card = document.getElementById('service-detail-card');
    const iconEl = document.getElementById('detail-icon');
    const iconGlow = document.getElementById('detail-icon-glow');
    const titleEl = document.getElementById('detail-title');
    const descEl = document.getElementById('detail-desc');
    const ctaEl = document.getElementById('detail-cta');

    // Get data from clicked element
    const title = element.dataset.title;
    const desc = element.dataset.desc;
    const icon = element.dataset.icon;
    const gradient = element.dataset.gradient;

    // Remove active class from all items
    document.querySelectorAll('.service-item').forEach(item => {
        item.classList.remove('active');
    });

    // Add active class to clicked item
    element.classList.add('active');

    // Animate card update
    card.classList.add('updating');

    setTimeout(() => {
        // Update icon with glow
        iconEl.className = `relative w-16 h-16 mx-auto bg-gradient-to-br ${gradient} rounded-2xl flex items-center justify-center shadow-lg border border-white/20`;
        iconEl.innerHTML = `<i class="fas ${icon} text-white text-2xl"></i>`;

        // Update glow color based on gradient
        if (gradient.includes('teal')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-vital-teal/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-vital-teal/40');
        } else if (gradient.includes('orange')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-vital-orange/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-vital-orange/40');
        } else if (gradient.includes('purple') || gradient.includes('pink')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-purple-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-purple-500/40');
        } else if (gradient.includes('green')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-green-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-green-500/40');
        } else if (gradient.includes('blue') || gradient.includes('cyan')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-blue-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-blue-500/40');
        } else if (gradient.includes('red') || gradient.includes('rose')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-rose-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-rose-500/40');
        } else if (gradient.includes('amber') || gradient.includes('yellow')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-amber-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-amber-500/40');
        } else if (gradient.includes('indigo')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-indigo-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-indigo-500/40');
        } else if (gradient.includes('violet')) {
            iconGlow.innerHTML = '<div class="w-20 h-20 bg-violet-500/40 rounded-2xl blur-xl"></div>';
            iconEl.classList.add('shadow-violet-500/40');
        }

        titleEl.textContent = title;
        descEl.textContent = desc;
        ctaEl.classList.remove('opacity-0');
        ctaEl.classList.add('opacity-100');

        card.classList.remove('updating');
    }, 200);
}

// Auto-select first service on load
document.addEventListener('DOMContentLoaded', function() {
    const firstService = document.querySelector('.service-item');
    if (firstService) {
        setTimeout(() => {
            showServiceDetail(firstService);
        }, 1000);
    }
});
</script>

