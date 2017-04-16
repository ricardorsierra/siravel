<?php

namespace Sitec\Siravel\Controllers;

class PagesController extends SiravelController
{
    function __construct()
    {
        $this->middleware('web');
    }

    public function getHome(\Illuminate\Http\Request $request)
    {
        return view('pages.home');

    }
}