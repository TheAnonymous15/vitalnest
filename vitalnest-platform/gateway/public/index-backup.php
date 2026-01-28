<?php
/**
 * Vitalnest Platform - Customer Portal
 * Main landing page for patient services, booking, and care management
 */

session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? 'guest';
$userName = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalnest - Professional Home Healthcare Services</title>
    <meta name="description" content="Book professional home healthcare services. Licensed nurses, clinicians, and lab services at your doorstep.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                        'warm-orange': '#F97316',
                        'soft-amber': '#FDBA74',
                        'cream': '#FFFBEB',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-in': 'slideIn 0.8s ease-out',
                        'glow': 'glow 3s ease-in-out infinite alternate',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 3px rgba(15, 118, 110, 0.3), 0 0 6px rgba(15, 118, 110, 0.2)' },
                            '100%': { boxShadow: '0 0 8px rgba(15, 118, 110, 0.4), 0 0 12px rgba(15, 118, 110, 0.3), 0 0 16px rgba(15, 118, 110, 0.2)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-1000px 0' },
                            '100%': { backgroundPosition: '1000px 0' },
                        },
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0F766E 0%, #F97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animated gradient background - Soft and subtle */
        .animated-gradient {
            background: linear-gradient(-45deg,
                rgba(15, 118, 110, 0.9),
                rgba(19, 78, 74, 0.85),
                rgba(15, 118, 110, 0.9),
                rgba(20, 83, 45, 0.8)
            );
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Hover lift effect */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Subtle glow effect - gentler on eyes */
        .neon-glow {
            box-shadow: 0 0 5px rgba(15, 118, 110, 0.2),
                        0 0 10px rgba(15, 118, 110, 0.15),
                        0 0 15px rgba(15, 118, 110, 0.1);
        }

        /* Shimmer effect for loading/highlighting */
        .shimmer {
            background: linear-gradient(90deg,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        /* Particle background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 10s infinite;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #0F766E 0%, #F97316 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #134E4A 0%, #F97316 100%);
        }

        /* Floating shapes - very subtle */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            animation: float 8s ease-in-out infinite;
        }

        /* Perspective card effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg);
        }

        /* Gradient border animation */
        @keyframes borderGlow {
            0%, 100% { border-color: #0F766E; }
            50% { border-color: #F97316; }
        }

        .border-glow {
            animation: borderGlow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-cream font-sans antialiased overflow-x-hidden">

    <!-- Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass backdrop-blur-xl border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo with Glow Effect -->
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-teal to-warm-orange rounded-xl blur-lg opacity-50 group-hover:opacity-100 transition duration-500"></div>
                        <div class="relative w-12 h-12 bg-gradient-to-br from-vital-teal to-warm-orange rounded-xl flex items-center justify-center transform group-hover:scale-110 transition duration-300">
                            <i class="fas fa-heartbeat text-white text-xl animate-pulse"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold bg-gradient-to-r from-vital-teal to-warm-orange bg-clip-text text-transparent">Vitalnest</span>
                        <p class="text-xs text-gray-600 font-medium tracking-wide">Future of Healthcare</p>
                    </div>
                </div>

                <!-- Navigation Links with Hover Effects -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#services" class="relative text-gray-700 font-semibold hover:text-vital-teal transition duration-300 group">
                        <span>Services</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-vital-teal to-warm-orange group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#packages" class="relative text-gray-700 font-semibold hover:text-vital-teal transition duration-300 group">
                        <span>Packages</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-vital-teal to-warm-orange group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#how-it-works" class="relative text-gray-700 font-semibold hover:text-vital-teal transition duration-300 group">
                        <span>How It Works</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-vital-teal to-warm-orange group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#about" class="relative text-gray-700 font-semibold hover:text-vital-teal transition duration-300 group">
                        <span>About</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-vital-teal to-warm-orange group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <!-- User Actions with Enhanced Buttons -->
                <div class="flex items-center gap-3">
                    <?php if ($isLoggedIn): ?>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-3 px-4 py-2 glass rounded-full">
                                <div class="w-8 h-8 bg-gradient-to-br from-vital-teal to-warm-orange rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold"><?php echo strtoupper(substr($userName, 0, 2)); ?></span>
                                </div>
                                <span class="text-sm font-semibold text-gray-800">Hello, <strong class="gradient-text"><?php echo htmlspecialchars($userName); ?></strong></span>
                            </div>
                            <a href="/dashboard" class="relative px-6 py-3 bg-gradient-to-r from-vital-teal to-deep-teal text-white rounded-xl font-bold overflow-hidden group">
                                <span class="relative z-10">Dashboard</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-warm-orange to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                            </a>
                            <a href="/logout.php" class="px-4 py-2 text-gray-700 hover:text-warm-orange transition font-medium">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="/login.php" class="px-6 py-3 text-vital-teal hover:text-deep-teal font-bold transition duration-300">
                            Sign In
                        </a>
                        <a href="/register.php" class="relative px-8 py-3 bg-gradient-to-r from-warm-orange to-orange-600 text-white rounded-xl font-bold overflow-hidden group neon-glow">
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fas fa-rocket"></i>
                                Get Started
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-vital-teal to-deep-teal transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden animated-gradient pt-20">
        <!-- Floating Particles Background -->
        <div class="particles absolute inset-0">
            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 80%; top: 30%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 30%; top: 60%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 70%; top: 70%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 50%; top: 40%; animation-delay: 3s;"></div>
        </div>

        <!-- Floating Gradient Orbs - Subtle -->
        <div class="floating-shape w-96 h-96 bg-warm-orange/10 top-20 -left-48 blur-3xl" style="animation-delay: 0s;"></div>
        <div class="floating-shape w-96 h-96 bg-vital-teal/10 bottom-20 -right-48 blur-3xl" style="animation-delay: 2s;"></div>
        <div class="floating-shape w-64 h-64 bg-soft-amber/10 top-1/2 left-1/2 blur-3xl" style="animation-delay: 4s;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 animate-slide-in">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-3 glass px-6 py-3 rounded-full border border-white/30 hover:scale-105 transition duration-300 cursor-pointer group">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-bold text-white">🏥 Licensed Healthcare Professionals</span>
                        <i class="fas fa-check-circle text-green-400 group-hover:rotate-12 transition duration-300"></i>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black leading-tight text-white">
                        Professional
                        <span class="block mt-2">Healthcare,</span>
                        <span class="block mt-2 bg-gradient-to-r from-warm-orange via-soft-amber to-orange-400 bg-clip-text text-transparent animate-glow">
                            In Your Home
                        </span>
                    </h1>

                    <!-- Subheading -->
                    <p class="text-xl md:text-2xl text-white/90 leading-relaxed font-light">
                        Experience the future of healthcare with <span class="font-bold text-warm-orange">AI-powered</span> care coordination,
                        <span class="font-bold text-soft-amber">real-time monitoring</span>, and licensed professionals at your doorstep.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#packages" class="group relative inline-flex items-center justify-center px-10 py-5 bg-white text-vital-teal rounded-2xl font-bold text-lg overflow-hidden hover-lift shadow-2xl">
                            <span class="relative z-10 flex items-center gap-3">
                                <i class="fas fa-calendar-check group-hover:rotate-12 transition duration-300"></i>
                                Book a Visit
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-warm-orange to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500"></div>
                            <div class="absolute inset-0 shimmer"></div>
                        </a>
                        <a href="#how-it-works" class="group inline-flex items-center justify-center px-10 py-5 glass border-2 border-white/30 text-white rounded-2xl font-bold text-lg hover-lift backdrop-blur-xl">
                            <i class="fas fa-play-circle mr-3 group-hover:scale-125 transition duration-300"></i>
                            How It Works
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="flex flex-wrap items-center gap-8 pt-6">
                        <div class="flex items-center gap-3 glass px-4 py-3 rounded-xl border border-white/20">
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-green-400 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-xs text-white/70 font-medium">Secure</div>
                                <div class="text-sm text-white font-bold">HIPAA Compliant</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 glass px-4 py-3 rounded-xl border border-white/20">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-certificate text-blue-400 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-xs text-white/70 font-medium">Verified</div>
                                <div class="text-sm text-white font-bold">Licensed Pros</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 glass px-4 py-3 rounded-xl border border-white/20">
                            <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-amber-400 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-xs text-white/70 font-medium">Rating</div>
                                <div class="text-sm text-white font-bold">98% Satisfaction</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Card - Futuristic Dashboard Preview -->
                <div class="relative animate-slide-up">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-vital-teal/30 to-warm-orange/30 rounded-3xl blur-3xl animate-pulse-slow"></div>

                    <!-- Main Card -->
                    <div class="relative glass border border-white/30 rounded-3xl p-8 backdrop-blur-2xl shadow-2xl card-3d">
                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="glass rounded-2xl p-6 text-center border border-white/20 hover-lift group cursor-pointer">
                                <div class="text-4xl font-black bg-gradient-to-r from-warm-orange to-orange-400 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition duration-300">5000+</div>
                                <div class="text-sm text-white/80 font-semibold">Happy Patients</div>
                                <div class="mt-2 flex justify-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></div>
                                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                                </div>
                            </div>
                            <div class="glass rounded-2xl p-6 text-center border border-white/20 hover-lift group cursor-pointer">
                                <div class="text-4xl font-black bg-gradient-to-r from-vital-teal to-teal-400 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition duration-300">500+</div>
                                <div class="text-sm text-white/80 font-semibold">Care Providers</div>
                                <div class="mt-2 flex justify-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></div>
                                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                    <div class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Services Preview with Icons -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 glass p-4 rounded-xl border border-white/20 hover-lift group cursor-pointer">
                                <div class="w-14 h-14 bg-gradient-to-br from-vital-teal to-deep-teal rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition duration-300 neon-glow">
                                    <i class="fas fa-user-nurse text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-white text-lg">Home Nursing</div>
                                    <div class="text-sm text-white/70">Daily care & monitoring</div>
                                </div>
                                <i class="fas fa-arrow-right text-white/50 group-hover:text-warm-orange group-hover:translate-x-2 transition duration-300"></i>
                            </div>

                            <div class="flex items-center gap-4 glass p-4 rounded-xl border border-white/20 hover-lift group cursor-pointer">
                                <div class="w-14 h-14 bg-gradient-to-br from-warm-orange to-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition duration-300 neon-glow">
                                    <i class="fas fa-flask text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-white text-lg">Lab Services</div>
                                    <div class="text-sm text-white/70">Sample collection at home</div>
                                </div>
                                <i class="fas fa-arrow-right text-white/50 group-hover:text-warm-orange group-hover:translate-x-2 transition duration-300"></i>
                            </div>

                            <div class="flex items-center gap-4 glass p-4 rounded-xl border border-white/20 hover-lift group cursor-pointer">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition duration-300 neon-glow">
                                    <i class="fas fa-stethoscope text-2xl text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-white text-lg">Clinical Consultations</div>
                                    <div class="text-sm text-white/70">Doctor visits at home</div>
                                </div>
                                <i class="fas fa-arrow-right text-white/50 group-hover:text-warm-orange group-hover:translate-x-2 transition duration-300"></i>
                            </div>
                        </div>

                        <!-- Live Indicator -->
                        <div class="mt-6 flex items-center justify-center gap-2 text-white/80">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs font-semibold">All systems operational</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce z-10">
            <a href="#services" class="flex flex-col items-center gap-2 text-white/80 hover:text-white transition">
                <span class="text-sm font-semibold">Explore Services</span>
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-32 bg-gradient-to-br from-gray-50 via-cream to-white relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-vital-teal/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-warm-orange/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-2 glass border border-vital-teal/20 rounded-full mb-4">
                    <div class="w-2 h-2 bg-vital-teal rounded-full animate-pulse"></div>
                    <span class="text-sm font-bold text-vital-teal">Premium Healthcare Services</span>
                </div>
                <h2 class="text-5xl md:text-6xl font-black bg-gradient-to-r from-vital-teal via-deep-teal to-warm-orange bg-clip-text text-transparent">
                    Our Healthcare Services
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light">
                    Comprehensive home-based healthcare delivered by <span class="font-bold text-vital-teal">AI-assisted</span> licensed professionals
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Home Nursing -->
                <div class="group relative hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-vital-teal to-deep-teal rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative bg-white rounded-3xl p-8 shadow-xl border border-gray-100 group-hover:border-vital-teal/50 transition duration-500">
                        <div class="relative w-20 h-20 mb-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-vital-teal/20 to-vital-teal/10 rounded-2xl rotate-6 group-hover:rotate-12 transition duration-500"></div>
                            <div class="relative w-full h-full bg-gradient-to-br from-vital-teal to-deep-teal rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500">
                                <i class="fas fa-user-nurse text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 group-hover:text-vital-teal transition duration-300">Home Nursing Care</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Professional nursing care in the comfort of your home. Daily visits, wound care, medication management, and more.</p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-green-600"></i>
                                </div>
                                <span>Daily vital monitoring</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-green-600"></i>
                                </div>
                                <span>Wound care & dressing</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-green-600"></i>
                                </div>
                                <span>Medication administration</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-green-600"></i>
                                </div>
                                <span>Post-surgery care</span>
                            </li>
                        </ul>
                        <a href="/services/nursing" class="inline-flex items-center gap-2 text-vital-teal font-bold group-hover:gap-4 transition-all duration-300">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Laboratory Services -->
                <div class="group relative hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-warm-orange to-orange-600 rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative bg-white rounded-3xl p-8 shadow-xl border border-gray-100 group-hover:border-warm-orange/50 transition duration-500">
                        <div class="relative w-20 h-20 mb-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-warm-orange/20 to-warm-orange/10 rounded-2xl rotate-6 group-hover:rotate-12 transition duration-500"></div>
                            <div class="relative w-full h-full bg-gradient-to-br from-warm-orange to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500">
                                <i class="fas fa-flask text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 group-hover:text-warm-orange transition duration-300">Laboratory Services</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Complete lab testing at home. Sample collection, processing, and digital results delivered to you.</p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-orange-600"></i>
                                </div>
                                <span>Blood tests & analysis</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-orange-600"></i>
                                </div>
                                <span>Sample collection at home</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-orange-600"></i>
                                </div>
                                <span>Digital lab reports</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-orange-600"></i>
                                </div>
                                <span>Fast turnaround time</span>
                            </li>
                        </ul>
                        <a href="/services/lab" class="inline-flex items-center gap-2 text-warm-orange font-bold group-hover:gap-4 transition-all duration-300">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Clinical Consultations -->
                <div class="group relative hover-lift">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition duration-500"></div>
                    <div class="relative bg-white rounded-3xl p-8 shadow-xl border border-gray-100 group-hover:border-purple-500/50 transition duration-500">
                        <div class="relative w-20 h-20 mb-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-500/10 rounded-2xl rotate-6 group-hover:rotate-12 transition duration-500"></div>
                            <div class="relative w-full h-full bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-500">
                                <i class="fas fa-stethoscope text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 group-hover:text-purple-600 transition duration-300">Clinical Consultations</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Expert medical consultations from licensed doctors and clinicians at your location.</p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-purple-600"></i>
                                </div>
                                <span>General practitioner visits</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-purple-600"></i>
                                </div>
                                <span>Specialist consultations</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-purple-600"></i>
                                </div>
                                <span>Diagnosis & treatment plans</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-700">
                                <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-xs text-purple-600"></i>
                                </div>
                                <span>Prescription management</span>
                            </li>
                        </ul>
                        <a href="/services/clinical" class="inline-flex items-center gap-2 text-purple-600 font-bold group-hover:gap-4 transition-all duration-300">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Continue with remaining services in same pattern... -->
                <!-- ...existing code... -->
            </div>
        </div>
    </section>

                <!-- Maternal Care -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition group">
                    <div class="w-16 h-16 bg-warm-orange/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-warm-orange group-hover:scale-110 transition">
                        <i class="fas fa-baby text-3xl text-warm-orange group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-3">Maternal Care</h3>
                    <p class="text-gray-600 mb-4">Comprehensive antenatal, postnatal, and newborn care for mothers and babies.</p>
                    <ul class="space-y-2 text-sm text-gray-700 mb-6">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Antenatal checkups</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Postnatal care</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Newborn care</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Breastfeeding support</span>
                        </li>
                    </ul>
                    <a href="/services/maternal" class="inline-flex items-center text-vital-teal font-semibold hover:text-deep-teal transition">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Chronic Disease Management -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition group">
                    <div class="w-16 h-16 bg-vital-teal/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-vital-teal group-hover:scale-110 transition">
                        <i class="fas fa-heartbeat text-3xl text-vital-teal group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-3">Chronic Disease Care</h3>
                    <p class="text-gray-600 mb-4">Long-term management for diabetes, hypertension, and other chronic conditions.</p>
                    <ul class="space-y-2 text-sm text-gray-700 mb-6">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Diabetes management</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Hypertension monitoring</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Regular health tracking</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Lifestyle counseling</span>
                        </li>
                    </ul>
                    <a href="/services/chronic-care" class="inline-flex items-center text-vital-teal font-semibold hover:text-deep-teal transition">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Elder Care -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition group">
                    <div class="w-16 h-16 bg-warm-orange/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-warm-orange group-hover:scale-110 transition">
                        <i class="fas fa-hands-helping text-3xl text-warm-orange group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-3">Elder Care</h3>
                    <p class="text-gray-600 mb-4">Compassionate care for elderly patients requiring daily assistance and monitoring.</p>
                    <ul class="space-y-2 text-sm text-gray-700 mb-6">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Daily living assistance</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Companionship</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Mobility support</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-warm-orange"></i>
                            <span>Cognitive care</span>
                        </li>
                    </ul>
                    <a href="/services/elder-care" class="inline-flex items-center text-vital-teal font-semibold hover:text-deep-teal transition">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Care Packages Section -->
    <section id="packages" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Care Packages</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose the package that best fits your healthcare needs
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Basic Package -->
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-vital-teal hover:shadow-xl transition">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-deep-teal mb-2">Basic</h3>
                        <div class="text-4xl font-bold text-vital-teal mb-1">KES 25,000</div>
                        <div class="text-gray-600">/month</div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Weekly home visits</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Basic vital monitoring</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">FHG services</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Blood sugar checks</span>
                        </li>
                    </ul>
                    <button class="w-full bg-white text-vital-teal border-2 border-vital-teal px-6 py-3 rounded-lg font-semibold hover:bg-vital-teal hover:text-white transition">
                        Select Plan
                    </button>
                </div>

                <!-- Standard Package -->
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-vital-teal hover:shadow-xl transition">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-deep-teal mb-2">Standard</h3>
                        <div class="text-4xl font-bold text-vital-teal mb-1">KES 50,000</div>
                        <div class="text-gray-600">/month</div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Twice weekly visits</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">On-call support</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Wound care management</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">NGT feeding assistance</span>
                        </li>
                    </ul>
                    <button class="w-full bg-white text-vital-teal border-2 border-vital-teal px-6 py-3 rounded-lg font-semibold hover:bg-vital-teal hover:text-white transition">
                        Select Plan
                    </button>
                </div>

                <!-- Premium Package (Featured) -->
                <div class="relative bg-gradient-to-br from-vital-teal to-deep-teal border-2 border-warm-orange rounded-2xl p-8 transform scale-105 shadow-2xl">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-warm-orange text-white px-4 py-1 rounded-full text-sm font-bold">Most Popular</span>
                    </div>
                    <div class="text-center mb-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">Premium</h3>
                        <div class="text-4xl font-bold text-warm-orange mb-1">KES 200,000</div>
                        <div class="text-teal-200">/month</div>
                    </div>
                    <ul class="space-y-3 mb-8 text-white">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Daily nursing care</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Weekly laboratory tests</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>24/7 emergency access</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>High-risk monitoring</span>
                        </li>
                    </ul>
                    <button class="w-full bg-warm-orange text-white px-6 py-3 rounded-lg font-bold hover:bg-orange-600 transition shadow-lg">
                        Select Plan
                    </button>
                </div>

                <!-- Maternal Package -->
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-vital-teal hover:shadow-xl transition">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-deep-teal mb-2">Maternal</h3>
                        <div class="text-4xl font-bold text-vital-teal mb-1">KES 50,000</div>
                        <div class="text-gray-600">/trimester</div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Antenatal care</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Ultrasound support</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Antenatal profile tests</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span class="text-gray-700">Postnatal follow-up</span>
                        </li>
                    </ul>
                    <button class="w-full bg-white text-vital-teal border-2 border-vital-teal px-6 py-3 rounded-lg font-semibold hover:bg-vital-teal hover:text-white transition">
                        Select Plan
                    </button>
                </div>
            </div>

            <!-- Custom Package CTA -->
            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-4">Need a custom package? We can create a plan tailored to your specific needs.</p>
                <a href="/contact" class="inline-flex items-center text-vital-teal font-semibold hover:text-deep-teal transition">
                    Contact us for custom packages <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Getting started with Vitalnest is simple and straightforward
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-vital-teal to-deep-teal rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-3xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Create Account</h3>
                    <p class="text-gray-600">Sign up and complete your profile with medical history and preferences</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-warm-orange to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-3xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Choose Service</h3>
                    <p class="text-gray-600">Select the healthcare service or package that suits your needs</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-vital-teal to-deep-teal rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-3xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Book Visit</h3>
                    <p class="text-gray-600">Schedule your visit at a convenient time and location</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-warm-orange to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-3xl font-bold text-white">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Receive Care</h3>
                    <p class="text-gray-600">Our licensed professional arrives at your location to provide care</p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-16 bg-white rounded-2xl p-8 shadow-lg">
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="w-16 h-16 bg-vital-teal/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-2xl text-vital-teal"></i>
                        </div>
                        <h4 class="font-bold text-deep-teal mb-2">Same-Day Visits</h4>
                        <p class="text-gray-600 text-sm">Book urgent care visits and get service within hours</p>
                    </div>
                    <div>
                        <div class="w-16 h-16 bg-warm-orange/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-2xl text-warm-orange"></i>
                        </div>
                        <h4 class="font-bold text-deep-teal mb-2">Track Everything</h4>
                        <p class="text-gray-600 text-sm">Monitor visits, view reports, and access records online</p>
                    </div>
                    <div>
                        <div class="w-16 h-16 bg-vital-teal/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-2xl text-vital-teal"></i>
                        </div>
                        <h4 class="font-bold text-deep-teal mb-2">Flexible Payment</h4>
                        <p class="text-gray-600 text-sm">Pay via M-Pesa, bank transfer, or credit card</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">What Our Patients Say</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real stories from families who trust Vitalnest with their healthcare
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-cream rounded-2xl p-8 shadow-lg border-l-4 border-vital-teal">
                    <div class="flex items-center gap-1 text-warm-orange mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "Vitalnest has been a blessing for my elderly mother. The nurses are professional, caring, and always punctual. Highly recommended!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-vital-teal rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">MJ</span>
                        </div>
                        <div>
                            <div class="font-bold text-deep-teal">Margaret Johnson</div>
                            <div class="text-sm text-gray-600">Nairobi, Kenya</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-cream rounded-2xl p-8 shadow-lg border-l-4 border-warm-orange">
                    <div class="flex items-center gap-1 text-warm-orange mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "The lab service is incredibly convenient. They came to my home, took samples, and I got my results online within 24 hours. Excellent service!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-warm-orange rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">DK</span>
                        </div>
                        <div>
                            <div class="font-bold text-deep-teal">David Kipchoge</div>
                            <div class="text-sm text-gray-600">Mombasa, Kenya</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-cream rounded-2xl p-8 shadow-lg border-l-4 border-vital-teal">
                    <div class="flex items-center gap-1 text-warm-orange mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "The maternal care package was perfect for my pregnancy journey. Professional, caring, and always available when I needed them."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-vital-teal rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">SO</span>
                        </div>
                        <div>
                            <div class="font-bold text-deep-teal">Sarah Omondi</div>
                            <div class="text-sm text-gray-600">Kisumu, Kenya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-vital-teal via-teal-600 to-deep-teal text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-teal-100 mb-8">
                Join thousands of families who trust Vitalnest for their home healthcare needs
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register.php" class="inline-flex items-center justify-center px-10 py-4 bg-warm-orange text-white rounded-xl font-bold hover:bg-orange-600 transition shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Account
                </a>
                <a href="#packages" class="inline-flex items-center justify-center px-10 py-4 bg-white text-vital-teal rounded-xl font-bold hover:bg-gray-100 transition shadow-xl">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Book a Visit
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-teal to-warm-orange rounded-lg flex items-center justify-center">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <div>
                            <div class="font-bold text-white text-lg">Vitalnest</div>
                            <div class="text-xs text-gray-400">Home Healthcare</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">
                        Professional home healthcare services delivered with compassion and excellence.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-vital-teal transition">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-vital-teal transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-vital-teal transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-vital-teal transition">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="font-bold text-white mb-4">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/services/nursing" class="hover:text-warm-orange transition">Home Nursing</a></li>
                        <li><a href="/services/lab" class="hover:text-warm-orange transition">Laboratory Services</a></li>
                        <li><a href="/services/clinical" class="hover:text-warm-orange transition">Clinical Consultations</a></li>
                        <li><a href="/services/maternal" class="hover:text-warm-orange transition">Maternal Care</a></li>
                        <li><a href="/services/chronic-care" class="hover:text-warm-orange transition">Chronic Disease Care</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-bold text-white mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/about" class="hover:text-warm-orange transition">About Us</a></li>
                        <li><a href="/careers" class="hover:text-warm-orange transition">Careers</a></li>
                        <li><a href="/providers" class="hover:text-warm-orange transition">For Providers</a></li>
                        <li><a href="/contact" class="hover:text-warm-orange transition">Contact Us</a></li>
                        <li><a href="/blog" class="hover:text-warm-orange transition">Blog</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-bold text-white mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/help" class="hover:text-warm-orange transition">Help Center</a></li>
                        <li><a href="/faq" class="hover:text-warm-orange transition">FAQs</a></li>
                        <li><a href="/privacy" class="hover:text-warm-orange transition">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-warm-orange transition">Terms of Service</a></li>
                        <li><a href="/hipaa" class="hover:text-warm-orange transition">HIPAA Compliance</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">
                        &copy; <?php echo date('Y'); ?> Vitalnest Homecare. All rights reserved.
                    </p>
                    <div class="flex gap-6 text-sm">
                        <a href="tel:+254700000000" class="hover:text-warm-orange transition">
                            <i class="fas fa-phone mr-2"></i>+254 700 000 000
                        </a>
                        <a href="mailto:support@vitalnest.com" class="hover:text-warm-orange transition">
                            <i class="fas fa-envelope mr-2"></i>support@vitalnest.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Package selection handling
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Select Plan')) {
                button.addEventListener('click', function() {
                    <?php if ($isLoggedIn): ?>
                        // Redirect to booking page
                        window.location.href = '/booking';
                    <?php else: ?>
                        // Redirect to registration
                        window.location.href = '/register.php';
                    <?php endif; ?>
                });
            }
        });

        // Mobile menu toggle (if needed)
        // Add mobile menu functionality here
    </script>
</body>
</html>

