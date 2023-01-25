<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SliderController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Slider',
            'slider' => $this->SliderModel->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/slider/index', $data);
    }

    public function update($slider_id)
    {
        $rules = $this->validate([
            'slider_title' => 'required',
            'description' => 'required',
            'slider_image' => 'max_size[slider_image,2048]|mime_in[slider_image,image/jpg,image/png,image/jpeg]|ext_in[slider_image,jpg,png,jpeg]|is_image[slider_image]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to edit slider!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('slider_image');

        if (validation_show_error('slider_image') == 4) {
            $image = $this->request->getPost('oldImage');
        } else {
            // encrypt image name
            $imageName = $image->getRandomName();

            $image->move(WRITEPATH . '../public/assets-admin/img/', $imageName);

            if ($imageName == 'test.jpg') {
                // do nothing
            }

            unlink(WRITEPATH . '../public/assets-admin/img/' . $this->request->getPost('oldImage'));
        }

        $this->SliderModel->update($slider_id, [
            'slider_title' => esc($this->request->getPost('slider_title')),
            'description' => $this->request->getPost('description'),
            'slider_image' => $imageName,
        ]);

        return redirect()->to('admin/slider')->with('success', 'Slider successfully updated!');
    }
}
