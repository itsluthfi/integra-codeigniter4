<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProductController extends BaseController
{
    // product controller
    public function index()
    {
        $data = [
            'title' => 'Product',
            'product' => $this->ProductModel->orderBy('product_id', 'DESC')->findAll(),
        ];

        return view('admin/product/index', $data);
    }

    public function form_create()
    {
        $data = [
            'title' => 'Add Product',
            'category' => $this->CategoryModel->orderBy('category_id', 'DESC')->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/product/form_create', $data);
    }

    public function store_product()
    {
        $rules = $this->validate([
            'product_name' => 'required',
            'category_slug' => 'required',
            'description' => 'required',
            'product_image' => 'uploaded[product_image]|max_size[product_image,2048]|mime_in[product_image,image/jpg,image/png,image/jpeg]|ext_in[product_image,jpg,png,jpeg]|is_image[product_image]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to add product!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('product_image');

        // encrypt image name
        $imageName = $image->getRandomName();

        $image->move(WRITEPATH . '../public/assets-admin/img/', $imageName);

        // get slug
        $slug = url_title($this->request->getPost('product_name'), '-', true);

        $this->ProductModel->insert([
            'product_slug' => $slug,
            'product_name' => esc($this->request->getPost('product_name')),
            'category_slug' => esc($this->request->getPost('category_slug')),
            'description' => $this->request->getPost('description'),
            'product_image' => $imageName,
        ]);

        return redirect()->to('admin/product-list')->with('success', 'Product successfully added!');
    }

    public function form_update($product_id)
    {
        $data = [
            'title' => 'Edit Product',
            'product' => $this->ProductModel->find($product_id),
            'category' => $this->CategoryModel->orderBy('category_id', 'DESC')->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/product/form_update', $data);
    }

    public function update_product($product_id)
    {
        $rules = $this->validate([
            'product_name' => 'required',
            'category_slug' => 'required',
            'description' => 'required',
            'product_image' => 'max_size[product_image,2048]|mime_in[product_image,image/jpg,image/png,image/jpeg]|ext_in[product_image,jpg,png,jpeg]|is_image[product_image]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to edit product!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('product_image');

        if (validation_show_error('product_image') == 4) {
            $image = $this->request->getPost('oldImage');
        } else {
            // encrypt image name
            $imageName = $image->getRandomName();

            $image->move(WRITEPATH . '../public/assets-admin/img/', $imageName);

            unlink(WRITEPATH . '../public/assets-admin/img/' . $this->request->getPost('oldImage'));
        }

        // get slug
        $slug = url_title($this->request->getPost('product_name'), '-', true);

        $this->ProductModel->update($product_id, [
            'product_slug' => $slug,
            'product_name' => esc($this->request->getPost('product_name')),
            'category_slug' => esc($this->request->getPost('category_slug')),
            'description' => $this->request->getPost('description'),
            'product_image' => $imageName,
        ]);

        return redirect()->to('admin/product-list')->with('success', 'Product successfully updated!');
    }

    public function destroy_product()
    {
        if ($this->request->isAJAX()) {
            $product_id = $this->request->getVar('product_id');

            $product = $this->ProductModel->find($product_id);

            // delete image from directory
            unlink(WRITEPATH . '../public/assets-admin/img/' . $product->product_image);

            $this->ProductModel->delete($product_id);

            $result = [
                'success' => 'Product successfully deleted!',
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function detail_product($product_id)
    {
        $data = [
            'title' => 'Detail Product',
            'product' => $this->ProductModel->find($product_id),
        ];

        return view('admin/product/detail', $data);
    }

    // product category controller
    public function category()
    {
        $data = [
            'title' => 'Product',
            'category' => $this->CategoryModel->orderBy('category_id', 'DESC')->findAll(),
        ];

        return view('admin/product/category', $data);
    }

    public function store()
    {
        // get slug
        $slug = url_title($this->request->getPost('category_name'), '-', true);

        // store to database
        $data = [
            'category_name' => esc($this->request->getPost('category_name')),
            'category_slug' => $slug
        ];

        $this->CategoryModel->insert($data);

        return redirect()->back()->with('success', 'Category successfully added!');
    }

    public function update($category_id)
    {
        // get slug
        $slug = url_title($this->request->getPost('category_name'), '-', true);

        // store to database
        $data = [
            'category_name' => esc($this->request->getPost('category_name')),
            'category_slug' => $slug
        ];

        $this->CategoryModel->update($category_id, $data);

        return redirect()->back()->with('success', 'Category successfully edited!');
    }

    public function destroy($category_id)
    {
        $this->CategoryModel->where('category_id', $category_id)->delete();

        return redirect()->back()->with('success', 'Category successfully deleted!');
    }
}
