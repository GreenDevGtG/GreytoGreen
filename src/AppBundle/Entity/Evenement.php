<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * 
 */
class Evenement
{
    /**
     * @var \DateTime
     *
     * 
     */
    private $date_debut;

    /**
     * @var \DateTime
     *
     * 
     */
    private $date_fin;

    /**
     * @var \Lieu
     *
     * 
     */
    private $lieu;

    /**
     * @var \Article
     *
     * 
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
