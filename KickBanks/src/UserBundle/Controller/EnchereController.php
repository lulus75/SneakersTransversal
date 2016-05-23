<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\User;
use EntitiesBundle\Entity\Article;
use EntitiesBundle\Entity\Commentaire;
use EntitiesBundle\Entity\Enchere;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class EnchereController extends Controller
{
    public function enchereAction($id, Request $request)
    {
        $article = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findBy(array('id' => $id));

        $enchere = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Enchere')
            ->findBy(array('idArticle' => $id));
        $dateStart = $article[0]->getDateArticle();
        $dateEnd = $article[0]->getEndTime();

        $end = new \DateTime("now");

//var_dump($end);


        if (!empty($article) && $end < $dateEnd ) {

            
            $nickname = $article[0]->getNickname();
            $title = $article[0] -> getTitle();
            $url[] = $article[0]->getArticleUrl1();
            $url[] = $article[0]->getArticleUrl2();
            $url[] = $article[0]->getArticleUrl3();
            $description = $article[0]->getDescription();
            $etat = $article[0] -> getEtat();
            $couleur = $article[0]->getCouleur();
            $price = $article[0]->getPrice();
            $bidPrice = $article[0]->getBidPrice();
            $marque = $article[0]->getMarque();
            $date = $article[0]->getDateArticle();
            $bidDuration = $article[0]->getEndTime();

            // recuperer l'utilisateur qui veut faire une enchere
            // POST du nouveau prix puis Update la bdd de l'article en question avec le nouveau prix si superieur au precedent sinon erreur

            // cree base de donnée Enchere qui contiendra ID de l'article en question
            // prix encherit
            // idUser qui encherit
            // la date



            if (!empty($_POST['newPrice']) && isset($_POST['newPrice'])) {
                $newPrice = $_POST['newPrice'];
                $oldPrice = $bidPrice;

                if ($oldPrice >= $newPrice) {
                    var_dump("Votre enchere et inférieur ou égale au prix déjà existant !");
                } else {
                    $newPrice = trim(htmlentities($newPrice));
                    //user qui vient de poster recuperer son pseudo pour enregistrer dans la bdd enchere
                    $session = new Session();
                    $idUserPost = $session->get('userId');

                    $em = $this->getDoctrine()->getManager();
                    $newEnchere = new Enchere();
                    $newEnchere->setNewPrice($newPrice);
                    $newEnchere->setIdUser($idUserPost);
                    $newEnchere->setIdArticle($id);
                    $newEnchere->setDate(new \DateTime());
                    $em->persist($newEnchere);
                    $em->flush();

                    $article = $this->getDoctrine()
                        ->getRepository('EntitiesBundle:Article')
                        ->findBy(array('id' => $id));

                    $article[0]->setBidPrice($newPrice);
                    $bidPrice = $article[0]->getBidPrice();
                    $em->flush();


                }
            }
            if (!empty($_POST['commentaire']) && isset($_POST['commentaire'])) {
                $commentairePoster = trim(htmlentities($_POST['commentaire']));

                $session = new Session();
                $idUserPost = $session->get('userId');

                $nicknameCommentaire = $this->getDoctrine()
                    ->getRepository('EntitiesBundle:User')
                    ->findBy(array('id' => $idUserPost));

                $nicknameCommentaire = $nicknameCommentaire[0]->getNickname();

                /////nouveau commentaire enregistrer bdd
                $em = $this->getDoctrine()->getManager();
                $newCommentaire = new Commentaire();
                $newCommentaire->setNickname($nicknameCommentaire);
                $newCommentaire->setIdUser($idUserPost);
                $newCommentaire->setContent($commentairePoster);
                $newCommentaire->setIdArticle($id);
                $newCommentaire->setDateCommentaire(new \DateTime());
                $em->persist($newCommentaire);
                $em->flush();
            }

            ////// recuperer tous les commentaire si il y en a déjà

            $commentaires = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Commentaire')
                ->findBy(array('idArticle' => $id));

            if (empty($commentaires)) {
                $msgErrorCommentaire = 'Aucun commentaire poster pour cette article !';
                $commentairesPoster = '';
            } else {
                $msgErrorCommentaire = '';
                $commentairesPoster = $commentaires;
            }


            return $this->render('UserBundle:Articles:articleEnchere.html.twig', array('article' => $article, 'nickname' => $nickname,
                'url' => $url, 'description' => $description, 'price' => $price, 'marque' => $marque, 'date' => $date, 'msgCommentaires' => $msgErrorCommentaire,
                'commentaires' => $commentairesPoster, 'bid' => $bidDuration, 'bidPrice' => $bidPrice, 'historique' => $enchere,
                'etat'=>$etat,'couleur' => $couleur,'title'=>$title
            ));


        }else
        if( $dateEnd > $end){
            $repository = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Enchere');

            $qb = $repository->createQueryBuilder('e1');

            $query1 = $qb->select($qb->expr()->max('e1.newPrice'))
                ->from('EntitiesBundle:Enchere', 'e2')->getQuery();
            $id = $query1->getSingleResult();
            $qb2 = $repository->createQueryBuilder('e');
            $query = $qb2->having('e.newPrice= :newPrice')
                ->setParameter('newPrice', $id)
                ->getQuery();

            $endBid = $query->getSingleResult();

            $lol = $endBid->getIdUser();
            $em = $this->getDoctrine()->getManager();
            $article[0]->setWinnerId($lol);
            $em->flush();
            return $this->redirect('/');
        }

        return $this->redirect('/');
    }
}
