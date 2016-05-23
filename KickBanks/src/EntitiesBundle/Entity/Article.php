<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 */
class Article
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var int
     */
    private $idArticle;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $urlImgArticle;

    /**
     * @var \DateTime
     */
    private $dateArticle;

    /**
     * @var string
     */
    private $nickname;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Article
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idArticle
     *
     * @param integer $idArticle
     * @return Article
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get idArticle
     *
     * @return integer 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set urlImgArticle
     *
     * @param string $urlImgArticle
     * @return Article
     */
    public function setUrlImgArticle($urlImgArticle)
    {
        $this->urlImgArticle = $urlImgArticle;

        return $this;
    }

    /**
     * Get urlImgArticle
     *
     * @return string 
     */
    public function getUrlImgArticle()
    {
        return $this->urlImgArticle;
    }

    /**
     * Set dateArticle
     *
     * @param \DateTime $dateArticle
     * @return Article
     */
    public function setDateArticle($dateArticle)
    {
        $this->dateArticle = $dateArticle;

        return $this;
    }

    /**
     * Get dateArticle
     *
     * @return \DateTime 
     */
    public function getDateArticle()
    {
        return $this->dateArticle;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return Article
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    /**
     * @var integer
     */
    private $price;


    /**
     * Set price
     *
     * @param integer $price
     * @return Article
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * @var string
     */
    private $marque;


    /**
     * Set marque
     *
     * @param string $marque
     * @return Article
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }
    /**
     * @var string
     */
    private $articleUrl1;

    /**
     * @var string
     */
    private $articleUrl2;

    /**
     * @var string
     */
    private $articleUrl3;


    /**
     * Set articleUrl1
     *
     * @param string $articleUrl1
     * @return Article
     */
    public function setArticleUrl1($articleUrl1)
    {
        $this->articleUrl1 = $articleUrl1;

        return $this;
    }

    /**
     * Get articleUrl1
     *
     * @return string 
     */
    public function getArticleUrl1()
    {
        return $this->articleUrl1;
    }

    /**
     * Set articleUrl2
     *
     * @param string $articleUrl2
     * @return Article
     */
    public function setArticleUrl2($articleUrl2)
    {
        $this->articleUrl2 = $articleUrl2;

        return $this;
    }

    /**
     * Get articleUrl2
     *
     * @return string 
     */
    public function getArticleUrl2()
    {
        return $this->articleUrl2;
    }

    /**
     * Set articleUrl3
     *
     * @param string $articleUrl3
     * @return Article
     */
    public function setArticleUrl3($articleUrl3)
    {
        $this->articleUrl3 = $articleUrl3;

        return $this;
    }

    /**
     * Get articleUrl3
     *
     * @return string 
     */
    public function getArticleUrl3()
    {
        return $this->articleUrl3;
    }
    
    /**
     * @var \DateTime
     */
    private $endTime;


    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Article
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }



    /**
     * @var integer
     */
    private $bidPrice;
    
    /**
     * Set bidPrice
     *
     * @param integer $bidPrice
     * @return Article
     */
    public function setBidPrice($bidPrice)
    {
        $this->bidPrice = $bidPrice;

        return $this;
    }

    /**
     * Get bidPrice
     *
     * @return integer 
     */
    public function getBidPrice()
    {
        return $this->bidPrice;
    }
    /**
     * @var integer
     */
    private $winnerId;


    /**
     * Set winnerId
     *
     * @param integer $winnerId
     * @return Article
     */
    public function setWinnerId($winnerId)
    {
        $this->winnerId = $winnerId;

        return $this;
    }

    /**
     * Get winnerId
     *
     * @return integer 
     */
    public function getWinnerId()
    {
        return $this->winnerId;
    }
    /**
     * @var string
     */
    private $etat;

    /**
     * @var string
     */
    private $couleur;


    /**
     * Set etat
     *
     * @param string $etat
     * @return Article
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return Article
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
    
    /**
     * @var string
     */
    private $title;


    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
