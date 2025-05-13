<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PembimbingIndustri;

class PembimbingIndustriController extends BaseController
{
    public function dashboard()
    {
        return view('industri/dashboard');
    }

    public function editProfil()
    {
        $industriModel = new PembimbingIndustri();
        $pembimbingId = session()->get('pembimbing_id');

        $profil = $industriModel->find($pembimbingId); // atau where('pembimbing_id', $pembimbingId)
        return view('industri/edit_profil', ['profil' => $profil]);
    }

    public function updateProfil()
    {
        $industriModel = new PembimbingIndustri();
        $userId = session()->get('user_id');

        $data = [
            'nama'       => $this->request->getPost('nama'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email'      => $this->request->getPost('email'),
            'perusahaan' => $this->request->getPost('perusahaan'),
            'nip'        => $this->request->getPost('nip'),
        ];

        $industriModel->update($userId, $data);
        return redirect()->to('/industri/dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
    public function gantiPassword()
    {
        return view('industri/ganti_password');
    }

    public function simpanPassword()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $passwordBaru = $this->request->getPost('password');
        $konfirmasi  = $this->request->getPost('konfirmasi_password');

        if ($passwordBaru !== $konfirmasi) {
            return redirect()->back()->with('error', 'Password tidak cocok.');
        }

        $hashedPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $userModel->update($userId, ['password' => $hashedPassword]);

        return redirect()->to('/industri/dashboard')->with('success', 'Password berhasil diubah.');
    }
}
