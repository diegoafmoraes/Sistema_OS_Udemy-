<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        $data = [
            'titulo' => lang('App.Home.Home'),
        ];

        return view('Home/index', $data);
    }
}
