# Receptionist Dashboard - Modular Architecture

## Overview
The dashboard has been refactored into a modular component-based architecture for better maintainability and organization.

## File Structure

```
receptionist-dashboard/
├── components/
│   ├── dashboard.php          # Main file that combines all components
│   ├── dashboard-old.php      # Backup of original monolithic file
│   └── dashboard/             # Modular components directory
│       ├── header.php         # HTML head, meta tags, scripts (1KB)
│       ├── styles.php         # Custom CSS animations (526B)
│       ├── sidebar.php        # Sidebar navigation (13KB)
│       ├── topbar.php         # Top header/search bar (2KB)
│       ├── dashboard-tab.php  # Dashboard tab content (21KB)
│       ├── messages-tab.php   # Messages inbox tab (11KB)
│       ├── scripts.php        # All JavaScript functions (54KB)
│       ├── modals.php         # Logout and notification modals (3.8KB)
│       └── footer.php         # Closing HTML tags (43B)
```

## Components Description

### 1. **header.php**
- HTML doctype and head section
- Meta tags and viewport
- Font imports (Inter)
- Font Awesome CDN
- Tailwind CSS configuration
- Includes styles.php

### 2. **styles.php**
- Custom CSS animations (fadeIn, scaleIn)
- Line clamp utilities
- Additional styling

### 3. **sidebar.php**
- VitalNest branding
- Navigation menu with sub-menus:
  - Dashboard (home)
  - Patient Registration
  - Appointments
  - Check-In/Out
  - Waiting Room
  - Billing
  - Phone Calls
  - Messages (with unread badge)
  - Reports
  - Settings
- User profile section
- Logout button

### 4. **topbar.php**
- Page header with title
- Sidebar toggle button
- Notifications bell (with indicator)
- Search button

### 5. **dashboard-tab.php**
- Stats cards (4 metrics):
  - Patients in Queue
  - Today's Appointments
  - New Registrations
  - Active Calls
- Waiting Room Queue list
- Next Appointments list
- Pending Tasks grid
- Quick Actions panel

### 6. **messages-tab.php**
- Header with gradient title
- Stats cards (Total, Unread, Read, High Priority)
- Filter pills
- Split-view inbox layout:
  - Message list (left pane)
  - Preview panel (right pane)
- Loading and empty states

### 7. **scripts.php**
- Tab switching logic
- Submenu toggle functions
- Messages management:
  - loadMessages()
  - displayMessages()
  - showMessagePreview()
  - filterMessages()
  - markAsRead()
  - forwardMessage()
  - toggleForwardMenu()
- Utility functions:
  - getTimeAgo()
  - escapeHtml()
- Logout functions
- Inactivity timeout (5 minutes)
- Auto-refresh (60 seconds for messages)

### 8. **modals.php**
- Logout confirmation modal
- Inactivity warning modal

### 9. **footer.php**
- Closing div tags
- Closing body and html tags

## How It Works

The main `dashboard.php` file acts as a controller that includes all components in the correct order:

```php
<?php
// Authentication check
require 'dashboard/header.php';      // <html><head>...
require 'dashboard/sidebar.php';     // Sidebar navigation
// Main content wrapper starts
require 'dashboard/topbar.php';      // Top header bar
require 'dashboard/dashboard-tab.php'; // Tab 1 content
require 'dashboard/messages-tab.php';  // Tab 2 content
require 'dashboard/scripts.php';     // JavaScript
require 'dashboard/modals.php';      // Modal dialogs
require 'dashboard/footer.php';      // </body></html>
```

## Benefits of Modular Architecture

1. **Maintainability**: Each component is in its own file, easy to find and edit
2. **Reusability**: Components can be reused across different dashboards
3. **Collaboration**: Multiple developers can work on different components
4. **Version Control**: Easier to track changes in git diffs
5. **Testing**: Individual components can be tested independently
6. **Performance**: Easier to optimize specific sections
7. **Scalability**: Easy to add new tabs or features

## Adding New Components

To add a new tab or section:

1. Create new file in `dashboard/` directory (e.g., `reports-tab.php`)
2. Add content with proper HTML structure
3. Include it in main `dashboard.php`:
   ```php
   <?php require_once __DIR__ . '/dashboard/reports-tab.php'; ?>
   ```
4. Add tab switching logic in `scripts.php` if needed
5. Add menu item in `sidebar.php`

## File Size Breakdown

- **Total modular components**: ~105KB
- **Largest**: scripts.php (54KB) - all JavaScript
- **Smallest**: footer.php (43B) - closing tags

## Migration Notes

- Original monolithic file saved as `dashboard-old.php` (backup)
- All functionality preserved
- No breaking changes
- Same authentication flow
- Same UI/UX experience

## Development Tips

1. Edit individual component files instead of main dashboard.php
2. Test changes by refreshing the dashboard in browser
3. Check browser console for JavaScript errors
4. Use browser DevTools to debug component issues
5. Maintain consistent code style across components

## Future Improvements

- [ ] Add more granular components (e.g., separate stats-cards.php)
- [ ] Extract repeated HTML patterns into reusable functions
- [ ] Create component library for buttons, cards, modals
- [ ] Add TypeScript for better JavaScript type safety
- [ ] Implement lazy loading for heavy components
- [ ] Add unit tests for JavaScript functions

---

**Last Updated**: February 3, 2026  
**Version**: 2.0 (Modular)  
**Maintained by**: VitalNest Development Team

