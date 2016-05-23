<?php

namespace UserBundle\Controller;

use EntitiesBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Services\Register;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends Controller
{
    public function articleAction(Request $request)
    {



        if (!empty($_POST['price']) && !empty($_POST['etat']) && !empty($_POST['title']) && !empty($_POST['color'])  && !empty($_POST['description'])  && !empty($_POST['marque']) && !empty($_POST['endTime']) && count( $_FILES['imageProduit']['name'])>=3) {


            $uploads_dir = '../web/assets/uploads/';
            $extCheck = $_FILES["imageProduit"]["type"];
            $marque = $_POST['marque'];
            $etat = $_POST['etat'];
            $title = $_POST['title'];
            $finenchere = $_POST['endTime'];
            $couleur = $_POST['color'];
            $tab=array();
                foreach ($couleur as $color){
                    array_push($tab,$color);
                }
            $colorbdd = implode(' ',$tab);
            $test = array();
            $uploadOk = true ;
            $msg = ' ';
            $error = ' ';


            if(count($extCheck)>= 3 && count($extCheck)< 4 || $_FILES["imageProduit"]["type"] > 6000000){

            foreach ($extCheck as $i => $value) {

                $extension = explode('/', strtolower($extCheck[$i]));
                //    var_dump($extension[1]);
                array_push($test, $extension);
            }


            foreach ($_FILES["imageProduit"]["error"] as $key => $error) {
                foreach ($test as $k => $value){
                    if(($test[$k][1] !== 'jpg') && ($test[$k][1] !== 'png') && ($test[$k][1] !== 'jpeg') && ($test[$k][1] !== 'gif'))
                    {
                        $erreur = 'Veuillez inséré un fichier de type jpg,png,jpeg';
                        $uploadOk = false;
                    }
                }
                if ($error == UPLOAD_ERR_OK && !isset($erreur)) {
                    $tmp_name = $_FILES["imageProduit"]["tmp_name"][$key];
                    $name = $_FILES["imageProduit"]["name"][$key];
                    move_uploaded_file(($tmp_name), ($uploads_dir.$name));

                }

            }
            }else{
                $uploadOk = false;
            }

            if($uploadOk == false){
                $erreur = 'Veuillez inséré trois photos de type jpg,png,jpeg ';
            }else{
                $uploadDisplay = 'assets/uploads/';
                $fileUrl = array();

                foreach ($_FILES["imageProduit"]["error"] as $key => $error) {

                        $name = $_FILES["imageProduit"]["name"][$key];
                        array_push($fileUrl,$uploadDisplay.$name);
                }

                $session = $request->getSession();
                $idUserConnected = $session->get('userId');

                $user = $this->getDoctrine()
                    ->getRepository('EntitiesBundle:User')
                    ->findBy(array('id' => $idUserConnected));

                // var_dump($_FILES['imageProduit']['name']);

                function secondsToTime($seconds) {

                    $date = new \DateTime();
                    echo $date->getTimestamp(). "<br>";
                    $finalTime =  $date->add(new \DateInterval('PT'.$seconds.'S'));
                    return $finalTime;
                }


                $time = secondsToTime($finenchere) ;

                var_dump($time);
                $newArticle = new Article();
                $newArticle->setNickname($user[0]->getNickname());
                $newArticle->setMarque($marque);
                $newArticle->setTitle($title);
                $newArticle->setDateArticle(new \DateTime());
                $newArticle ->setArticleUrl1($fileUrl[0]);
                $newArticle ->setArticleUrl2($fileUrl[1]);
                $newArticle ->setArticleUrl3($fileUrl[2]);
                $newArticle ->setEndTime($time);
                $newArticle ->setEtat($etat);
                $newArticle ->setCouleur($colorbdd);
                $newArticle->setIdUser($user[0]->getId());
                $newArticle->setDescription($_POST['description']);
                $price = $newArticle->setPrice($_POST['price']);
                $bidPrice = $newArticle->setBidPrice($_POST['bidPrice']);
                $newArticle->setIdArticle($user[0]->getId());


                $em = $this->getDoctrine()->getManager();
                $em->persist($newArticle);
                $em->flush();

                $erreur = "Article ajouté avec succès !";
               // header( "Refresh:3; url=/");


            }
        }

        else{

            $erreur ='Veuillez remplir tout les champs correctement';


        }


        return $this->render('UserBundle:Articles:article.html.twig', array('erreur'=>$erreur));
    }
}
