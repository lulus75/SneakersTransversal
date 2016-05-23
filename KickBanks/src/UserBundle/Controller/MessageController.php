<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\Article;
use EntitiesBundle\Entity\Commentaire;
use EntitiesBundle\Entity\Message;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class MessageController extends Controller
{
    public function messageAction(Request $request)
    {
        $session = $request->getSession();
        $successMessage = '';
        $errorUser = '';
        $idUserConnected = $session->get('userId');

        if($idUserConnected != null){
        if (empty($_POST['recepteur']) || !isset($_POST['recepteur']) || empty($_POST['contentMsg']) || !isset($_POST['contentMsg'])) {
            var_dump("Remplissez TOUS les champs !");
        } else {
            $recepteur = $this->getDoctrine()
                ->getRepository('EntitiesBundle:User')
                ->findBy(array('nickname' => $_POST['recepteur']));
            if (empty($recepteur)) {
               $errorUser="Aucun utilisateur trouvé !";
            } else {

                $idOfRecepteur = $recepteur[0]->getId();
                $idUserEnvoyeur = $idUserConnected;
                $contentMessage = trim(htmlentities($_POST['contentMsg']));

                $em = $this->getDoctrine()->getManager();
                $newMessage = new Message();
                $newMessage->setIdUser($idUserEnvoyeur);
                $newMessage->setIdRecepteur($idOfRecepteur);
                $newMessage->setContentMessage($contentMessage);
                $newMessage->setDateMessage(new \DateTime());
                $em->persist($newMessage);
                $em->flush();

                $successMessage="Message envoyé avec succès !";
            }
        }

        /////Message envoyé
        $MessageSend = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Message')
            ->findBy(array('idUser' => $idUserConnected));
        if (empty($MessageSend)) {
            $msgNoMessageSend = 'Vous avez pas encor envoyé de message';
            $MessageSend = '';
            $nicknameOfRecepteur = '';
        } else {
            $msgNoMessageSend = '';
        }

        ///////Message reçu
        $MessageRecu = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Message')
            ->findBy(array('idRecepteur' => $idUserConnected));

           $name =  $MessageRecu[0]->getIdUser();
            $nickname = $this->getDoctrine()
                ->getRepository('EntitiesBundle:User')
                ->findBy(array('id' => $name));

            $nicknameSender = $nickname[0]->getnickname();


            if (empty($MessageRecu)) {
            $msgNoMessageRecu = 'Vous avez aucun message recu !';
            $MessageRecu = '';
        } else {
            $msgNoMessageRecu = '';
        }
        return $this->render('UserBundle:Messagerie:message.html.twig', array('msgNoMessageSend' => $msgNoMessageSend, 'msgSend' => $MessageSend, 'msgRecu' => $MessageRecu,'successMessage'=> $successMessage,'errorUser'=>$errorUser,'nicknameSender'=>$nickname));

    }else{
            return $this->redirect('/login');
        }
    }


}
