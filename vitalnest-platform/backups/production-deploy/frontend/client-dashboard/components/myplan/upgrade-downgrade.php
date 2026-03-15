<div id="upgrade-downgrade-section" class="hidden relative py-8">
    <div class="space-y-6 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Change Your Plan</h2>
                <p class="text-white/40 text-sm mt-1">Upgrade or downgrade your subscription</p>
            </div>
            <button onclick="showSection('current-plan-section')" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white/70 hover:text-white text-sm rounded-lg transition-all border border-white/10">
                <i class="fas fa-arrow-left mr-2 text-xs"></i>Back
            </button>
        </div>

        <!-- Current Plan Card - Compact -->
        <div id="current-plan-info" class="bg-slate-800/30 backdrop-blur-xl rounded-xl border border-white/10 p-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center border border-cyan-400/30">
                        <i class="fas fa-shield-check text-cyan-400"></i>
                    </div>
                    <div>
                        <div class="text-white/40 text-xs">Your Current Plan</div>
                        <div class="text-white font-bold" id="current-plan-name-change">-</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-white/40 text-xs">Current Price</div>
                    <div class="text-white font-bold">KES <span id="current-plan-price-change">0</span>K/mo</div>
                </div>
            </div>
        </div>

        <!-- Available Plans Grid - Horizontal Timeline Style -->
        <div>
            <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-sync-alt text-cyan-400 text-sm"></i>
                Available Plans
            </h3>
            <div id="change-plans-grid" class="space-y-3"></div>
        </div>

        <!-- Comparison Section - Slide Down -->
        <div id="comparison-section" class="hidden">
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-xl border border-white/10 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-cyan-500/10 to-teal-500/10 border-b border-white/10 p-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <i class="fas fa-exchange-alt text-cyan-400 text-sm"></i>
                        Plan Comparison
                    </h3>
                </div>

                <!-- Comparison Grid -->
                <div class="p-5">
                    <div class="grid md:grid-cols-3 gap-4 items-center">
                        <!-- Current Plan -->
                        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                            <div class="text-center mb-3">
                                <div class="text-white/40 text-xs mb-1">Current</div>
                                <div class="text-white font-bold text-lg" id="compare-current-name">-</div>
                                <div class="text-cyan-400 text-xl font-bold mt-2">KES <span id="compare-current-price">0</span>K</div>
                            </div>
                            <div class="space-y-1.5" id="compare-current-features"></div>
                        </div>

                        <!-- Arrow -->
                        <div class="flex items-center justify-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500/20 to-teal-500/20 rounded-full flex items-center justify-center border border-cyan-400/30">
                                <i class="fas fa-arrow-right text-cyan-400"></i>
                            </div>
                        </div>

                        <!-- New Plan -->
                        <div class="bg-gradient-to-br from-cyan-500/10 to-teal-500/10 rounded-xl p-4 border border-cyan-400/30">
                            <div class="text-center mb-3">
                                <div class="text-cyan-400 text-xs mb-1 font-semibold">New Plan</div>
                                <div class="text-white font-bold text-lg" id="compare-new-name">-</div>
                                <div class="text-cyan-400 text-xl font-bold mt-2">KES <span id="compare-new-price">0</span>K</div>
                            </div>
                            <div class="space-y-1.5" id="compare-new-features"></div>
                        </div>
                    </div>

                    <!-- Price Difference -->
                    <div class="mt-4 p-4 bg-white/5 rounded-xl border border-white/10 text-center">
                        <div class="text-white/40 text-xs mb-1">Price Difference</div>
                        <div id="price-difference" class="text-xl font-bold"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 flex gap-3">
                        <button onclick="hideComparison()" class="flex-1 py-2.5 bg-white/5 border border-white/10 text-white text-sm font-medium rounded-lg hover:bg-white/10 transition-all">
                            Cancel
                        </button>
                        <button onclick="confirmPlanChange()" id="confirm-change-btn" class="flex-1 py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-all">
                            Confirm Change
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedNewPackage = null;

async function loadChangePlans() {
    if (!currentSubscription) {
        showAlert('Error', 'No active subscription found', 'error');
        showSection('current-plan-section');
        return;
    }

    // Display current plan info
    document.getElementById('current-plan-name-change').textContent = currentSubscription.package_name;
    const currentPriceK = (parseFloat(currentSubscription.price) / 1000).toFixed(0);
    document.getElementById('current-plan-price-change').textContent = currentPriceK;

    // Load all packages
    try {
        const response = await fetch('http://localhost:9044/packages');
        const result = await response.json();

        if (result.success && result.data) {
            displayChangePlans(result.data);
        }
    } catch (error) {
        console.error('Error loading packages:', error);
        showAlert('Error', 'Failed to load available plans', 'error');
    }
}

function displayChangePlans(packages) {
    const grid = document.getElementById('change-plans-grid');
    grid.innerHTML = '';

    packages.forEach(pkg => {
        if (pkg.id == currentSubscription.package_id) {
            return; // Skip current package
        }

        const isUpgrade = parseFloat(pkg.price) > parseFloat(currentSubscription.price);
        const priceDiff = Math.abs(parseFloat(pkg.price) - parseFloat(currentSubscription.price));
        const priceDiffK = (priceDiff / 1000).toFixed(0);
        const priceK = (parseFloat(pkg.price) / 1000).toFixed(0);

        const planRow = document.createElement('div');
        planRow.className = 'group';
        planRow.innerHTML = `
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-xl border border-white/10 hover:border-${isUpgrade ? 'green' : 'blue'}-400/30 transition-all overflow-hidden">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-4 gap-4">
                    <!-- Left: Plan Info -->
                    <div class="flex items-center gap-3 flex-1">
                        <!-- Badge -->
                        <div class="px-3 py-1 ${isUpgrade ? 'bg-green-500/20 border-green-400/30 text-green-400' : 'bg-blue-500/20 border-blue-400/30 text-blue-400'} border rounded-full text-[10px] font-bold">
                            ${isUpgrade ? 'UPGRADE' : 'DOWNGRADE'}
                        </div>

                        <!-- Plan Details -->
                        <div>
                            <h3 class="text-white font-bold">${pkg.name}</h3>
                            <p class="text-white/50 text-xs">${pkg.description}</p>
                        </div>
                    </div>

                    <!-- Middle: Quick Stats -->
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-1.5 text-white/60">
                            <i class="fas fa-calendar-check text-cyan-400"></i>
                            <span>${pkg.max_appointments === -1 ? '∞' : pkg.max_appointments} visits</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-white/60">
                            <i class="fas fa-users text-cyan-400"></i>
                            <span>${pkg.max_family_members === -1 ? '∞' : pkg.max_family_members} family</span>
                        </div>
                    </div>

                    <!-- Right: Price & Actions -->
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <div class="text-white font-bold">KES ${priceK}K/mo</div>
                            <div class="text-${isUpgrade ? 'green' : 'blue'}-400 text-xs font-medium">
                                ${isUpgrade ? '+' : '-'}${priceDiffK}K
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="event.stopPropagation(); showPlanDetails(${pkg.id}, '${pkg.name.replace(/'/g, "\\'")}', '${pkg.description.replace(/'/g, "\\'")}', ${pkg.price}, ${JSON.stringify(pkg.features).replace(/'/g, "\\'")})" class="px-3 py-2 bg-white/5 border border-white/10 text-white text-xs font-medium rounded-lg hover:bg-white/10 transition-all">
                                See Details
                            </button>
                            <button onclick="event.stopPropagation(); choosePlanDirect(${JSON.stringify(pkg).replace(/'/g, "\\'")})" class="px-3 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-xs font-semibold rounded-lg hover:opacity-90 transition-all">
                                Choose Plan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        grid.appendChild(planRow);
    });
}

function selectNewPlan(pkg) {
    selectedNewPackage = pkg;

    // Format prices in K
    const currentPriceK = (parseFloat(currentSubscription.price) / 1000).toFixed(0);
    const newPriceK = (parseFloat(pkg.price) / 1000).toFixed(0);

    // Show comparison
    document.getElementById('compare-current-name').textContent = currentSubscription.package_name;
    document.getElementById('compare-current-price').textContent = currentPriceK;
    document.getElementById('compare-new-name').textContent = pkg.name;
    document.getElementById('compare-new-price').textContent = newPriceK;

    // Features comparison - compact
    const currentFeatures = JSON.parse(currentSubscription.features || '[]');
    const newFeatures = pkg.features;

    const currentFeaturesDiv = document.getElementById('compare-current-features');
    currentFeaturesDiv.innerHTML = currentFeatures.slice(0, 4).map(f =>
        `<div class="flex items-start gap-1.5 text-white/60 text-xs"><i class="fas fa-check text-cyan-400 mt-0.5 text-[10px]"></i><span>${f}</span></div>`
    ).join('');

    const newFeaturesDiv = document.getElementById('compare-new-features');
    newFeaturesDiv.innerHTML = newFeatures.slice(0, 4).map(f =>
        `<div class="flex items-start gap-1.5 text-white/80 text-xs"><i class="fas fa-check text-cyan-400 mt-0.5 text-[10px]"></i><span>${f}</span></div>`
    ).join('');

    // Price difference
    const diff = parseFloat(pkg.price) - parseFloat(currentSubscription.price);
    const diffK = (Math.abs(diff) / 1000).toFixed(0);
    const isUpgrade = diff > 0;
    const diffDiv = document.getElementById('price-difference');
    diffDiv.innerHTML = `
        <span class="${isUpgrade ? 'text-green-400' : 'text-blue-400'}">
            ${isUpgrade ? '+' : '-'}KES ${diffK}K/month
        </span>
        <div class="text-white/40 text-xs mt-1">${isUpgrade ? 'Additional cost' : 'You save'}</div>
    `;

    document.getElementById('comparison-section').classList.remove('hidden');
    document.getElementById('comparison-section').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function hideComparison() {
    document.getElementById('comparison-section').classList.add('hidden');
    selectedNewPackage = null;
}

// Show plan details modal (using the learnMore modal from available packages)
function showPlanDetails(id, name, description, price, features) {
    const priceK = (parseFloat(price) / 1000).toFixed(0);
    learnMore(id, name, description, price, 'month', features);
}

// Choose plan directly without comparison
function choosePlanDirect(pkg) {
    selectedNewPackage = pkg;
    confirmPlanChange();
}

async function confirmPlanChange() {
    if (!selectedNewPackage) return;

    const userId = localStorage.getItem('user_id') || '1';
    const isUpgrade = parseFloat(selectedNewPackage.price) > parseFloat(currentSubscription.price);

    showConfirm(
        `${isUpgrade ? 'Upgrade' : 'Downgrade'} Plan?`,
        `Are you sure you want to ${isUpgrade ? 'upgrade' : 'downgrade'} to ${selectedNewPackage.name}?`,
        async (confirmed) => {
            if (!confirmed) return;

            try {
                const response = await fetch('http://localhost:9044/change-plan', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        user_id: userId,
                        new_package_id: selectedNewPackage.id
                    })
                });

                const result = await response.json();

                if (result.success) {
                    showAlert('Success!', `Successfully ${result.data.change_type}d to ${selectedNewPackage.name}!`, 'success');
                    setTimeout(() => {
                        hideComparison();
                        showSection('current-plan-section');
                        loadCurrentPlan();
                    }, 1500);
                } else {
                    showAlert('Error', result.message, 'error');
                }
            } catch (error) {
                console.error('Error changing plan:', error);
                showAlert('Connection Error', 'Failed to change plan. Please try again.', 'error');
            }
        }
    );
}

// Preload change plans on page load
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            // Wait a bit for currentSubscription to be loaded
            setTimeout(() => {
                if (currentSubscription) {
                    loadChangePlans();
                }
            }, 500);
        });
    } else {
        // DOM already loaded
        setTimeout(() => {
            if (currentSubscription) {
                loadChangePlans();
            }
        }, 500);
    }
})();
</script>

