<?php


namespace Application\Core;


use Exception;

class Model
{
    public function loginAction()
    {
        unset($_SESSION['message']);
        if (!empty($_POST)) {
            $dataUser = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
            ];
            $Login = new Login($dataUser);
            try {
                if ($Login->validate()) {
                    header('Location: /profile');
                } else {
                    $_SESSION['message'] = 'Error: Incorrect username or password!';
                }
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
    }

    public function registerAction()
    {
        unset($_SESSION['message']);
        if (!empty($_POST)) {
            $dataUser = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'repeatPassword' => trim($_POST['repeatPassword']),
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'avatarURL' => trim($_POST['url']),
                'date' => $_POST['date'],
            ];
            $Register = new Register($dataUser);
            if ($Register->register()) {
                header('Location: /signup');
            } else {
                $_SESSION['message'] = $Register->getError();
            }
        }
    }
}