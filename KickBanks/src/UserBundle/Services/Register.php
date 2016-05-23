<?php

namespace UserBundle\Services;

class Register
{
    public function register()
    {
        $tabOk = [];
        $tabErreur = [];
        $formOk = true;
        if (empty($_POST['nickname']) || !isset($_POST['nickname']) || strlen($_POST['nickname']) < 4) {
            $formOk = false;
            array_push($tabErreur, 'nickname invalide !');
        } else {
            $nickname = trim(htmlentities($_POST['nickname']));
        }

        if (empty($_POST['firstname']) || !isset($_POST['firstname']) || strlen($_POST['firstname']) < 4) {
            $formOk = false;
            array_push($tabErreur, 'Prénom invalide !');
        } else {
            $firstname = trim(htmlentities($_POST['firstname']));
        }

        if (empty($_POST['lastname']) || !isset($_POST['lastname']) || strlen($_POST['lastname']) < 4) {
            $formOk = false;
            array_push($tabErreur, 'Nom invalide !');
        } else {
            $lastname = trim(htmlentities($_POST['lastname']));
        }

        if (empty($_POST['email']) || !isset($_POST['email'])) {
            $formOk = false;
            array_push($tabErreur, 'email invalide !');
        } else {
            $email = trim(htmlentities($_POST['email']));
        }

        if (empty($_POST['password']) || !isset($_POST['password']) || empty($_POST['password2']) || !isset($_POST['password2']) || $_POST['password'] !== $_POST['password2']) {
            $formOk = false;
            array_push($tabErreur, 'password invalide !');
        }
        else {
            $salt = 'azkeakzakeoakzeokaozekazokeoazkzedsdqskddksqkdqkdkqkdkqkdqkdaozekajzeuarheuqpreoaqmlqd';
            $p1 = trim(htmlentities($_POST['password']));
            $p2 = trim(htmlentities($_POST['password2']));
            $password = sha1($p1 . $salt);
            $password2 = sha1($p2 . $salt);

        }

        if (count($tabErreur) > 0) {
            return $tabErreur;
        } else {
            array_push($tabOk, $nickname, $email, $password, $password2,$firstname,$lastname);
            return $tabOk;
        }
    }


}