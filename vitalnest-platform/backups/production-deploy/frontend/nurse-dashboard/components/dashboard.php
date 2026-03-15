<?php
// Check authentication
$token = $_COOKIE['nurse_token'] ?? '';
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
    <title>VitalNest - Nurse Dashboard</title>
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
        <aside id="sidebar" class="w-72 relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-800/90 to-slate-900/95 backdrop-blur-2xl border-r border-cyan-400/20 rounded-r-[2rem] shadow-2xl shadow-cyan-500/10"></div>
            <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-cyan-400/50 to-transparent animate-pulse"></div>
            <div class="relative h-full flex flex-col">
                <div class="p-6 border-b border-cyan-400/10">
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i class="fas fa-user-nurse text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">VitalNest</h1>
                            <p class="text-xs text-cyan-400 font-semibold">Nursing Station</p>
                        </div>
                    </div>
                </div>
                <nav class="flex-1 overflow-y-auto p-4 space-y-2 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">
                    <div class="menu-item px-4 py-3 rounded-xl border-l-4 border-cyan-400 bg-gradient-to-r from-cyan-400/20 to-cyan-400/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-home text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Dashboard</span>
                        </div>
                    </div>
                    <!-- Patient Care -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('patients')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-heartbeat text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Patient Care</span>
                                </div>
                                <i id="patients-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="patients-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-bed w-4 mr-2"></i> Patient Rounds
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-user-injured w-4 mr-2"></i> My Patients
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-clipboard-list w-4 mr-2"></i> Care Plans
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-procedures w-4 mr-2"></i> Admissions
                            </div>
                        </div>
                    </div>
                    <!-- Vital Signs -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-heart-pulse text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Vital Signs</span>
                        </div>
                    </div>
                    <!-- Medications -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('medications')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-pills text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Medications</span>
                                </div>
                                <i id="medications-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="medications-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-syringe w-4 mr-2"></i> Administration
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-list w-4 mr-2"></i> Medication List
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-history w-4 mr-2"></i> Admin Log
                            </div>
                        </div>
                    </div>
                    <!-- Nursing Notes -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-notes-medical text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Nursing Notes</span>
                        </div>
                    </div>
                    <!-- Assessments -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-clipboard-check text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Assessments</span>
                        </div>
                    </div>
                    <!-- Procedures -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-hand-holding-medical text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Procedures</span>
                        </div>
                    </div>
                    <!-- Tasks -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-tasks text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Tasks</span>
                        </div>
                    </div>
                    <!-- Reports -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chart-line text-cyan-400 w-5"></i>
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
                <div class="p-4 border-t border-cyan-400/10">
                    <div class="flex items-center justify-between p-3 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:border-cyan-400/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/20 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg relative">
                                <span class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full blur-md opacity-50 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative">RN</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm" id="userName">Nurse Smith</p>
                                <p class="text-cyan-400 text-xs">Registered Nurse</p>
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
                                    <span class="relative z-10">Nursing Dashboard</span>
                                    <span class="absolute inset-0 text-cyan-400 blur-md opacity-30">Nursing Dashboard</span>
                                </h2>
                                <p class="text-sm text-white/60 mt-1">Your nursing station overview</p>
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
                                    <i class="fas fa-procedures text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full border border-green-400/20">Active</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">24</h3>
                            <p class="text-white/60 text-sm">Patients Assigned</p>
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
                                <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full border border-blue-400/20">Due</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">18</h3>
                            <p class="text-white/60 text-sm">Med Administration</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-purple-400/20 rounded-2xl p-6 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-heartbeat text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full border border-purple-400/20">Complete</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">32</h3>
                            <p class="text-white/60 text-sm">Vitals Recorded</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-amber-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-amber-400/20 rounded-2xl p-6 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-clipboard-check text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-red-400 font-semibold px-3 py-1 bg-red-400/10 rounded-full border border-red-400/20">Pending</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">5</h3>
                            <p class="text-white/60 text-sm">Tasks Pending</p>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                    <!-- Today's Tasks -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-clipboard-list text-cyan-400"></i>
                                Today's Tasks
                            </h3>
                            <div class="space-y-3">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Medication Administration</p>
                                            <p class="text-white/60 text-sm">Room 204 • Patient: John Doe</p>
                                            <p class="text-cyan-400 text-xs mt-1">Due: 10:00 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-sm rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                                            Complete
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Vital Signs Check</p>
                                            <p class="text-white/60 text-sm">Room 305 • Patient: Jane Smith</p>
                                            <p class="text-cyan-400 text-xs mt-1">Due: 11:30 AM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            Start
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">Wound Care</p>
                                            <p class="text-white/60 text-sm">Room 412 • Patient: Mike Johnson</p>
                                            <p class="text-cyan-400 text-xs mt-1">Due: 2:00 PM</p>
                                        </div>
                                        <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Critical Alerts -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-red-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-exclamation-circle text-red-400 animate-pulse"></i>
                                Critical Alerts
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-lg hover:bg-red-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-red-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">High BP Alert - Room 204</p>
                                        <p class="text-white/70 text-xs">BP: 180/110 mmHg • Patient: John Doe</p>
                                    </div>
                                    <span class="text-xs text-red-400 font-bold px-2 py-1 bg-red-400/20 rounded">URGENT</span>
                                </div>
                                <div class="flex items-center gap-3 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-lg hover:bg-yellow-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">Medication Due - Room 305</p>
                                        <p class="text-white/70 text-xs">Insulin administration overdue by 15 min</p>
                                    </div>
                                    <span class="text-xs text-yellow-400 font-bold px-2 py-1 bg-yellow-400/20 rounded">15 min</span>
                                </div>
                                <div class="flex items-center gap-3 p-4 bg-blue-500/10 border border-blue-500/20 rounded-lg hover:bg-blue-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">Patient Call - Room 412</p>
                                        <p class="text-white/70 text-xs">Assistance requested</p>
                                    </div>
                                    <span class="text-xs text-blue-400 font-bold px-2 py-1 bg-blue-400/20 rounded">Now</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Rounds & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Patient Rounds -->
                    <div class="lg:col-span-2 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-bed text-purple-400"></i>
                                Patient Rounds
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-bed text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-semibold text-sm">Room 204</p>
                                            <p class="text-green-400 text-xs font-bold">Stable</p>
                                        </div>
                                    </div>
                                    <p class="text-white/80 text-xs mb-2">John Doe • Male, 58</p>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-white/60">Last vitals: 2h ago</span>
                                        <button class="text-cyan-400 hover:text-cyan-300">View</button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-bed text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-semibold text-sm">Room 305</p>
                                            <p class="text-yellow-400 text-xs font-bold">Monitor</p>
                                        </div>
                                    </div>
                                    <p class="text-white/80 text-xs mb-2">Jane Smith • Female, 42</p>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-white/60">Last vitals: 30m ago</span>
                                        <button class="text-cyan-400 hover:text-cyan-300">View</button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-bed text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-semibold text-sm">Room 412</p>
                                            <p class="text-red-400 text-xs font-bold">Critical</p>
                                        </div>
                                    </div>
                                    <p class="text-white/80 text-xs mb-2">Mike Johnson • Male, 65</p>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-white/60">Last vitals: 15m ago</span>
                                        <button class="text-cyan-400 hover:text-cyan-300">View</button>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-bed text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-semibold text-sm">Room 501</p>
                                            <p class="text-blue-400 text-xs font-bold">Recovering</p>
                                        </div>
                                    </div>
                                    <p class="text-white/80 text-xs mb-2">Sarah Lee • Female, 34</p>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-white/60">Last vitals: 1h ago</span>
                                        <button class="text-cyan-400 hover:text-cyan-300">View</button>
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
                                            <i class="fas fa-heartbeat text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Record Vitals</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-vital-orange/10 to-amber-600/5 rounded-lg border border-vital-orange/20 hover:border-vital-orange/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-600 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-syringe text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Log Medication</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-purple-500/10 to-purple-700/5 rounded-lg border border-purple-400/20 hover:border-purple-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-notes-medical text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Add Note</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-amber-500/10 to-amber-700/5 rounded-lg border border-amber-400/20 hover:border-amber-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-clipboard-check text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Assessment</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('hidden'); }
        function toggleSubmenu(id) {
            const submenu = document.getElementById(`${id}-submenu`);
            const icon = document.getElementById(`${id}-icon`);
            document.querySelectorAll('[id$="-submenu"]').forEach(menu => { if (menu.id !== `${id}-submenu`) menu.style.maxHeight = '0px'; });
            document.querySelectorAll('[id$="-icon"]').forEach(i => { if (i.id !== `${id}-icon`) i.style.transform = 'rotate(0deg)'; });
            if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
                submenu.style.maxHeight = '0px'; icon.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + 'px'; icon.style.transform = 'rotate(180deg)';
            }
        }
        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('nurse_user');
            localStorage.removeItem('nurse_token');
            document.cookie = 'nurse_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
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
            localStorage.removeItem('nurse_user'); localStorage.removeItem('nurse_token');
            document.cookie = 'nurse_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }
        function stayLoggedIn() { hideInactivityWarning(); resetInactivityTimer(); }
        ['mousedown','mousemove','keypress','scroll','touchstart','click'].forEach(e => document.addEventListener(e, resetInactivityTimer, true));

        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('nurse_user') || '{}');
            if (user.first_name) document.getElementById('userName').textContent = `Nurse ${user.last_name || user.first_name}`;
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

