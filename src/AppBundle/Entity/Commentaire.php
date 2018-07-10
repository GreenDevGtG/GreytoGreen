<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_Utilisateur_has_article_article1_idx", columns={"article_id"}), @ORM\Index(name="fk_Utilisateur_has_article_Utilisateur1_idx", columns={"utilisateur_id"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cree_le", type="datetime", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $creeLe;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=65535, nullable=false)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mis_a_jour_le", type="datetime", nullable=false)
     */
    private $misAJourLe;

    /**
     * @var \Utilisateur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

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
    public function getCreeLe()
    {
        return $this->creeLe;
    }

    /**
     * @param \DateTime $creeLe
     * @return Commentaire
     */
    public function setCreeLe($creeLe)
    {
        $this->creeLe = $creeLe;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
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
     * @return Commentaire
     */
    public function setMisAJourLe($misAJourLe)
    {
        $this->misAJourLe = $misAJourLe;
        return $this;
    }

    /**
     * @return \Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param \Utilisateur $utilisateur
     * @return Commentaire
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
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
     * @return Commentaire
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }



}
