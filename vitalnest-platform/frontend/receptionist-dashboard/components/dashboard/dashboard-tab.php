<?php
// dashboard-tab.php - Dashboard Tab Content
?>
<!-- Dashboard Tab -->
<div id="dashboard-tab" class="tab-content">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/20 to-cyan-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-cyan-400/20 rounded-2xl p-6 hover:border-cyan-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-cyan-500/20">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-t-2xl"></div>
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-user-clock text-white text-2xl"></i>
                    </div>
                    <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full border border-blue-400/20">Waiting</span>
                </div>
                <h3 class="text-4xl font-black text-white mb-1">8</h3>
                <p class="text-white/60 text-sm">Patients in Queue</p>
            </div>
        </div>

        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/20 to-amber-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-vital-orange/20 rounded-2xl p-6 hover:border-vital-orange/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-500/20">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-vital-orange to-amber-600 rounded-t-2xl"></div>
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-calendar-day text-white text-2xl"></i>
                    </div>
                    <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full border border-green-400/20">Today</span>
                </div>
                <h3 class="text-4xl font-black text-white mb-1">42</h3>
                <p class="text-white/60 text-sm">Appointments</p>
            </div>
        </div>

        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-purple-400/20 rounded-2xl p-6 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-2xl"></div>
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full border border-purple-400/20">New</span>
                </div>
                <h3 class="text-4xl font-black text-white mb-1">7</h3>
                <p class="text-white/60 text-sm">New Registrations</p>
            </div>
        </div>

        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-amber-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-amber-400/20 rounded-2xl p-6 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/20">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-phone-volume text-white text-2xl"></i>
                    </div>
                    <span class="text-sm text-cyan-400 font-semibold px-3 py-1 bg-cyan-400/10 rounded-full border border-cyan-400/20">Active</span>
                </div>
                <h3 class="text-4xl font-black text-white mb-1">3</h3>
                <p class="text-white/60 text-sm">Active Calls</p>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Waiting Room Queue -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-users text-cyan-400"></i>
                    Waiting Room Queue
                </h3>
                <div class="space-y-3">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex-1">
                                <p class="text-white font-semibold">Sarah Johnson</p>
                                <p class="text-white/60 text-sm">Dr. Michael Chen • General Checkup</p>
                                <p class="text-cyan-400 text-xs mt-1">Waiting: 15 min</p>
                            </div>
                            <button class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-sm rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                                Call In
                            </button>
                        </div>
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex-1">
                                <p class="text-white font-semibold">John Smith</p>
                                <p class="text-white/60 text-sm">Dr. Emily Davis • Follow-up</p>
                                <p class="text-cyan-400 text-xs mt-1">Waiting: 8 min</p>
                            </div>
                            <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                Notify
                            </button>
                        </div>
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex-1">
                                <p class="text-white font-semibold">Emma Williams</p>
                                <p class="text-white/60 text-sm">Dr. Robert Brown • Lab Results</p>
                                <p class="text-cyan-400 text-xs mt-1">Waiting: 5 min</p>
                            </div>
                            <button class="px-4 py-2 bg-white/10 text-white text-sm rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                Notify
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Appointments -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-check text-vital-orange"></i>
                    Next Appointments
                </h3>
                <div class="space-y-3">
                    <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-green-400">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-white font-semibold text-sm">10:00 AM - Margaret Thompson</p>
                                <p class="text-white/60 text-xs">Dr. Sarah Johnson • Annual Physical</p>
                            </div>
                            <span class="text-xs text-green-400 font-bold px-2 py-1 bg-green-400/20 rounded">Confirmed</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-blue-400">
                        <div class="flex-1">
                            <p class="text-white font-semibold text-sm">10:30 AM - Robert Davis</p>
                            <p class="text-white/60 text-xs">Dr. Michael Chen • Consultation</p>
                            <span class="text-xs text-blue-400 font-bold">Check-in pending</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-purple-400">
                        <div class="flex-1">
                            <p class="text-white font-semibold text-sm">11:00 AM - Linda Martinez</p>
                            <p class="text-white/60 text-xs">Dr. Emily Davis • Follow-up</p>
                            <span class="text-xs text-purple-400 font-bold">Scheduled</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-yellow-400">
                        <div class="flex-1">
                            <p class="text-white font-semibold text-sm">11:30 AM - James Wilson</p>
                            <p class="text-white/60 text-xs">Dr. Robert Brown • New Patient</p>
                            <span class="text-xs text-yellow-400 font-bold">Not confirmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pending Tasks -->
        <div class="lg:col-span-2 relative group">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-purple-400"></i>
                    Pending Tasks
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-invoice-dollar text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Pending Payments</p>
                                <p class="text-red-400 text-xs font-bold">5 outstanding</p>
                            </div>
                        </div>
                        <button class="w-full px-3 py-2 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white text-xs rounded-lg hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                            View All
                        </button>
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone-slash text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Missed Calls</p>
                                <p class="text-yellow-400 text-xs font-bold">3 to return</p>
                            </div>
                        </div>
                        <button class="w-full px-3 py-2 bg-white/10 text-white text-xs rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            Return Calls
                        </button>
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-id-card text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Insurance Verify</p>
                                <p class="text-blue-400 text-xs font-bold">8 pending</p>
                            </div>
                        </div>
                        <button class="w-full px-3 py-2 bg-white/10 text-white text-xs rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            Verify
                        </button>
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all duration-300 hover:bg-cyan-400/5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-times text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Rescheduling</p>
                                <p class="text-purple-400 text-xs font-bold">4 requests</p>
                            </div>
                        </div>
                        <button class="w-full px-3 py-2 bg-white/10 text-white text-xs rounded-lg hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            Process
                        </button>
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
                                <i class="fas fa-user-plus text-white text-sm"></i>
                            </div>
                            <span class="text-white font-semibold text-sm">New Patient</span>
                        </div>
                    </button>
                    <button class="w-full p-3 bg-gradient-to-r from-vital-orange/10 to-amber-600/5 rounded-lg border border-vital-orange/20 hover:border-vital-orange/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-600 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                <i class="fas fa-calendar-plus text-white text-sm"></i>
                            </div>
                            <span class="text-white font-semibold text-sm">Schedule Appt</span>
                        </div>
                    </button>
                    <button class="w-full p-3 bg-gradient-to-r from-purple-500/10 to-purple-700/5 rounded-lg border border-purple-400/20 hover:border-purple-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                <i class="fas fa-clipboard-check text-white text-sm"></i>
                            </div>
                            <span class="text-white font-semibold text-sm">Check In</span>
                        </div>
                    </button>
                    <button class="w-full p-3 bg-gradient-to-r from-amber-500/10 to-amber-700/5 rounded-lg border border-amber-400/20 hover:border-amber-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                <i class="fas fa-dollar-sign text-white text-sm"></i>
                            </div>
                            <span class="text-white font-semibold text-sm">Process Payment</span>
                            </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Dashboard Tab -->

