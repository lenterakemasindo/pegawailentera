<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Slip as crown;
use App\Models\Pegawai as p;
use App\Models\Absen as a;

class Penggajian extends BaseController
{
    protected $database;
    protected $idp;
    protected $abs;

    public function __construct()
    {
        $this->database = new crown();
        $this->idp = new p();
        $this->abs = new a();
        $this->halaman = $this->halaman;
        $this->halaman['page'] = "Penggajian";
    }

    public function index()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Slip Gaji';

        return view('slip/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->idp
        ]);
    }

    public function vertivicate()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'start' => ['required'],
            'end' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();


            $data = $this->database->findAll();

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Data Slip Gaji';

            return view('slip/index', [
                'datatable' => $data,
                'halaman' => $this->halaman,
                'pegawai' => $this->idp,
                'error' => $errors
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $start = date('Y-m-d', strtotime($data['start']));
        $end = date('Y-m-d', strtotime($data['end']));

        $result = [];

        $find_absen = $this->abs->where("dt BETWEEN '{$start}' AND '{$end}'")->findAll();

        // Membuat data untuk form
        foreach ($this->idp->findAll() as $r) {
            $result[$r['idp']] = [
                'idp' => $r['idp']
            ];
        }
        $num = 0;
        foreach ($find_absen as $f) {
            $result[$num++] = [
                'pegawai' => $this->idp->find($f['idp']),
                'tipe' => $
            ];
            echo $this->idp->find($f['idp'])['nama'];
        }

        return redirect()->to('menu/slip');
    }
}
