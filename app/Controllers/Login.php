<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $nomorInduk = $this->request->getPost('nomor_induk'); // Ganti dengan nama input yang sesuai
        $password = $this->request->getPost('password');

        // Ambil data pengguna dari model
        $userModel = new UserModel();
        $user = $userModel->where('nomor_induk', $nomorInduk)->first();

        // Validasi username dan password
        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['user_id'],
                'nama'    => $user['nama'],
                'role'    => $user['role'],
                'logged_in' => true,
            ]);
            return redirect()->to('/admin'); // Redirect ke halaman admin
        } else {
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}