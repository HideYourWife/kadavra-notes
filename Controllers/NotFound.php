<?php


namespace Controllers;


use App\Controller;

class NotFound extends Controller
{
    public function index ()
    {
        return $this->render('404');
    }
}