# Mixed Content Error - Quick Fix Guide

## Problem
Your Laravel app is loading assets (CSS/JS) over HTTP instead of HTTPS, causing browser security errors.

**Error:** "Mixed Content: The page was loaded over HTTPS, but requested an insecure stylesheet/script"

## Root Cause
Laravel doesn't know it's behind Render's HTTPS proxy, so it generates HTTP URLs for assets.

## Solutions Applied

I've made three critical fixes to your code:

### 1. Force HTTPS in Production
**File:** `app/Providers/AppServiceProvider.php`

```php
public function boot(): void
{
    // Force HTTPS in production (when behind a proxy like Render)
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
}
```

This tells Laravel to always generate HTTPS URLs when `APP_ENV=production`.

### 2. Trust Proxies
**File:** `bootstrap/app.php`

```php
->withMiddleware(function (Middleware $middleware): void {
    // Trust all proxies (safe on Render.com)
    $middleware->trustProxies(at: '*', headers: [
        'X-Forwarded-For',
        'X-Forwarded-Host',
        'X-Forwarded-Port',
        'X-Forwarded-Proto',
    ]);
})
```

This tells Laravel to trust Render's proxy headers so it knows the request came via HTTPS.

### 3. Updated APP_URL
**File:** `render.yaml`

```yaml
- key: APP_URL
  value: https://nelsonvargas.onrender.com
```

Set the correct HTTPS URL for your app.

## How to Deploy the Fix

### Step 1: Commit and Push
```bash
git add .
git commit -m "Fix mixed content error: force HTTPS and trust proxies"
git push origin main
```

### Step 2: Update APP_URL in Render Dashboard (CRITICAL!)
Even if you push the code, you need to update the environment variable in Render:

1. Go to [Render Dashboard](https://dashboard.render.com/)
2. Click on your service (nelsonvargas)
3. Click "Environment" tab
4. Find `APP_URL`
5. Change it to: `https://nelsonvargas.onrender.com`
6. Click "Save Changes"

Render will automatically redeploy.

### Step 3: Verify APP_ENV is Production
In the same Environment tab, verify:
```
APP_ENV=production
```

If it's set to `local` or `development`, change it to `production`.

### Step 4: Clear Cache (Optional)
After deployment, you can clear the cache by running these in Render Shell:

1. Go to your service in Render Dashboard
2. Click "Shell" tab
3. Run:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

Then run:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Quick Test

After deployment:

1. Visit: `https://nelsonvargas.onrender.com/`
2. Open browser DevTools (F12)
3. Go to "Console" tab
4. Refresh the page
5. You should see NO mixed content errors

## If It Still Doesn't Work

### Check 1: Verify Environment Variables
In Render Dashboard → Environment tab, ensure:
- `APP_ENV=production` ✅
- `APP_URL=https://nelsonvargas.onrender.com` ✅
- `APP_DEBUG=false` ✅

### Check 2: Check Logs
In Render Dashboard → Logs tab, look for:
```
[5/7] Optimizing application...
php artisan config:cache
```

This should run without errors.

### Check 3: Hard Refresh Browser
Sometimes browsers cache the old HTTP links:
- Windows/Linux: `Ctrl + Shift + R`
- Mac: `Cmd + Shift + R`

### Check 4: Inspect Asset URLs
In DevTools → Elements tab, find:
```html
<link rel="stylesheet" href="https://...">
<script src="https://...">
```

The URLs should start with `https://`, not `http://`.

## Why This Fix Works

1. **URL::forceScheme('https')** - Forces all generated URLs to use HTTPS
2. **trustProxies()** - Tells Laravel to detect HTTPS from proxy headers
3. **APP_URL with HTTPS** - Ensures asset URLs are generated with HTTPS

All three work together to ensure your app knows it's being served over HTTPS.

## Prevention

For future deployments:
- Always set `APP_ENV=production` in production
- Always set `APP_URL` to the full HTTPS URL
- Keep the proxy trust configuration in `bootstrap/app.php`

## Additional Notes

- This fix is safe and follows Laravel best practices
- Trusting all proxies (`*`) is safe on Render because you control the infrastructure
- This will NOT affect local development (only runs when `APP_ENV=production`)
