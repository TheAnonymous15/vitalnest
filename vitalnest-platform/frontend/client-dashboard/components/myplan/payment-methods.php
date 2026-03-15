<!-- Payment Methods Section -->
<div id="payment-methods-section" class="hidden relative py-8">
    <div class="space-y-6 relative z-10 max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-bold text-white">Payment Methods</h2>
                    <span id="payment-count-badge"
                          class="hidden px-2.5 py-1 bg-cyan-500/20 border border-cyan-400/30 rounded-full text-cyan-400 text-xs font-semibold">
                    </span>
                </div>
                <p class="text-white/40 text-sm mt-1">
                    Manage your payment options – you can add multiple methods
                </p>
            </div>

            <button onclick="showAddPaymentModal()"
                    class="px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-lg hover:opacity-90 transition-all flex items-center gap-2">
                <i class="fas fa-plus text-xs"></i>
                Add Method
            </button>
        </div>

        <!-- Loading -->
        <div id="payment-loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
            <p class="text-white/60 mt-4">Loading payment methods...</p>
        </div>

        <!-- Empty -->
        <div id="no-payment-methods" class="hidden">
            <div class="bg-slate-800/30 backdrop-blur-xl rounded-2xl border border-white/10 p-10 text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-cyan-500/20 to-teal-500/20 rounded-2xl flex items-center justify-center border border-cyan-400/20">
                    <i class="fas fa-credit-card text-cyan-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No Payment Methods Yet</h3>
                <p class="text-white/50 text-sm mb-6">
                    Add your payment methods to manage subscriptions easily
                </p>
                <button onclick="showAddPaymentModal()"
                        class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all">
                    <i class="fas fa-plus mr-2"></i>Add First Method
                </button>
            </div>
        </div>

        <!-- Grid -->
        <div id="payment-methods-list"
             class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        </div>
    </div>
</div>

<!-- Add Payment Modal -->
<div id="add-payment-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"
         onclick="hideAddPaymentModal()"></div>

    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="payment-modal-content"
             class="bg-slate-800 rounded-2xl border border-white/10 w-full max-w-lg shadow-2xl transform scale-90 opacity-0 transition-all duration-200">

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-white/10 flex justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Add Payment Method</h3>
                    <p class="text-white/40 text-xs">Multiple methods supported</p>
                </div>
                <button onclick="hideAddPaymentModal()"
                        class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-times text-white/60 text-sm"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6">

                <!-- Type -->
                <div>
                    <label class="text-white/60 text-xs font-medium mb-3 block">
                        Payment Type
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button id="type-card"
                                onclick="selectPaymentType('card')"
                                class="payment-type-btn p-4 bg-white/5 border border-white/10 rounded-xl text-white">
                            <i class="fas fa-credit-card text-cyan-400 text-xl mb-2"></i>
                            <div class="text-sm font-semibold">Card</div>
                        </button>

                        <button id="type-mobile"
                                onclick="selectPaymentType('mobile')"
                                class="payment-type-btn p-4 bg-white/5 border border-white/10 rounded-xl text-white">
                            <i class="fas fa-mobile-alt text-cyan-400 text-xl mb-2"></i>
                            <div class="text-sm font-semibold">Mobile Money</div>
                        </button>
                    </div>
                </div>

                <!-- Card -->
                <div id="card-form" class="hidden space-y-3">
                    <input id="card-number" placeholder="Card Number"
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                    <div class="grid grid-cols-2 gap-3">
                        <input id="card-expiry" placeholder="MM/YY"
                               class="px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                        <input id="card-cvv" placeholder="CVV"
                               class="px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                    </div>
                    <input id="card-name" placeholder="Cardholder Name"
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                </div>

                <!-- Mobile -->
                <div id="mobile-form" class="hidden space-y-3">
                    <select id="mobile-provider"
                            class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                        <option value="">Select Provider</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="airtel">Airtel</option>
                        <option value="mtn">MTN</option>
                    </select>

                    <input id="mobile-number" placeholder="+254700000000"
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded text-white">
                </div>

                <label class="flex items-center gap-2">
                    <input id="set-default" type="checkbox">
                    <span class="text-white/70 text-sm">Set as default</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 border-t border-white/10 flex gap-3">
                <button onclick="hideAddPaymentModal()"
                        class="flex-1 py-2 bg-white/5 border border-white/10 text-white rounded">
                    Cancel
                </button>
                <button onclick="savePaymentMethod()"
                        class="flex-1 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded">
                    Save Method
                </button>
            </div>

        </div>
    </div>
</div>

<script>
let selectedPaymentType = null;
let paymentMethods = [];

/* ---------- LOAD ---------- */
async function loadPaymentMethods() {
    const userId = localStorage.getItem('user_id') || 1;

    payment-loading.classList.remove('hidden');
    payment-methods-list.classList.add('hidden');
    no-payment-methods.classList.add('hidden');

    try {
        const res = await fetch(`' + window.location.origin + '/api/subscriptions/payment-methods?user_id=${userId}`);
        const json = await res.json();

        payment-loading.classList.add('hidden');

        if (json.success && json.data.length) {
            paymentMethods = json.data;
            displayPaymentMethods(json.data);
            payment-methods-list.classList.remove('hidden');
        } else {
            no-payment-methods.classList.remove('hidden');
        }
    } catch {
        payment-loading.classList.add('hidden');
        no-payment-methods.classList.remove('hidden');
    }
}

/* ---------- DISPLAY ---------- */
function displayPaymentMethods(methods) {
    payment-methods-list.innerHTML = '';

    payment-count-badge.textContent = `${methods.length} Methods`;
    payment-count-badge.classList.toggle('hidden', !methods.length);

    methods.forEach(m => {
        const isCard = m.type === 'card';
        const div = document.createElement('div');

        div.className =
            'bg-slate-800/30 border border-white/10 rounded-xl p-5 text-white';

        div.innerHTML = `
            <div class="font-bold mb-1">${isCard ? m.card_brand : m.mobile_money_provider}</div>
            <div class="text-sm opacity-70">
                ${isCard ? '•••• ' + m.card_last_four : m.mobile_money_number}
            </div>
            <button onclick="removePaymentMethod(${m.id})"
                    class="mt-3 text-red-400 text-xs">
                Remove
            </button>
        `;

        payment-methods-list.appendChild(div);
    });
}

/* ---------- MODAL ---------- */
function showAddPaymentModal() {
    add-payment-modal.classList.remove('hidden');
    setTimeout(() => payment-modal-content.classList.replace('scale-90','scale-100'), 10);
}

function hideAddPaymentModal() {
    add-payment-modal.classList.add('hidden');
}

/* ---------- TYPE ---------- */
function selectPaymentType(type) {
    selectedPaymentType = type;
    card-form.classList.toggle('hidden', type !== 'card');
    mobile-form.classList.toggle('hidden', type !== 'mobile');
}

/* ---------- SAVE ---------- */
async function savePaymentMethod() {
    alert('Hook backend here');
}

/* ---------- REMOVE ---------- */
async function removePaymentMethod(id) {
    alert('Remove ' + id);
}

document.addEventListener('DOMContentLoaded', loadPaymentMethods);
</script>
