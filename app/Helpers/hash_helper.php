<?php

if (!function_exists('pw')) {
  /**
   * Make extra secure hash
   * @param String $to_hashed 
   * 
   * @return String
   */
  function pw($to_hashed)
  {
    $hash = hash('sha224', $to_hashed);
    $hash .= hash('ripemd128', $to_hashed);
    return md5($hash);
  }
}

if (!function_exists('rememberTokenHash')) {
  /**
   * Make ekstra secure remember token with hash
   * @param String $username
   * @param String $password
   * @param Integer $id
   * 
   * @return String
   */
  function rememberTokenHash($username, $password, $id)
  {
    $hash = pw($id);
    $hash .= pw($username);
    $hash .= pw($password);
    $hash = sha1($hash);
    return md5($hash);
  }
}
