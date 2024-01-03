<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kasbon as crown;
use App\Models\Pegawai as p;
use SebastianBergmann\Type\NullType;

class Kasbon extends BaseController
{
    protected $database;
    protected $p;

    public function __construct()
    {
        $this->database = new crown();
        $this->p = new p();
        $this->halaman['page'] = "Kasbon";
    }
    public function index()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Kasbon';

        return view('kasbon/index', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p
        ]);
    }

    public function insert()
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'idp' => ['required'],
            'jumlah' => ['required'],
            'ket' => ['required'],
            'tgl' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            $data = $this->database->findAll();

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Data Kasbon';

            return view('kasbon/index', [
                'datatable' => $data,
                'halaman' => $this->halaman,
                'pegawai' => $this->p
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->insert([
            'idp' => $data['idp'],
            'jumlah' => $data['jumlah'],
            'ket' => $data['ket'],
            'tgl' => $data['tgl'],
        ]);

        return redirect()->to('menu/kas');
    }

    public function destroy($id)
    {
        $delete = $this->database->delete($id);
        return redirect()->route('menu/kas');
    }

    public function edit($id)
    {
        $find = $this->database->find($id);

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Ubah Data Kasbon';

        return view('kasbon/edit', [
            'datatable' => (object) $find,
            'halaman' => $this->halaman,
            'pegawai' => $this->p
        ]);
    }

    public function update($id)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'idp' => ['required'],
            'jumlah' => ['required'],
            'ket' => ['required'],
            'tgl' => ['required'],
        ];

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            $data = $this->database->findAll();

            // Konfigurasi Halaman
            $this->halaman->subpage = 'Data Kasbon';

            return view('kasbon/index', [
                'datatable' => $data,
                'halaman' => $this->halaman,
                'pegawai' => $this->p,
                'errors' => $errors
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        $this->database->update($id, [
            'idp' => $data['idp'],
            'jumlah' => $data['jumlah'],
            'ket' => $data['ket'],
            'tgl' => $data['tgl'],
        ]);

        return redirect()->to('menu/kas');
    }

    // Essensials Function
    public function tebus()
    {
        $data = $this->database->findAll();

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Tebus Kasbon';

        return view('kasbon/tebus', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p
        ]);
    }

    public function formTebus($id)
    {
        $data = $this->database->find($id);

        $lunas = 0;
        if ($json = json_decode($data['dibayar'])) {
            foreach ($json->data as $d) {
                $lunas += $d->jumlah;
            }
        }
        $lunas = $data['jumlah'] - $lunas;

        if ($lunas === 0) return redirect()->to('menu/kas/tebus');

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Formulir Tebus Kasbon';

        return view('kasbon/tebus_form', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p
        ]);
    }

    public function tebusProcess($id)
    {
        // Secure function from hacking
        if (!$this->request->is('post')) return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

        // Set some rules
        $rules = [
            'id' => ['required'],
            'jumlah' => ['required'],
            'tgl' => ['required'],
        ];

        $dataf = $this->database->find($id);

        // Valudating rules
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();


            // Konfigurasi Halaman
            $this->halaman->subpage = 'Formulir Tebus Kasbon';

            return view('kasbon/tebus_form', [
                'datatable' => $dataf,
                'halaman' => $this->halaman,
                'pegawai' => $this->p,
                'errors' => $errors
            ]);
        }

        // Get validated data
        $data = $this->validator->getValidated();

        // Membuat data json untuk diupload
        if (!$decode = json_decode($dataf['dibayar'])) {
            $decode = null;
        } else {
            $decode = json_decode($dataf['dibayar'])->data;
        }
        $tgl = $data['tgl'];
        $jum = $data['jumlah'];
        // Jikalau Bukan Menambahkan Data
        if ($data['id'] != "null") :
            $decode[$data['id']]->tgl = $tgl;
            $decode[$data['id']]->jumlah = $jum;
        else :
            $count = 0;
            if ($decode !== null) $count = count($decode);
            $decode[$count] = (object) [
                'tgl' => $tgl,
                'jumlah' => (int) $jum
            ];
        endif;

        $decode = (object) ['data' => $decode];
        $json = json_encode($decode);

        $this->database->update($id, [
            'dibayar' => $json,
        ]);

        return redirect()->to('menu/kas/tebus/' . $id);
    }

    public function viewTebus($id)
    {
        $data = $this->database->find($id);

        // Konfigurasi Halaman
        $this->halaman->subpage = 'Data Tebus Kasbon';

        return view('kasbon/tebus_view', [
            'datatable' => $data,
            'halaman' => $this->halaman,
            'pegawai' => $this->p
        ]);
    }
}
