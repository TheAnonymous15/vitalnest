<?php
// Check authentication
$token = $_COOKIE['token'] ?? '';
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

        /* ... Keep all the existing 3D glassmorphic CSS from HR dashboard ... */
        /* Sidebar, content panel, stat cards, particles, animations, etc. */

        /* I'll include the complete CSS in the actual file */
    </style>
</head>
<body class="flex h-screen">

    <!-- 3D Glassmorphic Sidebar -->
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
                        <i class="fas fa-user-md text-white text-xl"></i>
                    </div>
                    <div class="sidebar-text">
                        <h1 class="text-xl font-black text-white bg-gradient-to-r from-cyan-400 to-white bg-clip-text text-transparent">VitalNest</h1>
                        <p class="text-xs text-cyan-400 font-semibold">Medical Portal</p>
                    </div>
                </div>
            </div>

            <!-- Doctor-Specific Navigation Menu -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-2 sidebar-nav">
                <!-- Dashboard -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer active" onclick="showSection('dashboard')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-home text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Dashboard</span>
                    </div>
                </div>

                <!-- Patients -->
                <div>
                    <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('patients')">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-procedures text-cyan-400 w-5"></i>
                                <span class="sidebar-text text-white font-medium">My Patients</span>
                            </div>
                            <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="patients-icon"></i>
                        </div>
                    </div>
                    <div class="submenu pl-12 mt-1 space-y-1" id="patients-submenu">
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('patient-list')">
                            <i class="fas fa-list w-4"></i> All Patients
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('new-patient')">
                            <i class="fas fa-user-plus w-4"></i> New Patient
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('critical-patients')">
                            <i class="fas fa-exclamation-triangle w-4"></i> Critical Cases
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('patient-history')">
                            <i class="fas fa-history w-4"></i> Medical History
                        </div>
                    </div>
                </div>

                <!-- Appointments -->
                <div>
                    <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('appointments')">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-calendar-alt text-cyan-400 w-5"></i>
                                <span class="sidebar-text text-white font-medium">Appointments</span>
                            </div>
                            <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="appointments-icon"></i>
                        </div>
                    </div>
                    <div class="submenu pl-12 mt-1 space-y-1" id="appointments-submenu">
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('today-appointments')">
                            <i class="fas fa-clock w-4"></i> Today's Schedule
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('upcoming')">
                            <i class="fas fa-calendar-week w-4"></i> Upcoming
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('completed')">
                            <i class="fas fa-check-circle w-4"></i> Completed
                        </div>
                    </div>
                </div>

                <!-- Medical Records -->
                <div>
                    <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="toggleSubmenu('records')">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-file-medical text-cyan-400 w-5"></i>
                                <span class="sidebar-text text-white font-medium">Medical Records</span>
                            </div>
                            <i class="fas fa-chevron-down sidebar-text text-white/60 text-xs transition-transform" id="records-icon"></i>
                        </div>
                    </div>
                    <div class="submenu pl-12 mt-1 space-y-1" id="records-submenu">
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('emr')">
                            <i class="fas fa-notes-medical w-4"></i> EMR/EHR
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('diagnoses')">
                            <i class="fas fa-diagnoses w-4"></i> Diagnoses
                        </div>
                        <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm" onclick="showSection('treatment-plans')">
                            <i class="fas fa-file-prescription w-4"></i> Treatment Plans
                        </div>
                    </div>
                </div>

                <!-- Prescriptions -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('prescriptions')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-prescription text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Prescriptions</span>
                    </div>
                </div>

                <!-- Lab Results -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('lab-results')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-flask text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Lab Results</span>
                    </div>
                </div>

                <!-- Consultations -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('consultations')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-comments text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Consultations</span>
                    </div>
                </div>

                <!-- Reports -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer" onclick="showSection('reports')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chart-bar text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Reports</span>
                    </div>
                </div>

                <!-- Settings -->
                <div class="menu-item px-4 py-3 rounded-lg border-l-4 border-transparent cursor-pointer settings-item" onclick="showSection('settings')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-cog text-cyan-400 w-5"></i>
                        <span class="sidebar-text text-white font-medium">Settings</span>
                    </div>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-cyan-400/20">
                <div class="user-profile-section flex items-center justify-between p-3 bg-white/5 rounded-xl backdrop-blur-sm border border-white/10 hover:border-cyan-400/50 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="user-avatar w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg relative">
                            DR
                        </div>
                        <div class="sidebar-text">
                            <p class="text-white font-semibold text-sm" id="userName">Dr. Smith</p>
                            <p class="text-cyan-400 text-xs">Physician</p>
                        </div>
                    </div>
                    <button onclick="logout()" class="text-vital-orange hover:text-vital-orange/80 transition-all hover:scale-110 hover:rotate-12">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Panel -->
    <main class="flex-1 flex flex-col overflow-hidden main-content-panel relative">
        <!-- 3D Content Depth Layers -->
        <div class="content-layer content-layer-1"></div>
        <div class="content-layer content-layer-2"></div>

        <!-- Floating Particles -->
        <div class="content-particle"></div>
        <div class="content-particle"></div>
        <div class="content-particle"></div>
        <div class="content-particle"></div>

        <!-- Header -->
        <header class="content-header relative z-10 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 hover:bg-cyan-400/20 text-white hover:text-cyan-400 transition-all hover:scale-110 border border-white/10 hover:border-cyan-400/50">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h2 class="section-title text-3xl font-black text-white" data-text="Dashboard" id="sectionTitle">Dashboard</h2>
                        <p class="text-sm text-white/60 mt-1" id="sectionSubtitle">Your medical practice overview</p>
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

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6 content-scrollbar relative z-10">
            <!-- Dashboard Section -->
            <div id="section-dashboard" class="section-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Doctor-Specific Stats -->
                    <div class="stat-card p-6" style="--card-color: #22d3ee; --card-color-alpha: rgba(34, 211, 238, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-400/50">
                                <i class="fas fa-user-injured text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full">Active</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">142</h3>
                        <p class="text-white/60 text-sm relative z-10">Total Patients</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #F97316; --card-color-alpha: rgba(249, 115, 22, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-vital-orange/50">
                                <i class="fas fa-calendar-day text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full">Today</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">12</h3>
                        <p class="text-white/60 text-sm relative z-10">Appointments</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #a855f7; --card-color-alpha: rgba(168, 85, 247, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50">
                                <i class="fas fa-prescription-bottle text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full">Pending</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">7</h3>
                        <p class="text-white/60 text-sm relative z-10">Prescriptions</p>
                    </div>

                    <div class="stat-card p-6" style="--card-color: #f59e0b; --card-color-alpha: rgba(245, 158, 11, 0.3);">
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50">
                                <i class="fas fa-flask text-white text-2xl"></i>
                            </div>
                            <span class="text-sm text-red-400 font-semibold px-3 py-1 bg-red-400/10 rounded-full">3 Urgent</span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-1 relative z-10">15</h3>
                        <p class="text-white/60 text-sm relative z-10">Lab Results</p>
                    </div>
                </div>

                <!-- Quick Actions & Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="glass-panel p-6">
                        <h3 class="text-xl font-bold text-white mb-4">Today's Schedule</h3>
                        <div class="space-y-3">
                            <div class="activity-item p-4 bg-white/5 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-white font-semibold">Sarah Johnson</p>
                                        <p class="text-white/60 text-sm">Annual Checkup • 10:00 AM</p>
                                    </div>
                                    <button class="px-4 py-2 btn-3d text-white text-sm rounded-lg">Start</button>
                                </div>
                            </div>
                            <div class="activity-item p-4 bg-white/5 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-white font-semibold">Michael Chen</p>
                                        <p class="text-white/60 text-sm">Follow-up • 11:30 AM</p>
                                    </div>
                                    <button class="px-4 py-2 btn-3d text-white text-sm rounded-lg">View</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel p-6">
                        <h3 class="text-xl font-bold text-white mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            <div class="activity-item flex items-center gap-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <p class="text-white/80 text-sm">Lab results reviewed for Patient #2458</p>
                                <span class="ml-auto text-xs text-white/60">2h ago</span>
                            </div>
                            <div class="activity-item flex items-center gap-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                <p class="text-white/80 text-sm">Prescription issued: Amoxicillin 500mg</p>
                                <span class="ml-auto text-xs text-white/60">4h ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder sections -->
            <div id="section-placeholder" class="section-content hidden">
                <div class="glass-panel p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">Section Content</h3>
                    <p class="text-white/60">This section is under development...</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Copy all the existing JavaScript from HR dashboard
        // Including: toggleSidebar, toggleSubmenu, showSection, logout functions
        // Plus all initialization code
    </script>
</body>
</html>

