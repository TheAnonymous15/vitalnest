<script>
// Modal Functions
function openRegisterModal() {
    document.getElementById('register-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRegisterModal() {
    document.getElementById('register-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openResetModal() {
    document.getElementById('reset-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeResetModal() {
    document.getElementById('reset-modal').classList.add('hidden');
    document.getElementById('reset-step-1').classList.remove('hidden');
    document.getElementById('reset-step-2').classList.add('hidden');
    document.body.style.overflow = 'auto';

    // Reset all input fields
    document.getElementById('reset-identifier').value = '';
    document.getElementById('reset-token').value = '';
    document.getElementById('reset-new-password').value = '';
    document.getElementById('reset-new-password-confirm').value = '';

    // Reset password strength indicator
    const strengthBar = document.getElementById('reset-password-strength-bar');
    const strengthText = document.getElementById('reset-password-strength-text');
    if (strengthBar && strengthText) {
        strengthBar.style.width = '0%';
        strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
        strengthText.textContent = 'WEAK';
        strengthText.className = 'text-xs text-white/40';
    }

    // Clear any alert messages
    const resetAlert = document.getElementById('reset-alert');
    if (resetAlert) {
        resetAlert.classList.add('hidden');
    }
}

function showResetStep1() {
    document.getElementById('reset-step-1').classList.remove('hidden');
    document.getElementById('reset-step-2').classList.add('hidden');
}

// Create particle system
function createParticles() {
    const container = document.getElementById('particles');
    const particleCount = 50;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        const tx = (Math.random() - 0.5) * 200;
        particle.style.setProperty('--tx', tx + 'px');
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 15 + 's';
        particle.style.animationDuration = (10 + Math.random() * 10) + 's';

        if (Math.random() > 0.5) {
            particle.style.background = 'rgba(249, 115, 22, 0.8)';
            particle.style.boxShadow = '0 0 10px rgba(249, 115, 22, 0.8)';
        }
        container.appendChild(particle);
    }
}

// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function toggleRegisterPassword() {
    const passwordInput = document.getElementById('register-password');
    const icon = document.getElementById('register-password-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function toggleResetPassword() {
    const passwordInput = document.getElementById('reset-new-password');
    const icon = document.getElementById('reset-password-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Show alert message
function showAlert(message, type = 'error') {
    const alert = document.getElementById('alert');
    const styles = {
        success: 'bg-green-500/10 border-2 border-green-500/50',
        error: 'bg-red-500/10 border-2 border-red-500/50'
    };
    const icons = { success: 'check-circle', error: 'exclamation-triangle' };
    const textColor = type === 'success' ? 'text-green-400' : 'text-red-400';

    alert.className = 'mb-6 rounded-xl overflow-hidden ' + styles[type];
    alert.innerHTML = '<div class="p-4 flex items-center gap-3 ' + textColor + '"><div class="w-10 h-10 rounded-lg bg-' + (type === 'success' ? 'green' : 'red') + '-500/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-' + icons[type] + ' text-lg"></i></div><div class="flex-1"><span class="font-semibold uppercase tracking-wide" style="font-family: \'Orbitron\', sans-serif;">' + message + '</span></div></div><div class="loading-bar"></div>';
    alert.classList.remove('hidden');

    setTimeout(function() {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-20px)';
        alert.style.transition = 'all 0.3s ease';
        setTimeout(function() {
            alert.classList.add('hidden');
            alert.style.opacity = '1';
            alert.style.transform = 'translateY(0)';
        }, 300);
    }, 5000);
}

// Show alert in popup modal
function showResetAlert(message, type = 'error') {
    // Remove existing modal if any
    const existingModal = document.getElementById('alert-popup-modal');
    if (existingModal) existingModal.remove();

    const icons = { success: 'check-circle', error: 'exclamation-triangle' };
    const iconColor = type === 'success' ? 'text-green-400' : 'text-red-400';
    const bgColor = type === 'success' ? 'bg-green-500/20' : 'bg-red-500/20';
    const borderColor = type === 'success' ? 'border-green-500/50' : 'border-red-500/50';

    const modal = document.createElement('div');
    modal.id = 'alert-popup-modal';
    modal.className = 'fixed inset-0 z-[200] flex items-center justify-center p-4';
    modal.style.opacity = '0';
    modal.innerHTML = `
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-sm holo-card rounded-2xl p-6 transform scale-90">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full ${bgColor} border-2 ${borderColor} flex items-center justify-center mb-4">
                    <i class="fas fa-${icons[type]} text-2xl ${iconColor}"></i>
                </div>
                <p class="text-white text-sm font-semibold uppercase tracking-wide mb-4" style="font-family: 'Orbitron', sans-serif;">
                    ${message}
                </p>
                <button onclick="closeAlertModal()" class="cyber-button px-6 py-2 rounded-lg text-sm">
                    <span class="relative z-10">OK</span>
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    // Animate in
    setTimeout(function() {
        modal.style.transition = 'opacity 0.3s ease';
        modal.style.opacity = '1';
        const content = modal.querySelector('.holo-card');
        content.style.transition = 'transform 0.3s ease';
        content.style.transform = 'scale(1)';
    }, 10);

    // Auto close after 5 seconds
    setTimeout(function() {
        closeAlertModal();
    }, 5000);
}

function closeAlertModal() {
    const modal = document.getElementById('alert-popup-modal');
    if (modal) {
        modal.style.opacity = '0';
        const content = modal.querySelector('.holo-card');
        if (content) content.style.transform = 'scale(0.9)';
        setTimeout(function() {
            modal.remove();
        }, 300);
    }
}

// Registration Handler
async function handleRegister(e) {
    e.preventDefault();
    const btn = document.getElementById('register-btn');
    const originalText = btn.innerHTML;

    const firstName = document.getElementById('register-firstname').value;
    const lastName = document.getElementById('register-lastname').value;
    const email = document.getElementById('register-email').value;
    const countryCode = document.getElementById('register-country-code').value;
    const phoneNumber = document.getElementById('register-phone').value;
    const phone = countryCode + phoneNumber;
    const password = document.getElementById('register-password').value;
    const passwordConfirm = document.getElementById('register-password-confirm').value;

    if (password !== passwordConfirm) {
        showResetAlert('ERROR • Passwords do not match', 'error');
        return;
    }

    btn.innerHTML = '<span class="relative z-10 flex items-center gap-2"><i class="fas fa-circle-notch fa-spin"></i>CREATING...</span>';
    btn.disabled = true;

    try {
        const response = await fetch('http://localhost:9099/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password, first_name: firstName, last_name: lastName, phone })
        });

        const result = await response.json();

        if (result.success) {
            showResetAlert('SUCCESS • Account Created! Redirecting to login...', 'success');
            setTimeout(function() {
                closeRegisterModal();
                document.getElementById('register-firstname').value = '';
                document.getElementById('register-lastname').value = '';
                document.getElementById('register-email').value = '';
                document.getElementById('register-phone').value = '';
                document.getElementById('register-password').value = '';
                document.getElementById('register-password-confirm').value = '';
                document.getElementById('register-terms').checked = false;
            }, 2000);
        } else {
            showResetAlert('ERROR • ' + result.message, 'error');
        }
    } catch (error) {
        showResetAlert('ERROR • Service Unavailable', 'error');
    }

    btn.innerHTML = originalText;
    btn.disabled = false;
}

// Password Strength Meters
if (document.getElementById('register-password')) {
    document.getElementById('register-password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');

        let strength = 0;
        if (password.length >= 6) strength += 25;
        if (password.length >= 8) strength += 25;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) strength += 25;

        strengthBar.style.width = strength + '%';

        if (strength <= 25) {
            strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
            strengthText.textContent = 'WEAK';
            strengthText.className = 'text-xs text-red-400';
        } else if (strength <= 50) {
            strengthBar.className = 'h-full bg-orange-500 transition-all duration-300';
            strengthText.textContent = 'FAIR';
            strengthText.className = 'text-xs text-orange-400';
        } else if (strength <= 75) {
            strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
            strengthText.textContent = 'GOOD';
            strengthText.className = 'text-xs text-yellow-400';
        } else {
            strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
            strengthText.textContent = 'STRONG';
            strengthText.className = 'text-xs text-green-400';
        }
    });
}

if (document.getElementById('reset-new-password')) {
    document.getElementById('reset-new-password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('reset-password-strength-bar');
        const strengthText = document.getElementById('reset-password-strength-text');

        let strength = 0;
        if (password.length >= 6) strength += 25;
        if (password.length >= 8) strength += 25;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) strength += 25;

        strengthBar.style.width = strength + '%';

        if (strength <= 25) {
            strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
            strengthText.textContent = 'WEAK';
            strengthText.className = 'text-xs text-red-400';
        } else if (strength <= 50) {
            strengthBar.className = 'h-full bg-orange-500 transition-all duration-300';
            strengthText.textContent = 'FAIR';
            strengthText.className = 'text-xs text-orange-400';
        } else if (strength <= 75) {
            strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
            strengthText.textContent = 'GOOD';
            strengthText.className = 'text-xs text-yellow-400';
        } else {
            strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
            strengthText.textContent = 'STRONG';
            strengthText.className = 'text-xs text-green-400';
        }
    });
}

// Reset Request Handler
async function handleResetRequest(e) {
    e.preventDefault();
    const btn = document.getElementById('reset-request-btn');
    const originalText = btn.innerHTML;
    const identifier = document.getElementById('reset-identifier').value.trim();

    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(identifier);
    const isPhone = /^\+?\d{10,15}$/.test(identifier.replace(/\s/g, ''));

    if (!isEmail && !isPhone) {
        showResetAlert('ERROR • Please enter a valid email or phone number', 'error');
        return;
    }

    btn.innerHTML = '<span class="relative z-10 flex items-center gap-2"><i class="fas fa-circle-notch fa-spin"></i>SENDING...</span>';
    btn.disabled = true;

    try {
        const payload = isEmail ? { email: identifier } : { phone: identifier };

        const response = await fetch('http://localhost:9099/request-reset', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (result.success) {
            showResetAlert('SUCCESS • Reset code sent! Proceeding to next step...', 'success');
            setTimeout(function() {
                document.getElementById('reset-step-1').classList.add('hidden');
                document.getElementById('reset-step-2').classList.remove('hidden');
                if (result.dev_token) {
                    document.getElementById('reset-token').value = result.dev_token;
                }
                window.resetIdentifier = identifier;
                window.resetIdentifierType = isEmail ? 'email' : 'phone';
            }, 2000);
        } else {
            showResetAlert('ERROR • ' + result.message, 'error');
        }
    } catch (error) {
        showResetAlert('ERROR • Service Unavailable', 'error');
    }

    btn.innerHTML = originalText;
    btn.disabled = false;
}

// Reset Password Handler
async function handleResetPassword(e) {
    e.preventDefault();
    const btn = document.getElementById('reset-password-btn');
    const originalText = btn.innerHTML;

    const token = document.getElementById('reset-token').value;
    const newPassword = document.getElementById('reset-new-password').value;
    const newPasswordConfirm = document.getElementById('reset-new-password-confirm').value;

    if (newPassword !== newPasswordConfirm) {
        showResetAlert('ERROR • Passwords do not match', 'error');
        return;
    }

    btn.innerHTML = '<span class="relative z-10 flex items-center gap-2"><i class="fas fa-circle-notch fa-spin"></i>RESETTING...</span>';
    btn.disabled = true;

    try {
        const response = await fetch('http://localhost:9099/reset-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token, new_password: newPassword })
        });

        const result = await response.json();

        if (result.success) {
            closeResetModal();
            showAlert('SUCCESS • Password Reset! You can now login.', 'success');
        } else {
            showResetAlert('ERROR • ' + result.message, 'error');
        }
    } catch (error) {
        showResetAlert('ERROR • Service Unavailable', 'error');
    }

    btn.innerHTML = originalText;
    btn.disabled = false;
}

// Login Form Handler
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    const loadingBar = document.getElementById('loadingBar');
    const originalHTML = submitBtn.innerHTML;

    submitBtn.innerHTML = '<span class="relative z-10 flex items-center justify-center gap-3"><i class="fas fa-circle-notch fa-spin text-lg"></i><span>AUTHENTICATING</span><i class="fas fa-circle-notch fa-spin text-sm"></i></span>';
    submitBtn.disabled = true;
    loadingBar.classList.remove('hidden');

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('http://localhost:9099/auth/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email, password: password, role: 'client' })
        });

        const data = await response.json();

        if (data.success && data.data.token) {
            document.cookie = 'client_token=' + data.data.token + '; path=/; max-age=28800; SameSite=Strict';
            localStorage.setItem('client_token', data.data.token);
            localStorage.setItem('client_user', JSON.stringify(data.data.user));

            showAlert('ACCESS GRANTED • Entering Portal...', 'success');

            submitBtn.innerHTML = '<span class="relative z-10 flex items-center justify-center gap-3"><i class="fas fa-check-circle text-lg"></i><span>ACCESS GRANTED</span><i class="fas fa-check-circle text-lg"></i></span>';

            setTimeout(function() {
                window.location.href = '../';
            }, 1500);
        } else {
            showAlert('ACCESS DENIED • Invalid Credentials', 'error');
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
            loadingBar.classList.add('hidden');
        }
    } catch (error) {
        console.error('Login error:', error);
        showAlert('CONNECTION ERROR • Service Unavailable', 'error');
        submitBtn.innerHTML = originalHTML;
        submitBtn.disabled = false;
        loadingBar.classList.add('hidden');
    }
});

// Mouse trail effect
document.addEventListener('mousemove', function(e) {
    const trail = document.createElement('div');
    trail.className = 'particle';
    trail.style.left = e.clientX + 'px';
    trail.style.top = e.clientY + 'px';
    trail.style.position = 'fixed';
    trail.style.width = '4px';
    trail.style.height = '4px';
    trail.style.opacity = '0.5';
    trail.style.animation = 'none';
    document.body.appendChild(trail);

    setTimeout(function() {
        trail.style.opacity = '0';
        trail.style.transform = 'scale(0)';
        trail.style.transition = 'all 0.5s ease';
    }, 100);

    setTimeout(function() {
        trail.remove();
    }, 600);
});

// Initialize
window.addEventListener('DOMContentLoaded', function() {
    createParticles();
});
</script>

