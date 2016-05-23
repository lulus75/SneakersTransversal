<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class EditProfileController extends Controller
{
    public function editProfileAction(Request $request)
    {

        $session = $request->getSession();
        $idUserConnected = $session->get('userId');

        $user = $this->getDoctrine()
            ->getRepository('EntitiesBundle:User')
            ->findBy(array('id' => $idUserConnected));

        if (empty($_POST['editNickname']) || !isset($_POST['editNickname']) || empty($_POST['editEmail']) || !isset($_POST['editEmail'])) {
            var_dump("erreur remplissez bien tous les champs");
        } else {
            var_dump("ok");

            $newNickname = trim(htmlentities($_POST['editNickname']));
            $newEmail = trim(htmlentities($_POST['editEmail']));
            var_dump($newEmail);
            var_dump($newNickname);
            if (strlen($newNickname) < 4) {
                var_dump("votre nouveau nickname doit faire minimum 5 caractères ...");
            } else {
                $em = $this->getDoctrine()->getManager();
                $user = $this->getDoctrine()
                    ->getRepository('EntitiesBundle:User')
                    ->findBy(array('id' => $idUserConnected));

                $user[0]->setNickname($newNickname);
                $user[0]->setEmail($newEmail);
                $em->flush();

                $articleOfUser = $this->getDoctrine()
                    ->getRepository('EntitiesBundle:Article')
                    ->findBy(array('idUser' => $idUserConnected));

                $articleOfUser[0]->setNickname($newNickname);
                $em->flush();


                var_dump($user);
                var_dump("Vos identifiants on étais mis à jour avec succès !");
            }
        }

        return $this->render('UserBundle:User:editProfile.html.twig');

    }
}
