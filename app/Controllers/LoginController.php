<?php

class LoginController
{

    private $view;

    /**
     * LoginController constructor.
     * @param $view
     */
    public function __construct()
    {
        $this->view = new View;
    }

    public function login()
    {
        $login = Helper::postString('login');
        $psw = Helper::postString('psw');

        if ($login === "admin" && $psw === "123") {
            $_SESSION["authenticated"] = 'true';
            header('Location: /');
        } else {
            $this->view->generate('login', null, 'Please input right login/pasword' , 'danger');
        }


    }

    public function logout()
    {
        session_unset();
        header('Location: /');
    }

    public function showLoginForm()
    {
        $this->view->generate('login');
    }

    public function permError()
    {
        (new MainController)->index(1, null, "You don't have permissions", 'danger');
    }

}