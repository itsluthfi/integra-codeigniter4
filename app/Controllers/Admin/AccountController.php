<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;

class AccountController extends BaseController
{
    protected $UserModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index()
    {
        $data = [
            'title' => 'Account',
            'data_account' => $this->builder->get()->getResultObject(),
        ];

        return view('admin/account/index', $data);
    }

    public function update($id)
    {
        $data = [
            'email' => strip_tags($this->request->getPost('email')),
            'username' => strip_tags($this->request->getPost('username')),
        ];

        $this->builder->where('id', $id);
        $this->builder->update($data);

        return redirect()->back()->with('success', 'Account successfully edited!');
    }

    public function destroy($id)
    {
        $this->builder->delete(['id' => $id]);

        return redirect()->back()->with('success', 'Account successfully deleted!');
    }
}
