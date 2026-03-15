<?php
/**
 * Care Packages Section - Dynamic Data from API
 * Fetches package data from the packages service
 */

// Fetch packages from API
function getPackages() {
    $dbPath = __DIR__ . '/../../../../database/vitalnest_packages.db';

    if (!file_exists($dbPath)) {
        return [];
    }

    try {
        $db = new PDO("sqlite:{$dbPath}");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get all active packages
        $stmt = $db->query("SELECT * FROM packages WHERE is_active = 1 ORDER BY sort_order ASC");
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get features for each package
        foreach ($packages as &$package) {
            $featStmt = $db->prepare("SELECT * FROM package_features WHERE package_id = ? ORDER BY sort_order ASC");
            $featStmt->execute([$package['id']]);
            $package['features'] = $featStmt->fetchAll(PDO::FETCH_ASSOC);

            // Format price
            $package['price_formatted'] = $package['price'] >= 1000
                ? number_format($package['price'] / 1000) . 'K'
                : number_format($package['price']);

            // Format duration
            $package['duration_text'] = $package['duration_value'] == 1
                ? "/{$package['duration_unit']}"
                : "/{$package['duration_value']} {$package['duration_unit']}s";
        }

        return $packages;
    } catch (PDOException $e) {
        error_log("Error fetching packages: " . $e->getMessage());
        return [];
    }
}

$packages = getPackages();

// Color mappings for Tailwind classes
$colorMap = [
    'teal' => [
        'bg' => 'bg-vital-teal',
        'bg_light' => 'bg-vital-teal/20',
        'bg_gradient' => 'from-vital-teal/20 to-teal-900/40',
        'border' => 'border-vital-teal/20',
        'text' => 'text-vital-teal',
        'hover' => 'hover:bg-teal-600',
    ],
    'orange' => [
        'bg' => 'bg-vital-orange',
        'bg_light' => 'bg-vital-orange/20',
        'bg_gradient' => 'from-vital-orange/20 to-orange-900/40',
        'border' => 'border-vital-orange/20',
        'text' => 'text-vital-orange',
        'hover' => 'hover:bg-orange-600',
    ],
    'rose' => [
        'bg' => 'bg-rose-500',
        'bg_light' => 'bg-rose-500/20',
        'bg_gradient' => 'from-rose-500/20 to-rose-900/40',
        'border' => 'border-rose-500/20',
        'text' => 'text-rose-400',
        'hover' => 'hover:bg-rose-600',
    ],
    'pink' => [
        'bg' => 'bg-pink-500',
        'bg_light' => 'bg-pink-500/20',
        'bg_gradient' => 'from-pink-500/20 to-rose-900/40',
        'border' => 'border-pink-500/20',
        'text' => 'text-pink-400',
        'hover' => 'hover:bg-pink-600',
    ],
];

function getColors($color) {
    global $colorMap;
    return $colorMap[$color] ?? $colorMap['teal'];
}
?>

<!-- Care Packages Section - Dynamic -->
<section id="packages" class="relative py-16 overflow-hidden">
    <!-- Animated Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>

    <!-- Animated Orbs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-vital-teal/15 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-vital-orange/15 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-vital-orange/20 rounded-full mb-4">
                    <span class="w-1.5 h-1.5 bg-vital-orange rounded-full animate-pulse"></span>
                    <span class="text-vital-orange text-[10px] font-bold uppercase tracking-wider">Care Plans</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-white leading-tight">
                    Your Care,<br>
                    <span class="bg-gradient-to-r from-vital-orange via-amber-400 to-vital-teal bg-clip-text text-transparent">Your Choice</span>
                </h2>
            </div>
            <p class="text-white/50 text-sm max-w-sm lg:text-right">
                From essential check-ups to comprehensive daily care — find the perfect fit for your family.
            </p>
        </div>

        <?php if (empty($packages)): ?>
        <!-- No packages fallback -->
        <div class="text-center py-12">
            <p class="text-white/50">No packages available at the moment.</p>
        </div>
        <?php else: ?>

        <!-- Package Selector Tabs -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <?php foreach ($packages as $index => $pkg):
                $colors = getColors($pkg['color']);
                $isFirst = $index === 0;
            ?>
            <button
                onclick="showPackage('<?= $pkg['slug'] ?>')"
                class="package-tab <?= $isFirst ? 'active' : '' ?> px-4 py-2 rounded-full text-sm font-bold transition-all duration-300"
                data-tab="<?= $pkg['slug'] ?>"
                data-color="<?= $pkg['color'] ?>"
            >
                <i class="fas <?= $pkg['icon'] ?> mr-2"></i><?= htmlspecialchars($pkg['name']) ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Package Display Area -->
        <div class="relative">
            <?php foreach ($packages as $index => $pkg):
                $colors = getColors($pkg['color']);
                $isFirst = $index === 0;
            ?>
            <!-- <?= $pkg['name'] ?> Package -->
            <div id="pkg-<?= $pkg['slug'] ?>" class="package-content <?= $isFirst ? 'active' : 'hidden' ?>">
                <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                    <!-- Left: Price Display -->
                    <div class="lg:col-span-2 relative">
                        <div class="h-full bg-gradient-to-br <?= $colors['bg_gradient'] ?> backdrop-blur-xl rounded-3xl p-8 <?= $colors['border'] ?> border overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 <?= $colors['bg_light'] ?> rounded-full blur-2xl"></div>
                            <div class="relative">
                                <?php if ($pkg['badge']): ?>
                                <span class="inline-block px-3 py-1 <?= $colors['bg_light'] ?> <?= $colors['text'] ?> text-xs font-bold rounded-full mb-4">
                                    <?= htmlspecialchars($pkg['badge']) ?>
                                </span>
                                <?php endif; ?>

                                <div class="mb-6">
                                    <span class="text-white/40 text-lg"><?= $pkg['currency'] ?></span>
                                    <span class="text-6xl md:text-7xl font-black text-white ml-1"><?= $pkg['price_formatted'] ?></span>
                                    <span class="text-white/40 text-lg"><?= $pkg['duration_text'] ?></span>
                                </div>

                                <h3 class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars($pkg['name']) ?></h3>
                                <p class="text-white/60 text-sm mb-6"><?= htmlspecialchars($pkg['description']) ?></p>

                                <a href="<?= htmlspecialchars($pkg['cta_link']) ?>" class="block w-full py-3 <?= $colors['bg'] ?> text-white font-bold rounded-xl <?= $colors['hover'] ?> transition-all duration-300 text-center">
                                    <?= htmlspecialchars($pkg['cta_text']) ?> <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Features -->
                    <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                        <?php foreach ($pkg['features'] as $feature): ?>
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 <?= $colors['bg_light'] ?> rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <i class="fas <?= htmlspecialchars($feature['icon']) ?> <?= $colors['text'] ?>"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm"><?= htmlspecialchars($feature['title']) ?></h4>
                                    <?php if ($feature['description']): ?>
                                    <p class="text-white/40 text-xs mt-1"><?= htmlspecialchars($feature['description']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>

        <!-- Custom Plan CTA -->
        <div class="mt-10 bg-gradient-to-r from-slate-800/80 to-slate-900/80 backdrop-blur-xl rounded-2xl p-6 border border-white/5">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-vital-orange/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-puzzle-piece text-vital-orange text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold">Need something different?</h4>
                        <p class="text-white/50 text-sm">We can build a custom care plan just for you</p>
                    </div>
                </div>
                <a href="#contact" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all flex items-center gap-2">
                    <i class="fas fa-comments"></i> Let's Talk
                </a>
            </div>
        </div>

    </div>
</section>

<style>
    .package-tab {
        background: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.6);
        border: 1px solid transparent;
    }

    .package-tab:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .package-tab.active {
        background: linear-gradient(135deg, var(--tab-color, #0F766E), var(--tab-color-dark, #134E4A));
        color: white;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .package-tab[data-color="teal"].active {
        --tab-color: #0F766E;
        --tab-color-dark: #134E4A;
    }

    .package-tab[data-color="orange"].active {
        --tab-color: #F97316;
        --tab-color-dark: #EA580C;
    }

    .package-tab[data-color="rose"].active {
        --tab-color: #F43F5E;
        --tab-color-dark: #E11D48;
    }

    .package-tab[data-color="pink"].active {
        --tab-color: #EC4899;
        --tab-color-dark: #DB2777;
    }

    .package-content {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -20px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

<script>
function showPackage(slug) {
    // Hide all packages
    document.querySelectorAll('.package-content').forEach(el => {
        el.classList.add('hidden');
        el.classList.remove('active');
    });

    // Remove active from all tabs
    document.querySelectorAll('.package-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Show selected package
    const packageEl = document.getElementById('pkg-' + slug);
    if (packageEl) {
        packageEl.classList.remove('hidden');
        packageEl.classList.add('active');
    }

    // Activate tab
    const tabEl = document.querySelector(`.package-tab[data-tab="${slug}"]`);
    if (tabEl) {
        tabEl.classList.add('active');
    }
}
</script>

