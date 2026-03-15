<?php
// Check authentication
$token = $_COOKIE['patient_token'] ?? $_COOKIE['client_token'] ?? '';
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
    <title>VitalNest - Patient Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: { 'vital-cyan': '#22d3ee', 'vital-orange': '#F97316' }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-56 relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-800/90 to-slate-900/95 backdrop-blur-2xl border-r border-cyan-400/20 rounded-r-[1.5rem] shadow-2xl shadow-cyan-500/10"></div>
            <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-cyan-400/50 to-transparent animate-pulse"></div>
            <div class="relative h-full flex flex-col">
                <div class="p-4 border-b border-cyan-400/10">
                    <div class="flex items-center gap-2 group cursor-pointer">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-heartbeat text-white text-sm"></i>
                        </div>
                        <div>
                            <h1 class="text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">VitalNest</h1>
                            <p class="text-[10px] text-cyan-400 font-semibold">Patient Portal</p>
                        </div>
                    </div>
                </div>
                <nav class="flex-1 overflow-y-auto p-2 space-y-1 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">
                    <div class="menu-item px-3 py-2 rounded-lg border-l-2 border-cyan-400 bg-gradient-to-r from-cyan-400/20 to-cyan-400/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-home text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Dashboard</span>
                        </div>
                    </div>
                    <!-- My Plan -->
                    <div>
                        <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10" onclick="toggleSubmenu('myplan')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-box-open text-cyan-400 w-4 text-xs"></i>
                                    <span class="text-white font-semibold text-xs">My Plan</span>
                                </div>
                                <i id="myplan-icon" class="fas fa-chevron-down text-white/60 text-[10px] transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="myplan-submenu" class="ml-4 mt-0.5 space-y-0.5 max-h-0 overflow-hidden transition-all duration-300">
                            <div onclick="showSection('current-plan-section')" class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-crown w-3 mr-1.5 text-[10px]"></i>Current Plan
                            </div>
                            <div onclick="showSection('available-packages-section')" class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-boxes w-3 mr-1.5 text-[10px]"></i>Available Packages
                            </div>
                            <div onclick="showSection('upgrade-downgrade-section')" class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-sync-alt w-3 mr-1.5 text-[10px]"></i>Upgrade/Downgrade
                            </div>
                            <div onclick="showSection('billing-history-section')" class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-receipt w-3 mr-1.5 text-[10px]"></i>Billing History
                            </div>
                            <div onclick="showSection('payment-methods-section')" class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-credit-card w-3 mr-1.5 text-[10px]"></i>Payment Methods
                            </div>
                        </div>
                    </div>
                    <!-- My Cover -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10" onclick="showSection('insurance-cover-section')">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-shield-alt text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">My Cover</span>
                        </div>
                    </div>
                    <!-- Appointments -->
                    <div>
                        <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10" onclick="toggleSubmenu('appointments')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-cyan-400 w-4 text-xs"></i>
                                    <span class="text-white font-semibold text-xs">Appointments</span>
                                </div>
                                <i id="appointments-icon" class="fas fa-chevron-down text-white/60 text-[10px] transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="appointments-submenu" class="ml-4 mt-0.5 space-y-0.5 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-calendar-plus w-3 mr-1.5 text-[10px]"></i>Book Appointment
                            </div>
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-list w-3 mr-1.5 text-[10px]"></i>My Appointments
                            </div>
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-history w-3 mr-1.5 text-[10px]"></i>Past Visits
                            </div>
                        </div>
                    </div>
                    <!-- My Calendar -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10" onclick="showSection('my-calendar-section')">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-days text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">My Calendar</span>
                        </div>
                    </div>
                    <!-- Medical Records -->
                    <div>
                        <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10" onclick="toggleSubmenu('records')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file-medical text-cyan-400 w-4 text-xs"></i>
                                    <span class="text-white font-semibold text-xs">Medical Records</span>
                                </div>
                                <i id="records-icon" class="fas fa-chevron-down text-white/60 text-[10px] transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="records-submenu" class="ml-4 mt-0.5 space-y-0.5 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-notes-medical w-3 mr-1.5 text-[10px]"></i>Health Summary
                            </div>
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-allergies w-3 mr-1.5 text-[10px]"></i>Allergies
                            </div>
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-disease w-3 mr-1.5 text-[10px]"></i>Conditions
                            </div>
                            <div class="px-3 py-1.5 text-white/70 hover:text-cyan-400 cursor-pointer text-[11px] rounded hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-procedures w-3 mr-1.5 text-[10px]"></i>Procedures
                            </div>
                        </div>
                    </div>
                    <!-- Medications -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-pills text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Medications</span>
                        </div>
                    </div>
                    <!-- Lab Results -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-flask text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Lab Results</span>
                        </div>
                    </div>
                    <!-- Prescriptions -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-prescription text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Prescriptions</span>
                        </div>
                    </div>
                    <!-- Billing -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-file-invoice-dollar text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Billing</span>
                        </div>
                    </div>
                    <!-- Messages -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-cyan-400/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-comments text-cyan-400 w-4 text-xs"></i>
                            <span class="text-white font-semibold text-xs">Messages</span>
                        </div>
                    </div>
                    <!-- Settings -->
                    <div class="px-3 py-2 rounded-lg border-l-2 border-transparent hover:border-vital-orange/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-1 hover:bg-vital-orange/10 mt-2 border-t border-cyan-400/10 pt-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-cog text-vital-orange w-4 text-xs transform transition-transform duration-300 hover:scale-125 hover:rotate-90"></i>
                            <span class="text-white font-semibold text-xs">Settings</span>
                        </div>
                    </div>
                </nav>
                <div class="p-2 border-t border-cyan-400/10">
                    <div class="flex items-center justify-between p-2 bg-white/5 backdrop-blur-sm rounded-lg border border-white/10 hover:border-cyan-400/50 transition-all duration-300 group">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white text-[10px] font-bold shadow-lg relative">
                                <span class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full blur-md opacity-50 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative">PT</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-[11px]" id="userName">Patient</p>
                                <p class="text-cyan-400 text-[9px]">Health Member</p>
                            </div>
                        </div>
                        <button onclick="logout()" class="text-vital-orange hover:text-vital-orange/80 transition-all duration-300 hover:scale-110 text-xs">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-slate-800/60 to-slate-900/70 backdrop-blur-3xl"></div>
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
                                    <span class="relative z-10">My Health</span>
                                    <span class="absolute inset-0 text-cyan-400 blur-md opacity-30">My Health</span>
                                </h2>
                                <p class="text-sm text-white/60 mt-1">Your personal health dashboard</p>
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
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/20 to-cyan-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-2xl p-6 hover:border-cyan-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-calendar-check text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full border border-blue-400/20">Upcoming</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">3</h3>
                            <p class="text-white/60 text-sm">Appointments</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/20 to-amber-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-vital-orange/20 rounded-2xl p-6 hover:border-vital-orange/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-vital-orange to-amber-600 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-pills text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full border border-green-400/20">Active</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">5</h3>
                            <p class="text-white/60 text-sm">Medications</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-purple-400/20 rounded-2xl p-6 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-flask text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full border border-purple-400/20">Recent</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">2</h3>
                            <p class="text-white/60 text-sm">Lab Results</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-amber-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-amber-400/20 rounded-2xl p-6 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-comments text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-cyan-400 font-semibold px-3 py-1 bg-cyan-400/10 rounded-full border border-cyan-400/20">1 New</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">8</h3>
                            <p class="text-white/60 text-sm">Messages</p>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                    <!-- Upcoming Appointments -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-cyan-400"></i>
                                Upcoming Appointments
                            </h3>
                            <div class="space-y-3">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Dr. Sarah Johnson</p>
                                            <p class="text-white/60 text-sm">Annual Checkup</p>
                                            <p class="text-cyan-400 text-xs mt-1">Tomorrow • 10:00 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-sm rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                                            Details
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Dr. Michael Chen</p>
                                            <p class="text-white/60 text-sm">Follow-up Consultation</p>
                                            <p class="text-cyan-400 text-xs mt-1">Feb 5 • 2:00 PM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Dr. Emily Davis</p>
                                            <p class="text-white/60 text-sm">Lab Results Review</p>
                                            <p class="text-cyan-400 text-xs mt-1">Feb 8 • 11:30 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Medications -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-pills text-vital-orange"></i>
                                Active Medications
                            </h3>
                            <div class="space-y-3">
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-green-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold text-sm">Lisinopril 10mg</p>
                                            <p class="text-white/60 text-xs">Once daily • Morning</p>
                                        </div>
                                        <span class="text-xs text-green-400 font-bold px-2 py-1 bg-green-400/20 rounded">Active</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-green-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold text-sm">Metformin 500mg</p>
                                            <p class="text-white/60 text-xs">Twice daily • With meals</p>
                                        </div>
                                        <span class="text-xs text-green-400 font-bold px-2 py-1 bg-green-400/20 rounded">Active</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-yellow-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold text-sm">Vitamin D 1000 IU</p>
                                            <p class="text-white/60 text-xs">Once daily • Refill Soon</p>
                                        </div>
                                        <span class="text-xs text-yellow-400 font-bold px-2 py-1 bg-yellow-400/20 rounded">Low Stock</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-blue-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold text-sm">Aspirin 81mg</p>
                                            <p class="text-white/60 text-xs">Once daily • Morning</p>
                                        </div>
                                        <span class="text-xs text-blue-400 font-bold px-2 py-1 bg-blue-400/20 rounded">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Health Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Recent Lab Results -->
                    <div class="lg:col-span-2 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-flask text-purple-400"></i>
                                Recent Lab Results
                            </h3>
                            <div class="space-y-3">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-white font-semibold">Complete Blood Count (CBC)</p>
                                            <p class="text-white/60 text-xs">Completed: Jan 28, 2026</p>
                                        </div>
                                        <button class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-sm rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                                            View Report
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div class="p-2 bg-white/5 rounded-lg text-center">
                                            <p class="text-white/60 text-xs">WBC</p>
                                            <p class="text-green-400 font-bold text-sm">7.2</p>
                                            <p class="text-xs text-green-400">Normal</p>
                                        </div>
                                        <div class="p-2 bg-white/5 rounded-lg text-center">
                                            <p class="text-white/60 text-xs">RBC</p>
                                            <p class="text-green-400 font-bold text-sm">4.8</p>
                                            <p class="text-xs text-green-400">Normal</p>
                                        </div>
                                        <div class="p-2 bg-white/5 rounded-lg text-center">
                                            <p class="text-white/60 text-xs">Platelets</p>
                                            <p class="text-green-400 font-bold text-sm">245</p>
                                            <p class="text-xs text-green-400">Normal</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-white font-semibold">Lipid Panel</p>
                                            <p class="text-white/60 text-xs">Completed: Jan 15, 2026</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-bolt text-amber-400"></i>
                                Quick Actions
                            </h3>
                            <div class="space-y-3">
                                <button class="w-full p-3 bg-gradient-to-r from-cyan-400/10 to-cyan-600/5 rounded-lg border border-cyan-400/20 hover:border-cyan-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-calendar-plus text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Book Appointment</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-vital-orange/10 to-amber-600/5 rounded-lg border border-vital-orange/20 hover:border-vital-orange/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-600 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-prescription text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Request Refill</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-purple-500/10 to-purple-700/5 rounded-lg border border-purple-400/20 hover:border-purple-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-comments text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Message Doctor</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-amber-500/10 to-amber-700/5 rounded-lg border border-amber-400/20 hover:border-amber-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-file-download text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Download Records</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Plan Sections -->
                <?php include 'myplan/current-plan.php'; ?>
                <?php include 'myplan/available-packages.php'; ?>
                <?php include 'myplan/upgrade-downgrade.php'; ?>
                <?php include 'myplan/billing-history.php'; ?>
                <?php include 'myplan/payment-methods.php'; ?>

                <!-- Insurance Cover Section -->
                <?php include 'myplan/insurance-cover.php'; ?>

                <!-- My Calendar Section -->
                <?php include 'myplan/my-calendar.php'; ?>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('hidden');
        }

        function toggleSubmenu(id) {
            const submenu = document.getElementById(`${id}-submenu`);
            const icon = document.getElementById(`${id}-icon`);

            document.querySelectorAll('[id$="-submenu"]').forEach(menu => {
                if (menu.id !== `${id}-submenu`) {
                    menu.style.maxHeight = '0px';
                }
            });

            document.querySelectorAll('[id$="-icon"]').forEach(i => {
                if (i.id !== `${id}-icon`) {
                    i.style.transform = 'rotate(0deg)';
                }
            });

            if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
                submenu.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        }

        function showSection(sectionId) {
            // Hide all plan sections and main dashboard content
            const allSections = document.querySelectorAll('[id$="-section"]');
            allSections.forEach(section => section.classList.add('hidden'));

            // Also hide main dashboard content if showing a plan section
            const mainDashboardContent = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4');
            if (mainDashboardContent && sectionId !== 'dashboard-section') {
                mainDashboardContent.parentElement.querySelectorAll('.grid, .relative.group').forEach(el => {
                    if (!el.closest('[id$="-section"]')) {
                        el.style.display = 'none';
                    }
                });
            } else if (mainDashboardContent) {
                mainDashboardContent.parentElement.querySelectorAll('.grid, .relative.group').forEach(el => {
                    if (!el.closest('[id$="-section"]')) {
                        el.style.display = '';
                    }
                });
            }

            // Show selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');

                // Load data for the section
                if (sectionId === 'current-plan-section' && typeof loadCurrentPlan === 'function') {
                    loadCurrentPlan();
                } else if (sectionId === 'available-packages-section' && typeof loadAvailablePackages === 'function') {
                    loadAvailablePackages();
                } else if (sectionId === 'upgrade-downgrade-section' && typeof loadChangePlans === 'function') {
                    loadChangePlans();
                } else if (sectionId === 'billing-history-section' && typeof loadBillingHistory === 'function') {
                    loadBillingHistory();
                } else if (sectionId === 'payment-methods-section' && typeof loadPaymentMethods === 'function') {
                    loadPaymentMethods();
                } else if (sectionId === 'insurance-cover-section' && typeof loadInsuranceCovers === 'function') {
                    loadInsuranceCovers();
                } else if (sectionId === 'my-calendar-section' && typeof initCalendar === 'function') {
                    initCalendar();
                }
            }

            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('client_user');
            localStorage.removeItem('client_token');
            localStorage.removeItem('patient_user');
            localStorage.removeItem('patient_token');
            localStorage.removeItem('user_id');
            document.cookie = 'client_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            document.cookie = 'patient_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function cancelLogout() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Inactivity timeout (5 minutes = 300000ms)
        let inactivityTimeout;
        let warningTimeout;
        const INACTIVITY_LIMIT = 5 * 60 * 1000;
        const WARNING_BEFORE = 60 * 1000;

        function resetInactivityTimer() {
            clearTimeout(inactivityTimeout);
            clearTimeout(warningTimeout);
            hideInactivityWarning();
            warningTimeout = setTimeout(() => { showInactivityWarning(); }, INACTIVITY_LIMIT - WARNING_BEFORE);
            inactivityTimeout = setTimeout(() => { autoLogout(); }, INACTIVITY_LIMIT);
        }

        function showInactivityWarning() { document.getElementById('inactivityModal').classList.remove('hidden'); }
        function hideInactivityWarning() { document.getElementById('inactivityModal').classList.add('hidden'); }

        function autoLogout() {
            localStorage.removeItem('client_user');
            localStorage.removeItem('client_token');
            localStorage.removeItem('patient_user');
            localStorage.removeItem('patient_token');
            document.cookie = 'client_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            document.cookie = 'patient_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function stayLoggedIn() { hideInactivityWarning(); resetInactivityTimer(); }

        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'].forEach(event => {
            document.addEventListener(event, resetInactivityTimer, true);
        });

        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('client_user') || '{}');
            if (user.first_name) {
                document.getElementById('userName').textContent = user.first_name + ' ' + (user.last_name || '');
            }
            resetInactivityTimer();
        });
    </script>

    <!-- Inactivity Warning Modal -->
    <div id="inactivityModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md transform transition-all">
            <div class="relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-xl rounded-3xl border border-white/10 shadow-2xl overflow-hidden">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-yellow-500/20 via-transparent to-orange-500/20 pointer-events-none"></div>
                <div class="relative p-8">
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500/20 to-orange-500/20 flex items-center justify-center border border-yellow-500/30 animate-pulse">
                            <i class="fas fa-clock text-3xl text-yellow-400"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white text-center mb-2">Session Timeout Warning</h3>
                    <p class="text-slate-400 text-center mb-8">You've been inactive. You'll be logged out in <span class="text-yellow-400 font-bold">1 minute</span> unless you continue.</p>
                    <div class="flex gap-4">
                        <button onclick="autoLogout()" class="flex-1 px-6 py-3 rounded-xl bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 hover:text-white font-semibold transition-all duration-300 border border-slate-600/50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout Now
                        </button>
                        <button onclick="stayLoggedIn()" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold transition-all duration-300 shadow-lg shadow-cyan-500/25">
                            <i class="fas fa-check mr-2"></i>Stay Logged In
                        </button>
                    </div>
                </div>
            </div>
        </div>
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



