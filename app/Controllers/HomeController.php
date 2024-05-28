<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    private const VIEWS_DIRECTORY = 'home/';
    public function index(): string
    {
        //$this->dataToView['title'] = 'Bem Vindo a Home';
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }
}
