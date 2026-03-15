<?php
/**
 * VitalNest - Client/Patient Dashboard
 * Main dashboard interface for patients
 */

// Check authentication
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - VitalNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vital-cyan': '#0891b2',
                        'vital-blue': '#0e7490'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-64 h-screen bg-gradient-to-b from-cyan-900 to-blue-900">

        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-injured text-white"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold">Patient Portal</h1>
                    <p class="text-xs text-white/60">VitalNest</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="#dashboard" onclick="showSection('dashboard')" class="nav-item active flex items-center gap-3 px-4 py-3 rounded-xl text-white bg-white/10 transition-all">
                <i class="fas fa-home w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="#appointments" onclick="showSection('appointments')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-calendar-alt w-5"></i>
                <span>Appointments</span>
            </a>
            <a href="#health-records" onclick="showSection('health-records')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-heartbeat w-5"></i>
                <span>Health Records</span>
            </a>
            <a href="#medications" onclick="showSection('medications')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-pills w-5"></i>
                <span>Medications</span>
            </a>
            <a href="#lab-results" onclick="showSection('lab-results')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-file-medical w-5"></i>
                <span>Lab Results</span>
            </a>
            <a href="#billing" onclick="showSection('billing')" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-file-invoice-dollar w-5"></i>
                <span>Billing</span>
            </a>
        </nav>

        <!-- User Info & Logout -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-4 py-3 bg-white/5 rounded-xl mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm" id="userInitials">P</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-semibold text-sm truncate" id="userName">Patient User</p>
                    <p class="text-white/60 text-xs">Patient</p>
                </div>
            </div>
            <button onclick="logout()" class="w-full px-4 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl font-semibold transition-colors">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </div>

    </aside>

    <!-- Main Content -->
    <div class="ml-64">

        <!-- Header -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-30">
            <div>
                <h2 class="text-2xl font-bold text-gray-900" id="pageTitle">My Health Dashboard</h2>
                <p class="text-sm text-gray-600" id="pageSubtitle">Welcome back!</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-cyan-500 rounded-full"></span>
                </button>
                <button class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                    <i class="fas fa-calendar-plus mr-2"></i>Book Appointment
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6">

            <!-- DASHBOARD SECTION -->
            <div id="section-dashboard" class="content-section">

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-calendar-check text-white text-xl"></i>
                            </div>
                            <span class="text-cyan-600 text-sm font-semibold">Upcoming</span>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium">Next Appointment</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">No appointments</p>
                        <p class="text-xs text-gray-500 mt-2">Schedule your next visit</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-pills text-white text-xl"></i>
                            </div>
                            <span class="text-purple-600 text-sm font-semibold">Active</span>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium">Medications</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">0</p>
                        <p class="text-xs text-gray-500 mt-2">Current prescriptions</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-flask text-white text-xl"></i>
                            </div>
                            <span class="text-orange-600 text-sm font-semibold">Pending</span>
                        </div>
                        <h3 class="text-gray-600 text-sm font-medium">Lab Results</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-2">0</p>
                        <p class="text-xs text-gray-500 mt-2">Awaiting results</p>
                    </div>

                </div>

                <!-- Recent Activity & Health Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <p class="text-gray-500 text-center py-8">No recent activity</p>
                        </div>
                    </div>

                    <!-- Health Summary -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Health Summary</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Blood Pressure</span>
                                <span class="font-semibold text-gray-900">-- / --</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Heart Rate</span>
                                <span class="font-semibold text-gray-900">-- bpm</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Temperature</span>
                                <span class="font-semibold text-gray-900">--°F</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Other sections (hidden by default) -->
            <div id="section-appointments" class="content-section hidden">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold mb-4">My Appointments</h3>
                    <p class="text-gray-500 text-center py-8">No appointments scheduled</p>
                </div>
            </div>

            <div id="section-health-records" class="content-section hidden">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Health Records</h3>
                    <p class="text-gray-500 text-center py-8">No health records available</p>
                </div>
            </div>

            <div id="section-medications" class="content-section hidden">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Medications</h3>
                    <p class="text-gray-500 text-center py-8">No active medications</p>
                </div>
            </div>

            <div id="section-lab-results" class="content-section hidden">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Lab Results</h3>
                    <p class="text-gray-500 text-center py-8">No lab results available</p>
                </div>
            </div>

            <div id="section-billing" class="content-section hidden">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold mb-4">Billing & Invoices</h3>
                    <p class="text-gray-500 text-center py-8">No billing records</p>
                </div>
            </div>

        </main>

    </div>

    <script src="sources/dashboard.js"></script>

</body>
</html>
