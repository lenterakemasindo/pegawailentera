<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\Environment as env;
use App\Models\Auth as log;
use App\Models\Config as conf;
use Config\Services;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * 
     * Define BaseController Property
     * @var mixed
     * 
     */
    protected $ipc;
    protected $users;
    protected $session;
    protected $config;
    protected $halaman = [
        'page' => 'Pengguna',
        'subpage' => 'Index'
    ];



    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->ipc = new env();
        $this->users = new log();

        $this->halaman = (object) $this->halaman;

        $this->ipc->initializeClientIpAddress();
        $this->ipc = $this->ipc->ipc;
        $this->session = Services::session();
        $this->config = new conf();
        $this->config = $this->config->findAll();
    }
}
