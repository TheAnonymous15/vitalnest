    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('hidden');
        }

        // Tab switching function
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Update menu item styles
            document.querySelectorAll('#dashboard-menu, #messages-menu').forEach(menu => {
                menu.classList.remove('border-cyan-400', 'bg-gradient-to-r', 'from-cyan-400/20', 'to-cyan-400/5');
                menu.classList.add('border-transparent', 'bg-white/5');
            });

            // Highlight selected menu
            const selectedMenu = document.getElementById(tabName + '-menu');
            if (selectedMenu) {
                selectedMenu.classList.remove('border-transparent', 'bg-white/5');
                selectedMenu.classList.add('border-cyan-400', 'bg-gradient-to-r', 'from-cyan-400/20', 'to-cyan-400/5');
            }

            // Load messages if switching to messages tab
            if (tabName === 'messages') {
                loadMessages();
                startMessageRefresh(); // Start real-time refresh
            } else {
                stopMessageRefresh(); // Stop refresh when leaving messages tab
            }
        }

        function toggleSubmenu(id) {
            const submenu = document.getElementById(`${id}-submenu`);
            const icon = document.getElementById(`${id}-icon`);

            document.querySelectorAll('[id$="-submenu"]').forEach(menu => {
                if (menu.id !== `${id}-submenu`) {
                    menu.style.maxHeight = '0px';
                }
            });

            document.querySelectorAll('[id$="-icon"]').forEach(i => {
                if (i.id !== `${id}-icon`) {
                    i.style.transform = 'rotate(0deg)';
                }
            });

            if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
                submenu.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        }

        function logout() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function confirmLogout() {
            localStorage.removeItem('receptionist_user');
            localStorage.removeItem('receptionist_token');
            document.cookie = 'receptionist_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }

        function cancelLogout() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Messages Management
        let currentFilter = 'all';
        let currentSearchQuery = '';
        let allMessages = [];
        let messageRefreshInterval = null;
        let isInitialLoad = true;

        async function loadMessages(silent = false) {
            const container = document.getElementById('messages-container');
            const loading = document.getElementById('loading-messages');
            const empty = document.getElementById('empty-messages');

            // Only show loading spinner on initial load, not on background refresh
            if (!silent && isInitialLoad) {
                loading.classList.remove('hidden');
                empty.classList.add('hidden');
            }

            try {
                // Fetch both regular messages and custom plan requests
                const [messagesResponse, customPlansResponse] = await Promise.all([
                    fetch('http://localhost:9033/messages'),
                    fetch('http://localhost:9033/custom-plans')
                ]);

                const messagesResult = await messagesResponse.json();
                const customPlansResult = await customPlansResponse.json();

                if (messagesResult.success && messagesResult.data) {
                    const previousCount = allMessages.length;
                    const previousUnreadCount = allMessages.filter(m => m.status === 'unread').length;
                    const previousHighPriorityIds = allMessages.filter(m => m.priority === 'high' && m.status === 'unread').map(m => m.id);

                    // Combine messages and custom plans (mark custom plans with type)
                    allMessages = messagesResult.data.map(m => ({ ...m, type: 'message' }));

                    if (customPlansResult.success && customPlansResult.data) {
                        const customPlans = customPlansResult.data.map(cp => ({
                            ...cp,
                            type: 'custom_plan',
                            sender_email: cp.sender_email || 'N/A',
                            subject: 'Custom Care Plan Request',
                            status: cp.status === 'pending' ? 'unread' : 'read'
                        }));
                        allMessages = [...allMessages, ...customPlans];
                    }

                    // Sort by created_at desc
                    allMessages.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                    // Check if there are new messages
                    const currentCount = allMessages.length;
                    const currentUnreadCount = allMessages.filter(m => m.status === 'unread').length;
                    const currentHighPriorityMessages = allMessages.filter(m => m.priority === 'high' && m.status === 'unread');

                    // Detect new high priority messages
                    if (silent && currentHighPriorityMessages.length > 0) {
                        const newHighPriorityMessages = currentHighPriorityMessages.filter(m => !previousHighPriorityIds.includes(m.id));

                        // Show popup for each new high priority message
                        newHighPriorityMessages.forEach(msg => {
                            showHighPriorityMessagePopup(msg);
                        });
                    }

                    // Show subtle notification if new messages arrived (only on silent refresh)
                    if (silent && currentCount > previousCount) {
                        const newMessagesCount = currentCount - previousCount;
                        const highPriorityCount = newHighPriorityMessages?.length || 0;

                        // Only show notification for non-high priority messages (high priority get popup)
                        if (newMessagesCount > highPriorityCount) {
                            showNewMessageNotification(newMessagesCount - highPriorityCount);
                        }
                    }

                    displayMessages(allMessages);
                    updateMessageCounts();

                    isInitialLoad = false;
                } else {
                    throw new Error('Failed to load messages');
                }
            } catch (error) {
                console.error('Error loading messages:', error);

                // Only show error UI on initial load
                if (!silent && isInitialLoad) {
                    container.innerHTML = `
                        <div class="text-center py-12">
                            <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-3"></i>
                            <p class="text-white/60">Error loading messages</p>
                            <p class="text-white/40 text-sm">${error.message}</p>
                        </div>
                    `;
                }
            } finally {
                if (!silent && isInitialLoad) {
                    loading.classList.add('hidden');
                }
            }
        }

        // Show notification when new messages arrive
        function showNewMessageNotification(count) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-50 transform transition-all duration-500 animate-slideInRight';

            notification.innerHTML = `
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-lg shadow-2xl border border-cyan-400/30 flex items-center gap-3">
                    <i class="fas fa-envelope text-xl"></i>
                    <div>
                        <p class="font-bold text-sm">${count} New Message${count > 1 ? 's' : ''}</p>
                        <p class="text-xs text-white/90">Just received</p>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }


        // Show stunning high priority message popup
        function showHighPriorityMessagePopup(msg) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-lg animate-fadeIn';
            modal.id = `high-priority-modal-${msg.id}`;

            const date = new Date(msg.created_at);

            modal.innerHTML = `
                <div class="relative max-w-lg w-full transform transition-all animate-scaleIn">
                    <!-- Animated Background Effects -->
                    <div class="absolute -inset-3 bg-gradient-to-r from-red-500/30 via-orange-500/30 to-red-500/30 rounded-2xl blur-xl animate-pulse"></div>

                    <!-- Main Content Card -->
                    <div class="relative bg-gradient-to-br from-slate-900/98 via-slate-800/98 to-slate-900/98 backdrop-blur-xl rounded-xl border-2 border-red-500/50 shadow-2xl overflow-hidden">

                        <!-- Compact Header -->
                        <div class="relative bg-gradient-to-r from-red-600/30 via-orange-600/30 to-red-600/30 border-b border-red-500/50 p-4">
                            <div class="flex items-center gap-3">
                                <!-- Alert Icon -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-red-500 rounded-full blur-lg animate-ping"></div>
                                    <div class="relative w-12 h-12 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-exclamation-circle text-white text-xl"></i>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 bg-red-500/30 border border-red-400/50 rounded text-red-300 text-xs font-black uppercase">⚠️ High Priority</span>
                                        <span class="px-2 py-0.5 bg-green-500/20 border border-green-400/40 rounded text-green-300 text-xs font-bold uppercase">New</span>
                                    </div>
                                    <h2 class="text-lg font-black text-white">Urgent Message!</h2>
                                </div>

                                <button onclick="this.closest('.fixed').remove()" class="w-8 h-8 bg-white/10 hover:bg-red-500/30 rounded-full flex items-center justify-center transition-all">
                                    <i class="fas fa-times text-white/60 hover:text-white text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Compact Content -->
                        <div class="p-4 space-y-3">
                            <!-- Sender Info -->
                            <div class="flex items-center gap-3 bg-gradient-to-br from-red-500/10 to-orange-500/10 border border-red-500/30 rounded-lg p-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                    ${msg.sender_name.charAt(0).toUpperCase()}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-white font-bold text-sm truncate">${escapeHtml(msg.sender_name)}</h3>
                                    <div class="flex items-center gap-2 text-xs text-white/60">
                                        <i class="fas fa-envelope text-red-400"></i>
                                        <span class="truncate">${escapeHtml(msg.sender_email)}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="bg-white/5 border border-white/10 rounded-lg p-3">
                                <p class="text-white font-semibold text-sm mb-1">${escapeHtml(msg.subject)}</p>
                                <p class="text-white/70 text-xs line-clamp-2">${escapeHtml(msg.message)}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 border-t border-red-500/30 p-3">
                            <div class="grid grid-cols-2 gap-2 mb-2">
                                <!-- View Full Message -->
                                <button onclick="showMessagePreview(${msg.id}); this.closest('.fixed').remove();" class="px-3 py-2 bg-gradient-to-r from-red-500 to-orange-600 hover:from-red-600 hover:to-orange-700 text-white font-semibold rounded-lg transition-all hover:scale-105 transform text-xs flex items-center justify-center gap-1.5">
                                    <i class="fas fa-eye"></i>
                                    <span>View Full</span>
                                </button>

                                <!-- Mark as Read -->
                                <button onclick="markAsRead(${msg.id}); this.closest('.fixed').remove();" class="px-3 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-lg transition-all hover:scale-105 transform text-xs flex items-center justify-center gap-1.5">
                                    <i class="fas fa-check"></i>
                                    <span>Mark Read</span>
                                </button>
                            </div>

                            <div class="grid grid-cols-3 gap-2">
                                <!-- Forward to Person -->
                                <button onclick="event.stopPropagation(); toggleUrgentForwardPerson(${msg.id})" class="relative px-3 py-2 bg-cyan-500/20 hover:bg-cyan-500/30 border border-cyan-400/30 text-cyan-300 font-semibold rounded-lg transition-all text-xs flex items-center justify-center gap-1.5">
                                    <i class="fas fa-user"></i>
                                    <span>Person</span>
                                    <!-- Dropdown -->
                                    <div id="urgent-forward-person-${msg.id}" class="hidden absolute bottom-full left-0 mb-1 w-40 bg-slate-900/98 backdrop-blur-xl border border-cyan-400/30 rounded-lg shadow-2xl overflow-hidden z-50">
                                        <div class="p-1">
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'doctor'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-cyan-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-user-md text-cyan-400 w-3"></i>
                                                <span>Doctor</span>
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'nurse'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-cyan-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-user-nurse text-cyan-400 w-3"></i>
                                                <span>Nurse</span>
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'admin'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-cyan-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-user-shield text-cyan-400 w-3"></i>
                                                <span>Admin</span>
                                            </button>
                                        </div>
                                    </div>
                                </button>

                                <!-- Forward to Department -->
                                <button onclick="event.stopPropagation(); toggleUrgentForwardDept(${msg.id})" class="relative px-3 py-2 bg-purple-500/20 hover:bg-purple-500/30 border border-purple-400/30 text-purple-300 font-semibold rounded-lg transition-all text-xs flex items-center justify-center gap-1.5">
                                    <i class="fas fa-building"></i>
                                    <span>Dept</span>
                                    <!-- Dropdown -->
                                    <div id="urgent-forward-dept-${msg.id}" class="hidden absolute bottom-full left-0 mb-1 w-40 bg-slate-900/98 backdrop-blur-xl border border-purple-400/30 rounded-lg shadow-2xl overflow-hidden z-50">
                                        <div class="p-1">
                                            <button onclick="event.stopPropagation(); forwardToDepartment(${msg.id}, 'medical'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-purple-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-stethoscope text-purple-400 w-3"></i>
                                                <span>Medical</span>
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardToDepartment(${msg.id}, 'lab'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-purple-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-flask text-purple-400 w-3"></i>
                                                <span>Lab</span>
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardToDepartment(${msg.id}, 'pharmacy'); this.closest('.fixed').remove();" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-purple-400/20 rounded text-xs flex items-center gap-2">
                                                <i class="fas fa-pills text-purple-400 w-3"></i>
                                                <span>Pharmacy</span>
                                            </button>
                                        </div>
                                    </div>
                                </button>

                                <!-- Reply -->
                                <button onclick="window.location.href='mailto:${escapeHtml(msg.sender_email)}?subject=Re: ${encodeURIComponent(msg.subject)}'; this.closest('.fixed').remove();" class="px-3 py-2 bg-orange-500/20 hover:bg-orange-500/30 border border-orange-400/30 text-orange-300 font-semibold rounded-lg transition-all text-xs flex items-center justify-center gap-1.5">
                                    <i class="fas fa-reply"></i>
                                    <span>Reply</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Play alert sound
            try {
                const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIGWi75+adTQ==');
                audio.play().catch(() => {});
            } catch (e) {}
        }

        // Toggle forward person dropdown in urgent modal
        function toggleUrgentForwardPerson(msgId) {
            const menu = document.getElementById(`urgent-forward-person-${msgId}`);
            const deptMenu = document.getElementById(`urgent-forward-dept-${msgId}`);
            if (deptMenu) deptMenu.classList.add('hidden');
            menu?.classList.toggle('hidden');
        }

        // Toggle forward department dropdown in urgent modal
        function toggleUrgentForwardDept(msgId) {
            const menu = document.getElementById(`urgent-forward-dept-${msgId}`);
            const personMenu = document.getElementById(`urgent-forward-person-${msgId}`);
            if (personMenu) personMenu.classList.add('hidden');
            menu?.classList.toggle('hidden');
        }

        // Start real-time message refresh
        function startMessageRefresh() {
            // Clear any existing interval
            if (messageRefreshInterval) {
                clearInterval(messageRefreshInterval);
            }

            // Refresh messages every 10 seconds in the background
            messageRefreshInterval = setInterval(() => {
                loadMessages(true); // Silent refresh
            }, 10000);
        }

        // Stop real-time message refresh
        function stopMessageRefresh() {
            if (messageRefreshInterval) {
                clearInterval(messageRefreshInterval);
                messageRefreshInterval = null;
            }
        }

        function displayMessages(messages) {
            const container = document.getElementById('messages-container');
            const empty = document.getElementById('empty-messages');
            const loading = document.getElementById('loading-messages');

            loading.classList.add('hidden');

            if (!messages || messages.length === 0) {
                empty.classList.remove('hidden');
                container.innerHTML = '';
                return;
            }

            empty.classList.add('hidden');

            // Apply filter
            let filteredMessages = currentFilter === 'all'
                ? messages
                : currentFilter === 'high'
                ? messages.filter(m => m.priority === 'high')
                : currentFilter === 'custom_plan'
                ? messages.filter(m => m.type === 'custom_plan')
                : messages.filter(m => m.status === currentFilter);

            // Apply search query
            if (currentSearchQuery.trim()) {
                const query = currentSearchQuery.toLowerCase().trim();
                filteredMessages = filteredMessages.filter(m => {
                    return (
                        m.sender_name.toLowerCase().includes(query) ||
                        m.sender_email.toLowerCase().includes(query) ||
                        (m.sender_phone && m.sender_phone.toLowerCase().includes(query)) ||
                        m.message.toLowerCase().includes(query) ||
                        m.subject.toLowerCase().includes(query)
                    );
                });
            }

            if (filteredMessages.length === 0) {
                empty.classList.remove('hidden');
                container.innerHTML = '';
                return;
            }

            // Modern compact message list
            container.innerHTML = filteredMessages.map(msg => {
                const priorityConfig = {
                    high: { icon: 'fa-circle', color: 'text-red-400', bg: 'bg-red-500/10', border: 'border-red-500/30' },
                    medium: { icon: 'fa-circle', color: 'text-amber-400', bg: 'bg-amber-500/10', border: 'border-amber-500/30' },
                    normal: { icon: 'fa-circle', color: 'text-blue-400', bg: 'bg-blue-500/10', border: 'border-blue-500/30' }
                };

                const priority = priorityConfig[msg.priority] || priorityConfig.normal;
                const isUnread = msg.status === 'unread';
                const date = new Date(msg.created_at);
                const timeAgo = getTimeAgo(date);

                return `
                    <div onclick="showMessagePreview(${msg.id})"
                         id="msg-item-${msg.id}"
                         class="message-item group cursor-pointer backdrop-blur-md hover:bg-white/5 transition-all duration-200 border-b border-white/10 last:border-b-0">

                        <div class="p-3">
                            <!-- Header Row: Avatar, Name, Time, Status -->
                            <div class="flex items-center gap-2 mb-2">
                                <!-- Unread Indicator -->
                                ${isUnread ? '<div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse flex-shrink-0"></div>' : '<div class="w-2 flex-shrink-0"></div>'}

                                <!-- Avatar -->
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500/20 to-cyan-500/20 flex items-center justify-center text-white font-bold text-xs border border-white/10 flex-shrink-0">
                                    ${msg.sender_name.charAt(0).toUpperCase()}
                                </div>

                                <!-- Name -->
                                <h4 class="text-white ${isUnread ? 'font-bold' : 'font-medium'} text-sm truncate flex-1">
                                    ${escapeHtml(msg.sender_name)}
                                </h4>

                                <!-- Time -->
                                <span class="text-white/40 text-xs whitespace-nowrap flex-shrink-0">${timeAgo}</span>
                            </div>

                            <!-- Subject Row -->
                            <div class="flex items-start gap-2 mb-1.5 ml-10">
                                <i class="fas ${priority.icon} ${priority.color} text-xs mt-0.5 flex-shrink-0"></i>
                                <p class="text-white/90 ${isUnread ? 'font-semibold' : 'font-normal'} text-xs truncate flex-1">
                                    ${escapeHtml(msg.subject)}
                                </p>
                            </div>

                            <!-- Message Preview -->
                            <p class="text-white/50 text-xs truncate ml-10 mb-2">
                                ${escapeHtml(msg.message)}
                            </p>

                            <!-- Footer: Email & Actions -->
                            <div class="flex items-center justify-between gap-2 ml-10">
                                <div class="flex items-center gap-2 flex-1 min-w-0">
                                    ${msg.priority !== 'normal' ? `
                                        <span class="px-2 py-0.5 ${priority.bg} ${priority.color} rounded text-[10px] font-bold uppercase border ${priority.border} flex-shrink-0">
                                            ${msg.priority}
                                        </span>
                                    ` : ''}
                                    <span class="text-white/40 text-xs truncate">
                                        <i class="fas fa-envelope text-[10px] mr-1"></i>${escapeHtml(msg.sender_email)}
                                    </span>
                                </div>

                                <!-- Quick Actions -->
                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
                                    ${isUnread ? `
                                        <button onclick="event.stopPropagation(); markAsRead(${msg.id})"
                                                class="w-6 h-6 flex items-center justify-center rounded hover:bg-green-500/20 text-green-400 transition-all"
                                                title="Mark read">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                    ` : ''}
                                    <button onclick="event.stopPropagation(); toggleForwardMenu(${msg.id})"
                                            class="w-6 h-6 flex items-center justify-center rounded hover:bg-cyan-500/20 text-cyan-400 transition-all"
                                            title="Forward">
                                        <i class="fas fa-share text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Forward Dropdown (Hidden by default) -->
                            <div id="forward-menu-${msg.id}" class="hidden absolute right-2 mt-2 w-48 bg-slate-900/98 backdrop-blur-xl border border-white/20 rounded-lg shadow-2xl overflow-hidden z-50">
                                <div class="p-1.5">
                                    <div class="text-white/50 text-xs font-semibold px-2 py-1.5 border-b border-white/10 mb-1">Forward to:</div>
                                    <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'doctor')" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-white/10 rounded text-xs transition-all hover:text-white flex items-center gap-2">
                                        <i class="fas fa-user-md text-cyan-400 w-4 text-xs"></i>
                                        <span>Doctor</span>
                                    </button>
                                    <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'nurse')" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-white/10 rounded text-xs transition-all hover:text-white flex items-center gap-2">
                                        <i class="fas fa-user-nurse text-cyan-400 w-4 text-xs"></i>
                                        <span>Nurse</span>
                                    </button>
                                    <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'admin')" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-white/10 rounded text-xs transition-all hover:text-white flex items-center gap-2">
                                        <i class="fas fa-user-shield text-cyan-400 w-4 text-xs"></i>
                                        <span>Admin</span>
                                    </button>
                                    <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'hr')" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-white/10 rounded text-xs transition-all hover:text-white flex items-center gap-2">
                                        <i class="fas fa-users text-cyan-400 w-4 text-xs"></i>
                                        <span>HR</span>
                                    </button>
                                    <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'billing')" class="w-full text-left px-2 py-1.5 text-white/80 hover:bg-white/10 rounded text-xs transition-all hover:text-white flex items-center gap-2">
                                        <i class="fas fa-file-invoice-dollar text-cyan-400 w-4 text-xs"></i>
                                        <span>Billing</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Show message preview in right pane
        function showMessagePreview(messageId) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            // Highlight selected message
            document.querySelectorAll('.message-item').forEach(item => {
                item.classList.remove('bg-purple-500/5', 'selected-message');
                item.style.borderLeft = '';
            });
            const selectedItem = document.getElementById(`msg-item-${messageId}`);
            if (selectedItem) {
                selectedItem.classList.add('bg-purple-500/5', 'selected-message');
                selectedItem.style.borderLeft = '3px solid rgb(168, 85, 247)';
            }

            // Mark as read if unread
            if (msg.status === 'unread') {
                markAsRead(messageId);
            }

            // Open reply panel
            openReplyPanel(messageId);

            const priorityConfig = {
                high: { color: 'red', icon: 'fa-exclamation-circle', label: 'High Priority', gradient: 'from-red-500 to-red-600' },
                medium: { color: 'amber', icon: 'fa-flag', label: 'Medium Priority', gradient: 'from-amber-500 to-amber-600' },
                normal: { color: 'blue', icon: 'fa-info-circle', label: 'Normal Priority', gradient: 'from-blue-500 to-blue-600' }
            };

            const config = priorityConfig[msg.priority] || priorityConfig.normal;
            const date = new Date(msg.created_at);

            const previewPane = document.getElementById('message-preview');
            previewPane.innerHTML = `
                <div class="h-full flex flex-col">

                    <!-- Message Header - Compact -->
                    <div class="flex-shrink-0 border-b border-white/10 backdrop-blur-md">
                        <!-- Top Bar with Subject -->
                        <div class="p-6 pb-4">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-white mb-2 leading-tight">${escapeHtml(msg.subject)}</h2>
                                    <div class="flex items-center gap-3 flex-wrap">
                                        <!-- Priority Badge -->
                                        <div class="flex items-center gap-2 px-3 py-1.5 bg-${config.color}-500/10 border border-${config.color}-400/30 rounded-lg">
                                            <i class="fas ${config.icon} ${config.color === 'red' ? 'text-red-400' : config.color === 'amber' ? 'text-amber-400' : 'text-blue-400'} text-sm"></i>
                                            <span class="${config.color === 'red' ? 'text-red-300' : config.color === 'amber' ? 'text-amber-300' : 'text-blue-300'} text-xs font-bold uppercase">${config.label}</span>
                                        </div>
                                        <!-- Timestamp -->
                                        <div class="flex items-center gap-2 text-white/50 text-sm">
                                            <i class="fas fa-clock text-xs"></i>
                                            <span>${date.toLocaleString('en-US', {
                                                weekday: 'short',
                                                year: 'numeric',
                                                month: 'short',
                                                day: 'numeric',
                                                hour: '2-digit',
                                                minute: '2-digit'
                                            })}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sender Information Card -->
                            <div class="backdrop-blur-md rounded-xl border border-white/10 p-4">
                                <div class="flex items-start gap-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-br ${config.gradient} rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg ring-2 ring-white/10">
                                            ${msg.sender_name.charAt(0).toUpperCase()}
                                        </div>
                                    </div>

                                    <!-- Sender Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-baseline gap-2 mb-1">
                                            <h3 class="text-white font-bold text-lg">${escapeHtml(msg.sender_name)}</h3>
                                            <span class="text-white/40 text-xs">Sender</span>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2 text-white/70 text-sm">
                                                <i class="fas fa-envelope w-4 text-cyan-400"></i>
                                                <a href="mailto:${escapeHtml(msg.sender_email)}" class="hover:text-cyan-400 transition-colors">${escapeHtml(msg.sender_email)}</a>
                                            </div>
                                            ${msg.sender_phone ? `
                                                <div class="flex items-center gap-2 text-white/70 text-sm">
                                                    <i class="fas fa-phone w-4 text-green-400"></i>
                                                    <a href="tel:${escapeHtml(msg.sender_phone)}" class="hover:text-green-400 transition-colors">${escapeHtml(msg.sender_phone)}</a>
                                                </div>
                                            ` : ''}
                                            <div class="flex items-center gap-2 text-white/50 text-xs mt-2">
                                                <i class="fas fa-hashtag w-4"></i>
                                                <span>Message ID: ${msg.id}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quick Stats -->
                                    <div class="flex-shrink-0 text-right">
                                        <div class="backdrop-blur-md rounded-lg px-3 py-2 border border-white/10">
                                            <div class="text-white/50 text-xs mb-1">Status</div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full ${msg.status === 'unread' ? 'bg-green-400 animate-pulse' : 'bg-slate-400'}"></div>
                                                <span class="text-white text-sm font-semibold capitalize">${msg.status}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Body - Enhanced -->
                    <div class="flex-1 overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-purple-500/30 scrollbar-track-transparent">
                        <div class="max-w-4xl">
                            <!-- Message Label -->
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-comment-alt text-purple-400"></i>
                                <h4 class="text-white/60 text-sm font-semibold uppercase tracking-wide">Message Content</h4>
                                <div class="flex-1 h-px bg-gradient-to-r from-purple-400/30 to-transparent"></div>
                            </div>

                            <!-- Message Text -->
                            <div class="backdrop-blur-md rounded-xl p-6 border border-white/10">
                                <p class="text-white/90 text-base leading-relaxed whitespace-pre-wrap">${escapeHtml(msg.message)}</p>
                            </div>

                            <!-- Message Metadata -->
                            <div class="mt-6 grid grid-cols-2 gap-4">
                                <!-- Received -->
                                <div class="backdrop-blur-md rounded-lg p-4 border border-white/10">
                                    <div class="flex items-center gap-2 text-white/50 text-xs mb-2">
                                        <i class="fas fa-calendar-check"></i>
                                        <span class="uppercase tracking-wide">Received</span>
                                    </div>
                                    <p class="text-white text-sm font-semibold">${date.toLocaleDateString('en-US', {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    })}</p>
                                    <p class="text-white/70 text-xs">${date.toLocaleTimeString('en-US', {
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit'
                                    })}</p>
                                </div>

                                <!-- Response Time -->
                                <div class="backdrop-blur-md rounded-lg p-4 border border-white/10">
                                    <div class="flex items-center gap-2 text-white/50 text-xs mb-2">
                                        <i class="fas fa-clock"></i>
                                        <span class="uppercase tracking-wide">Time Elapsed</span>
                                    </div>
                                    <p class="text-white text-sm font-semibold">${getTimeAgo(date)}</p>
                                    <p class="text-white/70 text-xs">${msg.status === 'unread' ? 'Awaiting response' : 'Message read'}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Bar - Compact -->
                    <div class="flex-shrink-0 backdrop-blur-md border-t border-white/10 p-3">
                        <div class="flex items-center gap-2">
                            <!-- Mark as Read Button -->
                            ${msg.status === 'unread' ? `
                                <button onclick="markAsRead(${msg.id})"
                                        class="flex-1 px-3 py-2 bg-gradient-to-r from-green-500/20 to-emerald-500/20 hover:from-green-500/30 hover:to-emerald-500/30 text-green-300 font-medium rounded-lg transition-all border border-green-400/30 flex items-center justify-center gap-2 text-sm">
                                    <i class="fas fa-check text-xs"></i>
                                    <span>Mark Read</span>
                                </button>
                            ` : ''}

                            <!-- Forward to Person Dropdown -->
                            <div class="relative flex-1">
                                <button onclick="toggleForwardMenu('preview-${msg.id}')"
                                        class="w-full px-3 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 hover:from-cyan-500/30 hover:to-blue-500/30 text-cyan-300 font-medium rounded-lg transition-all border border-cyan-400/30 flex items-center justify-center gap-2 text-sm">
                                    <i class="fas fa-share text-xs"></i>
                                    <span>Forward to Person</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div id="forward-menu-preview-${msg.id}" class="hidden absolute bottom-full left-0 mb-2 w-56 bg-slate-800/98 backdrop-blur-xl border border-cyan-400/30 rounded-lg shadow-2xl overflow-hidden z-50">
                                    <div class="p-2">
                                        <div class="text-white/50 text-xs font-semibold px-3 py-2 mb-1 border-b border-white/10">Forward to:</div>
                                        <button onclick="forwardMessage(${msg.id}, 'doctor')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-user-md text-cyan-400 w-4"></i>
                                            <span>Doctor</span>
                                        </button>
                                        <button onclick="forwardMessage(${msg.id}, 'nurse')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-user-nurse text-cyan-400 w-4"></i>
                                            <span>Nurse</span>
                                        </button>
                                        <button onclick="forwardMessage(${msg.id}, 'admin')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-user-shield text-cyan-400 w-4"></i>
                                            <span>Admin</span>
                                        </button>
                                        <button onclick="forwardMessage(${msg.id}, 'hr')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-users text-cyan-400 w-4"></i>
                                            <span>HR</span>
                                        </button>
                                        <button onclick="forwardMessage(${msg.id}, 'billing')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-file-invoice-dollar text-cyan-400 w-4"></i>
                                            <span>Billing</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Forward to Department Dropdown -->
                            <div class="relative flex-1">
                                <button onclick="toggleForwardDeptMenu('preview-${msg.id}')"
                                        class="w-full px-3 py-2 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 text-purple-300 font-medium rounded-lg transition-all border border-purple-400/30 flex items-center justify-center gap-2 text-sm">
                                    <i class="fas fa-building text-xs"></i>
                                    <span>Forward to Dept</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div id="forward-dept-menu-preview-${msg.id}" class="hidden absolute bottom-full left-0 mb-2 w-56 bg-slate-800/98 backdrop-blur-xl border border-purple-400/30 rounded-lg shadow-2xl overflow-hidden z-50">
                                    <div class="p-2">
                                        <div class="text-white/50 text-xs font-semibold px-3 py-2 mb-1 border-b border-white/10">Forward to Department:</div>
                                        <button onclick="forwardToDepartment(${msg.id}, 'medical')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-stethoscope text-purple-400 w-4"></i>
                                            <span>Medical</span>
                                        </button>
                                        <button onclick="forwardToDepartment(${msg.id}, 'nursing')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-user-nurse text-purple-400 w-4"></i>
                                            <span>Nursing</span>
                                        </button>
                                        <button onclick="forwardToDepartment(${msg.id}, 'lab')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-flask text-purple-400 w-4"></i>
                                            <span>Laboratory</span>
                                        </button>
                                        <button onclick="forwardToDepartment(${msg.id}, 'pharmacy')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-pills text-purple-400 w-4"></i>
                                            <span>Pharmacy</span>
                                        </button>
                                        <button onclick="forwardToDepartment(${msg.id}, 'billing')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-file-invoice-dollar text-purple-400 w-4"></i>
                                            <span>Billing</span>
                                        </button>
                                        <button onclick="forwardToDepartment(${msg.id}, 'hr')" class="w-full text-left px-3 py-2 text-white/80 hover:bg-purple-400/20 rounded-md text-sm transition-all hover:text-white flex items-center gap-2">
                                            <i class="fas fa-users text-purple-400 w-4"></i>
                                            <span>HR</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Expand Button -->
                            <button onclick="viewMessage(${msg.id})"
                                    class="px-3 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all text-sm border border-white/20"
                                    title="Full screen view">
                                <i class="fas fa-expand-alt text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function getTimeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            const intervals = {
                year: 31536000,
                month: 2592000,
                week: 604800,
                day: 86400,
                hour: 3600,
                minute: 60
            };

            for (const [unit, secondsInUnit] of Object.entries(intervals)) {
                const interval = Math.floor(seconds / secondsInUnit);
                if (interval >= 1) {
                    return `${interval} ${unit}${interval !== 1 ? 's' : ''} ago`;
                }
            }
            return 'Just now';
        }

        function filterMessages(filter) {
            currentFilter = filter;

            // Update button styles
            const activeClass = 'px-4 py-2 backdrop-blur-md text-purple-300 rounded-lg text-sm font-semibold transition-all border border-purple-400/30 hover:border-purple-400/50 hover:scale-105 transform flex items-center gap-2';
            const inactiveClass = 'px-4 py-2 backdrop-blur-md text-white/70 rounded-lg text-sm font-semibold transition-all hover:scale-105 transform border border-white/10 flex items-center gap-2';

            document.getElementById('filter-all').className = filter === 'all' ? activeClass : inactiveClass;
            document.getElementById('filter-unread').className = filter === 'unread' ? activeClass : inactiveClass;
            document.getElementById('filter-read').className = filter === 'read' ? activeClass : inactiveClass;
            document.getElementById('filter-high').className = filter === 'high' ? activeClass : inactiveClass;
            document.getElementById('filter-custom_plan').className = filter === 'custom_plan' ? activeClass : inactiveClass;

            displayMessages(allMessages);
        }

        // Search messages function
        function searchMessages(query) {
            currentSearchQuery = query;

            const clearBtn = document.getElementById('clear-search');
            const counter = document.getElementById('search-counter');

            if (query.trim()) {
                clearBtn.classList.remove('hidden');

                // Calculate match count
                const searchQuery = query.toLowerCase().trim();
                const matchCount = allMessages.filter(m => {
                    return (
                        m.sender_name.toLowerCase().includes(searchQuery) ||
                        m.sender_email.toLowerCase().includes(searchQuery) ||
                        (m.sender_phone && m.sender_phone.toLowerCase().includes(searchQuery)) ||
                        m.message.toLowerCase().includes(searchQuery) ||
                        m.subject.toLowerCase().includes(searchQuery)
                    );
                }).length;

                // Show counter with match count
                counter.textContent = matchCount;
                counter.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
                counter.classList.add('hidden');
            }

            // Re-display messages with search applied
            displayMessages(allMessages);
        }

        // Clear search function
        function clearSearch() {
            currentSearchQuery = '';
            document.getElementById('message-search').value = '';
            document.getElementById('clear-search').classList.add('hidden');
            document.getElementById('search-counter').classList.add('hidden');
            displayMessages(allMessages);
        }

        function updateMessageCounts() {
            const total = allMessages.length;
            const unread = allMessages.filter(m => m.status === 'unread').length;
            const read = allMessages.filter(m => m.status === 'read').length;
            const high = allMessages.filter(m => m.priority === 'high').length;
            const customPlan = allMessages.filter(m => m.type === 'custom_plan').length;

            document.getElementById('count-all').textContent = total;
            document.getElementById('count-unread').textContent = unread;
            document.getElementById('count-read').textContent = read;
            document.getElementById('count-high').textContent = high;
            document.getElementById('count-custom_plan').textContent = customPlan;

            // Update sidebar badge
            const badge = document.getElementById('unread-badge');
            if (unread > 0) {
                badge.textContent = unread;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        async function markAsRead(messageId) {
            // Update locally
            const msg = allMessages.find(m => m.id === messageId);
            if (msg) {
                msg.status = 'read';
                displayMessages(allMessages);
                updateMessageCounts();
            }
        }

        function viewMessage(messageId) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            const priorityConfig = {
                high: { color: 'red', icon: 'fa-exclamation-circle', label: 'High Priority' },
                medium: { color: 'amber', icon: 'fa-flag', label: 'Medium Priority' },
                normal: { color: 'blue', icon: 'fa-info-circle', label: 'Normal Priority' }
            };

            const config = priorityConfig[msg.priority] || priorityConfig.normal;
            const date = new Date(msg.created_at);

            // Create modal
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-md animate-fadeIn';
            modal.onclick = (e) => { if (e.target === modal) modal.remove(); };

            modal.innerHTML = `
                <div class="relative w-full max-w-3xl transform transition-all animate-scaleIn">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-3xl blur-2xl"></div>
                    <div class="relative bg-gradient-to-br from-slate-800/95 to-slate-900/95 backdrop-blur-xl rounded-3xl border border-purple-400/30 shadow-2xl overflow-hidden">

                        <!-- Header -->
                        <div class="relative bg-gradient-to-r from-purple-600/20 to-pink-600/20 border-b border-white/10 p-6">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10"></div>
                            <div class="relative flex items-start justify-between">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-envelope-open text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-white mb-2">${escapeHtml(msg.subject)}</h3>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="px-3 py-1 ${msg.status === 'unread' ? 'bg-green-500/20 text-green-300 border-green-400/40' : 'bg-slate-500/20 text-slate-300 border-slate-400/40'} rounded-lg text-xs font-bold border">
                                                ${msg.status.toUpperCase()}
                                            </span>
                                            <span class="px-3 py-1 bg-${config.color}-500/20 text-${config.color}-300 border-${config.color}-400/40 rounded-lg text-xs font-bold border">
                                                <i class="fas ${config.icon} mr-1"></i>${config.label}
                                            </span>
                                            <span class="px-3 py-1 bg-white/10 text-white/70 rounded-lg text-xs">
                                                <i class="fas fa-clock mr-1"></i>${date.toLocaleString()}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="this.closest('.fixed').remove()" class="text-white/60 hover:text-white transition-all hover:rotate-90 transform duration-300">
                                    <i class="fas fa-times text-2xl"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 space-y-6">
                            <!-- Sender Info Card -->
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 rounded-xl blur-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6">
                                    <h4 class="text-white/60 text-sm font-semibold mb-4 flex items-center gap-2">
                                        <i class="fas fa-user-circle text-cyan-400"></i>
                                        Sender Information
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-white/50 text-xs mb-1">Name</p>
                                            <p class="text-white font-semibold text-lg">${escapeHtml(msg.sender_name)}</p>
                                        </div>
                                        <div>
                                            <p class="text-white/50 text-xs mb-1">Email</p>
                                            <p class="text-white/90">${escapeHtml(msg.sender_email)}</p>
                                        </div>
                                        ${msg.sender_phone ? `
                                            <div>
                                                <p class="text-white/50 text-xs mb-1">Phone</p>
                                                <p class="text-white/90">${escapeHtml(msg.sender_phone)}</p>
                                            </div>
                                        ` : ''}
                                        <div>
                                            <p class="text-white/50 text-xs mb-1">Message ID</p>
                                            <p class="text-white/70 font-mono text-sm">#${msg.id}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Content -->
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-xl blur-lg opacity-50 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6">
                                    <h4 class="text-white/60 text-sm font-semibold mb-4 flex items-center gap-2">
                                        <i class="fas fa-comment-alt text-purple-400"></i>
                                        Message Content
                                    </h4>
                                    <div class="bg-slate-900/50 rounded-lg p-4 border border-white/5">
                                        <p class="text-white/90 whitespace-pre-wrap leading-relaxed">${escapeHtml(msg.message)}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 border-t border-white/10 p-6">
                            <div class="flex flex-wrap gap-3">
                                ${msg.status === 'unread' ? `
                                    <button onclick="markAsRead(${msg.id}); this.closest('.fixed').remove();" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all hover:scale-105 transform">
                                        <i class="fas fa-check mr-2"></i>Mark as Read
                                    </button>
                                ` : ''}
                                <div class="relative flex-1 group/forward">
                                    <button onclick="event.stopPropagation(); toggleForwardMenu('modal-${msg.id}')" class="w-full px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all hover:scale-105 transform">
                                        <i class="fas fa-share mr-2"></i>Forward to Department
                                    </button>
                                    <!-- Forward Dropdown Menu -->
                                    <div id="forward-menu-modal-${msg.id}" class="hidden absolute bottom-full left-0 mb-2 w-full bg-slate-800/95 backdrop-blur-xl border border-cyan-400/30 rounded-lg shadow-2xl overflow-hidden z-50">
                                        <div class="p-2">
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'doctor'); this.closest('.fixed').remove();" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white">
                                                <i class="fas fa-user-md mr-2 text-cyan-400"></i>Doctor Department
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'nurse'); this.closest('.fixed').remove();" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white">
                                                <i class="fas fa-user-nurse mr-2 text-cyan-400"></i>Nursing Department
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'admin'); this.closest('.fixed').remove();" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white">
                                                <i class="fas fa-user-shield mr-2 text-cyan-400"></i>Administration
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'hr'); this.closest('.fixed').remove();" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white">
                                                <i class="fas fa-users mr-2 text-cyan-400"></i>HR Department
                                            </button>
                                            <button onclick="event.stopPropagation(); forwardMessage(${msg.id}, 'billing'); this.closest('.fixed').remove();" class="w-full text-left px-3 py-2 text-white/80 hover:bg-cyan-400/20 rounded-md text-sm transition-all hover:text-white">
                                                <i class="fas fa-file-invoice-dollar mr-2 text-cyan-400"></i>Billing Department
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="window.location.href='mailto:${escapeHtml(msg.sender_email)}?subject=Re: ${encodeURIComponent(msg.subject)}'" class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all hover:scale-105 transform">
                                    <i class="fas fa-reply mr-2"></i>Reply via Email
                                </button>
                                <button onclick="this.closest('.fixed').remove()" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all hover:scale-105 transform">
                                    <i class="fas fa-times mr-2"></i>Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            if (msg.status === 'unread') {
                markAsRead(messageId);
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Reply Panel Functions
        let currentReplyMessage = null;

        function openReplyPanel(messageId) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            currentReplyMessage = msg;

            // Show reply form, hide empty state
            document.getElementById('reply-empty-state').classList.add('hidden');
            document.getElementById('reply-form-container').classList.remove('hidden');

            // Populate form
            document.getElementById('reply-to-name').innerHTML = `To: <span class="text-white">${escapeHtml(msg.sender_name)} (${escapeHtml(msg.sender_email)})</span>`;
            document.getElementById('reply-subject').value = `Re: ${msg.subject}`;
            document.getElementById('reply-message').value = '';
            document.getElementById('reply-message').focus();
        }

        function closeReplyPanel() {
            currentReplyMessage = null;
            document.getElementById('reply-empty-state').classList.remove('hidden');
            document.getElementById('reply-form-container').classList.add('hidden');
            document.getElementById('reply-subject').value = '';
            document.getElementById('reply-message').value = '';
        }

        function insertTemplate(templateType) {
            const templates = {
                greeting: `Dear ${currentReplyMessage ? currentReplyMessage.sender_name : '[Name]'},\n\nThank you for contacting VitalNest. `,
                thanks: `Thank you for reaching out to us. We appreciate your inquiry and are here to help.\n\n`,
                followup: `We wanted to follow up on your recent inquiry. If you have any additional questions or need further assistance, please don't hesitate to contact us.\n\n`,
                appointment: `We would be happy to schedule an appointment for you. Please let us know your preferred date and time, and we'll do our best to accommodate you.\n\n`
            };

            const textarea = document.getElementById('reply-message');
            const template = templates[templateType] || '';
            const currentValue = textarea.value;

            // Insert template at cursor position or append
            const cursorPos = textarea.selectionStart;
            const newValue = currentValue.substring(0, cursorPos) + template + currentValue.substring(cursorPos);
            textarea.value = newValue;

            // Move cursor after inserted template
            textarea.selectionStart = textarea.selectionEnd = cursorPos + template.length;
            textarea.focus();
        }

        function sendReply() {
            if (!currentReplyMessage) return;

            const subject = document.getElementById('reply-subject').value.trim();
            const message = document.getElementById('reply-message').value.trim();

            if (!message) {
                alert('Please enter a message before sending.');
                return;
            }

            // Show sending state
            const sendBtn = event.target;
            const originalText = sendBtn.innerHTML;
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

            // Simulate sending (in production, this would call an API)
            setTimeout(() => {
                // Create mailto link as fallback
                const mailtoLink = `mailto:${encodeURIComponent(currentReplyMessage.sender_email)}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(message)}`;

                // Open email client
                window.location.href = mailtoLink;

                // Show success notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 z-50 transform transition-all duration-500 animate-scaleIn';

                notification.innerHTML = `
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-xl shadow-2xl border border-green-400/30">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-2xl"></i>
                            <div>
                                <p class="font-bold">Reply Sent!</p>
                                <p class="text-sm text-white/90">Your reply has been opened in your email client</p>
                            </div>
                        </div>
                    </div>
                `;

                document.body.appendChild(notification);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 500);
                }, 3000);

                // Reset button
                sendBtn.disabled = false;
                sendBtn.innerHTML = originalText;

                // Close reply panel
                closeReplyPanel();
            }, 1000);
        }

        // Toggle forward menu
        function toggleForwardMenu(messageId) {
            const menu = document.getElementById(`forward-menu-${messageId}`);
            // Close all other menus
            document.querySelectorAll('[id^="forward-menu-"]').forEach(m => {
                if (m.id !== `forward-menu-${messageId}`) {
                    m.classList.add('hidden');
                }
            });
            // Toggle current menu
            menu.classList.toggle('hidden');
        }

        // Close forward menus when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.group\\/forward')) {
                document.querySelectorAll('[id^="forward-menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        // Forward message to department
        function forwardMessage(messageId, department) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            // Close the menu
            document.getElementById(`forward-menu-${messageId}`).classList.add('hidden');

            // Department display names and info
            const departments = {
                doctor: { name: 'Doctor Department', icon: 'fa-user-md', color: 'blue' },
                nurse: { name: 'Nursing Department', icon: 'fa-user-nurse', color: 'green' },
                admin: { name: 'Administration', icon: 'fa-user-shield', color: 'purple' },
                hr: { name: 'HR Department', icon: 'fa-users', color: 'amber' },
                billing: { name: 'Billing Department', icon: 'fa-file-invoice-dollar', color: 'orange' }
            };

            const dept = departments[department];

            // Show confirmation modal
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-md animate-fadeIn';
            modal.onclick = (e) => { if (e.target === modal) modal.remove(); };

            modal.innerHTML = `
                <div class="relative w-full max-w-md transform transition-all animate-scaleIn">
                    <div class="relative bg-gradient-to-br from-slate-800/95 to-slate-900/95 backdrop-blur-xl rounded-2xl border border-cyan-400/30 shadow-2xl overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-${dept.color}-500 rounded-full flex items-center justify-center">
                                    <i class="fas ${dept.icon} text-white text-2xl"></i>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-white text-center mb-2">Forward Message</h3>
                            <p class="text-white/70 text-center mb-1">Forward this message to:</p>
                            <p class="text-cyan-400 font-semibold text-center mb-4">${dept.name}</p>

                            <div class="backdrop-blur-md rounded-lg p-3 mb-6 border border-white/10">
                                <p class="text-white/60 text-xs mb-1">From:</p>
                                <p class="text-white text-sm font-semibold">${escapeHtml(msg.sender_name)}</p>
                                <p class="text-white/70 text-xs">${escapeHtml(msg.subject)}</p>
                            </div>

                            <div class="flex gap-3">
                                <button onclick="this.closest('.fixed').remove()" class="flex-1 px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all">
                                    Cancel
                                </button>
                                <button onclick="confirmForward(${messageId}, '${department}'); this.closest('.fixed').remove();" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-${dept.color}-500 hover:from-cyan-600 hover:to-${dept.color}-600 text-white font-semibold rounded-lg transition-all shadow-lg">
                                    <i class="fas fa-share mr-2"></i>Forward
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
        }

        // Confirm and execute forward
        function confirmForward(messageId, department) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            // Show success notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-50 transform transition-all duration-500 animate-scaleIn';

            notification.innerHTML = `
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-xl shadow-2xl border border-green-400/30">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <div>
                            <p class="font-bold">Message Forwarded!</p>
                            <p class="text-sm text-white/90">Sent to ${department} department</p>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 500);
            }, 3000);

            // Here you would typically make an API call to actually forward the message
            // For now, we'll just log it
            console.log(`Forwarding message ${messageId} to ${department}`, msg);
        }

        // Toggle forward to department menu
        function toggleForwardDeptMenu(messageId) {
            const menu = document.getElementById(`forward-dept-menu-${messageId}`);
            // Close all other department menus
            document.querySelectorAll('[id^="forward-dept-menu-"]').forEach(m => {
                if (m.id !== `forward-dept-menu-${messageId}`) {
                    m.classList.add('hidden');
                }
            });
            // Toggle current menu
            menu.classList.toggle('hidden');
        }

        // Forward message to department (placeholder for future functionality)
        function forwardToDepartment(messageId, department) {
            const msg = allMessages.find(m => m.id === messageId);
            if (!msg) return;

            // Close the menu
            document.getElementById(`forward-dept-menu-preview-${messageId}`).classList.add('hidden');

            // Department display names and info
            const departments = {
                medical: { name: 'Medical Department', icon: 'fa-stethoscope', color: 'purple' },
                nursing: { name: 'Nursing Department', icon: 'fa-user-nurse', color: 'purple' },
                lab: { name: 'Laboratory', icon: 'fa-flask', color: 'purple' },
                pharmacy: { name: 'Pharmacy', icon: 'fa-pills', color: 'purple' },
                billing: { name: 'Billing Department', icon: 'fa-file-invoice-dollar', color: 'purple' },
                hr: { name: 'HR Department', icon: 'fa-users', color: 'purple' }
            };

            const dept = departments[department];

            // Show success notification (functionality to be implemented later)
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-50 transform transition-all duration-500 animate-scaleIn';

            notification.innerHTML = `
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-4 rounded-xl shadow-2xl border border-purple-400/30">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-building text-2xl"></i>
                        <div>
                            <p class="font-bold">Department Forward!</p>
                            <p class="text-sm text-white/90">Sent to ${dept.name}</p>
                            <p class="text-xs text-white/70 mt-1">(Functionality to be implemented)</p>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 500);
            }, 3000);

            // Placeholder for future API call
            console.log(`Forwarding message ${messageId} to ${department} department`, msg);
        }

        // Inactivity timeout (5 minutes)
        let inactivityTimeout, warningTimeout;
        const INACTIVITY_LIMIT = 5 * 60 * 1000, WARNING_BEFORE = 60 * 1000;
        function resetInactivityTimer() {
            clearTimeout(inactivityTimeout); clearTimeout(warningTimeout); hideInactivityWarning();
            warningTimeout = setTimeout(() => showInactivityWarning(), INACTIVITY_LIMIT - WARNING_BEFORE);
            inactivityTimeout = setTimeout(() => autoLogout(), INACTIVITY_LIMIT);
        }
        function showInactivityWarning() { document.getElementById('inactivityModal').classList.remove('hidden'); }
        function hideInactivityWarning() { document.getElementById('inactivityModal').classList.add('hidden'); }
        function autoLogout() {
            localStorage.removeItem('receptionist_user'); localStorage.removeItem('receptionist_token');
            document.cookie = 'receptionist_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
            window.location.href = '../';
        }
        function stayLoggedIn() { hideInactivityWarning(); resetInactivityTimer(); }
        ['mousedown','mousemove','keypress','scroll','touchstart','click'].forEach(e => document.addEventListener(e, resetInactivityTimer, true));

        window.addEventListener('DOMContentLoaded', () => {
            const user = JSON.parse(localStorage.getItem('receptionist_user') || '{}');
            if (user.first_name) document.getElementById('userName').textContent = user.first_name + ' ' + (user.last_name || '');
            resetInactivityTimer();

            // Load messages in background to get unread count for badge
            loadMessages();

            // Start real-time message refresh (every 10 seconds)
            startMessageRefresh();
        });
    </script>
