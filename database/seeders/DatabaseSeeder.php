<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Profile data is now in .env file, not database

        // Seed Projects
        \App\Models\Project::create([
            'title' => 'E-Commerce Platform',
            'description' => 'A full-featured e-commerce platform with shopping cart, payment integration, and admin dashboard. Built with Laravel and Vue.js.',
            'image' => 'https://via.placeholder.com/600x400/3b82f6/ffffff?text=E-Commerce',
            'demo_url' => 'https://example.com/demo',
            'github_url' => 'https://github.com/username/ecommerce',
            'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Stripe'],
            'featured' => true,
            'order' => 1,
        ]);

        \App\Models\Project::create([
            'title' => 'Task Management App',
            'description' => 'A collaborative task management application with real-time updates, team collaboration features, and project tracking.',
            'image' => 'https://via.placeholder.com/600x400/10b981/ffffff?text=Task+Manager',
            'demo_url' => 'https://example.com/tasks',
            'github_url' => 'https://github.com/username/task-app',
            'technologies' => ['React', 'Node.js', 'MongoDB', 'Socket.io', 'Material-UI'],
            'featured' => true,
            'order' => 2,
        ]);

        \App\Models\Project::create([
            'title' => 'Portfolio CMS',
            'description' => 'A content management system specifically designed for portfolios and creative professionals. Easy to customize and extend.',
            'image' => 'https://via.placeholder.com/600x400/8b5cf6/ffffff?text=Portfolio+CMS',
            'demo_url' => 'https://example.com/cms',
            'github_url' => 'https://github.com/username/portfolio-cms',
            'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'PostgreSQL'],
            'featured' => false,
            'order' => 3,
        ]);

        // Seed Skills - Balanced distribution (5 skills per category)
        // Backend
        \App\Models\Skill::create(['name' => 'PHP', 'icon' => '🐘', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'category' => 'Backend', 'proficiency' => 95, 'order' => 1]);
        \App\Models\Skill::create(['name' => 'Laravel', 'icon' => '⚡', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'category' => 'Backend', 'proficiency' => 90, 'order' => 2]);
        \App\Models\Skill::create(['name' => 'Node.js', 'icon' => '🟢', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg', 'category' => 'Backend', 'proficiency' => 85, 'order' => 3]);
        \App\Models\Skill::create(['name' => 'Express.js', 'icon' => '🚂', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original.svg', 'category' => 'Backend', 'proficiency' => 80, 'order' => 4]);
        \App\Models\Skill::create(['name' => 'REST APIs', 'icon' => '🔌', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/fastapi/fastapi-original.svg', 'category' => 'Backend', 'proficiency' => 90, 'order' => 5]);

        // Frontend
        \App\Models\Skill::create(['name' => 'JavaScript', 'icon' => '📜', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'category' => 'Frontend', 'proficiency' => 90, 'order' => 6]);
        \App\Models\Skill::create(['name' => 'TypeScript', 'icon' => '📘', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg', 'category' => 'Frontend', 'proficiency' => 85, 'order' => 7]);
        \App\Models\Skill::create(['name' => 'React', 'icon' => '⚛️', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg', 'category' => 'Frontend', 'proficiency' => 85, 'order' => 8]);
        \App\Models\Skill::create(['name' => 'Vue.js', 'icon' => '💚', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'category' => 'Frontend', 'proficiency' => 80, 'order' => 9]);
        \App\Models\Skill::create(['name' => 'HTML/CSS', 'icon' => '🌐', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg', 'category' => 'Frontend', 'proficiency' => 95, 'order' => 10]);

        // Database
        \App\Models\Skill::create(['name' => 'MySQL', 'icon' => '🐬', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'category' => 'Database', 'proficiency' => 85, 'order' => 11]);
        \App\Models\Skill::create(['name' => 'PostgreSQL', 'icon' => '🐘', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'category' => 'Database', 'proficiency' => 75, 'order' => 12]);
        \App\Models\Skill::create(['name' => 'MongoDB', 'icon' => '🍃', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg', 'category' => 'Database', 'proficiency' => 70, 'order' => 13]);
        \App\Models\Skill::create(['name' => 'Redis', 'icon' => '⚡', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg', 'category' => 'Database', 'proficiency' => 80, 'order' => 14]);
        \App\Models\Skill::create(['name' => 'Tailwind CSS', 'icon' => '🎨', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'category' => 'Database', 'proficiency' => 90, 'order' => 15]);

        // DevOps & Tools
        \App\Models\Skill::create(['name' => 'Git', 'icon' => '📦', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg', 'category' => 'DevOps', 'proficiency' => 90, 'order' => 16]);
        \App\Models\Skill::create(['name' => 'Docker', 'icon' => '🐳', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg', 'category' => 'DevOps', 'proficiency' => 80, 'order' => 17]);
        \App\Models\Skill::create(['name' => 'AWS', 'icon' => '☁️', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original-wordmark.svg', 'category' => 'DevOps', 'proficiency' => 75, 'order' => 18]);
        \App\Models\Skill::create(['name' => 'CI/CD', 'icon' => '🔄', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg', 'category' => 'DevOps', 'proficiency' => 70, 'order' => 19]);
        \App\Models\Skill::create(['name' => 'Linux', 'icon' => '🐧', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg', 'category' => 'DevOps', 'proficiency' => 85, 'order' => 20]);

        // Programming Languages
        \App\Models\Skill::create(['name' => 'Java', 'icon' => '☕', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'category' => 'Programming Languages', 'proficiency' => 80, 'order' => 21]);
        \App\Models\Skill::create(['name' => 'Python', 'icon' => '🐍', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', 'category' => 'Programming Languages', 'proficiency' => 85, 'order' => 22]);
        \App\Models\Skill::create(['name' => 'C#', 'icon' => '🔷', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/csharp/csharp-original.svg', 'category' => 'Programming Languages', 'proficiency' => 75, 'order' => 23]);
        \App\Models\Skill::create(['name' => 'C++', 'icon' => '⚙️', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg', 'category' => 'Programming Languages', 'proficiency' => 70, 'order' => 24]);
        \App\Models\Skill::create(['name' => 'VB.NET', 'icon' => '💎', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dot-net/dot-net-original.svg', 'category' => 'Programming Languages', 'proficiency' => 65, 'order' => 25]);

        // Social links are now in .env file, not database

        // Seed Experiences
        \App\Models\Experience::create([
            'company' => 'Tech Innovations Inc.',
            'position' => 'Senior Full Stack Developer',
            'location' => 'San Francisco, CA',
            'start_date' => '2021-01-15',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Leading development of enterprise web applications and mentoring junior developers.',
            'responsibilities' => [
                'Architecting and developing scalable web applications using Laravel and React',
                'Leading a team of 5 developers and conducting code reviews',
                'Implementing CI/CD pipelines and automated testing',
                'Collaborating with product managers to define technical requirements',
            ],
            'order' => 1,
        ]);

        \App\Models\Experience::create([
            'company' => 'Digital Solutions LLC',
            'position' => 'Full Stack Developer',
            'location' => 'San Francisco, CA',
            'start_date' => '2018-06-01',
            'end_date' => '2020-12-31',
            'is_current' => false,
            'description' => 'Developed and maintained multiple client projects using modern web technologies.',
            'responsibilities' => [
                'Built custom web applications using PHP, JavaScript, and MySQL',
                'Worked directly with clients to gather requirements and provide solutions',
                'Maintained and optimized existing codebases',
                'Implemented responsive designs using CSS frameworks',
            ],
            'order' => 2,
        ]);

        \App\Models\Experience::create([
            'company' => 'StartUp Studio',
            'position' => 'Junior Web Developer',
            'location' => 'Oakland, CA',
            'start_date' => '2016-08-01',
            'end_date' => '2018-05-31',
            'is_current' => false,
            'description' => 'Supported development team in building web applications for startup clients.',
            'responsibilities' => [
                'Assisted in developing features for client web applications',
                'Fixed bugs and improved application performance',
                'Wrote technical documentation',
                'Participated in daily standups and sprint planning',
            ],
            'order' => 3,
        ]);

        // Seed Education
        \App\Models\Education::create([
            'institution' => 'University of California, Berkeley',
            'degree' => 'Bachelor of Science',
            'field_of_study' => 'Computer Science',
            'location' => 'Berkeley, CA',
            'start_date' => '2012-09-01',
            'end_date' => '2016-05-31',
            'is_current' => false,
            'description' => 'Focused on software engineering, data structures, and web development.',
            'grade' => '3.8 GPA',
            'achievements' => [
                'Dean\'s List all semesters',
                'Computer Science Department Scholarship',
                'Led university hackathon team to 2nd place finish',
                'President of Web Development Club',
            ],
            'order' => 1,
        ]);

        \App\Models\Education::create([
            'institution' => 'Coding Bootcamp Academy',
            'degree' => 'Full Stack Web Development Certificate',
            'field_of_study' => 'Web Development',
            'location' => 'Online',
            'start_date' => '2016-01-01',
            'end_date' => '2016-06-30',
            'is_current' => false,
            'description' => 'Intensive program covering modern web development technologies and best practices.',
            'grade' => null,
            'achievements' => [
                'Graduated top of class',
                'Built 5 full-stack projects',
                'Received job placement assistance',
            ],
            'order' => 2,
        ]);

        // Seed Achievements
        \App\Models\Achievement::create([
            'title' => 'AWS Certified Solutions Architect',
            'type' => 'certificate',
            'issuer' => 'Amazon Web Services',
            'description' => 'Professional certification demonstrating expertise in designing distributed systems on AWS.',
            'date' => '2023-08-15',
            'icon' => '🏆',
            'url' => '#',
            'order' => 1,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Best Web Application Award',
            'type' => 'award',
            'issuer' => 'Tech Innovation Summit 2023',
            'description' => 'Won first place for innovative e-commerce platform with AI-powered recommendations.',
            'date' => '2023-11-20',
            'icon' => '🥇',
            'url' => null,
            'order' => 2,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Laravel Certified Developer',
            'type' => 'certificate',
            'issuer' => 'Laravel',
            'description' => 'Official certification demonstrating advanced Laravel framework knowledge and best practices.',
            'date' => '2022-05-10',
            'icon' => '📜',
            'url' => '#',
            'order' => 3,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Open Source Contributor',
            'type' => 'achievement',
            'issuer' => 'GitHub',
            'description' => 'Contributed to 50+ open source projects with over 1000 stars combined.',
            'date' => '2024-01-01',
            'icon' => '⭐',
            'url' => 'https://github.com',
            'order' => 4,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Google Cloud Professional',
            'type' => 'certificate',
            'issuer' => 'Google Cloud',
            'description' => 'Certified in designing, developing, and managing solutions on Google Cloud Platform.',
            'date' => '2023-03-22',
            'icon' => '☁️',
            'url' => '#',
            'order' => 5,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Hackathon Winner',
            'type' => 'award',
            'issuer' => 'Code Masters Hackathon 2022',
            'description' => 'Led team to victory building a real-time collaboration tool in 48 hours.',
            'date' => '2022-09-15',
            'icon' => '💻',
            'url' => null,
            'order' => 6,
        ]);
    }
}
