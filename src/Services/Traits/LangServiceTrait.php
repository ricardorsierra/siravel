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

        if (!$langs || empty($langs)) {
            return '';
        }

        $current = LangRepository::getCurrent();

        $response = '<li>';
        $response .= '<a href=""><span class="'.$current['class'].'"></span></a>';
        $response .= '<ul class="sub-menu clearfix">';
        $response .= '<a href="'.url('sitec/language/set/'.$current['locale']).'"><span class="no-translation current-lang menu-item '.$current['class'].'"></span></a>';

        foreach ($langs as $lang) {
            if ($lang['locale'] !== $current['locale']) {
                $response .= '<a href="'.url('sitec/language/set/'.$lang['locale']).'"><span class="no-translation menu-item '.$lang['class'].'"></span></a>';
            }
            $response .= '<li class=\'no-translation menu-item\'><a href=\''.url('sitec/language/set/'.$link['locale']).'\'><span class="flag-icon '.$link['class'].'"></span></a></li>';
        }

        $response .= '</ul></li>';

        return $response;
    }
}