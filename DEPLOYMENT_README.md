# 🚀 Render.com Deployment Guide

## Prerequisites

1. **GitHub Account** - Your code needs to be on GitHub
2. **Render Account** - Sign up at [render.com](https://render.com)

## Quick Deployment Steps

### 1. Push Code to GitHub
```bash
git push origin main
```

### 2. Connect to Render
1. Go to [render.com](https://render.com)
2. Click **"New"** → **"Blueprint"**
3. Connect your GitHub repository
4. Render will auto-detect your `render.yaml` configuration

### 3. Configure Environment Variables
In your Render dashboard, update these environment variables:

**Required Changes:**
- `ADMIN_EMAIL` - Set your admin email
- `ADMIN_PASSWORD` - Set a secure password
- `APP_URL` - Will be auto-filled by Render

**Optional:**
- `GOOGLE_ANALYTICS_ID` - Your GA4 ID (already set to G-L0RHNJ2SQB)

### 4. Deploy!
Click **"Create Blueprint"** - Render will build and deploy your app automatically.

## Environment Variables Reference

| Variable | Description | Default |
|----------|-------------|---------|
| `APP_ENV` | Environment | `production` |
| `APP_DEBUG` | Debug mode | `false` |
| `APP_KEY` | Laravel app key | Auto-generated |
| `APP_URL` | Your Render URL | Auto-set |
| `DB_CONNECTION` | Database type | `sqlite` |
| `ADMIN_EMAIL` | Admin login email | `admin@yourportfolio.com` |
| `ADMIN_PASSWORD` | Admin login password | `changeme123!` |

## Admin Access

After deployment, access your admin panel at:
```
https://your-app-name.onrender.com/admin
```

Use the credentials you set in the environment variables.

## Troubleshooting

### Build Fails
- Check Render build logs
- Ensure all dependencies are in `composer.json`
- Verify Node.js version compatibility

### Database Issues
- SQLite is automatically created during build
- Data persists across deployments

### Environment Variables
- All variables are case-sensitive
- Required variables must be set before deployment

## Performance Notes

- **Free Tier**: 750 hours/month
- **Auto-scaling**: Automatic based on traffic
- **SSL**: Automatic HTTPS certificate
- **CDN**: Global CDN included

## Custom Domain (Optional)

1. Go to your Render service settings
2. Add your custom domain
3. Update DNS records as instructed
4. Update `APP_URL` environment variable

## Monitoring

- **Logs**: View in Render dashboard
- **Analytics**: Google Analytics 4 is already integrated
- **Uptime**: Render provides uptime monitoring

## Security Checklist

- ✅ Admin credentials changed from defaults
- ✅ `APP_DEBUG=false` in production
- ✅ HTTPS enabled automatically
- ✅ Secure environment variables
- ✅ File permissions configured

---

**Need Help?** Check Render's documentation or your deployment logs for specific errors.