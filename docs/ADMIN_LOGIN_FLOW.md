# Admin Login Flow - Testing Guide

## Flow Overview

1. **User visits**: `http://localhost:3147`
2. **index.php checks**: Does `localStorage` have `auth_token`?
   - **NO** → Loads `components/login.php`
   - **YES** → Loads `components/dashboard.php`

## Login Process

### Step 1: Login Page Loads
- URL: `http://localhost:3147`
- File: `frontend/admin-dashboard/index.php`
- Checks `localStorage.getItem('auth_token')`
- No token found → Fetches and displays `components/login.php`

### Step 2: User Enters Credentials
- Email: `admin@vitalnest.com`
- Password: `Admin@123`
- Clicks "Sign In"

### Step 3: Authentication Request
- POST to: `http://localhost:9099/auth/login`
- Payload: `{ email, password }`
- Expected Response:
```json
{
  "success": true,
  "data": {
    "token": "jwt_token_here",
    "user": {
      "id": 1,
      "email": "admin@vitalnest.com",
      "role": "admin",
      "name": "Admin User"
    }
  }
}
```

### Step 4: Token Storage (After Successful Login)
The login.php now stores tokens in THREE places:
1. `localStorage.setItem('auth_token', token)` - For index.php routing check
2. `localStorage.setItem('token', token)` - For dashboard.php authentication
3. `document.cookie = 'token=...'` - For PHP-side authentication

### Step 5: Redirect
- After 1 second delay (for success message)
- Redirects to: `../index.php` (which is `http://localhost:3147`)

### Step 6: Index Reloads
- index.php checks `localStorage.getItem('auth_token')` again
- Token found → Fetches `components/dashboard.php`
- Dashboard displays

## Dashboard Authentication Check

dashboard.php verifies authentication by:
1. Checking cookie: `$_COOKIE['token']`
2. If no cookie → Redirect to `../index.php`
3. JavaScript also checks `localStorage.getItem('token')`

## Logout Process

When user clicks "Logout":
1. Removes `localStorage.removeItem('auth_token')`
2. Removes `localStorage.removeItem('token')`
3. Removes `localStorage.removeItem('user')`
4. Clears cookie: `document.cookie = 'token=; expires=...'`
5. Redirects to: `../index.php`
6. No token found → Shows login page

## Fixed Issues

### Issue 1: Token Key Mismatch ✅ FIXED
- **Problem**: login.php saved as `auth_token`, dashboard.php looked for `token`
- **Solution**: Now saves to BOTH keys

### Issue 2: Missing Cookie ✅ FIXED
- **Problem**: dashboard.php checked `$_COOKIE['token']` but login never set it
- **Solution**: Now sets cookie after successful login

### Issue 3: Incomplete Logout ✅ FIXED
- **Problem**: Logout didn't remove `auth_token`
- **Solution**: Now removes all tokens

### Issue 4: HTML Formatting ✅ FIXED
- **Problem**: Missing newline between `</header>` and `<div>`
- **Solution**: Added proper line break

## Testing Steps

1. **Clear all browser data** (localStorage, cookies, cache)
2. Visit `http://localhost:3147`
3. Should see LOGIN page
4. Enter credentials:
   - Email: `admin@vitalnest.com`
   - Password: `Admin@123`
5. Click "Sign In"
6. Should see "Login successful! Redirecting..." message
7. After 1 second, page reloads
8. Should now see DASHBOARD with:
   - Header "Admin Dashboard"
   - Welcome message "Welcome, admin"
   - Stats cards
   - Quick actions
   - Recent activity
9. Click "Logout"
10. Should return to LOGIN page

## Troubleshooting

### If login doesn't redirect:
1. Check browser console for errors
2. Verify Identity Service is running: `curl http://localhost:9099/auth/login`
3. Check Network tab to see if login request succeeded
4. Verify localStorage has tokens: `localStorage.getItem('auth_token')`

### If dashboard doesn't load:
1. Check localStorage: `localStorage.getItem('auth_token')`
2. Check cookies: `document.cookie`
3. Check browser console for fetch errors

### If redirects to login after successful authentication:
1. Check cookie is set: `document.cookie`
2. Verify token hasn't expired
3. Check dashboard.php isn't clearing tokens

## Service Dependencies

- **Identity Service**: `http://localhost:9099` (Port 9099)
- **Admin Dashboard**: `http://localhost:3147` (Port 3147)

Make sure both services are running before testing.
