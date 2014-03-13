<?php

namespace Shorty\FirstBundle\Repository;


interface ShortenedUrlRepositoryInterface
{
	public function findLatestShortenedUrl($itemCount);

	public function findShortenedUrlBySlug($slug);
} 