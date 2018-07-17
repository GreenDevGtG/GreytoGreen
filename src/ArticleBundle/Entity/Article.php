<?php
namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\JoinTable(name="categorie_article",
     *   joinColumns={
     *     @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     *   }
     * )
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
     * @var string
     */
    private $tmpPath;

    /**
     * @var UploadedFile
     */
    private $file;

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
     * @param UploadedFile|null $file
     * @return Article
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if (isset($this->urlImage)) {
            $this->tmpPath = $this->urlImage;
            $this->urlImage = null;
        } else {
            $this->urlImage = '';
        }

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Fonction permettant de renomer l'image avant la sauvegarde en base.
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if ($this->getFile() !== null) {
            $hash = sha1(uniqid(mt_rand(), true));

            // $hash ~= sd54sdf54sf6zaqsd54sqd654ds.jpg
            $this->setUrlImage($hash . '.' . $this->getFile()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if ($this->getFile() === null) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->getUrlImage());
        $this->setFile(null);
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/upload/astuces';
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

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->creeLe = new \DateTime("now");
        $this->misAJourLe = new \DateTime("now");

    }

    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->misAJourLe = new \DateTime("now");
    }

    function miseEnFormeContenu(){
        $postTitre='</h3>';
    
        $postContenu='</div>';;
    
        $tab= explode('**',$this->getContenu());
        foreach ($tab as $key => $value) {
            if($key % 2 != 0){
                $tab[$key]='<h3>
                <a class="button-upDown" data-toggle="collapse" href="#collapseIn'.$key.'" role="button" aria-expanded="false" aria-controls="collapseIn'.$key.'">
                    <i class="text-white fa fa-sort-down"></i>
                </a>
                '.$value.$postTitre;
            }
            elseif ($key != 0) {
                $value=str_replace('--','<br>-',$value);
                $tab[$key]='<div class="collapse" id="collapseIn' . ($key - 1) . '" >'.$value.$postContenu;
            }
        }
        $raw = implode(' ',$tab);
        
        echo htmlspecialchars_decode($raw);
        
    }
}