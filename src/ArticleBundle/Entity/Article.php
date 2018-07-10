<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="url_image", type="text", length=65535, nullable=false)
     */
    private $urlImage;

    /**
     * @var string
     *
     * @ORM\Column(name="url_source", type="text", length=65535, nullable=false)
     */
    private $urlSource;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cree_le", type="datetime", nullable=false)
     */
    private $creeLe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mis_a_jour_le", type="datetime", nullable=false)
     */
    private $misAJourLe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Utilisateur", mappedBy="article")
     */
    private $utilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Categorie", mappedBy="article")
     */
    private $categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Lieu", inversedBy="article")
     * @ORM\JoinTable(name="evenement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     *   }
     * )
     */
    private $lieu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lieu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }

    /**
     * @param string $urlImage
     * @return Article
     */
    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlSource()
    {
        return $this->urlSource;
    }

    /**
     * @param string $urlSource
     * @return Article
     */
    public function setUrlSource($urlSource)
    {
        $this->urlSource = $urlSource;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreeLe()
    {
        return $this->creeLe;
    }

    /**
     * @param \DateTime $creeLe
     * @return Article
     */
    public function setCreeLe($creeLe)
    {
        $this->creeLe = $creeLe;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMisAJourLe()
    {
        return $this->misAJourLe;
    }

    /**
     * @param \DateTime $misAJourLe
     * @return Article
     */
    public function setMisAJourLe($misAJourLe)
    {
        $this->misAJourLe = $misAJourLe;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $utilisateur
     * @return Article
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $categorie
     * @return Article
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $lieu
     * @return Article
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }



}
