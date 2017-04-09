<?php

namespace Sitec\Siravel;

use Devfactory\Minify\Facades\MinifyFacade;
use Devfactory\Minify\MinifyServiceProvider;
use GrahamCampbell\Markdown\Facades\Markdown;
use GrahamCampbell\Markdown\MarkdownServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Siravel;
use Spatie\LaravelAnalytics\LaravelAnalyticsFacade;
use Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider;
use Sitec\Laracogs\LaracogsProvider;
use Sitec\Siravel\Console\Keys;
use Sitec\Siravel\Console\ModuleComposer;
use Sitec\Siravel\Console\ModuleCrud;
use Sitec\Siravel\Console\ModuleMake;
use Sitec\Siravel\Console\ModulePublish;
use Sitec\Siravel\Console\Setup;
use Sitec\Siravel\Console\ThemeGenerate;
use Sitec\Siravel\Console\ThemePublish;
use Sitec\Siravel\Providers\SiravelEventServiceProvider;
use Sitec\Siravel\Providers\SiravelModuleProvider;
use Sitec\Siravel\Providers\SiravelRouteProvider;
use Sitec\Siravel\Providers\SiravelServiceProvider;

class SiravelProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/PublishedAssets/Views/themes' => base_path('resources/themes'),
            __DIR__.'/PublishedAssets/Controllers' => app_path('Http/Controllers'),
            __DIR__.'/PublishedAssets/Migrations' => base_path('database/migrations'),
            __DIR__.'/PublishedAssets/Seeds' => base_path('database/seeds'),
            __DIR__.'/PublishedAssets/Middleware' => app_path('Http/Middleware'),
            __DIR__.'/PublishedAssets/Routes' => base_path('routes'),
            __DIR__.'/PublishedAssets/Config' => base_path('config'),
        ]);

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/siravel'),
        ], 'backend');

        $this->loadTranslationsFrom(__DIR__.'/Lang', 'siravel');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $theme = Config::get('siravel.frontend-theme', 'default');

        $this->loadViewsFrom(__DIR__.'/Views', 'siravel');

        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('siravel-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $theme = Config::get('siravel.frontend-theme');
            $view = '"siravel-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('menu', function ($expression) {
            return "<?php echo Siravel::menu($expression); ?>";
        });

        Blade::directive('modules', function () {
            return '<?php echo Siravel::moduleLinks(); ?>';
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Siravel::widget($expression); ?>";
        });

        Blade::directive('image', function ($expression) {
            return "<?php echo Siravel::image($expression); ?>";
        });

        Blade::directive('image_link', function ($expression) {
            return "<?php echo Siravel::imageLink($expression); ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Siravel::images($expression); ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Siravel::editBtn($expression); ?>";
        });

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        });
    }

    /**
     * Register the services.
     */
    public function register()
    {

        /*
        |--------------------------------------------------------------------------
        | Register Services Providers
        |--------------------------------------------------------------------------
        */
        $this->app->register(\SiravelServiceProvider::class);
        $this->app->register(\SiravelEventServiceProvider::class);
        $this->app->register(\SiravelRouteProvider::class);
        $this->app->register(\SiravelModuleProvider::class);

        $this->app->register(\LaracogsProvider::class);
        $this->app->register(\MarkdownServiceProvider::class);
        $this->app->register(\LaravelAnalyticsServiceProvider::class);

        /*
         * Minify
         */
        $this->app->register(MinifyServiceProvider::class);
        /*
         * Generate
         */
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Laracasts\Flash\FlashServiceProvider::class);
        $this->app->register(\Prettus\Repository\Providers\RepositoryServiceProvider::class);
        $this->app->register(\InfyOm\Generator\InfyOmGeneratorServiceProvider::class);
        $this->app->register(\InfyOm\AdminLTETemplates\AdminLTETemplatesServiceProvider::class);
        /*
         * Generate que add depois
         */
        $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
        $this->app->register(\Amranidev\ScaffoldInterface\ScaffoldInterfaceServiceProvider::class);
        // Enquete
        $this->app->register(\Inani\Larapoll\LarapollServiceProvider::class);
        // Debug Bar
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        /*
         * Criptografia
         */
        $this->app->register(\Yab\Crypto\CryptoProvider::class);




        /*
        |--------------------------------------------------------------------------
        | Register the Alias
        |--------------------------------------------------------------------------
        */
        $loader = AliasLoader::getInstance();
        $loader->alias('Markdown', Markdown::class);
        $loader->alias('LaravelAnalytics', LaravelAnalyticsFacade::class);
        /*
         * Minify
         */
        $loader->alias('Minify', MinifyFacade::class);
        /*
         * Minify
         */
        $loader->alias('Socialite', \Laravel\Socialite\Facades\Socialite::class);
        /*
         * DebugBar
         */
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        /*
         * Others
         */
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html' , \Collective\Html\HtmlFacade::class);
        $loader->alias('Flash', \Laracasts\Flash\Flash::class);

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([
            ThemeGenerate::class,
            ThemePublish::class,
            ModulePublish::class,
            ModuleMake::class,
            ModuleComposer::class,
            ModuleCrud::class,
            Setup::class,
            Keys::class,
        ]);
    }
}
