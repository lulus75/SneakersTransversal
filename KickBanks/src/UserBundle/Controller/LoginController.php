<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        if (!empty($_POST)) {
            $salt = 'azkeakzakeoakzeokaozekazokeoazkzedsdqskddksqkdqkdkqkdkqkdqkdaozekajzeuarheuqpreoaqmlqd';
            $p1 = trim(htmlentities($_POST['password']));
            $passwordLogin = sha1($p1 . $salt);

            $emailLogin = trim(htmlentities($_POST['email']));

            $user = $this->getDoctrine()
                ->getRepository('EntitiesBundle:User')
                ->findBy(array('email' => $emailLogin, 'password' => $passwordLogin));

            if (empty($user)) {
                var_dump("Veuillez vous inscrire ou rentrer des identifiants correct");
                return $this->render('UserBundle:User:login.html.twig');
            } else {
                $idUserLogin = $user[0]->getId();
                $session = new Session();
                $session->clear();
                $session->start();
                $session->set('userId', $idUserLogin);
                $session->get('userId');

                // affichage par defaut
                $em = $this->getDoctrine()->getManager();
                $articles = $this->getDoctrine()
                    ->getRepository('EntitiesBundle:Article')
                    ->findAll();
                $msgError = '';
                $articlesSearch = '';


                return $this->render('UserBundle:Base:index.html.twig', array('articles' => $articles, 'articlesPriceSearch' => $articlesSearch, 'msgError' => $msgError));

            }
        }
        return $this->render('UserBundle:User:login.html.twig');
    }
}
