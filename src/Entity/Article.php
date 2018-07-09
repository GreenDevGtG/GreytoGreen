<?php

namespace App\Entity;

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
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

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
     * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="idArticle")
     */
    private $idUtilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Categorie", mappedBy="idArticle")
     */
    private $idCategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Lieu", inversedBy="idArticle")
     * @ORM\JoinTable(name="evenement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_article", referencedColumnName="id_article")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_lieu", referencedColumnName="id_lieu")
     *   }
     * )
     */
    private $idLieu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCategorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idLieu = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
