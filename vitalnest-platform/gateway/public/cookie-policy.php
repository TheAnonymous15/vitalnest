<?php
/**
 * Vitalnest Platform - Cookie Policy
 * Information about cookies and tracking technologies
 */

session_start();

$pageTitle = 'Cookie Policy - VitalNest Home Healthcare';
$pageDescription = 'Learn about how VitalNest uses cookies and similar technologies to improve your experience and protect your data.';

// Define base paths
define('BASE_PATH', __DIR__);
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('COMPONENTS_PATH', INCLUDES_PATH . '/components');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $pageDescription ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vital-black': '#1A1A1A',
                        'vital-dark': '#0D0D0D',
                        'vital-orange': '#F97316',
                        'vital-teal': '#0F766E',
                        'deep-teal': '#134E4A',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #0D0D0D 0%, #1A1A1A 50%, #0D0D0D 100%);
        }

        .policy-card {
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(15, 118, 110, 0.2);
        }

        .section-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.01));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .highlight-box {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(249, 115, 22, 0.05));
            border-left: 4px solid #F97316;
        }

        .teal-highlight {
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.15), rgba(15, 118, 110, 0.05));
            border-left: 4px solid #0F766E;
        }

        .cookie-type {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cookie-type:hover {
            border-color: rgba(15, 118, 110, 0.3);
        }
    </style>
</head>
<body class="min-h-screen text-white">
    <!-- Background Effects -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/4 left-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-vital-teal/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Header Navigation -->
    <nav class="relative z-50 bg-slate-950/80 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="index.php" class="flex items-center gap-3 group">
                    <img src="/resources/logo.png" alt="VitalNest" class="h-10 w-auto">
                    <span class="text-xl font-bold text-white group-hover:text-vital-teal transition-colors">VitalNest</span>
                </a>
                <a href="index.php" class="flex items-center gap-2 text-white/60 hover:text-vital-teal transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 max-w-4xl mx-auto px-6 py-16">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/20 rounded-full border border-purple-500/30 mb-6">
                <i class="fas fa-cookie-bite text-purple-400"></i>
                <span class="text-sm font-semibold text-purple-400">Cookies & Tracking</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Cookie Policy</span>
            </h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto">
                Understanding how we use cookies to enhance your experience while protecting your privacy.
            </p>
            <p class="text-white/40 text-sm mt-4">
                <i class="far fa-calendar-alt mr-2"></i>Last Updated: March 13, 2026
            </p>
        </div>

        <!-- Cookie Policy Content -->
        <div class="space-y-8">
            <!-- What Are Cookies -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-cookie text-purple-400"></i>
                    </span>
                    What Are Cookies?
                </h2>
                <p class="text-white/70 leading-relaxed mb-4">
                    Cookies are small text files that are stored on your device (computer, tablet, or mobile) when you visit our website or use our services. They help us remember your preferences, understand how you use our platform, and improve your overall experience.
                </p>
                <div class="teal-highlight p-4 rounded-lg">
                    <p class="text-white/80 text-sm">
                        <i class="fas fa-info-circle text-vital-teal mr-2"></i>
                        Cookies cannot access personal information on your device beyond what you provide to us. They are widely used across the internet to make websites work more efficiently.
                    </p>
                </div>
            </section>

            <!-- Types of Cookies We Use -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-layer-group text-vital-teal"></i>
                    </span>
                    Types of Cookies We Use
                </h2>

                <div class="space-y-4">
                    <!-- Essential Cookies -->
                    <div class="cookie-type rounded-xl p-6 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-green-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-white">Essential Cookies</h3>
                                    <span class="px-3 py-1 bg-green-500/20 text-green-400 text-xs font-semibold rounded-full">Required</span>
                                </div>
                                <p class="text-white/60 text-sm mb-3">
                                    These cookies are necessary for the website to function properly. They enable core functionality such as security, session management, and accessibility features.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Session ID</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Authentication</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Security Tokens</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Functional Cookies -->
                    <div class="cookie-type rounded-xl p-6 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-cog text-blue-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-white">Functional Cookies</h3>
                                    <span class="px-3 py-1 bg-blue-500/20 text-blue-400 text-xs font-semibold rounded-full">Optional</span>
                                </div>
                                <p class="text-white/60 text-sm mb-3">
                                    These cookies remember your preferences and choices to provide enhanced, personalized features. For example, remembering your language preference or login details.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Language Settings</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">User Preferences</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Remember Me</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Cookies -->
                    <div class="cookie-type rounded-xl p-6 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-vital-orange/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-bar text-vital-orange text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-white">Analytics Cookies</h3>
                                    <span class="px-3 py-1 bg-vital-orange/20 text-vital-orange text-xs font-semibold rounded-full">Optional</span>
                                </div>
                                <p class="text-white/60 text-sm mb-3">
                                    These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. This helps us improve our services.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Page Views</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Navigation Patterns</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Error Tracking</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Healthcare-Specific Cookies -->
                    <div class="cookie-type rounded-xl p-6 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-vital-teal/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-heartbeat text-vital-teal text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-white">Healthcare Session Cookies</h3>
                                    <span class="px-3 py-1 bg-vital-teal/20 text-vital-teal text-xs font-semibold rounded-full">Required</span>
                                </div>
                                <p class="text-white/60 text-sm mb-3">
                                    Special cookies used to maintain secure healthcare sessions. These ensure your medical information is protected and sessions timeout appropriately for security.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Patient Session</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Auto-Logout Timer</span>
                                    <span class="px-2 py-1 bg-white/5 text-white/50 text-xs rounded">Secure Forms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cookie Duration -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-vital-orange"></i>
                    </span>
                    Cookie Duration
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                        <div class="flex items-center gap-3 mb-3">
                            <i class="fas fa-hourglass-start text-vital-teal"></i>
                            <h3 class="font-semibold text-white">Session Cookies</h3>
                        </div>
                        <p class="text-white/60 text-sm">
                            Temporary cookies that are deleted when you close your browser. Used for maintaining your session while you navigate our platform.
                        </p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                        <div class="flex items-center gap-3 mb-3">
                            <i class="fas fa-calendar-alt text-vital-orange"></i>
                            <h3 class="font-semibold text-white">Persistent Cookies</h3>
                        </div>
                        <p class="text-white/60 text-sm">
                            Remain on your device for a set period (up to 12 months). Used for remembering your preferences across visits.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Third-Party Cookies -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-external-link-alt text-purple-400"></i>
                    </span>
                    Third-Party Cookies
                </h2>
                <p class="text-white/70 leading-relaxed mb-4">
                    We may use third-party services that set their own cookies. These include:
                </p>
                <ul class="space-y-3 text-white/70">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span><strong class="text-white">Payment Processors:</strong> M-Pesa and bank integration for secure payment processing</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span><strong class="text-white">Analytics Services:</strong> To help us understand website usage (anonymized data only)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span><strong class="text-white">Security Services:</strong> To protect against fraud and unauthorized access</span>
                    </li>
                </ul>
                <div class="highlight-box mt-6 p-4 rounded-lg">
                    <p class="text-white/80 text-sm">
                        <i class="fas fa-lock text-vital-orange mr-2"></i>
                        <strong>Note:</strong> We never allow third parties to access your protected health information through cookies.
                    </p>
                </div>
            </section>

            <!-- Managing Cookies -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-sliders-h text-vital-teal"></i>
                    </span>
                    Managing Your Cookie Preferences
                </h2>

                <p class="text-white/70 mb-6">
                    You have control over cookies. Here's how you can manage them:
                </p>

                <div class="space-y-4">
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-browser text-vital-teal mr-2"></i>Browser Settings
                        </h4>
                        <p class="text-white/60 text-sm">Most browsers allow you to refuse cookies or delete them. Check your browser's help section for instructions.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-toggle-on text-vital-teal mr-2"></i>Cookie Consent Banner
                        </h4>
                        <p class="text-white/60 text-sm">When you first visit our site, you can choose which optional cookies to accept through our consent banner.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-user-cog text-vital-teal mr-2"></i>Account Settings
                        </h4>
                        <p class="text-white/60 text-sm">Logged-in users can manage cookie preferences in their account settings dashboard.</p>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-white/5 rounded-lg border border-white/10">
                    <p class="text-white/60 text-sm">
                        <i class="fas fa-exclamation-triangle text-yellow-400 mr-2"></i>
                        <strong class="text-white">Warning:</strong> Disabling essential cookies may affect the functionality of our platform and prevent access to secure healthcare features.
                    </p>
                </div>
            </section>

            <!-- Do Not Track -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-gray-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-eye-slash text-gray-400"></i>
                    </span>
                    Do Not Track Signals
                </h2>
                <p class="text-white/70 leading-relaxed">
                    We honor Do Not Track (DNT) signals sent by your browser. When DNT is enabled, we limit data collection to only essential cookies required for platform functionality and security.
                </p>
            </section>

            <!-- Updates to Policy -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-sync-alt text-blue-400"></i>
                    </span>
                    Updates to This Policy
                </h2>
                <p class="text-white/70 leading-relaxed">
                    We may update this Cookie Policy from time to time to reflect changes in our practices or for legal reasons. We will notify you of significant changes by posting a notice on our website or sending you an email. We encourage you to review this policy periodically.
                </p>
            </section>

            <!-- Contact Information -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-question-circle text-vital-orange"></i>
                    </span>
                    Questions About Cookies?
                </h2>

                <p class="text-white/70 mb-6">
                    If you have any questions about our use of cookies, please contact us:
                </p>

                <div class="grid md:grid-cols-2 gap-4">
                    <a href="mailto:Vitalnesthomecare25@gmail.com" class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-vital-teal/50 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-vital-teal/20 rounded-lg flex items-center justify-center group-hover:bg-vital-teal/30 transition-colors">
                                <i class="fas fa-envelope text-vital-teal"></i>
                            </div>
                            <div>
                                <p class="text-white/40 text-xs">Email</p>
                                <p class="text-white font-medium">Vitalnesthomecare25@gmail.com</p>
                            </div>
                        </div>
                    </a>
                    <a href="tel:+254746511327" class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-vital-orange/50 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-vital-orange/20 rounded-lg flex items-center justify-center group-hover:bg-vital-orange/30 transition-colors">
                                <i class="fas fa-phone text-vital-orange"></i>
                            </div>
                            <div>
                                <p class="text-white/40 text-xs">Phone / WhatsApp</p>
                                <p class="text-white font-medium">+254 746 511 327</p>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-16">
            <a href="index.php" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full text-white font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all hover:-translate-y-1">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="relative z-10 border-t border-white/10 mt-16">
        <div class="max-w-4xl mx-auto px-6 py-8 text-center">
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-white/40">
                <span>&copy; <?= date('Y') ?> VitalNest</span>
                <span class="text-white/20">•</span>
                <a href="privacy-policy.php" class="hover:text-white/60 transition-colors">Privacy Policy</a>
                <span class="text-white/20">•</span>
                <a href="terms-of-service.php" class="hover:text-white/60 transition-colors">Terms of Service</a>
                <span class="text-white/20">•</span>
                <a href="cookie-policy.php" class="text-purple-400 hover:text-purple-400/80 transition-colors">Cookie Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>

