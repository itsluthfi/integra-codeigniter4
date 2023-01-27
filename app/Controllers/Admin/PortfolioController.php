<?php

namespace App\Controllers\Admin;

use DateTime;
use App\Controllers\BaseController;

class PortfolioController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Portfolio',
            'portfolio' => $this->PortfolioModel->orderBy('portfolio_id', 'DESC')->findAll(),
        ];

        return view('admin/portfolio/index', $data);
    }

    public function form_create()
    {
        $data = [
            'title' => 'Add Portfolio',
            'category' => $this->CategoryModel->orderBy('category_id', 'DESC')->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/portfolio/form_create', $data);
    }

    public function form_update($portfolio_id)
    {
        $data = [
            'title' => 'Edit Portfolio',
            'portfolio' => $this->PortfolioModel->find($portfolio_id),
            'category' => $this->CategoryModel->orderBy('category_id', 'DESC')->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/portfolio/form_update', $data);
    }

    public function store_portfolio()
    {
        $rules = $this->validate([
            'portfolio_name' => 'required',
            'category_name' => 'required',
            'portfolio_client' => 'required',
            'portfolio_date' => 'required',
            'description' => 'required',
            'portfolio_image' => 'uploaded[portfolio_image]|max_size[portfolio_image,2048]|mime_in[portfolio_image,image/jpg,image/png,image/jpeg]|ext_in[portfolio_image,jpg,png,jpeg]|is_image[portfolio_image]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to add portfolio!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('portfolio_image');

        // encrypt image name
        $imageName = $image->getRandomName();

        $image->move(WRITEPATH . '../public/assets-admin/img/', $imageName);

        // get slug
        $slug = url_title($this->request->getPost('portfolio_name'), '-', true);

        $this->PortfolioModel->insert([
            'portfolio_slug' => $slug,
            'portfolio_name' => esc($this->request->getPost('portfolio_name')),
            'category_name' => esc($this->request->getPost('category_name')),
            'portfolio_client' => esc($this->request->getPost('portfolio_client')),
            'portfolio_date' => esc($this->request->getPost('portfolio_date')),
            'description' => esc($this->request->getPost('description')),
            'portfolio_image' => $imageName,
        ]);

        return redirect()->to('admin/portfolio')->with('success', 'Portfolio successfully added!');
    }

    public function update_portfolio($portfolio_id)
    {
        $rules = $this->validate([
            'portfolio_name' => 'required',
            'category_name' => 'required',
            'portfolio_client' => 'required',
            'portfolio_date' => 'required',
            'description' => 'required',
            'portfolio_image' => 'uploaded[portfolio_image]|max_size[portfolio_image,2048]|mime_in[portfolio_image,image/jpg,image/png,image/jpeg]|ext_in[portfolio_image,jpg,png,jpeg]|is_image[portfolio_image]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to edit portfolio!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('portfolio_image');

        if (validation_show_error('portfolio_image') == 4) {
            $image = $this->request->getPost('oldImage');
        } else {
            // encrypt image name
            $imageName = $image->getRandomName();

            $image->move(WRITEPATH . '../public/assets-admin/img/', $imageName);

            unlink(WRITEPATH . '../public/assets-admin/img/' . $this->request->getPost('oldImage'));
        }

        // get slug
        $slug = url_title($this->request->getPost('portfolio_name'), '-', true);

        $this->PortfolioModel->update($portfolio_id, [
            'portfolio_slug' => $slug,
            'portfolio_name' => esc($this->request->getPost('portfolio_name')),
            'category_name' => esc($this->request->getPost('category_name')),
            'portfolio_client' => esc($this->request->getPost('portfolio_client')),
            'portfolio_date' => esc($this->request->getPost('portfolio_date')),
            'description' => esc($this->request->getPost('description')),
            'portfolio_image' => $imageName,
        ]);

        return redirect()->to('admin/portfolio')->with('success', 'Portfolio successfully updated!');
    }

    public function destroy_portfolio()
    {
        if ($this->request->isAJAX()) {
            $portfolio_id = $this->request->getVar('portfolio_id');

            $portfolio = $this->PortfolioModel->find($portfolio_id);

            // delete image from directory
            unlink(WRITEPATH . '../public/assets-admin/img/' . $portfolio->portfolio_image);

            $this->PortfolioModel->delete($portfolio_id);

            $result = [
                'success' => 'Portfolio successfully deleted!',
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function detail_portfolio($portfolio_slug)
    {
        $data = [
            'title' => 'Detail Portfolio',
            'portfolio' => $this->PortfolioModel->find($portfolio_slug),
        ];

        return view('admin/portfolio/detail', $data);
    }
}
