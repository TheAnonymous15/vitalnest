<div id="billing-history-section" class="hidden">
    <div class="space-y-6">
        <!-- Header -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 via-cyan-400/5 to-transparent backdrop-blur-xl rounded-2xl border border-cyan-400/20"></div>
            <div class="relative p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white">Billing History</h2>
                    <p class="text-white/60 mt-1">View your payment history and invoices</p>
                </div>
                <button onclick="exportBillingHistory()" class="px-6 py-3 bg-white/5 border border-cyan-400/20 text-cyan-400 rounded-xl font-semibold hover:bg-cyan-500/10 transform transition-all duration-300">
                    <i class="fas fa-download mr-2"></i> Export
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800/50 via-slate-900/50 to-slate-800/50 backdrop-blur-xl rounded-xl border border-cyan-400/10"></div>
                <div class="relative p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-dollar-sign text-cyan-400 text-xl"></i>
                        <span class="text-xs text-white/60">Total Spent</span>
                    </div>
                    <div class="text-2xl font-bold text-white">$<span id="total-spent">0.00</span></div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800/50 via-slate-900/50 to-slate-800/50 backdrop-blur-xl rounded-xl border border-cyan-400/10"></div>
                <div class="relative p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-file-invoice text-green-400 text-xl"></i>
                        <span class="text-xs text-white/60">Paid</span>
                    </div>
                    <div class="text-2xl font-bold text-green-400" id="paid-count">0</div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800/50 via-slate-900/50 to-slate-800/50 backdrop-blur-xl rounded-xl border border-cyan-400/10"></div>
                <div class="relative p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-clock text-yellow-400 text-xl"></i>
                        <span class="text-xs text-white/60">Pending</span>
                    </div>
                    <div class="text-2xl font-bold text-yellow-400" id="pending-count">0</div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800/50 via-slate-900/50 to-slate-800/50 backdrop-blur-xl rounded-xl border border-cyan-400/10"></div>
                <div class="relative p-4">
                    <div class="flex items-center justify-between mb-2">
                        <i class="fas fa-calendar-alt text-cyan-400 text-xl"></i>
                        <span class="text-xs text-white/60">Last Payment</span>
                    </div>
                    <div class="text-sm font-bold text-white" id="last-payment-date">-</div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="relative">
            <div class="absolute inset-0 bg-white/5 backdrop-blur-sm rounded-xl border border-cyan-400/10"></div>
            <div class="relative p-4 flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" id="search-billing" placeholder="Search invoices..." class="w-full px-4 py-2 bg-white/5 border border-cyan-400/20 rounded-lg text-white placeholder-white/40 focus:outline-none focus:border-cyan-400/50">
                </div>
                <select id="filter-status" class="px-4 py-2 bg-white/5 border border-cyan-400/20 rounded-lg text-white focus:outline-none focus:border-cyan-400/50">
                    <option value="all">All Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
                <select id="filter-period" class="px-4 py-2 bg-white/5 border border-cyan-400/20 rounded-lg text-white focus:outline-none focus:border-cyan-400/50">
                    <option value="all">All Time</option>
                    <option value="30">Last 30 days</option>
                    <option value="90">Last 90 days</option>
                    <option value="365">Last year</option>
                </select>
            </div>
        </div>

        <!-- Loading State -->
        <div id="billing-loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-cyan-400 border-t-transparent"></div>
            <p class="text-white/60 mt-4">Loading billing history...</p>
        </div>

        <!-- Billing Table -->
        <div id="billing-table-container" class="hidden relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-800/30 via-slate-900/30 to-slate-800/30 backdrop-blur-xl rounded-2xl border border-cyan-400/10"></div>
            <div class="relative overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-cyan-400/20">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody id="billing-table-body">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Empty State -->
        <div id="no-billing-history" class="hidden text-center py-12">
            <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-cyan-400/20 to-cyan-600/20 rounded-full flex items-center justify-center">
                <i class="fas fa-file-invoice text-cyan-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">No Billing History</h3>
            <p class="text-white/60">You don't have any billing records yet</p>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div id="invoice-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="hideInvoiceModal()"></div>
    <div class="relative max-w-2xl w-full">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800 backdrop-blur-xl rounded-2xl border border-cyan-400/30 shadow-2xl"></div>
        <div class="relative p-8">
            <!-- Invoice Header -->
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-white mb-2">INVOICE</h2>
                    <div class="text-white/60 text-sm">VitalNest Healthcare</div>
                </div>
                <button onclick="hideInvoiceModal()" class="text-white/60 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Invoice Details -->
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <div class="text-white/60 text-sm mb-1">Invoice Number</div>
                    <div class="text-white font-semibold" id="invoice-number">-</div>
                </div>
                <div>
                    <div class="text-white/60 text-sm mb-1">Date</div>
                    <div class="text-white font-semibold" id="invoice-date">-</div>
                </div>
            </div>

            <!-- Items -->
            <div class="mb-8">
                <div class="border-t border-b border-cyan-400/20 py-4">
                    <div class="flex justify-between mb-2">
                        <div class="text-white/60">Description</div>
                        <div class="text-white/60">Amount</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="text-white font-semibold" id="invoice-description">-</div>
                        <div class="text-white font-semibold">$<span id="invoice-amount">0.00</span></div>
                    </div>
                </div>
                <div class="flex justify-between pt-4">
                    <div class="text-xl font-bold text-white">Total</div>
                    <div class="text-2xl font-bold text-cyan-400">$<span id="invoice-total">0.00</span></div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button onclick="printInvoice()" class="flex-1 px-6 py-3 bg-white/5 border border-cyan-400/20 text-cyan-400 rounded-xl font-semibold hover:bg-cyan-500/10 transform transition-all duration-300">
                    <i class="fas fa-print mr-2"></i> Print
                </button>
                <button onclick="downloadInvoice()" class="flex-1 px-6 py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-xl font-semibold hover:from-cyan-600 hover:to-cyan-700 transform transition-all duration-300">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let billingHistory = [];
let currentInvoice = null;

async function loadBillingHistory() {
    const userId = localStorage.getItem('user_id') || '1';

    document.getElementById('billing-loading').classList.remove('hidden');
    document.getElementById('billing-table-container').classList.add('hidden');
    document.getElementById('no-billing-history').classList.add('hidden');

    try {
        const response = await fetch(`' + window.location.origin + '/api/subscriptions/billing-history?user_id=${userId}`);
        const result = await response.json();

        document.getElementById('billing-loading').classList.add('hidden');

        if (result.success && result.data && result.data.length > 0) {
            billingHistory = result.data;
            displayBillingHistory(result.data);
            updateBillingSummary(result.data);
            document.getElementById('billing-table-container').classList.remove('hidden');
        } else {
            document.getElementById('no-billing-history').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error loading billing history:', error);
        document.getElementById('billing-loading').classList.add('hidden');
        document.getElementById('no-billing-history').classList.remove('hidden');
    }
}

function updateBillingSummary(history) {
    const totalSpent = history.reduce((sum, item) => {
        return item.status === 'paid' ? sum + parseFloat(item.amount) : sum;
    }, 0);

    const paidCount = history.filter(item => item.status === 'paid').length;
    const pendingCount = history.filter(item => item.status === 'pending').length;

    document.getElementById('total-spent').textContent = totalSpent.toFixed(2);
    document.getElementById('paid-count').textContent = paidCount;
    document.getElementById('pending-count').textContent = pendingCount;

    const lastPayment = history.find(item => item.status === 'paid' && item.payment_date);
    if (lastPayment) {
        document.getElementById('last-payment-date').textContent = new Date(lastPayment.payment_date).toLocaleDateString();
    }
}

function displayBillingHistory(history) {
    const tbody = document.getElementById('billing-table-body');
    tbody.innerHTML = '';

    history.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'border-b border-cyan-400/5 hover:bg-white/5 transition-colors duration-200';
        row.innerHTML = `
            <td class="px-6 py-4">
                <div class="text-white font-semibold">${item.invoice_number || 'N/A'}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-white/80">${new Date(item.billing_date).toLocaleDateString()}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-white/80">${item.description || item.package_name}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-white font-semibold">$${parseFloat(item.amount).toFixed(2)}</div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold ${getStatusClass(item.status)}">
                    ${item.status.toUpperCase()}
                </span>
            </td>
            <td class="px-6 py-4">
                <button onclick='viewInvoice(${JSON.stringify(item)})' class="text-cyan-400 hover:text-cyan-300 font-semibold text-sm">
                    <i class="fas fa-eye mr-1"></i> View
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function getStatusClass(status) {
    switch(status) {
        case 'paid':
            return 'bg-green-500/20 border border-green-400/30 text-green-400';
        case 'pending':
            return 'bg-yellow-500/20 border border-yellow-400/30 text-yellow-400';
        case 'failed':
            return 'bg-red-500/20 border border-red-400/30 text-red-400';
        default:
            return 'bg-white/10 border border-white/20 text-white/60';
    }
}

function viewInvoice(invoice) {
    currentInvoice = invoice;
    document.getElementById('invoice-number').textContent = invoice.invoice_number;
    document.getElementById('invoice-date').textContent = new Date(invoice.billing_date).toLocaleDateString();
    document.getElementById('invoice-description').textContent = invoice.description;
    document.getElementById('invoice-amount').textContent = parseFloat(invoice.amount).toFixed(2);
    document.getElementById('invoice-total').textContent = parseFloat(invoice.amount).toFixed(2);
    document.getElementById('invoice-modal').classList.remove('hidden');
}

function hideInvoiceModal() {
    document.getElementById('invoice-modal').classList.add('hidden');
    currentInvoice = null;
}

function printInvoice() {
    window.print();
}

function downloadInvoice() {
    alert('PDF download functionality would be implemented here');
}

function exportBillingHistory() {
    const csv = [
        ['Invoice', 'Date', 'Description', 'Amount', 'Status'].join(','),
        ...billingHistory.map(item => [
            item.invoice_number,
            new Date(item.billing_date).toLocaleDateString(),
            item.description,
            item.amount,
            item.status
        ].join(','))
    ].join('\n');

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'billing-history.csv';
    a.click();
}

// Filtering
document.getElementById('search-billing')?.addEventListener('input', filterBillingHistory);
document.getElementById('filter-status')?.addEventListener('change', filterBillingHistory);
document.getElementById('filter-period')?.addEventListener('change', filterBillingHistory);

function filterBillingHistory() {
    const search = document.getElementById('search-billing').value.toLowerCase();
    const status = document.getElementById('filter-status').value;
    const period = parseInt(document.getElementById('filter-period').value);

    let filtered = billingHistory;

    if (search) {
        filtered = filtered.filter(item =>
            item.invoice_number?.toLowerCase().includes(search) ||
            item.description?.toLowerCase().includes(search)
        );
    }

    if (status !== 'all') {
        filtered = filtered.filter(item => item.status === status);
    }

    if (period && period !== 'all') {
        const cutoffDate = new Date();
        cutoffDate.setDate(cutoffDate.getDate() - period);
        filtered = filtered.filter(item => new Date(item.billing_date) >= cutoffDate);
    }

    displayBillingHistory(filtered);
}

// Load when section is shown
if (document.getElementById('billing-history-section').classList.contains('hidden') === false) {
    loadBillingHistory();
}
</script>

