<?php

namespace Sitec\Siravel\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SiravelEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saved: Sitec\Siravel\Models\Blog' => [
            'Sitec\Siravel\Models\Blog@afterSaved',
        ],
        'eloquent.saved: Sitec\Siravel\Models\Page' => [
            'Sitec\Siravel\Models\Page@afterSaved',
        ],
        'eloquent.saved: Sitec\Siravel\Models\Event' => [
            'Sitec\Siravel\Models\Event@afterSaved',
        ],
        'eloquent.saved: Sitec\Siravel\Models\FAQ' => [
            'Sitec\Siravel\Models\Event@afterSaved',
        ],
        'eloquent.saved: Sitec\Siravel\Models\Translation' => [
            'Sitec\Siravel\Models\Event@afterSaved',
        ],
        'eloquent.saved: Sitec\Siravel\Models\Widget' => [
            'Sitec\Siravel\Models\Event@afterSaved',
        ],

        'eloquent.created: Sitec\Siravel\Models\Blog' => [
            'Sitec\Siravel\Models\Blog@afterCreate',
        ],
        'eloquent.created: Sitec\Siravel\Models\Page' => [
            'Sitec\Siravel\Models\Page@afterCreate',
        ],
        'eloquent.created: Sitec\Siravel\Models\Event' => [
            'Sitec\Siravel\Models\Event@afterCreate',
        ],
        'eloquent.created: Sitec\Siravel\Models\FAQ' => [
            'Sitec\Siravel\Models\Event@afterCreate',
        ],
        'eloquent.created: Sitec\Siravel\Models\Widget' => [
            'Sitec\Siravel\Models\Event@afterCreate',
        ],

        'eloquent.deleting: Sitec\Siravel\Models\Blog' => [
            'Sitec\Siravel\Models\Blog@beingDeleted',
        ],
        'eloquent.deleting: Sitec\Siravel\Models\Page' => [
            'Sitec\Siravel\Models\Page@beingDeleted',
        ],
        'eloquent.deleting: Sitec\Siravel\Models\Event' => [
            'Sitec\Siravel\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Sitec\Siravel\Models\FAQ' => [
            'Sitec\Siravel\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Sitec\Siravel\Models\Translation' => [
            'Sitec\Siravel\Models\Event@beingDeleted',
        ],
        'eloquent.deleting: Sitec\Siravel\Models\Widget' => [
            'Sitec\Siravel\Models\Event@beingDeleted',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot()
    {
        parent::boot();
    }
}
