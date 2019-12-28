<?php


namespace Controllers;


use App\Controller;

class auth extends Controller
{
    public function index()
    {
        session_start();
        if ($_SESSION['name'] == 'admin') {

        }

        return $this->render('auth');
    }
}