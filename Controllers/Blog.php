<?php


namespace Controllers;

use App\Controller;
use Models\User;

class Blog extends Controller
{

    public function index ()
    {
        session_start();
        if (!isset($_SESSION['time'])) {
            $_SESSION['time'] = date("H:i:s");
        }
        session_write_close();

        $user = new User('users');
        $data = $user->getAll();
        $params = [
            'param1' => "Don't do this",
            'param2' => "Or do this...",
            'data' => $data,
        ];
        return $this->render('blog', $params);
    }

    public function posts()
    {
        return $this->render('posts');
    }

}