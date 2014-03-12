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
        $em = $this->getDoctrine()->getManager();
        $urls = $em->getRepository('ShortyFirstBundle:ShortenedUrl')->findAll();

        return array(
            'urls' => $urls
            );
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
                $slugGenerator = $this->get('slug_generator');
                $slug = $slugGenerator->generateSlug($entity->getOriginalUrl());
                $entity->setSlug($slug);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
    		// $slug =  $entity->getSlug();

    		return $this->redirect($this->generateUrl('success', 
                array('id' => $entity->getId())
                ));
    	}

        return array('form' => $form->createView());
    }

    /**
    *@Route("/success/{id}", name="success")
    *@Method({"GET", "POST"})
    *@Template()
    */
    public function shortenSuccessAction(ShortenedUrl $entity){
        // $newEntity = $entity;
        // var_dump($newEntity);
        // exit;

        return array('entity' => $entity);
    }

}
