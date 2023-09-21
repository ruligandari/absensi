<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Models\PresensiModel;

class WaktuPresensiController extends BaseController
{
    public function index()
    {
        $presensiModel = new PresensiModel();
        $presensi = $presensiModel->findAll();
        $data = [
            'title' => 'Data Presensi',
            'presensi' => $presensi
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
            'title' => 'Form Input Presensi',
            'mk' => $mk,
            'kelas' => $kelas,
            'dosen' => $dosen
        ];
        return view ('Admin/waktupresensi/create',$data);
    }
    public function rincian($kelas){
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->byKelas($kelas);
        $data = [
            'title' => 'Rincian Presensi',
            'kelas' => $mahasiswaModel
        ];
        dd($data);
        return view('Admin/waktupresensi/rincian',$data);
    }
    public function save(){

        $presensiModel = new PresensiModel();

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

        $presensiModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/data-waktupresensi'));
    }
    public function delete($id)
    {
        $modelPresensi = new PresensiModel();
        $modelPresensi->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/data-waktupresensi'));
    }

    public function create_presensi(){
        $wajah = $this->request->getVar('absen');
        dd($wajah);
    }
}
 