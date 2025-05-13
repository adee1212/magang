<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Panitia;

class PanitiaController extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login dan role-nya panitia
        if (session()->get('logged_in') && session()->get('role') === 'panitia') {
            return view('panitia/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Akses ditolak.');
        }
    }
    public function dashboard()
    {
        $userModel = new Panitia();
        $user = $userModel->find(session()->get('panitia_id')); // Mengambil data user dari session
        return view('panitia/dashboard', ['panitia' => $user]);
    }
    public function editProfil()
    {
        $userModel = new Panitia();
        $user = $userModel->find(session()->get('panitia_id'));
        return view('panitia/edit_profil', ['panitia' => $user]);
    }


    public function updateProfil()
    {
        $userModel = new Panitia();
        $data = [
            'email' => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon')
        ];

        $userModel->update(session()->get('user_id'), $data);
        return redirect()->to('/panitia/dashboard')->with('message', 'Profil berhasil diperbarui!');
    }

    public function gantiPassword()
    {
        $userModel = new Panitia();
        $userId = session()->get('panitia_id');
        $user = $userModel->find($userId);

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasiPassword = $this->request->getPost('konfirmasi_password');

        if (password_verify($passwordLama, $user->password)) {
            if ($passwordBaru === $konfirmasiPassword) {
                $userModel->update($userId, ['password' => password_hash($passwordBaru, PASSWORD_DEFAULT)]);
                return redirect()->to('/panitia/dashboard')->with('message', 'Password berhasil diubah!');
            } else {
                return redirect()->to('/panitia/dashboard')->with('error', 'Password baru tidak cocok!');
            }
        } else {
            return redirect()->to('/panitia/dashboard')->with('error', 'Password lama salah!');
        }
    }
}
