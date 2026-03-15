<div id="current-plan-section" class="hidden relative py-8">
    <div class="space-y-6 relative z-10 max-w-6xl mx-auto">
        <!-- Compact Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">My Active Plan</h2>
                <p class="text-white/40 text-sm mt-1">Manage your subscription</p>
            </div>
        </div>

        <!-- Loading State -->
        <div id="plan-loading" class="text-center py-12 hidden">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
            <p class="text-white/60 mt-4">Loading your plan...</p>
        </div>

        <!-- No Subscription - Compact -->
        <div id="no-subscription" class="hidden">
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-2xl border border-white/10 p-10 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-cyan-500/20 to-teal-500/20 rounded-2xl flex items-center justify-center border border-cyan-400/20">
                    <i class="fas fa-box-open text-cyan-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No Active Plan</h3>
                <p class="text-white/50 text-sm mb-6">Subscribe to a care plan to get started with premium features</p>
                <button onclick="showSection('available-packages-section')" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-cyan-500/20">
                    <i class="fas fa-sparkles mr-2"></i>Browse Plans
                </button>
            </div>
        </div>

        <!-- Current Plan Details - Modern Redesign -->
        <div id="current-plan-details" class="hidden space-y-4">
            <!-- Main Plan Card - Horizontal Split -->
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                <div class="grid lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-white/10">
                    <!-- Left: Plan Overview -->
                    <div class="lg:col-span-2 p-6">
                        <!-- Plan Header -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-cyan-500/20 to-teal-500/20 rounded-xl flex items-center justify-center border border-cyan-400/30">
                                    <i class="fas fa-shield-heart text-cyan-400 text-2xl"></i>
                                </div>
                                <div>
                                    <h3 id="plan-name" class="text-2xl font-bold text-white mb-1">Premium Care</h3>
                                    <p id="plan-description" class="text-white/50 text-sm"></p>
                                </div>
                            </div>
                            <span id="plan-status" class="px-3 py-1.5 bg-green-500/20 border border-green-400/30 rounded-full text-green-400 text-xs font-semibold">Active</span>
                        </div>

                        <!-- Quick Stats Grid -->
                        <div class="grid grid-cols-4 gap-3 mb-6">
                            <div class="bg-white/5 rounded-xl p-3 text-center border border-white/5 hover:bg-white/10 transition-all">
                                <div class="text-xl font-bold text-white" id="appointments-limit">∞</div>
                                <div class="text-white/40 text-[10px] mt-1">Visits</div>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 text-center border border-white/5 hover:bg-white/10 transition-all">
                                <div class="text-xl font-bold text-white" id="family-limit">∞</div>
                                <div class="text-white/40 text-[10px] mt-1">Family</div>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 text-center border border-white/5 hover:bg-white/10 transition-all">
                                <div class="text-xl font-bold text-cyan-400"><span id="lab-discount">0</span>%</div>
                                <div class="text-white/40 text-[10px] mt-1">Lab</div>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 text-center border border-white/5 hover:bg-white/10 transition-all">
                                <div class="text-xl font-bold text-teal-400"><span id="pharmacy-discount">0</span>%</div>
                                <div class="text-white/40 text-[10px] mt-1">Pharmacy</div>
                            </div>
                        </div>

                        <!-- Billing Info -->
                        <div class="flex items-center gap-6 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar text-white/40 text-xs"></i>
                                <span class="text-white/40">Next billing:</span>
                                <span class="text-white font-medium" id="next-billing">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Price & Actions -->
                    <div class="p-6 bg-gradient-to-br from-white/5 to-transparent">
                        <div class="text-center mb-6">
                            <div class="text-white/40 text-xs mb-2">Monthly Payment</div>
                            <div class="flex items-baseline justify-center gap-1">
                                <span class="text-white/60 text-sm">KES</span>
                                <span class="text-4xl font-black text-white" id="plan-price">0</span>
                                <span class="text-white/60 text-sm">K</span>
                            </div>
                            <div class="text-white/40 text-xs mt-1">per <span id="plan-cycle">month</span></div>
                        </div>

                        <div class="space-y-2">
                            <button onclick="showSection('upgrade-downgrade-section')" class="w-full py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-sync-alt text-xs"></i>
                                <span>Change Plan</span>
                            </button>
                            <button onclick="showCancelModal()" class="w-full py-3 bg-white/5 border border-red-400/20 text-red-400 text-sm font-semibold rounded-xl hover:bg-red-500/10 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-times-circle text-xs"></i>
                                <span>Cancel</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section - Collapsible -->
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                <button onclick="toggleFeatures()" class="w-full p-4 flex items-center justify-between hover:bg-white/5 transition-all">
                    <h4 class="text-white font-semibold text-sm flex items-center gap-2">
                        <i class="fas fa-check-circle text-cyan-400 text-xs"></i>
                        Plan Features & Benefits
                    </h4>
                    <i class="fas fa-chevron-down text-white/40 text-xs transition-transform" id="features-chevron"></i>
                </button>
                <div id="plan-features-container" class="px-4 pb-4 hidden">
                    <div id="plan-features" class="grid sm:grid-cols-2 gap-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Subscription Modal -->
<div id="cancel-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="hideCancelModal()"></div>
    <div class="relative max-w-md w-full">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800 backdrop-blur-xl rounded-2xl border border-red-400/30 shadow-2xl"></div>
        <div class="relative p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Cancel Subscription?</h3>
                <p class="text-white/60">Are you sure you want to cancel your subscription? You'll lose access to all premium features.</p>
            </div>

            <div class="mb-4">
                <label class="block text-white/80 text-sm mb-2">Reason for cancellation (optional)</label>
                <textarea id="cancel-reason" rows="3" class="w-full px-4 py-3 bg-white/5 border border-cyan-400/20 rounded-xl text-white placeholder-white/40 focus:outline-none focus:border-cyan-400/50 resize-none" placeholder="Help us improve by sharing your reason..."></textarea>
            </div>

            <div class="flex gap-3">
                <button onclick="hideCancelModal()" class="flex-1 px-6 py-3 bg-white/5 border border-cyan-400/20 text-white rounded-xl font-semibold hover:bg-white/10 transform transition-all duration-300">
                    Keep Plan
                </button>
                <button onclick="confirmCancellation()" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:from-red-600 hover:to-red-700 transform transition-all duration-300">
                    Yes, Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentSubscription = null;

async function loadCurrentPlan() {
    const userId = localStorage.getItem('user_id') || '1'; // Get from auth

    document.getElementById('plan-loading').classList.remove('hidden');
    document.getElementById('no-subscription').classList.add('hidden');
    document.getElementById('current-plan-details').classList.add('hidden');

    try {
        const response = await fetch(`http://localhost:9044/subscription?user_id=${userId}`);
        const result = await response.json();

        document.getElementById('plan-loading').classList.add('hidden');

        if (result.success && result.data) {
            currentSubscription = result.data;
            displayCurrentPlan(result.data);
            document.getElementById('current-plan-details').classList.remove('hidden');
        } else {
            document.getElementById('no-subscription').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error loading plan:', error);
        document.getElementById('plan-loading').classList.add('hidden');
        document.getElementById('no-subscription').classList.remove('hidden');
    }
}

// Preload current plan on page load
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadCurrentPlan);
    } else {
        loadCurrentPlan();
    }
})();

function displayCurrentPlan(plan) {
    document.getElementById('plan-name').textContent = plan.package_name;
    document.getElementById('plan-description').textContent = plan.package_description;

    // Format price
    const price = parseFloat(plan.price);
    const priceK = (price / 1000).toFixed(0);
    document.getElementById('plan-price').textContent = priceK;
    document.getElementById('plan-cycle').textContent = plan.billing_cycle;

    // Status
    const statusBadge = document.getElementById('plan-status');
    statusBadge.textContent = plan.status.charAt(0).toUpperCase() + plan.status.slice(1);
    statusBadge.className = `px-3 py-1.5 rounded-full text-xs font-semibold ${
        plan.status === 'active' ? 'bg-green-500/20 border border-green-400/30 text-green-400' :
        plan.status === 'cancelled' ? 'bg-red-500/20 border border-red-400/30 text-red-400' :
        'bg-yellow-500/20 border border-yellow-400/30 text-yellow-400'
    }`;

    // Stats
    document.getElementById('appointments-limit').textContent = plan.max_appointments === -1 ? '∞' : plan.max_appointments;
    document.getElementById('family-limit').textContent = plan.max_family_members === -1 ? '∞' : plan.max_family_members;
    document.getElementById('lab-discount').textContent = plan.lab_discount || 0;
    document.getElementById('pharmacy-discount').textContent = plan.pharmacy_discount || 0;

    // Features - Compact list
    const featuresContainer = document.getElementById('plan-features');
    featuresContainer.innerHTML = '';
    if (plan.features && Array.isArray(plan.features)) {
        plan.features.forEach(feature => {
            const featureDiv = document.createElement('div');
            featureDiv.className = 'flex items-start gap-2 p-2.5 bg-white/5 rounded-lg hover:bg-white/10 transition-all group';
            featureDiv.innerHTML = `
                <i class="fas fa-check text-cyan-400 text-xs mt-1 flex-shrink-0"></i>
                <span class="text-white/70 text-sm group-hover:text-white transition-colors">${feature}</span>
            `;
            featuresContainer.appendChild(featureDiv);
        });
    }

    // Dates
    document.getElementById('next-billing').textContent = new Date(plan.next_billing_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function toggleFeatures() {
    const container = document.getElementById('plan-features-container');
    const chevron = document.getElementById('features-chevron');

    if (container.classList.contains('hidden')) {
        container.classList.remove('hidden');
        chevron.classList.add('rotate-180');
    } else {
        container.classList.add('hidden');
        chevron.classList.remove('rotate-180');
    }
}

function showCancelModal() {
    document.getElementById('cancel-modal').classList.remove('hidden');
}

function hideCancelModal() {
    document.getElementById('cancel-modal').classList.add('hidden');
    document.getElementById('cancel-reason').value = '';
}

async function confirmCancellation() {
    const userId = localStorage.getItem('user_id') || '1';
    const reason = document.getElementById('cancel-reason').value;

    try {
        const response = await fetch('http://localhost:9044/cancel', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: userId, reason })
        });

        const result = await response.json();

        if (result.success) {
            alert('Subscription cancelled successfully');
            hideCancelModal();
            loadCurrentPlan();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error cancelling subscription:', error);
        alert('Failed to cancel subscription');
    }
}

// Load when section is shown
if (document.getElementById('current-plan-section').classList.contains('hidden') === false) {
    loadCurrentPlan();
}
</script>

<style>
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
