<?php

namespace Sitec\Siravel\Services\Traits;

use Illuminate\Support\Facades\Config;
use Sitec\Siravel\Facades\CryptoServiceFacade;

trait ModuleServiceTrait
{
    /**
     * Module Assets.
     *
     * @param string $module      Module name
     * @param string $path        Asset path
     * @param string $contentType Content type
     *
     * @return string
     */
    public function moduleAsset($module, $path, $contentType = 'null')
    {
        $assetPath = base_path(Config::get('siravel.module-directory').'/'.ucfirst($module).'/Assets/'.$path);

        if (!is_file($assetPath)) {
            $assetPath = config('siravel.modules.'.$module.'.asset_path').'/'.$path;
        }

        return url('siravel/asset/'.CryptoServiceFacade::url_encode($assetPath).'/'.CryptoServiceFacade::url_encode($contentType).'/?isModule=true');
    }

    /**
     * Module Config.
     *
     * @param string $module      Module name
     * @param string $path        Asset path
     * @param string $contentType Content type
     *
     * @return string
     */
    public function moduleConfig($module, $path)
    {
        $configArray = @include base_path(Config::get('siravel.module-directory').'/'.ucfirst($module).'/config.php');

        if (!$configArray) {
            return config('siravel.modules.'.$module.'.'.$path);
        }

        return self::assignArrayByPath($configArray, $path);
    }

    /**
     * Module Links.
     *
     * @return string
     */
    public function moduleLinks()
    {
        $links = '';

        foreach (config('siravel.modules', []) as $module => $config) {
            $link = $module;

            if (isset($config['url'])) {
                $link = $config['url'];
            }

            $links .= '<li><a href="'.url($link).'">'.ucfirst($link).'</a></li>';
        }

        return $links;
    }
}
