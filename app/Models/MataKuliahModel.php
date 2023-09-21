<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mata_kuliah';
    protected $primaryKey       = 'id_mk';
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
    $builder = $this->db->table('mata_kuliah');
    $builder->select('id_mk');
    $builder->orderBy('id_mk', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    if ($query->getNumRows() > 0) {
        $row = $query->getRow();
        return $row->id_mk;
    } else{
        return null;
    }
    }
    public function innerTable(){
        $builder = $this->db->table('mata_kuliah');
        $builder->join('dosen','mata_kuliah.id_dosen = dosen.id_dosen');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getbyId($id){
        $builder = $this->db->table('mata_kuliah');
        $builder->join('dosen','mata_kuliah.id_dosen = dosen.id_dosen');
        $builder->where('id_mk',$id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}