<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLastID(){
    // get last id_supplier
    $builder = $this->db->table('mahasiswa');
    $builder->select('nim');
    $builder->orderBy('nim', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    if ($query->getNumRows() > 0) {
        $row = $query->getRow();
        return $row->nim;
    } else{
        return null;
    }
    }
    public function innerTable(){
        $builder = $this->db->table('mahasiswa');
        $builder->join('kelas','mahasiswa.id_kelas = kelas.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function byKelas($kelas){
        $builder = $this->db->table('mahasiswa');
        $builder->join('kelas','mahasiswa.id_kelas = kelas.id_kelas');
        $builder->where('kelas.id_kelas',$kelas);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function cariData($id){
        $builder = $this->db->table('mahasiswa');
        $builder->join('kelas','mahasiswa.id_kelas = kelas.id_kelas');
        $builder->where('nim',$id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function cariNama($nama){
        $builder = $this->db->table('mahasiswa');
        $builder->join('kelas','mahasiswa.id_kelas = kelas.id_kelas');
        $builder->where('nama',$nama);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getAllData()
    {
        $builder = $this->db->table('mahasiswa');
        $builder->join('kelas','mahasiswa.id_kelas = kelas.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }
}