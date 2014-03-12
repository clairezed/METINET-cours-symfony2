<?php

namespace Shorty\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Shorty\FirstBundle\Form\ShortenedUrlType;
use Shorty\FirstBundle\Entity\ShortenedUrl;
use Shorty\FirstBundle\Service\HashSlugGenerator;
use Shorty\FirstBundle\Service\Sha1;
use Shorty\FirstBundle\Service\Md5;


class DefaultController extends Controller
{
    /**
    *@Route("/", name="home")
    *@Method("GET")
    *@Template()
    */
    public function indexAction()
    {
        $form = $this->createForm(new ShortenedUrlType());
        return array('form' => $form->createView());
    }

    /**
    *@Route("/shorten", name="shorten")
    *@Method({"GET", "POST"})
    *@Template()
    */
    public function shortenUrlAction(Request $request){
        $entity = new ShortenedUrl();
    	$form = $this->createForm(new ShortenedUrlType(), $entity);
    	$form->handleRequest($request);

    	if($form->isValid()){
            if($entity->getSlug() == null){
                $slugGenerator = $this->get('slug_generator_md5');
                // $slugGenerator = new HashSlugGenerator(new Md5());
                $slug = $slugGenerator->generateSlug($entity->getOriginalUrl());
                $entity->setSlug($slug);
            }
            $original_url = $form['original_url']->getData();
    		$slug =  $entity->getSlug();

            return array('form' => $form->createView(), 'slug'=> $slug);

    		// return $this->redirect($this->generateUrl('success', 
      //           array('entity' => $entity)
      //           ));
    	}

        return array('form' => $form->createView());
    }

    /**
    *@Route("/success/{$id}", name="success")
    *@Method({"GET", "POST"})
    *@Template()
    */
    public function shortenSuccessAction(ShortenedUrl $entity){
        $newEntity = $entity;
        var_dump($newEntity);
        exit;

        // return array('form' => $form->createView());
    }

}
