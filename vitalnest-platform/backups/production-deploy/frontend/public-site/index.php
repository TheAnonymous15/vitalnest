<?php
// Vitalnest Homecare - Digital Healthcare Infrastructure Platform
// Version: 1.0.0
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalnest Homecare | Digital Healthcare Infrastructure | Feel Human. Operate Like a System.</title>
    <meta name="description" content="Enterprise-grade digital healthcare platform delivering professional home-based care services. Microservices architecture for scalable, reliable healthcare delivery.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                        'warm-orange': '#F97316',
                        'soft-amber': '#FDBA74',
                        'cream-white': '#FFFBEB',
                        'light-gray': '#F3F4F6',
                        'medium-gray': '#D1D5DB',
                        'charcoal': '#1F2933',
                        'success': '#16A34A',
                        'warning': '#EAB308',
                        'critical': '#DC2626',
                        'info': '#2563EB',
                    },
                    fontFamily: {
                        sans: ['Inter', 'Source Sans Pro', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white font-sans text-charcoal antialiased">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-deep-teal shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-warm-orange rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">V</span>
                    </div>
                    <div>
                        <span class="text-white font-bold text-xl">Vitalnest</span>
                        <p class="text-soft-amber text-xs">Healthcare Infrastructure</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#platform" class="text-cream-white hover:text-warm-orange transition font-medium">Platform</a>
                    <a href="#services" class="text-cream-white hover:text-warm-orange transition font-medium">Services</a>
                    <a href="#dashboards" class="text-cream-white hover:text-warm-orange transition font-medium">Dashboards</a>
                    <a href="#architecture" class="text-cream-white hover:text-warm-orange transition font-medium">Architecture</a>
                    <a href="#contact" class="text-cream-white hover:text-warm-orange transition font-medium">Contact</a>
                </div>

                <div class="flex gap-3">
                    <button class="hidden md:block px-6 py-2 text-white border border-warm-orange rounded-lg hover:bg-warm-orange transition">Sign In</button>
                    <button class="px-6 py-2 bg-warm-orange text-white rounded-lg font-semibold hover:bg-soft-amber hover:text-deep-teal transition">Get Started</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-deep-teal via-vital-teal to-teal-600 text-white py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-72 h-72 bg-warm-orange rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-soft-amber rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-block px-4 py-2 bg-warm-orange/20 border border-warm-orange/30 rounded-full mb-6">
                        <span class="text-soft-amber font-semibold">Digital Healthcare Infrastructure</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        Homecare,<br/>
                        <span class="text-warm-orange">Reimagined</span>
                    </h1>
                    <p class="text-xl text-teal-100 mb-8 leading-relaxed">
                        Enterprise-grade microservices platform delivering professional home-based healthcare.
                        <span class="text-soft-amber font-semibold">Feel human. Operate like a system. Grow like a platform.</span>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="px-8 py-4 bg-warm-orange text-white rounded-xl font-bold hover:bg-soft-amber hover:text-deep-teal transition shadow-xl">
                            Explore Platform
                        </button>
                        <button class="px-8 py-4 bg-transparent text-white border-2 border-white rounded-xl font-semibold hover:bg-white hover:text-vital-teal transition">
                            View Architecture
                        </button>
                    </div>

                    <div class="mt-12 grid grid-cols-3 gap-6">
                        <div>
                            <div class="text-3xl font-bold text-warm-orange">5000+</div>
                            <div class="text-sm text-teal-200">Active Patients</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-warm-orange">500+</div>
                            <div class="text-sm text-teal-200">Care Providers</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-warm-orange">98%</div>
                            <div class="text-sm text-teal-200">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <div class="text-center mb-6">
                            <i class="fas fa-heartbeat text-7xl text-warm-orange"></i>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 bg-white/10 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-success text-xl"></i>
                                <span>Real-time Care Monitoring</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-success text-xl"></i>
                                <span>HIPAA Compliant Platform</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-success text-xl"></i>
                                <span>Microservices Architecture</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-success text-xl"></i>
                                <span>AI-Ready Analytics</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Philosophy -->
    <section id="platform" class="py-20 bg-cream-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Platform Philosophy</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Three integrated layers working in harmony to deliver exceptional healthcare
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Human Layer -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-t-4 border-warm-orange hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-warm-orange/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-heart text-3xl text-warm-orange"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Human Layer</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Warm, empathetic visual design</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Simple, reassuring language</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Emotional support focus</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-warm-orange mt-1"></i>
                            <span>Trust signals everywhere</span>
                        </li>
                    </ul>
                </div>

                <!-- System Layer -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-t-4 border-vital-teal hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-vital-teal/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-cogs text-3xl text-vital-teal"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">System Layer</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-vital-teal mt-1"></i>
                            <span>Clear clinical workflows</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-vital-teal mt-1"></i>
                            <span>Strong service separation</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-vital-teal mt-1"></i>
                            <span>Role-based access control</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-vital-teal mt-1"></i>
                            <span>Complete auditability</span>
                        </li>
                    </ul>
                </div>

                <!-- Platform Layer -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-t-4 border-info hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-info/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-network-wired text-3xl text-info"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Platform Layer</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-info mt-1"></i>
                            <span>Modular microservices</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-info mt-1"></i>
                            <span>API-first design</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-info mt-1"></i>
                            <span>Event-driven architecture</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-info mt-1"></i>
                            <span>Analytics-native platform</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Microservices Architecture -->
    <section id="architecture" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Microservices Architecture</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Enterprise-grade distributed system with event-driven communication
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Identity & Access Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-vital-teal hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-shield-alt text-2xl text-vital-teal"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Identity & Access</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• User authentication</li>
                        <li>• Role-based access control (RBAC)</li>
                        <li>• Multi-role users</li>
                        <li>• Audit trails</li>
                    </ul>
                </div>

                <!-- Client & Patient Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-warm-orange hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-users text-2xl text-warm-orange"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Client & Patient</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Client profiles</li>
                        <li>• Patient records</li>
                        <li>• Family relationships</li>
                        <li>• Consent management</li>
                    </ul>
                </div>

                <!-- Caregiver Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-success hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-user-nurse text-2xl text-success"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Caregiver Service</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Caregiver profiles</li>
                        <li>• Credential verification</li>
                        <li>• Availability scheduling</li>
                        <li>• Performance metrics</li>
                    </ul>
                </div>

                <!-- Scheduling Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-info hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-calendar-check text-2xl text-info"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Scheduling & Visits</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Home visit booking</li>
                        <li>• Assignment logic</li>
                        <li>• Visit status lifecycle</li>
                        <li>• Time & location logging</li>
                    </ul>
                </div>

                <!-- Medical Records Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-warning hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-file-medical text-2xl text-warning"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Medical Records</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Visit notes</li>
                        <li>• Observations</li>
                        <li>• Wound records</li>
                        <li>• Chronic condition tracking</li>
                    </ul>
                </div>

                <!-- Reporting Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-critical hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-chart-bar text-2xl text-critical"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Reporting Service</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Pre-computed reports</li>
                        <li>• Role-specific exports</li>
                        <li>• PDF / CSV generation</li>
                        <li>• Compliance reports</li>
                    </ul>
                </div>

                <!-- Analytics Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-vital-teal hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-chart-line text-2xl text-vital-teal"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Analytics Service</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Event tracking</li>
                        <li>• KPI aggregation</li>
                        <li>• Trend analysis</li>
                        <li>• Predictive readiness</li>
                    </ul>
                </div>

                <!-- Notification Service -->
                <div class="bg-light-gray rounded-xl p-6 border-l-4 border-warm-orange hover:shadow-lg transition">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-bell text-2xl text-warm-orange"></i>
                        <h3 class="text-lg font-bold text-deep-teal">Notification Service</h3>
                    </div>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• Email notifications</li>
                        <li>• SMS / WhatsApp</li>
                        <li>• System alerts</li>
                        <li>• Event-driven messaging</li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 bg-gradient-to-r from-vital-teal to-deep-teal rounded-2xl p-8 text-white">
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-4xl font-bold mb-2">9</div>
                        <div class="text-teal-200">Microservices</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">API-First</div>
                        <div class="text-teal-200">Architecture</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">Event-Driven</div>
                        <div class="text-teal-200">Communication</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Ecosystem -->
    <section id="dashboards" class="py-20 bg-cream-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Dashboard Ecosystem</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Role-specific interfaces for every stakeholder in the care delivery process
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Admin Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-vital-teal/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-tachometer-alt text-3xl text-vital-teal"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Admin Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• System overview & KPIs</li>
                        <li>• Active patients & caregivers</li>
                        <li>• Visit pipeline management</li>
                        <li>• Revenue & package insights</li>
                        <li>• Risk & compliance alerts</li>
                    </ul>
                </div>

                <!-- Doctor/Clinician Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-warm-orange/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-md text-3xl text-warm-orange"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Clinician Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• Assigned patient overview</li>
                        <li>• Clinical summaries</li>
                        <li>• Diagnosis & treatment notes</li>
                        <li>• Medication plan management</li>
                        <li>• Lab results review</li>
                        <li>• Care plan approval</li>
                    </ul>
                </div>

                <!-- Caregiver Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-success/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-hands-helping text-3xl text-success"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Caregiver Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• Daily assignments</li>
                        <li>• Patient profiles access</li>
                        <li>• Task checklists</li>
                        <li>• Visit reporting tools</li>
                        <li>• Photo & evidence uploads</li>
                    </ul>
                </div>

                <!-- Client/Family Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-info/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-home text-3xl text-info"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Client/Family Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• Care plan overview</li>
                        <li>• Visit history timeline</li>
                        <li>• Lab results & reports</li>
                        <li>• Notifications & alerts</li>
                        <li>• Secure messaging</li>
                    </ul>
                </div>

                <!-- Lab Technician Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-warning/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-flask text-3xl text-warning"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Lab Technician Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• Pending lab requests</li>
                        <li>• Sample tracking system</li>
                        <li>• Lab result entry forms</li>
                        <li>• Result validation</li>
                        <li>• Historical lab data</li>
                    </ul>
                </div>

                <!-- Analytics Dashboard -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-critical/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-analytics text-3xl text-critical"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-deep-teal mb-4">Analytics Dashboard</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>• Operational KPIs</li>
                        <li>• Clinical outcomes tracking</li>
                        <li>• Lab turnaround times</li>
                        <li>• Utilization metrics</li>
                        <li>• Growth indicators</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Analytics & Intelligence -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-6">Analytics & Intelligence</h2>
                    <p class="text-xl text-gray-700 mb-8">
                        Data-driven insights powering better healthcare decisions with AI-ready infrastructure
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-vital-teal/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-pie text-vital-teal text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-deep-teal mb-1">Real-Time KPI Tracking</h4>
                                <p class="text-gray-600 text-sm">Visit completion rates, caregiver utilization, patient outcomes</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-warm-orange/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-project-diagram text-warm-orange text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-deep-teal mb-1">Event-Driven Data Flow</h4>
                                <p class="text-gray-600 text-sm">User action → Event → Analytics Service → Dashboards</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-success/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-brain text-success text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-deep-teal mb-1">AI-Ready Platform</h4>
                                <p class="text-gray-600 text-sm">Pattern detection, risk prediction, staffing optimization</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-info/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-database text-info text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-deep-teal mb-1">Analytics Warehouse</h4>
                                <p class="text-gray-600 text-sm">Centralized data store for reporting and business intelligence</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-vital-teal to-deep-teal rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Key Metrics Tracked</h3>
                    <div class="space-y-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold">Visit Completion Rate</span>
                                <span class="text-2xl font-bold text-warm-orange">94%</span>
                            </div>
                            <div class="w-full bg-white/20 rounded-full h-2">
                                <div class="bg-warm-orange h-2 rounded-full" style="width: 94%"></div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold">Caregiver Utilization</span>
                                <span class="text-2xl font-bold text-soft-amber">87%</span>
                            </div>
                            <div class="w-full bg-white/20 rounded-full h-2">
                                <div class="bg-soft-amber h-2 rounded-full" style="width: 87%"></div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold">Patient Retention</span>
                                <span class="text-2xl font-bold text-success">92%</span>
                            </div>
                            <div class="w-full bg-white/20 rounded-full h-2">
                                <div class="bg-success h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack -->
    <section id="services" class="py-20 bg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Technology Stack</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Enterprise-grade technologies powering reliable healthcare delivery
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Frontend -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="w-12 h-12 bg-vital-teal/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-desktop text-2xl text-vital-teal"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-4">Frontend</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>• JavaScript (ES6+)</li>
                        <li>• PHP (server-rendered)</li>
                        <li>• Tailwind CSS</li>
                        <li>• Lightweight frameworks</li>
                    </ul>
                </div>

                <!-- Backend -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="w-12 h-12 bg-warm-orange/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-server text-2xl text-warm-orange"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-4">Backend</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>• PHP (Laravel-style)</li>
                        <li>• RESTful APIs</li>
                        <li>• Service authentication</li>
                        <li>• Event bus integration</li>
                    </ul>
                </div>

                <!-- Data -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="w-12 h-12 bg-success/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-database text-2xl text-success"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-4">Data</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>• MySQL / PostgreSQL</li>
                        <li>• Redis (caching)</li>
                        <li>• Analytics warehouse</li>
                        <li>• Database per service</li>
                    </ul>
                </div>

                <!-- Infrastructure -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="w-12 h-12 bg-info/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-cloud text-2xl text-info"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-4">Infrastructure</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>• Docker containers</li>
                        <li>• Load balancing</li>
                        <li>• CI/CD pipelines</li>
                        <li>• Monitoring & logging</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Security & Compliance -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-4">Security & Compliance</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Healthcare-grade security protecting patient data and privacy
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-light-gray rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-vital-teal/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-3xl text-vital-teal"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Data Security</h3>
                    <p class="text-gray-700">HTTPS encryption, token-based authentication, service isolation</p>
                </div>

                <div class="bg-light-gray rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-warm-orange/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-shield text-3xl text-warm-orange"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Privacy Protection</h3>
                    <p class="text-gray-700">Data minimization, consent tracking, local data residency</p>
                </div>

                <div class="bg-light-gray rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-success/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clipboard-check text-3xl text-success"></i>
                    </div>
                    <h3 class="text-xl font-bold text-deep-teal mb-3">Compliance</h3>
                    <p class="text-gray-700">HIPAA compliance, audit trails, regulatory adherence</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Scalability Roadmap -->
    <section class="py-20 bg-gradient-to-br from-deep-teal via-vital-teal to-teal-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Scalability Roadmap</h2>
                <p class="text-xl text-teal-100 max-w-3xl mx-auto">
                    Strategic growth path from regional platform to continental infrastructure
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Phase 1 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="inline-block px-4 py-2 bg-warm-orange rounded-full text-sm font-bold mb-4">Phase 1</div>
                    <h3 class="text-2xl font-bold mb-4">Foundation</h3>
                    <ul class="space-y-3 text-teal-100">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-warm-orange mt-1"></i>
                            <span>Core platform launch</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-warm-orange mt-1"></i>
                            <span>All dashboards live</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-warm-orange mt-1"></i>
                            <span>Reporting system</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-warm-orange mt-1"></i>
                            <span>Kenya market focus</span>
                        </li>
                    </ul>
                </div>

                <!-- Phase 2 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="inline-block px-4 py-2 bg-soft-amber text-deep-teal rounded-full text-sm font-bold mb-4">Phase 2</div>
                    <h3 class="text-2xl font-bold mb-4">Expansion</h3>
                    <ul class="space-y-3 text-teal-100">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-soft-amber mt-1 text-xs"></i>
                            <span>Mobile applications</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-soft-amber mt-1 text-xs"></i>
                            <span>Remote monitoring</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-soft-amber mt-1 text-xs"></i>
                            <span>Partner API integrations</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-soft-amber mt-1 text-xs"></i>
                            <span>East Africa expansion</span>
                        </li>
                    </ul>
                </div>

                <!-- Phase 3 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="inline-block px-4 py-2 bg-teal-400 text-deep-teal rounded-full text-sm font-bold mb-4">Phase 3</div>
                    <h3 class="text-2xl font-bold mb-4">Intelligence</h3>
                    <ul class="space-y-3 text-teal-100">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-teal-400 mt-1 text-xs"></i>
                            <span>AI-assisted care</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-teal-400 mt-1 text-xs"></i>
                            <span>Predictive analytics</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-teal-400 mt-1 text-xs"></i>
                            <span>Pan-African reach</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-circle text-teal-400 mt-1 text-xs"></i>
                            <span>Platform partnerships</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-deep-teal mb-6">Ready to Transform Healthcare?</h2>
            <p class="text-xl text-gray-700 mb-8">
                Join us in building the future of digital healthcare infrastructure in Africa.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="px-10 py-4 bg-warm-orange text-white rounded-xl font-bold text-lg hover:bg-soft-amber hover:text-deep-teal transition shadow-xl">
                    Schedule a Demo
                </button>
                <button class="px-10 py-4 bg-transparent text-vital-teal border-2 border-vital-teal rounded-xl font-bold text-lg hover:bg-vital-teal hover:text-white transition">
                    Contact Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-deep-teal text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-vital-teal to-warm-orange rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-xl">V</span>
                        </div>
                        <div>
                            <div class="font-bold text-lg">Vitalnest</div>
                            <div class="text-xs text-teal-300">Healthcare Infrastructure</div>
                        </div>
                    </div>
                    <p class="text-teal-200 text-sm">
                        Building digital healthcare infrastructure that feels human, operates like a system, and grows like a platform.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Platform</h4>
                    <ul class="space-y-2 text-teal-200 text-sm">
                        <li><a href="#" class="hover:text-warm-orange transition">Microservices</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Dashboards</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Analytics</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">API Documentation</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Company</h4>
                    <ul class="space-y-2 text-teal-200 text-sm">
                        <li><a href="#" class="hover:text-warm-orange transition">About Us</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Careers</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Partners</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Legal</h4>
                    <ul class="space-y-2 text-teal-200 text-sm">
                        <li><a href="#" class="hover:text-warm-orange transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">HIPAA Compliance</a></li>
                        <li><a href="#" class="hover:text-warm-orange transition">Security</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-teal-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-teal-300 text-sm">
                        &copy; <?php echo date('Y'); ?> Vitalnest Homecare. All rights reserved. Digital Healthcare Infrastructure.
                    </p>
                    <div class="flex gap-6">
                        <a href="#" class="text-teal-300 hover:text-warm-orange transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-teal-300 hover:text-warm-orange transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-teal-300 hover:text-warm-orange transition">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-teal-300 hover:text-warm-orange transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe sections for animations
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(section);
        });
    </script>
</body>
</html>

