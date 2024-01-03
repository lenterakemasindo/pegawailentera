<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Auth as users;

use function PHPUnit\Framework\returnSelf;

class Admin implements FilterInterface
{
  /**
   *
   * @param RequestInterface $request
   * @param array|null       $arguments
   *
   * @return mixed
   */
  public function before(RequestInterface $request, $arguments = null)
  {
    if (session()->ispegawai === true) return redirect('pegawai');
  }

  /**
   * @param RequestInterface  $request
   * @param ResponseInterface $response
   * @param array|null        $arguments
   *
   * @return mixed
   */
  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    //
  }
}
