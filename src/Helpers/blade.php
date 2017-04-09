<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('SiravelService')->menu($slug, $view);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('SiravelService')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('SiravelService')->widget($slug);
    }
}

if (!function_exists('editBtn')) {
    function edit($module, $id = null)
    {
        return app('SiravelService')->module($module, $id);
    }
}
