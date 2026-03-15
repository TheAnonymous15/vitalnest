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

        <!-- Package Display Area -->
        <div id="packages-display" class="relative">
            <!-- Loading state shows inline -->
            <div id="packages-loading" class="text-center py-12 hidden">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
                <p class="text-white/60 mt-4">Loading packages...</p>
            </div>
        </div>

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
                <button onclick="openCustomPlanModal()" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all duration-300">
                    <i class="fas fa-comments mr-2"></i>Let's Talk
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Plan Contact Modal - Center Popup -->
<div id="custom-plan-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeCustomPlanModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-slate-800 rounded-2xl border border-white/10 w-full max-w-md shadow-2xl transform scale-90 opacity-0 transition-all duration-200" id="custom-plan-sheet">
            <!-- Header -->
            <div class="px-5 py-4 border-b border-white/10 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white">Tell Us Your Needs</h3>
                    <p class="text-white/40 text-xs">We'll build a custom plan for you</p>
                </div>
                <button onclick="closeCustomPlanModal()" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20">
                    <i class="fas fa-times text-white/60 text-sm"></i>
                </button>
            </div>
            <!-- Content -->
            <div class="px-5 py-4 space-y-3 max-h-[60vh] overflow-y-auto">
                <div>
                    <label class="text-white/60 text-xs font-medium">Name *</label>
                    <input type="text" id="custom-plan-name" placeholder="Your full name" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                </div>
                <div>
                    <label class="text-white/60 text-xs font-medium">Phone *</label>
                    <div class="flex gap-2 mt-1">
                        <select id="custom-plan-country-code" class="px-2 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-xs">
                            <option value="+254">🇰🇪 +254</option>
                            <option value="+255">🇹🇿 +255</option>
                            <option value="+256">🇺🇬 +256</option>
                            <option value="+1">🇺🇸 +1</option>
                        </select>
                        <input type="tel" id="custom-plan-phone" placeholder="712345678" class="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                    </div>
                </div>
                <div>
                    <label class="text-white/60 text-xs font-medium">Email (Optional)</label>
                    <input type="email" id="custom-plan-email" placeholder="your@email.com" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                </div>
                <div>
                    <label class="text-white/60 text-xs font-medium">Message *</label>
                    <textarea id="custom-plan-message" rows="2" placeholder="Describe your needs..." class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50 resize-none"></textarea>
                </div>
            </div>
            <!-- Buttons -->
            <div class="px-5 py-4 border-t border-white/10 flex gap-2">
                <button onclick="sendDirectMessage()" class="flex-1 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-medium rounded-lg flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane text-xs"></i>Direct
                </button>
                <button onclick="sendViaWhatsApp()" class="flex-1 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-medium rounded-lg flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp"></i>WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Alert Modal - Center Popup -->
<div id="custom-alert-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeAlert()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-6">
        <div class="bg-slate-800 rounded-2xl border border-white/10 w-full max-w-[280px] shadow-2xl transform scale-90 opacity-0 transition-all duration-200" id="alert-sheet">
            <div class="p-5 text-center">
                <div id="alert-icon-container" class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3"></div>
                <h3 id="alert-title" class="text-white font-bold text-base mb-1"></h3>
                <p id="alert-message" class="text-white/50 text-xs leading-relaxed"></p>
            </div>
            <div id="alert-actions" class="px-4 pb-4"></div>
        </div>
    </div>
</div>

<!-- Confirm Modal - Center Popup -->
<div id="custom-confirm-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeConfirmModal(false)"></div>
    <div class="absolute inset-0 flex items-center justify-center p-6">
        <div class="bg-slate-800 rounded-2xl border border-white/10 w-full max-w-[280px] shadow-2xl transform scale-90 opacity-0 transition-all duration-200" id="confirm-sheet">
            <div class="p-5 text-center">
                <div class="w-12 h-12 bg-cyan-500/20 rounded-full flex items-center justify-center mx-auto mb-3 border border-cyan-500/30">
                    <i class="fas fa-question text-cyan-400 text-lg"></i>
                </div>
                <h3 id="confirm-title" class="text-white font-bold text-base mb-1"></h3>
                <p id="confirm-message" class="text-white/50 text-xs leading-relaxed"></p>
            </div>
            <div class="px-4 pb-4 flex gap-2">
                <button onclick="closeConfirmModal(false)" class="flex-1 py-2 bg-white/10 text-white text-sm font-medium rounded-xl border border-white/10">
                    Cancel
                </button>
                <button id="confirm-yes-btn" class="flex-1 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-medium rounded-xl">
                    Confirm
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
let confirmCallback = null;

// Custom Alert Modal Functions
function showAlert(title, message, type = 'info') {
    const modal = document.getElementById('custom-alert-modal');
    const sheet = document.getElementById('alert-sheet');
    const iconContainer = document.getElementById('alert-icon-container');
    const titleEl = document.getElementById('alert-title');
    const messageEl = document.getElementById('alert-message');
    const actionsEl = document.getElementById('alert-actions');

    titleEl.textContent = title;
    messageEl.textContent = message;

    let iconHTML = '';
    let iconBg = '';

    switch(type) {
        case 'success':
            iconBg = 'bg-green-500/20 border border-green-500/30';
            iconHTML = '<i class="fas fa-check text-green-400 text-lg"></i>';
            break;
        case 'error':
            iconBg = 'bg-red-500/20 border border-red-500/30';
            iconHTML = '<i class="fas fa-times text-red-400 text-lg"></i>';
            break;
        case 'warning':
            iconBg = 'bg-amber-500/20 border border-amber-500/30';
            iconHTML = '<i class="fas fa-exclamation text-amber-400 text-lg"></i>';
            break;
        default:
            iconBg = 'bg-cyan-500/20 border border-cyan-500/30';
            iconHTML = '<i class="fas fa-info text-cyan-400 text-lg"></i>';
    }

    iconContainer.className = `w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 ${iconBg}`;
    iconContainer.innerHTML = iconHTML;

    actionsEl.innerHTML = `
        <button onclick="closeAlert()" class="w-full py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-medium rounded-xl">
            OK
        </button>
    `;

    modal.classList.remove('hidden');
    setTimeout(() => {
        sheet.classList.remove('scale-90', 'opacity-0');
        sheet.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeAlert() {
    const modal = document.getElementById('custom-alert-modal');
    const sheet = document.getElementById('alert-sheet');

    sheet.classList.remove('scale-100', 'opacity-100');
    sheet.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 200);
}

// Custom Confirm Modal Functions
function showConfirm(title, message, callback) {
    const modal = document.getElementById('custom-confirm-modal');
    const sheet = document.getElementById('confirm-sheet');
    const titleEl = document.getElementById('confirm-title');
    const messageEl = document.getElementById('confirm-message');

    titleEl.textContent = title;
    messageEl.textContent = message;
    confirmCallback = callback;

    modal.classList.remove('hidden');
    setTimeout(() => {
        sheet.classList.remove('scale-90', 'opacity-0');
        sheet.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';

    document.getElementById('confirm-yes-btn').onclick = () => closeConfirmModal(true);
}

function closeConfirmModal(confirmed) {
    const modal = document.getElementById('custom-confirm-modal');
    const sheet = document.getElementById('confirm-sheet');

    sheet.classList.remove('scale-100', 'opacity-100');
    sheet.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        if (confirmCallback) {
            confirmCallback(confirmed);
            confirmCallback = null;
        }
    }, 200);
}

async function loadAvailablePackages() {
    // If packages already loaded, just display them
    if (availablePackages.length > 0) {
        filterPackages(currentFilter);
        return;
    }

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

// Preload packages on page load
(function() {
    // Wait for DOM to be ready, then preload packages
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadAvailablePackages);
    } else {
        // DOM already loaded
        loadAvailablePackages();
    }
})();

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

    // Create a comparison table layout
    packages.forEach((pkg, index) => {
        const badge = pkg.badge || '';
        const badgeColor = pkg.badge_color || 'teal';

        const colorSchemes = {
            'teal': { gradient: 'from-cyan-500/20 to-teal-600/20', accent: 'cyan-400', border: 'cyan-400/30', glow: 'from-cyan-500/10 to-teal-500/10' },
            'orange': { gradient: 'from-orange-500/20 to-amber-600/20', accent: 'orange-400', border: 'orange-400/30', glow: 'from-orange-500/10 to-amber-500/10' },
            'amber': { gradient: 'from-amber-500/20 to-rose-500/20', accent: 'amber-400', border: 'amber-500/30', glow: 'from-amber-500/10 to-rose-500/10' },
            'rose': { gradient: 'from-rose-500/20 to-pink-600/20', accent: 'rose-400', border: 'rose-500/30', glow: 'from-rose-500/10 to-pink-500/10' }
        };

        const colors = colorSchemes[badgeColor] || colorSchemes['teal'];
        const priceK = (pkg.price / 1000).toFixed(0);
        const isPremium = pkg.name.includes('Premium');

        const packageRow = document.createElement('div');
        packageRow.className = 'mb-6 opacity-0 animate-fadeIn';
        packageRow.style.animationDelay = `${index * 0.1}s`;
        packageRow.innerHTML = `
            <div class="relative group">
                <!-- Hover glow effect -->
                <div class="absolute -inset-0.5 bg-gradient-to-r ${colors.glow} rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-lg"></div>

                <div class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                    <!-- Header Row -->
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between p-5 border-b border-white/10 bg-gradient-to-r ${colors.gradient}">
                        <div class="flex items-start gap-4 mb-4 lg:mb-0">
                            <!-- Plan Icon -->
                            <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 border border-${colors.border}">
                                ${isPremium ? '<i class="fas fa-crown text-amber-400 text-2xl"></i>' :
                                  pkg.name.includes('Maternal') ? '<i class="fas fa-baby text-rose-400 text-2xl"></i>' :
                                  pkg.name.includes('Standard') ? '<i class="fas fa-fire text-orange-400 text-2xl"></i>' :
                                  '<i class="fas fa-heart-pulse text-cyan-400 text-2xl"></i>'}
                            </div>                            </div>

                            <!-- Plan Info -->
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-xl font-bold text-white">${pkg.name}</h3>
                                    ${badge ? `<span class="px-2 py-0.5 bg-${colors.accent}/20 text-${colors.accent} text-[10px] font-bold rounded-full border border-${colors.accent}/30">${badge}</span>` : ''}
                                </div>
                                <p class="text-white/50 text-sm">${pkg.description}</p>
                            </div>
                        </div>

                        <!-- Price & CTA -->
                        <div class="flex items-center gap-4 lg:flex-shrink-0">
                            <div class="text-right">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-white/40 text-sm">KES</span>
                                    <span class="text-3xl font-black text-white">${priceK}K</span>
                                    <span class="text-white/40 text-xs">/${pkg.billing_cycle === 'trimester' ? 'tri' : 'mo'}</span>
                                </div>
                            </div>
                            <button onclick="selectPackage(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', ${pkg.price})"
                                    class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-bold rounded-lg hover:opacity-90 transition-all whitespace-nowrap">
                                Select Plan
                            </button>
                        </div>
                    </div>

                    <!-- Features Grid -->
                    <div class="p-5">
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            ${pkg.features.slice(0, 6).map(feature => `
                                <div class="flex items-start gap-2 group/item">
                                    <div class="w-5 h-5 bg-${colors.accent}/20 rounded-md flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="fas fa-check text-${colors.accent} text-xs"></i>
                                    </div>
                                    <span class="text-white/70 text-sm leading-relaxed group-hover/item:text-white transition-colors">${feature}</span>
                                </div>
                            `).join('')}
                            ${pkg.features.length > 6 ? `
                                <button onclick="learnMore(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', '${pkg.description.replace(/'/g, "\\'")}', ${pkg.price}, '${pkg.billing_cycle}', ${JSON.stringify(pkg.features).replace(/'/g, "\\'")})"
                                        class="flex items-center gap-2 text-${colors.accent} text-sm font-medium hover:gap-3 transition-all">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>+${pkg.features.length - 6} more benefits</span>
                                </button>
                            ` : ''}
                        </div>

                        <!-- Learn More Link -->
                        <div class="mt-4 pt-4 border-t border-white/5">
                            <button onclick="learnMore(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', '${pkg.description.replace(/'/g, "\\'")}', ${pkg.price}, '${pkg.billing_cycle}', ${JSON.stringify(pkg.features).replace(/'/g, "\\'")})"
                                    class="text-${colors.accent} text-sm font-medium hover:underline">
                                View full details <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        display.appendChild(packageRow);
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
        showConfirm(
            'Switch Plan?',
            `You already have an active subscription. Do you want to switch to ${packageName}?`,
            (confirmed) => {
                if (confirmed) {
                    window.currentPackageToSelect = packageId;
                    showSection('upgrade-downgrade-section');
                }
            }
        );
        return;
    }

    const billingText = packageName.includes('Maternal') ? 'trimester' : 'month';
    showConfirm(
        'Subscribe to Plan?',
        `Subscribe to ${packageName} for KES ${(price/1000).toFixed(0)}K/${billingText}?`,
        async (confirmed) => {
            if (!confirmed) return;

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
                    showAlert('Success!', `Successfully subscribed to ${packageName}!`, 'success');
                    setTimeout(() => {
                        showSection('current-plan-section');
                        loadCurrentPlan();
                    }, 1500);
                } else {
                    showAlert('Error', result.message, 'error');
                }
            } catch (error) {
                console.error('Error subscribing:', error);
                showAlert('Connection Error', 'Failed to subscribe. Please try again.', 'error');
            }
        }
    );
}

// Close modal on ESC key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeLearnMoreModal();
        closeCustomPlanModal();
    }
});

// Close modal when clicking outside
document.getElementById('learn-more-modal')?.addEventListener('click', (e) => {
    if (e.target.id === 'learn-more-modal') {
        closeLearnMoreModal();
    }
});

document.getElementById('custom-plan-modal')?.addEventListener('click', (e) => {
    if (e.target.id === 'custom-plan-modal') {
        closeCustomPlanModal();
    }
});

function openCustomPlanModal() {
    const modal = document.getElementById('custom-plan-modal');
    const sheet = document.getElementById('custom-plan-sheet');

    modal.classList.remove('hidden');
    setTimeout(() => {
        sheet.classList.remove('scale-90', 'opacity-0');
        sheet.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeCustomPlanModal() {
    const modal = document.getElementById('custom-plan-modal');
    const sheet = document.getElementById('custom-plan-sheet');

    sheet.classList.remove('scale-100', 'opacity-100');
    sheet.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Clear form
        document.getElementById('custom-plan-name').value = '';
        document.getElementById('custom-plan-phone').value = '';
        document.getElementById('custom-plan-email').value = '';
        document.getElementById('custom-plan-message').value = '';
    }, 200);
}

function validateCustomPlanForm() {
    const name = document.getElementById('custom-plan-name').value.trim();
    const phone = document.getElementById('custom-plan-phone').value.trim();
    const message = document.getElementById('custom-plan-message').value.trim();

    if (!name) {
        showAlert('Name Required', 'Please enter your name', 'warning');
        return false;
    }

    if (!phone) {
        showAlert('Phone Required', 'Please enter your phone number', 'warning');
        return false;
    }

    if (!message) {
        showAlert('Message Required', 'Please tell us what you need', 'warning');
        return false;
    }

    return true;
}

function sendViaWhatsApp() {
    if (!validateCustomPlanForm()) return;

    const name = document.getElementById('custom-plan-name').value.trim();
    const countryCode = document.getElementById('custom-plan-country-code').value;
    const phone = document.getElementById('custom-plan-phone').value.trim();
    const email = document.getElementById('custom-plan-email').value.trim();
    const message = document.getElementById('custom-plan-message').value.trim();

    // Format WhatsApp message
    let whatsappMessage = `*Custom Care Plan Request*%0A%0A`;
    whatsappMessage += `*Name:* ${name}%0A`;
    whatsappMessage += `*Phone:* ${countryCode}${phone}%0A`;
    if (email) whatsappMessage += `*Email:* ${email}%0A`;
    whatsappMessage += `%0A*Requirements:*%0A${message}`;

    // VitalNest support WhatsApp number (replace with actual number)
    const supportNumber = '254712345678'; // Replace with actual support number

    // Open WhatsApp
    window.open(`https://wa.me/${supportNumber}?text=${whatsappMessage}`, '_blank');

    closeCustomPlanModal();
}

async function sendDirectMessage() {
    if (!validateCustomPlanForm()) return;

    const name = document.getElementById('custom-plan-name').value.trim();
    const countryCode = document.getElementById('custom-plan-country-code').value;
    const phone = document.getElementById('custom-plan-phone').value.trim();
    const email = document.getElementById('custom-plan-email').value.trim();
    const message = document.getElementById('custom-plan-message').value.trim();

    const fullPhone = countryCode + phone;

    try {
        const response = await fetch('' + window.location.origin + '/api/notifications/custom-plan', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                sender_name: name,
                sender_phone: fullPhone,
                sender_email: email || null,
                message: message
            })
        });

        const result = await response.json();

        if (result.success) {
            showAlert('Message Sent!', 'Your custom plan request has been sent successfully! Our team will contact you soon.', 'success');
            closeCustomPlanModal();
        } else {
            showAlert('Error', 'Error sending message: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Error sending custom plan request:', error);
        showAlert('Connection Error', 'Failed to send message. Please try again or use WhatsApp.', 'error');
    }
}

function initiateCall() {
    const name = document.getElementById('custom-plan-name').value.trim();

    if (!name) {
        showAlert('Name Required', 'Please enter your name first', 'warning');
        document.getElementById('custom-plan-name')?.focus();
        return;
    }

    // VitalNest support phone number
    const phoneNumber = '+254746511327';

    // Open phone dialer
    window.location.href = `tel:${phoneNumber}`;

    // Close modal after initiating call
    setTimeout(() => {
        closeCustomPlanModal();
    }, 500);
}
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
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.5);
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

