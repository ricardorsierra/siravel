<?php

namespace Sitec\Siravel\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Sitec\Siravel\Services\BlogService;
use Sitec\Siravel\Services\CryptoService;
use Sitec\Siravel\Services\EventService;
use Sitec\Siravel\Services\ModuleService;
use Sitec\Siravel\Services\PageService;
use Sitec\Siravel\Services\SiravelService;

class SiravelServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Siravel', \Sitec\Siravel\Facades\SiravelServiceFacade::class);
        $loader->alias('EventService', \Sitec\Siravel\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \Sitec\Siravel\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Sitec\Siravel\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Sitec\Siravel\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \Sitec\Siravel\Services\FileService::class);

        $this->app->bind('SiravelService', function ($app) {
            return new SiravelService();
        });

        $this->app->bind('EventService', function ($app) {
            return App::make(EventService::class);
        });

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });

        $this->app->bind('ModuleService', function ($app) {
            return new ModuleService();
        });

        $this->app->bind('BlogService', function ($app) {
            return new BlogService();
        });
    }
}
