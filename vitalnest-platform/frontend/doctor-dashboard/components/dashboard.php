<?php
// Check authentication
$token = $_COOKIE['doctor_token'] ?? '';
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
    <title>VitalNest - Doctor Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'vital-cyan': '#22d3ee',
                        'vital-orange': '#F97316',
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen font-sans">

    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 relative">
            <!-- Glassmorphic Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-800/90 to-slate-900/95 backdrop-blur-2xl border-r border-cyan-400/20 rounded-r-[2rem] shadow-2xl shadow-cyan-500/10"></div>

            <!-- Animated Edge Glow -->
            <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-cyan-400/50 to-transparent animate-pulse"></div>

            <!-- Content -->
            <div class="relative h-full flex flex-col">

                <!-- Logo -->
                <div class="p-6 border-b border-cyan-400/10">
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-user-md text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">VitalNest</h1>
                            <p class="text-xs text-cyan-400 font-semibold">Medical Portal</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-4 space-y-2 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">

                    <!-- Dashboard -->
                    <div class="menu-item px-4 py-3 rounded-xl border-l-4 border-cyan-400 bg-gradient-to-r from-cyan-400/20 to-cyan-400/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-home text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                            <span class="text-white font-semibold">Dashboard</span>
                        </div>
                    </div>

                    <!-- Patients -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('patients')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-procedures text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                                    <span class="text-white font-semibold">My Patients</span>
                                </div>
                                <i id="patients-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="patients-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-list w-4 mr-2"></i> All Patients
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-user-plus w-4 mr-2"></i> New Patient
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-exclamation-triangle w-4 mr-2"></i> Critical Cases
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-history w-4 mr-2"></i> Medical History
                            </div>
                        </div>
                    </div>

                    <!-- Appointments -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('appointments')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-calendar-alt text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                                    <span class="text-white font-semibold">Appointments</span>
                                </div>
                                <i id="appointments-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="appointments-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-clock w-4 mr-2"></i> Today's Schedule
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-calendar-week w-4 mr-2"></i> Upcoming
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-check-circle w-4 mr-2"></i> Completed
                            </div>
                        </div>
                    </div>

                    <!-- Medical Records -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('records')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-file-medical text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                                    <span class="text-white font-semibold">Medical Records</span>
                                </div>
                                <i id="records-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="records-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-notes-medical w-4 mr-2"></i> EMR/EHR
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-diagnoses w-4 mr-2"></i> Diagnoses
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-file-prescription w-4 mr-2"></i> Treatment Plans
                            </div>
                        </div>
                    </div>

                    <!-- Prescriptions -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-prescription text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                            <span class="text-white font-semibold">Prescriptions</span>
                        </div>
                    </div>

                    <!-- Lab Results -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-flask text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                            <span class="text-white font-semibold">Lab Results</span>
                        </div>
                    </div>

                    <!-- Consultations -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-comments text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                            <span class="text-white font-semibold">Consultations</span>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chart-bar text-cyan-400 w-5 transform transition-transform duration-300 hover:scale-125"></i>
                            <span class="text-white font-semibold">Reports</span>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-vital-orange/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-vital-orange/10 hover:shadow-lg hover:shadow-orange-500/20 mt-4 border-t border-cyan-400/10 pt-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-cog text-vital-orange w-5 transform transition-transform duration-300 hover:scale-125 hover:rotate-90"></i>
                            <span class="text-white font-semibold">Settings</span>
                        </div>
                    </div>
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t border-cyan-400/10">
                    <div class="flex items-center justify-between p-3 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:border-cyan-400/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg relative">
                                <span class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full blur-md opacity-50 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative">DR</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm" id="userName">Dr. Smith</p>
                                <p class="text-cyan-400 text-xs">Physician</p>
                            </div>
                        </div>
                        <button onclick="logout()" class="text-vital-orange hover:text-vital-orange/80 transition-all duration-300 hover:scale-110 hover:rotate-12">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden relative">

            <!-- Glassmorphic Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-slate-800/60 to-slate-900/70 backdrop-blur-3xl"></div>

            <!-- Floating Particles -->
            <div class="absolute top-10 right-20 w-2 h-2 bg-cyan-400 rounded-full blur-sm opacity-40 animate-bounce" style="animation-duration: 3s;"></div>
            <div class="absolute top-40 right-60 w-3 h-3 bg-cyan-400 rounded-full blur-sm opacity-30 animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-40 right-40 w-2 h-2 bg-vital-orange rounded-full blur-sm opacity-40 animate-bounce" style="animation-duration: 5s;"></div>

            <!-- Header -->
            <header class="relative z-10 border-b border-cyan-400/10 bg-gradient-to-r from-white/5 to-transparent backdrop-blur-xl">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button onclick="toggleSidebar()" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all duration-300 hover:scale-110 border border-white/10 hover:border-cyan-400/50 backdrop-blur-sm">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            <div>
                                <h2 class="text-3xl font-black text-white relative">
                                    <span class="relative z-10">Dashboard</span>
                                    <span class="absolute inset-0 text-cyan-400 blur-md opacity-30">Dashboard</span>
                                </h2>
                                <p class="text-sm text-white/60 mt-1">Your medical practice overview</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="relative w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all duration-300 border border-white/10 hover:border-cyan-400/50 backdrop-blur-sm group">
                                <i class="fas fa-bell text-xl group-hover:animate-bounce"></i>
                                <span class="absolute top-2 right-2 w-2 h-2 bg-vital-orange rounded-full animate-pulse shadow-lg shadow-vital-orange"></span>
                            </button>
                            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all duration-300 hover:scale-110 border border-white/10 hover:border-cyan-400/50 backdrop-blur-sm">
                                <i class="fas fa-search text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-6 relative z-10 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                    <!-- Stat Card 1 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/20 to-cyan-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-2xl p-6 hover:border-cyan-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-user-injured text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full border border-green-400/20">Active</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">142</h3>
                            <p class="text-white/60 text-sm">Total Patients</p>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/20 to-amber-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-vital-orange/20 rounded-2xl p-6 hover:border-vital-orange/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-vital-orange to-amber-600 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-calendar-day text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full border border-blue-400/20">Today</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">12</h3>
                            <p class="text-white/60 text-sm">Appointments</p>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-purple-400/20 rounded-2xl p-6 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-prescription-bottle text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full border border-purple-400/20">Pending</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">7</h3>
                            <p class="text-white/60 text-sm">Prescriptions</p>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-amber-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-amber-400/20 rounded-2xl p-6 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-flask text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-red-400 font-semibold px-3 py-1 bg-red-400/10 rounded-full border border-red-400/20">3 Urgent</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">15</h3>
                            <p class="text-white/60 text-sm">Lab Results</p>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Today's Schedule -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-clock text-cyan-400"></i>
                                Today's Schedule
                            </h3>
                            <div class="space-y-3">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-white font-semibold">Sarah Johnson</p>
                                            <p class="text-white/60 text-sm">Annual Checkup • 10:00 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-sm rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                                            Start
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-white font-semibold">Michael Chen</p>
                                            <p class="text-white/60 text-sm">Follow-up • 11:30 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-white font-semibold">Emma Davis</p>
                                            <p class="text-white/60 text-sm">Consultation • 2:00 PM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-history text-vital-orange"></i>
                                Recent Activity
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <p class="text-white/80 text-sm flex-1">Lab results reviewed for Patient #2458</p>
                                    <span class="text-xs text-white/60">2h ago</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                                    <p class="text-white/80 text-sm flex-1">Prescription issued: Amoxicillin 500mg</p>
                                    <span class="text-xs text-white/60">4h ago</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                                    <p class="text-white/80 text-sm flex-1">Follow-up scheduled for Patient #3891</p>
                                    <span class="text-xs text-white/60">5h ago</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                                    <p class="text-white/80 text-sm flex-1">Medical records updated for Patient #1234</p>
                                    <span class="text-xs text-white/60">6h ago</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="relative group lg:col-span-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-bolt text-cyan-400"></i>
                                Quick Actions
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <button class="group/btn p-4 bg-gradient-to-br from-cyan-400/10 to-cyan-600/5 rounded-xl border border-cyan-400/20 hover:border-cyan-400/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-cyan-500/20">
                                    <div class="w-12 h-12 mx-auto bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg mb-3 transform transition-transform duration-300 group-hover/btn:scale-110 group-hover/btn:rotate-3">
                                        <i class="fas fa-user-plus text-white text-xl"></i>
                                    </div>
                                    <p class="text-white font-semibold text-sm">Add Patient</p>
                                </button>
                                <button class="group/btn p-4 bg-gradient-to-br from-vital-orange/10 to-amber-600/5 rounded-xl border border-vital-orange/20 hover:border-vital-orange/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-500/20">
                                    <div class="w-12 h-12 mx-auto bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg mb-3 transform transition-transform duration-300 group-hover/btn:scale-110 group-hover/btn:rotate-3">
                                        <i class="fas fa-prescription text-white text-xl"></i>
                                    </div>
                                    <p class="text-white font-semibold text-sm">New Prescription</p>
                                </button>
                                <button class="group/btn p-4 bg-gradient-to-br from-purple-500/10 to-purple-700/5 rounded-xl border border-purple-400/20 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/20">
                                    <div class="w-12 h-12 mx-auto bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg mb-3 transform transition-transform duration-300 group-hover/btn:scale-110 group-hover/btn:rotate-3">
                                        <i class="fas fa-file-medical text-white text-xl"></i>
                                    </div>
                                    <p class="text-white font-semibold text-sm">Medical Record</p>
                                </button>
                                <button class="group/btn p-4 bg-gradient-to-br from-amber-500/10 to-amber-700/5 rounded-xl border border-amber-400/20 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-amber-500/20">
                                    <div class="w-12 h-12 mx-auto bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg mb-3 transform transition-transform duration-300 group-hover/btn:scale-110 group-hover/btn:rotate-3">
                                        <i class="fas fa-chart-line text-white text-xl"></i>
                                    </div>
                                    <p class="text-white font-semibold text-sm">View Reports</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Toggle Submenu
        function toggleSubmenu(id) {
            const submenu = document.getElementById(`${id}-submenu`);
            const icon = document.getElementById(`${id}-icon`);

            // Close all other submenus
            document.querySelectorAll('[id$="-submenu"]').forEach(menu => {
                if (menu.id !== `${id}-submenu`) {
                    menu.style.maxHeight = '0px';
                }
            });

            // Reset all icons
            document.querySelectorAll('[id$="-icon"]').forEach(i => {
                if (i.id !== `${id}-icon`) {
                    i.style.transform = 'rotate(0deg)';
                }
            });

            // Toggle current submenu
            if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
                submenu.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        }

        // Logout
        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('doctor_user');
            localStorage.removeItem('doctor_token');
            document.cookie = 'doctor_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
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
            localStorage.removeItem('doctor_user'); localStorage.removeItem('doctor_token');
            document.cookie = 'doctor_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }
        function stayLoggedIn() { hideInactivityWarning(); resetInactivityTimer(); }
        ['mousedown','mousemove','keypress','scroll','touchstart','click'].forEach(e => document.addEventListener(e, resetInactivityTimer, true));

        // Initialize
        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('doctor_user') || '{}');
            if (user.first_name) {
                document.getElementById('userName').textContent = `Dr. ${user.last_name || user.first_name}`;
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
                    <button onclick="autoLogout()" class="flex-1 px-6 py-3 rounded-xl bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 font-semibold transition-all border border-slate-600/50"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
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

