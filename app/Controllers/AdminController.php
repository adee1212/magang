<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DosenPembimbingModel;
use App\Models\PembimbingIndustriModel;
use App\Models\Bimbingan; // untuk dosen
use App\Models\BimbinganIndustriModel; // untuk industri
use App\Models\PembimbingIndustri;

class AdminController extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak.');
        }

        return view('admin_dashboard');
    }

    // FORM BIMBINGAN DOSEN
    public function tambahBimbingan()
    {
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenPembimbingModel();

        $mahasiswa = $mahasiswaModel->findAll();
        $dosen = $dosenModel->findAll();

        return view('/atur_bimbingan', ['mahasiswa' => $mahasiswa, 'dosen' => $dosen]);
    }

    public function saveBimbingan()
    {
        $bimbinganModel = new Bimbingan(); // gunakan model relasi bimbingan_dosen

        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'dosen_id'     => $this->request->getPost('dosen_id'),
        ];

        if ($bimbinganModel->insert($data)) {
            return redirect()->to('/admin')->with('success', 'Bimbingan dosen berhasil ditentukan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menentukan bimbingan dosen.');
        }
    }

    // 🔽 FORM BIMBINGAN INDUSTRI
    public function tambahBimbinganIndustri()
    {
        $mahasiswaModel = new MahasiswaModel();
        $pembimbingModel = new BimbinganIndustriModel();

        $mahasiswa = $mahasiswaModel->findAll();
        $pembimbing = $pembimbingModel->findAll();

        return view('atur_bimbingan_industri', [
            'mahasiswa' => $mahasiswa,
            'pembimbing' => $pembimbing
        ]);
    }

    public function saveBimbinganIndustri()
    {
        $mahasiswa_id = $this->request->getPost('mahasiswa_id');
        $pembimbing_id = $this->request->getPost('pembimbing_id');

        $mahasiswaModel = new MahasiswaModel();
        $pembimbingModel = new PembimbingIndustri();
        $bimbinganModel = new BimbinganIndustriModel();

        $mahasiswa = $mahasiswaModel->find($mahasiswa_id);
        $pembimbing = $pembimbingModel->find($pembimbing_id);

        if (!$mahasiswa || !$pembimbing) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        // Validasi kecocokan perusahaan
        if (strtolower($mahasiswa['nama_perusahaan']) !== strtolower($pembimbing['perusahaan'])) {
            return redirect()->back()->with('error', 'Perusahaan tidak cocok antara mahasiswa dan pembimbing industri.');
        }

        // Simpan relasi ke tabel bimbingan_industri
        if ($bimbinganModel->insert([
            'mahasiswa_id' => $mahasiswa_id,
            'pembimbing_id' => $pembimbing_id
        ])) {
            return redirect()->to('/admin')->with('success', 'Bimbingan industri berhasil ditentukan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data bimbingan industri.');
        }
    }
}
