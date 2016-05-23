<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use EntitiesBundle\Entity\Tchat;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class TchatController extends Controller
{
    public function tchatAction(Request $request)
    {
        $session = new Session();
        $idUserPost = $session->get('userId');

        $messageTchat = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Tchat')
            ->findAll();
        if (empty($messageTchat)) {
            $msgError = "Il n'y aucun message poster pour le moment";
            $allMsg = '';
        } else {
            $msgError = "";
            $allMsg = $messageTchat;
        }

        if (empty($_POST['message']) || !isset($_POST['message'])) {
            $msgErrorPost = 'Message invalide !';
        } else {
            $msgErrorPost = '';
            $nickname = $this->getDoctrine()
                ->getRepository('EntitiesBundle:User')
                ->findBy(array('id' => $idUserPost));
            $nicknamePost = $nickname[0]->getNickname();

            $content = trim(htmlentities($_POST['message']));
            $newMessageTchat = new Tchat();
            $newMessageTchat->setNickname($nicknamePost);
            $newMessageTchat->setContentMsg($content);
            $newMessageTchat->setDateMsg(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($newMessageTchat);
            $em->flush();

        }
        return $this->render('UserBundle:Tchat:tchat.html.twig', array('msgError' => $msgError,
            'msgErrorPost' => $msgErrorPost,
            'allMsg' => $allMsg));
    }
}
