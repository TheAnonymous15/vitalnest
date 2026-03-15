<?php
/**
 * Vitalnest Platform - Terms of Service
 * Legal terms governing use of VitalNest services
 */

session_start();

$pageTitle = 'Terms of Service - VitalNest Home Healthcare';
$pageDescription = 'Terms and conditions for using VitalNest home healthcare services. Understand your rights and responsibilities.';

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

        .warning-box {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border-left: 4px solid #EF4444;
        }
    </style>
</head>
<body class="min-h-screen text-white">
    <!-- Background Effects -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-vital-orange/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-vital-teal/5 rounded-full blur-3xl"></div>
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
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-vital-orange/20 rounded-full border border-vital-orange/30 mb-6">
                <i class="fas fa-file-contract text-vital-orange"></i>
                <span class="text-sm font-semibold text-vital-orange">Legal Agreement</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-vital-orange to-amber-400">Terms of Service</span>
            </h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto">
                Please read these terms carefully before using our home healthcare services.
            </p>
            <p class="text-white/40 text-sm mt-4">
                <i class="far fa-calendar-alt mr-2"></i>Effective Date: March 13, 2026
            </p>
        </div>

        <!-- Terms Content -->
        <div class="space-y-8">
            <!-- Agreement -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-handshake text-vital-teal"></i>
                    </span>
                    Agreement to Terms
                </h2>
                <p class="text-white/70 leading-relaxed mb-4">
                    By accessing or using VitalNest Home Healthcare services ("Services"), you agree to be bound by these Terms of Service ("Terms"). These Terms apply to all users, including patients, caregivers, and visitors.
                </p>
                <div class="highlight-box p-4 rounded-lg">
                    <p class="text-white/80 text-sm">
                        <i class="fas fa-info-circle text-vital-orange mr-2"></i>
                        <strong>Please Note:</strong> These terms constitute a legally binding agreement between you and VitalNest. If you do not agree to all terms, you must not use our services.
                    </p>
                </div>
            </section>

            <!-- Services Description -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-stethoscope text-vital-orange"></i>
                    </span>
                    Our Services
                </h2>

                <p class="text-white/70 mb-6">
                    VitalNest provides professional home healthcare services including but not limited to:
                </p>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <ul class="space-y-2 text-white/70 text-sm">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Initial comprehensive assessment</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Medication management</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Wound care and dressings</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Nutritional counselling</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Physiotherapy services</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Nasogastric feeding</li>
                        </ul>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <ul class="space-y-2 text-white/70 text-sm">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Electrocardiogram (ECG)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Laboratory services and imaging</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Maternal care (antenatal, prenatal, postnatal)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Daily living assistance</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>Coordination with specialists</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-vital-teal"></i>24/7 on-call support</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Eligibility -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-purple-400"></i>
                    </span>
                    Eligibility
                </h2>
                <p class="text-white/70 leading-relaxed mb-4">
                    To use our services, you must:
                </p>
                <ul class="space-y-3 text-white/70">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span>Be at least 18 years of age, or have a legal guardian consent on your behalf</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span>Provide accurate and complete personal and health information</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span>Be located within our service area in Kenya</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-vital-teal mt-1"></i>
                        <span>Have a suitable home environment for receiving healthcare services</span>
                    </li>
                </ul>
            </section>

            <!-- Subscription Packages -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box-open text-vital-teal"></i>
                    </span>
                    Subscription Packages & Pricing
                </h2>

                <div class="space-y-4">
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">Basic Package - KES 25,000/month</h4>
                        <p class="text-white/60 text-sm">Weekly visits from clinician, nurse, physiotherapist, and nutritionist. Includes basic tests (Full Hemogram, B/S for Mps).</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">Standard Package - KES 50,000/month</h4>
                        <p class="text-white/60 text-sm">Weekly plus on-call visits. Additional tests (UECs, LFTs, X-rays). Suitable for patients requiring regular dressings and NGT feeding.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">Premium Package - KES 200,000/month</h4>
                        <p class="text-white/60 text-sm">Daily management for chronically ill and elderly. Daily nursing, on-call clinical management, weekly physio and nutritional reviews. Weekly UECs/LFTs, twice-weekly FHG and BS.</p>
                    </div>
                    <div class="teal-highlight p-4 rounded-lg">
                        <h4 class="font-semibold text-white mb-1">Maternal Package - KES 50,000/3 months</h4>
                        <p class="text-white/60 text-sm">Ultrasound per trimester, weekly and on-call visits by midwife, clinician, and nutritionist. First trimester antenatal profile included.</p>
                    </div>
                </div>

                <p class="text-white/50 text-sm mt-4">
                    <i class="fas fa-info-circle mr-1"></i>
                    Prices are subject to change. Additional services may incur extra charges.
                </p>
            </section>

            <!-- Payment Terms -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-credit-card text-green-400"></i>
                    </span>
                    Payment Terms
                </h2>

                <div class="space-y-4 text-white/70">
                    <p><strong class="text-white">Payment Methods:</strong> We accept M-Pesa, Paybill, and bank transfers. Card payments coming soon.</p>
                    <p><strong class="text-white">Payment Schedule:</strong> Subscription fees are due at the beginning of each billing period.</p>
                    <p><strong class="text-white">Late Payments:</strong> Services may be suspended if payment is not received within 7 days of the due date.</p>
                    <p><strong class="text-white">Refunds:</strong> Refunds are processed on a case-by-case basis. Unused portions of subscriptions may be refundable minus a 10% administrative fee.</p>
                </div>
            </section>

            <!-- User Responsibilities -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-cog text-vital-orange"></i>
                    </span>
                    Your Responsibilities
                </h2>

                <ul class="space-y-3 text-white/70">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Provide accurate health information and medical history</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Inform us of any changes to your health condition or medications</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Provide a safe environment for our healthcare providers</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Be available for scheduled appointments or provide 24-hour notice for cancellations</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Follow treatment plans and medical advice provided</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-arrow-right text-vital-teal mt-1"></i>
                        <span>Treat our staff with respect and dignity</span>
                    </li>
                </ul>
            </section>

            <!-- Limitation of Liability -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </span>
                    Limitation of Liability
                </h2>

                <div class="warning-box p-4 rounded-lg mb-4">
                    <p class="text-white/80 text-sm">
                        <i class="fas fa-exclamation-circle text-red-400 mr-2"></i>
                        <strong>Emergency Services:</strong> VitalNest is NOT an emergency service provider. In case of medical emergencies, please call emergency services immediately (999 or visit the nearest hospital).
                    </p>
                </div>

                <p class="text-white/70 leading-relaxed">
                    While we strive to provide the highest quality care, VitalNest shall not be liable for any indirect, incidental, special, or consequential damages arising from the use of our services. Our liability is limited to the fees paid for services during the period in which the issue arose.
                </p>
            </section>

            <!-- Termination -->
            <section class="section-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-gray-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-ban text-gray-400"></i>
                    </span>
                    Termination
                </h2>
                <p class="text-white/70 leading-relaxed mb-4">
                    Either party may terminate services with 30 days written notice. VitalNest reserves the right to terminate services immediately if:
                </p>
                <ul class="space-y-2 text-white/70">
                    <li class="flex items-center gap-2"><i class="fas fa-times-circle text-red-400"></i>Payment obligations are not met</li>
                    <li class="flex items-center gap-2"><i class="fas fa-times-circle text-red-400"></i>False information is provided</li>
                    <li class="flex items-center gap-2"><i class="fas fa-times-circle text-red-400"></i>Our staff's safety is compromised</li>
                    <li class="flex items-center gap-2"><i class="fas fa-times-circle text-red-400"></i>There is a breach of these Terms</li>
                </ul>
            </section>

            <!-- Governing Law -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-teal/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-gavel text-vital-teal"></i>
                    </span>
                    Governing Law
                </h2>
                <p class="text-white/70 leading-relaxed">
                    These Terms shall be governed by and construed in accordance with the laws of the Republic of Kenya. Any disputes arising from these Terms or our services shall be resolved through arbitration in Nairobi, Kenya, in accordance with the Arbitration Act of Kenya.
                </p>
            </section>

            <!-- Contact Information -->
            <section class="policy-card rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-envelope text-vital-orange"></i>
                    </span>
                    Questions About These Terms?
                </h2>

                <p class="text-white/70 mb-6">
                    If you have any questions about these Terms of Service, please contact us:
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
            <a href="index.php" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-vital-orange to-amber-500 rounded-full text-white font-semibold hover:shadow-lg hover:shadow-vital-orange/30 transition-all hover:-translate-y-1">
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
                <a href="terms-of-service.php" class="text-vital-orange hover:text-vital-orange/80 transition-colors">Terms of Service</a>
                <span class="text-white/20">•</span>
                <a href="cookie-policy.php" class="hover:text-white/60 transition-colors">Cookie Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>

