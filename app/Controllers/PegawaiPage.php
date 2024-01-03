<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Pegawai;
use App\Models\Config;

class PegawaiPage extends BaseController
{
    private $pegawai;
    protected $config;
    private $user;

    public function __construct()
    {
        $this->pegawai = new Pegawai();
        $this->config = new Config();
        $this->user = $this->pegawai->find(session()->id);
    }

    public function index()
    {
        if ($this->user['ktp'] === null || $this->user['birth_at'] === null) return $this->config();

        return view('pegawaiLanding/index', [
            'user' => $this->user,
            'pegawai' => $this->pegawai,
        ]);
    }

    public function config($error = null)
    {
        return view('pegawaiLanding/config', [
            'config' => $this->config,
            'user' => $this->user,
            'pegawai' => $this->pegawai,
            'errors' => $error,
        ]);
    }

    public function update()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'nama' => ['required'],
            'p@ss' => ['rules' => 'required', 'errors' => ['required' => 'The password field is required.']],
            'ktp' => ['required'],
            'birth_at' => ['rules' => 'required', 'errors' => ['required' => 'The birth field is required.']],
        ];

        // Validating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->config($errors);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->pegawai->update(session()->id, [
            'nama' => $data['nama'],
            'pass' => pw($data['p@ss']),
            'ktp' => $data['ktp'],
            'birth_at' => $data['birth_at'],
        ]);

        return redirect()->back();
    }
}
