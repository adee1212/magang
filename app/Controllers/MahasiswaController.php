<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MahasiswaModel; // Pastikan untuk mengimpor model mahasiswa

class MahasiswaController extends BaseController
{
    public function index()
    {
        // // Menggunakan MahasiswaModel untuk mendapatkan data mahasiswa
        // $mahasiswaModel = new MahasiswaModel();
        // $userId = session()->get('user_id'); // Mendapatkan user_id dari session
        // $mahasiswa = $mahasiswaModel->getAllMahasiswa(); // Mengambil semua data mahasiswa

        // return view('/daftar_mahasiswa', ['mahasiswa' => $mahasiswa]); // Mengirimkan data ke view
        // // Mengambil data mahasiswa berdasarkan user_id
        // $mahasiswa = $mahasiswaModel->find($userId);

        // // Cek apakah hasil pengambilan data mahasiswa tidak null
        // if (!$mahasiswa) {
        //     return redirect()->to('/login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan login kembali.'); // Mengalihkan jika tidak ada
        // }

        // // Kirimkan data ke view
        // return view('mahasiswa/dashboard', ['mahasiswa' => $mahasiswa]);
        $role = session()->get('role');
        $userId = session()->get('user_id');
        $mahasiswaModel = new MahasiswaModel();

        if ($role === 'admin') {
            // Jika admin, tampilkan semua mahasiswa
            $mahasiswa = $mahasiswaModel->getAllMahasiswa(); // atau pakai findAll()
            return view('daftar_mahasiswa', ['mahasiswa' => $mahasiswa]);
        } elseif ($role === 'mahasiswa') {
            // Jika mahasiswa, tampilkan dashboard mahasiswa
            $mahasiswa = $mahasiswaModel->find($userId);

            if (!$mahasiswa) {
                return redirect()->to('/login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan login kembali.');
            }

            return view('mahasiswa/dashboard', ['mahasiswa' => $mahasiswa]);
        } else {
            return redirect()->to('/login')->with('error', 'Akses tidak valid.');
        }
    }

    public function edit()
    {
        $userId = session()->get('user_id');
        $mahasiswaModel = new MahasiswaModel();
        // Mengambil data mahasiswa
        $mahasiswa = $mahasiswaModel->find($userId);

        // Pastikan data mahasiswa ditemukan sebelum menampilkan form
        if (!$mahasiswa) {
            return redirect()->to('/login')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        return view('mahasiswa/edit', ['mahasiswa' => $mahasiswa]); // Mengembalikan view edit dengan data
    }

    public function update()
    {
        $mahasiswaModel = new MahasiswaModel();
        $userId = session()->get('user_id'); // Ambil user_id dari session

        // Ambil data dari input
        $dataUpdate = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nim'          => $this->request->getPost('nim'),
            'program_studi' => $this->request->getPost('program_studi'),
            'kelas'        => $this->request->getPost('kelas'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'divisi'       => $this->request->getPost('divisi'),
            'durasi_magang' => $this->request->getPost('durasi_magang'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'nama_pembimbing_perusahaan' => $this->request->getPost('nama_pembimbing_perusahaan'),
            'no_hp_pembimbing_perusahaan' => $this->request->getPost('no_hp_pembimbing_perusahaan'),
            'email_pembimbing_perusahaan' => $this->request->getPost('email_pembimbing_perusahaan'),
        ];

        // Update data mahasiswa
        if ($mahasiswaModel->update($userId, $dataUpdate)) {
            return redirect()->to('/mahasiswa/dashboard')->with('success', 'Profil berhasil diperbarui.'); // Redirect ke dashboard
        } else {
            return redirect()->back()->with('error', 'Update profil gagal.'); // Pesan error jika gagal
        }
    }

    public function update_password()
    {
        $userId = session()->get('user_id');

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $userModel = new UserModel();
        $user = $userModel->find($userId); // Ambil user dari tabel 'users'

        if ($user && password_verify($currentPassword, $user['password'])) {
            if ($newPassword === $confirmPassword) {
                $dataUpdate = [
                    'password' => password_hash($newPassword, PASSWORD_DEFAULT)
                ];

                if ($userModel->update($userId, $dataUpdate)) {
                    return redirect()->to('/mahasiswa/dashboard')->with('success', 'Password berhasil diperbarui.');
                } else {
                    return redirect()->back()->with('error', 'Gagal memperbarui password.');
                }
            } else {
                return redirect()->back()->with('error', 'Konfirmasi password baru tidak cocok.');
            }
        } else {
            return redirect()->back()->with('error', 'Password lama salah.');
        }
    }

    public function ganti_password()
    {
        return view('mahasiswa/ganti_password');
    }
}
