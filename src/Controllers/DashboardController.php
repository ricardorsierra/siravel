<?php

namespace Sitec\Siravel\Controllers;

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelAnalytics\LaravelAnalyticsFacade as LaravelAnalytics;
use Sitec\Siravel\Services\AnalyticsService;

class DashboardController extends SiravelController
{
    public function __construct(AnalyticsService $service)
    {
        $this->service = $service;
    }

    public function main()
    {
        if (!is_null(config('laravel-analytics.siteId')) && config('siravel.analytics') == 'google') {
            foreach (LaravelAnalytics::getVisitorsAndPageViews(7) as $view) {
                $visitStats['date'][] = $view['date']->format('Y-m-d');
                $visitStats['visitors'][] = $view['visitors'];
                $visitStats['pageViews'][] = $view['pageViews'];
            }

            return view('siravel::dashboard.analytics-google', compact('visitStats', 'oneYear'));
        } elseif (is_null(config('siravel.analytics')) || config('siravel.analytics') == 'internal') {
            if (Schema::hasTable(config('siravel.db-prefix', '').'analytics')) {
                return view('siravel::dashboard.analytics-internal')
                    ->with('stats', $this->service->getDays(15))
                    ->with('topReferers', $this->service->topReferers(15))
                    ->with('topBrowsers', $this->service->topBrowsers(15))
                    ->with('topPages', $this->service->topPages(15));
            }
        }

        return view('siravel::dashboard.empty');
    }
}
