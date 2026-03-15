<?php
//session_start();

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
    <title>HR Dashboard - VitalNest</title>

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
                    colors: {
                        'vital-black': '#1A1A1A',
                        'vital-dark': '#0D0D0D',
                        'vital-orange': '#F97316',
                        'vital-orange-light': '#FB923C',
                        'vital-orange-dark': '#EA580C',
                        'cyan-400': '#22d3ee',
                        'deep-teal': '#134E4A',
                        'teal-accent': '#22d3ee',
                        'warm-orange': '#FDBA74',
                        'soft-amber': '#FCD34D',
                        'cream': '#FFFBEB',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0A0F1C 0%, #0D1321 50%, #000000 100%);
            min-height: 100vh;
        }

        /* Floating orb animations */
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.4; }
            50% { transform: translate(20px, 20px) scale(1.1); opacity: 0.6; }
        }

        .orb-bg-1 {
            position: fixed;
            top: -10%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(34, 211, 238, 0.05);
            border-radius: 50%;
            filter: blur(80px);
            animation: float 25s ease-in-out infinite;
            z-index: 0;
        }

        .orb-bg-2 {
            position: fixed;
            bottom: -10%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: rgba(249, 115, 22, 0.04);
            border-radius: 50%;
            filter: blur(80px);
            animation: float 30s ease-in-out infinite reverse;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Floating Orbs -->
    <div class="orb-bg-1"></div>
    <div class="orb-bg-2"></div>

    <!-- Header -->
    <header class="bg-black/40 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-400/30">
                    <i class="fas fa-users-cog text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">VitalNest</h1>
                    <p class="text-xs text-white/60">HR Dashboard</p>
                </div>
            </div>
            <button onclick="logout()" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-vital-orange to-amber-600 hover:from-amber-600 hover:to-vital-orange text-white rounded-lg font-medium transition-all shadow-lg shadow-vital-orange/30">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Welcome, <span id="userName">HR Manager</span></h2>
            <p class="text-white/60">Manage staff, recruitment, and HR operations</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Employees -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-cyan-400/50 transition-all border-t-4 border-t-cyan-400">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-cyan-400/20 rounded-lg">
                        <i class="fas fa-users text-cyan-400 text-2xl"></i>
                    </div>
                    <span class="text-sm text-green-400 font-semibold">+8%</span>
                </div>
                <h3 class="text-3xl font-bold text-white">487</h3>
                <p class="text-white/60 text-sm font-medium">Total Employees</p>
            </div>

            <!-- Active Recruitments -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-vital-orange/50 transition-all border-t-4 border-t-vital-orange">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-vital-orange/20 rounded-lg">
                        <i class="fas fa-briefcase text-vital-orange text-2xl"></i>
                    </div>
                    <span class="text-sm text-blue-400 font-semibold">12 Open</span>
                </div>
                <h3 class="text-3xl font-bold text-white">24</h3>
                <p class="text-white/60 text-sm font-medium">Active Recruitments</p>
            </div>

            <!-- Pending Onboarding -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-purple-400/50 transition-all border-t-4 border-t-purple-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-500/20 rounded-lg">
                        <i class="fas fa-user-plus text-purple-400 text-2xl"></i>
                    </div>
                    <span class="text-sm text-orange-400 font-semibold">This Week</span>
                </div>
                <h3 class="text-3xl font-bold text-white">8</h3>
                <p class="text-white/60 text-sm font-medium">Pending Onboarding</p>
            </div>

            <!-- Leave Requests -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-amber-400/50 transition-all border-t-4 border-t-amber-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-500/20 rounded-lg">
                        <i class="fas fa-calendar-check text-amber-400 text-2xl"></i>
                    </div>
                    <span class="text-sm text-red-400 font-semibold">5 Urgent</span>
                </div>
                <h3 class="text-3xl font-bold text-white">18</h3>
                <p class="text-white/60 text-sm font-medium">Leave Requests</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Actions -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-bolt text-vital-orange"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-cyan-400/10 to-cyan-400/5 border border-cyan-400/20 rounded-xl hover:shadow-lg hover:border-cyan-400/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center shadow-lg shadow-cyan-400/30">
                                <i class="fas fa-user-plus text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Add Employee</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-vital-orange/10 to-vital-orange/5 border border-vital-orange/20 rounded-xl hover:shadow-lg hover:border-vital-orange/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-vital-orange to-amber-600 rounded-full flex items-center justify-center shadow-lg shadow-vital-orange/30">
                                <i class="fas fa-file-contract text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Post Job</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-purple-500/10 to-purple-500/5 border border-purple-400/20 rounded-xl hover:shadow-lg hover:border-purple-400/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-700 rounded-full flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <i class="fas fa-calendar-alt text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Manage Leave</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-blue-500/10 to-blue-500/5 border border-blue-400/20 rounded-xl hover:shadow-lg hover:border-blue-400/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <i class="fas fa-dollar-sign text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Payroll</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-green-500/10 to-green-500/5 border border-green-400/20 rounded-xl hover:shadow-lg hover:border-green-400/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center shadow-lg shadow-green-500/30">
                                <i class="fas fa-graduation-cap text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Training</span>
                        </button>
                        <button class="flex flex-col items-center gap-2 p-4 bg-gradient-to-br from-amber-500/10 to-amber-500/5 border border-amber-400/20 rounded-xl hover:shadow-lg hover:border-amber-400/50 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-700 rounded-full flex items-center justify-center shadow-lg shadow-amber-500/30">
                                <i class="fas fa-chart-line text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-semibold text-white">Reports</span>
                        </button>
                    </div>
                </div>

                <!-- Recent Employees -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="fas fa-users text-cyan-400"></i>
                            Recent Hires
                        </h3>
                        <button class="text-cyan-400 hover:text-cyan-400 font-semibold text-sm">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <!-- Employee 1 -->
                        <div class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-white/20 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-cyan-400/20">
                                    JD
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Dr. Jane Doe</p>
                                    <p class="text-sm text-white/60">Cardiologist • Jan 28, 2026</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-cyan-400 text-white rounded-lg text-sm font-medium hover:bg-cyan-600 transition-all shadow-lg shadow-cyan-400/20">
                                View
                            </button>
                        </div>

                        <!-- Employee 2 -->
                        <div class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-white/20 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-vital-orange to-amber-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-vital-orange/20">
                                    MS
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Michael Smith</p>
                                    <p class="text-sm text-white/60">Registered Nurse • Jan 25, 2026</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-cyan-400 text-white rounded-lg text-sm font-medium hover:bg-cyan-600 transition-all shadow-lg shadow-cyan-400/20">
                                View
                            </button>
                        </div>

                        <!-- Employee 3 -->
                        <div class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-white/20 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-700 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-purple-500/20">
                                    SJ
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Sarah Johnson</p>
                                    <p class="text-sm text-white/60">Lab Technician • Jan 22, 2026</p>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-cyan-400 text-white rounded-lg text-sm font-medium hover:bg-cyan-600 transition-all shadow-lg shadow-cyan-400/20">
                                View
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recruitment Pipeline -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-funnel-dollar text-vital-orange"></i>
                        Recruitment Pipeline
                    </h3>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-500/20 border border-blue-400/30 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-2xl font-bold text-blue-400">45</span>
                            </div>
                            <p class="text-xs font-semibold text-white/70">Applications</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-500/20 border border-purple-400/30 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-2xl font-bold text-purple-400">28</span>
                            </div>
                            <p class="text-xs font-semibold text-white/70">Screening</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-amber-500/20 border border-amber-400/30 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-2xl font-bold text-amber-400">12</span>
                            </div>
                            <p class="text-xs font-semibold text-white/70">Interviews</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-500/20 border border-green-400/30 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-2xl font-bold text-green-400">5</span>
                            </div>
                            <p class="text-xs font-semibold text-white/70">Offers</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Leave Requests -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-calendar-times text-vital-orange"></i>
                        Pending Leaves
                    </h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-amber-500/10 border border-amber-400/30 rounded-lg">
                            <p class="font-semibold text-white text-sm">Emma Wilson</p>
                            <p class="text-xs text-white/60 mt-1">Feb 5-9 • Vacation</p>
                            <div class="flex gap-2 mt-2">
                                <button class="flex-1 px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-xs font-medium transition-all">Approve</button>
                                <button class="flex-1 px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs font-medium transition-all">Deny</button>
                            </div>
                        </div>
                        <div class="p-3 bg-amber-500/10 border border-amber-400/30 rounded-lg">
                            <p class="font-semibold text-white text-sm">Robert Brown</p>
                            <p class="text-xs text-white/60 mt-1">Feb 3 • Sick Leave</p>
                            <div class="flex gap-2 mt-2">
                                <button class="flex-1 px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-xs font-medium transition-all">Approve</button>
                                <button class="flex-1 px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs font-medium transition-all">Deny</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Department Stats -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-building text-cyan-400"></i>
                        By Department
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-white/70">Medical Staff</span>
                            <span class="text-sm font-bold text-white">245</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2">
                            <div class="bg-gradient-to-r from-cyan-400 to-cyan-500 h-2 rounded-full" style="width: 50%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-white/70">Nursing</span>
                            <span class="text-sm font-bold text-white">128</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2">
                            <div class="bg-gradient-to-r from-vital-orange to-amber-500 h-2 rounded-full" style="width: 26%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-white/70">Administration</span>
                            <span class="text-sm font-bold text-white">68</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" style="width: 14%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-white/70">Support Staff</span>
                            <span class="text-sm font-bold text-white">46</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 h-2 rounded-full" style="width: 10%"></div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-calendar-day text-vital-orange"></i>
                        Upcoming Events
                    </h3>
                    <div class="space-y-3">
                        <div class="flex gap-3">
                            <div class="text-center bg-gradient-to-br from-cyan-400 to-cyan-600 text-white rounded-lg p-2 w-14 shadow-lg shadow-cyan-400/20">
                                <p class="text-xs font-semibold">FEB</p>
                                <p class="text-xl font-bold">5</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-white">New Hire Orientation</p>
                                <p class="text-xs text-white/60">9:00 AM - Conference Room A</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="text-center bg-gradient-to-br from-vital-orange to-amber-600 text-white rounded-lg p-2 w-14 shadow-lg shadow-vital-orange/20">
                                <p class="text-xs font-semibold">FEB</p>
                                <p class="text-xl font-bold">8</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-white">Safety Training</p>
                                <p class="text-xs text-white/60">2:00 PM - Training Center</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load user data
        const user = JSON.parse(localStorage.getItem('user') || '{}');
        if (user.first_name && user.last_name) {
            document.getElementById('userName').textContent = `${user.first_name} ${user.last_name}`;
        }

        // Logout function
        function logout() {
            // Clear authentication
            document.cookie = 'token=; path=/; max-age=0';
            localStorage.removeItem('user');

            // Redirect to login
            window.location.reload();
        }
    </script>
</body>
</html>

