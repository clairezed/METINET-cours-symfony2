<?php

namespace Shorty\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortenedUrl
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ShortenedUrl
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="original_url", type="string", length=255)
     */
    private $originalUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set originalUrl
     *
     * @param string $originalUrl
     * @return ShortenedUrl
     */
    public function setOriginalUrl($originalUrl)
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    /**
     * Get originalUrl
     *
     * @return string 
     */
    public function getOriginalUrl()
    {
        return $this->originalUrl;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ShortenedUrl
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
