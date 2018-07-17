<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="fk_lieu_has_article_article1_idx", columns={"article_id"}), @ORM\Index(name="fk_lieu_has_article_lieu1_idx", columns={"lieu_id"})})
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     *
     */
    private $date_debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $date_fin;

    /**
     * @var \Lieu
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="MapBundle\Entity\Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     * })
     */
    private $lieu;

    /**
     * @var \Article
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ArticleBundle\Entity\Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     * @return Commentaire
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     * @return Commentaire
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    /**
     * @return \Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param \Lieu $lieu
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    /**
     * @return \Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param \Article $article
     * @return Evenement
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

}
