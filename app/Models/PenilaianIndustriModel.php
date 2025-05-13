<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianIndustriModel extends Model
{
    protected $table            = 'penilaian_industri';
    protected $primaryKey       = 'id_penilaian_industri';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'mahasiswa_id', 'komunikasi', 'berpikir_kritis', 'kerja_tim', 'inisiatif', 'literasi_digital',
        'deskripsi_produk', 'speksifikasi_produk', 'desain_produk', 'implementasi_produk',
        'pengujian_produk', 'total_nilai_industri'
    ];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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

    // ✅ Method untuk join data mahasiswa
    public function getByMahasiswa($mahasiswa_id)
    {
        return $this->select('penilaian_industri.*, 
                              mahasiswa.nama, 
                              mahasiswa.nim, 
                              mahasiswa.nama_pembimbing_perusahaan, 
                              mahasiswa.judul_magang')
                    ->join('mahasiswa', 'mahasiswa.mahasiswa_id = penilaian_industri.mahasiswa_id')
                    ->where('penilaian_industri.mahasiswa_id', $mahasiswa_id)
                    ->first();
    }
    
}
