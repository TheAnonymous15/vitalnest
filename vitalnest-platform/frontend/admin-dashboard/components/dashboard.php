<?php
// Check authentication for admin role
$token = $_COOKIE['admin_token'] ?? '';
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
    <title>VitalNest - Admin Dashboard</title>
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
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">VitalNest</h1>
                            <p class="text-xs text-cyan-400 font-semibold">Admin Portal</p>
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
                    <!-- User Management -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('users')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-users text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">User Management</span>
                                </div>
                                <i id="users-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="users-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-list w-4 mr-2"></i> All Users
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-user-plus w-4 mr-2"></i> Add User
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-user-shield w-4 mr-2"></i> Roles & Permissions
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-ban w-4 mr-2"></i> Suspended Users
                            </div>
                        </div>
                    </div>
                    <!-- System Management -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('system')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-cogs text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">System</span>
                                </div>
                                <i id="system-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="system-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-server w-4 mr-2"></i> Server Status
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-database w-4 mr-2"></i> Database
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-sync w-4 mr-2"></i> Backups
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-sliders-h w-4 mr-2"></i> Configuration
                            </div>
                        </div>
                    </div>
                    <!-- Departments -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-building text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Departments</span>
                        </div>
                    </div>
                    <!-- Care Packages -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-vital-orange/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-vital-orange/10 hover:shadow-lg hover:shadow-vital-orange/20" onclick="showSection('packages-section')">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-box-open text-vital-orange w-5"></i>
                            <span class="text-white font-semibold">Care Packages</span>
                        </div>
                    </div>
                    <!-- Services -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-briefcase-medical text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Services</span>
                        </div>
                    </div>
                    <!-- Security & Audit -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('security')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-shield-alt text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Security</span>
                                </div>
                                <i id="security-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="security-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-history w-4 mr-2"></i> Audit Logs
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-sign-in-alt w-4 mr-2"></i> Login Activity
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-exclamation-triangle w-4 mr-2"></i> Security Alerts
                            </div>
                        </div>
                    </div>
                    <!-- Billing & Finance -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('billing')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-dollar-sign text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Billing & Finance</span>
                                </div>
                                <i id="billing-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="billing-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-file-invoice-dollar w-4 mr-2"></i> Invoices
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-credit-card w-4 mr-2"></i> Payments
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-receipt w-4 mr-2"></i> Transactions
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-chart-pie w-4 mr-2"></i> Financial Reports
                            </div>
                        </div>
                    </div>
                    <!-- Communications -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('comms')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Communications</span>
                                </div>
                                <i id="comms-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="comms-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-bullhorn w-4 mr-2"></i> Announcements
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-paper-plane w-4 mr-2"></i> Mass Email
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-sms w-4 mr-2"></i> SMS Notifications
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-bell w-4 mr-2"></i> Push Notifications
                            </div>
                        </div>
                    </div>
                    <!-- Compliance & Legal -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('compliance')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-gavel text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Compliance</span>
                                </div>
                                <i id="compliance-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="compliance-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-shield-alt w-4 mr-2"></i> HIPAA Compliance
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-user-lock w-4 mr-2"></i> Data Privacy
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-file-contract w-4 mr-2"></i> Legal Documents
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-clipboard-check w-4 mr-2"></i> Audit Trail
                            </div>
                        </div>
                    </div>
                    <!-- Integration & API -->
                    <div>
                        <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20" onclick="toggleSubmenu('integrations')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-plug text-cyan-400 w-5"></i>
                                    <span class="text-white font-semibold">Integrations</span>
                                </div>
                                <i id="integrations-icon" class="fas fa-chevron-down text-white/60 text-xs transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="integrations-submenu" class="ml-6 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-key w-4 mr-2"></i> API Keys
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-link w-4 mr-2"></i> Third-Party Apps
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-webhook w-4 mr-2"></i> Webhooks
                            </div>
                            <div class="px-4 py-2 text-white/70 hover:text-cyan-400 cursor-pointer text-sm rounded-lg hover:bg-cyan-400/10 transform transition-all duration-200 hover:translate-x-1">
                                <i class="fas fa-exchange-alt w-4 mr-2"></i> Data Exchange
                            </div>
                        </div>
                    </div>
                    <!-- Support & Tickets -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-ticket-alt text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Support Tickets</span>
                        </div>
                    </div>
                    <!-- Analytics -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chart-line text-cyan-400 w-5"></i>
                            <span class="text-white font-semibold">Analytics</span>
                        </div>
                    </div>
                    <!-- Reports -->
                    <div class="px-4 py-3 rounded-xl border-l-4 border-transparent hover:border-cyan-400/50 bg-white/5 backdrop-blur-sm cursor-pointer transform transition-all duration-300 hover:translate-x-2 hover:bg-cyan-400/10 hover:shadow-lg hover:shadow-cyan-500/20">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-file-alt text-cyan-400 w-5"></i>
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
                                <span class="relative">AD</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm" id="userName">Administrator</p>
                                <p class="text-cyan-400 text-xs">System Admin</p>
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
                                    <span class="relative z-10">Admin Dashboard</span>
                                    <span class="absolute inset-0 text-cyan-400 blur-md opacity-30">Admin Dashboard</span>
                                </h2>
                                <p class="text-sm text-white/60 mt-1">Complete system overview and management</p>
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
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-green-400 font-semibold px-3 py-1 bg-green-400/10 rounded-full border border-green-400/20">+12%</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">1,247</h3>
                            <p class="text-white/60 text-sm">Total Users</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-vital-orange/20 to-amber-600/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-vital-orange/20 rounded-2xl p-6 hover:border-vital-orange/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-vital-orange to-amber-600 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-vital-orange to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-chart-line text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-blue-400 font-semibold px-3 py-1 bg-blue-400/10 rounded-full border border-blue-400/20">Live</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">342</h3>
                            <p class="text-white/60 text-sm">Active Sessions</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-purple-400/20 rounded-2xl p-6 hover:border-purple-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-purple-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-building text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-purple-400 font-semibold px-3 py-1 bg-purple-400/10 rounded-full border border-purple-400/20">Active</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">18</h3>
                            <p class="text-white/60 text-sm">Departments</p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-red-700/10 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-red-400/20 rounded-2xl p-6 hover:border-red-400/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-red-500/20">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-700 rounded-t-2xl"></div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-700 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/50 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                                </div>
                                <span class="text-sm text-red-400 font-semibold px-3 py-1 bg-red-400/10 rounded-full border border-red-400/20 animate-pulse">Urgent</span>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-1">7</h3>
                            <p class="text-white/60 text-sm">Security Alerts</p>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                    <!-- Recent Activity -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-history text-cyan-400"></i>
                                Recent Activity
                            </h3>
                            <div class="space-y-3">
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-green-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user-plus text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold text-sm">New User Created</p>
                                                <p class="text-white/60 text-xs">Dr. Sarah Johnson - Doctor Role</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-white/60">10m ago</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-blue-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-database text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold text-sm">Database Backup Completed</p>
                                                <p class="text-white/60 text-xs">All databases backed up successfully</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-white/60">1h ago</span>
                                    </div>
                                </div>
                                <div class="p-3 bg-white/5 rounded-lg hover:bg-cyan-400/5 transition-all duration-300 transform hover:translate-x-1 cursor-pointer border-l-4 border-purple-400">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-cogs text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold text-sm">System Configuration Updated</p>
                                                <p class="text-white/60 text-xs">Mail server settings modified</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-white/60">2h ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Alerts -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-red-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-shield-alt text-red-400 animate-pulse"></i>
                                Security Alerts
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-lg hover:bg-red-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-red-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">Failed Login Attempts</p>
                                        <p class="text-white/70 text-xs">5 failed attempts from IP: 192.168.1.42</p>
                                    </div>
                                    <span class="text-xs text-red-400 font-bold px-2 py-1 bg-red-400/20 rounded">CRITICAL</span>
                                </div>
                                <div class="flex items-center gap-3 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-lg hover:bg-yellow-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">Unusual Activity Detected</p>
                                        <p class="text-white/70 text-xs">Multiple role changes in short period</p>
                                    </div>
                                    <span class="text-xs text-yellow-400 font-bold px-2 py-1 bg-yellow-400/20 rounded">WARNING</span>
                                </div>
                                <div class="flex items-center gap-3 p-4 bg-orange-500/10 border border-orange-500/20 rounded-lg hover:bg-orange-500/20 transition-all duration-300 transform hover:translate-x-2 cursor-pointer">
                                    <div class="w-3 h-3 bg-orange-400 rounded-full animate-pulse flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-white/90 font-semibold text-sm">Permission Changes</p>
                                        <p class="text-white/70 text-xs">Admin permissions modified for user #2458</p>
                                    </div>
                                    <span class="text-xs text-orange-400 font-bold px-2 py-1 bg-orange-400/20 rounded">REVIEW</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Status & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- System Status -->
                    <div class="lg:col-span-2 relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-cyan-400/30 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-server text-purple-400"></i>
                                System Status
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-white/5 rounded-xl border border-green-400/20">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-white/80 text-sm font-semibold">API Gateway</p>
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    </div>
                                    <p class="text-green-400 text-xs">Online • 99.9% uptime</p>
                                    <div class="mt-2 h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-400 w-full rounded-full"></div>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-green-400/20">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-white/80 text-sm font-semibold">Database</p>
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    </div>
                                    <p class="text-green-400 text-xs">Connected • 2.1GB used</p>
                                    <div class="mt-2 h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-400 w-4/5 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-yellow-400/20">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-white/80 text-sm font-semibold">Storage</p>
                                        <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                                    </div>
                                    <p class="text-yellow-400 text-xs">75% capacity • 150GB free</p>
                                    <div class="mt-2 h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 w-3/4 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/5 rounded-xl border border-green-400/20">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-white/80 text-sm font-semibold">Services</p>
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    </div>
                                    <p class="text-green-400 text-xs">All running • 12/12 active</p>
                                    <div class="mt-2 h-1 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-400 w-full rounded-full"></div>
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
                                            <i class="fas fa-user-plus text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Add New User</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-vital-orange/10 to-amber-600/5 rounded-lg border border-vital-orange/20 hover:border-vital-orange/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-vital-orange to-amber-600 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-sync text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">Run Backup</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-purple-500/10 to-purple-700/5 rounded-lg border border-purple-400/20 hover:border-purple-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-chart-bar text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">View Reports</span>
                                    </div>
                                </button>
                                <button class="w-full p-3 bg-gradient-to-r from-amber-500/10 to-amber-700/5 rounded-lg border border-amber-400/20 hover:border-amber-400/50 transition-all duration-300 hover:scale-105 text-left group/btn">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-700 rounded-lg flex items-center justify-center shadow-lg transform transition-transform duration-300 group-hover/btn:scale-110">
                                            <i class="fas fa-cogs text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-semibold text-sm">System Config</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Packages Management Section (Hidden by default) -->
                <div id="packages-section" class="hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                                <i class="fas fa-box-open text-vital-orange"></i>
                                Care Packages Management
                            </h3>
                            <p class="text-white/60 text-sm mt-1">Manage pricing, features, and availability of care packages</p>
                        </div>
                        <button onclick="openAddPackageModal()" class="px-5 py-2.5 bg-gradient-to-r from-vital-orange to-amber-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-vital-orange/30 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Add Package
                        </button>
                    </div>

                    <!-- Packages Grid -->
                    <div id="packagesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <!-- Packages loaded dynamically -->
                        <div class="text-center py-12 col-span-full">
                            <i class="fas fa-spinner fa-spin text-4xl text-cyan-400 mb-4"></i>
                            <p class="text-white/60">Loading packages...</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Add/Edit Package Modal -->
    <div id="packageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-white/10 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-slate-800 border-b border-white/10 p-6 flex items-center justify-between">
                <h3 id="modalTitle" class="text-xl font-bold text-white">Add New Package</h3>
                <button onclick="closePackageModal()" class="text-white/60 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="packageForm" class="p-6 space-y-4">
                <input type="hidden" id="packageId" value="">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Package Name *</label>
                        <input type="text" id="pkgName" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none" placeholder="e.g., Basic Care">
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Slug *</label>
                        <input type="text" id="pkgSlug" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none" placeholder="e.g., basic">
                    </div>
                </div>

                <div>
                    <label class="block text-white/80 text-sm font-medium mb-1">Description</label>
                    <textarea id="pkgDescription" rows="2" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none resize-none" placeholder="Brief description of the package"></textarea>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Price (KES) *</label>
                        <input type="number" id="pkgPrice" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none" placeholder="25000">
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Duration</label>
                        <input type="number" id="pkgDuration" value="1" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Duration Unit</label>
                        <select id="pkgDurationUnit" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none">
                            <option value="month">Month</option>
                            <option value="trimester">Trimester</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Icon (FontAwesome)</label>
                        <input type="text" id="pkgIcon" value="fa-box" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none" placeholder="fa-leaf">
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Color</label>
                        <select id="pkgColor" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none">
                            <option value="teal">Teal</option>
                            <option value="orange">Orange</option>
                            <option value="rose">Rose</option>
                            <option value="pink">Pink</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm font-medium mb-1">Badge Text</label>
                        <input type="text" id="pkgBadge" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white focus:border-vital-orange focus:outline-none" placeholder="STARTER">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="pkgPopular" class="w-5 h-5 rounded border-white/20 bg-white/5 text-vital-orange focus:ring-vital-orange">
                        <label for="pkgPopular" class="text-white/80 text-sm">Mark as Popular</label>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="pkgActive" checked class="w-5 h-5 rounded border-white/20 bg-white/5 text-vital-orange focus:ring-vital-orange">
                        <label for="pkgActive" class="text-white/80 text-sm">Active</label>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="border-t border-white/10 pt-4 mt-4">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-white/80 text-sm font-medium">Features</label>
                        <button type="button" onclick="addFeatureRow()" class="text-vital-orange text-sm hover:underline">
                            <i class="fas fa-plus mr-1"></i>Add Feature
                        </button>
                    </div>
                    <div id="featuresContainer" class="space-y-2">
                        <!-- Feature rows added dynamically -->
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                    <button type="button" onclick="closePackageModal()" class="px-5 py-2.5 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-vital-orange to-amber-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-vital-orange/30 transition-all">
                        <i class="fas fa-save mr-2"></i>Save Package
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-red-500/20 w-full max-w-md p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trash-alt text-3xl text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Delete Package?</h3>
                <p class="text-white/60 text-sm mb-6">This action cannot be undone. All features will also be deleted.</p>
                <input type="hidden" id="deletePackageId">
                <div class="flex gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                        Cancel
                    </button>
                    <button onclick="confirmDelete()" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Packages Management Functions
        let packagesData = [];

        async function loadPackages() {
            try {
                const response = await fetch('/api/packages/admin/packages');
                const data = await response.json();
                if (data.success) {
                    packagesData = data.data;
                    renderPackages();
                }
            } catch (error) {
                console.error('Error loading packages:', error);
                document.getElementById('packagesGrid').innerHTML = `
                    <div class="text-center py-12 col-span-full">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                        <p class="text-white/60">Failed to load packages</p>
                    </div>
                `;
            }
        }

        function renderPackages() {
            const grid = document.getElementById('packagesGrid');
            if (packagesData.length === 0) {
                grid.innerHTML = `
                    <div class="text-center py-12 col-span-full">
                        <i class="fas fa-box-open text-4xl text-white/20 mb-4"></i>
                        <p class="text-white/60">No packages yet. Create your first package!</p>
                    </div>
                `;
                return;
            }

            const colorClasses = {
                teal: { bg: 'from-teal-500/20 to-teal-900/40', border: 'border-teal-500/20', text: 'text-teal-400' },
                orange: { bg: 'from-orange-500/20 to-orange-900/40', border: 'border-orange-500/20', text: 'text-orange-400' },
                rose: { bg: 'from-rose-500/20 to-rose-900/40', border: 'border-rose-500/20', text: 'text-rose-400' },
                pink: { bg: 'from-pink-500/20 to-pink-900/40', border: 'border-pink-500/20', text: 'text-pink-400' }
            };

            grid.innerHTML = packagesData.map(pkg => {
                const colors = colorClasses[pkg.color] || colorClasses.teal;
                return `
                    <div class="relative group">
                        <div class="bg-gradient-to-br ${colors.bg} backdrop-blur-xl rounded-2xl p-5 border ${colors.border} hover:border-white/20 transition-all duration-300">
                            ${!pkg.is_active ? '<div class="absolute top-3 right-3 px-2 py-0.5 bg-red-500/20 text-red-400 text-xs rounded-full">Inactive</div>' : ''}
                            ${pkg.is_popular ? '<div class="absolute top-3 left-3 px-2 py-0.5 bg-amber-500/20 text-amber-400 text-xs rounded-full">Popular</div>' : ''}

                            <div class="flex items-center gap-3 mb-4 ${pkg.is_popular || !pkg.is_active ? 'mt-4' : ''}">
                                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                    <i class="fas ${pkg.icon} ${colors.text} text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold">${pkg.name}</h4>
                                    <p class="${colors.text} text-sm font-semibold">${pkg.currency} ${pkg.price_formatted}${pkg.duration_text}</p>
                                </div>
                            </div>

                            <p class="text-white/50 text-xs mb-4 line-clamp-2">${pkg.description || 'No description'}</p>

                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-white/40 text-xs">${pkg.features.length} features</span>
                                ${pkg.badge ? `<span class="px-2 py-0.5 bg-white/10 text-white/60 text-xs rounded">${pkg.badge}</span>` : ''}
                            </div>

                            <div class="flex gap-2">
                                <button onclick="editPackage(${pkg.id})" class="flex-1 px-3 py-2 bg-white/10 hover:bg-white/20 text-white text-sm rounded-lg transition-all">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <button onclick="togglePackageStatus(${pkg.id})" class="px-3 py-2 bg-white/10 hover:bg-white/20 text-white text-sm rounded-lg transition-all" title="${pkg.is_active ? 'Deactivate' : 'Activate'}">
                                    <i class="fas ${pkg.is_active ? 'fa-eye-slash' : 'fa-eye'}"></i>
                                </button>
                                <button onclick="openDeleteModal(${pkg.id})" class="px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 text-sm rounded-lg transition-all">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function openAddPackageModal() {
            document.getElementById('modalTitle').textContent = 'Add New Package';
            document.getElementById('packageForm').reset();
            document.getElementById('packageId').value = '';
            document.getElementById('featuresContainer').innerHTML = '';
            addFeatureRow(); // Add one empty row
            document.getElementById('packageModal').classList.remove('hidden');
        }

        function closePackageModal() {
            document.getElementById('packageModal').classList.add('hidden');
        }

        function editPackage(id) {
            const pkg = packagesData.find(p => p.id === id);
            if (!pkg) return;

            document.getElementById('modalTitle').textContent = 'Edit Package';
            document.getElementById('packageId').value = pkg.id;
            document.getElementById('pkgName').value = pkg.name;
            document.getElementById('pkgSlug').value = pkg.slug;
            document.getElementById('pkgDescription').value = pkg.description || '';
            document.getElementById('pkgPrice').value = pkg.price;
            document.getElementById('pkgDuration').value = pkg.duration_value;
            document.getElementById('pkgDurationUnit').value = pkg.duration_unit;
            document.getElementById('pkgIcon').value = pkg.icon;
            document.getElementById('pkgColor').value = pkg.color;
            document.getElementById('pkgBadge').value = pkg.badge || '';
            document.getElementById('pkgPopular').checked = pkg.is_popular;
            document.getElementById('pkgActive').checked = pkg.is_active;

            // Load features
            const container = document.getElementById('featuresContainer');
            container.innerHTML = '';
            pkg.features.forEach(f => addFeatureRow(f));
            if (pkg.features.length === 0) addFeatureRow();

            document.getElementById('packageModal').classList.remove('hidden');
        }

        function addFeatureRow(feature = null) {
            const container = document.getElementById('featuresContainer');
            const row = document.createElement('div');
            row.className = 'flex gap-2 items-start';
            row.innerHTML = `
                <input type="text" placeholder="Feature title" value="${feature?.title || ''}" class="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-vital-orange focus:outline-none feature-title">
                <input type="text" placeholder="Description" value="${feature?.description || ''}" class="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-vital-orange focus:outline-none feature-desc">
                <input type="text" placeholder="fa-check" value="${feature?.icon || 'fa-check'}" class="w-24 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-vital-orange focus:outline-none feature-icon">
                <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(row);
        }

        document.getElementById('packageForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            // Collect features
            const features = [];
            document.querySelectorAll('#featuresContainer > div').forEach((row, i) => {
                const title = row.querySelector('.feature-title').value.trim();
                if (title) {
                    features.push({
                        title: title,
                        description: row.querySelector('.feature-desc').value.trim(),
                        icon: row.querySelector('.feature-icon').value.trim() || 'fa-check',
                        icon_color: document.getElementById('pkgColor').value,
                        sort_order: i + 1
                    });
                }
            });

            const packageData = {
                name: document.getElementById('pkgName').value,
                slug: document.getElementById('pkgSlug').value,
                description: document.getElementById('pkgDescription').value,
                price: parseFloat(document.getElementById('pkgPrice').value),
                duration_value: parseInt(document.getElementById('pkgDuration').value) || 1,
                duration_unit: document.getElementById('pkgDurationUnit').value,
                icon: document.getElementById('pkgIcon').value,
                color: document.getElementById('pkgColor').value,
                badge: document.getElementById('pkgBadge').value,
                is_popular: document.getElementById('pkgPopular').checked ? 1 : 0,
                is_active: document.getElementById('pkgActive').checked ? 1 : 0,
                features: features
            };

            const id = document.getElementById('packageId').value;
            const url = id ? `/api/packages/admin/packages/${id}` : '/api/packages/admin/packages';
            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(packageData)
                });
                const data = await response.json();

                if (data.success) {
                    closePackageModal();
                    loadPackages();
                } else {
                    alert(data.message || 'Failed to save package');
                }
            } catch (error) {
                console.error('Error saving package:', error);
                alert('Failed to save package');
            }
        });

        async function togglePackageStatus(id) {
            try {
                const response = await fetch(`/api/packages/admin/packages/${id}/toggle`, { method: 'PATCH' });
                const data = await response.json();
                if (data.success) loadPackages();
            } catch (error) {
                console.error('Error toggling status:', error);
            }
        }

        function openDeleteModal(id) {
            document.getElementById('deletePackageId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        async function confirmDelete() {
            const id = document.getElementById('deletePackageId').value;
            try {
                const response = await fetch(`/api/packages/admin/packages/${id}`, { method: 'DELETE' });
                const data = await response.json();
                if (data.success) {
                    closeDeleteModal();
                    loadPackages();
                }
            } catch (error) {
                console.error('Error deleting package:', error);
            }
        }

        // Show section function
        function showSection(sectionId) {
            // Hide all content sections except dashboard stats
            document.querySelectorAll('#packages-section').forEach(s => s.classList.add('hidden'));

            // Show requested section
            const section = document.getElementById(sectionId);
            if (section) {
                section.classList.remove('hidden');
                if (sectionId === 'packages-section') {
                    loadPackages();
                }
            }
        }

        // Auto-generate slug from name
        document.getElementById('pkgName')?.addEventListener('input', (e) => {
            const slugField = document.getElementById('pkgSlug');
            if (!document.getElementById('packageId').value) {
                slugField.value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }
        });
    </script>

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

        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('admin_user');
            localStorage.removeItem('admin_token');
            document.cookie = 'admin_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function cancelLogout() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Inactivity timeout (5 minutes = 300000ms)
        let inactivityTimeout;
        let warningTimeout;
        const INACTIVITY_LIMIT = 5 * 60 * 1000; // 5 minutes
        const WARNING_BEFORE = 60 * 1000; // Show warning 1 minute before

        function resetInactivityTimer() {
            clearTimeout(inactivityTimeout);
            clearTimeout(warningTimeout);
            hideInactivityWarning();

            // Show warning 1 minute before logout
            warningTimeout = setTimeout(() => {
                showInactivityWarning();
            }, INACTIVITY_LIMIT - WARNING_BEFORE);

            // Auto logout after inactivity
            inactivityTimeout = setTimeout(() => {
                autoLogout();
            }, INACTIVITY_LIMIT);
        }

        function showInactivityWarning() {
            document.getElementById('inactivityModal').classList.remove('hidden');
        }

        function hideInactivityWarning() {
            document.getElementById('inactivityModal').classList.add('hidden');
        }

        function autoLogout() {
            localStorage.removeItem('admin_user');
            localStorage.removeItem('admin_token');
            document.cookie = 'admin_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function stayLoggedIn() {
            hideInactivityWarning();
            resetInactivityTimer();
        }

        // Listen for user activity
        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'].forEach(event => {
            document.addEventListener(event, resetInactivityTimer, true);
        });

        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('admin_user') || '{}');
            if (user.first_name) {
                document.getElementById('userName').textContent = user.first_name + ' ' + (user.last_name || '');
            }
            // Start inactivity timer
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
                    <p class="text-slate-400 text-center mb-8">You've been inactive for a while. For security, you'll be logged out in <span class="text-yellow-400 font-bold">1 minute</span> unless you continue working.</p>
                    <div class="flex gap-4">
                        <button onclick="autoLogout()" class="flex-1 px-6 py-3 rounded-xl bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 hover:text-white font-semibold transition-all duration-300 border border-slate-600/50 hover:border-slate-500/50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout Now
                        </button>
                        <button onclick="stayLoggedIn()" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold transition-all duration-300 shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40">
                            <i class="fas fa-check mr-2"></i>Stay Logged In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cancelLogout()"></div>

        <!-- Modal Content -->
        <div class="relative w-full max-w-md transform transition-all">
            <div class="relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-xl rounded-3xl border border-white/10 shadow-2xl overflow-hidden">
                <!-- Glowing border effect -->
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-cyan-500/20 via-transparent to-orange-500/20 pointer-events-none"></div>

                <!-- Content -->
                <div class="relative p-8">
                    <!-- Icon -->
                    <div class="flex justify-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500/20 to-red-500/20 flex items-center justify-center border border-orange-500/30">
                            <i class="fas fa-sign-out-alt text-3xl text-orange-400"></i>
                        </div>
                    </div>

                    <!-- Text -->
                    <h3 class="text-2xl font-bold text-white text-center mb-2">Confirm Logout</h3>
                    <p class="text-slate-400 text-center mb-8">Are you sure you want to end your session? You'll need to login again to access the dashboard.</p>

                    <!-- Buttons -->
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

