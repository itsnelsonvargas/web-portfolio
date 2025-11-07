# Web Portfolio Setup Guide

## Project Overview

This is a **Laravel 12** web portfolio application featuring:

- **Portfolio Display**: Showcase projects, skills, achievements, education, and work experience
- **Contact Form**: Visitors can send messages via email
- **Seminar Certificates**: Displays certificates/files from `public/seminars` folder
- **Character References**: Testimonials from colleagues
- **Google Drive Integration**: Optional integration for file management
- **Modern UI**: Built with Tailwind CSS 4 and Vite
- **Docker Support**: Ready for deployment on Render.com or other platforms

## Project Structure

```
web-portfolio/
├── app/
│   ├── Http/Controllers/     # PortfolioController, SeminarController
│   ├── Models/                # Database models (Project, Skill, Experience, etc.)
│   ├── Mail/                  # Email handling (ContactFormMail)
│   └── Services/              # GoogleDriveService
├── database/
│   ├── migrations/            # Database schema migrations
│   └── seeders/               # DatabaseSeeder (populates sample data)
├── resources/
│   ├── views/                 # Blade templates
│   ├── css/                   # Tailwind CSS
│   └── js/                    # JavaScript
├── public/                    # Public assets
│   └── seminars/              # Seminar certificates (PDFs, images, etc.)
├── routes/
│   └── web.php                # Application routes
├── config/                    # Configuration files
├── docker/                    # Docker configuration files
└── Dockerfile                 # Multi-stage Docker build
```

## Prerequisites

### Option 1: Local Development (Recommended for Development)

- **PHP 8.2+** with extensions: pdo, pdo_sqlite, mbstring, xml, gd, curl
- **Composer** (PHP package manager)
- **Node.js 18+** and **npm**
- **SQLite** (included with PHP)

### Option 2: Docker (Recommended for Production/Testing)

- **Docker Desktop** (Windows/Mac) or **Docker** (Linux)
- **Node.js 18+** and **npm** (for building assets locally, optional)

## Setup Instructions

### Option 1: Local Development Setup

#### Step 1: Install PHP and Composer

**Windows:**
1. Download PHP from [php.net](https://windows.php.net/download/)
2. Download Composer from [getcomposer.org](https://getcomposer.org/download/)
3. Add PHP and Composer to your system PATH

**macOS:**
```bash
brew install php@8.2 composer
```

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-sqlite php8.2-mbstring php8.2-xml php8.2-gd php8.2-curl composer
```

#### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### Step 3: Environment Configuration

The `.env` file already exists. Verify it has these settings:

```env
APP_NAME="Web Portfolio"
APP_ENV=local
APP_KEY=base64:your-generated-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite by default)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Portfolio Information (from .env)
PORTFOLIO_NAME=Your Name
PORTFOLIO_TITLE=Your Title
PORTFOLIO_BIO=Your Bio
PORTFOLIO_EMAIL=your@email.com
PORTFOLIO_PHONE=Your Phone
PORTFOLIO_LOCATION=Your Location
PORTFOLIO_PROFILE_IMAGE=https://ui-avatars.com/api/?name=Your+Name&size=400
PORTFOLIO_RESUME_URL=Your Resume URL

# Social Links (format: Platform|URL)
PORTFOLIO_SOCIAL_GITHUB=GitHub|https://github.com/yourusername
PORTFOLIO_SOCIAL_LINKEDIN=LinkedIn|https://linkedin.com/in/yourusername

# Optional: Google Drive Integration
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/google/callback
GOOGLE_DRIVE_FOLDER_ID=your-folder-id

# Optional: Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Step 4: Generate Application Key

```bash
php artisan key:generate
```

#### Step 5: Create Database

```bash
# Create SQLite database file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

#### Step 6: Build Frontend Assets

```bash
# Development mode (with hot reload)
npm run dev

# OR Production build
npm run build
```

#### Step 7: Start Development Server

In a new terminal:

```bash
php artisan serve
```

Visit: `http://localhost:8000`

**OR use the convenient dev script:**

```bash
composer run dev
```

This runs:
- Laravel server (port 8000)
- Queue worker
- Log viewer (Pail)
- Vite dev server (with hot reload)

### Option 2: Docker Setup

#### Step 1: Build Docker Image

```bash
docker build -t web-portfolio .
```

#### Step 2: Create .env file

Ensure your `.env` file is configured (see Step 3 above).

#### Step 3: Run Container

```bash
docker run -d \
  -p 8080:8080 \
  --name web-portfolio \
  --env-file .env \
  web-portfolio
```

#### Step 4: Access Application

Visit: `http://localhost:8080`

#### Step 5: View Logs

```bash
docker logs -f web-portfolio
```

#### Step 6: Stop Container

```bash
docker stop web-portfolio
docker rm web-portfolio
```

## Quick Setup Script

The project includes a setup script in `composer.json`:

```bash
composer run setup
```

This will:
1. Install Composer dependencies
2. Copy `.env.example` to `.env` (if needed)
3. Generate application key
4. Run migrations
5. Install npm dependencies
6. Build frontend assets

## Database Management

### Reset Database

The project includes a temporary route for resetting the database:

```
GET /reset-db
```

**⚠️ WARNING**: Remove this route in production!

### Manual Database Reset

```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Or without seeding
php artisan migrate:fresh
```

## Adding Seminar Certificates

Place certificate files (PDF, images, etc.) in:

```
public/seminars/
```

Supported formats:
- PDF: `.pdf`
- Documents: `.doc`, `.docx`, `.ppt`, `.pptx`, `.xls`, `.xlsx`
- Images: `.jpg`, `.jpeg`, `.png`, `.gif`, `.webp`
- Videos: `.mp4`, `.avi`, `.mov`
- Archives: `.zip`

Files are automatically detected and displayed on the portfolio page.

## Environment Variables Reference

### Required Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `APP_KEY` | Laravel encryption key | `base64:...` |
| `APP_URL` | Application URL | `http://localhost:8000` |
| `PORTFOLIO_NAME` | Your full name | `John Doe` |
| `PORTFOLIO_EMAIL` | Your email | `john@example.com` |

### Optional Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `PORTFOLIO_TITLE` | Your job title | - |
| `PORTFOLIO_BIO` | Short bio | - |
| `PORTFOLIO_PHONE` | Phone number | - |
| `PORTFOLIO_LOCATION` | Location | - |
| `PORTFOLIO_PROFILE_IMAGE` | Profile image URL | - |
| `PORTFOLIO_RESUME_URL` | Resume/CV URL | - |
| `PORTFOLIO_SOCIAL_*` | Social media links | - |
| `GOOGLE_CLIENT_ID` | Google OAuth client ID | - |
| `GOOGLE_CLIENT_SECRET` | Google OAuth secret | - |
| `GOOGLE_DRIVE_FOLDER_ID` | Google Drive folder ID | - |

## Deployment

### Render.com (Recommended)

See `DEPLOYMENT.md` for detailed instructions.

The project includes:
- `render.yaml` - Render.com configuration
- `Dockerfile` - Multi-stage Docker build
- Health check endpoint: `/health`

### Other Platforms

The Dockerfile can be used with:
- AWS ECS/Fargate
- Google Cloud Run
- Azure Container Instances
- DigitalOcean App Platform
- Heroku (with Docker support)

## Troubleshooting

### PHP Not Found

**Windows:**
- Add PHP to system PATH
- Restart terminal/IDE

**macOS/Linux:**
- Verify installation: `php --version`
- Check PATH: `which php`

### Composer Not Found

**Windows:**
- Download from [getcomposer.org](https://getcomposer.org/download/)
- Add to PATH

**macOS:**
```bash
brew install composer
```

**Linux:**
```bash
sudo apt install composer
```

### Database Errors

```bash
# Ensure SQLite file exists
touch database/database.sqlite

# Check permissions
chmod 664 database/database.sqlite

# Run migrations
php artisan migrate
```

### Frontend Assets Not Loading

```bash
# Rebuild assets
npm run build

# Clear Laravel cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Permission Errors (Linux/macOS)

```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Development Workflow

1. **Make Changes**: Edit code in `app/`, `resources/`, etc.
2. **Watch Assets**: Run `npm run dev` for hot reload
3. **Test**: Visit `http://localhost:8000`
4. **Database Changes**: Create migrations with `php artisan make:migration`
5. **Build for Production**: Run `npm run build`

## Project Features

### Models

- **Profile**: Personal information (from .env)
- **Project**: Portfolio projects
- **Skill**: Technical skills with categories
- **Experience**: Work experience
- **Education**: Educational background
- **Achievement**: Certificates and achievements
- **CharacterReference**: Professional references
- **ContactMessage**: Contact form submissions
- **SocialLink**: Social media links (from .env)

### Routes

- `GET /` - Portfolio homepage
- `POST /contact` - Submit contact form
- `GET /health` - Health check endpoint
- `GET /reset-db` - Reset database (remove in production!)

## Next Steps

1. ✅ Set up the project using one of the methods above
2. ✅ Customize `.env` with your information
3. ✅ Add your projects, skills, and achievements
4. ✅ Add seminar certificates to `public/seminars/`
5. ✅ Configure email settings for contact form
6. ✅ Deploy to production (see `DEPLOYMENT.md`)

## Support

For issues or questions:
- Check `DEPLOYMENT.md` for deployment help
- Check `RENDER_TROUBLESHOOTING.md` for Render.com issues
- Review Laravel documentation: [laravel.com/docs](https://laravel.com/docs)

