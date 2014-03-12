<?php

namespace Shorty\FirstBundle\Service;

class Md5 implements HashInterface{

	public function hash($string){
		return md5($string);
	}
}