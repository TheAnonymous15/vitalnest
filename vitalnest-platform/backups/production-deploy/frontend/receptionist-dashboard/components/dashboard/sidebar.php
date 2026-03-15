<!-- Sidebar -->
<aside id="sidebar" class="w-72 relative">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-800/90 to-slate-900/95 backdrop-blur-2xl border-r border-cyan-400/20 rounded-r-[2rem] shadow-2xl shadow-cyan-500/10"></div>
    <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-cyan-400/50 to-transparent animate-pulse"></div>
    <div class="relative h-full flex flex-col">
        <div class="p-6 border-b border-cyan-400/10">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/50 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <i class="fas fa-headset text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">VitalNest</h1>
                    <p class="text-xs text-cyan-400 font-semibold">Reception Desk</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto p-4 space-y-2 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">
            <div id="dashboard-menu" onclick="showTab('dashboard')" class="menu-item px-4 py-3 rounded-xl border-l-4 border-cyan-400 bg-gradient-to-r from-cyan-400/20 to-cyan-400/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-home text-cyan-400 w-5"></i>
                    <span class="text-white font-semibold">Dashboard</span>
                </div>
            </div>
            <!-- Patient Registration -->
            <div>
                <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('patients')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-plus text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Patient Registration</span>
                        </div>
                        <i id="patients-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                    </div>
                </div>
                <div id="patients-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-user-plus w-4 mr-2"></i> New Patient
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-edit w-4 mr-2"></i> Update Info
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-search w-4 mr-2"></i> Search Patient
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-id-card w-4 mr-2"></i> Verify Insurance
                    </div>
                </div>
            </div>
            <!-- Appointments -->
            <div>
                <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('appointments')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Appointments</span>
                        </div>
                        <i id="appointments-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                    </div>
                </div>
                <div id="appointments-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-calendar-plus w-4 mr-2"></i> Schedule New
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-list w-4 mr-2"></i> View Schedule
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-edit w-4 mr-2"></i> Reschedule
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-times-circle w-4 mr-2"></i> Cancellations
                    </div>
                </div>
            </div>
            <!-- Check-In / Check-Out -->
            <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-clipboard-check text-cyan-400 w-5"></i>
                    <span class="text-white font-semibold">Check-In/Out</span>
                </div>
            </div>
            <!-- Waiting Room -->
            <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-users text-cyan-400 w-5"></i>
                    <span class="text-white font-semibold">Waiting Room</span>
                </div>
            </div>
            <!-- Billing & Payments -->
            <div>
                <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('billing')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-dollar-sign text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Billing</span>
                        </div>
                        <i id="billing-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                    </div>
                </div>
                <div id="billing-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-file-invoice-dollar w-4 mr-2"></i> Create Invoice
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-credit-card w-4 mr-2"></i> Process Payment
                    </div>
                    <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                        <i class="fas fa-receipt w-4 mr-2"></i> View Receipts
                    </div>
                </div>
            </div>
            <!-- Communications -->
            <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-phone text-cyan-400 w-5"></i>
                    <span class="text-white font-semibold">Phone Calls</span>
                </div>
            </div>
            <!-- Messages -->
            <div id="messages-menu" onclick="showTab('messages')" class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-envelope text-cyan-400 w-5"></i>
                    <span class="text-white font-semibold">Messages</span>
                    <span id="unread-badge" class="ml-auto px-2 py-0.5 bg-red-500 text-white text-xs font-bold rounded-full hidden">0</span>
                </div>
            </div>
            <!-- Reports -->
            <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-chart-bar text-cyan-400 w-5"></i>
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
            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-all cursor-pointer group">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p id="userName" class="text-white font-semibold text-sm truncate">Receptionist</p>
                    <p class="text-cyan-400 text-xs">Online</p>
                </div>
                <button onclick="logout()" class="text-white/60 hover:text-red-400 transition-all hover:scale-110 transform">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</aside>

