<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LogoutController extends Controller
{
    public function logoutAction()
    {
        $session = new Session();
        $session->clear();
        // redirect to route Home page
        return new Response('<html><body><p>Vous avez été donnecté ! <br><br><a href="/">Retour</a></p></body></html>');
    }

}
