<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'slider' => $this->SliderModel->findAll(),
            'category' => $this->CategoryModel->findAll(),
            'product' => $this->ProductModel->findAll(),
            'team' => $this->TeamModel->findAll(),
        ];

        return view('user/home/index', $data);
    }

    public function inner()
    {
        return view('user/inner/index');
    }

    public function portfolio()
    {
        return view('user/portfolio/detail');
    }
}
