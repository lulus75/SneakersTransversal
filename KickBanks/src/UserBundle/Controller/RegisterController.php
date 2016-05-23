<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends Controller
{
    public function registerAction(Request $request)
    {
        $registerService = $this->container->get('register');
        $data = $registerService->register();
        $idUserConnected = '';
        if (count($data) == 6) {  //tab renvoyer celui des correct


            $em = $this->getDoctrine()->getManager();
            $newUser = new User();
            $newUser->setNickname($data[0]);
            $newUser->setEmail($data[1]);
            $newUser->setPassword($data[2]);
            $newUser->setPassword2($data[3]);
            $newUser->setFirstname($data[4]);
            $newUser->setLastname($data[5]);


            $em->persist($newUser);
            $em->flush();



            $user = $this->getDoctrine()
                ->getRepository('EntitiesBundle:User')
                ->findBy(array('email' => $data[1], 'password' => $data[2]));

            $idUserLogin = $user;
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


            return $this->render('UserBundle:Base:index.html.twig', array('articles' => $articles, 'articlesPriceSearch' => $articlesSearch, 'msgError' => $msgError, 'tab' => $data, 'id' => $idUserConnected));
        }
        return $this->render('UserBundle:User:register.html.twig', array('tab' => $data, 'id' => $idUserConnected));

    }

    public function profileAction(Request $request)
    {
        return $this->render('UserBundle:User:profile.html.twig');

    }
}
