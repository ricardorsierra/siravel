<?php

namespace Sitec\Siravel\Controllers;

class PagesController extends SiravelController
{

    public function getHome()
    {

        return view('pages.home');

    }
}