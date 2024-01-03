<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Slip as crown;
use App\Models\Pegawai as p;

class Penggajian extends BaseController
{
    protected $database;
    protected $idp;

    public function __construct()
    {
        $this->database = new crown();
        $this->idp = new p();
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
}
