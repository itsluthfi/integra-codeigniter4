<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'product_itconsultant' => $this->ProductModel->where('category_slug', 'it-consultant')->countAllResults(),
            'product_webappdev' => $this->ProductModel->where('category_slug', 'web-app-development')->countAllResults(),
            'product_mobileappdev' => $this->ProductModel->where('category_slug', 'mobile-app-development')->countAllResults(),
            'product_training' => $this->ProductModel->where('category_slug', 'training')->countAllResults(),
            'product' => $this->ProductModel->limit(3)->find(),
        ];

        return view('admin/dashboard/index', $data);
    }
}
