<?php
namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(name="url_image", type="text", length=65535, nullable=true)
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
     * @ORM\Column(name="cree_le", type="datetime")
     */
    private $creeLe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mis_a_jour_le", type="datetime")
     */
    private $misAJourLe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Utilisateur", inversedBy="articles")
     * @ORM\JoinTable(name="auteur")
     */
    private $utilisateurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ArticleBundle\Entity\Categorie", inversedBy="articles")
     * @ORM\JoinTable(name="categorie_article")
     */
    private $categories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MapBundle\Entity\Lieu", inversedBy="articles")
     * @ORM\JoinTable(name="evenement")
     */
    private $lieus;

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
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lieu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set file.
     * 
     * @param UploadedFile $file
     * 
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
     * Get file.
     * 
     * @return Article
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * 
     * @return void
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $hash = sha1(uniqid(mt_rand(), true));
            $this->setUrlImage($hash . '.' . $this->getFile()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     * 
     * @return void
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->getUrlImage());

        if (isset($this->tmpPath)) {
            $this->removeFile($this->getUploadRootDir() . '/' . $this->tmpPath);
            $this->tmpPath = null;
        }

        $this->setFile(null);
    }

    /**
     * @ORM\PostRemove()
     * 
     * @return void
     */
    public function removeUpload()
    {
        if (($file = $this->getAbsolutePath())) {
            $this->removeFile($file);
        }
    }

    /**
     * Get absolute path.
     * 
     * @return mixed
     */
    public function getAbsolutePath()
    {
        if (null === $this->getUrlImage()) {
            return;
        }

        return $this->getUploadRootDir() . '/' . $this->getImage();
    }

    /**
     * Get web path.
     * 
     * @return mixed
     */
    public function getWebPath()
    {
        if (null === $this->getUrlImage() || '' === $this->getUrlImage()) {
            return;
        }

        return $this->getUploadDir() . '/' . $this->getUrlImage();
    }

    /**
     * Get upload root dir.
     * 
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/upload/image/' . $this->getUploadDir();
    }

    /**
     * Get upload dir.
     * 
     * @return string
     */
    protected function getUploadDir()
    {
        return 'article';
    }

    /**
     * Remove file
     * 
     * @param string $filename
     */
    protected function removeFile($filename)
    {
        if (is_file($filename)) {
            unlink($filename);
        }
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

    
    public function getMisAJourLe()
    {
        return $this->misAJourLe;
    }

    
    public function setMisAJourLe($misAJourLe)
    {
        $this->misAJourLe = $misAJourLe;
        return $this;
    }

   
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

   
    public function setUtilisateur($utilisateur)
    {
        $utilisateur->setArticle($this);
        $this->utilisateurs[] = $utilisateur;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return Article
     */
    public function setCategories($categories)
    {
        foreach ($categories as $categorie) {
            $categorie->setArticles($this);
            $this->categories[] = $categorie;
        } 

        return $this;
    }

    /**
     * @return Article
     */
    public function setCategorie(ArticleBundle\Entity\Categorie $categorie)
    {
        $categorie->setArticles($this);
        $this->categories[] = $categorie;
        return $this;
    }

    
    public function getLieus()
    {
        return $this->lieus;
    }

    /**
     * @return Article
     */
    public function setLieu($lieu)
    {
        $lieu->setArticle($this);
        $this->lieu[] = $lieu;
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
        $postTitre='</h4>';
    
        $postContenu='</div>';;
    
        $tab= explode('**',$this->getContenu());
        foreach ($tab as $key => $value) {
            if($key % 2 != 0){
                $tab[$key]='<h4>
                <a class="button-upDown" data-toggle="collapse" href="#collapseIn'.$this->getId().$key.'" role="button" aria-expanded="false" aria-controls="collapseIn'.$this->getId().$key.'">
                    <i class="text-white fa fa-sort-down"></i>
                </a>
                '.$value.$postTitre;
            }
            elseif($key !=0) {
                $value=str_replace('--','<br>-',$value);
                $tab[$key]='<div class="collapse" id="collapseIn' . ($this->getId().$key - 1) . '" >'.$value.$postContenu;
            }
        }
        $raw = implode(' ',$tab);
        
        echo htmlspecialchars_decode($raw);
        
    }
}