<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Pegawai as p;

class Auth extends BaseController
{
    public function form()
    {
        return view('auth/login');
    }
    public function login()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'username' => ['required', 'max_length[50]'],
            'password' => ['required', 'max_length[255]', 'min_length[5]'],
        ];

        // Validating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return view('auth/login', ['errors' => $errors]);
        }

        // Get validated data
        $data = $this->validator->getValidated();
        // Authtenticate Log In
        $findout = $this->users->where(
            ['user' => $data['username'], 'pass' => pw($data['password'])]
        )->findAll();
        // Redirect Back If Login Failed
        if (!$findout) {
            $this->session->setFlashdata('error', "username atau password salah");
            return redirect()->back()->with('test', 'failed')->withInput();
        }
        // Set login cookie & remember token
        $remember_token = rememberTokenHash($data['username'], pw($data['password']), $findout[0]['id']);
        createLoginCookie([
            'remember_token' => $remember_token,
            'id' =>  $findout[0]['id'],
            'islogin' => true,
            'ispegawai' => false,
        ], $remember_token);
        if ($this->request->getVar('remember') == 'on') $this->users->update(
            $findout[0]['id'],
            ['remember_token' => $remember_token]
        );
        $this->session->setFlashdata('msg', "Login Sukses !");
        return redirect()->to('/')->withCookies();
    }
    public function qrLogin()
    {
        return view('auth/qrcode');
    }
    public function qr($code)
    {
        return view('auth/qrpass');
    }
    public function loginV2($code)
    {
        $p = new p();

        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'password' => ['required', 'max_length[255]', 'min_length[5]'],
        ];

        // Validating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return view('auth/qrpass', ['errors' => $errors]);
        }

        // Get validated data
        $data = $this->validator->getValidated();
        // Authtenticate Log In
        $findout = $p->where(
            ['unicode' => $code, 'pass' => pw($data['password'])]
        )->findAll();
        // Redirect Back If Login Failed
        if (!$findout) {
            $this->session->setFlashdata('error', "login gagal, kata sandi gagal atau kode qr tidak diketahui");
            return redirect()->back()->with('test', 'failed')->withInput();
        }
        // Set login cookie & remember token
        $remember_token = rememberTokenHash($findout[0]['unicode'], pw($data['password']), $findout[0]['id']);
        createLoginCookie([
            'remember_token' => $remember_token,
            'id' =>  $findout[0]['id'],
            'islogin' => true,
            'ispegawai' => true,
        ], $remember_token);
        $p->update(
            $findout[0]['id'],
            ['remember_token' => $remember_token]
        );
        $this->session->setFlashdata('msg', "Selamat datang");
        return redirect()->to('/')->withCookies();
    }
    public function validating()
    {
        if (!session()->islogin && !get_cookie('log')) return redirect()->route('login');
        return redirect()->route('dashboard');
    }
    public function logout()
    {
        $p = new p();
        $findout = $this->users->find(session()->id);

        // Menghapus remember token
        if (isset(session()->id)) :
            if ($findout) {
                $this->users->update(
                    session()->id,
                    ['remember_token' => null]
                );
            } else {
                $p->update(
                    session()->id,
                    ['remember_token' => null]
                );
            }
        endif;
        // Memnghapus sesi
        session()->destroy();

        // Menghapus sesi login
        delete_cookie('log');

        return redirect('/')->withCookies();
    }

    public function logcookie()
    {
        $p = new p();
        $findout = $this->users->where(
            ['remember_token' => get_cookie('log')]
        )->findAll();
        if (!$findout) :
            $findout = $p->where(
                ['remember_token' => get_cookie('log')]
            )->findAll();
        endif;

        $remember_token = rememberTokenHash($findout[0]['user'], $findout[0]['pass'], $findout[0]['id']);
        createLoginCookie([
            'remember_token' => $remember_token,
            'id' =>  $findout[0]['id'],
            'islogin' => true
        ], $remember_token);
        return redirect('/');
    }
}
