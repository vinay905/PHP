<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    public function __construct()
    {
        helper(['url','form']);
    }
    
    public function index()
    {
        return view("Login");
    }

    public function forgotpass()
    {
        return view("mailform");
    }
}
