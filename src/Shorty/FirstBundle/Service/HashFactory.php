<?php

class HashFactory {

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function create($type)
	{
		return $this->container->get('shorty.hasher.' . $type);
	}
}