<?php

namespace App\Controllers;

use App\Models\DosenPembimbingModel; // Memanggil model dosen pembimbing
use CodeIgniter\Exceptions\PageNotFoundException; // Untuk menangani exception

class DosenPembimbingController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenPembimbingModel(); // Membuat instance dari model
        $userId = session()->get('user_id'); // Mengambil user_id dari session

        // Mencari dosen berdasarkan user_id
        $dosen = $dosenModel->where('dosen_id', $userId)->first();

        // Memastikan data dosen ditemukan
        if (!$dosen) {
            return redirect()->to('/login')->with('error', 'Data dosen tidak ditemukan.'); // Redirect jika tidak ditemukan
        }
        // Mengembalikan view dashboard dengan data dosen
        return view('dosen/dashboard', ['dosen' => $dosen]);
    }

    // Fungsi untuk edit profil
    public function editProfile()
    {
        helper('form'); // <--- tambahkan ini
        $dosenModel = new DosenPembimbingModel();
        $userId = session()->get('user_id');

        // Mengambil data dosen berdasarkan user_id
        $dosen = $dosenModel->where('dosen_id', $userId)->first();

        if (!$dosen) {
            throw PageNotFoundException::forPageNotFound(); // Tangani jika data tidak ditemukan
        }

        // Tampilkan form edit profil
        return view('dosen/edit_profile', ['dosen' => $dosen]);
    }

    // Fungsi untuk memperbarui profil
    public function updateProfile()
    {
        $dosenModel = new DosenPembimbingModel();
        $userId = session()->get('user_id');

        // Validasi input yang diterima
        $this->validate($this->request, [
            'nama' => 'required',
            'email' => 'required|valid_email',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Update data dosen
        $dosenModel->update($userId, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            // Tambahkan kolom lain sesuai kebutuhan
        ]);

        return redirect()->to('/dosen/dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    // Fungsi untuk ganti password
    public function changePassword()
    {
        helper('form'); // <--- tambahkan ini
        return view('dosen/change_password'); // Tampilkan form ganti password
    }

    // Fungsi untuk memperbarui password
    public function updatePassword()
    {
        $dosenModel = new DosenPembimbingModel();
        $userId = session()->get('user_id');

        // Validasi input password
        $this->validate($this->request, [
            'current_password' => 'required', // Password saat ini
            'new_password' => 'required|min_length[8]', // Password baru dengan panjang minimal
            'confirm_password' => 'required|matches[new_password]', // Konfirmasi password
        ]);

        // Cek jika password saat ini benar
        $dosen = $dosenModel->where('dosen_id', $userId)->first();
        if (!password_verify($this->request->getPost('current_password'), $dosen['password'])) {
            return redirect()->back()->with('error', 'Password saat ini salah.'); // Tangani jika salah
        }

        // Update password baru
        $dosenModel->update($userId, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT), // Hash dan simpan password baru
        ]);

        return redirect()->to('/dosen/dashboard')->with('success', 'Password berhasil diperbarui.');
    }
}
