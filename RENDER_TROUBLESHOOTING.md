# Render Deployment Troubleshooting Guide

## Issue: Application keeps loading but pages don't show

This guide will help you troubleshoot and fix deployment issues on Render.com.

### Step 1: Check Render Logs

1. Go to your [Render Dashboard](https://dashboard.render.com/)
2. Click on your web service
3. Click the "Logs" tab
4. Look for error messages

### Common Issues and Solutions

#### Issue 1: Build Fails

**Symptoms:**
- Logs show "Build failed" or similar error
- Container never starts

**Solutions:**
```bash
# Check for these specific errors in logs:

# Error: "postcss.config.js not found"
# FIXED: We removed postcss.config.js from Dockerfile

# Error: Permission denied
# FIXED: Dockerfile now runs as root, processes run as www-data

# Error: npm ci failed
# Solution: Check package.json and package-lock.json are committed
```

#### Issue 2: Container Starts But Pages Don't Load

**Symptoms:**
- Build succeeds
- Container is running
- But visiting URL shows loading forever or 502/504 error

**Check these in logs:**

1. **Entrypoint script errors:**
   ```
   Look for: "Starting Laravel Application Setup"
   Should see all 7 steps completing
   ```

2. **Migration errors:**
   ```
   Look for: "Running database migrations..."
   Should see: "Migrations completed successfully"
   If it says "WARNING: Migrations failed" - check database setup
   ```

3. **Nginx/PHP-FPM not starting:**
   ```
   Look for:
   - "nginx entered RUNNING state"
   - "php-fpm entered RUNNING state"

   If missing, supervisor isn't starting properly
   ```

4. **Port issues:**
   ```
   Should see nginx listening on port 8080
   Render expects port 8080
   ```

#### Issue 3: Environment Variables Not Set

**Symptoms:**
- Application starts but shows errors
- 500 Internal Server Error

**Solution:**
1. Go to your service in Render Dashboard
2. Click "Environment" tab
3. Ensure APP_KEY is set:
   ```bash
   # Generate locally:
   php artisan key:generate --show

   # Copy the output (e.g., base64:xxxxx)
   # Add to Render environment variables
   ```

4. Verify all required variables:
   - APP_KEY (CRITICAL - must be set!)
   - APP_ENV=production
   - APP_DEBUG=false
   - APP_URL=https://your-app.onrender.com
   - DB_CONNECTION=sqlite

#### Issue 4: APP_KEY Not Set or Invalid

**Symptoms:**
- "No application encryption key has been specified"
- Application won't start
- 500 errors

**Solution:**
```bash
# Generate a new key locally:
php artisan key:generate --show

# Or use this command:
echo "base64:$(openssl rand -base64 32)"

# Add to Render Environment Variables:
APP_KEY=base64:your-generated-key-here
```

After adding/updating APP_KEY, Render will automatically redeploy.

#### Issue 5: Database/Storage Permission Errors

**Symptoms:**
- "Permission denied" errors in logs
- Database errors
- Can't write to storage

**Solution:**
The entrypoint script now handles this automatically. Check logs for:
```
[1/7] Setting up permissions...
[2/7] Setting up database...
```

If these fail, the Dockerfile might not have been rebuilt properly.

### Quick Fix Checklist

Try these in order:

1. **Force Rebuild**
   - In Render Dashboard, click "Manual Deploy" → "Clear build cache & deploy"

2. **Check Environment Variables**
   - Ensure APP_KEY is set
   - Ensure APP_URL matches your Render URL

3. **Check Render Service Logs**
   - Look for the startup sequence (1/7 through 7/7)
   - Ensure nginx and php-fpm are RUNNING

4. **Test Health Endpoint**
   - Visit: `https://your-app.onrender.com/health`
   - Should return: "healthy"
   - If this works, nginx is running

5. **Check Application Logs**
   ```
   In Render logs, look for:
   - PHP errors
   - Laravel errors
   - Nginx errors
   ```

### Verify Everything is Working

After deployment, check these endpoints:

1. **Health Check:**
   ```
   https://your-app.onrender.com/health
   → Should return "healthy"
   ```

2. **Homepage:**
   ```
   https://your-app.onrender.com/
   → Should show your portfolio
   ```

### Reading Render Logs

Important log sections to look for:

```bash
# 1. Build Phase
"Building Docker image..."
"Step 1/20 : FROM node:22-alpine AS frontend"
# Should complete without errors

# 2. Startup Phase
"========================================="
"Starting Laravel Application Setup"
"[1/7] Setting up permissions..."
# All 7 steps should complete

# 3. Services Starting
"php-fpm entered RUNNING state"
"nginx entered RUNNING state"
"laravel-queue entered RUNNING state"

# 4. Application Ready
"Application Setup Complete!"
"Starting web server..."
```

### Still Not Working?

If you've tried everything above:

1. **Check the generated files are committed:**
   ```bash
   git status

   # Make sure these are tracked:
   - Dockerfile
   - docker/entrypoint.sh
   - docker/nginx.conf
   - docker/supervisord.conf
   - docker/php-fpm.conf
   - render.yaml
   - .dockerignore
   ```

2. **Verify file permissions locally:**
   ```bash
   # Entrypoint must be executable:
   chmod +x docker/entrypoint.sh
   git add docker/entrypoint.sh
   git commit -m "Fix entrypoint permissions"
   git push
   ```

3. **Test Docker build locally:**
   ```bash
   # Build the image
   docker build -t web-portfolio-test .

   # Run it
   docker run -p 8080:8080 \
     -e APP_KEY=base64:test-key-here \
     -e APP_ENV=production \
     -e APP_DEBUG=false \
     web-portfolio-test

   # Visit http://localhost:8080
   ```

4. **Contact Render Support:**
   - If the issue persists, provide them with:
     - Your service logs
     - Your Dockerfile
     - Error messages you're seeing

### Recent Fixes Applied

These issues have been fixed in the latest version:

- ✅ Removed postcss.config.js dependency (not needed)
- ✅ Fixed permission issues (Docker runs as root, app processes as www-data)
- ✅ Added /var/log/supervisor directory
- ✅ Improved entrypoint script with better logging
- ✅ Added health check route in Laravel
- ✅ Fixed supervisor to run as root
- ✅ Added detailed setup logging (7 steps)

After pulling these fixes, do a clean deploy on Render.

## Next Steps

After fixing the deployment:

1. **Monitor Performance:**
   - Check response times
   - Monitor memory usage in Render Dashboard

2. **Consider Upgrades:**
   - Free tier has limited resources
   - Consider paid plan for:
     - Better performance
     - Persistent disk storage
     - More memory/CPU

3. **Add Database Persistence:**
   - Current SQLite database resets on redeploy
   - Consider using Render PostgreSQL for production

4. **Set up Custom Domain:**
   - Go to "Settings" in Render Dashboard
   - Add your custom domain
   - Update APP_URL environment variable
