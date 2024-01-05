<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Slip as crown;
use App\Models\Pegawai as p;
use App\Models\Absen as a;
use App\Models\Config as c;

class Penggajian extends BaseController
{
    protected $database;
    protected $idp;
    protected $abs;
    protected $c;

    public function __construct()
    {
        $this->database = new crown();
        $this->idp = new p();
        $this->abs = new a();
        $this->c = new c();
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

        return redirect()->to("menu/slip/confirm/{$start}/{$end}");
    }

    public function find($start, $end)
    {
        $result = []; // Penyimpanan data per pegawai

        $find_absen = $this->abs->where("tipe=0 AND dt BETWEEN '{$start}' AND '{$end}'")->findAll();

        // Membuat Template Data
        foreach ($this->idp->where(["leave_at" => null])->findAll() as $r) {
            $result[$r['id']] = [
                'id' => $r['id'],
                'pegawai' => $r,
                'hadir' => 0,
                'tgl' => "{$start} s/d {$end}",
            ];
        }
        foreach ($find_absen as $f) {
            $id = $f['idp'];
            $fund = $this->idp->find($id);
            $result[$id]['hadir'] += 1;
        }

        $this->halaman->subpage = 'Konfirmasi Slip Gaji';

        return view('slip/confirm', [
            'datatable' => $result,
            'halaman' => $this->halaman,
            'pegawai' => $this->idp
        ]);
    }

    public function post($start, $end)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [];
        foreach ($this->idp->where(["leave_at" => null])->findAll() as $r) {
            $rules[$r['id'] . "id"] = ['required'];
            $rules[$r['id'] . "hadir"] = ['required'];
            $rules[$r['id'] . "bonus"] = ['required'];
            $rules[$r['id'] . "lembur"] = ['required'];
            $rules[$r['id'] . "potongan"] = ['required'];
        }

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

        foreach ($this->idp->where(["leave_at" => null])->findAll() as $r) {
            $rules[$r['id'] . "hadir"] = ['required'];
            $rules[$r['id'] . "bonus"] = ['required'];
            $rules[$r['id'] . "lembur"] = ['required'];
            $rules[$r['id'] . "potongan"] = ['required'];
            $this->database->insert([
                'idp' => $data[$r['id'] . "id"],
                'kehadiran' => $data[$r['id'] . "hadir"],
                'jamlembur' => $data[$r['id'] . "lembur"],
                'bonus' => $data[$r['id'] . "bonus"],
                'potongan' => $data[$r['id'] . "potongan"],
                'tgl' => $end,
                'gaji' => $r['gaji'],
                'lembur' => $r['lembur'],
            ]);
        }

        return redirect()->to("menu/slip/");
    }

    public function preprint()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'find' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) return $this->index();

        // Get validated data
        $valid = $this->validator->getValidated();

        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Slip Gaji';

        return view('slip/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->idp,
            'date' => $valid['find'],
            'redirect' => true
        ]);
    }

    public function print($tgl)
    {
        $data = []; // Data untuk slip gaji
        foreach ($this->database->where(['tgl' => $tgl])->findAll() as $r) {
            $data[$r['id']] = [
                'pegawai' => $this->idp->find($r['idp']),
                'slip' => $r,
            ];
        }
        return view('slip/print', ['data' => $data, 'c' => $this->c]);
    }
}
