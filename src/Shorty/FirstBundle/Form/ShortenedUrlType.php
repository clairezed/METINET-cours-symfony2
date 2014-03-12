<?php

namespace Shorty\FirstBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Shorty\FirstBundle\Entity\ShortenedUrl;

class ShortenedUrlType extends AbstractType{

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
			->add('original_url', 'text', array(
				'required'=>false))
			->add('slug', 'text', array(
				'required'=>false));
	}

	public function getName(){
		return 'shortyfirstbundle_shortenedurltype';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array(
			'data_class'=> 'Shorty\FirstBundle\Entity\ShortenedUrl'
			));
	}

}