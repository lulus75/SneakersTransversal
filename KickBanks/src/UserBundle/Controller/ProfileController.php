<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileController extends Controller
{
    public function profileAction(Request $request)
    {
        
        $session = $request->getSession();
        $idUserConnected = $session->get('userId');

        var_dump($idUserConnected);

        $user = $this->getDoctrine()
            ->getRepository('EntitiesBundle:User')
            ->findBy(array('id' => $idUserConnected));

        foreach ($user as $usersInfos) {
            $nickname = $usersInfos->getNickname();
            $email = $usersInfos->getEmail();
            $firstname = $usersInfos->getFirstName();
            $lastname = $usersInfos->getLastName();
        }

        $myArticle = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findBy(array('idUser' => $idUserConnected));
        if (empty($myArticle)) {
            $msg = "Vous n'avez pas encore poster d'article !";
            $allArticles = '';
        } else {
            $msg = '';
            $allArticles = $myArticle;
        }

        //historique enchère
        $allEnchere = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Enchere')
            ->findBy(array('idUser' => $idUserConnected));

        if (empty($allEnchere)) {
            $msgHistorique = 'Vous avez participer à aucune enchère !';
            $newPrice = '';
            $date = '';
            $historiquePrice = $msgHistorique;
        } else {
            $msgHistorique = '';
            ////////////////////////////////boucler sur toutes les encheres et envoyer date price de toute
            /////////////////////////////METTRE LES VARIABLES twig
            foreach ($allEnchere as $enchere) {
                $historiquePrice[] = $enchere->getNewPrice();
            }
        }

        return $this->render('UserBundle:User:profile.html.twig',
            array('nickname' => $nickname,
                'email' => $email,
                'msgArticle' => $msg,
                'allArticles' => $allArticles,
                'historiquePrice' => $historiquePrice,
                'msgHistorique' => $msgHistorique,
                'firstname' => $firstname,
                'lastname' => $lastname));

    }
}
