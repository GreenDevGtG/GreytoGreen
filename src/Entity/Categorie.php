<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="idCategorie")
     * @ORM\JoinTable(name="categorie_article",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_article", referencedColumnName="id_article")
     *   }
     * )
     */
    private $idArticle;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArticle = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
