<?php

namespace App\Controllers;

use App\Models\Kps; // Pastikan menggunakan model Kps yang tepat

class KpsController extends BaseController
{
    protected $kpsModel;

    public function __construct()
    {
        $this->kpsModel = new Kps(); // Inisialisasi model Kps
    }

    public function dashboard()
    {
        $kpsId = session()->get('kps_id');
        if (!$kpsId) {
            return redirect()->to('/login')->with('error', 'Session tidak valid.');
        }

        $kps = $this->kpsModel->find($kpsId);
        if (!$kps) {
            return redirect()->to('/login')->with('error', 'Data KPS tidak ditemukan.');
        }

        return view('kps/dashboard', [
            'title' => 'Dashboard KPS',
            'kps'   => $kps
        ]);
    }

    public function profil()
    {
        $kps = $this->kpsModel->find(session()->get('kps_id'));

        return view('kps/profil', [
            'title' => 'Profil KPS',
            'kps'   => $kps
        ]);
    }

    public function editProfil()
    {
        $kps = $this->kpsModel->find(session()->get('kps_id'));

        if ($this->request->getMethod() === 'post') {
            // Ambil semua data yang diperlukan
            $data = $this->request->getPost([
                'nama',          // Tambahkan nama ke array
                'email',
                'no_telepon'
            ]);

            // Perbarui data KPS
            $this->kpsModel->update($kps['kps_id'], $data);
            return redirect()->to('/kps/profil')->with('success', 'Profil berhasil diperbarui.');
        }

        // Tampilkan view untuk mengedit profil
        return view('kps/edit_profil', [
            'title' => 'Edit Profil',
            'kps'   => $kps
        ]);
    }

    public function gantiPassword()
    {
        if ($this->request->getMethod() === 'post') {
            $kpsId = session()->get('kps_id');
            $newPassword = $this->request->getPost('password');

            // Enkripsi password (disesuaikan dengan implementasi aslinya)
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $this->kpsModel->update($kpsId, ['password' => $hashedPassword]);

            return redirect()->to('/kps/profil')->with('success', 'Password berhasil diganti.');
        }

        return view('kps/ganti_password', [
            'title' => 'Ganti Password'
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
