<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity
 */
class Lieu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_lieu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLieu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", length=65535, nullable=false)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TÃ©lÃ©phone", type="string", length=20, nullable=true)
     */
    private $tã©lã©phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="site_web", type="string", length=80, nullable=true)
     */
    private $siteWeb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="idLieu")
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
