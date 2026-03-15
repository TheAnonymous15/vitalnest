# Component Architecture Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                       dashboard.php                              │
│                    (Main Controller)                             │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 1. header.php                                              │ │
│  │    - <!DOCTYPE html>                                       │ │
│  │    - <head> meta, fonts, tailwind, styles.php              │ │
│  │    - <body> wrapper start                                  │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 2. sidebar.php                                             │ │
│  │    - Logo & branding                                       │ │
│  │    - Navigation menu                                       │ │
│  │    - User profile & logout                                 │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 3. Main Content Wrapper                                    │ │
│  │                                                             │ │
│  │  ┌──────────────────────────────────────────────────────┐  │ │
│  │  │ 3a. topbar.php                                       │  │ │
│  │  │     - Page title                                     │  │ │
│  │  │     - Notifications, Search                          │  │ │
│  │  └──────────────────────────────────────────────────────┘  │ │
│  │                                                             │ │
│  │  ┌──────────────────────────────────────────────────────┐  │ │
│  │  │ 3b. Content Area                                     │  │ │
│  │  │                                                       │  │ │
│  │  │  ┌────────────────────────────────────────────────┐  │  │ │
│  │  │  │ dashboard-tab.php (Tab 1)                      │  │  │ │
│  │  │  │  - Stats Grid (4 cards)                        │  │  │ │
│  │  │  │  - Waiting Room Queue                          │  │  │ │
│  │  │  │  - Next Appointments                           │  │  │ │
│  │  │  │  - Pending Tasks                               │  │  │ │
│  │  │  │  - Quick Actions                               │  │  │ │
│  │  │  └────────────────────────────────────────────────┘  │  │ │
│  │  │                                                       │  │ │
│  │  │  ┌────────────────────────────────────────────────┐  │  │ │
│  │  │  │ messages-tab.php (Tab 2)                       │  │  │ │
│  │  │  │  - Header & Stats Cards                        │  │  │ │
│  │  │  │  - Filter Pills                                │  │  │ │
│  │  │  │  - Split View:                                 │  │  │ │
│  │  │  │    ├─ Message List (left)                      │  │  │ │
│  │  │  │    └─ Preview Panel (right)                    │  │  │ │
│  │  │  └────────────────────────────────────────────────┘  │  │ │
│  │  │                                                       │  │ │
│  │  └──────────────────────────────────────────────────────┘  │ │
│  │                                                             │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 4. scripts.php                                             │ │
│  │    - <script> tag                                          │ │
│  │    - Tab switching                                         │ │
│  │    - Messages management                                   │ │
│  │    - Forward functionality                                 │ │
│  │    - Inactivity timeout                                    │ │
│  │    - </script>                                             │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 5. modals.php                                              │ │
│  │    - Logout confirmation modal                             │ │
│  │    - Inactivity warning modal                              │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐ │
│  │ 6. footer.php                                              │ │
│  │    - Closing </div> tags                                   │ │
│  │    - </body>                                               │ │
│  │    - </html>                                               │ │
│  └────────────────────────────────────────────────────────────┘ │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘

COMPONENT DEPENDENCIES:
├── header.php
│   └── includes: styles.php
├── sidebar.php (standalone)
├── topbar.php (standalone)
├── dashboard-tab.php (standalone)
├── messages-tab.php (standalone)
├── scripts.php
│   └── depends on: DOM elements from all tabs
├── modals.php (standalone)
└── footer.php (standalone)

FILE LOADING ORDER:
1. Authentication check (dashboard.php)
2. Header + Styles (HTML structure begins)
3. Sidebar (navigation loaded)
4. Main content wrapper opens
5. Topbar (search, notifications)
6. Tab contents (both tabs loaded, 1 visible, 1 hidden)
7. Scripts (all JavaScript functions)
8. Modals (hidden by default)
9. Footer (HTML structure closes)
```

## Component Communication

```
User Interaction Flow:
┌─────────┐
│  User   │
└────┬────┘
     │
     ├─ Clicks "Messages" in sidebar.php
     │  └─> Triggers showTab('messages') in scripts.php
     │      └─> Hides dashboard-tab, Shows messages-tab
     │          └─> Calls loadMessages() in scripts.php
     │              └─> Fetches from notification service (port 9033)
     │                  └─> Updates messages-tab.php display
     │
     ├─ Clicks message in list
     │  └─> Triggers showMessagePreview(id) in scripts.php
     │      └─> Updates preview panel in messages-tab.php
     │          └─> Auto-marks as read
     │
     └─ Clicks "Forward" button
        └─> Triggers toggleForwardMenu(id) in scripts.php
            └─> Shows dropdown in messages-tab.php
                └─> Selects department
                    └─> Triggers forwardMessage(id, dept) in scripts.php
                        └─> Shows confirmation modal from modals.php
```

## Quick Reference

| Component | Purpose | Size | Can Modify Independently |
|-----------|---------|------|-------------------------|
| header.php | HTML structure start | 1KB | ✅ Yes |
| styles.php | CSS animations | 526B | ✅ Yes |
| sidebar.php | Navigation menu | 13KB | ✅ Yes |
| topbar.php | Page header | 2KB | ✅ Yes |
| dashboard-tab.php | Main dashboard | 21KB | ✅ Yes |
| messages-tab.php | Messages inbox | 11KB | ✅ Yes |
| scripts.php | All JavaScript | 54KB | ⚠️ Affects all |
| modals.php | Popup dialogs | 3.8KB | ✅ Yes |
| footer.php | HTML close tags | 43B | ✅ Yes |

