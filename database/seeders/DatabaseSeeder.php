<?php

namespace Database\Seeders;

use App\Models\AboutMe;
use App\Models\Experience;
use App\Models\ExperienceList;
use App\Models\FunFact;
use App\Models\Hero;
use App\Models\Knowledge;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name'  => 'Shadhin Ahmed',
            'email' => 'shadhinplanet@gmail.com',
            'password' => bcrypt('123'),
        ]);

        Hero::create(
            [
                'title'         =>'Shadhin Ahmed',
                'subtitle'      =>'Creative Freelancer',
                'image'         =>'SHA_0439-small.jpg',
                'skill_list'    =>'Web Designer,Web Developer,App Developer',
            ]
        );

        // Knowledge
        Knowledge::create([
            'name'      => 'WordPress',
            'image'      => 'wordpress.svg',
        ]);
        Knowledge::create([
            'name'      => 'Laravel',
            'image'      => 'laravel.svg',
        ]);
        Knowledge::create([
            'name'      => 'Nuxt',
            'image'      => 'nuxt.svg',
        ]);
        Knowledge::create([
            'name'      => 'Tailwind css',
            'image'      => 'tailwindcss.svg',
        ]);
        Knowledge::create([
            'name'      => 'HTML',
            'image'      => 'html.svg',
        ]);
        Knowledge::create([
            'name'      => 'CSS',
            'image'      => 'css.svg',
        ]);
        Knowledge::create([
            'name'      => 'Photoshop',
            'image'      => 'photoshop.svg',
        ]);
        Knowledge::create([
            'name'      => 'Illustrator',
            'image'      => 'illustrator.svg',
        ]);
        Knowledge::create([
            'name'      => 'Figma',
            'image'      => 'figma.svg',
        ]);
        Knowledge::create([
            'name'      => 'XD',
            'image'      => 'xd.svg',
        ]);



        AboutMe::create([
            'title' => 'Hi There! <br>I\'m Shadhin Ahmed',
            'subtitle' => 'About Me',
            'description' => 'A creative freelancer with 7 years of professional experience, specialized in Web Design and Development. I build clean, appealing, and functional interfaces that comply with the latest web standards.',
            'signature' => 'signature.png',
            'thumbnail' => 'shadhin.jpg',
            'cv_link' => 'CV - SHADHIN.pdf',
        ]);

        Service::create([
            'title' => 'I offer a full-cycle of Web Development Services',
            'subtitle' => 'Services',
            'description' => 'For more than 20 years our experts have been accomplishing enough with modern Web Development, new generation programming language, and full stack developers to
            deliver cost-effective solutions.',
        ]);


        // Skills
        Skill::create([
            'name'  => 'HTML & CSS',
            'value'  => '95',
            'color'  => '#d07020',
        ]);
        Skill::create([
            'name'  => 'Wordpress',
            'value'  => '90',
            'color'  => '#d07020',
        ]);
        Skill::create([
            'name'  => 'Laravel',
            'value'  => '85',
            'color'  => '#d07020',
        ]);
        Skill::create([
            'name'  => 'Nuxt JS',
            'value'  => '90',
            'color'  => '#d07020',
        ]);
        Skill::create([
            'name'  => 'Photoshop & Illustrator',
            'value'  => '85',
            'color'  => '#d07020',
        ]);
        Skill::create([
            'name'  => 'Figma & XD',
            'value'  => '85',
            'color'  => '#d07020',
        ]);

        // Service List
        ServicesList::create([
            'name'  => 'Design',
            'icon'  => 'design.svg',
        ]);
        ServicesList::create([
            'name'  => 'Development',
            'icon'  => 'code.svg',
        ]);
        ServicesList::create([
            'name'  => 'Support',
            'icon'  => 'support.svg',
        ]);
        ServicesList::create([
            'name'  => 'Debug',
            'icon'  => 'debug.svg',
        ]);
        ServicesList::create([
            'name'  => 'Award',
            'icon'  => 'debug.svg',
        ]);
        ServicesList::create([
            'name'  => 'Maintain',
            'icon'  => 'tools.svg',
        ]);


        // Portfolio
        Portfolio::create([
            'title' => 'Each project is a unique piece of development',
            'subtitle' => 'PORTFOLIO',
        ]);

        // Fun Facts
        FunFact::create([
            'title' => 'Complete Projects',
            'value' => 787,
            'suffix' => '+',
            'icon'  => 'database.svg'
        ]);
        FunFact::create([
            'title' => 'Happy Clients',
            'value' => 347,
            'suffix' => '+',
            'icon'  => 'happy.svg'
        ]);
        FunFact::create([
            'title' => 'Sleepless Night',
            'value' => 250,
            'suffix' => '+',
            'icon'  => 'coffee-cup.svg'
        ]);
        FunFact::create([
            'title' => 'Positive Rating',
            'value' => 98,
            'suffix' => '%',
            'icon'  => 'thumb-up.svg'
        ]);

        // Experience
        Experience::create([
            'title' => 'My Journey',
            'subtitle' => 'EXPERIENCES',
            'description' => 'Obviously I\'m a Web Designer. Experienced with all stages of the development cycle for dynamic web projects.            ',
        ]);

        ExperienceList::create([
            'title'         => 'Graphic Designer',
            'company_name'  => 'Apple',
            'company_tag'   => 'Testor',
            'description'   => 'Therefore always free from repetition, injected humour, or non-characteristic words etc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,',
            'start_date'    => '2010',
            'end_date'      => '2012',
        ]);

        ExperienceList::create([
            'title'         => 'Web Developer',
            'company_name'  => 'Oppo',
            'company_tag'   => 'HR Manager',
            'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet.',
            'start_date'    => '2012',
            'end_date'      => '2015',
        ]);

        ExperienceList::create([
            'title'         => 'UX Designer',
            'company_name'  => 'Vivo',
            'company_tag'   => 'Senior Designer',
            'description'   => 'The generated injected humour, or non-characteristic words etc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,',
            'start_date'    => '2015',
            'end_date'      => '2020',
        ]);


    }
}
