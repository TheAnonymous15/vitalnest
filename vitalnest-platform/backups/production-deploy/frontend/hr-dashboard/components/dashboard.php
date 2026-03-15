<?php
// Check authentication
$token = $_COOKIE['hr_token'] ?? '';
if (empty($token)) {
    header('Location: ../');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitalNest HR - Enterprise Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(to bottom right, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            overflow-x: hidden;
        }

        /* Animated background particles */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .bg-particle {
            position: fixed;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        /* Mega menu styles */
        .mega-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            border-top: 2px solid rgba(34, 211, 238, 0.3);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .mega-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }


        /* Quick action cards */
        .quick-card {
            transition: all 0.3s ease;
        }

        .quick-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 40px rgba(34, 211, 238, 0.3);
        }

        /* Command palette */
        .command-palette {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 90%;
            max-width: 600px;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(30px);
            border: 2px solid rgba(34, 211, 238, 0.3);
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.8);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .command-palette.active {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Floating action button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(34, 211, 238, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 15px 40px rgba(34, 211, 238, 0.6);
        }

        /* Breadcrumb animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .breadcrumb-item {
            animation: slideIn 0.3s ease forwards;
        }

        /* Submenu styles */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.open {
            max-height: 500px;
        }

        /* 3D Submenu Items */
        .submenu > div {
            position: relative;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform-style: preserve-3d;
        }

        .submenu > div::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 3px;
            height: 0;
            background: linear-gradient(180deg, #22d3ee, #06b6d4);
            transform: translateY(-50%);
            transition: height 0.3s ease;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
        }

        .submenu > div:hover {
            transform: translateX(6px) translateZ(3px);
            background: rgba(34, 211, 238, 0.05);
            padding-left: 20px;
        }

        .submenu > div:hover::before {
            height: 60%;
        }

        .submenu > div i {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .submenu > div:hover i {
            transform: translateZ(5px) scale(1.1);
            color: #22d3ee;
            filter: drop-shadow(0 2px 4px rgba(34, 211, 238, 0.6));
        }

        /* 3D Glassmorphic Sidebar */
        .sidebar {
            position: relative;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(15, 23, 42, 0.9) 0%,
                rgba(30, 41, 59, 0.85) 50%,
                rgba(15, 23, 42, 0.9) 100%
            );
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            border-radius: 0 30px 30px 0;
            border-right: 1px solid rgba(34, 211, 238, 0.3);
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                inset 0 -1px 0 rgba(0, 0, 0, 0.2),
                20px 0 60px rgba(34, 211, 238, 0.1);
            z-index: -1;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: -2px;
            width: 2px;
            height: 100%;
            background: linear-gradient(
                180deg,
                transparent,
                rgba(34, 211, 238, 0.6) 30%,
                rgba(249, 115, 22, 0.6) 70%,
                transparent
            );
            filter: blur(2px);
            animation: edgeGlow 3s ease-in-out infinite;
        }

        @keyframes edgeGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        /* Animated gradient overlay */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .sidebar::before {
            animation: gradientShift 15s ease infinite;
            background-size: 200% 200%;
        }

        /* 3D Depth Layers */
        .sidebar-layer {
            position: absolute;
            inset: 0;
            border-radius: 0 30px 30px 0;
            pointer-events: none;
        }

        .sidebar-layer-1 {
            background: linear-gradient(
                135deg,
                rgba(34, 211, 238, 0.05) 0%,
                transparent 50%,
                rgba(249, 115, 22, 0.05) 100%
            );
            transform: translateZ(10px);
        }

        .sidebar-layer-2 {
            background: radial-gradient(
                circle at 50% 0%,
                rgba(34, 211, 238, 0.1),
                transparent 70%
            );
            transform: translateZ(20px);
        }

        .sidebar-collapsed {
            width: 80px;
        }

        /* Logo Section with 3D effect */
        .logo-container {
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.4s ease;
        }

        .logo-container:hover {
            transform: translateZ(10px) scale(1.02);
        }

        .logo-icon {
            position: relative;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            filter: drop-shadow(0 10px 20px rgba(34, 211, 238, 0.4));
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            inset: -5px;
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
            filter: blur(15px);
        }

        .logo-icon:hover::before {
            opacity: 0.6;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(0.95); }
            50% { transform: scale(1.05); }
        }

        /* 3D Menu Items */
        .menu-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform-style: preserve-3d;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.02) 0%,
                rgba(255, 255, 255, 0.05) 50%,
                rgba(255, 255, 255, 0.02) 100%
            );
            border-left: 3px solid transparent;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(
                circle,
                rgba(34, 211, 238, 0.3),
                transparent 70%
            );
            transform: translate(-50%, -50%);
            transition: all 0.5s ease;
            border-radius: 50%;
        }

        .menu-item:hover::before {
            width: 400px;
            height: 400px;
        }

        .menu-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(34, 211, 238, 0.1) 0%,
                transparent 100%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
            transform: translateX(-100%);
        }

        .menu-item:hover {
            transform: translateX(8px) translateZ(5px);
            background: rgba(34, 211, 238, 0.08);
            border-left-color: #22d3ee;
            box-shadow:
                0 4px 20px rgba(34, 211, 238, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .menu-item:hover::after {
            opacity: 1;
            transform: translateX(0);
        }

        .menu-item.active {
            background: linear-gradient(
                90deg,
                rgba(34, 211, 238, 0.2) 0%,
                rgba(34, 211, 238, 0.1) 100%
            );
            border-left-color: #22d3ee;
            transform: translateX(8px) translateZ(5px);
            box-shadow:
                0 4px 30px rgba(34, 211, 238, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                inset -1px 0 0 rgba(34, 211, 238, 0.5);
        }

        .menu-item.active::after {
            opacity: 1;
            transform: translateX(0);
        }

        /* 3D Icon Animation */
        .menu-item i {
            position: relative;
            display: inline-block;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        .menu-item:hover i {
            transform: translateZ(10px) scale(1.2) rotate(5deg);
            filter: drop-shadow(0 4px 8px rgba(34, 211, 238, 0.6));
        }

        .menu-item.active i {
            transform: translateZ(10px) scale(1.15);
            filter: drop-shadow(0 4px 8px rgba(34, 211, 238, 0.8));
        }

        /* Chevron rotation with 3D effect */
        .menu-item [id$="-icon"] {
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Parallax scroll effect */
        .sidebar-content {
            position: relative;
            z-index: 10;
        }

        /* Floating particles in sidebar */
        @keyframes floatParticle {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translate(10px, -20px) rotate(180deg);
                opacity: 0.6;
            }
        }

        .sidebar-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.2;
            filter: blur(1px);
        }

        .sidebar-particle:nth-child(1) {
            top: 10%;
            left: 20%;
            animation: floatParticle 8s ease-in-out infinite;
        }

        .sidebar-particle:nth-child(2) {
            top: 30%;
            left: 70%;
            animation: floatParticle 10s ease-in-out infinite 2s;
        }

        .sidebar-particle:nth-child(3) {
            top: 50%;
            left: 40%;
            animation: floatParticle 12s ease-in-out infinite 4s;
        }

        .sidebar-particle:nth-child(4) {
            top: 70%;
            left: 60%;
            animation: floatParticle 9s ease-in-out infinite 1s;
        }

        .sidebar-particle:nth-child(5) {
            top: 85%;
            left: 30%;
            animation: floatParticle 11s ease-in-out infinite 3s;
        }

        /* User profile section 3D effect */
        .user-profile-section {
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.4s ease;
        }

        .user-profile-section:hover {
            transform: translateZ(10px) scale(1.02);
            box-shadow: 0 10px 30px rgba(34, 211, 238, 0.3);
        }

        .user-avatar {
            position: relative;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .user-avatar::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, #22d3ee, #F97316);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
            filter: blur(10px);
            animation: avatarGlow 3s ease-in-out infinite;
        }

        @keyframes avatarGlow {
            0%, 100% { opacity: 0.3; transform: scale(0.95); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        .user-profile-section:hover .user-avatar {
            transform: translateZ(15px) scale(1.1);
        }

        /* Navigation Section 3D styling */
        nav.sidebar-nav {
            transform-style: preserve-3d;
        }

        /* 3D Dashboard Title with depth */
        .dashboard-title {
            position: relative;
            transform-style: preserve-3d;
        }

        .dashboard-title::after {
            content: attr(data-text);
            position: absolute;
            left: 2px;
            top: 2px;
            z-index: -1;
            background: linear-gradient(135deg, rgba(34, 211, 238, 0.3), rgba(6, 182, 212, 0.3));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: blur(4px);
        }

        /* Settings Menu Item special styling */
        .menu-item.settings-item {
            margin-top: 8px;
            border-top: 1px solid rgba(34, 211, 238, 0.2);
            padding-top: 12px;
        }

        .menu-item.settings-item:hover {
            background: linear-gradient(
                90deg,
                rgba(249, 115, 22, 0.1) 0%,
                rgba(34, 211, 238, 0.05) 100%
            );
            border-left-color: #F97316;
        }

        /* Responsive 3D effect adjustments */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateZ(0);
            }

            .menu-item:hover {
                transform: translateX(4px);
            }
        }

        /* 3D Main Content Panel */
        .main-content-panel {
            position: relative;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .main-content-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(15, 23, 42, 0.7) 0%,
                rgba(30, 41, 59, 0.6) 50%,
                rgba(15, 23, 42, 0.7) 100%
            );
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);
            border-radius: 30px;
            border: 1px solid rgba(34, 211, 238, 0.2);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                inset 0 -1px 0 rgba(0, 0, 0, 0.2),
                -20px 0 60px rgba(34, 211, 238, 0.05);
            z-index: -1;
            animation: gradientShift 20s ease infinite;
            background-size: 200% 200%;
        }

        /* Content depth layers */
        .content-layer {
            position: absolute;
            inset: 0;
            border-radius: 30px;
            pointer-events: none;
        }

        .content-layer-1 {
            background: linear-gradient(
                135deg,
                rgba(34, 211, 238, 0.03) 0%,
                transparent 50%,
                rgba(249, 115, 22, 0.03) 100%
            );
            transform: translateZ(10px);
        }

        .content-layer-2 {
            background: radial-gradient(
                circle at 80% 20%,
                rgba(34, 211, 238, 0.08),
                transparent 60%
            );
            transform: translateZ(20px);
        }

        /* Floating particles in content area */
        .content-particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            opacity: 0.15;
            filter: blur(2px);
            pointer-events: none;
        }

        .content-particle:nth-child(1) {
            width: 6px;
            height: 6px;
            top: 15%;
            right: 10%;
            animation: floatParticle 10s ease-in-out infinite;
        }

        .content-particle:nth-child(2) {
            width: 4px;
            height: 4px;
            top: 40%;
            right: 30%;
            animation: floatParticle 12s ease-in-out infinite 2s;
        }

        .content-particle:nth-child(3) {
            width: 5px;
            height: 5px;
            top: 65%;
            right: 50%;
            animation: floatParticle 14s ease-in-out infinite 4s;
        }

        .content-particle:nth-child(4) {
            width: 3px;
            height: 3px;
            top: 80%;
            right: 20%;
            animation: floatParticle 11s ease-in-out infinite 1s;
        }

        /* 3D Header Section */
        .content-header {
            position: relative;
            transform-style: preserve-3d;
            background: linear-gradient(
                90deg,
                rgba(34, 211, 238, 0.05) 0%,
                rgba(255, 255, 255, 0.02) 100%
            );
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(34, 211, 238, 0.2);
            transition: all 0.4s ease;
        }

        .content-header::before {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 30%;
            height: 2px;
            background: linear-gradient(90deg, #22d3ee, transparent);
            box-shadow: 0 0 20px rgba(34, 211, 238, 0.5);
            animation: headerGlow 3s ease-in-out infinite;
        }

        @keyframes headerGlow {
            0%, 100% {
                width: 30%;
                opacity: 0.5;
            }
            50% {
                width: 60%;
                opacity: 1;
            }
        }

        /* 3D Section Title */
        .section-title {
            position: relative;
            transform-style: preserve-3d;
            display: inline-block;
        }

        .section-title::before {
            content: attr(data-text);
            position: absolute;
            left: 3px;
            top: 3px;
            z-index: -1;
            background: linear-gradient(135deg, rgba(34, 211, 238, 0.4), rgba(6, 182, 212, 0.4));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: blur(6px);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #22d3ee, #F97316, transparent);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .section-title:hover::after {
            transform: scaleX(1);
        }

        /* 3D Stat Cards */
        .stat-card {
            position: relative;
            transform-style: preserve-3d;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.05) 0%,
                rgba(255, 255, 255, 0.02) 100%
            );
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--card-color), transparent);
            box-shadow: 0 0 20px var(--card-color);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(
                circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                rgba(34, 211, 238, 0.15),
                transparent 50%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px) translateZ(20px) rotateX(5deg);
            border-color: var(--card-color);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 40px var(--card-color-alpha),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        /* 3D Glass Panel */
        .glass-panel {
            position: relative;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.08) 0%,
                rgba(255, 255, 255, 0.03) 100%
            );
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .glass-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(34, 211, 238, 0.08) 50%,
                transparent 70%
            );
            transform: rotate(45deg);
            transition: all 0.6s;
        }

        .glass-panel:hover {
            transform: translateY(-5px) translateZ(10px);
            border-color: rgba(34, 211, 238, 0.3);
            box-shadow:
                0 15px 45px rgba(0, 0, 0, 0.4),
                0 0 30px rgba(34, 211, 238, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .glass-panel:hover::before {
            animation: holographic 2s linear infinite;
        }

        /* 3D Button Effects */
        .btn-3d {
            position: relative;
            transform-style: preserve-3d;
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            border: 1px solid rgba(34, 211, 238, 0.5);
            box-shadow:
                0 5px 15px rgba(34, 211, 238, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        .btn-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-3d:hover {
            transform: translateY(-3px) translateZ(10px);
            box-shadow:
                0 10px 30px rgba(34, 211, 238, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .btn-3d:hover::before {
            left: 100%;
        }

        .btn-3d:active {
            transform: translateY(-1px) translateZ(5px);
        }

        /* Breadcrumb 3D effect */
        .breadcrumb-3d {
            position: relative;
            transform-style: preserve-3d;
        }

        .breadcrumb-3d a {
            position: relative;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .breadcrumb-3d a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #22d3ee, #06b6d4);
            transition: width 0.3s ease;
            box-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
        }

        .breadcrumb-3d a:hover {
            transform: translateZ(5px);
            text-shadow: 0 0 20px rgba(34, 211, 238, 0.6);
        }

        .breadcrumb-3d a:hover::after {
            width: 100%;
        }

        /* Notification bell 3D animation */
        .notification-bell {
            position: relative;
            transition: all 0.3s ease;
        }

        .notification-bell:hover {
            transform: translateZ(10px) scale(1.1);
            animation: bellRing 0.5s ease-in-out;
        }

        @keyframes bellRing {
            0%, 100% { transform: translateZ(10px) rotate(0deg) scale(1.1); }
            25% { transform: translateZ(10px) rotate(-15deg) scale(1.1); }
            75% { transform: translateZ(10px) rotate(15deg) scale(1.1); }
        }

        /* Search box 3D effect */
        .search-3d {
            position: relative;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .search-3d:focus-within {
            transform: translateZ(10px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(34, 211, 238, 0.5);
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.3),
                0 0 30px rgba(34, 211, 238, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        /* Activity feed 3D items */
        .activity-item {
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #22d3ee, transparent);
            transform: translateY(-50%);
            transition: width 0.3s ease;
            box-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
        }

        .activity-item:hover {
            transform: translateX(10px) translateZ(5px);
            background: rgba(34, 211, 238, 0.05);
        }

        .activity-item:hover::before {
            width: 4px;
        }

        /* Scrollbar for content */
        .content-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .content-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            margin: 10px 0;
        }

        .content-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #22d3ee, #06b6d4);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
        }

        .content-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #06b6d4, #22d3ee);
            box-shadow: 0 0 15px rgba(34, 211, 238, 0.8);
        }
    </style>
</head>
<body class="flex h-screen">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-72 bg-transparent flex flex-col relative overflow-hidden">
        <!-- 3D Depth Layers -->
        <div class="sidebar-layer sidebar-layer-1"></div>
        <div class="sidebar-layer sidebar-layer-2"></div>

        <!-- Floating Particles -->
        <div class="sidebar-particle"></div>
        <div class="sidebar-particle"></div>
        <div class="sidebar-particle"></div>
        <div class="sidebar-particle"></div>
        <div class="sidebar-particle"></div>

        <div class="sidebar-content relative z-10 flex flex-col h-full">
            <!-- Logo -->
            <div class="logo-container p-6 border-b border-cyan-400/20">
                <div class="flex items-center gap-3">
                    <div class="logo-icon w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-400/30 relative">
                        <i class="fas fa-users-cog text-white text-xl"></i>
                    </div>
                    <div class="sidebar-text">
                        <h1 class="text-xl font-black text-white bg-gradient-to-r from-cyan-400 to-white bg-clip-text text-transparent">VitalNest</h1>
                        <p class="text-xs text-cyan-400 font-semibold">HR Enterprise</p>
                    </div>
                </div>
            </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-2">
            <!-- Dashboard -->
            <div class="menu-item active px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('dashboard')">
                <div class="flex items-center gap-3">
                    <i class="fas fa-home text-cyan-400 w-5"></i>
                    <span class="sidebar-text text-white font-medium">Dashboard</span>
                </div>
            </div>

            <!-- Employee Management -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('employees')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Employees</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="employees-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="employees-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('employee-list')">
                        <i class="fas fa-list w-4"></i> All Employees
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('add-employee')">
                        <i class="fas fa-user-plus w-4"></i> Add Employee
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('departments')">
                        <i class="fas fa-sitemap w-4"></i> Departments
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('positions')">
                        <i class="fas fa-briefcase w-4"></i> Positions
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('org-chart')">
                        <i class="fas fa-diagram-project w-4"></i> Org Chart
                    </div>
                </div>
            </div>

            <!-- Recruitment & Onboarding -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('recruitment')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-tie text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Recruitment</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="recruitment-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="recruitment-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('job-postings')">
                        <i class="fas fa-newspaper w-4"></i> Job Postings
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('applications')">
                        <i class="fas fa-file-alt w-4"></i> Applications
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('interviews')">
                        <i class="fas fa-calendar-check w-4"></i> Interviews
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('candidates')">
                        <i class="fas fa-user-clock w-4"></i> Candidates
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('onboarding')">
                        <i class="fas fa-clipboard-check w-4"></i> Onboarding
                    </div>
                </div>
            </div>

            <!-- Attendance & Leave -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('attendance')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Attendance</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="attendance-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="attendance-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('daily-attendance')">
                        <i class="fas fa-user-check w-4"></i> Daily Attendance
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('leave-requests')">
                        <i class="fas fa-envelope-open-text w-4"></i> Leave Requests
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('leave-balance')">
                        <i class="fas fa-chart-pie w-4"></i> Leave Balance
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('holidays')">
                        <i class="fas fa-calendar-day w-4"></i> Holidays
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('shifts')">
                        <i class="fas fa-clock w-4"></i> Shift Management
                    </div>
                </div>
            </div>

            <!-- Payroll & Compensation -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('payroll')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-money-bill-wave text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Payroll</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="payroll-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="payroll-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('run-payroll')">
                        <i class="fas fa-play-circle w-4"></i> Run Payroll
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('payslips')">
                        <i class="fas fa-file-invoice-dollar w-4"></i> Payslips
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('salary-structure')">
                        <i class="fas fa-coins w-4"></i> Salary Structure
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('bonuses')">
                        <i class="fas fa-gift w-4"></i> Bonuses & Allowances
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('deductions')">
                        <i class="fas fa-minus-circle w-4"></i> Deductions
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('tax-compliance')">
                        <i class="fas fa-receipt w-4"></i> Tax & Compliance
                    </div>
                </div>
            </div>

            <!-- Performance Management -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('performance')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chart-line text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Performance</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="performance-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="performance-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('appraisals')">
                        <i class="fas fa-star w-4"></i> Appraisals
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('goals')">
                        <i class="fas fa-bullseye w-4"></i> Goals & KPIs
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('reviews')">
                        <i class="fas fa-comment-dots w-4"></i> Reviews & Feedback
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('promotions')">
                        <i class="fas fa-level-up-alt w-4"></i> Promotions
                    </div>
                </div>
            </div>

            <!-- Training & Development -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('training')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Training</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="training-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="training-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('courses')">
                        <i class="fas fa-book w-4"></i> Training Courses
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('certifications')">
                        <i class="fas fa-certificate w-4"></i> Certifications
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('skills-matrix')">
                        <i class="fas fa-table w-4"></i> Skills Matrix
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('learning-paths')">
                        <i class="fas fa-route w-4"></i> Learning Paths
                    </div>
                </div>
            </div>

            <!-- Documents & Policies -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('documents')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-folder-open text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Documents</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="documents-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="documents-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('contracts')">
                        <i class="fas fa-file-contract w-4"></i> Contracts
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('policies')">
                        <i class="fas fa-gavel w-4"></i> HR Policies
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('handbooks')">
                        <i class="fas fa-book-open w-4"></i> Employee Handbook
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('templates')">
                        <i class="fas fa-file-medical w-4"></i> Templates
                    </div>
                </div>
            </div>

            <!-- Benefits & Insurance -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('benefits')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-shield-alt text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Benefits</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="benefits-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="benefits-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('health-insurance')">
                        <i class="fas fa-heartbeat w-4"></i> Health Insurance
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('retirement-plans')">
                        <i class="fas fa-piggy-bank w-4"></i> Retirement Plans
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('life-insurance')">
                        <i class="fas fa-hand-holding-heart w-4"></i> Life Insurance
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('employee-perks')">
                        <i class="fas fa-gift w-4"></i> Perks & Rewards
                    </div>
                </div>
            </div>

            <!-- Time & Attendance Tracking -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('timetracking')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-business-time text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Time Tracking</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="timetracking-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="timetracking-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('timesheets')">
                        <i class="fas fa-clipboard-list w-4"></i> Timesheets
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('overtime')">
                        <i class="fas fa-hourglass-end w-4"></i> Overtime Management
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('time-off-accruals')">
                        <i class="fas fa-calendar-plus w-4"></i> Time-off Accruals
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('work-schedules')">
                        <i class="fas fa-calendar-week w-4"></i> Work Schedules
                    </div>
                </div>
            </div>

            <!-- Employee Wellness -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('wellness')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-spa text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Wellness</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="wellness-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="wellness-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('wellness-programs')">
                        <i class="fas fa-running w-4"></i> Wellness Programs
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('eap')">
                        <i class="fas fa-hands-helping w-4"></i> Employee Assistance
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('health-screenings')">
                        <i class="fas fa-stethoscope w-4"></i> Health Screenings
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('mental-health')">
                        <i class="fas fa-brain w-4"></i> Mental Health
                    </div>
                </div>
            </div>

            <!-- Assets & Equipment -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('assets')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-laptop text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Assets</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="assets-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="assets-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('equipment-tracking')">
                        <i class="fas fa-desktop w-4"></i> Equipment Tracking
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('asset-assignment')">
                        <i class="fas fa-hand-holding w-4"></i> Asset Assignment
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('asset-maintenance')">
                        <i class="fas fa-tools w-4"></i> Maintenance Log
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('asset-requests')">
                        <i class="fas fa-clipboard-check w-4"></i> Asset Requests
                    </div>
                </div>
            </div>

            <!-- Compliance & Legal -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('compliance')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-balance-scale text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Compliance</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="compliance-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="compliance-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('labor-laws')">
                        <i class="fas fa-gavel w-4"></i> Labor Laws
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('audits')">
                        <i class="fas fa-search-dollar w-4"></i> Audits
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('legal-cases')">
                        <i class="fas fa-file-contract w-4"></i> Legal Cases
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('licenses-permits')">
                        <i class="fas fa-id-card w-4"></i> Licenses & Permits
                    </div>
                </div>
            </div>

            <!-- Succession Planning -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('succession')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users-cog text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Succession</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="succession-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="succession-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('succession-plans')">
                        <i class="fas fa-sitemap w-4"></i> Succession Plans
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('talent-pool')">
                        <i class="fas fa-user-friends w-4"></i> Talent Pool
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('leadership-pipeline')">
                        <i class="fas fa-project-diagram w-4"></i> Leadership Pipeline
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('career-paths')">
                        <i class="fas fa-road w-4"></i> Career Paths
                    </div>
                </div>
            </div>

            <!-- Offboarding & Exit -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('offboarding')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-door-open text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Offboarding</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="offboarding-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="offboarding-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('resignations')">
                        <i class="fas fa-user-minus w-4"></i> Resignations
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('exit-interviews')">
                        <i class="fas fa-comments w-4"></i> Exit Interviews
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('final-settlements')">
                        <i class="fas fa-money-check-alt w-4"></i> Final Settlements
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('alumni-network')">
                        <i class="fas fa-network-wired w-4"></i> Alumni Network
                    </div>
                </div>
            </div>

            <!-- Employee Relations -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('relations')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-handshake text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Relations</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="relations-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="relations-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('grievances')">
                        <i class="fas fa-exclamation-triangle w-4"></i> Grievances
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('disciplinary')">
                        <i class="fas fa-gavel w-4"></i> Disciplinary Actions
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('employee-surveys')">
                        <i class="fas fa-poll w-4"></i> Employee Surveys
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('engagement')">
                        <i class="fas fa-smile w-4"></i> Engagement
                    </div>
                </div>
            </div>

            <!-- Reports & Analytics -->
            <div>
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('reports')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chart-bar text-cyan-400 w-5"></i>
                            <span class="sidebar-text text-white font-medium">Reports</span>
                        </div>
                        <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="reports-icon"></i>
                    </div>
                </div>
                <div class="submenu pl-12 mt-1 space-y-1" id="reports-submenu">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('hr-analytics')">
                        <i class="fas fa-chart-area w-4"></i> HR Analytics
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('headcount-reports')">
                        <i class="fas fa-users w-4"></i> Headcount Reports
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('turnover-analysis')">
                        <i class="fas fa-exchange-alt w-4"></i> Turnover Analysis
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('cost-analysis')">
                        <i class="fas fa-dollar-sign w-4"></i> Cost Analysis
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('compliance-reports')">
                        <i class="fas fa-check-circle w-4"></i> Compliance Reports
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('settings')">
                <div class="flex items-center gap-3">
                    <i class="fas fa-cog text-cyan-400 w-5"></i>
                    <span class="sidebar-text text-white font-medium">Settings</span>
                </div>
            </div>
        </nav>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-cyan-400/20">
            <div class="user-profile-section flex items-center justify-between p-3 bg-white/5 rounded-xl backdrop-blur-sm border border-white/10 hover:border-cyan-400/50 transition-all">
                <div class="flex items-center gap-3">
                    <div class="user-avatar w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg relative">
                        HR
                    </div>
                    <div class="sidebar-text">
                        <p class="text-white font-semibold text-sm" id="userName">HR Manager</p>
                        <p class="text-cyan-400 text-xs">Administrator</p>
                    </div>
                </div>
                <button onclick="logout()" class="text-vital-orange hover:text-vital-orange/80 transition-all hover:scale-110 hover:rotate-12">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col overflow-hidden main-content-panel relative">
        <!-- 3D Content Depth Layers -->
        <div class="content-layer content-layer-1"></div>
        <div class="content-layer content-layer-2"></div>

        <!-- Floating Particles -->
        <div class="content-particle"></div>
        <div class="content-particle"></div>
        <div class="content-particle"></div>
        <div class="content-particle"></div>

        <!-- Top Header -->
        <header class="content-header relative z-10 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all hover:scale-110 border border-white/10 hover:border-cyan-400/50">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h2 class="section-title text-3xl font-black text-white" data-text="Dashboard" id="sectionTitle">Dashboard</h2>
                        <p class="text-sm text-white/60 mt-1" id="sectionSubtitle">Overview of HR operations</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="notification-bell relative w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all border border-white/10 hover:border-cyan-400/50">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-vital-orange rounded-full animate-pulse shadow-lg shadow-vital-orange"></span>
                    </button>
                    <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all hover:scale-110 border border-white/10 hover:border-cyan-400/50">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Content Sections -->
        <div class="flex-1 overflow-y-auto p-6 content-scrollbar relative z-10">
            <!-- Dashboard Section -->
            <div id="section-dashboard" class="section-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stat Cards -->
                    <div class="stat-card p-6" style="--card-color: #22d3ee; --card-color-alpha: rgba(34, 211, 238, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-400/50">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full">+8%</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">487</h3>
                        <p class="text-white/60 text-sm relative z-10">Total Employees</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #F97316; --card-color-alpha: rgba(249, 115, 22, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-vital-orange/50">
                                <i class="fas fa-briefcase text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full">12 Open</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">24</h3>
                        <p class="text-white/60 text-sm relative z-10">Active Recruitments</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #a855f7; --card-color-alpha: rgba(168, 85, 247, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50">
                                <i class="fas fa-user-plus text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-orange-400 font-semibold px-3 py-1 bg-orange-400/10 rounded-full">This Week</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">8</h3>
                        <p class="text-white/60 text-sm relative z-10">Pending Onboarding</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #f59e0b; --card-color-alpha: rgba(245, 158, 11, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50">
                                <i class="fas fa-calendar-check text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-red-400 font-semibold px-3 py-1 bg-red-400/10 rounded-full">5 Urgent</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">18</h3>
                        <p class="text-white/60 text-sm relative z-10">Leave Requests</p>
                    </div>
                </div>

                <!-- Additional Dashboard Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-white mb-4">Recent Activities</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <p class="text-white/80 text-sm">New employee onboarded: Jane Doe</p>
                                <span class="ml-auto text-xs text-white/60">2h ago</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                <p class="text-white/80 text-sm">Leave request approved: John Smith</p>
                                <span class="ml-auto text-xs text-white/60">4h ago</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-orange-400 rounded-full"></div>
                                <p class="text-white/80 text-sm">Payroll processed for January</p>
                                <span class="ml-auto text-xs text-white/60">1d ago</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-white mb-4">Upcoming Events</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg border-l-4 border-cyan-400">
                                <i class="fas fa-calendar text-cyan-400"></i>
                                <div class="flex-1">
                                    <p class="text-white font-medium text-sm">Team Building Event</p>
                                    <p class="text-white/60 text-xs">Feb 5, 2026 • 9:00 AM</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg border-l-4 border-purple-400">
                                <i class="fas fa-graduation-cap text-purple-400"></i>
                                <div class="flex-1">
                                    <p class="text-white font-medium text-sm">Leadership Training</p>
                                    <p class="text-white/60 text-xs">Feb 8, 2026 • 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other sections will be added dynamically -->
            <div id="section-employee-list" class="section-content hidden">
                <div class="bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">All Employees</h3>
                    <p class="text-white/60">Employee list content will be displayed here...</p>
                </div>
            </div>

            <!-- Placeholder for other sections -->
            <div id="section-placeholder" class="section-content hidden">
                <div class="bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Section Content</h3>
                    <p class="text-white/60">This section is under development...</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
        }

        // Toggle submenu
        function toggleSubmenu(id) {
            const clickedSubmenu = document.getElementById(`${id}-submenu`);
            const clickedIcon = document.getElementById(`${id}-icon`);
            const isCurrentlyOpen = clickedSubmenu.classList.contains('open');

            // Close all submenus first
            document.querySelectorAll('.submenu').forEach(submenu => {
                submenu.classList.remove('open');
            });

            // Reset all icons
            document.querySelectorAll('[id$="-icon"]').forEach(icon => {
                icon.style.transform = 'rotate(0deg)';
            });

            // If the clicked submenu wasn't open, open it
            if (!isCurrentlyOpen) {
                clickedSubmenu.classList.add('open');
                clickedIcon.style.transform = 'rotate(180deg)';
            }
        }

        // Show section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });

            // Show selected section or placeholder
            const targetSection = document.getElementById(`section-${sectionId}`);
            if (targetSection) {
                targetSection.classList.remove('hidden');
            } else {
                document.getElementById('section-placeholder').classList.remove('hidden');
            }

            // Update active menu item
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.menu-item')?.classList.add('active');

            // Update header title
            const titles = {
                'dashboard': 'Dashboard',
                // Employees
                'employee-list': 'All Employees',
                'add-employee': 'Add Employee',
                'departments': 'Departments',
                'positions': 'Positions',
                'org-chart': 'Organization Chart',
                // Recruitment
                'job-postings': 'Job Postings',
                'applications': 'Applications',
                'interviews': 'Interviews',
                'candidates': 'Candidates',
                'onboarding': 'Onboarding',
                // Attendance
                'daily-attendance': 'Daily Attendance',
                'leave-requests': 'Leave Requests',
                'leave-balance': 'Leave Balance',
                'holidays': 'Holidays',
                'shifts': 'Shift Management',
                // Payroll
                'run-payroll': 'Run Payroll',
                'payslips': 'Payslips',
                'salary-structure': 'Salary Structure',
                'bonuses': 'Bonuses & Allowances',
                'deductions': 'Deductions',
                'tax-compliance': 'Tax & Compliance',
                // Performance
                'appraisals': 'Appraisals',
                'goals': 'Goals & KPIs',
                'reviews': 'Reviews & Feedback',
                'promotions': 'Promotions',
                // Training
                'courses': 'Training Courses',
                'certifications': 'Certifications',
                'skills-matrix': 'Skills Matrix',
                'learning-paths': 'Learning Paths',
                // Documents
                'contracts': 'Contracts',
                'policies': 'HR Policies',
                'handbooks': 'Employee Handbook',
                'templates': 'Templates',
                // Benefits
                'health-insurance': 'Health Insurance',
                'retirement-plans': 'Retirement Plans',
                'life-insurance': 'Life Insurance',
                'employee-perks': 'Perks & Rewards',
                // Time Tracking
                'timesheets': 'Timesheets',
                'overtime': 'Overtime Management',
                'time-off-accruals': 'Time-off Accruals',
                'work-schedules': 'Work Schedules',
                // Wellness
                'wellness-programs': 'Wellness Programs',
                'eap': 'Employee Assistance Program',
                'health-screenings': 'Health Screenings',
                'mental-health': 'Mental Health Support',
                // Assets
                'equipment-tracking': 'Equipment Tracking',
                'asset-assignment': 'Asset Assignment',
                'asset-maintenance': 'Maintenance Log',
                'asset-requests': 'Asset Requests',
                // Compliance
                'labor-laws': 'Labor Laws Compliance',
                'audits': 'HR Audits',
                'legal-cases': 'Legal Cases',
                'licenses-permits': 'Licenses & Permits',
                // Succession
                'succession-plans': 'Succession Plans',
                'talent-pool': 'Talent Pool',
                'leadership-pipeline': 'Leadership Pipeline',
                'career-paths': 'Career Paths',
                // Offboarding
                'resignations': 'Resignations',
                'exit-interviews': 'Exit Interviews',
                'final-settlements': 'Final Settlements',
                'alumni-network': 'Alumni Network',
                // Employee Relations
                'grievances': 'Grievances',
                'disciplinary': 'Disciplinary Actions',
                'employee-surveys': 'Employee Surveys',
                'engagement': 'Employee Engagement',
                // Reports
                'hr-analytics': 'HR Analytics',
                'headcount-reports': 'Headcount Reports',
                'turnover-analysis': 'Turnover Analysis',
                'cost-analysis': 'Cost Analysis',
                'compliance-reports': 'Compliance Reports',
                // Settings
                'settings': 'Settings'
            };
            document.getElementById('sectionTitle').textContent = titles[sectionId] || 'Section';
        }

        // Logout function
        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('hr_user');
            localStorage.removeItem('hr_token');
            document.cookie = 'hr_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function cancelLogout() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Inactivity timeout (5 minutes)
        let inactivityTimeout, warningTimeout;
        const INACTIVITY_LIMIT = 5 * 60 * 1000, WARNING_BEFORE = 60 * 1000;
        function resetInactivityTimer() {
            clearTimeout(inactivityTimeout); clearTimeout(warningTimeout); hideInactivityWarning();
            warningTimeout = setTimeout(() => showInactivityWarning(), INACTIVITY_LIMIT - WARNING_BEFORE);
            inactivityTimeout = setTimeout(() => autoLogout(), INACTIVITY_LIMIT);
        }
        function showInactivityWarning() { document.getElementById('inactivityModal').classList.remove('hidden'); }
        function hideInactivityWarning() { document.getElementById('inactivityModal').classList.add('hidden'); }
        function autoLogout() {
            localStorage.removeItem('hr_user'); localStorage.removeItem('hr_token');
            document.cookie = 'hr_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }
        function stayLoggedIn() { hideInactivityWarning(); resetInactivityTimer(); }
        ['mousedown','mousemove','keypress','scroll','touchstart','click'].forEach(e => document.addEventListener(e, resetInactivityTimer, true));

        // Initialize
        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('hr_user') || '{}');
            if (user.first_name) {
                document.getElementById('userName').textContent = `${user.first_name} ${user.last_name || ''}`;
            }
            resetInactivityTimer();
        });
    </script>

    <!-- Inactivity Warning Modal -->
    <div id="inactivityModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md"><div class="relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-xl rounded-3xl border border-white/10 shadow-2xl overflow-hidden">
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-yellow-500/20 via-transparent to-orange-500/20 pointer-events-none"></div>
            <div class="relative p-8">
                <div class="flex justify-center mb-6"><div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500/20 to-orange-500/20 flex items-center justify-center border border-yellow-500/30 animate-pulse"><i class="fas fa-clock text-3xl text-yellow-400"></i></div></div>
                <h3 class="text-2xl font-bold text-white text-center mb-2">Session Timeout Warning</h3>
                <p class="text-slate-400 text-center mb-8">You've been inactive. You'll be logged out in <span class="text-yellow-400 font-bold">1 minute</span>.</p>
                <div class="flex gap-4">
                    <button onclick="autoLogout()" class="flex-1 px-6 py-3 rounded-xl bg-slate-700/50 text-slate-300 font-semibold border border-slate-600/50"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                    <button onclick="stayLoggedIn()" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold shadow-lg"><i class="fas fa-check mr-2"></i>Stay Logged In</button>
                </div>
            </div>
        </div></div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cancelLogout()"></div>
        <div class="relative w-full max-w-md transform transition-all">
            <div class="relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-xl rounded-3xl border border-white/10 shadow-2xl overflow-hidden">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-cyan-500/20 via-transparent to-orange-500/20 pointer-events-none"></div>
                <div class="relative p-8">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500/20 to-red-500/20 flex items-center justify-center border border-orange-500/30">
                            <i class="fas fa-sign-out-alt text-3xl text-orange-400"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white text-center mb-2">Confirm Logout</h3>
                    <p class="text-slate-400 text-center mb-8">Are you sure you want to end your session? You'll need to login again to access the dashboard.</p>
                    <div class="flex gap-4">
                        <button onclick="cancelLogout()" class="flex-1 px-6 py-3 rounded-xl bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 hover:text-white font-semibold transition-all duration-300 border border-slate-600/50 hover:border-slate-500/50">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <button onclick="confirmLogout()" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold transition-all duration-300 shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

