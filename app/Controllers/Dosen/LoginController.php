<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class LoginController extends BaseController
{

    public function index()
    {
        $data =
            [
                'title' => 'Login'
            ];
        return view('Dosen/login/index', $data);
    }

    public function auth(){
        $model = new DosenModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();
        if ($data) {
            $hash_password = $data['password'];
            $verify_pass = password_verify($password, $hash_password);
            if ($verify_pass) {
                $ses_data = [
                    'id_dosen' => $data['id_dosen'],
                    'nama'     => $data['nama'],
                    'email'     => $data['email'],
                    'logged_in'     => TRUE
                ];
                session()->set($ses_data);
                return redirect()->to(base_url('dosen/dashboard'));
            } else {
                session()->setFlashdata('msg', 'Password yang anda masukan salah');
                return redirect()->to(base_url('dosen/login'));
            }
        } else {
            session()->setFlashdata('msg', 'Email yang anda masukan tidak terdaftar');
            return redirect()->to(base_url('dosen/login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('dosen/login'));
    }
}
