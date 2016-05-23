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

class SearchController extends Controller
{
    public function searchAction()
    {
        // affichage par defaut
        $em = $this->getDoctrine()->getManager();
        $articles = $this->getDoctrine()
            ->getRepository('EntitiesBundle:Article')
            ->findAll();
        $msgError = '';

        $result ='Rechercher un produit spécifique';


        //recherche par prix
        if (!empty($_POST['priceInput'])) {


            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('price' => $_POST['priceInput']));

            $msgError = '';
            $result = $articlesSearch;

        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }


        //recherche par etat
        if (!empty($_POST['etat'])) {

            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('etat' => $_POST['etat']));

            $msgError = '';
            $result = $articlesSearch;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        //recherche par couleur
        if (!empty($_POST['color'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);



            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;

        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }


        // recherche par marque
        if (!empty($_POST['marque'])) {


            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('marque' => $_POST['marque']));

            $msgError = '';
            $result = $articlesSearch;
            
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        //par marque + prix
        if (!empty($_POST['priceInput']) && !empty($_POST['marque'])) {


            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('marque' => $_POST['marque'], 'price' => $_POST['priceInput']));
            $msgError = '';
            $result = $articlesSearch;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        //par marque + couleur

        if (!empty($_POST['color']) && !empty($_POST['marque'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);

            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('marque' => $_POST['marque']));


            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.marque LIKE :marque')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('marque' , $_POST['marque'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }


        //marque + etat

        if (!empty($_POST['etat']) && !empty($_POST['marque'])) {
            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('marque' => $_POST['marque'],'etat' => $_POST['etat']));

            $msgError = '';
            $result = $articlesSearch;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        //etat + couleur

        if (!empty($_POST['color']) && !empty($_POST['etat'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);

            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.etat LIKE :etat')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('etat' , $_POST['etat'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }


        //marque + prix + etat

        if (!empty($_POST['etat']) && !empty($_POST['marque']) && !empty($_POST['priceInput'])) {
            $em = $this->getDoctrine()->getManager();
            $articlesSearch = $this->getDoctrine()
                ->getRepository('EntitiesBundle:Article')
                ->findBy(array('marque' => $_POST['marque'],'etat' => $_POST['etat'],'price'=> $_POST['priceInput']));

            $msgError = '';
            $result = $articlesSearch;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }



        //marque + prix + couleur

        if (!empty($_POST['color']) && !empty($_POST['marque']) && !empty($_POST['priceInput']) ) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);



            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.marque = :marque')
                ->andwhere('p.price = :price')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('marque' , $_POST['marque'])
                ->setParameter('price' , $_POST['priceInput'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        //marque + couleur + etat


        if (!empty($_POST['color']) && !empty($_POST['marque'])  &&  !empty($_POST['etat'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);



            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.marque = :marque')
                ->andwhere('p.etat = :etat')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('marque' , $_POST['marque'])
                ->setParameter('etat' , $_POST['etat'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        // prix + couleur + etat

        if (!empty($_POST['color']) && !empty($_POST['priceInput']) &&  !empty($_POST['etat'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);



            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.price = :price')
                ->andwhere('p.etat = :etat')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('price' , $_POST['priceInput'])
                ->setParameter('etat' , $_POST['etat'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }




        //marque + prix + etat + couleur

        if (!empty($_POST['color']) && !empty($_POST['marque']) && !empty($_POST['priceInput']) &&  !empty($_POST['etat'])) {
            $couleur = $_POST['color'];
            $tab=array();
            foreach ($couleur as $color){
                array_push($tab,$color);
            }
            $colorbdd = implode(' ',$tab);



            $repository = $em->getRepository('EntitiesBundle:Article');
            $query = $repository->createQueryBuilder('p')
                ->where('p.couleur LIKE :couleur')
                ->andwhere('p.marque = :marque')
                ->andwhere('p.etat = :etat')
                ->andwhere('p.price = :price')
                ->setParameter('couleur', '%'.$colorbdd.'%')
                ->setParameter('marque' , $_POST['marque'])
                ->setParameter('etat' , $_POST['etat'])
                ->setParameter('price' , $_POST['priceInput'])
                ->getQuery();
            $colors = $query->getResult();

            $msgError = '';
            $result = $colors;
        } elseif (empty($articles)) {
            $articlesSearch = $articles;
            $msgError = 'Aucun résultat trouvé pour votre recherche ! ';
        }

        return $this->render('UserBundle:Articles:search.html.twig', array('result' => $result, 'articlesPriceSearch' => $articles, 'msgError' => $msgError));
    }
}
