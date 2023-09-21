<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class DosenController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Data Dosen',
            'dosen' => $dosenModel->findAll()
        ];
        return view ('Admin/dosen/index',$data);
    }
    public function create(){
        $data = [
            'title' => 'Input Data Dosen'
        ];
        return view ('Admin/dosen/create',$data);
    }
    public function save(){
        $dosenModel = new DosenModel();
        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');
        $data = [
            'nama' => $nama,
            'nip' => $nip,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $dosenModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-dosen'));
    }
    public function form_edit($id){
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Edit Data Dosen',
            'dosen' => $dosenModel->find($id)
        ];
        return view ('Admin/dosen/update',$data);
    }
    public function update($id){
        $dosenModel = new DosenModel();
        $validasiPassword = $dosenModel->find($id);
        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordBaru = $this->request->getVar('password_baru');
        if($passwordBaru == null){
            $data = [
                'nama' => $nama,
                'nip' => $nip,
                'email' => $email,
                'password' => $password
            ];
        }else{
            $data = [
                'nama' => $nama,
                'nip' => $nip,
                'email' => $email,
                'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
            ];
        }
        
        $dosenModel->update($id,$data);
        session()->setFlashdata('success', 'Data berhasil Update');
        return redirect()->to(base_url('admin/data-dosen'));
    }
}
