<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('dashboard/landingTab');
    }
    public function admin()
    {
        return view('dashboard/iframe');
    }
}
