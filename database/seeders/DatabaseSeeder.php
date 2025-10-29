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
            'demo_url' => 'https://tbtp-staging.dswd.gov.ph',
            'github_url' => '',
            'technologies' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'jQuery'],
            'featured' => true,
        ]);

        \App\Models\Project::create([
            'title' => 'Tara, Basa! Digital Portal v2',
            'description' => 'A collaborative task management application with real-time updates, team collaboration features, and project tracking.',
            'image' => 'https://via.placeholder.com/600x400/10b981/ffffff?text=Task+Manager',
            'demo_url' => '',
            'github_url' => '',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
            'featured' => true,
        ]);

        \App\Models\Project::create([
            'title' => 'e-commerce website',
            'description' => 'A content management system specifically designed for portfolios and creative professionals. Easy to customize and extend.',
            'image' => 'https://via.placeholder.com/600x400/8b5cf6/ffffff?text=Portfolio+CMS',
            'demo_url' => '',
            'github_url' => 'https://github.com/itsnelsonvargas/eGrocery',
            'technologies' => ['Laravel', 'Blade', 'Bootstrap','jQuery', 'MySQL'],
            'featured' => false,
        ]);

        // Seed Skills - Balanced distribution
        // Backend
        \App\Models\Skill::create(['name' => 'PHP', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'category' => 'Backend', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Laravel', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'category' => 'Backend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Redis', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redis/redis-original.svg', 'category' => 'Backend', 'proficiency' => 70]);

        // Frontend
        \App\Models\Skill::create(['name' => 'JavaScript', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'category' => 'Frontend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Vue.js', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'category' => 'Frontend', 'proficiency' => 75]);
        \App\Models\Skill::create(['name' => 'HTML/CSS', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg', 'category' => 'Frontend', 'proficiency' => 95]);
        \App\Models\Skill::create(['name' => 'Tailwind CSS', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'category' => 'Frontend', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Bootstrap', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg', 'category' => 'Frontend', 'proficiency' => 95]);

        // Database
        \App\Models\Skill::create(['name' => 'MySQL', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'category' => 'Database', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'SQLite', 'logo_url' => '', 'category' => 'Database', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'MariaDB', 'logo_url' => '', 'category' => 'Database', 'proficiency' => 95]);

        // DevOps
        \App\Models\Skill::create(['name' => 'Git', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg', 'category' => 'DevOps', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'GitHub', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg', 'category' => 'DevOps', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'GitLab', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/gitlab/gitlab-original.svg', 'category' => 'DevOps', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'Linux', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg', 'category' => 'DevOps', 'proficiency' => 80]);

        // Tools
        \App\Models\Skill::create(['name' => 'VS Code', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg', 'category' => 'Tools', 'proficiency' => 95]);
        \App\Models\Skill::create(['name' => 'Sublime Text', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'JCreator', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'PyCharm', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/pycharm/pycharm-original.svg', 'category' => 'Tools', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'Visual Studio', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visualstudio/visualstudio-plain.svg', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'XAMPP', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Navicat', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 80]);
        \App\Models\Skill::create(['name' => 'MySQL Workbench', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Trello', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/trello/trello-plain.svg', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'ClickUp', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Postman', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postman/postman-original.svg', 'category' => 'Tools', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'Notepad++', 'logo_url' => '', 'category' => 'Tools', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Android Studio', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/androidstudio/androidstudio-original.svg', 'category' => 'Tools', 'proficiency' => 75]);

        // Programming Languages
        \App\Models\Skill::create(['name' => 'Java', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'category' => 'Programming Languages', 'proficiency' => 85]);
        \App\Models\Skill::create(['name' => 'Python', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', 'category' => 'Programming Languages', 'proficiency' => 90]);
        \App\Models\Skill::create(['name' => 'C#', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/csharp/csharp-original.svg', 'category' => 'Programming Languages', 'proficiency' => 75]);
        \App\Models\Skill::create(['name' => 'C++', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg', 'category' => 'Programming Languages', 'proficiency' => 70]);
        \App\Models\Skill::create(['name' => 'VB.NET', 'logo_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dot-net/dot-net-original.svg', 'category' => 'Programming Languages', 'proficiency' => 95]);

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
            'description' => 'DSWD Special Order No. 2434 series of 2025. Official certification demonstrating advanced Laravel framework knowledge and best practices.',
            'date' => '2022-05-10',
            'icon' => '📜',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Designated Safety and Evacuation Officer (SEO)',
            'type' => 'achievement',
            'issuer' => 'Department of Social Welfare and Development',
            'description' => 'Provided safety and evacuation training to staff, ensuring preparedness for emergencies in the workplace.',
            'date' => '2024-01-01',
            'icon' => '⭐',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Certified Six Sigma Yellow Belt',
            'type' => 'certificate',
            'issuer' => 'Prof. Dr. Marcelo Machado  Fernandes',
            'description' => 'A professional certification focused on foundational knowledge of Six Sigma principles for process improvement.',
            'date' => '2024-04-27',
            'icon' => '📜',
            'url' => '#',
        ]);

        \App\Models\Achievement::create([
            'title' => 'Civil Service Eligibility - Professional Level',
            'type' => 'certificate',
            'issuer' => 'Civil Service Commission',
            'description' => 'Passed the Civil Service Examination for Professional Level, demonstrating knowledge in public administration and governance.',
            'date' => '2019-09-04',
            'icon' => '📜',
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
            'testimonial' => 'As a Statistician, I handle reports and budget tasks. Nelson reliably supports data gathering, report preparation, and the CY 2025 budget, consistently demonstrating efficiency, adaptability, and professionalism.'
            'image' => 'https://ui-avatars.com/api/?name=Leonard+Deano&size=200&background=8b5cf6&color=fff',
        ]);

        \App\Models\CharacterReference::create([
            'name' => 'Engr. John Louise Noel Baloloy ',
            'position' => 'Mechanical Engineer',
            'company' => 'Partido State University',
            'relationship' => 'Collegue',
            'phone' => '0906-319-4627',
            'email' => 'johnlouisenoel.baloloy@parsu.edu.ph',
            'testimonial' => 'I’ve had the privilege of working with Sir Nelson, and I can confidently say he is one of the most reliable and detail-oriented developers/instructors I’ve met.',
            'image' => 'https://ui-avatars.com/api/?name=John+Louise+Noel+Baloloy&size=200&background=10b981&color=fff',
        ]);

    }
}
