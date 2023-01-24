<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        return view('user/home/index');
    }

    public function inner()
    {
        return view('user/inner/index');
    }

    public function portofolio()
    {
        return view('user/portofolio/detail');
    }
}
