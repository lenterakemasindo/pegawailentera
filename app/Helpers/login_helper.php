<?php

if (!function_exists('createLoginCookie')) {
  /**
   * Create login cookie with hash code
   * @param Array $data
   * @param String $remember_token
   * 
   * @return bool
   */
  function createLoginCookie($data, $remember_token)
  {
    setcookie('log', $remember_token, time() + 86400 * 365);
    session()->set($data);
    return true;
  }
}

if (!function_exists('findout')) {
  /**
   * Get user data from login sessions
   * @param String $string
   * 
   * @return array
   */
  function findout()
  {
    $users = new \App\Models\Auth();
    $findout = $users->find(session()->id);
    return $findout;
  }
}
