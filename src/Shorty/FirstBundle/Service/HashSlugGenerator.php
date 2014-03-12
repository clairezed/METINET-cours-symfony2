<?php

namespace Shorty\FirstBundle\Service;

use Shorty\FirstBundle\Service\SlugGeneratorInterface;

class HashSlugGenerator implements SlugGeneratorInterface{

	private $hash;
	
	public function __construct($hash){
		$this->hash = $hash;
	}

	public function generateSlug($url){
		return $this->hash->hash($url);
	}

}