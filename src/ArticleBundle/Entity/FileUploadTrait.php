<?php

/*
 * This file is part of the CoreBundle package.
 *
 * Copyright (c) 2017, Vincent Letourneau <vincent@nanoninja.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of FileUploadTrait
 *
 * @author Vincent Letourneau <vincent@nanoninja.com>
 */
trait FileUploadTrait
{

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var string
     */
    protected $tmpPath;

    /**
     * @var UploadedFile
     * 
     * @Assert\File(maxSize="2000000")
     */
    protected $file;

    /**
     * Set image
     * 
     * @param string $image
     * 
     * @return FileUploadTrait
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     * 
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set file.
     * 
     * @param UploadedFile $file
     * 
     * @return FileUploadTrait
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if (isset($this->image)) {
            $this->tmpPath = $this->image;
            $this->image = null;
        } else {
            $this->image = '';
        }

        return $this;
    }

    /**
     * Get file.
     * 
     * @return FileUploadTrait
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
            $this->setImage($hash . '.' . $this->getFile()->guessExtension());
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

        $this->getFile()->move($this->getUploadRootDir(), $this->getImage());

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
        if (null === $this->getImage()) {
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
        if (null === $this->getImage() || '' === $this->getImage()) {
            return;
        }

        return $this->getUploadDir() . '/' . $this->getImage();
    }

    /**
     * Get upload root dir.
     * 
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../app/Resources/upload/image/' . $this->getUploadDir();
    }

    /**
     * Get upload dir.
     * 
     * @return string
     */
    protected function getUploadDir()
    {
        return 'user';
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

}
