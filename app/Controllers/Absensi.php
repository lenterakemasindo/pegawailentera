<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Pegawai;

use function PHPUnit\Framework\returnSelf;

class Absensi extends BaseController
{
    protected $a;
    protected $j;
    protected $p;
    protected $tipe = [
        0 => 'Absen Masuk',
        1 => 'Absen Keluar',
    ];
    protected $kehadiran = [
        0 => 'Hadir',
        1 => 'Sakit',
        2 => 'Keperluan',
    ];

    public function __construct()
    {
        $this->a = new Absen();
        $this->j = new Jadwal();
        $this->p = new Pegawai();
    }

    public function index()
    {
        $popup = null;
        $type = 'danger';
        if (session()->getFlashdata('error')) $popup = session()->getFlashdata('error');
        if (session()->getFlashdata('success')) {
            $popup = session()->getFlashdata('success');
            $type = 'success';
        }
        return view('absensi/index', [
            'popup' => $popup,
            'type' => $type
        ]);
    }
    public function absen($unicode)
    {
        // Cek apakah data benar
        $findout = $this->p->where([
            'unicode' => $unicode
        ])->findAll();
        // Kembalikan jika kode qr tidak ditemukan
        session()->setFlashdata('error', 'Kode Qr Tidak Terdaftar');
        if (!$findout) return redirect()->back();

        // Membuat id
        $id = $findout[0]['id'];

        // Menentukan Masuk Atau Keluar
        $findoutAgain = $this->a->where([
            'idp' => $id,
            'dt' => date('Y-m-d'),
            'tipe' => 0
        ])->findAll();
        $tipe = 0;
        if ($findoutAgain) $tipe = 1;
        // Mengecek jika sudah absen masuk dan keluar
        $findoutValidate = $this->a->where([
            'idp' => $id,
            'dt' => date('Y-m-d'),
            'tipe' => 1
        ])->findAll();
        session()->setFlashdata('error', 'Anda Sudah Absen Masuk Dan Keluar');
        if ($findoutValidate) return redirect()->back();

        // Menambahkan data absen
        $this->a->insert([
            'idp' => $id,
            'dt' => date('Y-m-d'),
            'tmp' => date('Y-m-d G:i:s'),
            'tipe' => $tipe,
            'kehadiran' => 0,
        ]);
        session()->setFlashdata('error', '');
        session()->setFlashdata('success', 'Data ' . $this->tipe[$tipe] . ' Untuk ' . $findout[0]['nama'] . ' Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function api_absen($unicode)
    {
        $data = [
            'status' => 0,
            'result' => [],
            'error' => 'token tidak diketahui',
        ];
        if (!isset($_GET['token'])) die(json_encode($data));
        $data['error'] = 'token anda salah';
        if ($_GET['token'] !== "18@b807") die(json_encode($data));

        $data['status'] = 1;
        $data['error'] = '';
        $data['result'] = [
            'data_absensi' => 'masuk',
            'nama_pegawai' => 'firman',
            'waktu' => '2029/20/20 19:20:21'
        ];

        echo json_encode($data);

        $this->a->insert([
            'idp' => 0,
            'dt' => date('Y-m-d'),
            'tmp' => date('Y-m-d G:i:s'),
            'tipe' => '5',
            'kehadiran' => 0,
        ]);
    }
}
