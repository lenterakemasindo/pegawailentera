<?php

if (!function_exists('roots')) {
  /**
   * Get route data, example : "admin/dashboard"
   * 
   * @return String
   */
  function roots()
  {
    return uri_string(current_url());
  }
}
