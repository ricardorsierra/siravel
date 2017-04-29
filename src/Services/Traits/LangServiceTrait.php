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
        $langs = LangRepository::get();
        $current = LangRepository::getCurrent();

        if (!$langs || empty($langs)) {
            return '';
        }

        $response = '<li>';
        $response .= '<a href=""><span class="flag-icon flag-icon-'.$current['class'].'"></span></a>';
        $response .= '<ul class="sub-menu clearfix">';
        $response .= '<li class=\'no-translation menu-item\'><a href=\''.url('sitec/language/set/'.$current['locale']).'\'><span class="flag-icon '.$current['class'].'"></span></a></li>';
        foreach ($langs as $link) {
            if ($current['locale'] === $link['locale']) {
                continue;
            }
            $response .= '<li class=\'no-translation menu-item\'><a href=\''.url('sitec/language/set/'.$link['locale']).'\'><span class="flag-icon '.$link['class'].'"></span></a></li>';
        }

        $response .= '</ul></li>';

        return $response;
    }
}