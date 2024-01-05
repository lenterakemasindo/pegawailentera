<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// Import semua class yang dibutuhkan
use App\Models\Pegawai as pMod;
use App\Models\Jabatan as select;

class Pegawai extends BaseController
{
    protected $database;

    public function __construct()
    {
        $this->database = new pMod();
    }

    public function index()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $halaman = $this->halaman;
        $halaman->subpage = 'Data pegawai';

        // Mengambil data jabatan
        $select = new select();

        return view('pegawai/index', [
            'datatable' => $data,
            'select' => $select->findAll(),
            'halaman' => $halaman
        ]);
    }

    public function find($id)
    {
        $find = $this->database->find($id);

        // Konfigurasi Halaman
        $halaman = $this->halaman;
        $halaman->subpage = 'Detail Pegawai';

        // Mengambil data jabatan
        $select = new select();

        return view('pegawai/detail', [
            'inspect' => (object) $find,
            'jabatan' => $select->find($find['jabatan']),
            'halaman' => $halaman,
            'select' => $select->findAll(),
        ]);
    }

    public function insert()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'nik' => ['required'],
            'nip' => ['required'],
            'gaji' => ['required'],
            'lembur' => ['required'],
            'bonus' => ['required'],
            'nama' => ['required'],
            'npwp' => ['required'],
            'jabatan' => ['required'],
            'masuk' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            $data = $this->database->findAll();

            // Konfigurasi Halaman
            $halaman = $this->halaman;
            $halaman->subpage = 'Data pegawai';

            // Mengambil data jabatan
            $select = new select();

            return view('pegawai/index', [
                'errors' => $errors,
                'datatable' => $data,
                'select' => $select->findAll(),
                'halaman' => $halaman
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->insert([
            'unicode' => $data['nip'],
            'user' => $data['nik'],
            'pass' => pw($this->config[0]['value']), // Config 0, value -> default password
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'npwp' => $data['npwp'],
            'gaji' => $data['gaji'],
            'lembur' => $data['lembur'],
            'bonus' => $data['bonus'],
            'join_at' => $data['masuk'],
        ]);

        return redirect()->route('menu/pegawai');
    }

    public function update($id)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'nik' => ['required'],
            'nip' => ['required'],
            'gaji' => ['required'],
            'lembur' => ['required'],
            'bonus' => ['required'],
            'nama' => ['required'],
            'npwp' => ['required'],
            'jabatan' => ['required'],
            'masuk' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            $data = $this->database->findAll();

            // Konfigurasi Halaman
            $halaman = $this->halaman;
            $halaman->subpage = 'Data pegawai';

            // Mengambil data jabatan
            $select = new select();

            return view('pegawai/index', [
                'errors' => $errors,
                'datatable' => $data,
                'select' => $select->findAll(),
                'halaman' => $halaman
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->update($id, [
            'user' => $data['nik'],
            'unicode' => $data['nip'],
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'npwp' => $data['npwp'],
            'gaji' => $data['gaji'],
            'lembur' => $data['lembur'],
            'bonus' => $data['bonus'],
            'join_at' => $data['masuk'],
        ]);

        return redirect()->to('menu/pegawai');
    }

    public function destroy($id)
    {
        $process = $this->database->delete($id);

        return redirect()->route('menu/pegawai');
    }


    // Unique Essensials Function :

    public function resetPw($id)
    {
        $process = $this->database->update($id, [
            'pass' => pw($this->config[0]['value'])
        ]);

        return redirect()->route('menu/pegawai');
    }

    public function resign($id)
    {
        $process = $this->database->update($id, [
            'leave_at' => date('Y-m-d')
        ]);

        return redirect()->route('menu/pegawai');
    }

    public function negresign($id)
    {
        $process = $this->database->update($id, [
            'leave_at' => null
        ]);

        return redirect()->route('menu/pegawai');
    }

    public function ip($id)
    {
        $process = $this->database->update($id, [
            'ipaddr' => null
        ]);

        return redirect()->route('menu/pegawai');
    }

    public function ips($id)
    {
        $process = $this->database->update($id, [
            'ipaddr' => 'r3g1st@r',
        ]);

        return redirect()->route('menu/pegawai');
    }
}
