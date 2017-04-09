<?php

use Illuminate\Database\Seeder;
use Sitec\Sicms\Models\Blog;
use Sitec\Sicms\Models\FAQ;
use Sitec\Sicms\Models\Page;
use Sitec\Sicms\Models\Widget;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FAQ::create([
            'question' => 'What on earth is Quantum?',
            'answer' => 'Quantum is a starter app using Sicms. It makes it easy as possible to jumpstart an app/ website by allowing you to get started with as little as a single command to create the project.',
            'is_published' => true,
            'published_at' => \Carbon\Carbon::now()->subDays(1),
        ]);

        Widget::create([
            'name' => 'faq-description',
            'slug' => 'faq-description',
            'content' => 'Here we\'re actually using a widget to fill in some content. This gives TONS of freedom to the design to fit content where needed.',
        ]);

        Page::create([
            'title' => 'Welcome',
            'url' => 'welcome',
            'template' => 'featured-template',
            'seo_description' => 'First page on my awesome new website',
            'entry' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>',
            'is_published' => true,
            'published_at' => \Carbon\Carbon::now()->subDays(1),
        ]);

        Blog::create([
            'title' => 'Entry Number One',
            'url' => 'entry-number-one',
            'tags' => 'Writing',
            'seo_description' => 'This is some magic SEO yeah',
            'template' => 'show',
            'entry' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>',
            'is_published' => true,
            'published_at' => \Carbon\Carbon::now()->subDays(1),
        ]);
    }
}
