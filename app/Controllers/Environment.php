<?php

namespace App\Controllers;

use PhpParser\Node\Expr\Cast\String_;
use App\Models\Auth as log;
use App\Controllers\Auth as auth;

class Environment extends BaseController
{
    public $ipc;

    protected function initializeClientIpAddress(): bool
    {
        $this->ipc = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $this->ipc = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $this->ipc = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $this->ipc = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $this->ipc = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $this->ipc = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $this->ipc = $_SERVER['REMOTE_ADDR'];
        else
            $this->ipc = 'UNKNOWN';

        if ($this->ipc != null) return true;
        return false;
    }
}
