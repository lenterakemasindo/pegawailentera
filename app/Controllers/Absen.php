<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Pegawai as p;
use App\Models\Absen as a;
use App\Models\Jadwal as j;

use function PHPUnit\Framework\returnSelf;

class Absen extends BaseController
{
    protected $p;
    protected $a;
    protected $j;

    public function __construct()
    {
        $this->p = new p();
        $this->a = new a();
        $this->j = new j();
    }

    public function index()
    {
        $data = $this->a->where([
            'dt' => date('Y-m-d')
        ])->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Masuk';

        return view('absen/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [date('Y-m-d'), date('Y-m-d')],
            'type' => 2
        ]);
    }

    public function findIndex()
    {
        // Get validated data
        if (!$this->validate(['start' => 'required', 'end' => 'required'])) return $this->index();
        $data = $this->validator->getValidated();

        $datatable = $this->a->where('dt BETWEEN "' . date('Y-m-d', strtotime($data['start'])) . '" and "' . date('Y-m-d', strtotime($data['end'])) . '"')->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Masuk';

        return view('absen/index', [
            'datatable' => $datatable,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [$data['start'], $data['end']],
            'type' => 0
        ]);
    }

    public function masuk()
    {
        $data = $this->a->where([
            'dt' => date('Y-m-d'),
            'tipe' => 0
        ])->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Masuk';

        return view('absen/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [date('Y-m-d'), date('Y-m-d')],
            'type' => 0
        ]);
    }

    public function findMasuk()
    {
        // Get validated data
        if (!$this->validate(['start' => 'required', 'end' => 'required'])) return $this->masuk();
        $data = $this->validator->getValidated();

        $datatable = $this->a->where('tipe=0 AND dt BETWEEN "' . date('Y-m-d', strtotime($data['start'])) . '" and "' . date('Y-m-d', strtotime($data['end'])) . '"')->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Masuk';

        return view('absen/index', [
            'datatable' => $datatable,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [$data['start'], $data['end']],
            'type' => 0
        ]);
    }

    public function keluar()
    {
        $data = $this->a->where([
            'dt' => date('Y-m-d'),
            'tipe' => 1
        ])->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Keluar';

        return view('absen/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [date('Y-m-d'), date('Y-m-d')],
            'type' => 1
        ]);
    }

    public function findKeluar()
    {
        // Get validated data
        if (!$this->validate(['start' => 'required', 'end' => 'required'])) return $this->keluar();
        $data = $this->validator->getValidated();

        $datatable = $this->a->where('tipe=1 AND dt BETWEEN "' . date('Y-m-d', strtotime($data['start'])) . '" and "' . date('Y-m-d', strtotime($data['end'])) . '"')->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Absensi Masuk';

        return view('absen/index', [
            'datatable' => $datatable,
            'halaman' => $this->halaman,
            'pegawai' => $this->p,
            'jadwal' => $this->j->find(date('w') + 1),
            'value' => [$data['start'], $data['end']],
            'type' => 1
        ]);
    }
}
