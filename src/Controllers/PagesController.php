<?php

namespace Sitec\Siravel\Controllers;

class PagesController extends SiravelController
{
    function __construct()
    {
        $this->middleware('web');
    }

    public function getHome()
    {

        var_dump(config('app.locale'));
        dd(config('app.locale'), $request->session()->get('language'));
        return view('pages.home');

    }
}