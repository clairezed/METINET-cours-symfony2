<?php

namespace Shorty\FirstBundle\Service;

class Sha1 implements HashInterface{

	public function hash($string){
		return sha1($string);
	}
}