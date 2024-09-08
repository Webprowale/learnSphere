<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Home');
    }
    public function about(): string
    {
        return view('About');
    }
    public function contact(): string
    {
        return view('Contact');
    }
    public function course(): string
    {
        return view('Course');
    }
    public function login()
    {
        return view('Login');
    }
    public function register()
    {
        return view('Register');
    }
}
