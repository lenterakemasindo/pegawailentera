<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Jadwal as crown;

class Jadwal extends BaseController
{
    protected $database;
    protected $day;

    public function __construct()
    {
        $this->database = new crown();
        $this->day = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];
        $this->halaman = $this->halaman;
        $this->halaman['page'] = "Absensi";
    }

    public function index()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Jadwal Kerja';

        return view('jadwal/index', [
            'datatable' => $data,
            'day' => $this->day,
            'halaman' => $this->halaman
        ]);
    }

    public function edit($id)
    {
        $find = $this->database->find($id);

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Ubah Jam Kerja';

        return view('jadwal/edit', [
            'datatable' => (object) $find,
            'day' => $this->day[$find['id'] - 1],
            'halaman' => $this->halaman
        ]);
    }

    public function update($id)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'masuk' => ['required'],
            'keluar' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $find = $this->database->find($id);

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Ubah Jam Kerja';

            return view('jadwal/edit', [
                'datatable' => (object) $find,
                'day' => $this->day[$find['id'] - 1],
                'halaman' => $this->halaman
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->update($id, [
            'masuk' => $data['masuk'],
            'keluar' => $data['keluar'],
        ]);

        return redirect()->to('menu/jadwal');
    }
}
