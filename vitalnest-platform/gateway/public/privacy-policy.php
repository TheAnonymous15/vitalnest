<?php
/**
 * Vitalnest Platform - Privacy Policy
 * Compliant with medical data protection laws and HIPAA standards
 */

session_start();

$pageTitle = 'Privacy Policy - VitalNest Home Healthcare';
$pageDescription = 'Learn how VitalNest protects your personal and medical information. Our commitment to data privacy and security.';

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
    </style>
</head>
<body class="min-h-screen text-white">
    <!-- Background Effects -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-vital-teal/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-vital-orange/5 rounded-full blur-3xl"></div>
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
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-vital-teal/20 rounded-full border border-vital-teal/30 mb-6">
                <i class="fas fa-shield-halved text-vital-teal"></i>
                <span class="text-sm font-semibold text-vital-teal">Data Protection</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-vital-teal to-teal-400">Privacy Policy</span>
            </h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto">
                Your privacy is paramount. Learn how we collect, use, and protect your personal and medical information.
            </p>
            <p class="text-white/40 text-sm mt-4">
                <i class="far fa-calendar-alt mr-2"></i>Last Updated: March 13, 2026
            </p>
        </div>

        <!-- Policy Content -->
        <div class="space-y-8">
            <!-- Introduction -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-hand-holding-medical text-vital-teal"></i>
                    </span>
                    Introduction
                </h2>
                <p class="text-white/70 leading-relaxed">
                    VitalNest Home Healthcare ("we," "our," or "us") is committed to protecting your privacy and ensuring the security of your personal and health information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our home healthcare services, website, and mobile applications.
                </p>
                <div class="highlight-box mt-6 p-4 rounded-lg">
                    <p class="text-white/80 text-sm">
                        <i class="fas fa-exclamation-circle text-vital-orange mr-2"></i>
                        <strong>Important:</strong> By using our services, you consent to the data practices described in this policy. If you do not agree with our policies, please do not use our services.
                    </p>
                </div>
            </section>

            <!-- Information We Collect -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-database text-vital-orange"></i>
                    </span>
                    Information We Collect
                </h2>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-vital-teal mb-3">Personal Information</h3>
                        <ul class="space-y-2 text-white/70">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Full name, date of birth, and contact information (phone, email, address)</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Emergency contact details and next of kin information</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>National ID or passport number for identity verification</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Insurance information and payment details</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-vital-teal mb-3">Protected Health Information (PHI)</h3>
                        <ul class="space-y-2 text-white/70">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Medical history, diagnoses, and current health conditions</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Current medications and treatment plans</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Laboratory results, imaging reports, and diagnostic data</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Clinical notes and care assessments from our healthcare providers</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                                <span>Imagery and video data provided by clients for medical assessment</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- How We Use Your Information -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-cogs text-purple-400"></i>
                    </span>
                    How We Use Your Information
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <h4 class="font-semibold text-white mb-2">
                            <i class="fas fa-heartbeat text-vital-teal mr-2"></i>Healthcare Delivery
                        </h4>
                        <p class="text-white/60 text-sm">Providing personalized home healthcare services, treatments, and care coordination.</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <h4 class="font-semibold text-white mb-2">
                            <i class="fas fa-calendar-check text-vital-orange mr-2"></i>Appointment Management
                        </h4>
                        <p class="text-white/60 text-sm">Scheduling visits, sending reminders, and managing your care calendar.</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <h4 class="font-semibold text-white mb-2">
                            <i class="fas fa-file-invoice-dollar text-green-400 mr-2"></i>Billing & Insurance
                        </h4>
                        <p class="text-white/60 text-sm">Processing payments, insurance claims, and financial transactions.</p>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <h4 class="font-semibold text-white mb-2">
                            <i class="fas fa-chart-line text-blue-400 mr-2"></i>Quality Improvement
                        </h4>
                        <p class="text-white/60 text-sm">Analyzing care outcomes to continuously improve our services.</p>
                    </div>
                </div>
            </section>

            <!-- Data Protection Measures -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-lock text-vital-teal"></i>
                    </span>
                    Data Protection & Security
                </h2>

                <p class="text-white/70 mb-6">
                    We implement robust security measures to protect your sensitive health information:
                </p>

                <div class="grid gap-4">
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-shield-alt text-vital-teal mr-2"></i>End-to-End Encryption
                        </h4>
                        <p class="text-white/60 text-sm">All data transmissions are encrypted using AES-256 encryption standards.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-user-lock text-vital-teal mr-2"></i>Access Controls
                        </h4>
                        <p class="text-white/60 text-sm">Role-based access ensures only authorized personnel can view your information.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-server text-vital-teal mr-2"></i>Secure Storage
                        </h4>
                        <p class="text-white/60 text-sm">Data is stored in secure, compliant data centers with regular security audits.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">
                            <i class="fas fa-user-shield text-vital-teal mr-2"></i>Staff Training
                        </h4>
                        <p class="text-white/60 text-sm">All staff undergo regular privacy and security training programs.</p>
                    </div>
                </div>
            </section>

            <!-- Your Rights -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-vital-orange"></i>
                    </span>
                    Your Rights
                </h2>

                <p class="text-white/70 mb-6">
                    Under applicable data protection laws, you have the following rights:
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-eye text-vital-teal text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Right to Access</h4>
                            <p class="text-white/60 text-sm">Request copies of your personal and health data we hold.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-edit text-vital-teal text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Right to Rectification</h4>
                            <p class="text-white/60 text-sm">Request correction of inaccurate or incomplete information.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-trash-alt text-vital-teal text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Right to Erasure</h4>
                            <p class="text-white/60 text-sm">Request deletion of your data (subject to legal retention requirements).</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-hand-paper text-vital-teal text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Right to Restrict Processing</h4>
                            <p class="text-white/60 text-sm">Limit how we use your data in certain circumstances.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 bg-vital-teal/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-download text-vital-teal text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Right to Data Portability</h4>
                            <p class="text-white/60 text-sm">Receive your data in a portable, machine-readable format.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Data Retention -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-blue-400"></i>
                    </span>
                    Data Retention
                </h2>
                <p class="text-white/70 leading-relaxed">
                    We retain your personal and health information for as long as necessary to provide our services and comply with legal obligations. Medical records are retained in accordance with Kenya's health regulations and international standards, typically for a minimum of 10 years after your last interaction with our services.
                </p>
            </section>

            <!-- Contact Information -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-envelope text-vital-orange"></i>
                    </span>
                    Contact Us
                </h2>

                <p class="text-white/70 mb-6">
                    For privacy-related inquiries or to exercise your rights, please contact our Data Protection Officer:
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
            <a href="index.php" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-vital-teal to-teal-600 rounded-full text-white font-semibold hover:shadow-lg hover:shadow-vital-teal/30 transition-all hover:-translate-y-1">
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
                <a href="privacy-policy.php" class="text-vital-teal hover:text-vital-teal/80 transition-colors">Privacy Policy</a>
                <span class="text-white/20">•</span>
                <a href="terms-of-service.php" class="hover:text-white/60 transition-colors">Terms of Service</a>
                <span class="text-white/20">•</span>
                <a href="cookie-policy.php" class="hover:text-white/60 transition-colors">Cookie Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>

