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
        $shortenedUrlRepository = $this->get('shortened_url_repository');

        $urls = $shortenedUrlRepository->findLatestShortenedUrl(5);

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
            $entity->setCreatedAt();
            $entity->setNbClicks(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

    		return $this->redirect($this->generateUrl('success', 
                array('id' => $entity->getId())
                ));
    	}

        return array('form' => $form->createView());
    }

    /**
    *@Route("/success/{id}", name="success")
    *@Method({"GET"})
    *@Template()
    */
    public function shortenSuccessAction(ShortenedUrl $entity){
        return array('entity' => $entity);
    }

    /**
    *@Route("/r/{slug}", name="redirect_to_slug")
    *@Method({"GET"})
    */
    public function redirectToSlugUrl($slug){

        $shortenedUrlRepository = $this->get('shortened_url_repository');
        $entity = $shortenedUrlRepository->findShortenedUrlBySlug($slug);

        // \Doctrine\Common\Util\Debug::dump($entity);
        // exit;

        // nb clicks à incrémenter
        $entity->setNbClicks($entity->getNbClicks() + 1);
        $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

        return $this->redirect($entity->getOriginalUrl());
    }

}
