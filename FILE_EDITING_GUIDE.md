# File-Based Content Management Guide

Since your portfolio now uses JSON files instead of a database, here's how to edit your content:

## 📁 Data Files Location
All your portfolio data is stored in the `data/` directory as JSON files:

```
data/
├── profile.json          # Your personal info, bio, experience stats
├── projects.json         # Portfolio projects
├── skills.json           # Technical skills
├── trainings.json        # Certifications & courses
├── achievements.json     # Awards & recognitions
├── references.json       # Character references
├── social_links.json     # Social media links
└── settings.json         # Site configuration
```

## 🛠️ How to Edit Content

### Method 1: Direct JSON Editing (Recommended)
1. Open any JSON file in your code editor (VS Code, etc.)
2. Edit the content following JSON syntax
3. Save the file
4. Commit and push to Git

### Method 2: Using Scripts
You can create simple scripts to update content programmatically.

## 📝 Content Structure Examples

### Profile (profile.json)
```json
[
  {
    "id": 1,
    "name": "Your Name",
    "title": "Full Stack Developer",
    "bio": "Passionate developer with 3+ years of experience...",
    "email": "your.email@example.com",
    "phone": "+1 (555) 123-4567",
    "location": "Your City, Country",
    "profile_image": "/storage/profile/your-photo.jpg",
    "resume_url": "https://example.com/resume.pdf",
    "large_scale_projects": 5,
    "years_of_experience": 3,
    "created_at": "2025-01-01T00:00:00.000000Z",
    "updated_at": "2025-01-01T00:00:00.000000Z"
  }
]
```

### Projects (projects.json)
```json
[
  {
    "id": 1,
    "title": "E-commerce Platform",
    "description": "Full-stack e-commerce solution...",
    "image": "/storage/projects/ecommerce.jpg",
    "demo_url": "https://demo.example.com",
    "github_url": "https://github.com/user/project",
    "technologies": ["Laravel", "Vue.js", "MySQL"],
    "created_at": "2025-01-01T00:00:00.000000Z",
    "updated_at": "2025-01-01T00:00:00.000000Z"
  }
]
```

## ⚠️ Important Notes

1. **JSON Syntax**: Always validate JSON syntax before saving
2. **Git Workflow**: Changes are tracked in Git - commit regularly
3. **Backup**: Your data is now in version control, so it's safe
4. **Deployment**: Changes deploy automatically with your code

## 🔧 Admin Interface Status

Currently, the admin interface is **read-only** for most content:
- ✅ **Profile editing** works (saves to profile.json)
- ✅ **Training viewing** works (reads from trainings.json)
- ⚠️ **Training editing** disabled (edit trainings.json directly)
- ⚠️ **Project/Skills editing** disabled (edit JSON files directly)

## 🚀 Future Improvements

To make editing easier, you could add:
1. A simple web-based JSON editor
2. GitHub-integrated content management
3. Automated JSON validation
4. Content import/export tools

## 📞 Need Help?

If you need to make changes but aren't comfortable editing JSON:
1. Describe what you want to change
2. I'll help you update the JSON files
3. Or create helper scripts for common operations
