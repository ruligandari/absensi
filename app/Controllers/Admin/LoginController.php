<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\User;

class LoginController extends BaseController
{

    public function index()
    {
        $data =
            [
                'title' => 'Login'
            ];
        return view('Admin/login/index', $data);
    }

    public function auth(){
        $model = new StaffModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();
        if ($data) {
            $hash_password = $data['password'];
            $verify_pass = password_verify($password, $hash_password);
            if ($verify_pass) {
                $ses_data = [
                    'nama'     => $data['nama_staff'],
                    'email'     => $data['email'],
                    'logged_in'     => TRUE
                ];
                session()->set($ses_data);
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                session()->setFlashdata('msg', 'Password yang anda masukan salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('msg', 'Email yang anda masukan tidak terdaftar');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
