<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\MahasiswaModel;
use Kint\Parser\ToStringPlugin;

class MahasiswaController extends BaseController
{
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $mahasiswaModel->getAllData(),
        ];
        return view('Admin/mahasiswa/index', $data);
    }
    public function create(){
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();
        $data = [
            'title' => 'Tambah Data Mahasiswa',
            'kelas' => $kelas,
        ];
        return view('Admin/mahasiswa/create',$data);
    }
    public function form_edit($id){
        $mahasiswaModel = new MahasiswaModel();
        $kelasModel = new KelasModel();
        $data = [
            'title' => 'edit',
            'mahasiswa' => $mahasiswaModel->cariData($id),
            'kelas' => $kelasModel->findAll()
        ];
        return view('Admin/mahasiswa/update',$data);
    }
    public function save(){

        $mahasiswaModel = new MahasiswaModel();

        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $id_kelas = $this->request->getPost('id_kelas');
        $jurusan = $this->request->getVar('jurusan');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $ttl = $this->request->getPost('ttl');
        $agama = $this->request->getPost('agama');
        $alamat = $this->request->getPost('alamat');

        $data = [
            'nim' => $nim,
            'nama' => $nama,
            'id_kelas' => $id_kelas,
            'jurusan' => $jurusan,
            'jenis_kelamin' => $jenis_kelamin,
            'ttl' => $ttl,
            'agama' => $agama,
            'alamat' => $alamat
        ];

        $mahasiswaModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-mahasiswa'));
    }
    public function update($id){
        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $id_kelas = $this->request->getPost('id_kelas');
        $jurusan = $this->request->getVar('jurusan');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $ttl = $this->request->getPost('ttl');
        $agama = $this->request->getPost('agama');
        $alamat = $this->request->getPost('alamat');

        $mahasiswa = new MahasiswaModel();
        $data = [
            'nim' => $nim,
            'nama' => $nama,
            'id_kelas' => $id_kelas,
            'jurusan' => $jurusan,
            'jenis_kelamin' => $jenis_kelamin,
            'ttl' => $ttl,
            'agama' => $agama,
            'alamat' => $alamat
        ];
        if($data){
            $mahasiswa->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to(base_url('admin/data-mahasiswa'));
        }
    }
    public function delete($id){
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/data-mahasiswa'));
    }

    public function pasfoto($id){
        $data = [
            'title' => 'Generate Data Wajah',
            'nim' => $id
        ];
        return view('Admin/mahasiswa/update-foto', $data);
    }

    public function upload()
    {
        $datawajah = $this->request->getVar('datawajah');
        $nim = $this->request->getVar('nim');
        $file = $this->request->getFile('fotowajah');
        if ($file)
        {
            $namaFile = $file->getRandomName();

            // Pindahkan file baru ke direktori tujuan
             $file->move(ROOTPATH. 'public/uploads', $namaFile);
    
        }
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->update($nim, ['foto' => $namaFile, 'data_wajah' => $datawajah]);
        session()->setFlashdata('success', 'Foto berhasil diupload');
        return redirect()->to(base_url('admin/data-mahasiswa'));
    }
}
;