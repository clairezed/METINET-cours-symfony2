<?php

namespace Shorty\FirstBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

class ShortenedUrlRepository implements ShortenedUrlRepositoryInterface {

	/**
     * @var EntityManager
     */
    protected $_em;


    public function __construct(EntityManager $em)
    {
        $this->_em = $em;
    }

    public function selectAllShortenedUrl(){
    	$qb = $this->_em->createQueryBuilder();
		return $qb->select('s')
			->from('Shorty\FirstBundle\Entity\ShortenedUrl', 's');
    }

	public function findLatestShortenedUrl($itemCount = 10){

		$qb = $this->selectAllShortenedUrl()
			->orderBy('s.createdAt', 'DESC')
			->setMaxResults($itemCount)
		;
		
		return $qb->getQuery()->getResult();
	}

	public function findShortenedUrlBySlug($slug){
		$qb = $this->selectAllShortenedUrl()
			->where('s.slug = :slug')
			->setParameters(array(':slug'=>$slug))
		;
		
		return $qb->getQuery()->getSingleResult();

	}

}