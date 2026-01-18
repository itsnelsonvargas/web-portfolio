# Laravel Portfolio Website

A modern portfolio website built with Laravel featuring an admin panel for content management.

##  How It Works

### **Architecture**
- **Frontend**: Blade templates with Tailwind CSS
- **Backend**: Laravel 11 with Eloquent ORM
- **Database**: PostgreSQL (Supabase) or SQLite
- **Authentication**: Laravel Sanctum with admin middleware
- **File Storage**: Local storage with upload management

### **Core Features**
- **Public Portfolio**: Showcase projects, skills, contact form
- **Admin Dashboard**: Content management interface
- **User Management**: Admin authentication system
- **File Uploads**: Document and media management

##  Quick Setup

```bash
# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate
php artisan db:seed

# Build assets
npm run build

# Start server
php artisan serve
```

## 📊 Admin Panel Usage

### **Login**
- URL: `/admin/login`
- Email: `admin@example.com`
- Password: `password`

### **Content Management**

#### ** Projects**
- **Add**: `/admin/projects/create` → Fill form → Save
- **Edit**: Click project → "Edit" → Modify → Update
- **Delete**: Click project → "Delete" → Confirm
- **Fields**: Title, Description, Image, Link, Technologies (JSON)

#### ** Trainings**
- **Add**: `/admin/trainings/create` → Fill form → Save
- **Edit**: Click training → "Edit" → Modify → Update
- **Delete**: Click training → "Delete" → Confirm
- **Fields**: Title, Description, Duration, Instructor, Dates

#### ** File Uploads**
- **Upload**: `/admin/files` → Drag/drop or browse → Upload
- **View**: See all uploaded files with details
- **Delete**: Click file → "Delete" → Confirm
- **Download**: Click filename to download

#### ** Contact Messages**
- **View**: Dashboard shows unread messages
- **Read**: Click message → Mark as read
- **Delete**: Click message → "Delete" → Confirm
- **Reply**: Use email from message details

##  Key Components

### **Models**
- `User` - Admin authentication
- `Project` - Portfolio projects
- `Training` - Course/training records
- `ContactMessage` - Contact form submissions
- `Upload` - File management

### **Controllers**
- `Admin\AuthController` - Login/logout
- `Admin\DashboardController` - Statistics overview
- `Admin\TrainingController` - CRUD operations
- `Admin\UploadController` - File management
- `PortfolioController` - Public pages

### **Routes**
```php
// Public routes
GET / - Portfolio homepage
POST /contact - Contact form

// Admin routes (protected)
GET /admin - Dashboard
GET /admin/trainings - Training management
GET /admin/files - File management
```

## 🔧 Development Workflow

### **Adding New Content**
1. Login to admin panel
2. Navigate to desired section
3. Click "Add New" or "Create"
4. Fill required fields
5. Upload images/files if needed
6. Save changes

### **Editing Existing Content**
1. Go to admin section
2. Find item in list
3. Click "Edit" button
4. Modify fields
5. Save changes

### **Deleting Content**
1. Locate item in admin list
2. Click "Delete" button
3. Confirm deletion
4. Content removed permanently

### **File Management**
1. Go to `/admin/files`
2. Upload new files via drag/drop
3. View existing files with metadata
4. Download or delete as needed

## Dashboard Overview

Shows real-time statistics:
- **Projects Count**: Total portfolio items
- **Trainings Count**: Total courses/trainings
- **Uploads Count**: Total files uploaded
- **Messages Count**: Unread contact messages
- **Admin Count**: Total admin users

Recent items display latest additions for quick access.

## Security Features

- **CSRF Protection**: All forms protected
- **Admin Middleware**: Route protection
- **File Validation**: Upload restrictions
- **Input Sanitization**: Laravel automatic
- **Session Management**: Secure user sessions

## Deployment

### **Environment Variables**
```bash
APP_ENV=production
APP_DEBUG=false
APP_KEY=generated-key
DB_CONNECTION=pgsql
# ... Supabase credentials
```

### **Build Process**
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **Post-Deploy**
```bash
php artisan migrate
php artisan db:seed
```

## Troubleshooting

### **Common Issues**
- **Can't login**: Check admin credentials in seeder
- **Uploads fail**: Check file permissions on `storage/`
- **Database errors**: Verify connection in `.env`
- **Assets missing**: Run `npm run build`

### **Logs**
- Laravel logs: `storage/logs/laravel.log`
- Check logs for detailed error information

---

**Read time: ~2 minutes** | **Last updated: January 2025**