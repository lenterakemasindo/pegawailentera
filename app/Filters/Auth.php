<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Auth as users;

class Auth implements FilterInterface
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
        if (get_cookie('log')) { // Cek ketersediaan cookie login

            // buat sesi baru jika tidak ada
            if (!session()->islogin) return redirect('secureLoginForUnsetSessionButSetCookie');

            // paksa logout jika remember token tidak sama dengan cookie
            if (session()->remember_token !== get_cookie('log')) return redirect()->route('logout');
        }
        // Paksa logout jika belum terindikasi login
        if (!session()->islogin) return redirect()->route('logout');
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
