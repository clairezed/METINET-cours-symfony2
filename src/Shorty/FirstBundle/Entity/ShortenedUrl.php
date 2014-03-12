<?php

namespace Shorty\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShortenedUrl
 */
class ShortenedUrl
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $originalUrl;

    /**
     * @var string
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
        $newSlug = strtolower(preg_replace("![^a-z0-9]+!i", "-", $slug));

        $this->slug = $newSlug;

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
