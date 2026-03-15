/**
 * VitalNest Patient Dashboard - JavaScript
 * Handles navigation, user info, and logout functionality
 */

// Load user data on page load
document.addEventListener('DOMContentLoaded', function() {
    loadUserInfo();
    checkAuthentication();
});

/**
 * Load user information from localStorage
 */
function loadUserInfo() {
    try {
        const userData = JSON.parse(localStorage.getItem('user') || '{}');

        if (userData.full_name || userData.first_name) {
            const fullName = userData.full_name || `${userData.first_name || ''} ${userData.last_name || ''}`.trim();

            // Update user name
            const userNameElement = document.getElementById('userName');
            if (userNameElement) {
                userNameElement.textContent = fullName || 'Patient User';
            }

            // Update user initials
            const userInitialsElement = document.getElementById('userInitials');
            if (userInitialsElement && fullName) {
                const nameParts = fullName.split(' ');
                const initials = nameParts.map(part => part.charAt(0)).join('').substring(0, 2).toUpperCase();
                userInitialsElement.textContent = initials;
            }

            // Update page subtitle with personalized greeting
            const pageSubtitle = document.getElementById('pageSubtitle');
            if (pageSubtitle && userData.first_name) {
                const hour = new Date().getHours();
                let greeting = 'Good morning';
                if (hour >= 12 && hour < 17) greeting = 'Good afternoon';
                if (hour >= 17) greeting = 'Good evening';

                pageSubtitle.textContent = `${greeting}, ${userData.first_name}!`;
            }
        }
    } catch (error) {
        console.error('Error loading user info:', error);
    }
}

/**
 * Check if user is authenticated
 */
function checkAuthentication() {
    const token = localStorage.getItem('patient_token') || localStorage.getItem('client_token') || localStorage.getItem('token') || localStorage.getItem('auth_token');

    if (!token) {
        console.warn('No authentication token found');
        // Redirect to login after a short delay
        setTimeout(() => {
            window.location.href = '../';
        }, 100);
    }
}

/**
 * Show specific section and hide others
 */
function showSection(sectionName) {
    // Prevent default link behavior
    event?.preventDefault();

    // Hide all sections
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });

    // Show selected section
    const selectedSection = document.getElementById(`section-${sectionName}`);
    if (selectedSection) {
        selectedSection.classList.remove('hidden');
    }

    // Update navigation active state
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.classList.remove('active', 'bg-white/10', 'text-white');
        item.classList.add('text-white/60');
    });

    // Add active class to clicked nav item
    const clickedNavItem = event?.target?.closest('.nav-item');
    if (clickedNavItem) {
        clickedNavItem.classList.add('active', 'bg-white/10', 'text-white');
        clickedNavItem.classList.remove('text-white/60');
    }

    // Update page title based on section
    const pageTitles = {
        'dashboard': 'My Health Dashboard',
        'appointments': 'My Appointments',
        'health-records': 'Health Records',
        'medications': 'Medications',
        'lab-results': 'Lab Results',
        'billing': 'Billing & Invoices',
        'support-tickets': 'Support Tickets'
    };

    const pageTitle = document.getElementById('pageTitle');
    if (pageTitle && pageTitles[sectionName]) {
        pageTitle.textContent = pageTitles[sectionName];
    }

    // Update page subtitle
    const pageSubtitle = document.getElementById('pageSubtitle');
    if (pageSubtitle) {
        const subtitles = {
            'dashboard': 'Welcome back!',
            'appointments': 'Manage your appointments',
            'health-records': 'View your medical history',
            'medications': 'Track your prescriptions',
            'lab-results': 'View test results',
            'billing': 'Manage payments and invoices',
            'support-tickets': 'Get help and support'
        };
        pageSubtitle.textContent = subtitles[sectionName] || 'VitalNest Patient Portal';
    }
}

/**
 * Logout function
 */
function logout() {
    // Confirm logout
    if (!confirm('Are you sure you want to logout?')) {
        return;
    }

    // Clear all authentication data
    localStorage.removeItem('token');
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user');
    localStorage.removeItem('patient_token');
    localStorage.removeItem('patient_user');
    localStorage.removeItem('client_token');
    localStorage.removeItem('client_user');

    // Clear session cookies
    document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'auth_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'patient_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    document.cookie = 'client_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

    // Show logout message
    alert('You have been logged out successfully!');

    // Redirect to login page
    window.location.href = '../';
}

/**
 * Handle keyboard shortcuts
 */
document.addEventListener('keydown', function(e) {
    // Alt + L to logout
    if (e.altKey && e.key === 'l') {
        e.preventDefault();
        logout();
    }

    // Alt + D for dashboard
    if (e.altKey && e.key === 'd') {
        e.preventDefault();
        showSection('dashboard');
    }

    // Alt + A for appointments
    if (e.altKey && e.key === 'a') {
        e.preventDefault();
        showSection('appointments');
    }
});

// Export functions for use in other scripts
window.showSection = showSection;
window.logout = logout;
window.loadUserInfo = loadUserInfo;
window.checkAuthentication = checkAuthentication;

console.log('Patient Dashboard JavaScript loaded successfully');
