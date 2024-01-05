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
        if (!$findout) return ['e', 'UID N/A'];

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
        if ($findoutValidate) return ['e' => 'Sudah Absen'];

        // Menambahkan data absen
        $this->a->insert([
            'idp' => $id,
            'dt' => date('Y-m-d'),
            'tmp' => date('Y-m-d G:i:s'),
            'tipe' => $tipe,
            'kehadiran' => 0,
        ]);
        return [
            'data_absensi' => ($tipe == 1) ? 'keluar' : 'masuk',
            'nama_pegawai' => explode(' ', $findout[0]['nama'])[0],
            'waktu' => date('G:i:s')
        ];
    }

    public function api_absen($unicode)
    {
        $data = [
            'status' => 0,
            'result' => [],
            'error' => 'token tidak diketahui',
        ];
        if (!isset($_GET['token'])) die(json_encode($data)); // Error jika tidak terdapat token
        $data['error'] = 'token anda salah';
        if ($_GET['token'] !== "18@b807") die(json_encode($data)); // Error jika token salah
        $data['error'] = 'UID N/A';
        if ($regist = $this->p->where(['ipaddr' => 'r3g1st@r'])->findAll()) { // jika ada data untuk di registrasi
            $this->p->update($regist[0]['id'], [
                'ipaddr' => $unicode
            ]);
            $data['status'] = 1;
            $data['error'] = '';
            $data['result'] = [
                'data_absensi' => 'register',
                'nama_pegawai' => explode(' ', $regist[0]['nama'])[0],
                'waktu' => date('G:i:s')
            ];
            die(json_encode($data));
        }
        if (!$find = $this->p->where(['ipaddr' => $unicode])->findAll()) die(json_encode($data)); // Error jika data tidak diketahui
        $result = $this->absen($find[0]['unicode']);
        if (isset($result['e'])) {
            $data['error'] = $result['e'];
            die(json_encode($data));
        }
        $data['status'] = 1;
        $data['error'] = '';
        $data['result'] = $result;

        echo json_encode($data);
    }
}
