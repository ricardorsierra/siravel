<?php

namespace Sitec\Siravel\Controllers;

class UserController extends SiravelController
{

    public function getHome()
    {

        return view('panels.user.home');

    }

    public function getProtected()
    {

        return view('panels.user.protected');

    }

}