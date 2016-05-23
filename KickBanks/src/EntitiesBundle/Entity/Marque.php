<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 */
class Marque
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $marque;

    /**
     * @var string
     */
    private $logoUrl;


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
     * Set marque
     *
     * @param string $marque
     * @return Marque
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
     * Set logoUrl
     *
     * @param string $logoUrl
     * @return Marque
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Get logoUrl
     *
     * @return string 
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }
}
