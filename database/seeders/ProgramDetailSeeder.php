<?php

namespace Database\Seeders;

use App\Models\ProgramDetail;
use Illuminate\Database\Seeder;

class ProgramDetailSeeder extends Seeder
{
    public function run(): void
    {
        $mca = ProgramDetail::firstOrCreate(
            ['slug' => 'mca'],
            [
                'title'       => 'Master of Computer Applications',
                'short_name'  => 'MCA',
                'school_name' => 'School of Computer Applications · GNIMT',
                'level'       => 'Post Graduation Degree',
                'duration'    => '2 Years',
                'locations'   => 'Patiala &amp; Karnal',
                'hero_image'  => 'images/programs/bg1.jpg',
                'cta_image'   => 'images/programs/bg2.jpg',
                'quote'       => 'Turn Challenges Into Solutions Through Technology.',
                'overview_1'  => 'The Master of Computer Applications (MCA) is a postgraduate program designed to provide advanced knowledge and practical skills in computer science, software development, and information technology. The course equips students with the expertise required to develop innovative software solutions and manage modern computing systems across various industries.',
                'overview_2'  => 'The curriculum combines theoretical concepts with hands-on training, covering key areas such as programming languages, database management systems, software engineering, system analysis and design, computer networks, web technologies, cloud computing, cybersecurity, data analytics, and emerging technologies. Students gain practical exposure through projects, case studies, industry-oriented assignments, and internships.',
                'overview_3'  => 'Upon successful completion of the program, graduates develop strong problem-solving, analytical, and technical skills, enabling them to design, develop, test, and maintain software applications that meet organizational and customer requirements. The program also helps students stay updated with the latest advancements and trends in the rapidly evolving IT sector.',
                'overview_4'  => 'With a strong academic framework and industry-focused approach, the MCA program has consistently demonstrated excellent academic outcomes and career opportunities, preparing students for successful careers in software development, IT consulting, system administration, database management, web and mobile application development, and other technology-driven fields.',
                'eligibility' => 'BCA or Bachelor\'s degree in Computer Science / Engineering or its equivalent degree or B.Sc. / B.A. / B.Com / BBA with Mathematics at 10+2 or its equivalent level or Graduation level <em>(with an additional bridge course as per norms of University).</em>',
                'status'      => 1,
                'sort_order'  => 0,
            ]
        );

        if ($mca->wasRecentlyCreated || $mca->opportunities()->count() === 0) {
            $opportunities = [
                ['fas fa-building',         'Information Technology (IT) Companies'],
                ['fas fa-code',             'Software Development Industry'],
                ['fas fa-mobile-alt',       'Web and Mobile Application Development'],
                ['fas fa-cloud',            'Cloud Computing Services'],
                ['fas fa-chart-bar',        'Data Analytics and Data Science'],
                ['fas fa-robot',            'Artificial Intelligence (AI) & Machine Learning'],
                ['fas fa-shield-alt',       'Cyber Security'],
                ['fas fa-database',         'Database Management'],
                ['fas fa-network-wired',    'Network Administration'],
                ['fas fa-sitemap',          'System Analysis and Design'],
                ['fas fa-bug',              'Software Testing & Quality Assurance'],
                ['fas fa-shopping-cart',    'E-Commerce Industry'],
                ['fas fa-university',       'Fintech and Banking Technology'],
                ['fas fa-broadcast-tower',  'Telecommunications'],
                ['fas fa-heartbeat',        'Healthcare IT Services'],
                ['fas fa-chalkboard',       'Educational Technology (EdTech)'],
                ['fas fa-landmark',         'Government IT Departments'],
                ['fas fa-industry',         'Public Sector Undertakings (PSUs)'],
                ['fas fa-flask',            'Research and Development Organizations'],
                ['fas fa-briefcase',        'Consulting and IT Services'],
                ['fas fa-bullhorn',         'Digital Marketing & Technology Solutions'],
                ['fas fa-lightbulb',        'Startups and Entrepreneurship'],
                ['fas fa-cogs',             'Business Process Management (BPM)'],
                ['fas fa-server',           'Enterprise Resource Planning (ERP) Services'],
                ['fas fa-gamepad',          'Game Development Industry'],
            ];

            foreach ($opportunities as $i => [$icon, $title]) {
                $mca->opportunities()->create([
                    'icon'       => $icon,
                    'title'      => $title,
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
