 <div id="available-packages-section" class="hidden relative py-8">
    <!-- Animated Orbs Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-vital-teal/15 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-vital-orange/15 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="relative z-10">
        <!-- Header with Unique Treatment -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8">
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

        <!-- Unique Package Selector - Tab Pills -->
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button onclick="filterPackages('basic')" class="package-filter-tab active px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-filter="basic">
                <i class="fas fa-leaf mr-2"></i>Basic
            </button>
            <button onclick="filterPackages('standard')" class="package-filter-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-filter="standard">
                <i class="fas fa-fire mr-2"></i>Standard
            </button>
            <button onclick="filterPackages('premium')" class="package-filter-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-filter="premium">
                <i class="fas fa-crown mr-2"></i>Premium
            </button>
            <button onclick="filterPackages('maternal')" class="package-filter-tab px-4 py-2 rounded-full text-sm font-bold transition-all duration-300" data-filter="maternal">
                <i class="fas fa-baby mr-2"></i>Maternal
            </button>
        </div>

        <!-- Loading State -->
        <div id="packages-loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
            <p class="text-white/60 mt-4">Loading packages...</p>
        </div>

        <!-- Package Display Area -->
        <div id="packages-display" class="relative"></div>

        <!-- Custom Package Banner -->
        <div class="mt-10 relative overflow-hidden rounded-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-vital-teal/30 via-transparent to-vital-orange/30"></div>
            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-4 p-6 bg-white/5 backdrop-blur-xl border border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-vital-teal to-vital-orange rounded-xl flex items-center justify-center">
                        <i class="fas fa-puzzle-piece text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold">Need something different?</h4>
                        <p class="text-white/50 text-sm">We can build a custom care plan just for you</p>
                    </div>
                </div>
                <button class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all duration-300">
                    <i class="fas fa-comments mr-2"></i>Let's Talk
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Learn More Modal -->
<div id="learn-more-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-slate-900/95 via-slate-800/95 to-slate-900/95 backdrop-blur-xl rounded-3xl border border-white/10 max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-slate-900/98 to-slate-800/98 backdrop-blur-xl border-b border-white/10 p-6 flex items-center justify-between z-10">
            <div>
                <h3 id="modal-package-name" class="text-2xl font-bold text-white mb-1"></h3>
                <p id="modal-package-price" class="text-white/60 text-sm"></p>
            </div>
            <button onclick="closeLearnMoreModal()" class="w-10 h-10 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-300 flex items-center justify-center group">
                <i class="fas fa-times text-white/60 group-hover:text-white"></i>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-6">
            <!-- Description -->
            <div>
                <h4 class="text-white font-bold mb-3 flex items-center gap-2">
                    <i class="fas fa-info-circle text-cyan-400"></i>
                    About This Plan
                </h4>
                <p id="modal-package-description" class="text-white/70 leading-relaxed"></p>
            </div>

            <!-- Features -->
            <div>
                <h4 class="text-white font-bold mb-3 flex items-center gap-2">
                    <i class="fas fa-check-circle text-cyan-400"></i>
                    What's Included
                </h4>
                <div id="modal-package-features" class="grid sm:grid-cols-2 gap-3"></div>
            </div>

            <!-- Pricing Details -->
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                <h4 class="text-white font-bold mb-3 flex items-center gap-2">
                    <i class="fas fa-dollar-sign text-cyan-400"></i>
                    Pricing Information
                </h4>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-white/60">Base Price:</span>
                        <span id="modal-base-price" class="text-white font-semibold"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/60">Billing Cycle:</span>
                        <span id="modal-billing-cycle" class="text-white font-semibold"></span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-3 pt-4">
                <button onclick="closeLearnMoreModal()" class="py-3 bg-white/5 hover:bg-white/10 text-white font-bold rounded-xl border border-white/20 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </button>
                <button id="modal-select-btn" class="py-3 bg-gradient-to-r from-cyan-500 to-teal-600 hover:opacity-90 text-white font-bold rounded-xl transition-all duration-300">
                    Select This Plan <i class="fas fa-check ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let availablePackages = [];
let currentFilter = 'basic';

async function loadAvailablePackages() {
    document.getElementById('packages-loading').classList.remove('hidden');

    try {
        const response = await fetch('' + window.location.origin + '/api/subscriptions/packages');
        const result = await response.json();

        document.getElementById('packages-loading').classList.add('hidden');

        if (result.success && result.data) {
            availablePackages = result.data;
            // Filter to show basic packages by default
            filterPackages('basic');
        }
    } catch (error) {
        console.error('Error loading packages:', error);
        document.getElementById('packages-loading').classList.add('hidden');
    }
}

function filterPackages(filter) {
    currentFilter = filter;

    // Update tab states
    document.querySelectorAll('.package-filter-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelector(`.package-filter-tab[data-filter="${filter}"]`).classList.add('active');

    // Filter and display packages by package name
    const filtered = availablePackages.filter(pkg => {
        return pkg.name.toLowerCase().includes(filter.toLowerCase());
    });
    displayPackages(filtered);
}

function displayPackages(packages) {
    const display = document.getElementById('packages-display');
    display.innerHTML = '';

    if (!packages || packages.length === 0) {
        display.innerHTML = `
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-box-open text-white/40 text-3xl"></i>
                </div>
                <h3 class="text-white text-xl font-bold mb-2">No packages available</h3>
                <p class="text-white/50 text-sm">Please check back later or contact us for custom plans.</p>
            </div>
        `;
        return;
    }

    packages.forEach((pkg, index) => {
        const badge = pkg.badge || '';
        const badgeColor = pkg.badge_color || 'teal';

        // Color schemes matching the packages.php design
        const colorSchemes = {
            'teal': {
                bg: 'from-vital-teal/20 to-teal-900/40',
                border: 'border-vital-teal/20',
                accent: 'text-vital-teal',
                badge: 'bg-vital-teal/30 text-vital-teal',
                button: 'bg-vital-teal hover:bg-teal-600',
                icon: 'bg-vital-teal/20',
                glow: 'bg-vital-teal/20'
            },
            'orange': {
                bg: 'from-vital-orange/20 to-orange-900/40',
                border: 'border-vital-orange/20',
                accent: 'text-vital-orange',
                badge: 'bg-vital-orange/30 text-vital-orange',
                button: 'bg-vital-orange hover:bg-orange-600',
                icon: 'bg-vital-orange/20',
                glow: 'bg-vital-orange/20'
            },
            'amber': {
                bg: 'from-amber-500/30 via-rose-500/20 to-purple-900/40',
                border: 'border-amber-500/30',
                accent: 'text-amber-400',
                badge: 'bg-gradient-to-r from-amber-500/40 to-rose-500/40 text-amber-300',
                button: 'bg-gradient-to-r from-amber-500 to-rose-500 hover:opacity-90',
                icon: 'bg-amber-500/20',
                glow: 'bg-amber-500/20'
            },
            'rose': {
                bg: 'from-rose-500/20 to-pink-900/40',
                border: 'border-rose-500/20',
                accent: 'text-rose-400',
                badge: 'bg-rose-500/30 text-rose-300',
                button: 'bg-rose-500 hover:bg-rose-600',
                icon: 'bg-rose-500/20',
                glow: 'bg-rose-500/20'
            }
        };

        const colors = colorSchemes[badgeColor] || colorSchemes['teal'];
        const priceK = (pkg.price / 1000).toFixed(0);
        const isPremium = pkg.name.includes('Premium');

        const packageCard = document.createElement('div');
        packageCard.className = 'mb-8 opacity-0 animate-fadeIn';
        packageCard.style.animationDelay = `${index * 0.1}s`;
        packageCard.innerHTML = `
            <div class="grid lg:grid-cols-5 gap-6 items-stretch">
                <!-- Left: Big Price Display (2 columns) -->
                <div class="lg:col-span-2 relative">
                    <div class="h-full bg-gradient-to-br ${colors.bg} backdrop-blur-xl rounded-3xl p-8 border ${colors.border} overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 ${colors.glow} rounded-full blur-2xl"></div>
                        ${isPremium ? '<div class="absolute top-4 right-4 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center"><i class="fas fa-crown text-amber-400"></i></div>' : ''}
                        <div class="relative">
                            <span class="inline-block px-3 py-1 ${colors.badge} text-xs font-bold rounded-full mb-4">${badge}</span>
                            <div class="mb-6">
                                <span class="text-white/40 text-lg">KES</span>
                                <span class="text-6xl md:text-7xl font-black text-white ml-1">${priceK}K</span>
                                <span class="text-white/40 text-lg">/${pkg.billing_cycle === 'trimester' ? 'trimester' : 'mo'}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">${pkg.name}</h3>
                            <p class="text-white/60 text-sm mb-6">${pkg.description}</p>
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="learnMore(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', '${pkg.description.replace(/'/g, "\\'")}', ${pkg.price}, '${pkg.billing_cycle}', ${JSON.stringify(pkg.features).replace(/'/g, "\\'")})" class="py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all duration-300">
                                    <i class="fas fa-info-circle mr-2"></i>Learn More
                                </button>
                                <button onclick="selectPackage(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', ${pkg.price})" class="py-3 ${colors.button} text-white font-bold rounded-xl transition-all duration-300">
                                    Select Plan <i class="fas fa-check ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Features in Creative Layout (3 columns) -->
                <div class="lg:col-span-3 grid sm:grid-cols-2 gap-3">
                    ${pkg.features.map(feature => `
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-4 hover:bg-white/10 transition-all group">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 ${colors.icon} rounded-lg flex items-center justify-center flex-shrink-0 group-hover:${colors.icon.replace('/20', '/30')} transition-all">
                                    <i class="fas fa-check ${colors.accent}"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold text-sm">${feature}</h4>
                                    <p class="text-white/40 text-xs mt-1">Included</p>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;

        display.appendChild(packageCard);
    });
}

function learnMore(packageId, packageName, description, price, billingCycle, features) {
    // Populate modal with package details
    document.getElementById('modal-package-name').textContent = packageName;
    document.getElementById('modal-package-description').textContent = description;

    // Format price
    const priceK = (price / 1000).toFixed(0);
    document.getElementById('modal-package-price').textContent = `KES ${priceK}K / ${billingCycle}`;
    document.getElementById('modal-base-price').textContent = `KES ${price.toLocaleString()}`;
    document.getElementById('modal-billing-cycle').textContent = billingCycle.charAt(0).toUpperCase() + billingCycle.slice(1);

    // Display features
    const featuresContainer = document.getElementById('modal-package-features');
    featuresContainer.innerHTML = '';

    if (Array.isArray(features)) {
        features.forEach(feature => {
            const featureDiv = document.createElement('div');
            featureDiv.className = 'flex items-start gap-2 p-3 bg-white/5 rounded-lg';
            featureDiv.innerHTML = `
                <i class="fas fa-check-circle text-cyan-400 mt-0.5"></i>
                <span class="text-white/80 text-sm">${feature}</span>
            `;
            featuresContainer.appendChild(featureDiv);
        });
    }

    // Set up select button
    const selectBtn = document.getElementById('modal-select-btn');
    selectBtn.onclick = () => {
        closeLearnMoreModal();
        selectPackage(packageId, packageName, price);
    };

    // Show modal
    document.getElementById('learn-more-modal').classList.remove('hidden');
    document.getElementById('learn-more-modal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLearnMoreModal() {
    document.getElementById('learn-more-modal').classList.add('hidden');
    document.getElementById('learn-more-modal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

async function selectPackage(packageId, packageName, price) {
    const userId = localStorage.getItem('user_id') || '1';

    // Check if user has active subscription
    if (currentSubscription && currentSubscription.status === 'active') {
        if (confirm(`You already have an active subscription. Do you want to switch to ${packageName}?`)) {
            // Redirect to upgrade/downgrade
            window.currentPackageToSelect = packageId;
            showSection('upgrade-downgrade-section');
        }
        return;
    }

    if (!confirm(`Subscribe to ${packageName} for KES ${(price/1000).toFixed(0)}K/${packageName.includes('Maternal') ? 'trimester' : 'month'}?`)) {
        return;
    }

    try {
        const response = await fetch('' + window.location.origin + '/api/subscriptions/subscribe', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                user_id: userId,
                package_id: packageId
            })
        });

        const result = await response.json();

        if (result.success) {
            alert(`Successfully subscribed to ${packageName}!`);
            showSection('current-plan-section');
            loadCurrentPlan();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error subscribing:', error);
        alert('Failed to subscribe. Please try again.');
    }
}

// Close modal on ESC key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeLearnMoreModal();
    }
});

// Close modal when clicking outside
document.getElementById('learn-more-modal')?.addEventListener('click', (e) => {
    if (e.target.id === 'learn-more-modal') {
        closeLearnMoreModal();
    }
});
</script>

<style>
    /* Package Filter Tab Styles */
    .package-filter-tab {
        background: rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.6);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .package-filter-tab:hover {
        background: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.9);
    }
    .package-filter-tab.active {
        background: linear-gradient(135deg, #0F766E, #0D9488);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.4);
    }
    .package-filter-tab[data-filter="standard"].active {
        background: linear-gradient(135deg, #F97316, #EA580C);
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
    }
    .package-filter-tab[data-filter="premium"].active {
        background: linear-gradient(135deg, #F59E0B, #EC4899);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }
    .package-filter-tab[data-filter="maternal"].active {
        background: linear-gradient(135deg, #F43F5E, #EC4899);
        box-shadow: 0 4px 15px rgba(244, 63, 94, 0.4);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out forwards;
    }

    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -30px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(30px, 10px) scale(1.05); }
    }
    .animate-blob { animation: blob 15s ease-in-out infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

