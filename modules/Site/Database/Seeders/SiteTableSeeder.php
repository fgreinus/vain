<?php

namespace Modules\Site\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Site\Entities\Content;
use Modules\Site\Entities\Page;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('Modules\Site\Database\Seeders\PagesTableSeeder');
        $this->call('Modules\Site\Database\Seeders\ContentsTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('site_pages')->delete();

        Page::create([
            'id'      => 1,
            'user_id' => 1,
            'slug'    => 'setup-the-development-environment',
        ]);

        Page::create([
            'id'      => 2,
            'user_id' => 1,
            'slug'    => 'project-setup-and-maintenance',
        ]);
    }
}

class ContentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('site_pages_content')->delete();

        Content::create([
            'id'          => 1,
            'locale'      => 'en',
            'page_id'     => 1,
            'title'       => 'Setup the Development Environment',
            'keywords'    => 'setup, development, environment',
            'description' => 'A simple explanation of how to setup your dev environment.',
            'text'        => <<<EOF
<div class="markdown-body">
    <p><em>Already got the Virtual Machine up and running? Follow the <a href="project-setup-and-maintenance">Project Setup and Maintenance</a> guide for required first-start instructions and maintenance operations.</em></p>
    <h2>
        <a id="user-content-table-of-contents" class="anchor" href="#table-of-contents" aria-hidden="true"><span class="octicon octicon-link"></span></a>Table of Contents
    </h2>
    <ol class="task-list">
        <li><a href="#required-software">Required Software</a></li>
        <li>
            <a href="#host-setup">Host Setup</a>
            <ul class="task-list">
                <li><a href="#software-installation">Software Installation</a></li>
                <li><a href="#configuring-homestead">Configuring Homestead</a></li>
                <li><a href="#edit-your-machines-hosts-file">Edit your machine's hosts file</a></li>
            </ul>
        </li>
        <li>
            <a href="#boot-it-up">Boot it up</a>
            <ul class="task-list">
                <li><a href="#where-to-go-from-here">Where to go from here?</a></li>
            </ul>
        </li>
    </ol>
    <h2>
        <a id="user-content-required-software" class="anchor" href="#required-software" aria-hidden="true"><span class="octicon octicon-link"></span></a>Required Software
    </h2>
    <p>In order to run the Vain development environment, you have to install the following tools on your machine:</p>
    <ul class="task-list">
        <li>Virtualbox - <a href="https://www.virtualbox.org/wiki/Downloads">Download</a></li>
        <li>Vagrant - <a href="http://www.vagrantup.com/downloads.html">Download</a></li>
        <li>Laravel Homestead - <a href="http://laravel.com/docs/5.0/homestead">Documentation and Installation Instructions</a></li>
    </ul>
    <p><strong>Optional</strong></p>
    <p>The following software is optional, but in some cases it may improve productivity. Furthermore it will reflect the later production state and use case much more.</p>
    <ul class="task-list">
        <li>ManGOS - <a href="https://github.com/cmangos/issues/wiki/Installation-Instructions">Installation Guide</a></li>
        <li>Trinity - <a href="http://collab.kpsn.org/display/tc/Installation+Guide">Installation Guide</a></li>
    </ul>
    <p><em>All dependencies which Vain will actually need are installed within the Laravel Homestead Virtual Machine.</em></p>
    <h2>
        <a id="user-content-host-setup" class="anchor" href="#host-setup" aria-hidden="true"><span class="octicon octicon-link"></span></a>Host Setup
    </h2>
    <h3>
        <a id="user-content-software-installation" class="anchor" href="#software-installation" aria-hidden="true"><span class="octicon octicon-link"></span></a>Software Installation
    </h3>
    <p>Install Virtualbox and Vagrant and Laravel Homestead (<em>in that order</em>) by following the installation manuals on the corresponding pages.</p>
    <h3>
        <a id="user-content-configuring-homestead" class="anchor" href="#configuring-homestead" aria-hidden="true"><span class="octicon octicon-link"></span></a>Configuring Homestead
    </h3>
    <p>After you installed Homestead fire up your terminal and type <code>homestead edit</code>. Your favorite text editor will show up with the <code>Homestead.yaml</code> file opened.</p>
    <p>Configure the IP, Memory, CPUs, SSH Key and Shared Folders to your belongings. Finally we edit the <code>sites</code> array and add the following entry:</p>
    <div class="highlight highlight-yaml">
        <pre><span class="pl-s1"><span class="pl-ent">sites:</span></span>
    <span class="pl-s1">- <span class="pl-ent">map:</span> <span class="pl-s1">vain.app</span></span>
      <span class="pl-s1"><span class="pl-ent">to:</span> <span class="pl-s1">/home/vagrant/Code/vain/public</span></span></pre>
    </div>
    <p><strong>NOTE:</strong> If you changed the Shared Folders you have to replace <code>/home/vagrant/Code</code></p>
    <p>Finally tell Homestead, that we need a <code>vain</code> database for our environment by adding it to the <code>databases</code> array like so:</p>
    <div class="highlight highlight-yaml">
        <pre><span class="pl-s1"><span class="pl-ent">databases:</span></span>
    <span class="pl-s1">- <span class="pl-s1">vain</span></span></pre>
    </div>
    <p>As an reference from the Laravel Homestead guide, the following ports are forwarded to your Homestead environment:</p>
    <blockquote>
        <ul class="task-list">
            <li>SSH: 2222 -&gt; Forwards To 22</li>
            <li>HTTP: 8000 -&gt; Forwards To 80</li>
            <li>MySQL: 33060 -&gt; Forwards To 3306</li>
            <li>Postgres: 54320 -&gt; Forwards To 5432</li>
        </ul>
    </blockquote>
    <h3>
        <a id="user-content-edit-your-machines-hosts-file" class="anchor" href="#edit-your-machines-hosts-file" aria-hidden="true"><span class="octicon octicon-link"></span></a>Edit your machine's hosts file
    </h3>
    <p>In order to access your application properly through <code>vain.app</code> in your browser, I highly encourage you to add the following line to your <code>/etc/hosts</code>file replacing <code>x.x.x.x</code> IP with the one from <code>Homestead.yaml</code>:</p>
    <p><code>x.x.x.x vain.app</code></p>
    <h2>
        <a id="user-content-boot-it-up" class="anchor" href="#boot-it-up" aria-hidden="true"><span class="octicon octicon-link"></span></a>Boot it up
    </h2>
    <p>We are finally able to boot our VM using the <code>vagrant</code> like keywords <code>up</code>, <code>resume</code>, <code>suspend</code>, and <code>halt</code> only with the use of the <code>homestead</code> command. </p>
    <p><strong>So boot it up from anywhere with</strong> <code>homestead up</code>.</p>
    <h3>
        <a id="user-content-where-to-go-from-here" class="anchor" href="#where-to-go-from-here" aria-hidden="true"><span class="octicon octicon-link"></span></a>Where to go from here?
    </h3>
    <p>Follow the <a href="project-setup-and-maintenance">Project Setup and Maintenance</a> guide for required first-start instructions and maintenance operations.</p>
</div>
EOF
        ]);

        Content::create([
            'id'          => 2,
            'locale'      => 'en',
            'page_id'     => 2,
            'title'       => 'Project Setup and Maintenance',
            'keywords'    => 'project, setup, maintenance',
            'description' => 'Explanation how to configure the project.',
            'text'        => <<<EOF
<div class="markdown-body">
    <p><em>You already have Vain ready for development? Start contributing! Get a feeling for the platform by reading the <a href="deep-dive-development">Deep Dive Development</a> guide.</em></p>
    <h2>
        <a id="user-content-table-of-contents" class="anchor" href="#table-of-contents" aria-hidden="true"><span class="octicon octicon-link"></span></a>Table of Contents
    </h2>
    <ol class="task-list">
        <li><a href="#introduction">Introduction</a></li>
        <li><a href="#environment">Environment</a></li>
        <li>
            <a href="#dependencies">Dependencies</a>
            <ul class="task-list">
                <li><a href="#backend">Backend</a></li>
                <li><a href="#frontend">Frontend</a></li>
            </ul>
        </li>
        <li>
            <a href="#dependencies">Database</a>
            <ul class="task-list">
                <li><a href="#migration">Migration</a></li>
                <li><a href="#seeding">Seeding</a></li>
            </ul>
        </li>
        <li><a href="#asset-management">Asset Management</a></li>
        <li><a href="#testing">Testing</a></li>
        <li>
            <a href="#you-did-it">You did it!</a>
            <ul class="task-list">
                <li><a href="#where-to-go-from-here">Where to go from here?</a></li>
            </ul>
        </li>
    </ol>
    <h2>
        <a id="user-content-introduction" class="anchor" href="#introduction" aria-hidden="true"><span class="octicon octicon-link"></span></a>Introduction
    </h2>
    <p>These steps are generally required multiple times. You will need to follow them in sequential order if you boot your Homestead VM for the first time. Later on you may need some of them for maintaining the development environment and to complement your development work.</p>
    <p><strong>NOTE:</strong> All of the following steps are performed through an SSH connection to your Homestead VM. To open a SSH connection fire up your terminal and type <code>homestead ssh</code>.</p>
    <h2>
        <a id="user-content-environment" class="anchor" href="#environment" aria-hidden="true"><span class="octicon octicon-link"></span></a>Environment
    </h2>
    <p>You have to supply some environment specific variables to run the application. Having its roots in the ruby community the DotEnv concept is used. For your local development environment just copy the <code>.env.example</code> stub file to <code>.env</code> (don't commit that to any repository!). Check the key-value pairs and verify that everything is correct.</p>
    <p>For more information about DotEnv visit the <a href="http://laravel.com/docs/5.0/configuration#environment-configuration">Laravel Documentation</a>.</p>
    <h2>
        <a id="user-content-dependencies" class="anchor" href="#dependencies" aria-hidden="true"><span class="octicon octicon-link"></span></a>Dependencies
    </h2>
    <p>All dependency management tools have to <strong>run from the project root</strong>. We use the following dependency management tools for both backend and frontend:</p>
    <ul class="task-list">
        <li>
            <a href="https://getcomposer.org">Composer</a> / <a href="https://packagist.org">Repository</a> for Backend
        </li>
        <li>
            <a href="https://www.npmjs.com">NPM</a> for Frontend
        </li>
        <li>
            <a href="http://bower.io">Bower</a> / <a href="http://bower.io/search/">Repository</a> for Frontend
        </li>
    </ul>
    <p><strong>NOTE:</strong> All of them are shipped with Homestead out of the box.</p>
    <h3>
        <a id="user-content-backend" class="anchor" href="#backend" aria-hidden="true"><span class="octicon octicon-link"></span></a>Backend
    </h3>
    <p>Install all PHP backend dependencies with the command <code>composer install</code> or <code>composer update</code>respectively. It reads its dependencies out of the <code>composer.json</code> file.</p>
    <p><em>Examples: <code>laravel</code>, <code>phpSpec</code>, <code>entrust</code></em></p>
    <p>Please don't <code>.gitignore</code> the <code>composer.lock</code> file. Commit it to the repository. It is necessary to install correct dependency versions in production. (<a href="https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file">Source</a>)</p>
    <p>For more Information about Composer visit the <a href="https://getcomposer.org/doc/">Composer Documentation</a>.</p>
    <h3>
        <a id="user-content-frontend" class="anchor" href="#frontend" aria-hidden="true"><span class="octicon octicon-link"></span></a>Frontend
    </h3>
    <p>Why using two dependency managers for the frontend? You can not really differentiate the two dependency managers in general. But for the Vain project you can think of them like the following.</p>
    <p><strong>NPM the Node Package Manger</strong></p>
    <p>..is used to install all system level requirements. Those are necessary to build the frontend but are not required to actually run it. You can think of them as <strong>compile-time dependencies</strong>. Install those by running the command <code>npm install</code> in your terminal. It reads its dependencies out of the <code>package.json</code> file.</p>
    <p><em>Examples: <code>grunt</code>, <code>less</code></em></p>
    <p>For more Information about NPM visit the <a href="https://docs.npmjs.com">NPM Documentation</a>.</p>
    <p><strong>Bower</strong></p>
    <p>..is used to install all frontend frameworks upon which the UI and UIX is built. You can think of them as <strong>runtime dependencies</strong>. Install those - like you would do with composer - using the <code>bower install</code> or <code>bower update</code> command respectively. It reads its dependencies out of the <code>bower.json</code> file.</p>
    <p><em>Examples: <code>bootstrap</code>, <code>AdminLTE</code></em></p>
    <p>For more Information about Bower visit the <a href="http://bower.io/docs/api/">Bower Documentation</a>.</p>
    <h2>
        <a id="user-content-database" class="anchor" href="#database" aria-hidden="true"><span class="octicon octicon-link"></span></a>Database
    </h2>
    <p>Since we use a module architecture in Vain there are some differences to how you normally would migrate and seed a database in Laravel.</p>
    <p><strong>NOTE:</strong> The default artisan database commands will also work but they do not affect the modules.</p>
    <p>For more Information about arisan commands for modules visit the <a href="https://github.com/pingpong-labs/modules/wiki/Artisan-Commands">Module Artisan Commands</a> page.</p>
    <h3>
        <a id="user-content-migration" class="anchor" href="#migration" aria-hidden="true"><span class="octicon octicon-link"></span></a>Migration
    </h3>
    <p>Create new migration for the specified module.</p>
    <ul class="task-list">
        <li><code>php artisan module:migration MIGRATION MODULE</code></li>
    </ul>
    <p>Rollback, Reset and Refresh The Modules Migrations.</p>
    <ul class="task-list">
        <li><code>php artisan module:migrate-rollback</code></li>
        <li><code>php artisan module:migrate-reset</code></li>
        <li><code>php artisan module:migrate-refresh</code></li>
    </ul>
    <p>Rollback, Reset and Refresh The Migrations for the specified module.</p>
    <ul class="task-list">
        <li><code>php artisan module:migrate-rollback MODULE</code></li>
        <li><code>php artisan module:migrate-reset MODULE</code></li>
        <li><code>php artisan module:migrate-refresh MODULE</code></li>
    </ul>
    <p><strong>NOTE:</strong> See <a href="troubleshooting#artisan">this pitfall</a> with <code>module:migrate-rollback</code>.</p>
    <p>Migrate from the specified module.</p>
    <ul class="task-list">
        <li><code>php artisan module:migrate MODULE</code></li>
    </ul>
    <p>Migrate from all modules.</p>
    <ul class="task-list">
        <li><code>php artisan module:migrate</code></li>
    </ul>
    <h3>
        <a id="user-content-seeding" class="anchor" href="#seeding" aria-hidden="true"><span class="octicon octicon-link"></span></a>Seeding
    </h3>
    <p>Create new seed for the specified module.</p>
    <ul class="task-list">
        <li><code>php artisan module:seed-make SEED MODULE</code></li>
    </ul>
    <p>Seed from the specified module.</p>
    <ul class="task-list">
        <li><code>php artisan module:seed MODULE</code></li>
    </ul>
    <p>Seed from all modules.</p>
    <ul class="task-list">
        <li><code>php artisan module:seed</code></li>
    </ul>
    <h2>
        <a id="user-content-asset-management" class="anchor" href="#asset-management" aria-hidden="true"><span class="octicon octicon-link"></span></a>Asset Management
    </h2>
    <p>Building the Frontend is super easy. Since Elixir is built on top of gulp, you only have to run <code>gulp</code>. If you are actively developing the frontend you may choose <code>gulp watch</code> as it automatically triggers recompiles if you change an asset file.</p>
    <p>To get an in-depth guide how to handle assets read the <a href="how-to-elixir">How to Elixir</a> guide.</p>
    <h2>
        <a id="user-content-testing" class="anchor" href="#testing" aria-hidden="true"><span class="octicon octicon-link"></span></a>Testing
    </h2>
    <p>To get more information about testing read the <a href="testing-techniques">Testing Techniques</a> guide.</p>
    <h2>
        <a id="user-content-you-did-it" class="anchor" href="#you-did-it" aria-hidden="true"><span class="octicon octicon-link"></span></a>You did it!
    </h2>
    <p>Very well, you are ready for development. If you need assistance for some maintenance processes you can come back and use this page as an cheatsheet anytime you want.</p>
    <h3>
        <a id="user-content-where-to-go-from-here" class="anchor" href="#where-to-go-from-here" aria-hidden="true"><span class="octicon octicon-link"></span></a>Where to go from here?
    </h3>
    <p>Start contributing! Get a feeling for the platform by reading the <a href="deep-dive-development">Deep Dive Development</a> guide.</p>
</div>
EOF
        ]);
    }
}
