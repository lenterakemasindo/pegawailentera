<?php
if (!function_exists('formatDate')) {
  /**
   * Convert Date Format To Indonesian Format
   * @param String $date
   * 
   * @return String Date Format DDDD DD-MM-YY
   */
  function formatDate($date)
  {
    $hari = [
      '', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
    ];
    $bulan = [
      '', 'Januari', 'Febluari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $result = strtotime($date);
    $result = date('N:d-m-Y', $result);
    $result = explode(':', $result);
    $hari = $hari[$result[0]];
    $result = explode('-', $result[1]);

    $result = $hari . ", " . $result[0] . " " . $bulan[ltrim($result[1], '0')] . " " . $result[2];

    return $result;
  }
}
if (!function_exists('formatTime')) {
  /**
   * Convert Time Format To Indonesian Format
   * @param String $time
   * 
   * @return String Time Format G:i:s
   */
  function formatTime($time)
  {
    $result = explode(' ', $time);
    return $result[1];
  }
}
if (!function_exists('formatCurrency')) {
  /**
   * Convert Currency Format To Indonesian Format
   * @param Float $int Also can used normal Int 
   * 
   * @return String Curremcy For Rp. XXX.XXX,00
   */
  function formatCurrency($int)
  {
    return "Rp. " . number_format($int, 0, ',', '.') . ",00";
  }
}
