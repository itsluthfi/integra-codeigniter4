<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TeamController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Team',
            'team' => $this->TeamModel->findAll(),
            'validation' => validation_errors(),
        ];

        return view('admin/team/index', $data);
    }

    public function update($team_id)
    {
        $rules = $this->validate([
            'team_name' => 'required',
            'team_position' => 'required',
            'team_fb' => 'required',
            'team_ig' => 'required',
            'team_photo' => 'max_size[team_photo,2048]|mime_in[team_photo,image/jpg,image/png,image/jpeg]|ext_in[team_photo,jpg,png,jpeg]|is_image[team_photo]',
        ]);

        if (!$rules) {
            session()->setFlashdata('failed', 'Failed to edit team!');
            return redirect()->back()->withInput();
        }

        // get image
        $image = $this->request->getFile('team_photo');

        if (validation_show_error('team_photo') == 4) {
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

        $this->TeamModel->update($team_id, [
            'team_name' => esc($this->request->getPost('team_name')),
            'team_position' => esc($this->request->getPost('team_position')),
            'team_fb' => esc($this->request->getPost('team_fb')),
            'team_ig' => esc($this->request->getPost('team_ig')),
            'team_photo' => $imageName,
        ]);

        return redirect()->to('admin/team')->with('success', 'Team successfully updated!');
    }
}
