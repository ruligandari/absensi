<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\PresensiDataModel;

class WaktuPresensiController extends BaseController
{
    public function index()
    {
        $presensiModel = new PresensiModel();
        $data = [
            'title' => 'Data Presensi',
            'presensi' => $presensiModel->getByDosen()
        ];

        return view('Dosen/waktupresensi/index', $data);
    }
    public function rincian($kelas){
        $presensiModel = new PresensiDataModel();
        $data = [
            'title' => 'Rincian Presensi',
            'mahasiswa' => $presensiModel->byKelas($kelas)
        ];
        return view('Dosen/waktupresensi/rincian',$data);
    }
    public function form_edit($id){
        $presensiModel = new PresensiModel();
        $data = [
            'title' => 'Update Presensi',
            'presensi' => $presensiModel->find($id)
        ];
        return view('Dosen/waktupresensi/update',$data);
    }
    public function update($id){
        $jam_masuk = $this->request->getVar('jam_masuk');
        $jam_keluar = $this->request->getVar('jam_keluar');

        $presensi = new PresensiModel();
        $data = [
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar
        ];
        if($data){
            $presensi->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to(base_url('dosen/data-waktupresensi'));
        }
    }
}
