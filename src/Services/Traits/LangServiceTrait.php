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
        $response .= '<li class=\'no-translation menu-item current-lang \'><a href="'.url('sitec/language/set/'.$current['locale']).'"><span class="'.$current['class'].'"></span></a></li>';

        foreach ($langs as $lang) {
            if ($lang['locale'] !== $current['locale']) {
                $response .= '<li class=\'no-translation menu-item\'><a href="'.url('sitec/language/set/'.$lang['locale']).'"><span class="'.$lang['class'].'"></span></a></li>';
            }
        }

        $response .= '</ul></li>';

        return $response;
    }
}