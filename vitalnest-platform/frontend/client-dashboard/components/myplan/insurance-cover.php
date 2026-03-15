<div id="insurance-cover-section" class="hidden relative py-8">
    <div class="space-y-6 relative z-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">My Insurance Cover</h2>
                <p class="text-white/40 text-sm mt-1">Manage your insurance policies and claims</p>
            </div>
            <button onclick="openAddInsuranceModal()" class="px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                <i class="fas fa-plus text-xs"></i>
                Add Insurance
            </button>
        </div>

        <!-- Loading State -->
        <div id="insurance-loading" class="text-center py-12 hidden">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
            <p class="text-white/60 mt-4">Loading insurance covers...</p>
        </div>

        <!-- No Insurance -->
        <div id="no-insurance" class="hidden">
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-2xl border border-white/10 p-10 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-cyan-500/20 to-teal-500/20 rounded-2xl flex items-center justify-center border border-cyan-400/20">
                    <i class="fas fa-shield-alt text-cyan-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No Insurance Cover</h3>
                <p class="text-white/50 text-sm mb-6">Add your insurance information to get started</p>
                <button onclick="openAddInsuranceModal()" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-cyan-500/20">
                    <i class="fas fa-plus mr-2"></i>Add First Insurance
                </button>
            </div>
        </div>

        <!-- Insurance List -->
        <div id="insurance-list" class="hidden space-y-4"></div>
    </div>
</div>

<!-- Add/Edit Insurance Modal -->
<div id="insurance-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeInsuranceModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-slate-800 rounded-2xl border border-white/10 w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl transform scale-90 opacity-0 transition-all duration-200" id="insurance-modal-content">
            <!-- Header -->
            <div class="sticky top-0 bg-slate-800 border-b border-white/10 px-6 py-4 flex items-center justify-between z-10">
                <div>
                    <h3 class="text-lg font-bold text-white" id="modal-title">Add Insurance Cover</h3>
                    <p class="text-white/40 text-xs">Fill in your insurance details</p>
                </div>
                <button onclick="closeInsuranceModal()" class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20">
                    <i class="fas fa-times text-white/60 text-sm"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="insurance-form" class="p-6 space-y-4">
                <input type="hidden" id="insurance-id" value="">

                <!-- Provider Name -->
                <div>
                    <label class="text-white/60 text-xs font-medium">Insurance Provider *</label>
                    <input type="text" id="provider-name" required placeholder="e.g., AAR Healthcare, Britam, NHIF" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Policy Number -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Policy Number *</label>
                        <input type="text" id="policy-number" required placeholder="ABC123456" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                    </div>

                    <!-- Policy Type -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Policy Type *</label>
                        <select id="policy-type" required class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:outline-none focus:border-cyan-500/50">
                            <option value="">Select Type</option>
                            <option value="individual">Individual</option>
                            <option value="family">Family</option>
                            <option value="group">Group/Corporate</option>
                            <option value="government">Government (NHIF)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Start Date -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Start Date *</label>
                        <input type="date" id="start-date" required class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:outline-none focus:border-cyan-500/50">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">End Date *</label>
                        <input type="date" id="end-date" required class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:outline-none focus:border-cyan-500/50">
                    </div>
                </div>

                <!-- Coverage Amount -->
                <div>
                    <label class="text-white/60 text-xs font-medium">Coverage Amount (KES)</label>
                    <input type="number" id="coverage-amount" placeholder="0" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Primary Holder -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Primary Holder *</label>
                        <input type="text" id="primary-holder" required placeholder="Full Name" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                    </div>

                    <!-- Relationship -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Relationship</label>
                        <select id="relationship" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:outline-none focus:border-cyan-500/50">
                            <option value="self">Self</option>
                            <option value="spouse">Spouse</option>
                            <option value="parent">Parent</option>
                            <option value="child">Child</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Contact Phone -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Contact Phone</label>
                        <input type="tel" id="contact-phone" placeholder="+254712345678" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label class="text-white/60 text-xs font-medium">Contact Email</label>
                        <input type="email" id="contact-email" placeholder="insurance@provider.com" class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50">
                    </div>
                </div>

                <!-- Coverage Options -->
                <div class="border-t border-white/10 pt-4">
                    <h4 class="text-white font-semibold text-sm mb-3">Coverage Inclusions</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="prescription-coverage" checked class="w-4 h-4 rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-white/70 text-sm">Prescription Coverage</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="dental-coverage" class="w-4 h-4 rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-white/70 text-sm">Dental Coverage</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="vision-coverage" class="w-4 h-4 rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-white/70 text-sm">Vision Coverage</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="mental-health-coverage" checked class="w-4 h-4 rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-white/70 text-sm">Mental Health</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="maternity-coverage" class="w-4 h-4 rounded bg-white/5 border-white/10 text-cyan-500 focus:ring-cyan-500">
                            <span class="text-white/70 text-sm">Maternity Coverage</span>
                        </label>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="text-white/60 text-xs font-medium">Additional Notes</label>
                    <textarea id="insurance-notes" rows="2" placeholder="Any additional information..." class="w-full mt-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm placeholder-white/30 focus:outline-none focus:border-cyan-500/50 resize-none"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-white/10">
                    <button type="button" onclick="closeInsuranceModal()" class="flex-1 py-2.5 bg-white/5 border border-white/10 text-white text-sm font-medium rounded-lg hover:bg-white/10 transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-all">
                        <i class="fas fa-save mr-2"></i>Save Insurance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let insuranceCovers = [];
let editingInsuranceId = null;

// Load insurance covers
async function loadInsuranceCovers() {
    const userId = localStorage.getItem('user_id') || '1';

    document.getElementById('insurance-loading').classList.remove('hidden');
    document.getElementById('no-insurance').classList.add('hidden');
    document.getElementById('insurance-list').classList.add('hidden');

    try {
        const response = await fetch(`' + window.location.origin + '/api/insurance/insurance?user_id=${userId}`);
        const result = await response.json();

        document.getElementById('insurance-loading').classList.add('hidden');

        if (result.success && result.data && result.data.length > 0) {
            insuranceCovers = result.data;
            displayInsuranceList(result.data);
            document.getElementById('insurance-list').classList.remove('hidden');
        } else {
            document.getElementById('no-insurance').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error loading insurance:', error);
        document.getElementById('insurance-loading').classList.add('hidden');
        document.getElementById('no-insurance').classList.remove('hidden');
    }
}

// Display insurance list
function displayInsuranceList(covers) {
    const container = document.getElementById('insurance-list');
    container.innerHTML = '';

    covers.forEach(cover => {
        const isActive = cover.status === 'active';
        const isExpiringSoon = new Date(cover.end_date) - new Date() < 30 * 24 * 60 * 60 * 1000; // 30 days

        const coverageK = cover.coverage_amount ? (cover.coverage_amount / 1000).toFixed(0) : '0';

        const row = document.createElement('div');
        row.className = 'bg-slate-800/30 backdrop-blur-xl rounded-xl border border-white/10 hover:border-cyan-400/30 transition-all overflow-hidden';
        row.innerHTML = `
            <div class="p-5">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <!-- Left: Provider Info -->
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500/20 to-teal-500/20 rounded-xl flex items-center justify-center border border-cyan-400/30">
                            <i class="fas fa-shield-alt text-cyan-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-lg">${cover.provider_name}</h3>
                            <p class="text-white/50 text-xs">Policy #${cover.policy_number}</p>
                            <div class="flex items-center gap-3 mt-2 text-xs">
                                <span class="flex items-center gap-1 text-white/60">
                                    <i class="fas fa-user text-cyan-400"></i>
                                    ${cover.policy_type}
                                </span>
                                <span class="flex items-center gap-1 text-white/60">
                                    <i class="fas fa-calendar text-cyan-400"></i>
                                    ${new Date(cover.start_date).toLocaleDateString()} - ${new Date(cover.end_date).toLocaleDateString()}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Middle: Coverage -->
                    <div class="text-center px-6 border-l border-white/10">
                        <div class="text-white/40 text-xs mb-1">Coverage</div>
                        <div class="text-white font-bold text-xl">KES ${coverageK}K</div>
                    </div>

                    <!-- Right: Status & Actions -->
                    <div class="flex items-center gap-3">
                        <div>
                            <span class="px-3 py-1 ${isActive ? 'bg-green-500/20 border-green-400/30 text-green-400' : 'bg-red-500/20 border-red-400/30 text-red-400'} border rounded-full text-xs font-semibold">
                                ${isActive ? 'Active' : 'Inactive'}
                            </span>
                            ${isExpiringSoon && isActive ? '<div class="text-amber-400 text-xs mt-1"><i class="fas fa-exclamation-triangle"></i> Expiring Soon</div>' : ''}
                        </div>
                        <div class="flex gap-2">
                            <button onclick="editInsurance(${cover.id})" class="w-8 h-8 bg-white/5 hover:bg-white/10 rounded-lg flex items-center justify-center transition-all" title="Edit">
                                <i class="fas fa-edit text-cyan-400 text-sm"></i>
                            </button>
                            <button onclick="deleteInsurance(${cover.id}, '${cover.provider_name.replace(/'/g, "\\'")}'))" class="w-8 h-8 bg-white/5 hover:bg-red-500/20 rounded-lg flex items-center justify-center transition-all" title="Delete">
                                <i class="fas fa-trash text-red-400 text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Expandable Details -->
                <div class="mt-4 pt-4 border-t border-white/10">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
                        <div class="flex items-center gap-2 ${cover.prescription_coverage ? 'text-green-400' : 'text-white/30'}">
                            <i class="fas fa-${cover.prescription_coverage ? 'check' : 'times'}"></i>
                            <span>Prescription</span>
                        </div>
                        <div class="flex items-center gap-2 ${cover.dental_coverage ? 'text-green-400' : 'text-white/30'}">
                            <i class="fas fa-${cover.dental_coverage ? 'check' : 'times'}"></i>
                            <span>Dental</span>
                        </div>
                        <div class="flex items-center gap-2 ${cover.vision_coverage ? 'text-green-400' : 'text-white/30'}">
                            <i class="fas fa-${cover.vision_coverage ? 'check' : 'times'}"></i>
                            <span>Vision</span>
                        </div>
                        <div class="flex items-center gap-2 ${cover.maternity_coverage ? 'text-green-400' : 'text-white/30'}">
                            <i class="fas fa-${cover.maternity_coverage ? 'check' : 'times'}"></i>
                            <span>Maternity</span>
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.appendChild(row);
    });
}

// Open add insurance modal
function openAddInsuranceModal() {
    editingInsuranceId = null;
    document.getElementById('modal-title').textContent = 'Add Insurance Cover';
    document.getElementById('insurance-form').reset();
    document.getElementById('insurance-id').value = '';

    const modal = document.getElementById('insurance-modal');
    const content = document.getElementById('insurance-modal-content');

    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-90', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';
}

// Close insurance modal
function closeInsuranceModal() {
    const modal = document.getElementById('insurance-modal');
    const content = document.getElementById('insurance-modal-content');

    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 200);
}

// Edit insurance
function editInsurance(id) {
    const cover = insuranceCovers.find(c => c.id === id);
    if (!cover) return;

    editingInsuranceId = id;
    document.getElementById('modal-title').textContent = 'Edit Insurance Cover';
    document.getElementById('insurance-id').value = id;
    document.getElementById('provider-name').value = cover.provider_name;
    document.getElementById('policy-number').value = cover.policy_number;
    document.getElementById('policy-type').value = cover.policy_type;
    document.getElementById('coverage-amount').value = cover.coverage_amount || '';
    document.getElementById('start-date').value = cover.start_date;
    document.getElementById('end-date').value = cover.end_date;
    document.getElementById('primary-holder').value = cover.primary_holder_name;
    document.getElementById('relationship').value = cover.primary_holder_relationship || 'self';
    document.getElementById('contact-phone').value = cover.contact_phone || '';
    document.getElementById('contact-email').value = cover.contact_email || '';
    document.getElementById('prescription-coverage').checked = cover.prescription_coverage == 1;
    document.getElementById('dental-coverage').checked = cover.dental_coverage == 1;
    document.getElementById('vision-coverage').checked = cover.vision_coverage == 1;
    document.getElementById('mental-health-coverage').checked = cover.mental_health_coverage == 1;
    document.getElementById('maternity-coverage').checked = cover.maternity_coverage == 1;
    document.getElementById('insurance-notes').value = cover.notes || '';

    openAddInsuranceModal();
}

// Delete insurance
function deleteInsurance(id, providerName) {
    showConfirm(
        'Delete Insurance?',
        `Are you sure you want to delete ${providerName} insurance cover?`,
        async (confirmed) => {
            if (!confirmed) return;

            try {
                const response = await fetch(`' + window.location.origin + '/api/insurance/insurance/${id}`, {
                    method: 'DELETE'
                });

                const result = await response.json();

                if (result.success) {
                    showAlert('Success!', 'Insurance cover deleted successfully', 'success');
                    loadInsuranceCovers();
                } else {
                    showAlert('Error', result.message, 'error');
                }
            } catch (error) {
                console.error('Error deleting insurance:', error);
                showAlert('Connection Error', 'Failed to delete insurance. Please try again.', 'error');
            }
        }
    );
}

// Handle form submission
document.getElementById('insurance-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const userId = localStorage.getItem('user_id') || '1';
    const insuranceId = document.getElementById('insurance-id').value;

    const data = {
        user_id: userId,
        provider_name: document.getElementById('provider-name').value,
        policy_number: document.getElementById('policy-number').value,
        policy_type: document.getElementById('policy-type').value,
        coverage_amount: parseFloat(document.getElementById('coverage-amount').value) || 0,
        start_date: document.getElementById('start-date').value,
        end_date: document.getElementById('end-date').value,
        primary_holder_name: document.getElementById('primary-holder').value,
        primary_holder_relationship: document.getElementById('relationship').value,
        contact_phone: document.getElementById('contact-phone').value,
        contact_email: document.getElementById('contact-email').value,
        prescription_coverage: document.getElementById('prescription-coverage').checked ? 1 : 0,
        dental_coverage: document.getElementById('dental-coverage').checked ? 1 : 0,
        vision_coverage: document.getElementById('vision-coverage').checked ? 1 : 0,
        mental_health_coverage: document.getElementById('mental-health-coverage').checked ? 1 : 0,
        maternity_coverage: document.getElementById('maternity-coverage').checked ? 1 : 0,
        notes: document.getElementById('insurance-notes').value,
        status: 'active'
    };

    try {
        const url = insuranceId ? `' + window.location.origin + '/api/insurance/insurance/${insuranceId}` : '' + window.location.origin + '/api/insurance/insurance';
        const method = insuranceId ? 'PUT' : 'POST';

        const response = await fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            showAlert('Success!', `Insurance cover ${insuranceId ? 'updated' : 'added'} successfully!`, 'success');
            closeInsuranceModal();
            loadInsuranceCovers();
        } else {
            showAlert('Error', result.message, 'error');
        }
    } catch (error) {
        console.error('Error saving insurance:', error);
        showAlert('Connection Error', 'Failed to save insurance. Please try again.', 'error');
    }
});

// Preload insurance on page load
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadInsuranceCovers);
    } else {
        loadInsuranceCovers();
    }
})();
</script>

