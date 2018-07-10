<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendrier
 *
 * @ORM\Table(name="calendrier", indexes={@ORM\Index(name="fk_calendrier_article1_idx", columns={"article_id"})})
 * @ORM\Entity
 */
class Calendrier
{
    /**
     * @var int
     *
     * @ORM\Column(name="calendrier_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calendrierId;

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
     * @return int
     */
    public function getCalendrierId()
    {
        return $this->calendrierId;
    }

    /**
     * @param int $calendrierId
     * @return Calendrier
     */
    public function setCalendrierId($calendrierId)
    {
        $this->calendrierId = $calendrierId;
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
     * @return Calendrier
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }


}
