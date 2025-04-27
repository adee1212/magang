<?php

namespace App\Controllers;

use App\Models\MahasiswaModel; // Untuk mengambil data mahasiswa
use App\Models\DosenPembimbingModel; // Untuk mengambil data dosen
use App\Models\BimbinganModel; // Model relasi bimbingan

class AdminController extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak.');
        }

        return view('admin_dashboard');
    }
    public function tambahBimbingan()
    {
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenPembimbingModel();

        $mahasiswa = $mahasiswaModel->findAll(); // Ambil semua mahasiswa
        $dosen = $dosenModel->findAll(); // Ambil semua dosen

        return view('/atur_bimbingan', ['mahasiswa' => $mahasiswa, 'dosen' => $dosen]);
    }

    public function saveBimbingan()
    {
        $bimbinganModel = new DosenPembimbingModel();

        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'), // ID mahasiswa
            'dosen_id'     => $this->request->getPost('dosen_id'), // ID dosen
        ];

        // Simpan data ke dalam tabel bimbingan
        if ($bimbinganModel->insert($data)) {
            return redirect()->to('/admin')->with('success', 'Bimbingan berhasil ditentukan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menentukan bimbingan.');
        }
    }
}
