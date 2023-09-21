<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Models\PresensiModel;
use App\Models\PresensiDataModel;
use App\Models\KontrakModel;

class WaktuPresensiController extends BaseController
{
    public function index()
    {
        $presensiModel = new PresensiModel();
        $data = [
            'title' => 'Data Presensi',
            'presensi' => $presensiModel->joinTable()
        ];

        return view('Admin/waktupresensi/index', $data);
    }
    public function create(){
        $modelKelas = new KelasModel();
        $kelas = $modelKelas->findAll();
        $modelMK = new MataKuliahModel();
        $mk = $modelMK->findAll();
        $dosenModel = new DosenModel();
        $dosen = $dosenModel->findAll();
        $data = [
            'title' => 'Input Data Waktu Presensi',
            'mk' => $mk,
            'kelas' => $kelas,
            'dosen' => $dosen
        ];
        return view ('Admin/waktupresensi/create',$data);
    }
    public function rincian($kelas){
        $presensiModel = new PresensiDataModel();
        $data = [
            'title' => 'Rincian Presensi',
            'mahasiswa' => $presensiModel->byKelas($kelas)
        ]; 
        return view('Admin/waktupresensi/rincian',$data);
    }
    public function save(){

        $waktupresensiModel = new PresensiModel();
        $id_kelas = $this->request->getPost('id_kelas');
        $id_mk = $this->request->getPost('id_mk');
        $jam_masuk = $this->request->getPost('jam_masuk');
        $jam_keluar = $this->request->getPost('jam_keluar');
        $tanggal = $this->request->getPost('tanggal');
        $id_dosen = $this->request->getPost('id_dosen');

        $data = [
            'id_kelas' => $id_kelas,
            'id_mk' => $id_mk,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'tanggal' => $tanggal,
            'id_dosen' => $id_dosen
        ];

        $waktupresensiModel->insert($data);
        $id_presensi = $waktupresensiModel->insertID();
        $presensiDataModel = new PresensiDataModel();
        //Create Presensi
        $mahasiswaModel = new MahasiswaModel();
        $dataMahasiswa = $mahasiswaModel->byKelas($id_kelas);
        $kontrakModel = new KontrakModel();
        foreach($dataMahasiswa as $mahasiswa){
            $nim = $mahasiswa['nim'];
            $kontrakExist = $kontrakModel->checkKontrakExists($nim, $id_mk);
            if($kontrakExist){
            $data = [
                'nim' => $mahasiswa['nim'],
                'id_kelas' => $id_kelas,
                'id_mk' => $id_mk,
                'id' => $id_presensi,
                'status' => 'tidak hadir'
            ];
            $presensiDataModel->insert($data);
        }
    }
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-waktupresensi'));
    }
    public function form_edit($id){
        $waktuPresensiModel = new PresensiModel();
        $mkModel = new MataKuliahModel();
        $dosenModel = new DosenModel();
        $kelasModel = new KelasModel();
        $data = [
            'title' => 'Update Presensi',
            'presensi' => $waktuPresensiModel->cariData($id),
            'mk' => $mkModel->findAll(),
            'dosen' => $dosenModel->findAll(),
            'kelas' => $kelasModel->findAll()
        ];
        return view('admin/waktupresensi/update',$data);
    }
    public function update($id){
        $id_kelas = $this->request->getVar('id_kelas');
        $id_mk = $this->request->getVar('id_mk');
        $jam_masuk = $this->request->getVar('jam_masuk');
        $jam_keluar = $this->request->getVar('jam_keluar');
        $id_dosen = $this->request->getVar('id_dosen');
        $tanggal = $this->request->getVar('tanggal');

        $waktuPresensiModel = new PresensiModel();
        $data = [
            'id' => $id,
            'id_kelas' => $id_kelas,
            'id_mk' => $id_mk,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar,
            'tanggal' => $tanggal,
            'id_dosen' => $id_dosen
        ];
        if($data){
            $waktuPresensiModel->update($id,$data);
            session()->setFlashdata('success', 'Data berhasil Diupdate');
            return redirect()->to(base_url('admin/data-waktupresensi'));
        }
    }
    public function delete($id)
    {
        $modelPresensi = new PresensiModel();
        $modelPresensi->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/data-waktupresensi'));
    }
}
 