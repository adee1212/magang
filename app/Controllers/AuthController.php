<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\DosenPembimbingModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $nomorInduk = $this->request->getPost('nomor_induk');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByNomorInduk($nomorInduk); // Cari pengguna berdasarkan nomor induk

        // Memeriksa apakah pengguna ditemukan dan password valid
        if ($user && password_verify($password, $user['password'])) {
            // Mengatur session jika login berhasil
            session()->set([
                'user_id'    => $user['user_id'],
                'nama'       => $user['nama'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'logged_in'  => true,
            ]);

            // Pengecekan berdasarkan role dan redirect sesuai
            if ($user['role'] === 'mahasiswa') {
                return redirect()->to('/mahasiswa/dashboard');
            } elseif ($user['role'] === 'pembimbing_dosen') {
                return redirect()->to('/dosen/dashboard'); // Redirect ke dashboard dosen pembimbing
            }

            // Untuk role admin, redirect ke dashboard admin
            return redirect()->to('/admin');
        }

        // Jika login gagal, redirect kembali dengan pesan error
        return redirect()->back()->with('error', 'Login gagal. Periksa Nomor Induk dan password.');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function create()
    {
        $userModel = new UserModel();
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenPembimbingModel();

        $nomorInduk = $this->request->getPost('nomor_induk');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $role = $this->request->getPost('role');

        $data = [
            'nomor_induk' => $nomorInduk,
            'password' => $password,
            'nama' => $nama,
            'email' => $email,
            'role' => $role
        ];

        if ($userModel->createUser($data)) {
            $userId = $userModel->insertID();

            if ($role === 'mahasiswa') {
                $mahasiswaData = [
                    'mahasiswa_id' => $userId,
                    'nama_lengkap' => $nama,
                    'nim' => $nomorInduk,
                    'program_studi' => 'Sistem Informasi',
                    'email' => $email,
                    'kelas' => $this->request->getPost('kelas'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                    'divisi' => $this->request->getPost('divisi'),
                    'durasi_magang' => 0,
                    'tanggal_mulai' => null,
                    'tanggal_selesai' => null,
                    'nama_pembimbing_perusahaan' => $this->request->getPost('nama_pembimbing_perusahaan'),
                    'no_hp_pembimbing_perusahaan' => $this->request->getPost('no_hp_pembimbing_perusahaan'),
                    'email_pembimbing_perusahaan' => $this->request->getPost('email_pembimbing_perusahaan'),
                ];
                $mahasiswaModel->insert($mahasiswaData);
            }

            if ($role === 'dosen_pembimbing') {
                $existingDosen = $dosenModel->where('nip', $nomorInduk)->first();
                if (!$existingDosen) {
                    $dosenData = [
                        'dosen_id' => $userId,
                        'nama_lengkap' => $nama,
                        'nip' => $nomorInduk,
                        'no_telepon' => $this->request->getPost('no_telepon'),
                        'email' => $email,
                        'link_whatsapp' => 'N/A'
                    ];
                    $dosenModel->insert($dosenData);
                } else {
                    return redirect()->back()->with('error', 'Dosen dengan NIP ini sudah terdaftar.');
                }
            }

            // ✅ Tambahkan notifikasi berhasil & redirect ke login
            session()->setFlashdata('success', 'Akun berhasil dibuat. Silakan login.');
            return redirect()->to('/login');
        }

        // ❌ Jika gagal menyimpan user
        return redirect()->back()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
    }
}
