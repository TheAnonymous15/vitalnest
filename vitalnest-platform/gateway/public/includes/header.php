<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Vitalnest - Professional Home Healthcare Services'; ?></title>
    <meta name="description" content="<?php echo $pageDescription ?? 'Book professional home healthcare services. Licensed nurses, clinicians, and lab services at your doorstep.'; ?>">

    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GSAP Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/MotionPathPlugin.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Primary colors from brochure
                        'vital-black': '#1A1A1A',
                        'vital-dark': '#0D0D0D',
                        'vital-orange': '#F97316',
                        'vital-orange-light': '#FB923C',
                        'vital-orange-dark': '#EA580C',
                        // Teal accents
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                        'teal-accent': '#14B8A6',
                        // Supporting colors
                        'warm-orange': '#FDBA74',
                        'soft-amber': '#FCD34D',
                        'cream': '#FFFBEB',
                        // Grays
                        'gray-dark': '#262626',
                        'gray-medium': '#404040',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.6s ease-out forwards',
                        'slide-in': 'slideIn 0.8s ease-out forwards',
                        'slide-down': 'slideDown 0.8s ease-out forwards',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                        'glow': 'glow 3s ease-in-out infinite alternate',
                        'shimmer': 'shimmer 3s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'pulse-ring': 'pulseRing 2s ease-out infinite',
                        'bounce-in': 'bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                        'spin-slow': 'spin 20s linear infinite',
                        'spin-reverse': 'spinReverse 15s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        spinReverse: {
                            '0%': { transform: 'rotate(360deg)' },
                            '100%': { transform: 'rotate(0deg)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 3px rgba(15, 118, 110, 0.3), 0 0 6px rgba(15, 118, 110, 0.2)' },
                            '100%': { boxShadow: '0 0 8px rgba(15, 118, 110, 0.4), 0 0 12px rgba(15, 118, 110, 0.3), 0 0 16px rgba(15, 118, 110, 0.2)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-1000px 0' },
                            '50%': { backgroundPosition: '1000px 0' },
                            '100%': { backgroundPosition: '1000px 0' },
                        },
                        pulseRing: {
                            '0%': { boxShadow: '0 0 0 0 rgba(15, 118, 110, 0.4)' },
                            '70%': { boxShadow: '0 0 0 12px rgba(15, 118, 110, 0)' },
                            '100%': { boxShadow: '0 0 0 0 rgba(15, 118, 110, 0)' },
                        },
                        bounceIn: {
                            '0%': { opacity: '0', transform: 'scale(0.3)' },
                            '50%': { opacity: '1', transform: 'scale(1.05)' },
                            '100%': { transform: 'scale(1)' },
                        },
                    },
                }
            }
        }
    </script>

    <!-- Global Styles -->
    <style>
        /* Reset and Base Styles */
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        /* Custom scrollbar - Premium styling */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #0F766E 0%, #F97316 100%);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #134E4A 0%, #F97316 100%);
            box-shadow: 0 0 10px rgba(15, 118, 110, 0.3);
        }

        /* Firefox scrollbar */
        * {
            scrollbar-color: linear-gradient(180deg, #0F766E 0%, #F97316 100%) #f0f0f0;
            scrollbar-width: thin;
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Gradient text effects */
        .gradient-text {
            background: linear-gradient(135deg, #0F766E 0%, #F97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(15, 118, 110, 0.1));
        }

        .gradient-text-purple {
            background: linear-gradient(135deg, #9333EA 0%, #F97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animated gradient background - Eye-friendly */
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

        /* Hover lift effect for cards */
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

        .neon-glow-warm {
            box-shadow: 0 0 5px rgba(249, 115, 22, 0.2),
                        0 0 10px rgba(249, 115, 22, 0.15),
                        0 0 15px rgba(249, 115, 22, 0.1);
        }

        /* Shimmer effect for loading/highlighting */
        .shimmer {
            background: linear-gradient(90deg,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        /* Particle background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 10s infinite;
            opacity: 0.6;
        }

        /* Floating shapes - very subtle */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            animation: float 8s ease-in-out infinite;
            filter: blur(40px);
        }

        /* Perspective card effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.320, 1);
            perspective: 1000px;
        }

        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg) translateZ(20px);
        }

        /* Gradient border animation */
        @keyframes borderGlow {
            0%, 100% { border-color: #0F766E; }
            50% { border-color: #F97316; }
        }

        .border-glow {
            animation: borderGlow 3s ease-in-out infinite;
        }

        /* Smooth transitions */
        a, button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Selection styling */
        ::selection {
            background: #0F766E;
            color: white;
        }

        ::-moz-selection {
            background: #0F766E;
            color: white;
        }

        /* Link styling */
        a {
            color: inherit;
            text-decoration: none;
        }

        /* Button reset */
        button {
            border: none;
            background: none;
            cursor: pointer;
        }

        /* Form elements styling */
        input, textarea, select {
            font-family: inherit;
        }

        /* Image optimization */
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Focus visible for accessibility */
        :focus-visible {
            outline: 2px solid #0F766E;
            outline-offset: 2px;
        }

        /* Loading skeleton animation */
        @keyframes skeleton-loading {
            0% {
                background-color: rgba(255, 255, 255, 0.2);
            }
            50% {
                background-color: rgba(255, 255, 255, 0.4);
            }
            100% {
                background-color: rgba(255, 255, 255, 0.2);
            }
        }

        .skeleton {
            animation: skeleton-loading 1.5s infinite;
        }

        /* Smooth fade transitions */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Print styles */
        @media print {
            * {
                box-shadow: none !important;
                text-shadow: none !important;
            }
        }

        /* Reduced motion preference */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            ::-webkit-scrollbar-track {
                background: #1a1a1a;
            }

            ::selection {
                background: #0F766E;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: more) {
            .glass {
                background: rgba(255, 255, 255, 0.15);
                border: 1px solid rgba(0, 0, 0, 0.3);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-cream font-sans antialiased overflow-x-hidden">



