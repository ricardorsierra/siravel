<?php

namespace Sitec\Siravel\Services\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Sitec\Siravel\Repositories\LangRepository;

trait LangServiceTrait
{

    /**
     * Get a view.
     *
     * @param string $slug
     * @param View   $view
     *
     * @return string
     */
    public function menu_lang()
    {
        $langRepo = new LangRepository();
        $langs = $langRepo->all();

        if (!$langs || empty($langs)) {
            return '';
        }

        $links = LinkRepository::getLinksByMenuID($menu->id);
        $response = '<li>';
        $response = '<a href=""><span class="flag-icon flag-icon-br"></span></a>';
        $response = '<ul class="sub-menu clearfix">';

        $processedLinks = [];
        foreach ($links as $link) {
            if ($link->external) {
                $response .= "<a href=\"$link->external_url\">$link->name</a>";
                $processedLinks[] = "<a href=\"$link->external_url\">$link->name</a>";
            } else {
                $page = $pageRepo->findPagesById($link->page_id);
                if ($page) {
                    if (config('app.locale') == config('Siravel.default-language', $this->config('Siravel.default-language'))) {
                        $response .= '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                        $processedLinks[] = '<a href="'.URL::to('page/'.$page->url)."\">$link->name</a>";
                    } elseif (config('app.locale') != config('Siravel.default-language', $this->config('Siravel.default-language'))) {
                        if ($page->translation(config('app.locale'))) {
                            $response .= '<a href="'.URL::to('page/'.$page->translation(config('app.locale'))->data->url)."\">$link->name</a>";
                            $processedLinks[] = '<a href="'.URL::to('page/'.$page->translation(config('app.locale'))->data->url)."\">$link->name</a>";
                        }
                    }
                }
            }
        }

        $response = '</ul></li>';

        return $response;
    }
}