<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendrier
 *
 * @ORM\Table(name="calendrier", indexes={@ORM\Index(name="fk_calendrier_article1_idx", columns={"id_article"})})
 * @ORM\Entity
 */
class Calendrier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_calendrier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCalendrier;

    /**
     * @var \Article
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_article", referencedColumnName="id_article")
     * })
     */
    private $idArticle;


}
