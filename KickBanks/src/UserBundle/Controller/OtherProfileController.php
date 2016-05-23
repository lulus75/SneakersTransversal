<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use EntitiesBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OtherProfileController extends Controller
{
    public function otherProfileAction(Request $request, $nickname)
    {

        $session = $request->getSession();
        $idUserConnected = $session->get('userId');

        //recuperation data base
        $otherProfile = $this->getDoctrine()
            ->getRepository('EntitiesBundle:User')
            ->findBy(array('nickname' => $nickname));
        $otherNickname = $otherProfile[0]->getNickname();
        $otherEmail = $otherProfile[0]->getEmail();
        $otherFirstname = $otherProfile[0]->getFirstname();
        $otherLastname = $otherProfile[0]->getLastname();


        //reucperation des articles de other
        $otherArticle = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findBy(array('nickname' => $nickname));

        return $this->render('UserBundle:User:otherProfile.html.twig',array('nickname' => $otherNickname,
            'email' => $otherEmail, 'otherArticle' => $otherArticle,'firstname'=>$otherFirstname,'lastname'=>$otherLastname));

    }
}
