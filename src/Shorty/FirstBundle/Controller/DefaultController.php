<?php

namespace Shorty\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Shorty\FirstBundle\Form\UrlType;

class DefaultController extends Controller
{
    /**
    *@Route("/", name="home")
    *@Method("GET")
    *@Template()
    */
    public function indexAction()
    {
        $form = $this->createForm(new UrlType());
        return array('form' => $form->createView());
    }

    /**
    *@Route("/shorten", name="shorten")
    *@Method({"GET", "POST"})
    *@Template()
    */
    public function shortenUrlAction(Request $request){
    	$form = $this->createForm(new UrlType());
    	$form->handleRequest($request);
    	if($form->isValid()){
    		$url=$form['url']->getData();
    		return array('url' => $url, 'form' => $form->createView());
    	}

        return array('form' => $form->createView());
    }

    // /**
    // *@Route("/shorten", name="_shorten")
    // *@Method("POST")
    // */
    // public function shortenUrlAction(){
    // 	$form = $this->createForm(new UrlType());
    //     return array('form' => $form->createView());
    // }
}
