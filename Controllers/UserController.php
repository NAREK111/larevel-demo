<?php

require_once MODELS . 'User.php';
require_once MODELS . 'Markers.php';

class UserController extends Controller
{
    public function formRegisterAction()
    {
        $this->render('register');
    }

    public function formLoginAction()
    {
        $this->render('login');
    }

    public function registerAction()
    {
        $register = new User();
        if ($register->userRegister()) {
            $this->redirect('user/formLogin');
            // header('location: /user/formLogin');
        } else {
            $this->redirect('user/formRegister');
            // header('location: /user/formRegister');
        }

    }

    public function loginAction()
    {
        $user = new User();
        $arrayInfoUser = $user->userLogin();
        if ($arrayInfoUser) {
            $this->redirect('profil/index');
        } else {
            $this->redirect('user/formLogin');

            // throw new Exception('is not user', 404);
        }
    }

    public function logOutAction()
    {
        session_start();
        session_destroy();
        $this->redirect('user/formLogin');

    }




}