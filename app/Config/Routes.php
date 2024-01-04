<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::validating');
$routes->get('/logout', 'Auth::logout');
$routes->get('/secureLoginForUnsetSessionButSetCookie', 'Auth::logcookie');

$routes->get('/api/absen/absensi/(:num)', 'Absensi::api_absen/$1');

// UnLogged Menu 
$routes->group('', ['filter' => 'guest'], static function ($routes) {
  $routes->get('/login', 'Auth::form');
  $routes->get('/login/qrcode', 'Auth::qrLogin');
  $routes->get('/login/qrcode/(:num)', 'Auth::qr/$1');
  $routes->post('/login/qrcode/(:num)', 'Auth::loginV2/$1');
  $routes->post('/login', 'Auth::login');
});

// Logged In Menu
$routes->group('', ['filter' => 'auth'], static function ($routes) {
  // Pegawai Access Point
  $routes->get('/pegawai', 'PegawaiPage::index');
  $routes->post('/pegawai', 'PegawaiPage::update');


  // Administrator Access Point
  $routes->group('', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/dashboard', 'Home::index');
    $routes->get('/admin', 'Home::admin');

    // absensi reader
    $routes->get('/absen', 'Absensi::index');
    $routes->get('/absen/absensi/(:num)', 'Absensi::absen/$1');

    // Menu Link
    $routes->group('menu', static function ($routes) {

      // pegawai section
      $routes->get('pegawai', 'Pegawai::index');
      $routes->post('pegawai', 'Pegawai::insert');
      $routes->get('pegawai/details/(:num)', 'Pegawai::find/$1');
      $routes->post('pegawai/details/(:num)', 'Pegawai::update/$1');
      $routes->get('pegawai/destroy/(:num)', 'Pegawai::destroy/$1');
      $routes->get('pegawai/resetpw/(:num)', 'Pegawai::resetPw/$1');
      $routes->get('pegawai/resign/(:num)', 'Pegawai::resign/$1');
      $routes->get('pegawai/negresign/(:num)', 'Pegawai::negresign/$1');
      $routes->get('pegawai/resetipv4/(:num)', 'Pegawai::ip/$1');

      // jabatan section
      $routes->get('jabatan', 'Jabatan::index');
      $routes->post('jabatan', 'Jabatan::insert');
      $routes->get('jabatan/destroy/(:num)', 'Jabatan::destroy/$1');
      $routes->get('jabatan/edit/(:num)', 'Jabatan::edit/$1');
      $routes->post('jabatan/edit/(:num)', 'Jabatan::update/$1');

      // jadwal section
      $routes->get('jadwal', 'Jadwal::index');
      $routes->get('jadwal/edit/(:num)', 'Jadwal::edit/$1');
      $routes->post('jadwal/edit/(:num)', 'Jadwal::update/$1');

      // absen section
      $routes->get('absen', 'Absen::index');
      $routes->post('absen', 'Absen::findIndex');
      $routes->get('absen/masuk', 'Absen::masuk');
      $routes->post('absen/masuk', 'Absen::findMasuk');
      $routes->get('absen/keluar', 'Absen::keluar');
      $routes->post('absen/keluar', 'Absen::findKeluar');

      // kas section
      $routes->get('kas', 'Kasbon::index');
      $routes->post('kas', 'Kasbon::insert');
      $routes->get('kas/tebus/', 'Kasbon::tebus');
      $routes->get('kas/tebus/(:num)', 'Kasbon::formTebus/$1');
      $routes->get('kas/tebus/(:num)/view', 'Kasbon::viewTebus/$1');
      $routes->post('kas/tebus/(:num)', 'Kasbon::tebusProcess/$1');
      $routes->get('kas/destroy/(:num)', 'Kasbon::destroy/$1');
      $routes->get('kas/edit/(:num)', 'Kasbon::edit/$1');
      $routes->post('kas/edit/(:num)', 'Kasbon::update/$1');

      // slip gaji section
      $routes->get('slip', 'Penggajian::index');
      $routes->post('slip', 'Penggajian::vertivicate');
    });
  });
});
