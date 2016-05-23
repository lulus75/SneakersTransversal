<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // affichage par defaut
        $em = $this->getDoctrine()->getManager();
        $articles = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findAll();
        $msgError = '';


        return $this->render('UserBundle:Base:index.html.twig', array('articles' => $articles));
    }
}
