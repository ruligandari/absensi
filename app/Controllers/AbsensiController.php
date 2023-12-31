<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresensiDataModel;
use App\Models\MahasiswaModel;

class AbsensiController extends BaseController
{
    public function index()
    {
    }

    public function create($id)
    {
        $status = '';
        $id_waktu_presensi = '';
        $namaMk = '';

        date_default_timezone_set('Asia/Jakarta');
        $namaMhs = $id;
        $parts = explode(" ", $namaMhs);
        $nim = $parts[0];

        $time = strtotime(date('H:i:s'));
        $date = date('Y-m-d');
        $presensiData = new PresensiDataModel();
        $dataMahasiswa = $presensiData->byNama($nim);

        foreach ($dataMahasiswa as $mahasiswa) {
            $jam_masuk = strtotime($mahasiswa['jam_masuk']);
            $jam_keluar = strtotime($mahasiswa['jam_keluar']);

            // Hitung waktu batas telat (jam keluar + 15 menit)
            $batas_telat = strtotime('+15 minutes', $jam_keluar);

            if ($date == $mahasiswa['tanggal'] && $time >= $jam_masuk && $time <= $jam_keluar && $mahasiswa['status'] != 'hadir' && $mahasiswa['status'] != 'terlambat') {
                $status = 'hadir';
                $namaMk = $mahasiswa['nama_mk'];
                $id_waktu_presensi = $mahasiswa['id'];
            } else if ($date == $mahasiswa['tanggal']  && $time > $jam_keluar && $time <= $batas_telat && $mahasiswa['status'] != 'terlambat') {
                $status = 'terlambat';
                $namaMk = $mahasiswa['nama_mk'];
                $id_waktu_presensi = $mahasiswa['id'];
            } else if ($time > $batas_telat) {
                $status = 'tidak hadir';
                $namaMk = $mahasiswa['nama_mk'];
            } else if ($mahasiswa['status'] == 'hadir') {
                $status = 'sudah';
                $namaMk = $mahasiswa['nama_mk'];
            } else if ($mahasiswa['status'] == 'terlambat') {
                $status = 'sudah';
                $namaMk = $mahasiswa['nama_mk'];
            }
        }


        $data = [
            'status' => 'error',
            'msg' => 'Belum Ada Presensi ',
        ];


        if ($status == 'hadir') {
            $presensiData->updateStatusByIdWaktuPresensi($id_waktu_presensi, $nim);
            return json_encode(array('status' => 'success', 'msg' => 'Presensi ' . $namaMk .  ' hadir Berhasil'));
        } else if ($status == 'terlambat') {
            $presensiData->updateStatusByIdWaktuPresensiTerlambat($id_waktu_presensi, $nim);
            return json_encode(array('status' => 'success', 'msg' => 'Presensi ' . $namaMk .  ' Terlambat, Berhasil'));
        } else if ($status == 'tidak hadir') {
            return json_encode(array('status' => 'error', 'msg' => 'Waktu Presinsi ' . $namaMk . ' Pada Tanggal ' . $date . ' Jam ' . date('H:i:s')));
        } else if ($status == 'sudah') {
            return json_encode(array('status' => 'error', 'msg' => 'Anda Sudah Melakukan Presensi ' . $namaMk));
        }
        return json_encode($data);
    }
}
