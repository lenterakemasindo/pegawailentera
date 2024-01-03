<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Jabatan as crown;

class Jabatan extends BaseController
{
    protected $database;

    public function __construct()
    {
        $this->database = new crown();
    }

    public function index()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Jabatan';

        return view('jabatan/index', [
            'datatable' => $data,
            'halaman' => $this->halaman
        ]);
    }

    public function insert()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'jabatan' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Detail Pegawai';

            return view('jabatan/index', [
                'errors' => $errors, 'halaman' => $this->halaman, 'datatable' => $this->database->findAll()
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->insert([
            'nama' => $data['jabatan']
        ]);

        return redirect()->to('menu/jabatan');
    }

    public function edit($id)
    {
        $find = $this->database->find($id);

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Ubah Data Jabatan';

        return view('jabatan/edit', [
            'datatable' => (object) $find,
            'halaman' => $this->halaman
        ]);
    }

    public function destroy($id)
    {
        $delete = $this->database->delete($id);
        return redirect()->route('menu/jabatan');
    }

    public function update($id)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'jabatan' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Detail Pegawai';

            return view('jabatan/index', [
                'errors' => $errors, 'halaman' => $this->halaman, 'datatable' => $this->database->findAll()
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->update($id, [
            'nama' => $data['jabatan']
        ]);

        return redirect()->to('menu/jabatan');
    }
}
