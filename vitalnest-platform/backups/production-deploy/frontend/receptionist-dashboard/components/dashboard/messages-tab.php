                <!-- Messages Tab -->
                <div id="messages-tab" class="tab-content hidden">
                    <!-- Header Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60 text-lg">Contact Messages - Manage all customer inquiries and contact submissions</p>
                            </div>
                            <button onclick="loadMessages()" class="group px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl transition-all duration-300 shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105 transform">
                                <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                Refresh
                            </button>
                        </div>
                    </div>

                    <!-- Filter Pills with Counts -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-white/60 text-sm font-semibold">Filter:</span>
                        <button onclick="filterMessages('all')" id="filter-all" class="px-4 py-2 backdrop-blur-md text-purple-300 rounded-lg text-sm font-semibold transition-all border border-purple-400/30 hover:border-purple-400/50 hover:scale-105 transform flex items-center gap-2">
                            <span>All</span>
                            <span id="count-all" class="px-2 py-0.5 bg-purple-500/30 rounded-full text-xs">0</span>
                        </button>
                        <button onclick="filterMessages('unread')" id="filter-unread" class="px-4 py-2 backdrop-blur-md text-white/70 rounded-lg text-sm font-semibold transition-all hover:scale-105 transform border border-white/10 flex items-center gap-2">
                            <span>Unread</span>
                            <span id="count-unread" class="px-2 py-0.5 bg-green-500/30 rounded-full text-xs text-green-300">0</span>
                        </button>
                        <button onclick="filterMessages('read')" id="filter-read" class="px-4 py-2 backdrop-blur-md text-white/70 rounded-lg text-sm font-semibold transition-all hover:scale-105 transform border border-white/10 flex items-center gap-2">
                            <span>Read</span>
                            <span id="count-read" class="px-2 py-0.5 bg-slate-500/30 rounded-full text-xs text-slate-300">0</span>
                        </button>
                        <button onclick="filterMessages('high')" id="filter-high" class="px-4 py-2 backdrop-blur-md text-white/70 rounded-lg text-sm font-semibold transition-all hover:scale-105 transform border border-white/10 flex items-center gap-2">
                            <span>High Priority</span>
                            <span id="count-high" class="px-2 py-0.5 bg-red-500/30 rounded-full text-xs text-red-300">0</span>
                        </button>
                        <button onclick="filterMessages('custom_plan')" id="filter-custom_plan" class="px-4 py-2 backdrop-blur-md text-white/70 rounded-lg text-sm font-semibold transition-all hover:scale-105 transform border border-white/10 flex items-center gap-2">
                            <span>Custom Plans</span>
                            <span id="count-custom_plan" class="px-2 py-0.5 bg-cyan-500/30 rounded-full text-xs text-cyan-300">0</span>
                        </button>

                        <!-- Search Box -->
                        <div class="relative w-64">
                            <input
                                type="text"
                                id="message-search"
                                oninput="searchMessages(this.value)"
                                placeholder="Search messages..."
                                autocomplete="off"
                                style="background: transparent !important; color: white !important;"
                                class="w-full px-3 py-2 pl-9 pr-16 backdrop-blur-md border border-white/10 rounded-lg text-white text-sm placeholder-white/40 focus:border-cyan-400/50 focus:outline-none transition-all"
                            />
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-white/40 text-xs"></i>

                            <!-- Search Match Counter -->
                            <span id="search-counter" class="hidden absolute right-8 top-1/2 -translate-y-1/2 text-xs font-semibold px-2 py-0.5 bg-cyan-500/20 text-cyan-300 rounded-full border border-cyan-400/30">
                                0
                            </span>

                            <button
                                id="clear-search"
                                onclick="clearSearch()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-white/40 hover:text-white transition-all hidden"
                            >
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Messages Container -->
                    <div class="relative">
                        <div class="relative border border-white/10 rounded-2xl p-6">

                            <!-- Loading State -->
                            <div id="loading-messages" class="text-center py-20">
                                <div class="inline-block">
                                    <div class="w-16 h-16 border-4 border-purple-500/30 border-t-purple-500 rounded-full animate-spin mb-4"></div>
                                </div>
                                <p class="text-white/60 text-lg font-semibold">Loading messages...</p>
                                <p class="text-white/40 text-sm mt-2">Please wait while we fetch your messages</p>
                            </div>

                            <!-- Empty State -->
                            <div id="empty-messages" class="hidden text-center py-20">
                                <div class="w-20 h-20 bg-gradient-to-br from-slate-700 to-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-white/30 text-3xl"></i>
                                </div>
                                <p class="text-white/60 text-xl font-bold mb-2">No messages found</p>
                                <p class="text-white/40">Try adjusting your filters or check back later</p>
                            </div>

                            <!-- 3-Column Layout: List | Reading | Reply -->
                            <div class="grid grid-cols-12 gap-4 h-[700px]">
                                <!-- Messages List (Left - 3 columns) -->
                                <div class="col-span-3 backdrop-blur-md rounded-xl border border-white/10 overflow-hidden">
                                    <div class="p-4 border-b border-white/10">
                                        <h3 class="text-white font-semibold text-sm">Messages</h3>
                                    </div>
                                    <div id="messages-container" class="h-[calc(100%-56px)] overflow-y-auto scrollbar-thin scrollbar-thumb-purple-500/30 scrollbar-track-transparent">
                                        <!-- Messages will be loaded here dynamically -->
                                    </div>
                                </div>

                                <!-- Reading Panel (Center - 5 columns) -->
                                <div class="col-span-5 backdrop-blur-md rounded-xl border border-white/10 overflow-hidden">
                                    <div id="message-preview" class="h-full flex items-center justify-center">
                                        <div class="text-center p-8">
                                            <div class="w-20 h-20 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-envelope-open text-white/40 text-3xl"></i>
                                            </div>
                                            <p class="text-white/60 text-lg font-semibold mb-2">No message selected</p>
                                            <p class="text-white/40 text-sm">Click on a message to view its contents</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reply Panel (Right - 4 columns) -->
                                <div class="col-span-4 backdrop-blur-md rounded-xl border border-white/10 overflow-hidden">
                                    <div id="reply-panel" class="h-full flex flex-col">
                                        <!-- Reply panel empty state -->
                                        <div id="reply-empty-state" class="h-full flex items-center justify-center p-6">
                                            <div class="text-center">
                                                <div class="w-16 h-16 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                                    <i class="fas fa-reply text-white/40 text-2xl"></i>
                                                </div>
                                                <p class="text-white/60 text-sm font-semibold mb-1">Quick Reply</p>
                                                <p class="text-white/40 text-xs">Select a message to send a reply</p>
                                            </div>
                                        </div>

                                        <!-- Reply form (hidden by default) -->
                                        <div id="reply-form-container" class="hidden h-full flex flex-col">
                                            <!-- Reply Header -->
                                            <div class="flex-shrink-0 p-4 border-b border-white/10">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h3 class="text-white font-semibold text-sm">Quick Reply</h3>
                                                    <button onclick="closeReplyPanel()" class="text-white/60 hover:text-white transition-all">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <p id="reply-to-name" class="text-white/60 text-xs">To: <span class="text-white"></span></p>
                                            </div>

                                            <!-- Reply Form -->
                                            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                                                <div>
                                                    <label class="block text-white/70 text-xs font-semibold mb-2">Subject</label>
                                                    <input type="text" id="reply-subject" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-cyan-400/50 focus:outline-none transition-all" placeholder="Re: Original subject">
                                                </div>

                                                <div>
                                                    <label class="block text-white/70 text-xs font-semibold mb-2">Message</label>
                                                    <textarea id="reply-message" rows="10" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-cyan-400/50 focus:outline-none transition-all resize-none" placeholder="Type your reply here..."></textarea>
                                                </div>

                                                <!-- Quick Templates -->
                                                <div>
                                                    <label class="block text-white/70 text-xs font-semibold mb-2">Quick Templates</label>
                                                    <div class="grid grid-cols-2 gap-2">
                                                        <button onclick="insertTemplate('greeting')" class="px-3 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-xs text-white/80 transition-all">
                                                            <i class="fas fa-smile mr-1"></i>Greeting
                                                        </button>
                                                        <button onclick="insertTemplate('thanks')" class="px-3 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-xs text-white/80 transition-all">
                                                            <i class="fas fa-heart mr-1"></i>Thanks
                                                        </button>
                                                        <button onclick="insertTemplate('followup')" class="px-3 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-xs text-white/80 transition-all">
                                                            <i class="fas fa-calendar mr-1"></i>Follow-up
                                                        </button>
                                                        <button onclick="insertTemplate('appointment')" class="px-3 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-xs text-white/80 transition-all">
                                                            <i class="fas fa-clock mr-1"></i>Schedule
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Reply Actions -->
                                            <div class="flex-shrink-0 p-4 border-t border-white/10 space-y-2">
                                                <button onclick="sendReply()" class="w-full px-4 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-semibold rounded-lg transition-all hover:scale-105 transform shadow-lg">
                                                    <i class="fas fa-paper-plane mr-2"></i>Send Reply
                                                </button>
                                                <button onclick="closeReplyPanel()" class="w-full px-4 py-2 bg-white/5 hover:bg-white/10 text-white/80 rounded-lg transition-all text-sm">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Messages Tab -->
