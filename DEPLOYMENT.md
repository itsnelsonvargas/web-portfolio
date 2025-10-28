# Deployment Guide for Render.com

This guide will help you deploy your Laravel web portfolio to Render.com using Docker.

## Prerequisites

1. A [Render.com](https://render.com) account (free tier available)
2. Your code pushed to a Git repository (GitHub, GitLab, or Bitbucket)

## Deployment Steps

### Option 1: Using render.yaml (Recommended)

1. **Push your code to Git**
   ```bash
   git add .
   git commit -m "Add Docker configuration for Render deployment"
   git push origin main
   ```

2. **Connect to Render**
   - Go to [Render Dashboard](https://dashboard.render.com/)
   - Click "New" → "Blueprint"
   - Connect your repository
   - Render will automatically detect the `render.yaml` file

3. **Review and Deploy**
   - Review the configuration
   - Click "Apply"
   - Render will build and deploy your application

### Option 2: Manual Setup

1. **Create a New Web Service**
   - Go to [Render Dashboard](https://dashboard.render.com/)
   - Click "New" → "Web Service"
   - Connect your repository

2. **Configure the Service**
   - **Name**: `web-portfolio` (or your preferred name)
   - **Runtime**: Docker
   - **Region**: Choose the closest to your users
   - **Branch**: `main` (or your default branch)
   - **Plan**: Free (or choose a paid plan for better performance)

3. **Set Environment Variables**

   Go to the "Environment" tab and add these variables:

   ```
   APP_NAME=Web Portfolio
   APP_ENV=production
   APP_KEY=<generate-using-php-artisan-key-generate>
   APP_DEBUG=false
   APP_URL=https://your-app-name.onrender.com
   DB_CONNECTION=sqlite
   SESSION_DRIVER=database
   CACHE_STORE=database
   QUEUE_CONNECTION=database
   LOG_CHANNEL=stack
   LOG_LEVEL=error

   # Portfolio Configuration
   PORTFOLIO_NAME=Your Name
   PORTFOLIO_TITLE=Your Title
   PORTFOLIO_BIO=Your Bio
   PORTFOLIO_EMAIL=your@email.com
   PORTFOLIO_PHONE=Your Phone
   PORTFOLIO_LOCATION=Your Location
   PORTFOLIO_PROFILE_IMAGE=Your Image URL
   PORTFOLIO_RESUME_URL=Your Resume URL
   PORTFOLIO_SOCIAL_GITHUB=GitHub|https://github.com/yourusername
   PORTFOLIO_SOCIAL_LINKEDIN=LinkedIn|https://linkedin.com/in/yourusername
   ```

4. **Deploy**
   - Click "Create Web Service"
   - Render will build your Docker image and deploy

## Generating APP_KEY

You need to generate a unique `APP_KEY` for security. You can:

1. **Locally** (if you have PHP installed):
   ```bash
   php artisan key:generate --show
   ```

2. **Online**:
   Use an online base64 encoder to encode a 32-character random string, or use this format:
   ```
   base64:YOUR_BASE64_ENCODED_32_CHAR_STRING
   ```

## Post-Deployment

1. **Check Health**
   - Visit `https://your-app-name.onrender.com/health`
   - Should return "healthy"

2. **Visit Your Portfolio**
   - Visit `https://your-app-name.onrender.com`

3. **Monitor Logs**
   - Go to your service in Render Dashboard
   - Click "Logs" tab to monitor application logs

## Persistent Storage (Important!)

⚠️ **Note**: Render's free tier uses ephemeral storage, meaning your SQLite database and uploaded files will be reset on each deployment or when the container restarts.

For production use, consider:
- Using Render's PostgreSQL database (instead of SQLite)
- Using S3 or similar for file storage
- Upgrading to a paid plan with persistent disks

## Updating Your Deployment

Render automatically redeploys when you push to your connected Git branch:

```bash
git add .
git commit -m "Update feature"
git push origin main
```

## Troubleshooting

### Build Fails
- Check the build logs in Render Dashboard
- Ensure all configuration files are present
- Verify Dockerfile syntax

### Application Won't Start
- Check environment variables are set correctly
- Verify APP_KEY is set and valid
- Check logs for error messages

### Database Issues
- Ensure `database` directory exists in your repository
- Check file permissions in logs
- Consider switching to PostgreSQL for production

### Port Issues
- The application listens on port 8080 (configured in nginx.conf)
- Render automatically handles SSL/HTTPS

## Performance Tips

1. **Enable Opcache**: Already configured in Dockerfile
2. **Use Redis**: Add Redis service in Render for better caching
3. **CDN**: Use Cloudflare or similar for static assets
4. **Database**: Use PostgreSQL instead of SQLite for better performance

## Support

If you encounter issues:
1. Check Render's [documentation](https://render.com/docs)
2. Review application logs in Render Dashboard
3. Check Laravel logs at `/storage/logs/laravel.log`

## Local Testing

Test the Docker setup locally before deploying:

```bash
# Build the image
docker build -t web-portfolio .

# Run the container
docker run -p 8080:8080 --env-file .env web-portfolio

# Visit http://localhost:8080
```
