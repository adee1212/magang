<?php

namespace App\Controllers;

use App\Models\PenilaianIndustriModel;
use App\Models\MahasiswaModel;
use CodeIgniter\Controller;

class PenilaianIndustri extends Controller
{
    protected $penilaianModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->penilaianModel = new PenilaianIndustriModel();
        $this->mahasiswaModel = new MahasiswaModel();
        helper(['form']);
    }

    // Menampilkan form input
    public function create()
    {
        $data['mahasiswa'] = $this->mahasiswaModel->findAll();
        return view('penilaian_industri/create', $data);
    }

    // Proses simpan data
    public function store()
    {
        $input = $this->request->getPost();

        // Hitung total nilai
        $total = (
            $input['komunikasi'] + $input['berpikir_kritis'] + $input['kerja_tim'] +
            $input['inisiatif'] + $input['literasi_digital'] + $input['deskripsi_produk'] +
            $input['spesifikasi_produk'] + $input['desain_produk'] +
            $input['implementasi_produk'] + $input['pengujian_produk']
        ) / 10;

        $data = [
            'mahasiswa_id' => $input['mahasiswa_id'],
            'komunikasi' => $input['komunikasi'],
            'berpikir_kritis' => $input['berpikir_kritis'],
            'kerja_tim' => $input['kerja_tim'],
            'inisiatif' => $input['inisiatif'],
            'literasi_digital' => $input['literasi_digital'],
            'deskripsi_produk' => $input['deskripsi_produk'],
            'spesifikasi_produk' => $input['spesifikasi_produk'],
            'desain_produk' => $input['desain_produk'],
            'implementasi_produk' => $input['implementasi_produk'],
            'pengujian_produk' => $input['pengujian_produk'],
            'total_nilai_industri' => $total
        ];

        $this->penilaianModel->insert($data);
        return redirect()->to('/penilaianindustri')->with('success', 'Data penilaian berhasil disimpan!');
    }

    // Menampilkan daftar penilaian
    public function index()
    {
        $data['penilaian'] = $this->penilaianModel->getWithMahasiswa();
        return view('penilaian_industri/index', $data);
    }
}
