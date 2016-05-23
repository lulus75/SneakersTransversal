<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use EntitiesBundle\Entity\Article;
use EntitiesBundle\Entity\Marque;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class MarqueController extends Controller
{
    public function marqueAction($marqueName)
    {
        $marqueChoose = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Marque')
            ->findBy(array('marque' => $marqueName));
        $urlLogo = $marqueChoose[0]->getLogoUrl();
        $articleLinkToMarque = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findBy(array('marque' => $marqueName));
        $data = $articleLinkToMarque;

        if (empty($data)) {
            $msgError = 'Aucun produit liée à cette marque !';
        }else{
            $msgError = '';
        }


        return $this->render('UserBundle:Articles:marque.html.twig', array('urlLogo' => $urlLogo, 'nameMarque' => $marqueName, 'data' => $data, 'msgError' => $msgError));
        }
}
