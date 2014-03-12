<?php

namespace Shorty\FirstBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class ShortenedUrl {
	/**
	* @var integer
	*/
	private $id;

	/**
	* @var string
	*/
	private $original_url;

	/**
	* @var string
	*/
	private $slug;

	public function getId(){
		return $this->id;
	}

	public function getOriginalUrl(){
		return $this->original_url;
	}

	public function getSlug(){
		return $this->slug;
	}

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function setOriginalUrl($original_url){
		$this->original_url = $original_url;
		return $this;
	}

	public function setSlug($slug){
		$this->slug = $slug;
		return $this;
	}
}