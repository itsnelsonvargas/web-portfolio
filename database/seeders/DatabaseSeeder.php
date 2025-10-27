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
            'title' => 'Tara, Basa! Digital Portal v1',
            'description' => 'A full-featured e-commerce platform with shopping cart, payment integration, and admin dashboard. Built with Laravel and Vue.js.',
            'image' => 'https://via.placeholder.com/600x400/3b82f6/ffffff?text=E-Commerce',
            'demo_url' => 'https://example.com/demo',
            'github_url' => 'https://github.com/username/ecommerce',
            'technologies' => ['Laravel', 'Bootstrap', 'MySQL', 'Stripe'],
            'featured' => true,
        ]);

        \App\Models\Project::create([
            'title' => 'Tara, Basa! Digital Portal v2',
            'description' => 'A collaborative task management application with real-time updates, team collaboration features, and project tracking.',
            'image' => 'https://via.placeholder.com/600x400/10b981/ffffff?text=Task+Manager',
            'demo_url' => 'https://example.com/tasks',
            'github_url' => 'https://github.com/username/task-app',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Socket.io', 'Material-UI'],
            'featured' => true,
        ]);

        \App\Models\Project::create([
            'title' => 'e-commer website',
            'description' => 'A content management system specifically designed for portfolios and creative professionals. Easy to customize and extend.',
            'image' => 'https://via.placeholder.com/600x400/8b5cf6/ffffff?text=Portfolio+CMS',
            'demo_url' => 'https://example.com/cms',
            'github_url' => 'https://github.com/username/portfolio-cms',
            'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'PostgreSQL'],
            'featured' => false,
        ]);

        // Seed Skills - Balanced distribution
        // Backend
        \App\Models\Skill::create(['name' => 'PHP', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'category' => 'Backend', 'proficiency' => 95]);
        \App\Models\Skill::create(['name' => 'Laravel', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'category' => 'Backend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Redis', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg', 'category' => 'Backend', 'proficiency' => 80]);

        // Frontend
        \App\Models\Skill::create(['name' => 'JavaScript', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'category' => 'Frontend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Vue.js', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'category' => 'Frontend', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'HTML/CSS', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg', 'category' => 'Frontend', 'proficiency' => 95]);
        \App\Models\Skill::create(['name' => 'Tailwind CSS', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'category' => 'Frontend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Bootstrap', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg', 'category' => 'Frontend', 'proficiency' => 85]);

        // Database
        \App\Models\Skill::create(['name' => 'MySQL', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'category' => 'Database', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'SQLite', 'logo_url' => '', 'category' => 'Database', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'MariaDB', 'logo_url' => '', 'category' => 'Database', 'proficiency' => 90]);

        // DevOps
        \App\Models\Skill::create(['name' => 'Git', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg', 'category' => 'DevOps', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'GitHub', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg', 'category' => 'DevOps', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'GitLab', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/gitlab/gitlab-original.svg', 'category' => 'DevOps', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'Linux', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg', 'category' => 'DevOps', 'proficiency' => 80]);

        // Tools
        \App\Models\Skill::create(['name' => 'VS Code', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg', 'category' => 'Tools', 'proficiency' => 95]);
        \App\Models\Skill::create(['name' => 'Sublime Text', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'JCreator', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 75]);
        \App\Models\Skill::create(['name' => 'PyCharm', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/pycharm/pycharm-original.svg', 'category' => 'Tools', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'Visual Studio', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visualstudio/visualstudio-plain.svg', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'XAMPP', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Navicat', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'MySQL Workbench', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Trello', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/trello/trello-plain.svg', 'category' => 'Tools', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'ClickUp', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Postman', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postman/postman-original.svg', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Notepad++', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Android Studio', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/androidstudio/androidstudio-original.svg', 'category' => 'Tools', 'proficiency' => 75]);

        // Programming Languages
        \App\Models\Skill::create(['name' => 'Java', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'category' => 'Programming Languages', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'Python', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', 'category' => 'Programming Languages', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'C#', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/csharp/csharp-original.svg', 'category' => 'Programming Languages', 'proficiency' => 75]);
        \App\Models\Skill::create(['name' => 'C++', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg', 'category' => 'Programming Languages', 'proficiency' => 70]);
        \App\Models\Skill::create(['name' => 'VB.NET', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dot-net/dot-net-original.svg', 'category' => 'Programming Languages', 'proficiency' => 65]);

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
        ]);

        // Seed Achievements
        \App\Models\Achievement::create([
            'title' => 'Electronic Data Processing Specialist',
            'type' => 'certificate',
            'issuer' => 'Department of Comunications and Information Technology',
            'description' => 'Reached',
            'date' => '',
            'icon' => '🏆',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Philippine Air Force reservist',
            'type' => 'achievement',
            'issuer' => 'Philippine Air Force',
            'description' => 'Trained and certified as a reservist in the Philippine Air Force, demonstrating commitment to national service and discipline.',
            'date' => '2021-07-21',
            'icon' => '🥇',
            'url' => null,
        ]);

        \App\Models\Achievement::create([
            'title' => 'Quick Response Team (QRT) Lead',
            'type' => 'achievement',
            'issuer' => 'Department of Social Welfare and Development',
            'description' => 'Official certification demonstrating advanced Laravel framework knowledge and best practices.',
            'date' => '2022-05-10',
            'icon' => '📜',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Designated Safety and Evacuation Officer (SEO)',
            'type' => 'achievement',
            'issuer' => 'epartment of Social Welfare and Development',
            'description' => 'Contributed to 50+ open source projects with over 1000 stars combined.',
            'date' => '2024-01-01',
            'icon' => '⭐',
            'url' => 'https://github.com',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Google Cloud Professional',
            'type' => 'certificate',
            'issuer' => 'Google Cloud',
            'description' => 'Certified in designing, developing, and managing solutions on Google Cloud Platform.',
            'date' => '2023-03-22',
            'icon' => '☁️',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Hackathon Winner',
            'type' => 'award',
            'issuer' => 'Code Masters Hackathon 2022',
            'description' => 'Led team to victory building a real-time collaboration tool in 48 hours.',
            'date' => '2022-09-15',
            'icon' => '💻',
            'url' => null,
        ]);

        // Seed Character References
        \App\Models\CharacterReference::create([
            'name' => 'Leonard G. Deaño',
            'position' => 'Statistician',
            'company' => 'Department of Social Welfare and Development',
            'relationship' => 'Collegue',
            'phone' => '0966-640-9778',
            'email' => 'lgdeaño@dswd.gov.ph',
            'testimonial' => 'I had the pleasure of supervising this outstanding developer for over three years. Their technical expertise, dedication, and problem-solving abilities consistently exceeded expectations. They demonstrate strong leadership skills and are an invaluable asset to any team.',
            'image' => '',
        ]);

        \App\Models\CharacterReference::create([
            'name' => 'Engr. John Louise Noel Baloloy ',
            'position' => 'Engineering Instructor',
            'company' => 'Partido State University',
            'relationship' => 'Collegue',
            'phone' => '0906-319-4627',
            'email' => 'michael.chen@digitalsolutions.com',
            'testimonial' => 'Working with this developer was a true pleasure. They consistently delivered high-quality code on time and showed excellent communication skills throughout multiple complex projects. Their ability to translate business requirements into technical solutions is exceptional.',
            'image' => 'https://ui-avatars.com/api/?name=Michael+Chen&size=200&background=10b981&color=fff',
        ]);

        \App\Models\CharacterReference::create([
            'name' => 'Emily Rodriguez',
            'position' => 'IT Officer II',
            'company' => '',
            'relationship' => 'Former Supervisor',
            'phone' => '+1 (555) 456-7890',
            'email' => 'emily.rodriguez@startupstudio.com',
            'testimonial' => 'As a team lead, I was impressed by their quick learning ability and enthusiasm for new technologies. They consistently took initiative, mentored junior developers, and contributed innovative solutions to challenging problems. Highly recommended!',
            'image' => 'https://ui-avatars.com/api/?name=Emily+Rodriguez&size=200&background=8b5cf6&color=fff',
        ]);
    }
}
