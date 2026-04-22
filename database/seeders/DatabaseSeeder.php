<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        // Add Admin User
        \App\Models\User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name'              => 'Md Saiful Islam',
            'password'          => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Add Default Settings
        $settings = [
            ['key' => 'site_title', 'value' => 'Md Saiful Islam | Software Developer', 'type' => 'text'],
            ['key' => 'logo', 'value' => null, 'type' => 'image'],
            ['key' => 'bio_name', 'value' => 'MD SAIFUL ISLAM', 'type' => 'text'],
            ['key' => 'bio_title', 'value' => 'Software Developer', 'type' => 'text'],
            ['key' => 'about_title', 'value' => 'About Me', 'type' => 'text'],
            ['key' => 'about_subtitle', 'value' => 'Laravel Developer & Visionary Photographer', 'type' => 'text'],
            ['key' => 'bio_tagline', 'value' => 'Seeking a role where my passion for innovation and creativity aligns with a dynamic environment.', 'type' => 'text'],
            ['key' => 'about_image', 'value' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600&h=800', 'type' => 'image'],
            ['key' => 'bio_description', 'value' => "Seeking a role where my passion for innovation and creativity aligns with a dynamic environment that values my academic skills. Committed to leveraging my technical knowledge and driving fresh ideas for meaningful contributions to our nation's success.", 'type' => 'textarea'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/saifulislam07', 'type' => 'text'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/in/saifulislam07', 'type' => 'text'],
            ['key' => 'github', 'value' => 'https://github.com/saifulislam07', 'type' => 'text'],
            ['key' => 'whatsapp', 'value' => '+8801916**58**', 'type' => 'text'],
            ['key' => 'email', 'value' => 'saiful.rana@gmail.com', 'type' => 'text'],
            ['key' => 'phone', 'value' => '+8801916**58**', 'type' => 'text'],
            ['key' => 'address', 'value' => 'South Kafrul, Cantonment, Dhaka - 1206', 'type' => 'text'],
            ['key' => 'education_masters', 'value' => 'Masters of Management, Govt. Titumir College (2013 - 2015)', 'type' => 'text'],
            ['key' => 'education_bachelor', 'value' => 'Bachelor of Business Studies, Govt. Titumir College (2010 - 2013)', 'type' => 'text'],
            ['key' => 'education_hsc', 'value' => 'HSC-Science, Hesakhal Bazar College (2006 - 2008)', 'type' => 'text'],
            ['key' => 'education_ssc', 'value' => 'SSC-Science, Hesakhal Bazar High School (2003 - 2004)', 'type' => 'text'],
            ['key' => 'dob', 'value' => '01 Aug ***8', 'type' => 'text'],
            ['key' => 'blood_group', 'value' => 'B+', 'type' => 'text'],
            ['key' => 'district', 'value' => 'Cumilla', 'type' => 'text'],
            ['key' => 'hobbies', 'value' => 'Photography, Traveling, Coding, Reading, Gaming', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Portfolio of Md Saiful Islam, a passionate Software Developer specialized in Laravel.', 'type' => 'textarea'],
            ['key' => 'meta_keywords', 'value' => 'Saiful Islam, Laravel Developer, PHP Developer, Portfolio, Software Engineer', 'type' => 'text'],
            ['key' => 'google_analytics', 'value' => '', 'type' => 'text'],
            ['key' => 'is_maintenance', 'value' => '0', 'type' => 'text'],
            // SMTP Settings
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io', 'type' => 'text'],
            ['key' => 'mail_port', 'value' => '2525', 'type' => 'text'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'text'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'text'],
            ['key' => 'mail_from_address', 'value' => 'hello@example.com', 'type' => 'text'],
            ['key' => 'mail_from_name', 'value' => 'Saiful Portfolio', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value'], 'type' => $setting['type']]);
        }

        // Add Skills
        $skills = [
            ['name' => 'PHP', 'percentage' => 95],
            ['name' => 'MySQL', 'percentage' => 90],
            ['name' => 'Laravel', 'percentage' => 95],
            ['name' => 'Codeigniter', 'percentage' => 90],
            ['name' => 'API', 'percentage' => 90],
            ['name' => 'jQuery', 'percentage' => 85],
            ['name' => 'Ajax', 'percentage' => 85],
            ['name' => 'HTML', 'percentage' => 90],
            ['name' => 'CSS', 'percentage' => 85],
            ['name' => 'GIT', 'percentage' => 90],
            ['name' => 'Laragon', 'percentage' => 80],
            ['name' => 'Golang', 'percentage' => 60],
        ];
        foreach ($skills as $skill) {
            \App\Models\Skill::updateOrCreate(['name' => $skill['name']], ['percentage' => $skill['percentage']]);
        }

        // Add Projects (Based on Work Experience)
        $projects = [
            [
                'title'       => 'Jabeda.net - Business Solution SaaS',
                'slug'        => 'jabeda-net',
                'description' => 'A comprehensive business solution SaaS platform developed for Daisen Technology Ltd.',
                'problem'     => 'Need for a unified platform for business management and reporting.',
                'solution'    => 'Built a multi-tenant SaaS application with robust ERP features.',
                'tech_stack'  => ['Laravel', 'PHP', 'MySQL', 'Ajax'],
                'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800',
                'is_featured' => true,
            ],
            [
                'title'       => 'Restaurant Coupon Platform (JAPAN)',
                'slug'        => 'restaurant-coupon-japan',
                'description' => 'A dynamic coupon management system for restaurants in Japan.',
                'problem'     => 'Difficulty in managing and distributing digital coupons for restaurant chains.',
                'solution'    => 'Developed a high-performance coupon distribution system with real-time tracking.',
                'tech_stack'  => ['Laravel', 'PHP', 'MySQL', 'jQuery'],
                'cover_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800',
                'is_featured' => true,
            ],
            [
                'title'       => 'BIEA - Association Portal',
                'slug'        => 'biea-portal',
                'description' => 'Official portal for Bangladesh Industrial Engineer\'s Association (BIEA) managing jobs, blood donations, and membership.',
                'problem'     => 'Fragmented management of association members and services.',
                'solution'    => 'Centralized membership management and service portal for engineers.',
                'tech_stack'  => ['PHP', 'Codeigniter', 'MySQL'],
                'cover_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800',
                'is_featured' => true,
            ],
            [
                'title'       => 'MLM (Trinary System - Auto Club)',
                'slug'        => 'mlm-auto-club',
                'description' => 'Multi-level marketing platform featuring a complex trinary system for auto clubs.',
                'problem'     => 'Complex commission calculations and downline tracking.',
                'solution'    => 'Engineered a highly accurate recursive algorithm for commission and downline management.',
                'tech_stack'  => ['PHP', 'Codeigniter', 'MySQL'],
                'cover_image' => 'https://images.unsplash.com/photo-1551288049-bbbda536ad3a?auto=format&fit=crop&q=80&w=800',
                'is_featured' => false,
            ],
            [
                'title'       => 'Real Estate Accounting Software',
                'slug'        => 'real-estate-accounting',
                'description' => 'Enterprise accounting software specifically designed for real estate companies (TEAM).',
                'problem'     => 'Need for specific financial tracking for property sales and construction expenses.',
                'solution'    => 'Built a custom accounting engine with project-wise financial reporting.',
                'tech_stack'  => ['PHP', 'Codeigniter', 'MySQL', 'Ajax'],
                'cover_image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=800',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            $createdProject = \App\Models\Project::updateOrCreate(['slug' => $project['slug']], $project);

            // Add cover image to project images
            \App\Models\ProjectImage::updateOrCreate(
                ['project_id' => $createdProject->id, 'image_path' => $project['cover_image']],
                ['project_id' => $createdProject->id, 'image_path' => $project['cover_image']]
            );

            // Add extra images specifically for the MLM project
            if ($project['slug'] === 'mlm-auto-club') {
                $mlmImages = [
                    'https://images.unsplash.com/photo-1551288049-bbbda536ad3a?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1543286386-713bdd548da4?auto=format&fit=crop&q=80&w=800',
                ];
                foreach ($mlmImages as $img) {
                    \App\Models\ProjectImage::updateOrCreate(
                        ['project_id' => $createdProject->id, 'image_path' => $img],
                        ['project_id' => $createdProject->id, 'image_path' => $img]
                    );
                }
            }
        }

        // Add Categories
        $categories = [
            ['name' => 'Nature', 'slug' => 'nature'],
            ['name' => 'Architecture', 'slug' => 'architecture'],
            ['name' => 'Street', 'slug' => 'street'],
        ];
        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Add Gallery Photos
        $categoryIds = \App\Models\Category::pluck('id', 'slug');
        $photos = [
            ['title' => 'Mist over Mountains', 'category_id' => $categoryIds['nature'], 'image_path' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=800'],
            ['title' => 'Urban Symmetry', 'category_id' => $categoryIds['architecture'], 'image_path' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'],
            ['title' => 'Night City Life', 'category_id' => $categoryIds['street'], 'image_path' => 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&q=80&w=800'],
            ['title' => 'Forest Path', 'category_id' => $categoryIds['nature'], 'image_path' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&q=80&w=800'],
            ['title' => 'Minimalist Facade', 'category_id' => $categoryIds['architecture'], 'image_path' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&q=80&w=800'],
        ];
        foreach ($photos as $photo) {
            \App\Models\Gallery::updateOrCreate(['title' => $photo['title']], $photo);
        }
    }
}
