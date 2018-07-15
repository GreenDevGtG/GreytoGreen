<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_image", type="text")
     */
    private $uRLImage;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_source", type="text")
     */
    private $uRLSource;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set uRLImage
     *
     * @param string $uRLImage
     *
     * @return Article
     */
    public function setURLImage($uRLImage)
    {
        $this->uRLImage = $uRLImage;

        return $this;
    }

    /**
     * Get uRLImage
     *
     * @return string
     */
    public function getURLImage()
    {
        return $this->uRLImage;
    }

    /**
     * Set uRLSource
     *
     * @param string $uRLSource
     *
     * @return Article
     */
    public function setURLSource($uRLSource)
    {
        $this->uRLSource = $uRLSource;

        return $this;
    }

    /**
     * Get uRLSource
     *
     * @return string
     */
    public function getURLSource()
    {
        return $this->uRLSource;
    }
}

